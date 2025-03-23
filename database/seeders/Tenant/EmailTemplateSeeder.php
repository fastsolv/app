<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Helpers\Uuid;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email_template_id = Uuid::getUuid();
        $mail_ticket = Uuid::getUuid();
        $ticket_reply = Uuid::getUuid();
        $ticket_opened_department_id= Uuid::getUuid();
        $ticket_assigned_id = Uuid::getUuid();
        $assigned_to_reply_mail_id = Uuid::getUuid();
        $department_staff_reply_mail_id = Uuid::getUuid();
        $department_user_reply_mail_id = Uuid::getUuid();


        DB::table('email_templates')->insert([
            [
                'uuid' => $email_template_id,
                'name' => 'mail_ticket_opened',
                'status' => true,
                'system_template' => true,
                'merge_fields' => '{$ticket_id}, {$user_name}, {$app_url}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => $mail_ticket,
                'name' => 'ticket_opened',
                'status' => true,
                'system_template' => true,
                'merge_fields' => '{$ticket_id}, {$user_name}, {$app_url}, {$subject}, {$department}, {$ticket_url}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' =>$ticket_reply,
                'name' => 'ticket_reply',
                'status' => true,
                'system_template' => true,
                'merge_fields' => '{$ticket_id}, {$user_name}, {$app_url}, {$subject}, {$department}, {$ticket_url}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [

                'uuid' => $ticket_opened_department_id,
                'name' => 'ticket_opened_department',
                'status' => true,
                'system_template' => true,
                'merge_fields' => '{$ticket_id}, {$user_name}, {$app_url}, {$department}, {$subject}, {$ticket_url}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [

                'uuid' => $ticket_assigned_id,
                'name' => 'ticket_assigned',
                'status' => true,
                'system_template' => true,
                'merge_fields' => '{$ticket_id}, {$user_name}, {$app_url}, {$subject}, {$department}, {$ticket_url}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => $assigned_to_reply_mail_id,
                'name' => 'assigned_to_reply_mail',
                'status' => true,
                'system_template' => true,
                'merge_fields' => '{$ticket_id}, {$user_name}, {$app_url}, {$subject}, {$department}, {$ticket_url}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => $department_staff_reply_mail_id,
                'name' => 'department_staff_reply_mail',
                'status' => true,
                'system_template' => true,
                'merge_fields' => '{$ticket_id}, {$user_name}, {$app_url}, {$subject}, {$department}, {$ticket_url}, {$staff_name}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [

                'uuid' => $department_user_reply_mail_id,
                'name' => 'department_user_reply_mail',
                'status' => true,
                'system_template' => true,
                'merge_fields' => '{$ticket_id}, {$user_name}, {$app_url}, {$subject}, {$department}, {$ticket_url}',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);


        DB::table('email_template_translations')->insert([
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $email_template_id,
                'subject' => 'Hello',
                'message' => '<p>Hello {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $email_template_id,
                'subject' => 'Hello',
                'message' => '<p>Hello {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $email_template_id,
                'subject' => 'Hello',
                'message' => '<p>Hello {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
             [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $email_template_id,
                'subject' => 'Hello',
                'message' => '<p>Hello {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $mail_ticket,
                'subject' => 'after noon english',
                'message' => '<p>aferrtnoon {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You english</span></span></p><p><br></p>',
                'language_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $mail_ticket,
                'subject' => 'after noon espanul',
                'message' => '<p>aferrtnoon {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You espanul</span></span></p><p><br></p>',
                'language_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $mail_ticket,
                'subject' => 'after noon french',
                'message' => '<p>aferrtnoon {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You french</span></span></p><p><br></p>',
                'language_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
             [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $mail_ticket,
                'subject' => 'after noon deutch',
                'message' => '<p>aferrtnoon {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You deutch</span></span></p><p><br></p>',
                'language_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_reply,
                'subject' => 'email',
                'message' => '<p>email {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_reply,
                'subject' => 'email',
                'message' => '<p>email {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_reply,
                'subject' => 'email',
                'message' => '<p>email {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_reply,
                'subject' => 'email',
                'message' => '<p>email {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],


             [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_opened_department_id,
                'subject' => 'unknown',
                'message' => '<p>unknown {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_opened_department_id,
                'subject' => 'unknown',
                'message' => '<p>unknown {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_opened_department_id,
                'subject' => 'unknown',
                'message' => '<p>unknown {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_opened_department_id,
                'subject' => 'unknown',
                'message' => '<p>unknown {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],


            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $assigned_to_reply_mail_id,
                'subject' => 'happy',
                'message' => '<p>happiness {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $assigned_to_reply_mail_id,
                'subject' => 'happy',
                'message' => '<p>happiness {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
             [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $assigned_to_reply_mail_id,
                'subject' => 'happy',
                'message' => '<p>happiness {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $assigned_to_reply_mail_id,
                'subject' => 'happy',
                'message' => '<p>happiness {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],



            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $department_staff_reply_mail_id,
                'subject' => 'sad',
                'message' => '<p>saad {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $department_staff_reply_mail_id,
                'subject' => 'sad',
                'message' => '<p>saad {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
             [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $department_staff_reply_mail_id,
                'subject' => 'sad',
                'message' => '<p>saad {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $department_staff_reply_mail_id,
                'subject' => 'sad',
                'message' => '<p>saad {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

             [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $department_user_reply_mail_id,
                'subject' => 'completed',
                'message' => '<p>complete {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $department_user_reply_mail_id,
                'subject' => 'completed',
                'message' => '<p>complete {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $department_user_reply_mail_id,
                'subject' => 'completed',
                'message' => '<p>complete {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $department_user_reply_mail_id,
                'subject' => 'completed',
                'message' => '<p>complete {$user_name},</p><p>A ticket is opened and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_assigned_id,
                'subject' => 'Ticket Assigned en',
                'message' => '<p>Hello {$user_name},</p><p>A ticket is assigned for you and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_assigned_id,
                'subject' => 'Ticket Assigned es',
                'message' => '<p>Hello {$user_name},</p><p>A ticket is assigned for you and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_assigned_id,
                'subject' => 'Ticket Assigned fr',
                'message' => '<p>Hello {$user_name},</p><p>A ticket is assigned for you and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
             [
                'uuid' => Uuid::getUuid(),
                'email_template_id' => $ticket_assigned_id,
                'subject' => 'Ticket Assigned du',
                'message' => '<p>Hello {$user_name},</p><p>A ticket is assigned for you and the ticket id is
                        #{$ticket_id}.</p><p><span style="font-weight: bolder; color: rgb(34, 34, 34); font-family: Arial,
                        Helvetica, sans-serif; font-size: small;"><span style="font-family: &quot;Times New
                        Roman&quot;;">Thank You</span></span></p><p><br></p>',
                'language_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);

    }
}
