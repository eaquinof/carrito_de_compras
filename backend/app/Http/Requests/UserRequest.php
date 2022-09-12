<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => 'required',
          'email' => 'required',
          'password' => 'required'
        ];
    }

    public function messages()
    {
      return [
        'name.required' => ':attribute is required.',
        'email.required' => ':attribute is required.',
        'password.required' => ':attribute is required.',
      ];
    }

    public function failedValidation(ValidationValidator $validator)
    {
        //write your bussiness logic here otherwise it will give same old JSON response
       throw new HttpResponseException(response()->json(["errors"=> $validator->errors()], 422));
    }
}
