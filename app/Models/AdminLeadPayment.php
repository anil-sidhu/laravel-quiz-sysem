<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLeadPayment extends Model
{
    protected $fillable = [
        'admin_id',
        'user_id',
        'course_id',
        'lead_value',
        'commission_rate',
        'commission_amount',
        'payment_status',
        'lead_quality',
        'lead_generated_at',
        'payment_due_at',
        'paid_at',
        'notes'
    ];

    protected function casts(): array
    {
        return [
            'lead_value' => 'decimal:2',
            'commission_rate' => 'decimal:2',
            'commission_amount' => 'decimal:2',
            'lead_generated_at' => 'datetime',
            'payment_due_at' => 'datetime',
            'paid_at' => 'datetime',
        ];
    }

    /**
     * Get the admin who earned this commission
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the user/lead that generated this payment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course that generated this lead
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Calculate commission amount based on lead value and rate
     */
    public static function calculateCommission($leadValue, $commissionRate)
    {
        return round(($leadValue * $commissionRate) / 100, 2);
    }

    /**
     * Create a lead payment record
     */
    public static function createLeadPayment($adminId, $userId, $courseId, $leadValue = 50.00, $leadQuality = 'signup')
    {
        $admin = Admin::find($adminId);
        if (!$admin) return null;

        $commissionAmount = self::calculateCommission($leadValue, $admin->commission_rate);

        return self::create([
            'admin_id' => $adminId,
            'user_id' => $userId,
            'course_id' => $courseId,
            'lead_value' => $leadValue,
            'commission_rate' => $admin->commission_rate,
            'commission_amount' => $commissionAmount,
            'payment_status' => 'pending',
            'lead_quality' => $leadQuality,
            'lead_generated_at' => now(),
            'payment_due_at' => now()->addDays(30), // Payment due in 30 days
        ]);
    }
}
