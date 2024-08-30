<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            "name" => ["required"],
            "users_id" => ["required", "exists:users,id"],
            "categories_id" => ["required", "exists:categories,id"], // Jangan lupa untuk mengubah nama tabel jika perlu
            "price" => ["required", "integer"],
            "description" => ["required"]
        ];
    }
}
