<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'created_by_admin_id',
        'admin_assigned_at'
    ];

    protected function casts(): array
    {
        return [
            'admin_assigned_at' => 'datetime',
        ];
    }

    /**
     * Get the admin who created this course
     */
    public function createdByAdmin()
    {
        return $this->belongsTo(Admin::class, 'created_by_admin_id');
    }

    /**
     * Get all users who signed up from this course
     */
    public function signupLeads()
    {
        return $this->hasMany(User::class, 'signup_source_course_id');
    }

    /**
     * Get users who showed interest in training from this course
     */
    public function interestedLeads()
    {
        return $this->hasMany(User::class, 'signup_source_course_id')
                    ->where('interested_in_training', 'yes');
    }
}
