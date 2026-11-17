<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeskripsiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'kelas_id'  => 'required|exists:kelas,id',
            'mapel_id'  => 'required|exists:mapels,id',
            'deskripsi' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'kelas_id.required' => 'Kelas wajib dipilih.',
            'kelas_id.exists'   => 'Kelas yang dipilih tidak valid.',
            'mapel_id.required' => 'Mata pelajaran wajib dipilih.',
            'mapel_id.exists'   => 'Mata pelajaran yang dipilih tidak valid.',
        ];
    }
}