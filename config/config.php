<?php

// تعريف المسار الرئيسي للمشروع (Root path)

define('BASE_PATH', dirname(__DIR__));

// تعريف مسارات ثابتة
define('AUTH_PATH', BASE_PATH . '/auth/');
define('PUBLIC_PATH', BASE_PATH . '/public/');
define('INCLUDES_PATH', BASE_PATH . '/includes/');
define('HELPER_PATH', BASE_PATH . '/helper/');
define('HANDLERS_PATH', BASE_PATH . '/handlers/');
define('DB_PATH', BASE_PATH . '/DB/');
define('CONFIG_PATH', BASE_PATH . '/config/');
define('ASSETS_PATH', BASE_PATH . '/assets/');
// تعريف الرابط الأساسي لو عايز تستخدمه
define('BASE_URL', 'http://localhost/Password_Manager/');

// Load configuration files
// try {
//     $db_config = require_once CONFIG_PATH . 'DBconfig';
//     $key_config = require_once CONFIG_PATH . 'key';
// } catch (Exception $e) {
//     die("Error loading configuration: " . $e->getMessage());
// }

