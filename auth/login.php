<?php
  if (session_status() === PHP_SESSION_NONE) session_start();
  require_once dirname(__DIR__) . '/config/bootstrap.php';
  include_once HELPER_PATH . 'helper_function.php';
  if (isset($_SESSION['id'])) {
    header("Location:" . BASE_URL);
    exit; 
  }
  $pageTitle = "Password Manager | Login";
?>

<?php include(INCLUDES_PATH . 'header.php'); ?>

<div class="auth-container">
  <div class="auth-card">

    <h2><i class="fas fa-sign-in-alt"></i> Login</h2>
    <!-- Display Errors -->
    <?php displayError(); ?>

    <form method="POST" action="login_process" class="auth-form">
      <div class="form-group">
        <label for="email">
          <i class="fas fa-envelope"></i> Email
        </label>
        <input type="text" id="email" name="email">
      </div>

      <div class="form-group">
        <label for="password">
          <i class="fas fa-lock"></i> Password
        </label>
        <input type="password" id="password" name="password">
      </div>

      <button type="submit" class="btn-primary">
        <i class="fas fa-sign-in-alt"></i> Login
      </button>
    </form>

    <div class="auth-links">
      <a href="register" class="link-secondary">
        <i class="fas fa-user-plus"></i> Create Account
      </a>
      <a href="forgot_password" class="link-secondary">
        <i class="fas fa-key"></i> Forgot Password?
      </a>
    </div>
  </div>
</div>

<?php include(INCLUDES_PATH . 'footer.php'); ?>