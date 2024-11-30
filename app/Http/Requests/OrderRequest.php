<?php

namespace App\Http\Requests;

class OrderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'products' => 'required|array',
            'products.*.product_id' => 'required|int|exists:products,id',
            'products.*.quantity' => 'required|int|min:1'
        ];
    }
}
