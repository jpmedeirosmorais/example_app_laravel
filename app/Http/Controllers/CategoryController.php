<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try{
            $categories = Category::all();
            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'slug' => 'required|string|unique:categories'
            ]);

            $category = new Category($data);

            $category->save();

            return response()->json($category);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json($category);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'slug' => 'required|string|unique:categories,slug,' . $id,
            ]);

            $category = Category::findOrFail($id);
            $category->update($data);

            return response()->json($category, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json([
                'message' => 'Category deleted',
                'id' => $category->id
            ], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
