<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class OwnerRequest extends FormRequest
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
        $ownerId = $this->route('owner') ? $this->route('owner')->id : null;

        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:owners,email,' . $ownerId,
            'address' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('site.name_required'),
            'surname.required' => __('site.surname_required'),
            'phone.required' => __('site.phone_required'),
            'email.required' => __('site.email_required'),
            'email.email' => __('site.email_email'),
            'email.unique' => __('site.email_unique'),
            'address.required' => __('site.address_required'),
        ];
    }

}
