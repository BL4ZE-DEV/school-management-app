<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeStructureRequest extends FormRequest
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
// StoreFeeStructureRequest
    public function rules(): array
    {
    return [
        'academic_session_id' => [
            'required',
            'exists:tenant.academic_sessions,id',
        ],
        'school_class_id' => [
            'required',
            'exists:tenant.school_classes,id',
        ],
        'term_id' => [  
            'required',
            'exists:tenant.terms,id',
        ],
        'amount' => [
            'required',
            'numeric',
            'min:0',
        ],
        'description' => [
            'required',
            'string',
            'max:255',
        ],
    ];
    }
}
