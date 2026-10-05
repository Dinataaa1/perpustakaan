<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
 public function rules(): array
{
    return [
        'nama' => ['required', 'string', 'max:100'],

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

        'nomor_telepon' => ['required', 'string', 'max:15'],
        'alamat' => ['required', 'string'],
        'status' => ['required', 'in:aktif,nonaktif'],
    ];
}
}
