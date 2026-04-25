<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:50',
            'floor' => 'nullable|integer|min:0',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            // Host Data
            'host_first_name' => 'required|string|max:255',
            'host_last_name' => 'required|string|max:255',
            'host_phone' => 'required|string|max:20',
            'host_email' => 'required|email|max:255',
            'company_name' => 'required|string|max:255',
            'host_password' => 'required|string|min:8|confirmed',
        ];
    }
}
