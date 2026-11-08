<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitPaymentRequest extends FormRequest
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
// SubmitPaymentRequest
    public function rules(): array
    {
        return [
            'student_fee_id' => [
                'required',
                'exists:tenant.student_fees,id',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:1',
            ],
            'payment_date' => [
                'required',
                'date',
            ],
            'payment_reference' => [
                'nullable',
                'string',
                'max:255',
            ],
            'receipt' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:5120',
            ],
        ];
    }
}
