<?php

namespace App\Http\Controllers\Central;
use App\Http\Controllers\Controller;

use App\Models\Central\Plan;
use App\Models\Central\Services\PlanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use App\Helpers\Logger;
use App\Helpers\Uuid;

class PlanController extends Controller
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
        $plans = Plan::orderBy('display_order')->get();
        $params = [
            'plans' => $plans,
        ];
        return view('central.plans.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin', Authorize::class);
        return view('central.plans.create');
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
                'name' => 'required',
                'description' => 'required',
                'display_order' => 'required | numeric',
            ]);
            $validator->sometimes('department_count', 'required|numeric', function($request){
                return $request->departments == 1;
            });
            $validator->sometimes('staffs_qty', 'required|numeric', function($request){
                return $request->staff == 1;
            });
            $validator->sometimes('user_qty', 'required|numeric', function($request){
                return $request->users == 1;
            });
            $validator->sometimes('ticket_qty', 'required|numeric', function($request){
                return $request->tickets == 1;
            });
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $planService = new PlanService();
            $planService->addPlan($request);

            return redirect()->route('plans.index')
                ->with('success', __('Plan added'));
         } catch (\Exception $e) {
              Logger::error($e->getMessage());
             return redirect()
              ->back()
             ->withInput()
             ->with('error', $e->getMessage());
          }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $uuid)
    {
        $this->authorize('isAdmin', Authorize::class);
        $plan = Plan::find($uuid);
        $params = [
            'plan' =>$plan,
        ];
        return view('central.plans.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $this->authorize('isAdmin', Authorize::class);
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'display_order' => 'required | numeric',
            ]);
            $validator->sometimes('department_count', 'required|numeric', function($request){
                return $request->departments == 1;
            });
            $validator->sometimes('staffs_qty', 'required|numeric', function($request){
                return $request->staff == 1;
            });
            $validator->sometimes('user_qty', 'required|numeric', function($request){
                return $request->users == 1;
            });
            $validator->sometimes('ticket_qty', 'required|numeric', function($request){
                return $request->tickets == 1;
            });
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $plan = Plan::find($uuid);
            // dd($plan);
            $planService = new PlanService();
            $planService->updatePlan($request, $plan);

            return redirect()->route('plans.index')
                ->with('success', __('Plan Updated'));
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
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->authorize('isAdmin', Authorize::class);
        $plan = Plan::find($uuid);
        $plan->delete();
        return redirect()->route('plans.index')
            ->with('success', __('Plan deleted'));
    }
}
