<?php
  require_once dirname(__DIR__) . '/config/bootstrap.php';
  require_once AUTH_PATH . 'auth.php';
  $pageTitle = "Password Manager | Store Password";
  include_once INCLUDES_PATH . 'header.php';
  require_once HELPER_PATH . 'helper_function.php';
?>

<div class="container">
  <div class="store-password-section">
    <h2><i class="fas fa-save"></i> Store New Password</h2>

    <?php displaySuccess(); ?>
    <?php displayError(); ?>

    <form method="POST" action="<?= BASE_URL ?>store_pass_handel" class="store-form">
      <div class="form-group">
        <label for="title">Title/Name:</label>
        <input type="text" id="title" name="title" placeholder="e.g., Gmail, Facebook, Bank Account">
      </div>

      <div class="form-group">
        <label for="username">Username/Email:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username or email">
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <div class="password-input-group">
          <input type="password" id="password" name="password">
          <button type="button" onclick="togglePassword()" class="toggle-password">
            <i class="fas fa-eye" id="eye-icon"></i>
          </button>
        </div>
      </div>

      <div class="form-group">
        <label for="url">Website URL :</label>
        <input type="url" id="url" name="url" placeholder="https://example.com">
      </div>

      <div class="form-group">
        <label for="notes">Notes (Optional):</label>
        <textarea id="notes" name="notes" rows="3" placeholder="Any additional notes about this password"></textarea>
      </div>

      <!-- <div class="form-group">
        <label class="checkbox-label">
          <input type="checkbox" name="require_master_password" value="1">
          <span class="checkmark"></span>
          Require master password to view
        </label>
      </div> -->
      <br>
      <button type="submit" class="btn-primary">
        <i class="fas fa-save"></i> Store Password
      </button>

    </form>
  </div>
</div>

<script>
function togglePassword() {
  const passwordField = document.getElementById('password');
  const eyeIcon = document.getElementById('eye-icon');
  
  if (passwordField.type === 'password') {
    passwordField.type = 'text';
    eyeIcon.className = 'fas fa-eye-slash';
  } else {
    passwordField.type = 'password';
    eyeIcon.className = 'fas fa-eye';
  }
}

// Auto-fill password from URL parameter if present
<?php if (isset($_GET['password'])): ?>
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('password').value = '<?php echo htmlspecialchars($_GET['password']); ?>';
});
<?php endif; ?>
</script>

<?php include(INCLUDES_PATH . 'footer.php'); ?>