<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Setting;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings=Setting::find(9);
        $param=[
         'setting'=>  $settings,
        ];
        
        return view('tenant.theme.index', $param);
    }

}


