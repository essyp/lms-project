<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'phone_number',
        'email',
        'fullname',
        'state',
        'lga',
        'address',
        'gender',
        'parent_name',
        'ref',
        'password',
        'student_no',
    ];
}