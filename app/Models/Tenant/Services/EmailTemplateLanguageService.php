<?php

namespace App\Models\Tenant\Services;

use App\Models\Tenant\Language;
use App\Models\Tenant\Setting;

class EmailTemplateLanguageService{

    public function getEmailTemplateLanguageId($languageId = null){
        if(!empty($languageId)) {
            return $languageId;
        }

        if (empty($languageId)) {
            $defaultLanguageId = (int) Setting::where('name', 'default_language')
                ->where('type', 'language')
                ->value('value');
            if (!empty($defaultLanguageId)) {
                return $defaultLanguageId;
            }
        }

        $language = Language::first();
        if (!empty($language)) {
            return $language->id;
        }

    }
}
