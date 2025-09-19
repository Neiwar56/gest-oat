<?php

namespace App\Services;

use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailService
{
    /**
     * Send password reset email
     */
    public function sendPasswordReset(string $email, string $resetUrl, string $userName = null): bool
    {
        try {
            // En mode développement, on utilise le driver 'log'
            if (config('app.env') === 'local') {
                Log::info('Password reset email would be sent', [
                    'email' => $email,
                    'reset_url' => $resetUrl,
                    'user_name' => $userName
                ]);
                
                // Afficher l'URL dans les logs pour faciliter les tests
                Log::info('Reset URL for testing: ' . $resetUrl);
                
                return true;
            }
            
            // En production, utiliser le driver configuré (SES)
            Mail::to($email)->send(new ResetPasswordMail($resetUrl, $userName));
            return true;
            
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage(), [
                'email' => $email,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
    
    /**
     * Test email configuration
     */
    public function testConfiguration(): array
    {
        $config = [
            'mailer' => config('mail.default'),
            'from_address' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
            'environment' => config('app.env'),
        ];
        
        if (config('mail.default') === 'ses') {
            $config['aws_region'] = config('services.ses.region');
            $config['aws_key_configured'] = !empty(config('services.ses.key'));
        }
        
        return $config;
    }
}
