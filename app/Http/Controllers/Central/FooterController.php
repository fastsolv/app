<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Central\Setting;

class FooterController extends Controller
{
    public function privacyPolicy()
    {
        $data = Setting::where('name', 'privacy_policy')->first();
        return view('central.footer.privacy_policy', $data);
    }

    public function terms()
    {
        $data = Setting::where('name', 'terms_of_use')->first();
        return view('central.footer.terms', $data);
    }
}
