<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'destination_id' => 'required|integer',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'duration_days' => 'required|integer'
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return ResponseHelper::error(null, $validator->errors());
    }
}
