<?php

namespace App\Models\Tenant\Services;

use App\Helpers\AttachmentHelper;

use App\Helpers\Uuid;
use App\Models\Tenant\Announcement;

class AnnouncementService
{
    public function addAnnouncement($request)
    {
        $announcement=new  Announcement();
        $announcement->uuid = Uuid::getUuid();
        $announcement->title = $request->title;
        $announcement->announcement = $request->announcement;
        $announcement->is_published = $request->is_published;
        $announcement->language_code =$request->language_code;
        $announcement->save();
    }
}