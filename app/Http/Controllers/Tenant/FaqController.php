<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Models\Tenant\Faq;
use App\Models\Tenant\FaqCategory;
use App\Helpers\Uuid;
use Illuminate\Support\Str;
use App\Helpers\Logger;
use App\Models\Tenant\FaqTranslation;
use App\Models\Tenant\Language;
use App\Models\Tenant\RolePermission;
use App\Models\Tenant\Services\FaqService;
use App\Models\Tenant\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function __construct()
    {
        /*
        make sure only logged in and verified user has access
        to this controller
         */
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $this->authorize('view', Faq::class);
        $user = User::find(auth()->id());
        $show_add_button = $user->user_type !=='admin'? RolePermission::where('role_id', $user->role_id)->where('permission_id',38)->value('is_allowed'):1;
        $show_edit_button = $user->user_type !=='admin'? RolePermission::where('role_id', $user->role_id)->where('permission_id',39)->value('is_allowed'):1;
        $show_delete_button = $user->user_type !=='admin'? RolePermission::where('role_id', $user->role_id)->where('permission_id',40)->value('is_allowed'):1;

        if ( $request->name ) {
            if ( $request->order == 'desc' ) {
                $faqs = Faq::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';
            } else {
                $faqs = Faq::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';
            }
        } else {
            $faqs = Faq::paginate( 10 );
            $sort_order = 'decs';
        }

        // dd($faqs);

        $params = [
            'faqs' => $faqs,
            'request' => $request,
            'sort_order' => $sort_order,
            'show_add_button' => $show_add_button,
            'show_edit_button' => $show_edit_button,
            'show_delete_button' => $show_delete_button
        ];
        return view('tenant.faq.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Faq::class);
        $faq = Faq::all();
        $categories = FaqCategory::all();
        $languages = Language::all();
        $params = [
            'categories' => $categories,
            'faq' => $faq,
            'languages'=>$languages,
        ];
        return view('tenant.faq.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Faq::class);
        try {

            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
                'custom.*.question' => 'required|max:200',
                'custom.*.answer' => 'required'
            ]);
            $faqService = new FaqService();
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            $faq = $faqService->addFaq( $request );
            foreach ($request->custom as $languageId => $data) {
                $faq_translation = new FaqTranslation();
                $faq_translation->uuid = Uuid::getUuid();
                $faq_translation->faq_id = $faq->uuid;
                $faq_translation->language_id = $languageId;
                $faq_translation->question = $data['question'];
                $faq_translation->answer = $data['answer'];
                $faq_translation->save();
            }

                return redirect()->route('get_faqs')
                ->with('success', __('FAQ added'));
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
            ->back()
            ->withInput()
            ->with('error', __('Something went wrong'));
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $uuid)
    {
        $this->authorize('update', Faq::class);
        $faq = Faq::find($uuid);
        $faq_translation = FaqTranslation::where('faq_id',$faq->uuid)
            ->orderby('language_id')
            ->with('language')
            ->get();
        $categories = FaqCategory::all();
        $params = [
            'faq'=>$faq,
            'faq_translation'=>$faq_translation,
            'categories'=>$categories
        ];
        return view('tenant.faq.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $this->authorize('update', Faq::class);
        try {
            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
                'custom.*.question' => 'required|max:200',
                'custom.*.answer' => 'required'

            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $faq = Faq::find($uuid);
            $faq->name = $request->name;
            $categories = FaqCategory::all();

            foreach ($request->custom as $languageId => $data) {
            $faqTranslation = FaqTranslation::where('faq_id', $faq->uuid)
                ->where('language_id', $languageId)
                ->first();
            if (!$faqTranslation) {
                $faqTranslation = new FaqTranslation();
                $faqTranslation->faq_id = $faq->uuid;
                $faqTranslation->language_id = $languageId;
            }
            $faqTranslation->question = $data['question'];
            $faqTranslation->answer = $data['answer'];
            $faqTranslation->update();
            }


            $faq->update($request->all());
            return redirect()->route('get_faqs')
                ->with('success', __('FAQ updated'));

        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $uuid)
    {
        $this->authorize('delete', Faq::class);
        $faq = Faq::find($uuid);
        $faq->delete();
        return redirect()->route('get_faqs')
            ->with('success', __('FAQ deleted'));
    }
}
