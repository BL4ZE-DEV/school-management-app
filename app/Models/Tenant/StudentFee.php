<?php

namespace App\Models\Tenant;

class StudentFee extends TenantModel
{
    protected $fillable = [
        'student_enrollment_id',
        'fee_structure_id',
        'amount_due',
    ];

    protected $casts = [
        'amount_due' => 'decimal:2',
    ];

    protected $appends = [
        'approved_total',
        'pending_total',
        'balance',
        'is_cleared',
    ];

    public function studentEnrollment()
    {
        return $this->belongsTo(StudentEnrollment::class);
    }

    public function feeStructure()
    {
        return $this->belongsTo(FeeStructure::class);
    }

    public function paymentSubmissions()
    {
        return $this->hasMany(PaymentSubmission::class);
    }

    public function getApprovedTotalAttribute()
    {
        return $this->paymentSubmissions()
            ->where('status', 'approved')
            ->sum('amount');
    }

    public function getPendingTotalAttribute()
    {
        return $this->paymentSubmissions()
            ->where('status', 'pending')
            ->sum('amount');
    }

    public function getBalanceAttribute()
    {
        $balance = $this->amount_due - $this->approved_total;

        return max($balance, 0);
    }

    public function getIsClearedAttribute()
    {
        return $this->balance <= 0;
    }
}