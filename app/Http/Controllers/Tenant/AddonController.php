<?php

namespace App\Http\Controllers\Tenant;

use App\Helpers\Logger;
use App\Helpers\Uuid;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Addon;
use App\Models\Tenant\Hooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use ZipArchive;

class AddonController extends Controller
{
    public function __construct() {

        $this->middleware( [ 'auth', 'verified' ] );
    }

    public function index(Request $request)
    {
        $addon = Addon::all();
        $params = [
            'addon' => $addon
        ];
        return view('addon.index',$params);
    }
    public function create()
    {
        return view('addon.create');
    }
    public function store(Request $request)
    {
        try {
            //Form validation
            $validator = Validator::make($request->all(), [
                   'addonfile' => 'required'
                   
            ]);
        
    
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            if($request->hasFile('addonfile')) {
                
                $file = $request->file('addonfile');
                $zip = new ZipArchive;
                $extractedTemp = 'zip_extracted';
                $extractedTo = storage_path($extractedTemp);
                $res = $zip->open($file);
                $zipFolderName =  trim($zip->getNameIndex(0), '/');
                if ($res === true) {
                    $res = $zip->extractTo($extractedTo);
                    $zip->close();
                } else {
                    dd('could not open');
                }
                $jsonString = file_get_contents($extractedTo . "/$zipFolderName/config.json");
                $configArray = json_decode($jsonString, true);
                /*
                TODO: if an addon already exist with the
                    addon_index_url, throw error.
                */
                $addon_url = Addon::where('index_url',$configArray['addon_index_url'])->count();

                DB::beginTransaction();
                
                if(!$addon_url){
                    $addon = new Addon();
                    $addon->uuid = Uuid::getUuid();
                    $addon->name = $configArray['name'];
                    $addon->version = $configArray['version'];
                    $addon->index_url = $configArray['addon_index_url'];
                    $addon->settings_url = $configArray['addon_settings_url'];
                    $addon->status = true;
                }
                else{
                    throw new \Exception('Addon Already Exist');
                }
                
        
                //Move hooks and store hook details
                $hookConfig = $configArray['hook'];
                $hookPriority = $hookConfig['priority'];
                $hook = new Hooks();
                $hook->uuid = Uuid::getUuid();
                $hook->name = $hookConfig['name'];
                $hook->class = $hookConfig['class'];
                $hook->status = 1;
                $hook->priority = $hookConfig['priority'];
                $hook->rel_id  = $addon->uuid;
                $hook->save();
                $addon->save();
                
                //copy addon files
                $addonFiles = $configArray['addon_files'];
                foreach($addonFiles as $filePath){
                    $addonFile = $extractedTo . "/$zipFolderName/" . $filePath;
                    $destinationFile = base_path($filePath);
                    copy($addonFile,$destinationFile);
                }
                //copy hook file
                $hookFile = $extractedTo . "/$zipFolderName/" . $hookConfig['file'];
                $destinationFile =  base_path($hookConfig['file']);
                copy($hookFile, $destinationFile);
                
                DB::commit();
                
                return redirect()->route('addon.index')
                ->with('success', __('Addon added'));
            }
            else
            echo('else echoed');
        
        
    }
    catch (\Exception $e) {
        DB::rollback();
        Logger::error($e->getMessage());
        return redirect()
            ->back()
            ->withInput()
            ->with('error', __($e->getMessage()));
    }
           
    }
    public function edit(Request $request, $uuid)
    {
        $addon = Addon::find($uuid);
        $params = [
            'addon' => $addon
        ];
        return view('addon.edit', $params);
    }
    public function update(Request $request, $uuid)
    {
        try {
            //Form validation
            $validator = Validator::make($request->all(), [
                'addonname' => 'required',
                'status' => 'required'
                   
            ]);
            if ($validator->fails()) {
                Logger::error("Addon edit form is invalid: " .  json_encode($request->all()));
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
            }

           $addon = Addon::find($uuid);
           $updateArray = [];
           $updateArray['name'] = $request->addonname;
           $updateArray['status'] = $request->status;
           $addon->update($updateArray); 

           $hook = Hooks::where('rel_id',$uuid)->first();
           $hook->status = $request->status;
           $hook->save();
           
           return redirect()->route('addon.index')
           ->with('success', __('Addon Updated'));
            
            

       } 
       catch (\Exception $e) {
        Logger::error($e->getMessage());
        return redirect()
            ->back()
            ->withInput()
            ->with('error', __($e->getMessage()));
        }
    }
    public function destroy($uuid)
    {
        $addon = Addon::find($uuid);
        $addon->delete();
        $hook = Hooks::where('rel_id', $uuid)->first();
        $hook->delete();
        return redirect()->route('addon.index')
            ->with('success', __('Addon deleted'));
    }

}
