<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarkAttendanceRequest extends FormRequest
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
            'date' => [
                'required',
                'date',
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

            'students.*.status' => [
                'required',
                'string',
                'in:Present,Absent,Late',
            ],
        ];
    }
}
