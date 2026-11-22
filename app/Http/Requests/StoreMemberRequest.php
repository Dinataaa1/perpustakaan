<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:100',
            'nim' => [
                'required',
                'string',
                'max:20',
                Rule::unique('members', 'nim')->ignore($this->route('member')),
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('members', 'email')->ignore($this->route('member')),
            ],
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama anggota wajib diisi.',
            'nama.max' => 'Nama anggota maksimal 100 karakter.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.max' => 'NIM maksimal 20 karakter.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 100 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.max' => 'Nomor telepon maksimal 15 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status harus berupa aktif atau nonaktif.',
        ];
    }
}
