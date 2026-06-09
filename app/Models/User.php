<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'group_id'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Связи
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function tasksCreated()
    {
        return $this->hasMany(Task::class, 'teacher_id');
    }

    public function submissions()
    {
        return $this->hasMany(TaskSubmission::class, 'student_id');
    }

    public function checkedSubmissions()
    {
        return $this->hasMany(TaskSubmission::class, 'checked_by');
    }
}