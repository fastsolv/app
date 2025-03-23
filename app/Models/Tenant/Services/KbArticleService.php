<?php

namespace App\Models\Tenant\Services;

use App\Models\Tenant\KbArticle;
use Illuminate\Support\Str;
use App\Helpers\Uuid;
use App\Models\Tenant\KbArticleTranslation;

class KbArticleService
{
    public function addKb($request)
    {
        $kb_article = new  KbArticle();
        $kb_article->uuid = Uuid::getUuid();
        $kb_article->category_id = $request->category_id;
        $kb_article->name = $request->name;
        $kb_article->status = $request->status;
        $kb_article->slug = Str::slug($request->post('name'), '-');
        $kb_article->save();
        
        
        foreach($request->custom as $languageId => $data){
            $kb_article_translation = new KbArticleTranslation();
            $kb_article_translation->uuid = Uuid::getUuid();
            $kb_article_translation->language_id = $languageId;
            $kb_article_translation->article_id = $kb_article->uuid;
            $kb_article_translation->title = $data['title'];
            $kb_article_translation->description = $data['description'];
            $kb_article_translation->page_title = $data['page_title'];
            $kb_article_translation->meta_description = $data['meta_description'];
            $kb_article_translation->meta_keyword = $data['meta_keyword'];
            $kb_article_translation->save();
        }
    }

    public function updateKb($request, $kb_article)
    {
        $updateArray = [];
        $updateArray['category_id'] = $request->category_id;
        $updateArray['name'] = $request->name;
        $updateArray['status'] = $request->status;
        $updateArray['slug'] = Str::slug($request->post('name'), '-');
        $kb_article->update($updateArray); 

    }
}