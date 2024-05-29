<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'barcode'        => 'nullable|string|max:50',
            'category_id'    => 'required|exists:categories,id',
            'cost_price'     => 'required|numeric|min:0',
            'sale_price'     => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'unit'           => 'nullable|string|max:50',
            'stock_min'      => 'nullable|integer|min:0',
            'supplier_id'    => 'required|exists:suppliers,id',
        ];

        // Se o método HTTP for PATCH ou PUT, transforme as regras 'required' em 'sometimes'
        if ($this->isMethod('PATCH') || $this->isMethod('PUT')) {
            $rules = array_map(function ($rule) {
                return str_replace('required', 'sometimes', $rule);
            }, $rules);
        }

        return $rules;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data'    => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
