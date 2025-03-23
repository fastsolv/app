<?php

namespace App\Http\Controllers\Tenant;

use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Product;
use App\Models\Tenant\RolePermission;
use App\Models\Tenant\Services\ProductService;
use App\Models\Tenant\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct() {

        $this->middleware( [ 'auth', 'verified' ] );
    }

    public function index( Request $request )  {

        // $this->authorize( 'isNotUser', Product::class );
        // $this->authorize( 'view', Product::class );
        $user = User::find( auth()->id() );
        $show_add_button =  $user->user_type !== 'admin' ? RolePermission::where( 'role_id', $user->role_id )->where( 'permission_id', 9 )->value( 'is_allowed' ):1;
        $show_edit_button = $user->user_type !== 'admin' ? RolePermission::where( 'role_id', $user->role_id )->where( 'permission_id', 10 )->value( 'is_allowed' ):1;
        $show_delete_button = $user->user_type !== 'admin' ? RolePermission::where( 'role_id', $user->role_id )->where( 'permission_id', 12 )->value( 'is_allowed' ):1;

        if ( $request->name ) {

            if ( $request->order == 'desc' ) {
                $products = Product::orderBy( $request->name, 'desc' )->paginate( 10 );
                $sort_order = 'asc';

            } else {
                $products = Product::orderBy( $request->name, 'asc' )->paginate( 10 );
                $sort_order = 'desc';

            }
        } else {

            $products = Product::all();
            $sort_order = 'decs';
        }

        return view(
            'tenant.products.index',
            compact( 'products', 'show_add_button', 'show_edit_button', 'show_delete_button', 'sort_order' )
        );
    }

    public function create() {
        $this->authorize( 'isNotUser', Product::class );
        $this->authorize( 'create', Product::class );
        return view( 'tenant.products.create' );
    }

    public function store( Request $request ) {
        $this->authorize( 'isNotUser', Product::class );
        $this->authorize( 'create', Product::class );
        try {

            $validator = Validator::make( $request->all(), [
                'product_name' => 'required',
                'product_description' => 'required',
                'status' => 'required',

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
        $this->authorize( 'isNotUser', Product::class );
        $this->authorize( 'update', Product::class );
        $product = Product::find( $uuid );
        return view( 'tenant.products.edit', $product );
    }

    public function update( Request $request, $uuid ) {

        $this->authorize( 'isNotUser', Product::class );
        $this->authorize( 'update', Product::class );
        try {

            // validate the form
            $validator = Validator::make( $request->all(), [
                'product_name' => 'required',
                'product_description' => 'required',
                'status' => 'required',
            ] );

            if ( $validator->fails() ) {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors( $validator );
            }

            $product = Product::find( $uuid );
            $product->product_name = $request->product_name;
            $product->product_description = $request->product_description;
            $product->status = $request->status;
            $product->update();

            return redirect()->route( 'products' )
            ->with( 'success', __( 'Product updated' ) );

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

        $this->authorize( 'isNotUser', Product::class );
        $this->authorize( 'delete', Product::class );
        $product = Product::find( $uuid );
        $product->delete();
        return redirect()->route( 'products' )
        ->with( 'success', __( 'product deleted' ) );
    }
}


