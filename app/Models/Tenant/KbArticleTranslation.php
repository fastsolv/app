<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KbArticleTranslation extends Model
{
    protected $primaryKey = 'uuid';

    protected $fillable = ['description','page_title','meta_description', 'meta_keyword','title'];
    use HasFactory;

    public function kbArticle(){
        return $this->belongsTo(KbArticle::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }
}

