<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Tenant\Setting;

class FooterController extends Controller
{
    public function privacyPolicy()
    {
        $data = Setting::where('name', 'privacy_policy')->first();
        return view('tenant.footer.privacy_policy', $data);
    }

    public function terms()
    {
        $data = Setting::where('name', 'terms_of_use')->first();
        return view('tenant.footer.terms', $data);
    }
}
