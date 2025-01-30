<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'gender',
        'birth_date',
        'address',
        'phone',
        'active',
        'registration_date',
        'last_attendance_date',
    ];
}
