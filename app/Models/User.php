<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'id',
        'full_name',
        'phone',
        'email',
        'image',
        'address',
        'password',
        'status',
        'code_sent',
        'birthday',
        'role_id',
        'session_id',
        'provider',
        'provider_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['image_url', 'role_name'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
    ];

    public function getBirthdayAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        $locale = app()->getLocale();

        if ($locale === 'vi') {
            return Carbon::parse($value)->format('d/m/Y');
        } else {
            return Carbon::parse($value)->format('m/d/Y');
        }
    }

    // Custom roles relationship
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // App\Models\User.php
    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }

    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function getImageUrlAttribute()
    {
        return checkFile($this->image);
    }

    public function getRoleNameAttribute()
    {
        return $this->role->name;
    }

    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'notification_user')
            ->withTimestamps();
    }

    public function favorites()
    {
        return $this->belongsToMany(Menu::class, 'favorites');
    }
}
