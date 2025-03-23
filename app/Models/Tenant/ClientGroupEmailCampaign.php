<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientGroupEmailCampaign extends Model
{
    protected $primaryKey = 'uuid';
    public $incrementing = false;

    use HasFactory;

    protected $fillable = ['template_id', 'client_group_id', 'department_id', 'send_at', 'status'];

    public function emailTemplates()
    {
        return $this->belongsTo(EmailTemplate::class, 'template_id');
    }

    public function clientGroups()
    {
        return $this->belongsTo(ClientGroup::class, 'client_group_id');
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

}
