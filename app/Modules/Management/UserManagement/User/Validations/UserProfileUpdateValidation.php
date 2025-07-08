<?php

namespace App\Modules\Management\UserManagement\User\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserProfileUpdateValidation extends FormRequest
{
    /**
     * Determine if the  is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * validateError to make this request.
     */
    public function validateError($data)
    {
        $errorPayload =  $data->getMessages();
        return response(['status' => 'validation_error', 'errors' => $errorPayload], 422);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validateError($validator->errors()));
        if ($this->wantsJson() || $this->ajax()) {
            throw new HttpResponseException($this->validateError($validator->errors()));
        }
        parent::failedValidation($validator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required | sometimes',
            'last_name' => 'required | sometimes',
            'user_name' => 'required | sometimes',
            'state' => 'required | sometimes',
            'city' => 'required | sometimes',
            'post' => 'required | sometimes',
            'country' => 'required | sometimes',
            'image' => 'nullable | sometimes',
            'email' => 'required | sometimes', Rule::unique('users', 'email')->ignore(auth()->user()->id),
            'phone_number' => 'required | sometimes',
            'address' => 'nullable | sometimes',
        ];
    }
}
