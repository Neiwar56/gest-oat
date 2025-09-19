<?php

namespace App\Console\Commands;

use App\Services\EmailService;
use App\Services\PasswordResetService;
use Illuminate\Console\Command;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email configuration and send a test password reset email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info('🔧 Testing email configuration...');
        
        // Test configuration
        $emailService = new EmailService();
        $config = $emailService->testConfiguration();
        
        $this->table(['Setting', 'Value'], [
            ['Mailer', $config['mailer']],
            ['From Address', $config['from_address']],
            ['From Name', $config['from_name']],
            ['Environment', $config['environment']],
        ]);
        
        if (isset($config['aws_region'])) {
            $this->table(['AWS Setting', 'Value'], [
                ['AWS Region', $config['aws_region']],
                ['AWS Key Configured', $config['aws_key_configured'] ? 'Yes' : 'No'],
            ]);
        }
        
        $this->info('📧 Sending test password reset email...');
        
        // Test password reset
        $passwordService = new PasswordResetService();
        $result = $passwordService->sendResetLink($email);
        
        if ($result === 'passwords.sent') {
            $this->info('✅ Email sent successfully!');
            $this->info('📝 Check your logs for the reset URL in development mode.');
        } else {
            $this->error('❌ Email sending failed: ' . $result);
        }
    }
}
