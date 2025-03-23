<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Tenant\Language;
use App\Models\Tenant\Setting;
use App\Models\Tenant\TicketStatus;
use App\Models\Tenant\Permission;
use App\Models\Central\Address;
use App\Models\Central\Gateway;
use App\Models\Central\Service;
use App\Models\Central\Currency;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Tenant\RolePermission;
use Illuminate\Support\Facades\Schema;
use DB;
use Auth;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }

        $uri =  \Request::getRequestUri();
        $iSinstallRoute = false;
        if(substr( $uri, 0, 8 ) === "/install") {
            $iSinstallRoute = true;
        }
        if (!$iSinstallRoute) {
            View::share('languages', Language::all());
            View::share('logo', Setting::where('name', 'system_logo')
                ->value('value'));
            View::share('footer_text', Setting::where('name', 'footer_text')
                ->value('value'));
                
            if (tenant('id') !== null) {
                if(Auth::user() && tenant('status') == false) {
                    return response()->view('tenant.service_expired');
                }

                $app_name = Setting::where('name', 'app_name')->value('value');
                $words = explode(" ", $app_name);
                $app_name_short = "";
                if($words[0]!=null) {
                    foreach ($words as $w) {
                    $app_name_short .= $w[0];
                    }
                }
                $user = User::find(auth()->id());

                View::share('app_name_short', $app_name_short);
                View::share('app_name', $app_name);
                View::share('theme', Setting::where('id', 9)->value('value'));
                View::share('imap_enables', Setting::where('id', 1)->first());
                View::share('statuses', TicketStatus::all());
                View::share('extension', Setting::where('id', 2)->value('value'));
               
                View::share('statusPermission',$user ? RolePermission::where('role_id', $user->role_id)->where('permission_id',7)->value('is_allowed'):0);
                View::share('departmentPermission', $user ? RolePermission::where('role_id', $user->role_id)->where('permission_id',3)->value('is_allowed'):0);
                View::share('userPermission', $user ?  RolePermission::where('role_id', $user->role_id)->where('permission_id',15)->value('is_allowed'):0);
                View::share('emailTemplatePermission', $user ? RolePermission::where('role_id', $user->role_id)->where('permission_id',23)->value('is_allowed'):0);
                View::share('productPermission', $user ?  RolePermission::where('role_id', $user->role_id)->where('permission_id',11)->value('is_allowed'):0);
                View::share('cannedResponsePermission',  $user ? RolePermission::where('role_id', $user->role_id)->where('permission_id',19)->value('is_allowed'):0);

                View::share('ticketCreatePermission',  $user ? RolePermission::where('role_id', $user->role_id)->where('permission_id',25)->value('is_allowed'):0);
                View::share('ticketPermission',  $user ? RolePermission::where('role_id', $user->role_id)->where('permission_id',26)->value('is_allowed'):0);
                View::share('feedbackPermission',  $user ? RolePermission::where('role_id', $user->role_id)->where('permission_id',27)->value('is_allowed'):0);
                View::share('faqPermission',  $user ? RolePermission::where('role_id', $user->role_id)->where('permission_id',31)->value('is_allowed'):0);
                View::share('faqcategoryPermission',  $user ? RolePermission::where('role_id', $user->role_id)->where('permission_id',32)->value('is_allowed'):0);
                View::share('kbarticlePermission',  $user ? RolePermission::where('role_id', $user->role_id)->where('permission_id',28)->value('is_allowed'):0);
                View::share('kbcategoryPermission',  $user ? RolePermission::where('role_id', $user->role_id)->where('permission_id',30)->value('is_allowed'):0);
        
                View::share('emailAssignPermission',  $user ? Setting::where('id', 1)->value('value'):0);
                
            } else {
                $app_name = env('APP_NAME');
                $words = explode(" ", $app_name);
                $app_name_short = "";
                if($words[0]!=null) {
                    foreach ($words as $w) {
                    $app_name_short .= $w[0];
                    }
                }
                View::share('app_name_short', $app_name_short);
                View::share('currencies', Currency::all());
                $user = Auth::user();
                if ($user) {
                    View::share('existPlan',Service::where('user_id', $user->id)
                        ->where('status_id', 1)->latest()->first());
                    View::share('availableAddress', Address::find(1));
                    View::share('activeGateway', Gateway::where('status', true)->first());
                }

            }


        }
        return $next($request);
    }
}
