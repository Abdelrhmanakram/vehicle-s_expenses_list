<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleExpenseRequest extends FormRequest
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
            'vehicle_name' => 'nullable|string|max:255',
            'type' => 'nullable|array',
            'type.*' => ['string', Rule::in(['fuel', 'insurance', 'service'])],
            'min_cost' => 'nullable|numeric',
            'max_cost' => 'nullable|numeric',
            'min_date' => 'nullable|date',
            'max_date' => 'nullable|date',
            'sort' => ['nullable', Rule::in(['cost', 'created_at'])],
            'direction' => ['nullable', Rule::in(['asc', 'desc'])],
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
    }
}
