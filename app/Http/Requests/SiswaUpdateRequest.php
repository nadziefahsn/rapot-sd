<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
     
    public function rules(): array
    {
        return [
            'nisn'=> 'nullable|string',
            'nama_siswa'=> 'required|string',
            'kelas_id'=> 'required|exists:kelas,id',
        ];
    }
}
