<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\ResponseResource;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listCategoryWithProduct()
    {
        $page = 1;
        if (request('page') != null) {
            $page = request('page');
        }

        $data = Category::with(['products' => function ($query) {
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listAllCategory()
    {
        $page = 1;
        if (request('page') != null) {
            $page = request('page');
        }
        
        $data = Category::paginate(10, ['*'], 'page', $page);

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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        // Validate form.
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'enable' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors()->first(),
                'success' => false,
            ]);
        }

        $response = [
            'status' => true,
            'message' => 'success store category',
            'data' => [],
        ];

        $category = Category::create([
            'name' => $request->get('name'),
            'enable' => $request->get('enable'),
        ]);

        if (!$category) {
            $response['status'] = false;
            $response['message'] = 'failed to store category';
        }

        return new ResponseResource($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $response = [
            'status' => true,
            'message' => 'success',
            'data' => [],
        ];

        $category = Category::with('products')->where('id', '=', $id)->where('enable', '=', true)->get();
        $response['data'] = $category;

        if (!$category->toArray()) {
            return response()->json([
                'data' => [],
                'message' => 'Data not found'
            ], 404);
        }

        return new ResponseResource($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'enable' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors()->first(),
                'success' => false,
            ]);
        }

        $response = [
            'status' => true,
            'message' => 'success update category',
            'data' => [],
        ];

        $category = Category::find($id);
        $category->name = $request->get('name');
        $category->enable = $request->get('enable');

        if (!$category->save()) {
            $response['false'] = false;
            $response['message'] = 'failed to update category';
        }

        return new ResponseResource($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $category = Category::find($id)->delete();
        $response = [
            'status' => true,
            'message' => 'success delete category',
            'data' => [],
        ];

        if (!$category) {
            $response['status'] = false;
            $response['message'] = 'failed to delete category';
        }

        return new ResponseResource($response);
    }
}
