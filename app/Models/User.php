<?php

namespace App\Models;

use App\Scopes\UserStatusScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    const PENDING = 1;
    const ACTIVE = 2;
    const BANNED = 3;
    const INACTIVE = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new UserStatusScope);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($plain_password)
    {
        $this->attributes['password'] = Hash::make($plain_password);
    }

    public function setUsernameAttribute($username)
    {
        $this->attributes['username'] = Str::slug($username);
    }

    public function isActive()
    {
        return $this->status == self::ACTIVE;
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id', 'id');
    }
}
