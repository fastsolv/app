<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplateTranslation extends Model
{

    protected $primaryKey = 'uuid';
    use HasFactory;
    protected $fillable = ['subject','message','language_id'];

    public function language(){
        return $this->belongsTo(Language::class);
    }
}
