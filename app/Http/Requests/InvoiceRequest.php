<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'postal_zip' => 'required|string',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name field is required',
            'phone.required' => 'Phone field is required',
            'email.required' => 'Email field is required',
            'address.required' => 'Address field is required',
            'country.required' => 'Country field is required',
            'city.required' => 'City field is required',
            'postal_zip.required' => 'Postal/Zip field is required',
        ];
    }
}
