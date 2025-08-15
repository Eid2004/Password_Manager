<?php

// Use the global database configuration that was loaded in config
require_once dirname(__DIR__) . '/config/config.php';
$db_config = require_once CONFIG_PATH . 'DBconfig.php';

// Check if config was loaded successfully
if (!isset($db_config) || !is_array($db_config)) {
	die("Error: Database configuration not loaded properly");
}

// Validate required configuration keys
$required_keys = ['host', 'username', 'password', 'database', 'port'];
foreach ($required_keys as $key) {
	if (!isset($db_config[$key])) {
		die("Error: Missing required database configuration key: $key");
	}
}

$conn = mysqli_connect(
	$db_config['host'],
	$db_config['username'],
	$db_config['password'],
	$db_config['database'],
	$db_config['port']
);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

return $conn;