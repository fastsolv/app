<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use DB;

use Illuminate\Support\Str;
use App\Models\Tenant\Ticket;
use App\Models\Tenant\TicketReply;
use App\Models\Tenant\TicketNote;
use App\Models\Tenant\TicketStatus;
use App\Models\Tenant\TicketUrgency;
use App\Models\Tenant\Department;
use App\Models\Tenant\Tag;
use App\Models\User;
use App\Models\Tenant\TicketInternalNote;
use App\Models\Tenant\Setting;
use App\Helpers\Uuid;
use App\Helpers\Random;
use App\Helpers\TicketHelper;
use App\Mail\TicketOpened;
use App\Mail\TicketReplyAdded;
use App\Models\Tenant\Services\TicketService;
use App\Models\Tenant\Services\UserService;
use App\Helpers\Logger;
use App\Helpers\AttachmentHelper;
use App\Models\Tenant\KbArticle;
use App\Models\Tenant\KbArticleTranslation;
use App\Models\Tenant\KbCategory;
use App\Models\Tenant\Product;
use App\Models\Tenant\RolePermission;
use App\Models\Tenant\TicketAttachment;
use App\Models\Tenant\TicketReplyAttachment;
use App\Models\Tenant\TicketStatusLife;
use App\Services\Email;
use Illuminate\Support\Facades\Storage;
use Auth;
use Stringable;

class TicketController extends Controller
{
    public function __construct()
    {
        /*
        make sure only logged in and verified user has access
        to this controller
        */
        $this->middleware(['auth', 'verified']);
    }
    public function index(Request $request)
    {
        // get the logged in user
        $user = User::find(auth()->id());
        // Get all departments of the logged in user
        $dep = $user->departments()->pluck('department_id')->toArray();
        /*
        Create an object of TicketService,
        TicketService has functions that inteact with the
        Ticket model
         */
        $ticketService = new TicketService();
        // get all ticket status
        $ticketStatuses = TicketStatus::all();
        // get all ticket urgency list
        $ticketUrgency = TicketUrgency::all();
        // get all departments
        $department = Department::all();
        // service class that interact with the user model.
        $userService = new UserService();
        // get the staff list
        $staffs = $userService->getStaffs();
        /*
        Get tickets based on the filter option.
         */
        if ( $request->name ) {
            if ( $request->order == 'desc' ) {
                $tickets = Ticket::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';
            } else {
                $tickets = Ticket::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';
            }
        } else {
            $tickets = $ticketService->getFilteredTickets($user, $request, $dep)->orderBy( 'last_touched_at', 'desc' )->paginate(10);
            $sort_order = 'desc';
        }

        /*
        Tickets by status count.
         */
        $ticketCount = $ticketService->ticketCount($user, $dep);
        /*
        Display the tickets
         */
        $params = [
            'tickets' => $tickets,
            'sort_order' => $sort_order,
            'ticket_statuses' => $ticketStatuses,
            'ticket_urgency' => $ticketUrgency,
            'request' => $request,
            'staffs' => $staffs,
            'department' => $department,
            'ticketCount' => $ticketCount
        ];
        if ($user->role == 'user'){
            if($request->filter_search){
                return view('tenant.ticket/user.search_filter', $params);
            }
            else{
                return view('tenant.ticket/user.index', $params);
            }
        } else {
            if($request->filter_search){
                return view('tenant.ticket.search_filter', $params);
            }
            else{
                return view('tenant.ticket.index', $params);
            }
        }
    }

    /*
    Get tickets based on ticket status.
    */
    public function ticketByStatus(Request $request, $id)
    {
        $user = User::find(auth()->id());
        $dep = $user->departments()->pluck('department_id')->toArray();
        $ticketService = new TicketService();
        $ticketStatuses = TicketStatus::all();
        $ticketUrgency = TicketUrgency::all();
        $department = Department::all();
        $userService = new UserService();
        $staffs = $userService->getStaffs();
        $tickets = $ticketService->getFilteredTickets($user, $request, $dep)
            ->where('ticket_status_id', $id)->paginate(10);
        /*
        Tickets by status count.
         */
        $ticketCount = $ticketService->ticketCount($user, $dep);
        $params = [
            'tickets' => $tickets,
            'ticket_statuses' => $ticketStatuses,
            'ticket_urgency' => $ticketUrgency,
            'request' => $request,
            'staffs' => $staffs,
            'department' => $department,
            'ticketCount' => $ticketCount
        ];
        if ($user->role == 'user'){
            return view('tenant.ticket/user.ticket_by_status', $params);
        } else {
            return view('tenant.ticket.ticket_by_status', $params);
        }
    }

    /*
    Get tickets bopened by the logged in user.
    */
    public function myTicket(Request $request)
    {
        /*
        Check weather the user has access to this function
         */
        $this->authorize('isStaff', Ticket::class);

        $user = User::find(auth()->id());
        $opened_user = $user->id;
        $ticketService = new TicketService();
        $ticketStatuses = TicketStatus::all();
        $ticketUrgency = TicketUrgency::all();
        $department = Department::all();
        $userService = new UserService();
        $staffs = $userService->getStaffs();

        if ( $request->name ) {
            if ( $request->order == 'desc' ) {
                $tickets = Ticket::where('opened_user_id', $opened_user)->orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';
            } else {
                $tickets =  Ticket::where('opened_user_id', $opened_user)->orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';
            }
        } else {
            $tickets = $ticketService->myTickets($user, $request, $opened_user)->paginate(10);
            $sort_order = 'desc';
        }


        $params = [
            'tickets' => $tickets,
            'sort_order' => $sort_order,
            'ticket_statuses' => $ticketStatuses,
            'ticket_urgency' => $ticketUrgency,
            'request' => $request,
            'staffs' => $staffs,
            'department' => $department
        ];
       
        if($request->filter_search){
            return view('tenant.ticket/my_ticket_search_filter', $params);
        }
        else{
            return view('tenant.ticket.my_ticket', $params);
        }
    }

    /*
    Get tickets assigned to the logged in user.
    */
    public function assignedToMe(Request $request)
    {
        $user = User::find(auth()->id());
        /*
        Check weather the user has access to this function
         */
        $this->authorize('isStaff', Ticket::class);

        $ticketService = new TicketService();
        $ticketStatuses = TicketStatus::all();
        $ticketUrgency = TicketUrgency::all();
        $department = Department::all();
        $userService = new UserService();
        $staffs = $userService->getStaffs();
        $tickets = $ticketService->assignedToMe($user, $request);

        $params = [
            'tickets' => $tickets,
            'ticket_statuses' => $ticketStatuses,
            'ticket_urgency' => $ticketUrgency,
            'request' => $request,
            'staffs' => $staffs,
            'department' => $department,
        ];
        if($request->filter_search){
            return view('tenant.ticket/assigned_to_me_search_filter', $params);
        }
        else{
            return view('tenant.ticket.tickets_assigned_me', $params);
        }
            return view('tenant.ticket.tickets_assigned_me', $params);
        }

    public function create(Request $request)
    {
        /*
        Check weather the user has access to this function
         */
        $this->authorize('isNotAdmin', Ticket::class);
        $setting = Setting::where('name', 'Products')
        ->first();
        $products = $setting->value ==1 ? Product::where('status',1)->get(): null;
        // Get all departments
        $department = Department::all();
        // get all ticket urgency list
        $ticketUrgency = TicketUrgency::all();
        // get all users with user role
        $users = User::where('role', 'user')
               ->get();
        // get the logged in user
        $user = User::find(auth()->id());
        // Display open ticket page
        $params = [
            'department' => $department,
            'ticketUrgency' => $ticketUrgency,
            'users' => $users,
            'user_id' => $user->id,
            'role' => $user->role,
            'products' => $products,
        ];
        if ($user->role == 'user'){
            return view('tenant.ticket/user.create', $params);
        } else {
            return view('tenant.ticket.create', $params);
        }
    }

    public function store(Request $request)
    {
        /*
        Check weather the user has access to this function
         */
        $this->authorize('isNotAdmin', Ticket::class);
        try {
            // get the logged in user
            $user = User::find(auth()->id());
            if ($user->role == 'staff' && empty($request->ticket_user_id)){
                return redirect()->back()
                ->with('error', __('Add a user first'));
            }
            $ticketService = new TicketService();
            $validator = Validator::make($request->all(), [
                   'title' => 'required',
                   'message' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            // save ticket to database
            $ticket = new Ticket();
            $ticket->uuid = Uuid::getUuid();
            $ticket->ticket_user_id = $request->ticket_user_id;
            $ticket->department_id = $request->department_id;
            $ticket->product_id = $request->product_id;
            $ticket->ticket_urgency_id = $request->ticket_urgency_id;
            $ticket->opened_user_id = $user->id;
            $ticket->title = $request->title;
            $ticket->message = $request->message;
            $ticket->last_touched_at = Carbon::now()->format('Y-m-d H:i:s');
            /*
            Set ticket unread to the ticket
            */
            $ticket = $ticketService->setTicketUnread($ticket, Auth::user()->role);
            // Get allowed attachment extensions
            $extension = Setting::where('id', 2)->value('value');
            // Check for attachments
            if ($request->hasFile('attachments')) {
                $validator = Validator::make($request->all(), [
                    'attachments.*' => "required|mimes:$extension"
                ]);
                if ($validator->fails()) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', __('Invalid file format'));
                }
            }
            $ticket->save();
            if ($request->hasFile('attachments')) {
                $files = $request->file('attachments');
                // Set attachment name store to database
                $attachmentHelper = new AttachmentHelper();
                $storedFilenames = $attachmentHelper->privateStore($files, 'attachments');
                foreach ($storedFilenames as $fileName) {
                    $attachment = new TicketAttachment();
                    $attachment->name = $fileName;
                    $attachment->uuid = Uuid::getUuid();
                    $attachment->ticket_uuid = $ticket->uuid;
                    $attachment->save();
                }
            }
            $emailService = new Email();
            // Sent ticket opened mail to user's Email
            if (!empty($ticket->ticketUser) && !empty($ticket->ticketUser->email)) {
                $emailService->ticketOpened($ticket);
            }
            // Sent ticket opened mail to staffs under the ticket department
            $emailService->departmentEmail($ticket, $request->department_id);

            return redirect()->route('get_tickets')
                ->with('success', __('Ticket created'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    public function show($uuid)
    {
        $statuses = TicketStatus::all();
        $statusLife = TicketStatusLife::selectRaw('avg(life_time) as total, previous_status_id')
            ->where('ticket_uuid', $uuid)
            ->groupBy('previous_status_id')
            ->pluck('total', 'previous_status_id')->all();
        $ticket = Ticket::find($uuid);
        $params = [
            'statuses' => $statuses,
            'statusLife' => $statusLife,
            'ticket' => $ticket
        ];
        return view('tenant.ticket.show', $params);
    }

    public function closedStatus( $uuid)
    {

        $ticket = Ticket::find($uuid);
        $ticket->ticket_status_id= 2;
        $ticket->save();
        return redirect()
        ->route('tenant.ticket.reply', [$uuid])->with('success', __('Ticket Closed'));
    }

    public function reply(Request $request, $uuid)
    {
        $user = auth()->user();
        $ticket = Ticket::find($uuid);
        $kb_article = KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')->where('title', $ticket->title)
        ? KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')->where('title', $ticket->title)->first() :null;
        $ticketStatuses = TicketStatus::all();
        $ticketUrgency = TicketUrgency::all();
        $product_name =  $ticket->product_id?  Product::where('uuid',$ticket->product_id)->get():'';

        if (!$user->can('view', $ticket)) {
            return view('ticket.no_ticket');
        }
        if ($request->isMethod('POST')) {
            //if modifying the ticket
            if ($request->action && $request->action == "modify_ticket") {
                /*
                TODO: one confusion here.
                Are we using this for ticket modify ?
                If so why we need the modify function ?
                 */
                // $validator = Validator::make($request->all(), [
                //     'title' => 'required',
                //     'ticket_urgency_id' => 'required',
                //     'ticket_status_id' => 'required',
                // ]);
                // if ($validator->fails()) {
                //     $errors = $validator->errors()->first();
                //     return redirect()
                //     ->back()
                //     ->withInput()
                //     ->withErrors($validator);
                // }
                // $ticket->title = $request->title;
                // $ticket->ticket_urgency_id = $request->ticket_urgency_id;
                // $ticket->ticket_status_id = $request->ticket_status_id;
                // $ticket->save();
            } else {
                /*
                If replying to ticket
                */
                $validator = Validator::make($request->all(), [
                    'reply' => 'required'
                ]);
                if ($validator->fails()) {
                    $errors = $validator->errors()->first();
                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors($validator);
                }
            }

            $user = User::find(auth()->id());

            $ticketService = new TicketService();
            if ($request->reply) {

                $extension = setting::where('id', 2)->value('value');
                if ($request->hasFile('attachments')) {
                    $validator = Validator::make($request->all(), [
                        'attachments.*' => "required|mimes:$extension"
                    ]);
                    if ($validator->fails()) {
                        return response()->json(['error' => __('Invalid file format')], 400);
                    }
                }

                // Save ticket reply from TicketService
                $ticketReply = $ticketService->addTicketReply($user, $ticket, $request->reply);

                if ($request->hasFile('attachments')) {
                    $files = $request->file('attachments');
                    /*
                    Change the file name of attachment.
                    save attachment to database
                    */
                    $attachmentHelper = new AttachmentHelper();
                    $storedFilenames = $attachmentHelper->privateStore($files, 'attachments');
                    foreach ($storedFilenames as $fileName) {
                        $replyAttachment = new TicketReplyAttachment();
                        $replyAttachment->name = $fileName;
                        $replyAttachment->uuid = Uuid::getUuid();
                        $replyAttachment->ticket_reply_uuid = $ticketReply->uuid;
                        $replyAttachment->save();
                    }
                }

                $previous_status = $ticket->ticket_status_id;
                $old_staff = $ticket->assigned_to;
                $ticket->last_touched_at = Carbon::now()->format('Y-m-d H:i:s');
                // Change ticket status
                if ($user->role == 'staff'){


                    $ticket->ticket_status_id = 5;

                }elseif ($user->role == 'user'){

                    $ticket->ticket_status_id = 7;

                }
                $ticketService->ticketStatusLife($ticket, $previous_status, $old_staff, $ticket->ticket_status_id);
                /*
                set ticket unread.
                */
                $ticket = $ticketService->setTicketUnread($ticket, Auth::user()->role);
                $ticket->save();

                // Send ticket reply added mail to user's Email
                $emailService = new Email();
                if (TicketHelper::isStaffReply($user, $ticket)) {
                    $emailService->ticketReplyAdded($ticket);
                    $emailService->departmentStaffReply($ticket, $user);
                } else {
                    $emailService->departmentUserReply($ticket);
                }
                $emailService->assignedToReplyMail($ticket, $user->email);

                $request->session()->flash('success', __('Reply Added'));
                //TODO: Add language
                return response()->json(['message' => __('Reply Added')], 200);
            } else {
                $request->session()->flash('error', __('Please enter a reply'));
                return response()->json(['error' => __('Please enter a reply')], 400);
            }

        } else {
            /*
            set ticket read.
            */
            $ticketService = new TicketService();
            $ticket = $ticketService->setTicketRead($ticket, Auth::user()->role);
            $ticket->save();
        }
        $user = User::find(auth()->id());
        $show_make_article_link = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',29)->value('is_allowed'):1;


        // Display ticket replies
        $params = [
            'ticket' => $ticket,
            'ticket_reply' => $ticket->replies()->paginate(10),
            'ticket_statuses' => $ticketStatuses,
            'ticket_urgency' => $ticketUrgency,
             'product_name' => $product_name,
             'show_make_article_link' => $show_make_article_link,
             'article'=>$kb_article
        ];

        if ($user->role == 'user'){
            return view('tenant.ticket/user.reply', $params);
        } else {
            return view('tenant.ticket.reply', $params);
        }
    }


    /*
    TODO: We are uisng this methods?
    Or ticket modify too is going to reply function and uisng the action
    modify_ticket ?
     */
    public function modify(Request $request, $uuid)
    {
        // Get logged in user
        $user = auth()->user();
        // Get the ticket
        $ticket = Ticket::find($uuid);
        $kb_article = KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')->where('title', $ticket->title)
         ? KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')->where('title', $ticket->title)->first() :null;
        /*
        service class that interact with the Ticket model.
        */
        $ticketService = new TicketService();
        // Get all the ticket statuses
        $ticketStatuses = TicketStatus::all();
        // get all ticket urgency list
        $ticketUrgency = TicketUrgency::all();
        // Get all of the user departments
        $departments = Department::all();
        // Get all of the tags
        $tags = Tag::all();
        $selected_tags = $ticket->tags()->pluck('uuid')->toArray();

        /*
        service class that interact with the User model.
        */
        $userService = new UserService();
        $department_id = $ticket->department_id;
        // Get staffs
        $staffs = $userService->getDepartmentStaffs($department_id);

        /*
        Check weather the user has access to this function
         */
        if (!$user->can('view', $ticket)) {
            return view('tenant.ticket.no_ticket');
        }
        if ($request->isMethod('POST')) {

            if ($request->action && $request->action == "modify_ticket") {
                $validator = Validator::make($request->all(), [
                            'title' => 'required',
                        ]);
                if ($validator->fails()) {
                    $errors = $validator->errors()->first();
                    return redirect()
                            ->back()
                            ->withInput()
                            ->withErrors($validator);
                }
                $previous_status = $ticket->ticket_status_id;
                $previous_dpt = $ticket->department_id;
                $old_staff = $ticket->assigned_to;
                $ticket->title = $request->title;
                $emailService = new Email();

                if (!empty($request->ticket_urgency_id)){
                    $ticket->ticket_urgency_id = $request->ticket_urgency_id;
                }

                $ticket->ticket_status_id = $request->ticket_status_id;
                $ticket->save();
                if (!empty($request->ticket_status_id)){
                    $ticketService->ticketStatusLife($ticket, $previous_status, $old_staff, $request->ticket_status_id);
                }

                if ($request->assigned_to != $old_staff) {
                   $ticket->assigned_to = $request->assigned_to;
                   $ticket->save();
                   if (!empty($request->assigned_to)){
                    $emailService->assignedToEmail($ticket, $request->assigned_to);
                   }
                }

                if ($request->department_id != $previous_dpt) {
                    $ticket->department_id = $request->department_id;
                    $ticket->save();
                    if (!empty($request->department_id)) {
                        // Sent ticket opened mail to staffs under the ticket department
                        $emailService->departmentEmail($ticket, $request->department_id);
                    }
                }

                // Set ticket unread
                $ticket = $ticketService->modifyTicketUnread($ticket, $request);
                $ticket->save();
                $tagIdArray = explode(",", $request->tag_ids);
                $ticket->tags()->sync($tagIdArray);
                return redirect()
                    ->route('get_tickets')
                    ->with('success', __('Ticket updated'));

            }
        }
        $user = User::find(auth()->id());
        $show_make_article_link = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',29)->value('is_allowed'):1;
        // Display modify ticket page
        $params = [
            'ticket' => $ticket,
            'ticket_statuses' => $ticketStatuses,
            'ticket_urgency' => $ticketUrgency,
            'staffs' => $staffs,
            'tags' => $tags,
            'departments' => $departments,
            'selected_tags' =>  $selected_tags,
            'show_make_article_link' =>  $show_make_article_link,
            'article' => $kb_article
        ];

        if ($user->role == 'user'){
            return view('tenant.ticket/user.modify', $params);
        } else {
            return view('tenant.ticket.modify', $params);
        }
    }

    /*
    Add private notes
    */
    public function note(Request $request, $uuid)
    {
        // Get logged in user
        $user = auth()->user();
        // Get the ticket
        $ticket = Ticket::find($uuid);

        $kb_article = KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')
            ->where('title', $ticket->title)
         ? KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')
            ->where('title', $ticket->title)->first() :null;

        /*
        Check weather the user has access to this function
         */
        if (!$user->can('view', $ticket)) {
            return view('ticket.no_ticket');
        }

        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                    'note' => 'required',
                ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            /*
            Create an object of TicketService,
            TicketService has function to add ticket notes
            */
            $ticketService = new TicketService();
            $ticketService->addTicketNote($user, $ticket, $request->note);
        }
        $user = User::find(auth()->id());
        $show_make_article_link = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',29)->value('is_allowed'):1;


        // Display privte notes
        $params = [
            'ticket' => $ticket,
            'show_make_article_link' => $show_make_article_link,
            'ticket_notes' => $ticket->notes()->paginate(10),
            'article'=>$kb_article
        ];

        if ($user->role == 'user'){
            return view('tenant.ticket/user.note', $params);
        } else {
            return view('tenant.ticket.note', $params);
        }
    }


    public function feedback(Request $request, $uuid)
    {

        // Get logged in user
        $user = auth()->user();
        // Get the ticket
        $ticket = Ticket::find($uuid);
        if ($request->rating) {
          $validator = Validator::make($request->all(), [
                    'feedback_text' => 'required',
                ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $ticket->rating= $request->rating;
            $ticket->feedback_text=  $request->feedback_text;
            $ticket->update();
        }

        $params = [
            'ticket' => $ticket,
            'user' => $user,
            'show_feedback'  => false,

        ];
        if ($user->role == 'user'){
            return view('tenant.ticket/user.feedback', $params);
        }
    }

    public function feedbackEdit( $uuid){
    $user = auth()->user();
    $ticket = Ticket::find($uuid);
    $params = [
        'ticket' => $ticket,
        'show_feedback'  => true,
        'user' => $user,

    ];

        return view('tenant.ticket/user.feedback', $params);
     }
     public function feedbackDelete( $uuid){

        $user = auth()->user();
        $ticket = Ticket::find($uuid);
        $ticket->feedback_text =null;
        $ticket->update();
        $params = [
            'ticket' => $ticket,
            'show_feedback'  => true,
            'user' => $user,

        ];

            return view('tenant.ticket/user.feedback', $params);
         }

             public function articleDelete( $uuid){
                $user = auth()->user();
                $article = KbArticle::find($uuid);
                $article->delete();

                $params = [
                    'ticket' => $ticket,
                    'show_feedback'  => true,
                    'user' => $user,
                ];

                    return view('tenant.ticket.make_article', $params);
                 }
    /*
    Add internal notes
    */
    public function internalNote(Request $request, $uuid)
    {
        /*
        Check weather the user has access to this function
         */
        $this->authorize('isNotUser', Ticket::class);

        // Get the logged in user
        $user = auth()->user();
        // get the Ticket
        $ticket = Ticket::find($uuid);
        $kb_article =KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')->where('title', $ticket->title)
         ? KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')->where('title', $ticket->title)->first() :null;

        /*
        Check weather the user has access to this function
         */
        if (!$user->can('view', $ticket)) {
            return view('ticket.no_ticket');
        }

        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                    'internal_note' => 'required',
                ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            /*
            Create an object of ImapTicketService,
            ImapTicketService has function to add internal ticket notes
            */
            $ticketService = new TicketService();
            $ticketService->addInternalTicketNote($user, $ticket, $request->internal_note);
        }

        $user = User::find(auth()->id());
        $show_make_article_link = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',29)->value('is_allowed'):1;


        // Display internal notes
        $params = [
            'ticket' => $ticket,
            'show_make_article_link' => $show_make_article_link,
            'ticket_notes' => $ticket->internalNotes()->paginate(10),
            'article' =>  $kb_article
        ];

        return view('tenant.ticket.internal_note', $params);
    }

    /*
    Delete ticket
    */
    public function destroy($uuid)
    {
        $ticket = Ticket::find($uuid);
        $ticket->delete();
        return redirect()
            ->back()
            ->with('success', __('Ticket deleted'));
    }

    /*
    Download attachment
    */
    public function download($filename)
    {
        $attachmentHelper = new AttachmentHelper();
        return $attachmentHelper->privateDownload('attachments', $filename);
    }

    /*
    Delete a reply
    */
    public function replyDelete(Request $request, $uuid)
    {
        $reply = TicketReply::find($uuid);
        $ticketId = $reply->ticket_uuid;
        $reply->delete();
        return redirect()->route('ticket.reply', $ticketId)
            ->with('success', __('Reply deleted'));
    }

    /*
    Delete a private note
    */
    public function noteDelete(Request $request, $uuid)
    {
        $note = TicketNote::find($uuid);
        $ticketId = $note->ticket_uuid;
        $note->delete();
        return redirect()->route('ticket.note', $ticketId)
            ->with('success', __('Note deleted'));
    }


    public function makeArticle(Request $request, $uuid)
    {

        $kb_category = KbCategory::all();
        $ticket = Ticket::find($uuid);

        $ticket_reply=TicketReply::where('ticket_uuid', $uuid)->pluck('message');

        $kb_article = KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')->where('title', $ticket->title)
         ? KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')->where('title', $ticket->title)->first() :null;
        if($request->custom){
            // if (!empty($request->ticket_name)) {
            $kb_article = new KbArticle();
            $kb_article->uuid = Uuid::getUuid();
            $kb_article->name =$request->ticket_name;
            $kb_article->category_id = $request->category_id;
            $kb_article->status =1;
            $kb_article->slug =Str::slug($request->post('ticket_name'), '-');
            $kb_article->save();

            foreach($request->custom as $languageId => $data){
                $kb_article_translation = new KbArticleTranslation();
                $kb_article_translation->uuid = Uuid::getUuid();
                $kb_article_translation->language_id = $languageId;
                $kb_article_translation->article_id = $kb_article->uuid;
                $kb_article_translation->title = $data['ticket_title'];
                $kb_article_translation->description = $data['description'];
                $kb_article_translation->save();
            }
        }
        $params = [
            'kb_category' => $kb_category,
            'ticket' => $ticket,
            'ticket_reply' => $ticket_reply,
            'article' =>  $kb_article,
        ];

        return view('tenant.ticket.make_article', $params);
    }

    function makeArticleEdit(Request $request, $uuid,$article_id){
        $kb_category = kbcategory::all();
        $ticket = Ticket::find($uuid);
        $ticket_reply=TicketReply::where('ticket_uuid', $uuid)->pluck('message');

        if(request()->isMethod('post')){
            $kb_article = KbArticle::where('uuid', $article_id)->first();
        }else
        {
        $kb_article_translations = KbArticleTranslation::join('kb_articles','kb_article_translations.article_id','=','kb_articles.uuid')
        ->where('kb_article_translations.uuid',$article_id)
        ->first();
        $kb_article = KbArticle::where('uuid',$kb_article_translations->article_id)->first();
        }

        $kb_article_translation = KbArticleTranslation::where('article_id',$kb_article->uuid)
        ->orderBy('language_id')
        ->with('language')
        ->get();
        if($request->custom){
            $kb_article->name =$request->ticket_name;
            $kb_article->category_id =$request->category_id;
            $kb_article->status =1;
            $kb_article->slug =Str::slug($request->post('ticket_name'), '-');
            $kb_article->update();

            foreach ($request->custom as $languageId => $data) {
                $kb_article_trans = KbArticleTranslation::where('article_id',$kb_article->uuid)
                ->where('language_id',$languageId)
                ->first();
                $kb_article_trans->title = $data['ticket_title'];
                $kb_article_trans->description = $data['description'];
                $kb_article_trans->update();
            }
            }
        $params = [
            'kb_category' => $kb_category,
            'ticket' => $ticket,
            'ticket_reply' => $ticket_reply,
            'article' =>  $kb_article,
            'kb_article_translation' => $kb_article_translation,
        ];
        if($request->custom){
            return view('tenant.ticket.make_article', $params);
        }
            else{

                return view('tenant.ticket.make_article_edit', $params);
            }

    }

    public function feedbacks(Request $request)
    {
        $this->authorize('viewAny', Ticket::class);

        $tickets=Ticket::where('feedback_text','!=','null')->orderBy('updated_at','Desc')->paginate(10);


        $params = [
            'tickets' => $tickets,
            'request' => $request,

        ];

        return view('tenant.feedback.index', $params);
    }

     /*
    Delete an internal note
    */
    public function internalNoteDelete(Request $request, $uuid)
    {
        /*
        Check weather the user has access to this function
         */
        $this->authorize('isNotUser', Ticket::class);

        $note = TicketInternalNote::find($uuid);
        $ticketId = $note->ticket_uuid;
        $note->delete();
        return redirect()->route('ticket.internal_note', $ticketId)
            ->with('success', __('Note deleted'));
    }


}
