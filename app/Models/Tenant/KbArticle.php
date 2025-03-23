<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KbArticle extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    use HasFactory;
    protected $fillable = ['category_id','name','status','slug'];

    public function categories()
    {
        return $this->belongsTo(KbCategory::class, 'category_id');
    }

    public function kbArticletranslation(){
        return $this->hasMany(KbArticleTranslation::class);
    }
}
