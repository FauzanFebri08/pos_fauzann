<?php

namespace App\Http\Requests\User; // <-- Diubah dari 'user' ke 'User' (kapital)

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_id'  => 'required|exists:roles,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'Nama wajib diisi.',
            'name.max'          => 'Maksimal panjang nama 100 karakter.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email sudah terdaftar.', // <-- Ditambahkan
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal :min karakter.', // <-- Diperbaiki dari 'min. karakter'
            'role_id.required'  => 'Role wajib diisi.',
            'role_id.exists'    => 'Role yang dipilih tidak valid.', // <-- Ditambahkan
        ];
    }
}