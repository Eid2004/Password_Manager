<?php
  if(session_status() === PHP_SESSION_NONE)  session_start();
  require_once dirname(__DIR__) . '/config/bootstrap.php';
  $pageTitle = "Password Manager | My Passwords";
  require_once INCLUDES_PATH . 'header.php';
  require_once AUTH_PATH . 'auth.php';
  require_once HELPER_PATH . 'db_helper_func.php';
  require_once HELPER_PATH . 'helper_function.php';
  $key = include_once CONFIG_PATH . 'key.php';


  $id = $_SESSION['id'];
  // echo $id;
  $password_data = select(
    'passwords',
    ['id','platforme_name','platforme_username','platform_password','platform_url','notes','created_at'],
    "user_id = $id"
  );
  
  if(!$password_data) {
    $errors = "No passwords found.";
  }

?>

<div class="main-container">
  <div class="dashboard-header">
    <h1><i class="fas fa-eye"></i> Your Saved Passwords</h1>
    <p class="dashboard-subtitle">Easily view, copy, and manage your stored passwords securely.</p>
  </div>
  <div class="dashboard-card">
    <div class="card-header">
      <h2><i class="fas fa-list"></i> Password List</h2>
      <p>Below are all the passwords you have saved. Click copy to use them instantly.</p>
    </div>
    <div class="recent-passwords-list">
      <?php displayError() ?>
      <?php displaySuccess() ?>
      <!-- Example password items, replace with PHP loop for real data -->
      <?php if(!isset($errors)): ?>
        <?php foreach($password_data as $data): ?>
          <div class="password-item">
            <div class="password-info">
              <span class="password-label"><span class="btn-icon"><i class="fas fa-globe"></i></span> <strong>Platform:</strong> <a href="<?= $data['platform_url'] ?>" target="_blank"><?= $data['platform_url'] ?></a></span>
              <span class="password-label"><span class="btn-icon"><i class="fas fa-user"></i></span> <strong>Username:</strong> <?= $data['platforme_username'] ?> </span>
              <span class="password-label"><span class="btn-icon"><i class="fas fa-sticky-note"></i></span> <strong>Notes:</strong><?= $data['notes'] ?></span>
              <span class="password-date"><span class="btn-icon"><i class="fas fa-calendar-alt"></i></span> <strong>Created at:</strong> <?= $data['created_at'] ?> </span>
              <!-- <button class="btn-secondary" title="Update Password" onclick="window.location.href='<?= BASE_URL ?>updatePass'"><i class="fa-solid fa-rotate"></i> Update</button> -->
              <button class="btn-secondary" title="Delete Password" onclick="window.location.href='<?= BASE_URL . 'delete?id=' . $data['id']?>'"><i class="fa-solid fa-trash"></i>Delete</button>
            </div>
            <div class="password-input-group" style="margin-top:14px; gap:10px; width:320px;">
              <input type="password" id="password" value="<?= decrypt($data['platform_password'],$key) ?>" readonly style="width:400px;">
              <button type="button" class="toggle-password" onclick="togglePassword(this)" title="Show/Hide Password"><i class="fas fa-eye"></i></button>
              <button class="btn-secondary" onclick="copyToClipboard(this)" title="Copy Password"><i class="fas fa-copy"></i> Copy</button>
              
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php if(isset($errors)): ?>
        <div class="error-message">
          <p><?php echo $errors; ?></p>
        </div>
      <?php endif; ?>
    </div>
    <!-- <div class="view-all-btn">
      <a href="#" class="btn-secondary"><i class="fas fa-arrow-down"></i> View All</a>
    </div> -->
  </div>
</div>

<script>
function copyToClipboard(btn) {
  var input = btn.parentElement.querySelector('input');
  input.type = 'text';
  input.select();
  input.setSelectionRange(0, 99999);
  document.execCommand('copy');
  var original = btn.innerHTML;
  btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
  setTimeout(function() { btn.innerHTML = original; input.type = 'password'; }, 2000);
}
function togglePassword(btn) {
  var input = btn.parentElement.querySelector('input');
  if (input.type === 'password') {
    input.type = 'text';
    btn.innerHTML = '<i class="fas fa-eye-slash"></i>';
  } else {
    input.type = 'password';
    btn.innerHTML = '<i class="fas fa-eye"></i>';
  }
}

function measurePasswordStrength(password) {
  let strength = "Weak";
  const strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})");
  const mediumRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})");

  if (strongRegex.test(password)) {
    strength = "Strong";
  } else if (mediumRegex.test(password)) {
    strength = "Medium";
  }

  return strength;
}

function updatePasswordStrength(input) {
  const strengthValue = document.getElementById("strength-value");
  const password = input.value;
  const strength = measurePasswordStrength(password);

  strengthValue.textContent = strength;
  strengthValue.className = `strength-value ${strength.toLowerCase()}`;
}

const passwordInputs = document.querySelectorAll("#password");
passwordInputs.forEach(input => {
  input.addEventListener("input", () => updatePasswordStrength(input));
});
</script>

<?php include_once INCLUDES_PATH . 'footer.php'; ?>