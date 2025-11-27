<?php

/**
 * Subscription Expiry Auto-Trigger Helper
 * 
 * Automatically checks for expired subscriptions once per day
 * Triggers silently on any page load without blocking
 */

namespace HomeXoom\Helpers;

class SubscriptionExpiryHelper
{
    private static $timestampFile = ROOT_DIR . '/logs/last-expiry-check.txt';
    private static $lockFile = ROOT_DIR . '/logs/expiry-check.lock';

    /**
     * Check if expiry script needs to run and trigger it if needed
     * Runs silently in background without blocking page load
     */
    public static function autoCheck()
    {
        // Skip if in command line (avoid recursion when cron runs)
        if (php_sapi_name() === 'cli') {
            return;
        }

        // Check if we need to run (once per day)
        if (!self::shouldRun()) {
            return;
        }

        // Prevent multiple simultaneous executions
        if (self::isLocked()) {
            return;
        }

        // Trigger the expiry check script in background
        self::triggerExpiryCheck();
    }

    /**
     * Check if enough time has passed since last run
     */
    private static function shouldRun()
    {
        // Create logs directory if it doesn't exist
        $logsDir = dirname(self::$timestampFile);
        if (!is_dir($logsDir)) {
            mkdir($logsDir, 0755, true);
        }

        // Check timestamp file
        if (!file_exists(self::$timestampFile)) {
            return true;
        }

        $lastRun = (int) file_get_contents(self::$timestampFile);
        $hoursSinceLastRun = (time() - $lastRun) / 3600;

        // Run once every 24 hours
        return $hoursSinceLastRun >= 24;
    }

    /**
     * Check if another process is already running the check
     */
    private static function isLocked()
    {
        if (!file_exists(self::$lockFile)) {
            return false;
        }

        // Check if lock is stale (older than 5 minutes)
        $lockAge = time() - filemtime(self::$lockFile);
        if ($lockAge > 300) {
            // Remove stale lock
            @unlink(self::$lockFile);
            return false;
        }

        return true;
    }

    /**
     * Trigger the expiry check script in background (non-blocking)
     */
    private static function triggerExpiryCheck()
    {
        // Create lock file
        file_put_contents(self::$lockFile, time());

        // Update timestamp immediately to prevent other processes from starting
        file_put_contents(self::$timestampFile, time());

        $scriptPath = ROOT_DIR . '/cron/check-expired-subscriptions.php';

        // Windows: Use start /B to run in background
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $command = 'start /B php "' . $scriptPath . '" > NUL 2>&1';
            pclose(popen($command, 'r'));
        } else {
            // Linux/Mac: Use & to run in background
            $command = 'php "' . $scriptPath . '" > /dev/null 2>&1 &';
            exec($command);
        }

        // Remove lock file after a short delay (lock file will be cleaned up by the script itself)
        // We don't wait for the script to finish - it runs in background
    }
}
