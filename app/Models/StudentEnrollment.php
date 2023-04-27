<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'student_no',
        'previous_class_id',
        'previous_class_code',
        'previous_class_name',
        'next_class_id',
        'next_class_code',
        'next_class_name',
    ];

    public function student() {
        return $this->belongsTo(Student::class, "student_id");
    }
}