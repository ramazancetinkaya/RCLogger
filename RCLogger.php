<?php

/**
 * RCLogger - a PHP class that keeps verbose logging
 * © 2023 RAMAZAN ÇETİNKAYA, All rights reserved.
 *
 * @author [ramazancetinkaya]
 * @date [23.01.2023]
 *
 * Please note, this class is only a demonstration and should be used with caution, you should test it before using on a production environment.
 */

class Logger {
    // Log levels
    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';

    // File path for the log file
    private string $logFile;
    
    // Current log level
    private string $logLevel;

    /**
     * Logger constructor.
     *
     * @param string $logFile
     * @param string $logLevel
     */
    public function __construct(string $logFile, string $logLevel = self::DEBUG) {
        $this->logFile = $logFile;
        $this->logLevel = $logLevel;
        // call function to set the permissions
        $this->setPermissions();
    }
    /**
     * Set the permissions of the log file
     */
    public function setPermissions(): void {
        chmod($this->logFile, 0666);
    }
    
    /**
     * Log a message with the given level.
     *
     * @param string $level
     * @param string $message
     * @param array  $context
     */
    public function log(string $level, string $message, array $context = []): void {
        if ($this->isLogLevelEnabled($level)) {
            $date = date('Y-m-d H:i:s');
            $log = "[{$date}] [{$level}] {$message}";
            
            // Add context information to the log message
            if (!empty($context)) {
                $log .= PHP_EOL . json_encode($context);
            }
            
            // Write the log message to the log file
            file_put_contents($this->logFile, $log . PHP_EOL, FILE_APPEND);
        }
    }
    
    /**
     * Check if the given log level is enabled.
     *
     * @param string $level
     *
     * @return bool
     */
    public function isLogLevelEnabled(string $level): bool {
        $logLevels = [
            self::EMERGENCY,
            self::ALERT,
            self::CRITICAL,
            self::ERROR,
            self::WARNING,
            self::NOTICE,
            self::INFO,
            self::DEBUG
        ];
        
        $logLevelIndex = array_search($this->logLevel, $logLevels);
        $checkLevelIndex = array_search($level, $logLevels);
        
        return $checkLevelIndex >= $logLevelIndex;
    }
}

// You can use the class as follows:
$logger = new Logger('/path/to/log/file.log', Logger::ERROR);

/**

  You can use this class to log messages at different levels, such as emergency, alert, critical, error, warning, notice, info, and debug. 
  The class takes a log file path and a log level (default is debug) in the constructor. 
  The class includes a log method that takes a level, message, and context as inputs and writes them to the log file if the level is enabled. 
  The class also includes a method for checking if a given log level is enabled.

*/
