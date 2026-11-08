<?php

namespace App\Models\Tenant;

class PaymentSubmission extends TenantModel
{
    protected $fillable = [
        'student_fee_id',
        'amount',
        'payment_date',
        'payment_reference',
        'receipt_path',
        'status',
        'reviewed_by',
        'reviewed_at',
        'rejection_reason',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
        'reviewed_at' => 'datetime',
    ];

    public function studentFee()
    {
        return $this->belongsTo(StudentFee::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(
            TenantUser::class,
            'reviewed_by'
        );
    }
}