<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => ['string', 'min:10', 'max:255'],
            'article' => ['string', 'alpha_num:ascii', 'min:10', 'unique:products,article,' . $this->route('id')],
            'status' => ['string', 'in:available,unavailable'],
            'data' => ['json']
        ];
    }
}
