<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private array $members = [
        ['id' => 1, 'nama' => 'Ahmad Fauzi', 'nim' => '2024001', 'email' => 'ahmad@univ.ac.id', 'nomor_telepon' => '081234567890', 'alamat' => 'Jl. Merdeka No. 10, Jakarta', 'status' => 'aktif'],
        ['id' => 2, 'nama' => 'Siti Nurhaliza', 'nim' => '2024002', 'email' => 'siti@univ.ac.id', 'nomor_telepon' => '081298765432', 'alamat' => 'Jl. Sudirman No. 25, Bandung', 'status' => 'aktif'],
        ['id' => 3, 'nama' => 'Budi Santoso', 'nim' => '2024003', 'email' => 'budi@univ.ac.id', 'nomor_telepon' => '081312345678', 'alamat' => 'Jl. Pahlawan No. 5, Surabaya', 'status' => 'nonaktif'],
    ];

    public function index()
    {
        $members = $this->members;

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        return redirect()->route('members.index')
            ->with('success', "Anggota \"{$validated['nama']}\" berhasil ditambahkan (data dummy, belum tersimpan ke database).");
    }

    public function show(string $id)
    {
        return "MemberController@show, id: {$id}";
    }

    public function edit(string $id)
    {
        return "MemberController@edit, id: {$id}";
    }

    public function update(Request $request, string $id)
    {
        return "MemberController@update, id: {$id}";
    }

    public function destroy(string $id)
    {
        return "MemberController@destroy, id: {$id}";
    }
}