<?php

namespace App\Models\Tenant\Services;
use App\Models\Tenant\EmailTemplate;

use App\Helpers\Uuid;
use App\Models\Tenant\EmailTemplateTranslation;

class EmailTemplateService
{
    public function addEmailTemplate($request)
    {
        $email = new EmailTemplate();
        $email->uuid = Uuid::getUuid();
        $email->name = $request->name;
        $email->status = $request->status;
        $email->save();

        foreach($request->custom as $languageId=>$data){
            $email_trans = new EmailTemplateTranslation();
            $email_trans->uuid = Uuid::getUuid();
            $email_trans->email_template_id = $email->uuid;
            $email_trans->language_id = $languageId;
            $email_trans->subject = $data['subject'];
            $email_trans->message = $data['message'];
            $email_trans->save();
        }
    }
}