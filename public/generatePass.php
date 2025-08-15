<?php
require_once dirname(__DIR__) . '/config/bootstrap.php';
$pageTitle = "Password Manager | Generate Password";
include(INCLUDES_PATH . 'header.php');
?>


<div class="container">
  <div class="generate-password-section">
    <h2><i class="fas fa-magic"></i> Generate Strong Password</h2>

    <form method="POST" class="generate-form" action="<?= BASE_URL ?>handlers/generate_pass_handel">
      
      <?php if (isset($_SESSION['errors'])): ?>
        <div class="error-message">
          <?php foreach ($_SESSION['errors'] as $error): ?>
            <p><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?></p>
          <?php endforeach; ?>
        </div>
        <?php unset($_SESSION['errors']); ?>
      <?php endif; ?>
    
      <div class="result-section">
        <!-- <h3><i class="fas fa-key"></i> Generated Password:</h3> -->
        <div class="password-display">
          <input type="text" id="generated_password" value="<?php echo isset($_GET['password']) ? htmlspecialchars($_GET['password']) : '' ;?>" readonly>
          <button type="button" onclick="copyPassword()" class="btn-secondary">
            <i class="fas fa-copy"></i> Copy
          </button>
        </div>
      </div>

      

      <div class="form-group">
        <label for="password_length"><i class="fas fa-ruler-horizontal"></i> Password Length:</label>
        <input type="number" id="password_length" name="password_length">
      </div>

      <div class="options-group">
        <h3><i class="fas fa-sliders-h"></i> Include Characters:</h3>
        <div class="checkbox-row">
          <label class="checkbox-label">
            <input type="checkbox" name="include_upper" checked>
            <span class="checkmark"></span>
            <i class="fas fa-font"></i> Uppercase
          </label>
          <label class="checkbox-label">
            <input type="checkbox" name="include_lower" checked>
            <span class="checkmark"></span>
            <i class="fas fa-font"></i> Lowercase
          </label>
          <label class="checkbox-label">
            <input type="checkbox" name="include_numbers" checked>
            <span class="checkmark"></span>
            <i class="fas fa-hashtag"></i> Numbers
          </label>
          <label class="checkbox-label">
            <input type="checkbox" name="include_symbols">
            <span class="checkmark"></span>
            <i class="fas fa-asterisk"></i> Symbols
          </label>
        </div>
      </div>

      <button type="submit" class="btn-primary">
        <i class="fas fa-magic"></i> Generate Password
      </button>
      <?php $generated_password = isset($_GET['password']) ? $_GET['password'] : ""; ?>
      <button type="button" id="btn-primary" class="btn-primary" style=" <?php echo empty($generated_password) ? 'opacity:0.5;pointer-events:none;' : ''; ?>" onclick="submitStoreForm()">
        <i class="fas fa-save"></i> Store
      </button>
      <input type="hidden" id="store_password_hidden" value="<?php echo htmlspecialchars($generated_password); ?>">
    </form>
  </div>
</div>

<script>
function copyPassword() {
  const passwordField = document.getElementById('generated_password');
  passwordField.select();
  passwordField.setSelectionRange(0, 99999);
  document.execCommand('copy');
  // Show feedback
  const copyBtn = event.target.closest('button');
  const originalText = copyBtn.innerHTML;
  copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
  setTimeout(() => {
    copyBtn.innerHTML = originalText;
  }, 2000);
}
function submitStoreForm() {
  var password = document.getElementById('generated_password').value;
  if(password) {
    var input = document.getElementById('store_password_hidden');
    input.value = password;
    // Create and submit a form dynamically
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'storePass?password=' + encodeURIComponent(password);
    var hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'store_password';
    hidden.value = password;
    form.appendChild(hidden);
    document.body.appendChild(form);
    form.submit();
  }
}
</script>

<?php include(INCLUDES_PATH . 'footer.php'); ?>
