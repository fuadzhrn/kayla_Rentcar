<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    protected $fillable = ['email', 'code', 'user_data', 'attempts', 'max_attempts', 'expires_at'];
    
    protected $casts = [
        'user_data' => 'json',
        'expires_at' => 'datetime',
    ];
    
    /**
     * Cek apakah OTP masih valid (belum expired)
     */
    public function isValid(): bool
    {
        return $this->expires_at->isFuture();
    }
    
    /**
     * Cek apakah OTP masih memiliki percobaan
     */
    public function hasAttempts(): bool
    {
        return $this->attempts < $this->max_attempts;
    }
    
    /**
     * Increment attempt counter
     */
    public function incrementAttempts(): void
    {
        $this->increment('attempts');
    }
}

