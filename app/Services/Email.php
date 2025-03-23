<?php
namespace App\Services;

use Exception;
use App\Helpers\Logger;
use App\Models\Tenant\ErrorLog;
use App\Models\User;
use App\Models\Tenant\Department;
use App\Models\Tenant\EmailTemplate;
use App\Mail\TicketOpened;
use App\Mail\TicketReplyAdded;
use App\Mail\MailTicketOpened;
use App\Mail\AssignedToReplyMail;
use App\Mail\AssignedToMail;
use App\Mail\DepartmentMail;
use App\Mail\DepartmentStaffReplyMail;
use App\Mail\DepartmentUserReplyMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;
use App\Jobs\SendDynamicSmtpEmailJob;
use App\Models\Tenant\Services\EmailTemplateLanguageService;
use Illuminate\Support\Facades\DB;

class Email
{
    public function ticketOpened($ticket)
    {
        $templateLanguage = new EmailTemplateLanguageService();
        $language = $templateLanguage->getEmailTemplateLanguageId(
            $ticket->ticketUser->language_id
        );

        $content = DB::table("email_templates as et")
            ->where("name", "ticket_opened")
            ->leftJoin("email_template_translations as etl", function (
                $join
            ) use ($language) {
                $join
                    ->on("et.uuid", "=", "etl.email_template_id")
                    ->where("etl.language_id", "=", $language);
            })
            ->first();

        if ($content->status == true) {
            Logger::info(
                "Sending ticket opened mail to " . $ticket->ticketUser->email .
                " And language id = $language"
            );
            $mail = new TicketOpened($ticket, $content);
            Mail::to($ticket->ticketUser->email)->queue($mail);
        }
    }

    public function ticketReplyAdded($ticket)
    {
        $templateLanguage = new EmailTemplateLanguageService();
        $language = $templateLanguage->getEmailTemplateLanguageId(
            $ticket->ticketUser->language_id
        );
        $content = DB::table("email_templates as et")
            ->where("name", "ticket_reply")
            ->leftJoin("email_template_translations as etl", function (
                $join
            ) use ($language) {
                $join
                    ->on("et.uuid", "=", "etl.email_template_id")
                    ->where("etl.language_id", "=", $language);
            })
            ->first();

        if ($content->status == true) {
            $mail = new TicketReplyAdded($ticket, $content);
            Mail::to($ticket->ticketUser->email)->queue($mail);
        }
    }

    public function mailTicketOpened($ticket, $department)
    {
	    $templateLanguage = new EmailTemplateLanguageService();
	    // As email is for a new email user, let's send email in first language
        $language =  1;
        $content = DB::table("email_templates as et")
            ->where("name", "mail_ticket_opened")
            ->leftJoin("email_template_translations as etl", function (
                $join
            ) use ($language) {
                $join
                    ->on("et.uuid", "=", "etl.email_template_id")
                    ->where("etl.language_id", "=", $language);
            })
            ->first();

        if ($content->status == true) {
            $mail = new MailTicketOpened($ticket, $content);
            // Fix for the  Your domain gmail.com is not allowed in header error
            $mail->from($department->email);

            $backup = Mail::getSwiftMailer();
            $security =
                $department->smtp_encryption != ""
                    ? $department->smtp_encryption
                    : null;
            $transport = (new \Swift_SmtpTransport(
                $department->smtp_host,
                $department->smtp_port,
                $security
            ))
                ->setUsername($department->email)
                ->setPassword($department->smtp_password);
            $mailer = new \Swift_Mailer($transport);

            Mail::setSwiftMailer($mailer);
            Mail::to($ticket->from_email)->send($mail);
            Mail::setSwiftMailer($backup);
        }
    }

    public function departmentEmail($ticket, $dept_id)
    {
        $department = Department::where("id", $dept_id)->first();
        $user_ids = $department
            ->users()
            ->pluck("user_id")
            ->toArray();
        if (!empty($user_ids)) {
            $staffs = User::whereIn("id", $user_ids)->get();
            Logger::info("Sending ticket opened mail to department staffs");
            foreach ($staffs as $staff) {
                $templateLanguage = new EmailTemplateLanguageService();
                $language = $templateLanguage->getEmailTemplateLanguageId(
                    $staff->language_id
                );
                $content = DB::table("email_templates as et")
                    ->where("name", "ticket_opened_department")
                    ->leftJoin("email_template_translations as etl", function (
                        $join
                    ) use ($language) {
                        $join
                            ->on("et.uuid", "=", "etl.email_template_id")
                            ->where("etl.language_id", "=", $language);
                    })
                    ->first();
                $mail = new DepartmentMail($ticket, $content, $staff);
                Mail::to($staff->email)->queue($mail);
            }
        }
    }

    public function assignedToEmail($ticket, $staff_id)
    {
        $staff = User::find($staff_id);
        $templateLanguage = new EmailTemplateLanguageService();
        $language = $templateLanguage->getEmailTemplateLanguageId(
            $staff->language_id
        );
        $content = DB::table("email_templates as et")
            ->where("name", "ticket_assigned")
            ->leftJoin("email_template_translations as etl", function (
                $join
            ) use ($language) {
                $join
                    ->on("et.uuid", "=", "etl.email_template_id")
                    ->where("etl.language_id", "=", $language);
            })
            ->first();

        if ($content->status == true) {
            if (!empty($staff)) {
                Logger::info("Sending ticket assigned mail to assigned staff");
                $data = [];
                $mail = new AssignedToMail($ticket, $content);
                Mail::to($staff->email)->queue($mail);
            }
        }
    }

    public function assignedToReplyMail($ticket, $user)
    {
	if(empty($ticket->assigned_to))
		return;

        $assigned_staff = User::find($ticket->assigned_to);
        $templateLanguage = new EmailTemplateLanguageService();
        $language = $templateLanguage->getEmailTemplateLanguageId(
            $assigned_staff->language_id
        );
        $content = DB::table("email_templates as et")
            ->where("name", "assigned_to_reply_mail")
            ->leftJoin("email_template_translations as etl", function (
                $join
            ) use ($language) {
                $join
                    ->on("et.uuid", "=", "etl.email_template_id")
                    ->where("etl.language_id", "=", $language);
            })
            ->first();

        if ($content->status == true) {
            $staff_email = User::where("id", $ticket->assigned_to)->value(
                "email"
            );
            if (!empty($staff_email) && $user != $staff_email) {
                Logger::info("Sending ticket reply mail to assigned staff");
                $data = [];
                $mail = new AssignedToReplyMail($ticket, $content);
                Mail::to($staff_email)->queue($mail);
            }
        }
    }

    public function departmentStaffReply($ticket, $replied_staff)
    {
        $department = Department::where(
            "id",
            $ticket->department_id
        )->first();
        $user_ids = $department
            ->users()
            ->pluck("user_id")
            ->toArray();
        if (!empty($user_ids)) {
            $staffs = User::whereIn("id", $user_ids)
                ->where("id", "!=", $replied_staff->id)
                ->get();
            Logger::info(
                "Sending ticket reply mail to department staffs when staff replied"
            );
            foreach ($staffs as $staff) {
                /*
                Let's take the language ID for the user
                $staff and it will be $staff->language_id
                 */
                $templateLanguage = new EmailTemplateLanguageService();
                $language = $templateLanguage->getEmailTemplateLanguageId(
                    $staff->language_id
                );

                $content = DB::table("email_templates as et")
                    ->where("name", "department_staff_reply_mail")
                    ->leftJoin("email_template_translations as etl", function (
                        $join
                    ) use ($language) {
                        $join
                            ->on("et.uuid", "=", "etl.email_template_id")
                            ->where("etl.language_id", "=", $language);
                    })
                    ->first();

                $mail = new DepartmentStaffReplyMail(
                    $ticket,
                    $content,
                    $staff,
                    $replied_staff
                );
                Mail::to($staff->email)->queue($mail);
            }
        }
    }


    /*
    TODO: fix for the follwoing emails
     */
    public function departmentUserReply($ticket)
    {
        $department = Department::where(
            "id",
            $ticket->department_id
        )->first();
        $user_ids = $department
            ->users()
            ->pluck("user_id")
            ->toArray();
        if (!empty($user_ids)) {
            $staffs = User::whereIn("id", $user_ids)->get();
            Logger::info(
                "Sending ticket reply mail to department staffs when client replied"
            );
            foreach ($staffs as $staff) {
                $templateLanguage = new EmailTemplateLanguageService();
                $language = $templateLanguage->getEmailTemplateLanguageId(
                    $staff->language_id
                );
                $content = DB::table("email_templates as et")
                    ->where("name", "department_user_reply_mail")
                    ->leftJoin("email_template_translations as etl", function (
                        $join
                    ) use ($language) {
                        $join
                            ->on("et.uuid", "=", "etl.email_template_id")
                            ->where("etl.language_id", "=", $language);
                    })
                    ->first();
                $mail = new DepartmentUserReplyMail(
                    $ticket,
                    $content,
                    $staff
                );
                Mail::to($staff->email)->queue($mail);
            }
        }
    }
}
