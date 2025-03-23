<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    protected $primaryKey = 'uuid';
    use HasFactory;

    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }


    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
