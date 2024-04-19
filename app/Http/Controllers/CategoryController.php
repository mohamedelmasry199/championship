<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        // return response()->json($categories);
        return view('welcome',compact('categories'));
    }
    public function displayMedia($id)
    {
        $category = Category::findOrFail($id);

        // return response()->json($categories);
        return view('media',compact('category'));
    }

    public function subcategories($id)
    {
        $category = Category::with('children')->find($id);
        return response()->json($category->children);
    }





    public function showUpdates()
    {
        $categoryUpdates = DB::table('categories as c1')
            ->leftJoin('categories as c2', 'c1.parent_id', '=', 'c2.id')
            ->select('c1.name', 'c1.updated_at', 'c2.name as parent_name')
            ->whereNotNull('c1.updated_at')
            ->orderBy('c1.updated_at', 'desc')
            ->get();

        $imageUpdates = DB::table('images')
            ->join('categories', 'images.category_id', '=', 'categories.id')
            ->select('categories.name as parent_name', 'images.name', 'images.updated_at')
            ->whereNotNull('images.updated_at')
            ->orderBy('images.updated_at', 'desc')
            ->get();

        // Merge updates from both tables
        $updates = $categoryUpdates->merge($imageUpdates)->sortByDesc('updated_at');

        return view('updates', compact('updates'));
    }

}
