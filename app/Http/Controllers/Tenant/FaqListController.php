<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Tenant\Faq;
use App\Models\Tenant\FaqCategory;
use App\Helpers\Uuid;
use App\Models\Tenant\Services\DefaultLanguageService;
use DB; 
class FaqListController extends Controller
{
    public function index()
    {
        $defaultlanguage = new DefaultLanguageService();
        $language = $defaultlanguage->getArticleLanguageId();
      
        $faq_categories = FaqCategory::join('faq_category_translations', 'faq_categories.uuid', '=', 'faq_category_translations.category_id')
            ->where('language_id',$language)
            ->select('faq_categories.uuid','faq_category_translations.category_text')
            ->get();
        $faqs = [];     
        foreach( $faq_categories as $faq_category ){
            $faqs[$faq_category->uuid] = Faq::join('faq_translations', 'faqs.uuid', '=', 'faq_translations.faq_id')
                ->where('category_id', $faq_category->uuid)
                ->where('language_id',$language)
                ->get();
        }
        $params = [
            'faqs' => $faqs,
            'faq_categories' => $faq_categories
        ];
        return view('tenant.faq.show', $params);
    }
}