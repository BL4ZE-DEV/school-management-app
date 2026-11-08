<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmitStudentRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required','email','max:255','unique:tenant.tenant_users,email'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => ['required', 'string', 'max:50'],
            'dob' => ['required', 'date', 'before:today'],
            'school_class_id' => ['required','integer','exists:tenant.school_classes,id'],
            'academic_session_id' => ['required','integer','exists:tenant.academic_sessions,id'],
            'enrollment_date' => ['required', 'date'],
        ];
    }
}
