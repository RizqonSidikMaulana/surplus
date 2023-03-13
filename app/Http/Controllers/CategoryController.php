<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $response = [
            'status' => true,
            'message' => 'success',
            'data' => Category::where('enable', '=', true)->paginate(15)
        ];

        return new CategoryResource($response);
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

        return new CategoryResource($response);
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

        $category = Category::where('id', '=', $id)->where('enable', '=', true)->get();
        $response['data'] = $category;

        if (!$category->toArray()) {
            return response()->json([
                'data' => [],
                'message' => 'Data not found'
            ], 404);
        }

        return new CategoryResource($response);
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

        return new CategoryResource($response);
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

        return new CategoryResource($response);
    }
}
