<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 
        'email', 
        'password',
        'google_id',    // Tambahkan untuk Google login
        'avatar',       // Tambahkan untuk menyimpan foto profil Google
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if admin has Google account linked
     */
    public function hasGoogleAccount()
    {
        return !is_null($this->google_id);
    }

    /**
     * Get avatar URL or default
     */
    public function getAvatarUrlAttribute()
    {
        return $this->avatar ?: asset('images/default-avatar.png');
    }
}