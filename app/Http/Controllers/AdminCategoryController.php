<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('admin');

        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('admin');
        return view('dashboard.categories.create', [
            'title' => 'Tambah Kategori Baru'
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('admin');

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name'
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            Category::create($validated);

            return redirect()->route('administrator.category.index')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('admin');

        return view('dashboard.categories.edit', [
            'title' => 'Edit Kategori',
            'category' => $category
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('admin');

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            $category->update($validated);

            return redirect()->route('administrator.category.index')->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('admin');

        try {
            $category->delete();

            return redirect()->route('administrator.category.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('administrator.category.index')->with('error', 'Gagal menghapus kategori: ' . $th->getMessage());
        }
    }
}
