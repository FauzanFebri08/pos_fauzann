<?php

namespace App\Http\Requests\Produk;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'jenis_id'       => 'required|exists:jenis,id',
            'name'           => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0|gt:purchase_price',
            'stok'           => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'foto.image'             => 'File yang diunggah harus berupa gambar.',
            'foto.mimes'             => 'Ekstensi gambar harus JPG, JPEG, atau PNG.',
            'foto.max'               => 'Ukuran gambar maksimal 2MB.',
            
            'jenis_id.required'      => 'Jenis produk wajib dipilih.',
            'jenis_id.exists'        => 'Jenis produk tidak valid.',

            'name.required'          => 'Nama produk wajib diisi.',
            'name.max'               => 'Maksimal panjang nama produk 255 karakter.',
            
            'purchase_price.required'=> 'Harga beli wajib diisi.',
            'purchase_price.numeric' => 'Harga beli harus berupa angka.',
            'purchase_price.min'     => 'Harga beli tidak boleh kurang dari 0.',
            
            'selling_price.required' => 'Harga jual wajib diisi.',
            'selling_price.numeric'  => 'Harga jual harus berupa angka.',
            'selling_price.min'      => 'Harga jual tidak boleh kurang dari 0.',
            'selling_price.gt'       => 'Harga jual harus lebih besar dari harga beli.',
            
            'stok.required'          => 'Stok wajib diisi.',
            'stok.integer'           => 'Stok harus berupa bilangan bulat.',
            'stok.min'               => 'Stok tidak boleh kurang dari 0.',
        ];
    }
}