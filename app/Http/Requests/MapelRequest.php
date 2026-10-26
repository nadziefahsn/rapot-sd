<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MapelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori' => 'required|string|max:255',
            'mapel'    => 'required|string|max:255',
            'ringkas'  => 'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'kategori.required' => 'Kategori mata pelajaran wajib diisi.',
            'mapel.required'    => 'Nama mata pelajaran wajib diisi.',
        ];
    }
}