<?php
require_once dirname(__DIR__) . '/config/bootstrap.php';
require_once AUTH_PATH . 'auth.php';
$pageTitle = "Password Manager | Home";
include(INCLUDES_PATH . 'header.php');
?>

<div class="simple-dashboard">
  <div class="dashboard-header">
    <h1>Welcome to Your Password Manager</h1>
    <p class="dashboard-subtitle">Manage your passwords securely</p>
  </div>

  <div class="main-actions">
    <div class="action-card">
      <div class="action-icon">
        <i class="fas fa-key"></i>
      </div>
      <!-- Generare passwords section -->
      <h2>Generate Password</h2>
      <p>Create strong, secure passwords instantly</p>
      <a href="<?= BASE_URL ?>generatePass" class="action-btn generate-btn">
        <i class="fas fa-magic"></i>
        Generate Password
      </a>
    </div>

    <!-- View passwords section -->
    <div class="action-card">
      <div class="action-icon">
        <i class="fas fa-eye"></i>
      </div>
      <h2>View My Passwords</h2>
      <p>Access and manage your stored passwords</p>
      <a href="<?= BASE_URL ?>viewPasswords" class="action-btn view-btn">
        <i class="fas fa-list"></i>
        View Passwords
      </a>
    </div>

    <!-- Store passwords section -->
    <div class="action-card">
      <div class="action-icon">
        <i class="fas fa-save"></i>
      </div>
      <h2>Store Password</h2>
      <p>Save new passwords to your secure vault</p>
      <a href="<?= BASE_URL ?>storePass" class="action-btn store-btn">
        <i class="fas fa-plus"></i>
        Store Password
      </a>
    </div>
  </div>
</div>

<?php include(INCLUDES_PATH . 'footer.php'); ?>