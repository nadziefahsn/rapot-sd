<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TahunAjaranRequest extends FormRequest
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
            'tahun_ajaran'      => ['required', 'string'],
            'semester'          => ['required', 'in:Ganjil,Genap'],
            'kepala_sekolah'    => ['required', 'string'],
            'nuptk'             => ['required', 'string'],
            'titimangsa'        => ['required', 'date'],
        ];
    }
}
