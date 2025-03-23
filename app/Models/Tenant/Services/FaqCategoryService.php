<?php

namespace App\Models\Tenant\Services;

use App\Models\Tenant\FaqCategory;

use App\Helpers\Uuid;
use Carbon\Carbon;

class FaqCategoryService
{
    public function addFaq($request)
    {
        $faq_category = new FaqCategory();
        $faq_category->uuid = Uuid::getUuid();
        $faq_category->name = $request->name;
        $faq_category->created_at = Carbon::now()->format("Y-m-d H:i:s");
        $faq_category->save();
    
        return $faq_category;
       
    }
}