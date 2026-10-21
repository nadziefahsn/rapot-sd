<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
     
    public function rules(): array
    {
        return [
            'nis'=> 'required|string|unique:siswas,nis',
            'nisn'=> 'nullable|string',
            'nama_siswa'=> 'required|string',
            'kelas_id'=> 'required|exists:kelas,id',
        ];
    }
}
