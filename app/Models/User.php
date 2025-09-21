<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'interested_in_training',
        'leads',
        'passing_year',
        'user_status',
        'otp_code',
        'otp_expires_at',
        'mobile_verified_at',
        'signup_source_course_id',
        'signup_source_page_url',
        'signup_source_type',
        'signup_tracked_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'signup_tracked_at' => 'datetime',
        ];
    }

    /**
     * Get the course that generated this signup
     */
    public function signupSourceCourse()
    {
        return $this->belongsTo(Course::class, 'signup_source_course_id');
    }
}
