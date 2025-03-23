<?php

namespace App\Models\Tenant\Services;

use App\Models\Tenant\Faq;
use App\Models\Tenant\FaqCategory;
use App\Helpers\Uuid;
use Illuminate\Support\Str;

class FaqService
{
    public function addFaq( $request)
    { 
      $faq = new  Faq();
      $faq->uuid = Uuid::getUuid();
      $faq->category_id = $request->category_id;
      $faq->name = $request->name;
      $faq->save();

      
      return $faq;
    }
}