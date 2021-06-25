<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Validator;
use App\Http\Resource\Product as ProductResource;

class ProductController extends BaseController
{
        public function index() {
            $products = Product::all();
            return $this->sendResponse(ProductResource::collection($products), 'Products retrieved succesfully.');
        }


        public function store(Request $request)
        {
            $input = $request->all();

            $validator = Validator::make($input, [
                'name' => 'required',
                'detail' => 'required'
            ]);

            if($validator->falls()){
                return $this->sendError('Validation Error', $validator->errors());
            }

            $product =  Product::create($input)
        }
}