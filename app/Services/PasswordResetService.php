<?php

namespace App\Services;

use App\Models\User;
use App\Services\EmailService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetService
{
    /**
     * Send password reset email
     */
    public function sendResetLink(string $email): string
    {
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return 'passwords.user';
        }

        // Generate reset token
        $token = Str::random(64);
        
        // Store token in database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Generate reset URL
        $resetUrl = route('password.reset', ['token' => $token, 'email' => $email]);
        
        // Send email using EmailService
        $emailService = new EmailService();
        $success = $emailService->sendPasswordReset($user->email, $resetUrl, $user->name);
        
        return $success ? 'passwords.sent' : 'passwords.throttled';
    }

    /**
     * Reset password
     */
    public function resetPassword(string $email, string $token, string $password): string
    {
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$passwordReset || !Hash::check($token, $passwordReset->token)) {
            return 'passwords.token';
        }

        // Check if token is not expired (60 minutes)
        if (now()->diffInMinutes($passwordReset->created_at) > 60) {
            return 'passwords.token';
        }

        // Update user password
        $user = User::where('email', $email)->first();
        if (!$user) {
            return 'passwords.user';
        }

        $user->update([
            'password' => Hash::make($password)
        ]);

        // Delete the token
        DB::table('password_reset_tokens')
            ->where('email', $email)
            ->delete();

        return 'passwords.reset';
    }
}
