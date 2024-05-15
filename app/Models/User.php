<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
  
    protected $table = 'users';
    protected $fillable = [
        'email',
        'password',
        'role',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define a one-to-one relationship with the UserProfile model.
     *
     * @return HasOne
     */
    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }
    public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class, 'user_id', 'id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}
