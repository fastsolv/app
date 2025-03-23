<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Models\Tenant\FaqCategory;
use App\Helpers\Uuid;
use App\Helpers\Logger;
use App\Models\Tenant\FaqCategoryTranslation;
use App\Models\Tenant\Language;
use App\Models\Tenant\RolePermission;
use App\Models\Tenant\Services\FaqCategoryService;
use App\Models\Tenant\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class FaqCategoryController extends Controller
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
        $this->authorize('view', FaqCategory::class);
        $user = User::find(auth()->id());
        $show_add_button = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',41)->value('is_allowed'):1;
        $show_edit_button = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',42)->value('is_allowed'):1;
        $show_delete_button = $user->user_type !=='admin'?RolePermission::where('role_id', $user->role_id)->where('permission_id',43)->value('is_allowed'):1;
 

        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $faqCategories = FaqCategory::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $faqCategories = FaqCategory::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {

            $faqCategories = FaqCategory::paginate( 10 );
            $sort_order = 'decs';
        }
  

        $params = [
            'faqCategories' => $faqCategories,
            'request' => $request,
            'sort_order' => $sort_order,
            'show_add_button' => $show_add_button,
            'show_edit_button' => $show_edit_button,
            'show_delete_button' => $show_delete_button
        ];
        return view('tenant.faq_category.index', $params);
    }

    /**
     * Show the form for creating a new resource.

     */
    public function create()
    { 
        $this->authorize('create', FaqCategory::class);
        $languages = Language::all();
        $params = [
            'language'=>$languages
        ];
        return view('tenant.faq_category.create',$params);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', FaqCategory::class);
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required | unique:App\Models\Tenant\FaqCategory,name',
                'custom.*' => 'required',
                

            ]);
            $faqCategoryService = new FaqCategoryService();
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            $faq_category= $faqCategoryService->addFaq( $request);
            
            foreach ($request->custom as $language_id => $category) {
                $faq_category_t = new FaqCategoryTranslation();
                $faq_category_t->uuid = Uuid::getUuid();
                $faq_category_t->category_id = $faq_category->uuid;
                $faq_category_t->category_text = $category;
                $faq_category_t->language_id = $language_id;
                $faq_category_t->save();
            }
            
            
            return redirect()->route('get_faq_category')
                ->with('success', __('FAQ category added'));
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
        $this->authorize('update', FaqCategory::class);
        $faq_category = FaqCategory::find($uuid);
        $faq_category_translation = FaqCategoryTranslation::where('category_id', $faq_category->uuid)
            ->with('language')
            ->get();
        $params = [
            'uuid'=>$uuid,
            'faq_category'=>$faq_category,
            'faq_category_translation'=>$faq_category_translation
        ];
        return view('tenant.faq_category.edit',$params); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $this->authorize('update', FaqCategory::class);
        try {
            $faq_category = FaqCategory::find($uuid);
            $faq_category_translation = FaqCategoryTranslation::where('category_id', $faq_category->uuid)
                 ->get();
            $validator = Validator::make($request->all(), [
                'name' => 'required | unique:App\Models\Tenant\FaqCategory,name,'.$faq_category->uuid,
                   
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            // Update the category_text column for each FaqCategoryTranslation record
        foreach ($faq_category_translation as $faq_cat_trans) {
            $language_id = $faq_cat_trans->language_id;
            $faq_cat_trans->category_text = $request->custom[$language_id];
            $faq_cat_trans->update();
        }

            $faq_category->update($request->all());
            return redirect()->route('get_faq_category')
                ->with('success', __('FAQ category updated'));

        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    public function destroy(Request $request, $uuid)
    {
        $this->authorize('delete', FaqCategory::class);
        $faq_category = FaqCategory::find($uuid);
        $faq_category->delete();
        return redirect()->route('get_faq_category')
            ->with('success', __('FAQ category deleted'));
    }
}
