<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfilesConentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'infor' => 'required|array',
            'infor.address' => 'required|string',
            'infor.birthday_inder' => 'required|string',
            'infor.day' => 'required|string',
            'infor.email' => 'required|string',
            'infor.full_name' => 'required|string',
            'infor.month' => 'required|string',
            'infor.gender' => 'required|string',
            'infor.phone_number' => 'required|string',
            'infor.year' => 'required|string',
            'infor.work_experience' => 'required|string',

            'content' => 'nullable|array',
            'content.*.title' => 'nullable|string',
            'content.*.description' => 'nullable|string',
            'content.*.icon' => 'nullable|string',
            'content.*.order_number' => 'required|integer',

            'list_link_social' => 'nullable|array',
            'list_link_social.*.icon' => 'nullable|string',
            'list_link_social.*.title' => 'nullable|string',
            'list_link_social.*.link' => 'nullable|string',
            'list_link_social.*.order_number' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'body.required' => 'A message is required',
        ];
    }
}
