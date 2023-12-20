<?php

namespace App\Http\Controllers;

use App\Models\CategoryService;
use App\Models\TypeService;
use Illuminate\Http\Request;

class CategoryServiceController extends Controller
{
    public function index()
    {
        return CategoryService::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);

        return CategoryService::create($data);
    }

    public function show(CategoryService $categoryService)
    {
        return $categoryService;
    }

    public function update(Request $request, CategoryService $categoryService)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);

        $categoryService->update($data);

        return $categoryService;
    }

    public function destroy(CategoryService $categoryService)
    {
        $categoryService->delete();

        return response()->json();
    }
}
