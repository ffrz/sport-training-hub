<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    const ROLE_ADMIN = 'admin';
    const ROLE_COACH = 'coach';
    const ROLE_PLAYER = 'player';
    const ROLE_OWNER = 'owner';
    const ROLE_TECHNICAL_MANAGER = 'technical_manager';
    const ROLE_GENERAL_MANAGER = 'general_manager';

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'active',
        'password',
        'role',
        'email_verified_at',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        ];

    }

    public static function roles()
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_OWNER,
            self::ROLE_GENERAL_MANAGER,
            self::ROLE_TECHNICAL_MANAGER,
            self::ROLE_COACH,
            self::ROLE_PLAYER,
        ];
    }

    public static function roleNames()
    {
        return [
            self::ROLE_ADMIN => __('roles.' . self::ROLE_ADMIN),
            self::ROLE_OWNER => __('roles.' . self::ROLE_OWNER),
            self::ROLE_GENERAL_MANAGER => __('roles.' . self::ROLE_GENERAL_MANAGER),
            self::ROLE_TECHNICAL_MANAGER => __('roles.' . self::ROLE_TECHNICAL_MANAGER),
            self::ROLE_COACH => __('roles.' . self::ROLE_COACH),
            self::ROLE_PLAYER => __('roles.' . self::ROLE_PLAYER),
        ];
    }
}
