<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\RejectPaymentRequest;
use App\Http\Requests\SubmitPaymentRequest;
use App\Models\Tenant\StudentFee;
use App\Services\Tenant\PaymentSubmissionService;

class PaymentSubmissionController extends Controller
{
    public function __construct(
        protected PaymentSubmissionService $service
    ) {}

    public function store(SubmitPaymentRequest $request)
    {
        $data = $request->validated();

        $studentFee = StudentFee::findOrFail(
            $data['student_fee_id']
        );

        $path = $request->file('receipt')
            ->store('payment-receipts', 'public');

        $data['receipt_path'] = $path;

        $payment = $this->service->submitPayment(
            $studentFee,
            $data
        );

        return response()->json([
            'message' => 'Payment submitted successfully and is awaiting review.',
            'data' => $payment,
        ], 201);
    }

    public function pending()
    {
        return response()->json(
            $this->service->pendingPayments()
        );
    }

    public function approve($id)
    {
        $payment = $this->service->approve($id);

        return response()->json([
            'message' => 'Payment approved successfully.',
            'data' => $payment,
        ]);
    }

    public function reject(
        RejectPaymentRequest $request,
        $id
    ) {
        $payment = $this->service->reject(
            $id,
            $request->validated()['reason']
        );

        return response()->json([
            'message' => 'Payment rejected.',
            'data' => $payment,
        ]);
    }

    public function history($studentFeeId)
    {
        return response()->json(
            $this->service->paymentHistory(
                $studentFeeId
            )
        );
    }
}