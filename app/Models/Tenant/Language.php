<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    
    public function faqCategoryTranslations()
    {
        return $this->hasMany(FaqCategoryTranslation::class);
    }


    public function faqTranslations()
    {
        return $this->hasMany(FaqTranslation::class);
    }

    public function kbCategoryTranslations()
    {
        return $this->hasMany(KbCategoryTranslation::class);
    }

    public function kbArticleTranslation(){
        return $this->hasMany(KbArticleTranslation::class);
    }
    public function emailTemplateTranslation(){
        return $this->hasMany(EmailTemplateTranslation::class);
    }
    public function setting(){
        return $this->hasOne(Setting::class);
    }
}
