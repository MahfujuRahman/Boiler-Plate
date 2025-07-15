<?php

namespace App\Modules\Management\TestModule\ComprehensiveDataTypeTest\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class DataStoreValidation extends FormRequest
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
            'basic_string' => 'required | sometimes',
            'long_string' => 'required | sometimes',
            'short_string' => 'required | sometimes',
            'description' => 'required | sometimes',
            'long_content' => 'required | sometimes',
            'basic_number' => 'required | sometimes',
            'quantity' => 'required | sometimes',
            'count' => 'required | sometimes',
            'typo_integer' => 'required | sometimes',
            'user_id' => 'required | sometimes',
            'category_id' => 'required | sometimes',
            'priority' => 'required | sometimes',
            'unsigned_count' => 'required | sometimes',
            'unsigned_id' => 'required | sometimes',
            'birth_year' => 'required | sometimes',
            'is_active' => 'required | sometimes',
            'price' => 'required | sometimes',
            'weight' => 'required | sometimes',
            'amount' => 'required | sometimes',
            'birth_date' => 'required | sometimes',
            'created_at_fju' => 'required | sometimes',
            'event_time' => 'required | sometimes',
            'start_time' => 'required | sometimes',
            'last_seen' => 'required | sometimes',
            'metadata' => 'required | sometimes',
            'status_fhdj' => 'required | sometimes',
            'difficulty' => 'required | sometimes',
            'avatar' => 'required | sometimes',
            'document' => 'required | sometimes',
            'binary_data' => 'required | sometimes',
            'identifier' => 'required | sometimes',
            'user_password' => 'required | sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}