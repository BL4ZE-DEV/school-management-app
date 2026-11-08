<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResultsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'class_subject_id' => [
                'required',
                'integer',
                'exists:tenant.class_subjects,id',
            ],

            'term_id' => [
                'required',
                'integer',
                'exists:tenant.terms,id',
            ],

            'students' => [
                'required',
                'array',
                'min:1',
            ],

            'students.*.student_enrollment_id' => [
                'required',
                'integer',
                'exists:tenant.student_enrollments,id',
            ],

            'students.*.ca_score' => [
                'required',
                'integer',
                'min:0',
                'max:40',
            ],

            'students.*.exam_score' => [
                'required',
                'integer',
                'min:0',
                'max:60',
            ],
        ];
    }
}