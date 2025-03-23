<?php

namespace App\Models\Tenant\Services;

use App\Helpers\AttachmentHelper;

use App\Helpers\Uuid;
use App\Models\Tenant\Language;
use App\Models\Tenant\Setting;

class DefaultLanguageService
{

    public function getArticleLanguageId()
{
    $language = null;    
    if (session()->has('locale')) {
        $language = session()->get('locale');

        $currentLocaleCode = session()->get('locale');
        $currentLocale = Language::where('code', $currentLocaleCode)->first();
        $currentLocaleId = $currentLocale->id;
        $language = $currentLocaleId;
    }
    if (empty($language)) {
        $defaultLanguage = Setting::where('name', 'default_language')
            ->where('type', 'language')
            ->value('value');
        if (!empty($defaultLanguage)) {
            $language = $defaultLanguage;
        }
        else{
            $languageId = Language::where('id',1)
            ->value('id');
            if (!empty($languageId)) {
                $language = $languageId;
            }
        }
    }
    return $language;
}


}