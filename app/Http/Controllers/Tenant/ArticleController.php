<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Tenant\KbCategory;
use App\Models\Tenant\KbArticle;
use App\Helpers\Uuid;
use App\Models\Tenant\Services\DefaultLanguageService;
use DB;

class ArticleController extends Controller
{
  
  
    public function index()
    {
        $defaultlanguage = new DefaultLanguageService();
        $language = $defaultlanguage->getArticleLanguageId();

        $categories = KbCategory::join('kb_category_translations','kb_categories.uuid','=','kb_category_translations.category_id')
            ->where('language_id',$language)
            ->select('kb_categories.uuid','kb_categories.name','kb_category_translations.category_text')
            ->get();
        $category_article =[];
        foreach  ($categories as $category){

            $category_article[$category->uuid] = KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')
                ->where('language_id',$language)
                ->where('category_id',$category->uuid)
                ->get();
        }

        $params = [
            'categories' => $categories,
            'category_article' => $category_article,
            
       ];

        return view('tenant.article.index' , $params);
      
    }

   public function show($uuid)
    {

        $defaultlanguage = new DefaultLanguageService();
        $language = $defaultlanguage->getArticleLanguageId();

        $categories = KbCategory::join('kb_category_translations','kb_categories.uuid','=','kb_category_translations.category_id')
            ->where('language_id',$language)
            ->where('kb_categories.uuid',$uuid)
            ->first();
        $articles = KbArticle::join('kb_article_translations', 'kb_articles.uuid', '=', 'kb_article_translations.article_id')
            ->select('kb_articles.*','kb_article_translations.*')
            ->where('language_id',$language)
            ->where('kb_articles.category_id', $uuid)
            ->get();
        $params = [
            'categories' => $categories,
            'articles' => $articles,
        ];
        return view('tenant.article.show' , $params);
    }

    public function showArticle($slug)
    {
        $defaultlanguage = new DefaultLanguageService();
        $language = $defaultlanguage->getArticleLanguageId();

        $article = KbArticle::join('kb_article_translations', 'kb_articles.uuid', '=', 'kb_article_translations.article_id')
        ->where('language_id',$language)
        ->where('kb_articles.slug', $slug)
        ->first();
       
        $article_titles = KbArticle::join('kb_article_translations', 'kb_articles.uuid', '=', 'kb_article_translations.article_id')
        ->select('kb_articles.*','kb_article_translations.*')
        ->where('language_id',$language)
        ->where('kb_articles.category_id', $article->category_id)
        ->get();

        $categories = KbCategory::join('kb_category_translations', 'kb_categories.uuid', '=', 'kb_category_translations.category_id')
        ->select('kb_categories.uuid', 'kb_categories.name')
        ->get();

        $params = [
            'articles' => $article,
            'categories' => $categories,
            'article_titles' => $article_titles
       ];
        return view('tenant.article.view_article', $params);
    }
}