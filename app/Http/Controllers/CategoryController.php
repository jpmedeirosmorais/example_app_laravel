<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::simplePaginate());
    }

    public function store(CategoryRequest $request)
    {
        return new CategoryResource(Category::create([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-')
        ]));
    }

    public function show(string $id)
    {
        return new CategoryResource(Category::findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        return new CategoryResource(Category::findOrFail($id)->update($request->all()));
    }

    public function destroy(string $id)
    {
        return new CategoryResource(Category::findOrFail($id)->delete());
    }
}
