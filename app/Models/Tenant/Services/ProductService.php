<?php

namespace App\Models\Tenant\Services;

use Illuminate\Support\Str;
use App\Helpers\Uuid;
use App\Models\Tenant\Product;

class ProductService
{
    public function addProduct($request)
    {
        $product = new Product();
        $product->uuid = Uuid::getUuid();
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->status = $request->status;
        $product->save();
    }

    
}