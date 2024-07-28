<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string',
            'unit' => 'nullable|string',
            'unit_value' => 'nullable|string|',
            'selling_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'discount' => 'nullable|numeric|max:100|min:0',
            'tax' => 'nullable|numeric|max:100|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'variations.*.purchase_price' => 'nullable|numeric',
            'variations.*.selling_price' => 'nullable|numeric',
            'variations.*.attributes.*.name' => 'nullable|string',
            'variations.*.attributes.*.value' => 'nullable|string',
        ];
    }
}
