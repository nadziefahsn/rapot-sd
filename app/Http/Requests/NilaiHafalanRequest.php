<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class NilaiHafalanRequest extends FormRequest
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
            'nilai'   => 'required|array',
            'nilai.*' => 'nullable|array',
            'nilai.*.*' => 'nullable|integer|min:0|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nilai.required'       => 'Data nilai tidak boleh kosong.',
            'nilai.*.*.integer'    => 'Nilai hafalan harus berupa angka.',
            'nilai.*.*.min'        => 'Nilai hafalan minimal 0.',
            'nilai.*.*.max'        => 'Nilai hafalan maksimal 100.',
        ];
    }
}
