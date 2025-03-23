<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use Auth;

use Illuminate\Http\Request;
use App\Models\Tenant\KbCategory;
use App\Models\Tenant\KbArticle;
use App\Helpers\Uuid;
use App\Helpers\Logger;
use App\Models\Tenant\KbArticleTranslation;
use App\Models\Tenant\Language;
use App\Models\Tenant\RolePermission;
use App\Models\Tenant\Services\KbArticleService;
use App\Models\Tenant\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class KbArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize("view", KbArticle::class);
        $user = User::find(auth()->id());
        $show_add_button =
            $user->user_type !== "admin"
                ? RolePermission::where("role_id", $user->role_id)
                    ->where("permission_id", 29)
                    ->value("is_allowed")
                : 1;
        $show_edit_button =
            $user->user_type !== "admin"
                ? RolePermission::where("role_id", $user->role_id)
                    ->where("permission_id", 33)
                    ->value("is_allowed")
                : 1;
        $show_delete_button =
            $user->user_type !== "admin"
                ? RolePermission::where("role_id", $user->role_id)
                    ->where("permission_id", 34)
                    ->value("is_allowed")
                : 1;
        $sort_order = "decs";

        if ($request->name == "category_id") {
            if ($request->order == "desc") {
                $query = KbArticle::query();

                $kb_articles = $query
                    ->whereHas("categories", function ($q) use ($request) {
                        $q->orderBy("name", "desc");
                    })
                    ->paginate(10);

                $sort_order = "asc";
            } else {
                $query = KbArticle::query();

                $kb_articles = $query
                    ->whereHas("categories", function ($q) use ($request) {
                        $q->orderBy("name", "asc");
                    })
                    ->paginate(10);
                $sort_order = "desc";
            }
        } else {
            if ($request->name) {
                if ($request->order == "desc") {
                    $kb_articles = KbArticle::orderBy(
                        $request->name,
                        "desc"
                    )->paginate(10);
                    $sort_order = "asc";
                } else {
                    $kb_articles = KbArticle::orderBy(
                        $request->name,
                        "asc"
                    )->paginate(10);
                    $sort_order = "desc";
                }
            } else {
                $kb_articles = KbArticle::orderBy(
                    "created_at",
                    "desc"
                )->paginate(10);
            }
        }
        $query = KbArticle::query()->with("categories");
        $kb_articles = KbArticle::orderBy("created_at", "desc")->paginate(10);

        $params = [
            "kb_articles" => $kb_articles,
            "request" => $request,
            "sort_order" => $sort_order,
            "show_add_button" => $show_add_button,
            "show_edit_button" => $show_edit_button,
            "show_delete_button" => $show_delete_button,
        ];

        return view("tenant.kb_article.index", $params);
    }

    public function create()
    {
        // $this->authorize('isNotUser', KbArticle::class);
        $this->authorize("create", KbArticle::class);
        $kb_articles = KbArticle::all();
        $categories = KbCategory::all();
        $languages = Language::all();
        $params = [
            "categories" => $categories,
            "kb_articles" => $kb_articles,
            "languages" => $languages,
        ];
        return view("tenant.kb_article.create", $params);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create", KbArticle::class);
        try {
            $validator = Validator::make($request->all(), [
                "category_id" => "required",
                "name" => "required | unique:App\Models\Tenant\KbArticle,name",
                "custom.*.title" => "required | max:100 ",
                "status" => "required",
                "custom.*.description" => "required",
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            $kbArticleService = new KbArticleService();
            $kbArticleService = $kbArticleService->addKb($request);
            
            return redirect()
                ->route("get_kb_article")
                ->with("success", __("KB Article added"));
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with("error", __("Something went wrong"));
        }
    }

    public function edit(Request $request, $uuid)
    {
        $this->authorize("update", KbArticle::class);

        $kb_article = KbArticle::find($uuid);
        $categories = KbCategory::all();
        $kb_article_translation = KbArticleTranslation::where(
            "article_id",
            $kb_article->uuid
        )
            ->orderBy("language_id")
            ->with("language")
            ->get();

        $params = [
            "kb_article" => $kb_article,
            "categories" => $categories,
            "kb_article_translation" => $kb_article_translation,
        ];
        return view("tenant.kb_article.edit", $params);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $this->authorize("update", KbArticle::class);

        try {
            $kb_article = KbArticle::find($uuid);
            $validator = Validator::make($request->all(), [
                "category_id" => "required",
                "name" =>
                    "required | unique:App\Models\Tenant\KbArticle,name," .
                    $kb_article->uuid,
                "custom.*.title" => "required | max:100",
                "status" => "required",
                "custom.*.description" => "required",
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $kbArticleService = new KbArticleService();
            $kbArticleService = $kbArticleService->updateKb(
                $request,
                $kb_article
            );

            foreach ($request->custom as $languageId => $data) {
                $kb_article_trans = KbArticleTranslation::where(
                    "article_id",
                    $kb_article->uuid
                )
                    ->where("language_id", $languageId)
                    ->first();
                $kb_article_trans->title = $data["title"];
                $kb_article_trans->description = $data["description"];
                $kb_article_trans->page_title = $data["page_title"];
                $kb_article_trans->meta_description = $data["meta_description"];
                $kb_article_trans->meta_keyword = $data["meta_keyword"];
                $kb_article_trans->update();
            }
            return redirect()
                ->route("get_kb_article")
                ->with("success", __("Article updated"));
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
        $this->authorize("delete", KbArticle::class);
        $kb_article = KbArticle::find($uuid);
        $kb_article->delete();
        return redirect()
            ->route("get_kb_article")
            ->with("success", __("Article deleted"));
    }
}
