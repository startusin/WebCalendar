<?php

namespace App\Models;

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
        'alias',
        'languages',
        'excluded_permissions',
        'invited_by'
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
        'excluded_permissions' => 'array',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'calendar_id', 'id');
    }

    public function slots(): HasOne
    {
        return $this->hasOne(CustomSlot::class, 'calendar_id', 'id');
    }

    public function brunches(): HasMany
    {
        return $this->hasMany(Brunch::class, 'calendar_id', 'id');
    }

    public function settings(): HasOne
    {
        return $this->hasOne(CalendarSettings::class, 'calendar_id', 'id');
    }

    public function formSettings(): HasMany
    {
        return $this->hasMany(FormSettings::class, 'calendar_id', 'id');
    }

    public function translations(): HasOne
    {
        return $this->hasOne(Translations::class, 'calendar_id', 'id');
    }
}
