<?php

namespace App\Services\Tenant;

use App\Models\Tenant\PaymentSubmission;
use App\Models\Tenant\StudentFee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentSubmissionService
{
    public function submitPayment(
        StudentFee $studentFee,
        array $data
    ) {
        return PaymentSubmission::create([
            'student_fee_id' => $studentFee->id,
            'amount' => $data['amount'],
            'payment_date' => $data['payment_date'],
            'payment_reference' => $data['payment_reference'] ?? null,
            'receipt_path' => $data['receipt_path'],
            'status' => 'pending',
        ]);
    }

    public function pendingPayments()
    {
        return PaymentSubmission::with([
            'studentFee.studentEnrollment.student.user',
            'studentFee.studentEnrollment.schoolClass',
            'studentFee.feeStructure',
        ])
        ->where('status', 'pending')
        ->latest()
        ->get();
    }

    public function approve(int $paymentId)
    {
        return DB::transaction(function () use ($paymentId) {

            $payment = PaymentSubmission::lockForUpdate()
                ->findOrFail($paymentId);

            if ($payment->status !== 'pending') {
                throw new \Exception(
                    'This payment has already been reviewed.'
                );
            }

            $payment->update([
                'status' => 'approved',
                'reviewed_by' => Auth::guard('tenant')->id(),
                'reviewed_at' => now(),
                'rejection_reason' => null,
            ]);

            return $payment->fresh([
                'studentFee',
            ]);
        });
    }

    public function reject(
        int $paymentId,
        string $reason
    ) {
        return DB::transaction(function () use (
            $paymentId,
            $reason
        ) {

            $payment = PaymentSubmission::lockForUpdate()
                ->findOrFail($paymentId);

            if ($payment->status !== 'pending') {
                throw new \Exception(
                    'This payment has already been reviewed.'
                );
            }

            $payment->update([
                'status' => 'rejected',
                'reviewed_by' => Auth::guard('tenant')->id(),
                'reviewed_at' => now(),
                'rejection_reason' => $reason,
            ]);

            return $payment->fresh();
        });
    }

    public function paymentHistory(int $studentFeeId)
    {
        return PaymentSubmission::where(
            'student_fee_id',
            $studentFeeId
        )
        ->latest('payment_date')
        ->get();
    }
}