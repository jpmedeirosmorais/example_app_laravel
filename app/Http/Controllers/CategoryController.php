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
        return new CategoryResource(Category::all());
    }

    public function store(CategoryRequest $request)
    {
        return Category::create($request->getValues());
    }

    public function show(string $id)
    {
        return Category::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        return Category::findOrFail($id)->update($request->all());
    }

    public function destroy(string $id)
    {
        return Category::findOrFail($id)->delete();
    }
}
