<?php

	require_once dirname(__DIR__) . '/config/bootstrap.php';
	require_once AUTH_PATH . 'auth.php';


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$length = isset($_POST['password_length']) ? (int)$_POST['password_length'] : '';
		$upper = isset($_POST['include_upper']) ? true : false;
		$lower = isset($_POST['include_lower']) ? true : false;
		$numbers = isset($_POST['include_numbers']) ? true : false;
		$symbol = isset($_POST['include_symbols']) ? true : false;

		if(empty($length) || $length < 8 || $length > 128) {
			$error_message[] = "Password length must be between 8 and 128 characters.";
			$_SESSION['errors'] = $error_message;
			header("Location: " . BASE_URL . "generatePass");
			exit();
		}
		if (!$upper && !$lower && !$numbers && !$symbol) {
			$error_message[] = "Please select at least one character type.";
			$_SESSION['errors'] = $error_message;
			header("Location: " . BASE_URL . "generatePass");
			exit();
		} else {

			$generated_password = generatePassword($length, $upper, $numbers, $symbol, $lower);

			// Redirect to the same page with the generated password
			header("Location:". BASE_URL . "generatePass?password=" . urlencode($generated_password));
			exit();
		}
	}
?>
