<?php

require_once dirname(__DIR__) . '/config/bootstrap.php';
require_once AUTH_PATH . 'auth.php';
$pageTitle = "Password Manager | My Account";
include_once INCLUDES_PATH . 'header.php';

//query to get number of stored passwords
$id = $_SESSION['id'];
$data = select('passwords', ['COUNT(*) as count'], "user_id = $id");
$storedPasswordCount = $data[0]['count'] ?? 0;

?>

<body>
    <div class="account-container">
        <div class="account-header">
            <h1>My Account</h1>
        </div>
        <div class="account-details">
            <div>
                <span>First Name:</span> <strong> <?= isset($_SESSION['fname']) ? $_SESSION['fname']:'' ?> </strong>
            </div>
            <div>
                <span>Last Name:</span> <strong><?= isset($_SESSION['lname']) ? $_SESSION['lname']:'' ?></strong>
            </div>
            <div>
                <span>Email:</span> <strong><?= isset($_SESSION['email']) ? $_SESSION['email']:'' ?></strong>
            </div>
            <div>
                <span>Number Of Stored Password:</span> <strong><a href="viewPasswords"><?= $storedPasswordCount ?></a></strong>
            </div>
        </div> <br>
        <a href="#" class="update-button">Update Account</a>
    </div>
</body>

<?php
include_once INCLUDES_PATH . 'footer.php';
?>