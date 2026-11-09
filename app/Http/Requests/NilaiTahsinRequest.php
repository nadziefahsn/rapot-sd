<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NilaiTahsinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mapel_id'             => 'nullable|exists:mapels,id',
            'tahsin'               => 'required|array',
            'tahsin.*.jilid'      => 'nullable|string',
            'tahsin.*.halaman'    => 'nullable|string|max:100',
            'tahsin.*.nilai'      => 'nullable|numeric|min:0|max:100',
            'tahsin.*.kekurangan' => 'nullable|array',
            'tahsin.*.kelebihan'  => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'mapel_id.exists'         => 'Mata pelajaran Tahsin tidak ditemukan di database.',
            'tahsin.required'         => 'Data penilaian Tahsin tidak boleh kosong.',
            'tahsin.array'            => 'Format data penilaian Tahsin tidak valid.',
            'tahsin.*.nilai.numeric'  => 'Nilai Tahsin harus berupa angka.',
            'tahsin.*.nilai.min'      => 'Nilai Tahsin minimal adalah 0.',
            'tahsin.*.nilai.max'      => 'Nilai Tahsin maksimal adalah 100.',
            'tahsin.*.halaman.max'    => 'Input Halaman/Surah terlalu panjang (maksimal 100 karakter).',
            'tahsin.*.kekurangan.array' => 'Pilihan kekurangan harus berupa daftar item valid.',
            'tahsin.*.kelebihan.array'  => 'Pilihan kelebihan harus berupa daftar item valid.',
        ];
    }
}