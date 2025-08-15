<?php
  if (session_status() === PHP_SESSION_NONE) session_start();
  if (isset($_SESSION['id'])) {
    header("Location:" . BASE_URL);
    exit; 
  }
  require_once dirname(__DIR__) . '/config/bootstrap.php';
  include_once HELPER_PATH . 'helper_function.php';
  $pageTitle = "Password Manager | Register";
  include (INCLUDES_PATH . 'header.php');
?>

<div class="auth-container">
  <div class="auth-card">
    <h2><i class="fas fa-user-plus"></i> Create Account</h2>
    
    <!-- Display Errors -->
    <?php displayError(); ?>

    <form method="POST" action="register_process" class="auth-form">
      <div class="form-group">
        <label for="name">
          <i class="fas fa-user"></i> First Name
        </label>
        <input type="text" id="name" name="fname">
      </div>

      <div class="form-group">
        <label for="name">
          <i class="fas fa-user"></i> Last Name
        </label>
        <input type="text" id="name" name="lname">
      </div>

      <div class="form-group">
        <label for="email">
          <i class="fas fa-envelope"></i> Email
        </label>
        <input type="email" id="email" name="email">
      </div>

      <div class="form-group">
        <label for="password">
          <i class="fas fa-lock"></i> Password
        </label>
        <input type="password" id="password" name="password">
      </div>

      <div class="form-group">
        <label for="confirm_password">
          <i class="fas fa-lock"></i> Confirm Password
        </label>
        <input type="password" id="confirm_password" name="confirm_password">
      </div>

      <button type="submit" class="btn-primary">
        <i class="fas fa-user-plus"></i> Create Account
      </button>
    </form>

    <div class="auth-links">
      <a href="login" class="link-secondary">
        <i class="fas fa-sign-in-alt"></i> Already have an account? Login
      </a>
    </div>
  </div>
</div>

<?php include(INCLUDES_PATH . 'footer.php'); ?>