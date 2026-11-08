<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassSubjectTeacherRequest extends FormRequest
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
            'class_subject_id' => ['sometimes', 'required', 'integer', 'exists:tenant.class_subjects,id'],
            'teacher_id' => ['sometimes', 'required', 'integer', 'exists:tenant.teachers,id'],
            'term_id' => ['sometimes', 'required', 'integer', 'exists:tenant.terms,id'],
        ];
    }
}
