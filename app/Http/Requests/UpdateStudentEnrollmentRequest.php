<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentEnrollmentRequest extends FormRequest
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
            'student_id' => ['sometimes', 'required', 'integer', 'exists:tenant.students,id'],
            'school_class_id' => ['sometimes', 'required', 'integer', 'exists:tenant.school_classes,id'],
            'academic_session_id' => ['sometimes', 'required', 'integer', 'exists:tenant.academic_sessions,id'],
            'enrollment_date' => ['sometimes', 'required', 'date'],
            'status' => ['sometimes', 'required', 'string', 'max:50'],
        ];
    }
}
