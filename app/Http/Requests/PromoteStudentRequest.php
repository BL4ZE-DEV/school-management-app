<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromoteStudentRequest extends FormRequest
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
            'current_enrollment_id' => ['required','integer','exists:tenant.student_enrollments,id'],

            'new_school_class_id' => ['required','integer','exists:tenant.school_classes,id',],

            'new_academic_session_id' => ['required','integer','exists:tenant.academic_sessions,id',],

            'enrollment_date' => ['required','date',],
        ];
    }
}
