<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'transaction_id',
        'amount',
        'currency',
        'payment_method',
        'status',
        'payment_details',
        'gateway_response',
        'gateway_name',
        'failure_reason',
        'processed_at',
        'refunded_at',
        'refund_amount',
        'refund_reason'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'refund_amount' => 'decimal:2',
        'payment_details' => 'array',
        'gateway_response' => 'array',
        'processed_at' => 'datetime',
        'refunded_at' => 'datetime'
    ];

    // Payment status constants
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';
    const STATUS_REFUNDED = 'refunded';
    const STATUS_CANCELLED = 'cancelled';

    // Payment method constants
    const METHOD_CREDIT_CARD = 'credit_card';
    const METHOD_DEBIT_CARD = 'debit_card';
    const METHOD_PAYPAL = 'paypal';
    const METHOD_BANK_TRANSFER = 'bank_transfer';
    const METHOD_CRYPTO = 'crypto';

    /**
     * Get the booking associated with the payment
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Check if payment is successful
     */
    public function isSuccessful(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Check if payment is pending
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if payment is failed
     */
    public function isFailed(): bool
    {
        return $this->status === self::STATUS_FAILED;
    }

    /**
     * Check if payment is refunded
     */
    public function isRefunded(): bool
    {
        return $this->status === self::STATUS_REFUNDED;
    }

    /**
     * Check if payment can be refunded
     */
    public function canBeRefunded(): bool
    {
        return $this->isSuccessful() && !$this->isRefunded();
    }

    /**
     * Get the refundable amount
     */
    public function getRefundableAmount(): float
    {
        return (float) $this->amount - (float) $this->refund_amount;
    }

    /**
     * Mark payment as completed
     */
    public function markAsCompleted(): bool
    {
        return $this->update([
            'status' => self::STATUS_COMPLETED,
            'processed_at' => now()
        ]);
    }

    /**
     * Mark payment as failed
     */
    public function markAsFailed(string $reason = null): bool
    {
        return $this->update([
            'status' => self::STATUS_FAILED,
            'failure_reason' => $reason
        ]);
    }

    /**
     * Process refund
     */
    public function processRefund(float $amount = null, string $reason = null): bool
    {
        $refundAmount = $amount ?? $this->amount;

        if ($refundAmount > $this->getRefundableAmount()) {
            throw new \Exception('Refund amount exceeds available balance');
        }

        return $this->update([
            'status' => $refundAmount === $this->amount ? self::STATUS_REFUNDED : $this->status,
            'refund_amount' => (float) $this->refund_amount + $refundAmount,
            'refund_reason' => $reason,
            'refunded_at' => now()
        ]);
    }

    /**
     * Get masked card number for display
     */
    public function getMaskedCardNumber(): ?string
    {
        $details = $this->payment_details;

        if (isset($details['card_last_four'])) {
            return '**** **** **** ' . $details['card_last_four'];
        }

        return null;
    }

    /**
     * Get payment method display name
     */
    public function getPaymentMethodDisplayName(): string
    {
        return match ($this->payment_method) {
            self::METHOD_CREDIT_CARD => 'Credit Card',
            self::METHOD_DEBIT_CARD => 'Debit Card',
            self::METHOD_PAYPAL => 'PayPal',
            self::METHOD_BANK_TRANSFER => 'Bank Transfer',
            self::METHOD_CRYPTO => 'Cryptocurrency',
            default => ucfirst(str_replace('_', ' ', $this->payment_method))
        };
    }

    /**
     * Scope completed payments
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope failed payments
     */
    public function scopeFailed($query)
    {
        return $query->where('status', self::STATUS_FAILED);
    }

    /**
     * Scope pending payments
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope by payment method
     */
    public function scopeByMethod($query, $method)
    {
        return $query->where('payment_method', $method);
    }

    /**
     * Scope payments within date range
     */
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Get total revenue for a period
     */
    public static function getRevenue($startDate = null, $endDate = null): float
    {
        $query = self::completed();

        if ($startDate && $endDate) {
            $query->betweenDates($startDate, $endDate);
        }

        return (float) $query->sum('amount');
    }

    /**
     * Get payment statistics
     */
    public static function getStatistics($startDate = null, $endDate = null): array
    {
        $query = self::query();

        if ($startDate && $endDate) {
            $query->betweenDates($startDate, $endDate);
        }

        return [
            'total_payments' => $query->count(),
            'completed_payments' => $query->completed()->count(),
            'failed_payments' => $query->failed()->count(),
            'pending_payments' => $query->pending()->count(),
            'total_revenue' => self::getRevenue($startDate, $endDate),
            'average_payment' => $query->completed()->avg('amount') ?? 0,
        ];
    }
}
