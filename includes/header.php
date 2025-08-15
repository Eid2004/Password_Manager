<?php

  if(session_status() === PHP_SESSION_NONE) session_start();
  require_once dirname(__DIR__) . '/config/bootstrap.php';
  require_once HELPER_PATH . 'db_helper_func.php';
  require_once HELPER_PATH . 'helper_function.php';
  
// Get the base path for assets regardless of where the file is included from
$scriptPath = $_SERVER['SCRIPT_NAME'];
$scriptDir = dirname($scriptPath);
// If accessed via .htaccess rewrite (e.g. /storePass or /generatePass), treat as root
if (
    $scriptPath === '/storePass.php' ||
    $scriptPath === '/generatePass.php'
) {
    $rootPath = './';
} else if (strpos($scriptDir, '/auth') !== false || strpos($scriptDir, '/includes') !== false || strpos($scriptDir, '/public') !== false || strpos($scriptDir, '/handlers') !== false) {
    $rootPath = '../';
} else {
    $rootPath = './';
}


// Get current page name for navigation logic
$currentPage = basename($_SERVER['SCRIPT_NAME'], '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($pageTitle) ? $pageTitle : 'Password Manager'; ?></title>
  <link rel="stylesheet" href="/Password_Manager/assets/CSS/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="/Password_Manager/assets/img/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="/Password_Manager/assets/JS/script.js" defer></script>
</head>
<body>
  <header class="main-header">
    <div class="header-content">
      <h1>🔐 Cyber Password Manager</h1>
      <nav class="header-nav">
        <?php
        if(isset($_SESSION['id'])):
          // Get the user name From DB
          $id = $_SESSION['id'];
          $data = select('users',['fname','lname'],"id=$id");
          
          $username = $data[0]['fname'] . ' ' . $data[0]['lname'];
        ?>
          
          <?php if($currentPage === 'home.php'): ?>
            <!-- Home page navigation -->
            <a href="<?= BASE_URL ?>generatePass" class="nav-btn">
              <i class="fas fa-key"></i>
              <span>Generate Password</span>
            </a>
            <a href="<?= BASE_URL ?>storePass" class="nav-btn">
              <i class="fas fa-save"></i>
              <span>Store Password</span>
            </a>
            <a href="<?= BASE_URL ?>viewPasswords" class="nav-btn">
              <i class="fas fa-eye"></i>
              <span>View Passwords</span>
            </a>
            <a href="<?= BASE_URL ?>logout" class="nav-btn logout-btn">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </a>
            <span class="nav-username"> <a href="myAccount"><i class="fas fa-user"></i> <?= htmlspecialchars($username) ?></a></span>
            <!-- Grnerate password page navigation -->
          <?php elseif($currentPage === 'generatePass.php'): ?>
            <a href="<?= BASE_URL ?>home" class="nav-btn">
              <i class="fas fa-home"></i>
              <span>Home</span>
            </a>
            <a href="<?= BASE_URL ?>storePass" class="nav-btn">
              <i class="fas fa-save"></i>
              <span>Store Password</span>
            </a>
            <a href="<?= BASE_URL ?>viewPasswords" class="nav-btn">
              <i class="fas fa-eye"></i>
              <span>View Passwords</span>
            </a>
            <a href="<?= BASE_URL ?>logout" class="nav-btn logout-btn">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </a>
            <span class="nav-username"> <a href="myAccount"><i class="fas fa-user"></i> <?= htmlspecialchars($username) ?></a></span>
            <!-- Store password page navigation -->
          <?php elseif($currentPage === 'storePass.php'): ?>
            <a href="<?= BASE_URL ?>home" class="nav-btn">
              <i class="fas fa-home"></i>
              <span>Home</span>
            </a>
            <a href="<?= BASE_URL ?>generatePass" class="nav-btn">
              <i class="fas fa-key"></i>
              <span>Generate Password</span>
            </a>
            <a href="<?= BASE_URL ?>viewPasswords" class="nav-btn">
              <i class="fas fa-eye"></i>
              <span>View Passwords</span>
            </a>
              <a href="<?= BASE_URL ?>logout" class="nav-btn logout-btn">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </a>
            <span class="nav-username"><a href="myAccount"><i class="fas fa-user"></i> <?= htmlspecialchars($username) ?></a></span>
            <!-- My Account navigation -->
          <?php elseif($currentPage === 'myAccount.php'): ?>
            <a href="<?= BASE_URL ?>home" class="nav-btn">
              <i class="fas fa-home"></i>
              <span>Home</span>
            </a>
            <a href="<?= BASE_URL ?>generatePass" class="nav-btn">
              <i class="fas fa-key"></i>
              <span>Generate Password</span>
            </a>
            <a href="<?= BASE_URL ?>viewPasswords" class="nav-btn">
              <i class="fas fa-eye"></i>
              <span>View Passwords</span>
            </a>
              <a href="<?= BASE_URL ?>logout" class="nav-btn logout-btn">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </a>
            <!-- View passwords page navigation -->
          <?php elseif($currentPage === 'viewPasswords.php'): ?>
              <a href="<?= BASE_URL ?>home" class="nav-btn">
              <i class="fas fa-home"></i>
              <span>Home</span>
            </a>
            <a href="<?= BASE_URL ?>generatePass" class="nav-btn">
              <i class="fas fa-key"></i>
              <span>Generate Password</span>
            </a>
            <a href="<?= BASE_URL ?>storePass" class="nav-btn">
              <i class="fas fa-save"></i>
              <span>Store Password</span>
            </a>
            <a href="<?= BASE_URL ?>logout" class="nav-btn logout-btn">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </a>
            <span class="nav-username"><a href="myAccount"><i class="fas fa-user"></i> <?= htmlspecialchars($username) ?></a></span>
          <?php else: ?>
            <!-- Default navigation for other pages -->
            <a href="<?= BASE_URL ?>home" class="nav-btn">
              <i class="fas fa-home"></i>
              <span>Home</span>
            </a>
            <a href="<?= BASE_URL ?>generatePass" class="nav-btn">
              <i class="fas fa-key"></i>
              <span>Generate Password</span>
            </a>
            <a href="<?= BASE_URL ?>storePass" class="nav-btn">
              <i class="fas fa-save"></i>
              <span>Store Password</span>
            </a>
            <a href="<?= BASE_URL ?>viewPasswords" class="nav-btn">
              <i class="fas fa-eye"></i>
              <span>View Passwords</span>
            </a>
            <a href="<?= BASE_URL ?>logout" class="nav-btn logout-btn">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </a>
            <span class="nav-username"><a href="myAccount"><i class="fas fa-user"></i> <?= htmlspecialchars($username) ?></a></span>
          <?php endif; ?>
        <?php endif; ?>
      </nav>
    </div>
  </header>
  <main class="main-container">
