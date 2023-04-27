<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
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
        'title',
        'ref',
        'password',
        'staff_no',
        'role_id',
        'position',
    ];

    public function role() {
        return $this->belongsTo(StaffRole::class, "role_id");
    }
}