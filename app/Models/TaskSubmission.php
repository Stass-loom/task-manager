<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id', 'student_id', 'status', 'comment', 'checked_by', 'checked_at', 'teacher_comment'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'checked_at' => 'datetime',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function checker()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }
}