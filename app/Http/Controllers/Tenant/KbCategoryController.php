<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use Auth;

use Illuminate\Http\Request;
use App\Models\Tenant\KbCategory;
use App\Helpers\Uuid;
use App\Helpers\Logger;
use App\Models\Tenant\Services\KbCategoryService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use App\Helpers\AttachmentHelper;
use App\Models\Tenant\KbCategoryTranslation;
use App\Models\Tenant\Language;
use App\Models\Tenant\RolePermission;
use App\Models\Tenant\User;

class KbCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize("view", KbCategory::class);
        $user = User::find(auth()->id());
        $show_add_button =
            $user->user_type !== "admin"
                ? RolePermission::where("role_id", $user->role_id)
                    ->where("permission_id", 35)
                    ->value("is_allowed")
                : 1;
        $show_edit_button =
            $user->user_type !== "admin"
                ? RolePermission::where("role_id", $user->role_id)
                    ->where("permission_id", 36)
                    ->value("is_allowed")
                : 1;
        $show_delete_button =
            $user->user_type !== "admin"
                ? RolePermission::where("role_id", $user->role_id)
                    ->where("permission_id", 37)
                    ->value("is_allowed")
                : 1;

        if ($request->name) {
            if ($request->order == "desc") {
                $kb_categories = KbCategory::orderBy(
                    $request->name,
                    "desc"
                )->paginate(10);
                $sort_order = "asc";
            } else {
                $kb_categories = KbCategory::orderBy(
                    $request->name,
                    "asc"
                )->paginate(10);
                $sort_order = "desc";
            }
        } else {
            $kb_categories = KbCategory::paginate(10);
            $sort_order = "decs";
        }

        $params = [
            "kb_categories" => $kb_categories,
            "request" => $request,
            "sort_order" => $sort_order,
            "show_add_button" => $show_add_button,
            "show_edit_button" => $show_edit_button,
            "show_delete_button" => $show_delete_button,
        ];
        return view("tenant.kb_category.index", $params);
    }

    public function create()
    {
        $this->authorize("create", KbArticle::class);
        $languages = Language::all();
        $params = [
            "languages" => $languages,
        ];
        return view("tenant.kb_category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create", KbArticle::class);
        try {
            $kb_category = KbCategory::all();
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:App\Models\Tenant\KbCategory,name|max:15",
                "custom.*.description" => "required",
                "custom.*.category" => "required",
                "icon" => "required",
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            $kbCategoryService = new KbCategoryService();
            $kbCategoryService->addCategory($request);

            return redirect()
                ->route("get_kb_category")
                ->with("success", __("KB Category added"));
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with("error", __("Something went wrong"));
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $uuid)
    {
        $this->authorize("update", KbCategory::class);
        $kb_category = KbCategory::find($uuid);
        $kb_category_translation = KbCategoryTranslation::where(
            "category_id",
            $kb_category->uuid
        )
            ->orderby("language_id")
            ->with("language")
            ->get();

        $params = [
            "uuid" => $uuid,
            "kb_category" => $kb_category,
            "kb_category_translation" => $kb_category_translation,
        ];

        return view("tenant.kb_category.edit", $params);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $this->authorize("update", KbCategory::class);
        try {
            $kb_category = KbCategory::find($uuid);
            $kb_category_translation = KbCategoryTranslation::where(
                "category_id",
                $kb_category->uuid
            )->get();
            $validator = Validator::make($request->all(), [
                "name" =>
                    "required | max:15 | unique:App\Models\Tenant\KbCategory,name," .
                    $kb_category->uuid,
                "custom.*.description" => "required",
                "custom.*.category" => "required",
                "icon" => "required",
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            $updateArray = [];

            $updateArray["icon"] = $request->icon;
            $updateArray["name"] = $request->name;
            // $updateArray['description'] = $request->description;
            $kb_category->update($updateArray);

            foreach ($request->custom as $languageId => $data) {
                $kb_cat_trans = KbCategoryTranslation::where(
                    "category_id",
                    $kb_category->uuid
                )
                    ->where("language_id", $languageId)
                    ->first();
                $kb_cat_trans->category_text = $data["category"];
                $kb_cat_trans->description = $data["description"];
                $kb_cat_trans->update();
            }
            return redirect()
                ->route("get_kb_category")
                ->with("success", __("KB category updated"));
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with("error", __("Something went wrong"));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $uuid)
    {
        $this->authorize("delete", KbCategory::class);
        $kb_category = KbCategory::find($uuid);
        $kb_category->delete();
        return redirect()
            ->route("get_kb_category")
            ->with("success", __("KB category deleted"));
    }
}
