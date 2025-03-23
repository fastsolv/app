<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KbCategoryTranslation extends Model
{
    protected $primaryKey = 'uuid';
    protected $fillable = ['category_text','description'];
    use HasFactory;

    public function language(){
       return $this->belongsTo(Language::class);
    }

    public function kbCategory(){
        return $this->belongsTo(KbCategory::class);
    }
}
