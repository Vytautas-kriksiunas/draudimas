<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
        $carId = $this->route('car') ? $this->route('car')->id : null;

        return [
            'reg_number' => 'required|unique:cars,reg_number,' . $carId . '|regex:/^[A-Z]{3}[0-9]{3}$/',
            'brand' => 'required',
            'model' => 'required',
            'owner_id' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'reg_number.required' => __('site.reg_number_required'),
            'reg_number.unique' => __('site.reg_number_unique'),
            'reg_number.regex' => __('site.reg_number_regex'),
            'brand.required' => __('site.brand_required'),
            'model.required' => __('site.model_required'),
            'owner_id.required' => __('site.owner_required'),
        ];
    }
}
