<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'nama_depan.required' => 'nama depan harus di isi',
            'nama_belakang.required' => 'nama belakang harus di isi',
            'alamat.required' => 'alamat harus di isi',
            'pekerjaan.required' => 'pekerjaan harus di isi'
        ];
    }
}