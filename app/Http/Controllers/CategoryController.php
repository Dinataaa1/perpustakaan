<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private array $categories = [
        [
            'id' => 1,
            'nama' => 'Programming',
        ],
        [
            'id' => 2,
            'nama' => 'Novel',
        ],
        [
            'id' => 3,
            'nama' => 'Sains',
        ],
    ];

    public function index()
    {
        $categories = $this->categories;

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        return "Form edit kategori dengan ID: {$id}";
    }

    public function update(Request $request, string $id)
    {
        return redirect()
            ->route('categories.index')
            ->with('success', "Kategori dengan ID {$id} berhasil diperbarui.");
    }

    public function destroy(string $id)
    {
        return redirect()
            ->route('categories.index')
            ->with('success', "Kategori dengan ID {$id} berhasil dihapus.");
    }
}