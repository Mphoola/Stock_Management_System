<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if($this->isMethod('post')) {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ];
        } else {
            return [
                'name' => 'required|string|max:255',
            ];
        }

    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response =  response()->json([
            'status' => false,
            'message' => 'validation error',
            'errors' =>  $errors->messages()
        ], 422);
        throw new HttpResponseException($response);
    }
}
