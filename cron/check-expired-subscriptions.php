<?php

/**
 * Subscription Expiry Check Script
 * 
 * This script checks for expired subscriptions and updates their status.
 * Should be run daily via cron job or Task Scheduler.
 * 
 * Windows Task Scheduler:
 * schtasks /create /tn "Check Expired Subscriptions" /tr "php C:\xampp\htdocs\HomeXoom\cron\check-expired-subscriptions.php" /sc daily /st 02:00
 * 
 * Linux Cron:
 * 0 2 * * * /usr/bin/php /path/to/HomeXoom/cron/check-expired-subscriptions.php
 */

// Include required files
require_once dirname(__DIR__) . '/config.php';
require_once ROOT_DIR . '/Controllers/db.controller.php';

use HomeXoom\Controllers\DBController;

// Initialize database connection
$db = new DBController();
$db->openConnection();
$conn = $db->getConnection();

$logFile = dirname(__DIR__) . '/logs/subscription-expiry-check.log';
$timestamp = date('Y-m-d H:i:s');

// Create logs directory if it doesn't exist
if (!is_dir(dirname($logFile))) {
    mkdir(dirname($logFile), 0755, true);
}

// Log start
file_put_contents($logFile, "[$timestamp] Starting subscription expiry check...\n", FILE_APPEND);

try {
    // Find expired subscriptions
    $sql = "SELECT id, user_id, stripe_subscription_id, status, current_period_end 
            FROM Subscriptions 
            WHERE status IN ('active', 'trialing') 
            AND current_period_end < NOW()";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $expiredCount = 0;

        while ($row = $result->fetch_assoc()) {
            // Update subscription status to expired
            $updateSql = "UPDATE Subscriptions SET status = 'expired' WHERE id = ?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("i", $row['id']);

            if ($stmt->execute()) {
                $expiredCount++;
                file_put_contents(
                    $logFile,
                    "[$timestamp] Expired subscription ID: {$row['id']}, User ID: {$row['user_id']}, Stripe ID: {$row['stripe_subscription_id']}\n",
                    FILE_APPEND
                );
            } else {
                file_put_contents(
                    $logFile,
                    "[$timestamp] ERROR: Failed to expire subscription ID: {$row['id']}\n",
                    FILE_APPEND
                );
            }

            $stmt->close();
        }

        file_put_contents($logFile, "[$timestamp] Completed: Marked $expiredCount subscription(s) as expired.\n\n", FILE_APPEND);
        echo "Marked $expiredCount subscription(s) as expired.\n";
    } else {
        file_put_contents($logFile, "[$timestamp] No expired subscriptions found.\n\n", FILE_APPEND);
        echo "No expired subscriptions found.\n";
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    file_put_contents($logFile, "[$timestamp] ERROR: $error\n\n", FILE_APPEND);
    echo "Error: $error\n";
}

$db->closeConnection();

// Remove lock file if it exists
$lockFile = dirname(__DIR__) . '/logs/expiry-check.lock';
if (file_exists($lockFile)) {
    unlink($lockFile);
}

// Optional: Clean up old log entries (keep last 30 days)
$logContent = file_get_contents($logFile);
$logLines = explode("\n", $logContent);
if (count($logLines) > 1000) {
    $recentLogs = array_slice($logLines, -500);
    file_put_contents($logFile, implode("\n", $recentLogs));
}
