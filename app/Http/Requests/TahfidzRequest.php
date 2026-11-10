<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TahfidzRequest extends FormRequest
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
            'nilai'                => 'required', 'array',
            'nilai.*.surah'        => 'nullable', 'array',
            'nilai.*.kekurangan'   => 'nullable', 'array',
            'nilai.*.kelebihan'    => 'nullable', 'array',
            'nilai.*.nilai'        => 'nullable', 'numeric', 'min:0', 'max:100',
        ];
    }
}
