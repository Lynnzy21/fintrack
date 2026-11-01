<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Import Facade

class CategoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $categories = Category::where('user_id', $userId)->get();
        
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'color' => 'nullable|string|max:7',
        ]);

        Category::create([
            'user_id' => $userId,
            'name' => $request->name,
            'type' => $request->type,
            'color' => $request->color,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        $userId = Auth::id();

        if ($category->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $userId = Auth::id();

        if ($category->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'color' => 'nullable|string|max:7',
        ]);

        $category->update([
            'name' => $request->name,
            'type' => $request->type,
            'color' => $request->color,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy(Category $category)
    {
        $userId = Auth::id();

        if ($category->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        $category->delete();
        
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}