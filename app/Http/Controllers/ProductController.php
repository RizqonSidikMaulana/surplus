<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ResponseResource;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a list of products that enable was true.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $page = 1;
        if (request('page') != null) {
            $page = request('page');
        }

        $data = Product::with(['categories' => function ($query) {
            $query->where('enable', true);
        }, 'images' => function ($query) {
            $query->where('enable', true);
        }])->where('enable', '=', true);

        $data = $data->paginate(10, ['*'], 'page', $page);

        $response = [
            'status' => true,
            'message' => 'success',
            'data' => $data,
        ];

        return new ResponseResource($response);
    }

    /**
     * Display a list of products with avoid enable flag.
     *
     * @return \Illuminate\Http\Response
     */
    public function listAll()
    {
        $page = 1;
        if (request('page') != null) {
            $page = request('page');
        }

        $data = Product::with('categories', 'images');

        $data = $data->paginate(10, ['*'], 'page', $page);

        $response = [
            'status' => true,
            'message' => 'success',
            'data' => $data,
        ];

        return new ResponseResource($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $response = [
            'status' => true,
            'message' => 'success store product',
            'data' => [],
        ];

        // Validate form.
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string',
            'categories' => 'required|array',
            'images' => 'required|array',
            'images.*.name' => 'required|string',
            'images.*.file' => 'required|string',
            'images.*.enable' => 'boolean',
            'enable' => 'boolean',
        ]);

        if ($validator->fails()) {
            $response['status'] = false;
            $response['message'] = $validator->errors()->first();
            return new ResponseResource($response);
        }

        // Check category id
        $category = $request->get('categories');
        $resCategory = Category::whereIn('id', $category)->get();
        if (count($category) != count($resCategory->toArray())) {
            $response['status'] = false;
            $response['message'] = 'wrong categories id';
            return new ResponseResource($response);
        }
        try {
            DB::beginTransaction();
            
            // Insert image.
            $idImage = [];
            foreach ($request->get('images') as $value) {
                $idImage[] = Image::create($value)->id;
            }

            $idProduct = Product::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'enable' => $request->get('enable'),
            ])->id;

            $product = Product::find($idProduct);
            $product->categories()->sync($category);
            $product->images()->sync($idImage);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            $response['status'] = false;
            $response['message'] = $e->getMessage();
            return new ResponseResource($response);
        }

        return new ResponseResource($response);
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $response = [
            'status' => true,
            'message' => 'success',
            'data' => [],
        ];

        $product = Product::with('categories', 'images')->where('id', '=', $id)->get();
        $response['data'] = $product;

        if (!$product->toArray()) {
            $response['status'] = false;
            $response['message'] = 'Data not found';
            return new ResponseResource($response);
        }

        return new ResponseResource($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        $response = [
            'status' => true,
            'message' => 'success update product',
            'data' => [],
        ];

        // Validate form.
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string',
            'categories' => 'required|array',
            'images' => 'required|array',
            'images.*.name' => 'required|string',
            'images.*.file' => 'required|string',
            'images.*.enable' => 'boolean',
            'enable' => 'boolean',
        ]);

        if ($validator->fails()) {
            $response['status'] = false;
            $response['message'] = $validator->errors()->first();
            return new ResponseResource($response);
        }

        // Check product id.
        $product = Product::find($id);
        if (!$product) {
            $response['status'] = false;
            $response['message'] = 'wrong product id';
            return new ResponseResource($response);
        }

        // Check category id.
        $category = $request->get('categories');
        $resCategory = Category::whereIn('id', $category)->get();
        if (count($category) != count($resCategory->toArray())) {
            $response['status'] = false;
            $response['message'] = 'wrong categories id';
            return new ResponseResource($response);
        }

        try {
            DB::beginTransaction();
            
            // Insert image.
            $idImage = [];
            foreach ($request->get('images') as $value) {
                $idImage[] = Image::create($value)->id;
            }

            // Update product.
            $product->name = $request->get('name');
            $product->description = $request->get('description');
            $product->enable = $request->get('enable');

            $product->save();

            // Update categories and images of product.
            $product->categories()->sync($category);
            $product->images()->sync($idImage);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            $response['status'] = false;
            $response['message'] = $e->getMessage();
            return new ResponseResource($response);
        }

        return new ResponseResource($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            $response['status'] = false;
            $response['message'] = 'wrong product id';
            return new ResponseResource($response);
        }
        $product->images()->delete();
        $product->images()->detach();
        $product->categories()->detach();
        $product->delete();

        $response = [
            'status' => true,
            'message' => 'success delete product',
            'data' => [],
        ];

        if (!$product) {
            $response['status'] = false;
            $response['message'] = 'failed to delete product';
        }

        return new ResponseResource($response);
    }
}
