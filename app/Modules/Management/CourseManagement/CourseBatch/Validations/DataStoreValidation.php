<?php

namespace App\Modules\Management\CourseManagement\CourseBatch\Validations;

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
            'course_id' => 'required | sometimes',
            'batch_name' => 'required | sometimes',
            'admission_start_date' => 'required | sometimes',
            'admission_end_date' => 'required | sometimes',
            'batch_student_limit' => 'required | sometimes',
            'seat_booked' => 'required | sometimes',
            'booked_percent' => 'required | sometimes',
            'course_price' => 'required | sometimes',
            'course_discount' => 'required | sometimes',
            'after_discount_price' => 'required | sometimes',
            'first_class_date' => 'required | sometimes',
            'class_days' => 'required | sometimes',
            'class_start_time' => 'required | sometimes',
            'class_end_time' => 'required | sometimes',
            'show_percentage_on_cards' => 'required | sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}