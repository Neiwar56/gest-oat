<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\EmailService;
use App\Services\PasswordResetService;

echo "🔧 Testing email configuration...\n";

// Test configuration
$emailService = new EmailService();
$config = $emailService->testConfiguration();

echo "Mailer: " . $config['mailer'] . "\n";
echo "From Address: " . $config['from_address'] . "\n";
echo "From Name: " . $config['from_name'] . "\n";
echo "Environment: " . $config['environment'] . "\n";

if (isset($config['aws_region'])) {
    echo "AWS Region: " . $config['aws_region'] . "\n";
    echo "AWS Key Configured: " . ($config['aws_key_configured'] ? 'Yes' : 'No') . "\n";
}

echo "\n📧 Sending test password reset email...\n";

// Test password reset
$passwordService = new PasswordResetService();
$result = $passwordService->sendResetLink('admin@example.com');

if ($result === 'passwords.sent') {
    echo "✅ Email sent successfully!\n";
    echo "📝 Check your logs for the reset URL in development mode.\n";
} else {
    echo "❌ Email sending failed: " . $result . "\n";
}
