<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Coach extends Model
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
    ];

    public static function getActiveCount()
    {
        return DB::select("SELECT COUNT(0) as `count` FROM `coaches` WHERE `active`=1")[0]->count;
    }
}
