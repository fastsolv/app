<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;

class CountryStateController extends Controller
{
    /*
     * Get the list of countries
     */
    public function country()
    {
        $countries = DB::table('countries')->get()->toJson(JSON_PRETTY_PRINT);
        return response($countries, 200);
    }

    /*
     * Get the list of states corresponds to a country
     */
    public function state(Request $request)
    {
        $id = $request->country_id;
        $states = DB::table('states')
        ->where('country_id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($states, 200);
    }
}
