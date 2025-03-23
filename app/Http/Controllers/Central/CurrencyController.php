<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use App\Models\Central\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use App\Helpers\Logger;

class CurrencyController extends Controller
{
    public function __construct()
    {
        /*
        make sure only logged in and verified user has access
        to this controller
         */
        $this->middleware(['auth', 'verified']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin', Authorize::class);
        $currencies = Currency::all();
        $params = [
            'currencies' => $currencies,
        ];
        return view('central.currency.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin', Authorize::class);
        return view('central.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin', Authorize::class);
        try {
            $validator = Validator::make($request->all(), [
                'currency' => 'required',
                'prefix' => 'required',
            ]);

            $currency = new Currency();
            $currency->currency = $request->currency;
            $currency->prefix = $request->prefix;
            $currency->save();

            return redirect()->route('currency.index')
                ->with('success', __('Currency added'));
         } catch (\Exception $e) {
              Logger::error($e->getMessage());
             return redirect()
              ->back()
             ->withInput()
             ->with('error', __($e->getMessage()));
          }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $this->authorize('isAdmin', Authorize::class);
        // dd($id);
        $currency = Currency::find($id);
        $params = [
            'currency' =>$currency,
        ];
        return view('central.currency.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin', Authorize::class);
        try {
            $validator = Validator::make($request->all(), [
                'currency' => 'required',
                'prefix' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $currency = Currency::find($id);
            // dd($currency);
            $currency->update($request->all());

            return redirect()->route('currency.index')
                ->with('success', __('Currency Updated'));
         } catch (\Exception $e) {
              Logger::error($e->getMessage());
             return redirect()
              ->back()
             ->withInput()
             ->with('error', $e->getMessage());
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin', Authorize::class);
        $currency = Currency::find($id);
        $currency->delete();
        return redirect()->route('currency.index')
            ->with('success', __('Currency deleted'));
    }
}
