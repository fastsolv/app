<?php

namespace App\Models\Tenant\Services;

use App\Models\Tenant\KbCategory;
use App\Helpers\AttachmentHelper;

use App\Helpers\Uuid;
use App\Models\Tenant\KbCategoryTranslation;

class KbCategoryService
{
    public function addCategory($request)
    {
        $kb_category=new  KbCategory();
        $kb_category->uuid = Uuid::getUuid();
        $kb_category->name = $request->name;
        $kb_category->icon = $request->icon;
        // $kb_category->description = $request->description;
        $kb_category->save();

        foreach ($request->custom as $languageId => $data) {
            $kb_category_trans = new KbCategoryTranslation();
            $kb_category_trans->uuid = Uuid::getUuid();
            $kb_category_trans->category_id = $kb_category->uuid;
            $kb_category_trans->language_id = $languageId;
            $kb_category_trans->category_text = $data['category'];
            $kb_category_trans->description = $data['description'];
            $kb_category_trans->save();
        }
       

    }
}