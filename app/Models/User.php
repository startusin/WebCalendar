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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'languages'
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
        'password' => 'hashed',
        'languages' => 'array',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'calendar_id', 'id');
    }

    public function slots(): HasMany
    {
        return $this->hasMany(CustomSlot::class, 'calendar_id', 'id');
    }

    public function brunches(): HasMany
    {
        return $this->hasMany(Brunch::class, 'calendar_id', 'id');
    }

    public  function settings(): HasOne
    {
        return $this->hasOne(CalendarSettings::class, 'calendar_id', 'id');
    }
}
