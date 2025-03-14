<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

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
        'group_id',
        'name',
        'gender',
        'birth_date',
        'address',
        'phone',
        'active',
        'registration_date',
        'last_attendance_date',
    ];

    public function group()
    {
        return $this->belongsTo(StudentGroup::class, 'group_id', 'id');
    }

    public static function getActiveCount()
    {
        return DB::select("SELECT COUNT(0) as `count` FROM students WHERE active=1")[0]->count;
    }
}
