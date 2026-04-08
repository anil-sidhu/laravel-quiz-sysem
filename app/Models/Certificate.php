<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_id',
        'user_id',
        'student_name',
        'quiz_name',
        'score',
        'issued_at',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'score' => 'integer',
    ];

    /**
     * Get the user that owns the certificate.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a unique certificate ID.
     * Format: SHP-YYYY-XXXXXX (e.g., SHP-2026-A1B2C3)
     */
    public static function generateUniqueId(): string
    {
        do {
            $year = date('Y');
            $random = strtoupper(Str::random(6));
            $certificateId = "SHP-{$year}-{$random}";
        } while (self::where('certificate_id', $certificateId)->exists());

        return $certificateId;
    }

    /**
     * Find certificate by its unique ID.
     */
    public static function findByCertificateId(string $certificateId): ?self
    {
        return self::where('certificate_id', $certificateId)->first();
    }

    /**
     * Check if a certificate exists for a user and quiz.
     */
    public static function existsForUserAndQuiz(int $userId, string $quizName): ?self
    {
        return self::where('user_id', $userId)
            ->where('quiz_name', $quizName)
            ->first();
    }
}
