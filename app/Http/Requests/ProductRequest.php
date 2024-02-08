<?php

namespace App\Http\Requests;

use App\Models\Enums\StatusProduct;
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
            'name' => ['required', 'max:50', 'string'],
            'category_id' => ['required', 'exists:App\Models\Category,id'],
            'price' => ['required', 'decimal:2'],
            'description' => ['string', 'max: 255'],
            'status' => [Rule::enum(StatusProduct::class)]
        ];
    }
}
