<?php

namespace App\Helpers;

class SecurityHelper
{
    /**
     * Sanitasi input untuk mencegah script injection
     */
    public static function sanitizeInput(string $input): string
    {
        // Hapus tag HTML
        $input = strip_tags($input);
        
        // Hapus karakter kontrol
        $input = preg_replace('/[\x00-\x1F\x7F]/u', '', $input);
        
        // Trim whitespace
        $input = trim($input);
        
        return $input;
    }

    /**
     * Validasi format email
     */
    public static function validateEmail(string $email): bool
    {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($pattern, $email) === 1;
    }

    /**
     * Validasi kekuatan password
     */
    public static function validatePasswordStrength(string $password): bool
    {
        // Minimal 8 karakter
        if (strlen($password) < 8) {
            return false;
        }

        // Harus mengandung huruf besar
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        // Harus mengandung huruf kecil
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }

        // Harus mengandung angka
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        // Harus mengandung simbol
        if (!preg_match('/[@$!%*?&]/', $password)) {
            return false;
        }

        return true;
    }

    /**
     * Cek apakah input mengandung script injection attempt
     */
    public static function containsScriptInjection(string $input): bool
    {
        $maliciousPatterns = [
            '/<script[^>]*>.*?<\/script>/i',
            '/on\w+\s*=/i',
            '/javascript:/i',
            '/<iframe[^>]*>/i',
            '/<object[^>]*>/i',
            '/<embed[^>]*>/i',
            '/union.*select/i',
            '/insert.*into/i',
            '/delete.*from/i',
            '/drop.*table/i',
            '/update.*set/i',
            '/select.*from/i',
        ];

        foreach ($maliciousPatterns as $pattern) {
            if (preg_match($pattern, $input)) {
                return true;
            }
        }

        return false;
    }
}
