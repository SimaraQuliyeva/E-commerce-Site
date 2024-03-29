<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'c_name'=>'required|string',
            'c_email'=>'required|email',
            'c_subject'=>'required',
            'c_message'=>'required'
        ];
    }

    public function messages(): array
    {
        return [
            'c_name.required'=>'Fill your Name',
            'c_name.string'=>'Please enter A-Z, 0-9 characters',
            'c_name.min'=>'Name must be 4 character',
            'c_email.required'=>'Fill your Email',
            'c_subject.required'=>'Fill Subject',
            'c_message.required'=>'Please, write your message',
        ];
    }
}
