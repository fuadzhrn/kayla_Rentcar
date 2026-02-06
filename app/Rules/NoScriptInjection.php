<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoScriptInjection implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Cek apakah input mengandung script injection attempt
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
            '/\<|\>|\"|\'|;|\*/i',
        ];

        foreach ($maliciousPatterns as $pattern) {
            if (preg_match($pattern, (string)$value)) {
                $fail("Field {$attribute} mengandung karakter atau pola yang tidak diizinkan.");
                return;
            }
        }
    }
}
