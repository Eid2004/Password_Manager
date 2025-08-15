<?php
/**
 * Bootstrap file for Password Manager
 * This file should be included at the beginning of all PHP files
 * to ensure consistent path handling across the application
 */

// Start session if not already started and headers not sent
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
	session_start();
}

// Load the main configuration
require_once dirname(__DIR__) . '/config/config.php';

// Load helper functions
require_once HELPER_PATH . 'helper_function.php';
require_once HELPER_PATH . 'db_helper_func.php';

// Load database connection
require_once DB_PATH . 'db_connection.php';