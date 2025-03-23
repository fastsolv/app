<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tenant\Language;
use App\Models\Tenant\Services\UserService;

class LanguageController extends Controller
{
    public function __construct()
    {
        /*
        make sure only logged in and verified user has access
        to this controller
        */
        $this->middleware(['auth', 'verified']);    
    }

    public function index(Request $request)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('before', Language::class);

        // List the available languages
        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $languages = Language::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $languages = Language::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {

            $languages = Language::all();
            $sort_order = 'decs';
        }
  
        $languages = Language::all();
        return view('tenant.language.index', compact('languages'));
    }

    public function store(Request $request)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('before', Language::class);

        try {
            $validator = Validator::make($request->all(), [
                   'language' => 'required',
                   'code' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            
             //Add a new language
            $language = new Language();
            $language->language = $request->language;
            $language->code = $request->code;
            $language->save();

            return redirect()->route('language.index')
                ->with('success', __('Language added'));
        } catch (\Exception $e) {
            Logger::error($e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('Something went wrong'));
        }
    }

    public function destroy($id)
    {
        /*
        Check weather the user has access to this function
        */
        $this->authorize('before', Language::class);
        
        /*
        Delete a language
        */
        $language = Language::find($id);
        $language->delete();
        return redirect()->route('language.index')
            ->with('success', __('Language deleted'));
    }

}
