<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomListEmailCampaign extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;

    use HasFactory;
    protected $fillable = ['template_id', 'custom_user_list', 'department_id', 'send_at', 'status'];

    public function emailTemplates()
    {
        return $this->belongsTo(EmailTemplate::class, 'template_id');
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    
}
