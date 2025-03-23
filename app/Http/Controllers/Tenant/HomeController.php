<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use App\Models\Tenant\KbArticle;
use App\Models\Tenant\Services\DefaultLanguageService;
use Illuminate\Http\Request;

/*
TODO: are we using this controller ?
 */

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $defaultlanguage = new DefaultLanguageService();
        $language = $defaultlanguage->getArticleLanguageId();
        $isArticles =null;
        if($request->article){
         
		$articles = KbArticle::join('kb_article_translations','kb_articles.uuid','=','kb_article_translations.article_id')
              	->where('language_id', $language)
                ->where('title', 'like', '%' . $request->article. '%')
                ->orWhere('page_title', 'like', '%' . $request->article. '%')
                ->orWhere('meta_description', 'like', '%' . $request->article. '%')
                ->orWhere('meta_keyword', 'like', '%' . $request->article. '%')
                ->orWhere('description', 'like', '%' . $request->article. '%')->get();
                $isArticles = count($articles) ? 1:0;
              
        } else {
            $articles=[];    
        }
        return view('tenant.home_page.index', compact('articles','isArticles'));
    }

}
