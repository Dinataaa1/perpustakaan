<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    private array $books = [
        [
            'id' => 1,
            'judul' => 'Laravel untuk Pemula',
            'penulis' => 'Andi Pratama',
            'kategori' => 'Programming',
            'tahun' => 2024,
            'stok' => 5,
        ],
        [
            'id' => 2,
            'judul' => 'Belajar PHP Modern',
            'penulis' => 'Budi Santoso',
            'kategori' => 'Programming',
            'tahun' => 2023,
            'stok' => 3,
        ],
    ];

    private array $categories = [
        ['id' => 1, 'nama' => 'Programming'],
        ['id' => 2, 'nama' => 'Novel'],
        ['id' => 3, 'nama' => 'Sains'],
    ];

    public function index()
    {
        $books = $this->books;

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = $this->categories;

        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        return "Detail buku dengan ID: {$id}";
    }

    public function edit(string $id)
    {
        return "Form edit buku dengan ID: {$id}";
    }

    public function update(Request $request, string $id)
    {
        return redirect()
            ->route('books.index')
            ->with('success', "Buku dengan ID {$id} berhasil diperbarui.");
    }

    public function destroy(string $id)
    {
        return redirect()
            ->route('books.index')
            ->with('success', "Buku dengan ID {$id} berhasil dihapus.");
    }
}