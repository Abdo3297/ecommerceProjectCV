<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasRoles,
        InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birth',
        'provider_id',
        'provider',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];
    // collection of spatie media
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('user_profile_image');
    }
    // Attributes
    protected function Birth(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-m-Y'),
            set: fn ($value) => Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d')
        );
    }

    public function orders() :HasMany
    {
        return $this->hasMany(Order::class);
    }
}
