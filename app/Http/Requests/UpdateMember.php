<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMember extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nik' => [
                'required',
                Rule::unique('anggota')->ignore($this->member),
                'max:16'
            ],
            'nama' => 'required',
            'email' => [
                'nullable',
                'required',
                Rule::unique('anggota')->ignore($this->member),
                'max:35'
            ],
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => [
                'required',
                Rule::unique('anggota')->ignore($this->member),
                'max:20'
            ],
            'jenkel' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
        ];
    }
}
