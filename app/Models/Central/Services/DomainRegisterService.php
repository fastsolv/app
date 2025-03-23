<?php

namespace App\Models\Central\Services;

use Carbon\Carbon;
use DB;

use App\Models\Central\Setting;
use App\Models\Tenant;
use App\Models\Tenant\User;
use App\Helpers\Uuid;
use App\Helpers\Logger;
use App\Helpers\Random;

class DomainRegisterService
{
    public function registerDomain($sub_domain)
    {
        $user_data = auth()->user();
        $current_user = DB::table('users')->where('id', $user_data->id)->first();
        $tenant1 = Tenant::create(['id' => $sub_domain]);
        $central_domain = $this->getCentralDomain();
        $tenant1->domains()->create(['domain' => "$sub_domain.$central_domain"]);
        $tenant1->run(function () use ($current_user) {
            $user = new User;
            $user->first_name = $current_user->first_name;
            $user->last_name = $current_user->last_name;
            $user->email = $current_user->email;
            $user->password = $current_user->password;
	    $user->role = 'admin';
	    $user->user_type = 'admin';
            $user->email_verified_at = $current_user->email_verified_at;
            $user->save();
        });
    }


    public function getCentralDomain()
    {
        $centralDomain = Setting::find(5);
        if(!empty($centralDomain->value)) {
            return $centralDomain->value;
        }
    }

    public function setCentralDomain($value)
    {
        $centralDomain = Setting::find(5);
        $centralDomain->value = $value;
        $centralDomain->save();
    }

    public function getProtocol()
    {
        $protocol = Setting::find(6);
        if(!empty($protocol->value)) {
            return $protocol->value;
        }
    }

    public function setProtocol($value)
    {
        $protocol = Setting::find(6);
        $protocol->value = $value;
        $protocol->save();
    }
}
