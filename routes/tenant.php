<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/lang/{locale}', function($locale){
        session()->put('locale', $locale);
        //dd($locale);
       // App::setlocale($locale);
        return redirect()->back();
    });
    
    Auth::routes(['verify' => true]);
    
    Route::get('/', [App\Http\Controllers\Tenant\DashboardController::class, 'index'])->name('home');
    
    Route::get('/dashboard', [App\Http\Controllers\Tenant\DashboardController::class, 'index'])->name('dashboard');
    // TicketStatusController CRUD
    Route::resource('ticket_status', App\Http\Controllers\Tenant\TicketStatusController::class);
    Route::resource('department', App\Http\Controllers\Tenant\DepartmentController::class);
    Route::resource('ticket', App\Http\Controllers\Tenant\TicketController::class);
    Route::resource('staff', App\Http\Controllers\Tenant\StaffController::class);
    Route::resource('user', App\Http\Controllers\Tenant\UserController::class);
    Route::resource('language', App\Http\Controllers\Tenant\LanguageController::class);
    Route::resource('settings', App\Http\Controllers\Tenant\SettingController::class);
    Route::resource('imap_ticket', App\Http\Controllers\Tenant\ImapTicketController::class);
    Route::resource('error_log', App\Http\Controllers\Tenant\ErrorLogController::class);
    Route::resource('email_template', App\Http\Controllers\Tenant\EmailTemplateController::class);
    Route::resource('tags', App\Http\Controllers\Tenant\TagController::class);
    Route::resource('faq_category', App\Http\Controllers\Tenant\FaqCategoryController::class);
    Route::resource('faq', App\Http\Controllers\Tenant\FaqController::class);
    Route::resource('permissions', App\Http\Controllers\Tenant\PermissionController::class);
    Route::resource('kb_category', App\Http\Controllers\Tenant\KbCategoryController::class);
    Route::resource('kb_article', App\Http\Controllers\Tenant\KbArticleController::class);
    Route::resource('articles', App\Http\Controllers\Tenant\ArticleController::class);
    Route::resource('faq_list', App\Http\Controllers\Tenant\FaqListController::class);
    Route::resource('canned_responses', App\Http\Controllers\Tenant\CannedResponseController::class);
    Route::resource('client_groups', App\Http\Controllers\Tenant\ClientGroupController::class);
    Route::resource('client_group_campaign', App\Http\Controllers\Tenant\ClientGroupEmailCampaignController::class);
    Route::resource('custom_list_campaign', App\Http\Controllers\Tenant\CustomListEmailCampaignController::class);
    Route::resource('theme', App\Http\Controllers\Tenant\ThemeController::class);
    Route::resource('product', App\Http\Controllers\Tenant\ProductController::class);
    Route::resource('announcement', App\Http\Controllers\Tenant\AnnouncementController::class);
    Route::resource('roles', App\Http\Controllers\Tenant\RoleController::class);
    Route::resource('role_permission', App\Http\Controllers\Tenant\RolePermissionController::class);

    Route::get('role_permission-detail/{role_id}/permission',[App\Http\Controllers\Tenant\RolePermissionController::class,'rolePermission'])->name('role_permission.detail');
    Route::get('role_permission-detail/{role_id}/selectall',[App\Http\Controllers\Tenant\RolePermissionController::class,'selectAll'])->name('role_permission.select');


    Route::get('/article/{slug}', [App\Http\Controllers\Tenant\ArticleController::class, 'showArticle'])->name('showArticle');
    
    Route::match(['get', 'post'], '/{uuid}/ticket_reply', [App\Http\Controllers\Tenant\TicketController::class, 'reply'])
        ->name('ticket.reply');
    Route::match(['get', 'post'], '/{uuid}/ticket_modify', [App\Http\Controllers\Tenant\TicketController::class, 'modify'])
        ->name('ticket.modify');
    Route::match(['get', 'post'], '/{uuid}/ticket_note', [App\Http\Controllers\Tenant\TicketController::class, 'note'])
        ->name('ticket.note');
    Route::match(['get', 'post'], '/{uuid}/internal_ticket_note', [App\Http\Controllers\Tenant\TicketController::class, 'internalNote'])
        ->name('ticket.internal_note');
    Route::match(['get', 'post'], '/status_tickets/{id}', [App\Http\Controllers\Tenant\TicketController::class, 'ticketByStatus'])
        ->name('tickets');
    Route::get('/my_ticket', [App\Http\Controllers\Tenant\TicketController::class, 'myTicket'])->name('my_ticket');;
    Route::get('/assigned_to_me', [App\Http\Controllers\Tenant\TicketController::class, 'assignedToMe'])->name('ticket_assigned_me');
    
    Route::match(['get', 'post'], '/{uuid}/imap_ticket_reply', [App\Http\Controllers\Tenant\ImapTicketController::class, 'reply'])
        ->name('imap_ticket.reply');
    Route::match(['get', 'post'], '/{uuid}/imap_ticket_modify', [App\Http\Controllers\Tenant\ImapTicketController::class, 'modify'])
        ->name('imap_ticket.modify');
    Route::match(['get', 'post'], '/{uuid}/imap_ticket_note', [App\Http\Controllers\Tenant\ImapTicketController::class, 'note'])
        ->name('imap_ticket.note');
    Route::match(['get', 'post'], '/{uuid}/internal_imap_ticket_note', [App\Http\Controllers\Tenant\ImapTicketController::class, 'internalNote'])
        ->name('imap_ticket.internal_note');
    Route::match(['get', 'post'], '/imap_status_tickets/{id}', [App\Http\Controllers\Tenant\ImapTicketController::class, 'ticketByStatus'])
        ->name('imapTickets');
    Route::get('/email_assigned_to_me', [App\Http\Controllers\Tenant\ImapTicketController::class, 'assignedToMe'])->name('email_ticket_assigned_me');
    Route::match(['get', 'post'], '/get_tickets', [App\Http\Controllers\Tenant\TicketController::class, 'index'])->name('get_tickets');
    Route::match(['get', 'post'], '/user_announcements', [App\Http\Controllers\Tenant\AnnouncementController::class, 'userAnnouncement'])->name('user_announcements');
    Route::match(['get', 'post'], '/get_users', [App\Http\Controllers\Tenant\UserController::class, 'index'])->name('get_users');
    Route::match(['get', 'post'], '/get_announcement', [App\Http\Controllers\Tenant\AnnouncementController::class, 'index'])->name('get_announcement');
    Route::match(['get', 'post'], '/products', [App\Http\Controllers\Tenant\ProductController::class, 'index'])->name('products');
    Route::match(['get', 'post'], '/feedback', [App\Http\Controllers\Tenant\TicketController::class, 'feedbacks'])
        ->name('feedbacks');
    Route::match(['get', 'post'], '/get_roles', [App\Http\Controllers\Tenant\RoleController::class, 'index'])->name('get_roles');
    Route::match(['get', 'post'], '/get_ticket_statuses', [App\Http\Controllers\Tenant\TicketStatusController::class, 'index'])->name('get_ticket_statuses');
    Route::match(['get', 'post'], '/get_departments', [App\Http\Controllers\Tenant\DepartmentController::class, 'index'])->name('get_departments');
    Route::match(['get', 'post'], '/get_tags', [App\Http\Controllers\Tenant\TagController::class, 'index'])->name('get_tags');
    Route::match(['get', 'post'], '/get_canned_response', [App\Http\Controllers\Tenant\CannedResponseController::class, 'index'])->name('get_canned_response');
    Route::match(['get', 'post'], '/get_staffs', [App\Http\Controllers\Tenant\StaffController::class, 'index'])->name('get_staffs');
    Route::match(['get', 'post'], '/get_settings', [App\Http\Controllers\Tenant\SettingController::class, 'index'])->name('get_settings');
    Route::match(['get', 'post'], '/get_languages', [App\Http\Controllers\Tenant\LanguageController::class, 'index'])->name('get_languages');
    Route::match(['get', 'post'], '/get_faq_category', [App\Http\Controllers\Tenant\FaqCategoryController::class, 'index'])->name('get_faq_category');
    Route::match(['get', 'post'], '/get_faqs', [App\Http\Controllers\Tenant\FaqController::class, 'index'])->name('get_faqs');
    Route::match(['get', 'post'], '/get_kb_category', [App\Http\Controllers\Tenant\KbCategoryController::class, 'index'])->name('get_kb_category');
    Route::match(['get', 'post'], '/get_kb_article', [App\Http\Controllers\Tenant\KbArticleController::class, 'index'])->name('get_kb_article');
    Route::match(['get', 'post'], '/get_users', [App\Http\Controllers\Tenant\UserController::class, 'index'])->name('get_users');
    Route::match(['get', 'post'], '/get_tickets', [App\Http\Controllers\Tenant\TicketController::class, 'index'])->name('get_tickets');
    

    Route::get('/download/{file}', [App\Http\Controllers\Tenant\TicketController::class, 'download'])->name('download');
    Route::get('/imap_download/{file}', [App\Http\Controllers\Tenant\ImapTicketController::class, 'download'])->name('imap_download');
    
    Route::match(['get', 'post'],'get_imap_ticket', [App\Http\Controllers\Tenant\ImapTicketController::class,'index'])->name('get_imap_ticket');

    Route::delete('/delete_reply/{uuid}', [App\Http\Controllers\Tenant\TicketController::class, 'replyDelete'])->name('delete_reply');
    Route::delete('/delete_note/{uuid}', [App\Http\Controllers\Tenant\TicketController::class, 'noteDelete'])->name('delete_note');
    Route::delete('/delete_internal_note/{uuid}', [App\Http\Controllers\Tenant\TicketController::class, 'internalNoteDelete'])->name('delete_internal_note');
    
    Route::delete('/delete_imap_reply/{uuid}', [App\Http\Controllers\Tenant\ImapTicketController::class, 'replyDelete'])->name('delete_imap_reply');
    Route::delete('/delete_imap_note/{uuid}', [App\Http\Controllers\Tenant\ImapTicketController::class, 'noteDelete'])->name('delete_imap_note');
    Route::delete('/delete_imap_internal_note/{uuid}', [App\Http\Controllers\Tenant\ImapTicketController::class, 'internalNoteDelete'])->name('delete_imap_internal_note');
    
    Route::get('/profile', [App\Http\Controllers\Tenant\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [App\Http\Controllers\Tenant\ProfileController::class, 'update'])->name('profileUpdate');
    Route::get('/languages', [App\Http\Controllers\Tenant\LanguageController::class, 'lang'])->name('lang');
    
    Route::get('/permissions', [App\Http\Controllers\Tenant\PermissionController::class, 'index'])->name('permissions');
    Route::post('/permissions/update', [App\Http\Controllers\Tenant\PermissionController::class, 'update'])->name('permissionUpdate');
    
    Route::get('/privacy_policy', [App\Http\Controllers\Tenant\FooterController::class, 'privacyPolicy'])->name('privacyPolicy');
    Route::get('/terms_of_use', [App\Http\Controllers\Tenant\FooterController::class, 'terms'])->name('terms');
    
    Route::get('/get_canned_responses_api', [App\Http\Controllers\Tenant\CannedResponseController::class, 'getCannedResponsesApi'])->name('getCannedResponsesApi');
    
    Route::get('/get_tags_api', [App\Http\Controllers\Tenant\TagController::class, 'getTagsApi'])->name('getTagsApi');
    Route::get('/get_clients_api', [App\Http\Controllers\Tenant\ClientGroupController::class, 'getClientsApi'])->name('getClientsApi');
    Route::get('/get_client_groups_api', [App\Http\Controllers\Tenant\UserController::class, 'getClientGroupsApi'])->name('getClientGroupsApi');

});
