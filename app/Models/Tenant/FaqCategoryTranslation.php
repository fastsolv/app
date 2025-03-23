<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategoryTranslation extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;

    protected $fillable = ['language_id' , 'language_id' , 'uuid','category_text','created_at','updated_at'];
    
    use HasFactory;

public function category()
    {
    return $this->belongsTo(FaqCategory::class, 'category_id');
    }

public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
