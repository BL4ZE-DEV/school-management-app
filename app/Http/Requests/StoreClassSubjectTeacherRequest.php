<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassSubjectTeacherRequest extends FormRequest
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
            'class_subject_id' => ['required', 'integer', 'exists:class_subjects,id'],
            'teacher_id' => ['required', 'integer', 'exists:teachers,id'],
            'term_id' => ['required', 'integer', 'exists:tenant.terms,id'],
        ];
    }
}
