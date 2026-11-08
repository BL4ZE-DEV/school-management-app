<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassSubjectRequest extends FormRequest
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
            'class_id' => ['sometimes', 'required', 'integer', 'exists:tenant.school_classes,id'],
            'subject_id' => ['sometimes', 'required', 'integer', 'exists:tenant.subjects,id'],
            'academic_session_id' => ['sometimes', 'required', 'integer', 'exists:tenant.academic_sessions,id'],
        ];
    }
}
