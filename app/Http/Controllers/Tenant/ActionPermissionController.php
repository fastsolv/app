<?php

namespace App\Http\Controllers\Tenant;

use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\Tenant\ActionPermission;
use App\Models\Tenant\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActionPermissionController extends Controller
{
    public function __construct() {

        $this->middleware( [ 'auth', 'verified' ] );
    }
    
    public function index() {
         $this->authorize( 'isNotUser', ActionPermission::class );
     
        $action_permissions = ActionPermission::all();
    
        return view(
            'action_permissions.index',
            compact( 'action_permissions' )
        );
    }
    
    public function create() {
        $this->authorize( 'isNotUser', ActionPermission::class );
    
        return view( 'action_permissions.create' );
    }
    
    public function store( Request $request ) {
        $this->authorize( 'isNotUser', ActionPermission::class );
        try {
    
            $validator = Validator::make( $request->all(), [
                'model' => 'required',
                'action' => 'required',
              
    
            ] );
    
            if ( $validator->fails() ) {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors( $validator );
            }
    
            $product_Service = new ProductService();
    
            $ProductService = $product_Service->addProduct( $request );
    
            return redirect()->route( 'products' )
            ->with( 'success', __( 'Product Added' ) );
    
        } catch ( \Exception $e ) {
            //TODO: add the error to the error log ?
            Logger::error( $e->getMessage() );
            return redirect()
            ->back()
            ->withInput()
            ->with( 'error', __( 'Something went wrong' ) );
        }
    }
    
    public function show( $id ) {
        //
    }
    
    public function edit( $uuid ) {
        $this->authorize( 'isNotUser', ActionPermission::class );
    
        $action_permission = ActionPermission::find( $uuid );
        return view( 'action_permissions.edit', $action_permission );
    }
    
    
    public function update( Request $request, $uuid ) {
    
        $this->authorize( 'isNotUser', ActionPermission::class );
    
        try {
       
            // validate the form
            $validator = Validator::make( $request->all(), [
                'model' => 'required',
                'action' => 'required',
                
            ] );
    
            if ( $validator->fails() ) {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors( $validator );
            }
    
            $action_permission = ActionPermission::find( $uuid );
            $action_permission->model = $request->model;
            $action_permission->action = $request->action;
           
            $action_permission->update();
        
    
            return redirect()->route( 'action_permissions.index' )
            ->with( 'success', __( 'action_permission updated' ) );
    
        } catch ( \Exception $e ) {
            Logger::error( 'IMAP error' );
            Logger::error( $e->getMessage() );
            return redirect()
            ->back()
            ->withInput()
            ->with( 'error', __( 'Something went wrong' ) );
        }
    }
    
    public function destroy( $uuid ) {
    
        $this->authorize( 'isNotUser', ActionPermission::class );
    
        $action_permission = ActionPermission::find( $uuid );
        $action_permission->delete();
        return redirect()->route( 'action_permissions.index' )
        ->with( 'success', __( 'action permissions deleted' ) );
    }
}    