<?php

	require_once dirname(__DIR__) . '/config/bootstrap.php';
	require_once HELPER_PATH . 'db_helper_func.php'; 
	require_once HELPER_PATH . 'helper_function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$fname = htmlspecialchars(trim($_POST['fname'] ?? ''));
	$lname = htmlspecialchars(trim($_POST['lname'] ?? ''));
	$email =htmlspecialchars(trim($_POST['email'] ?? ''));
	$password = password_hash($_POST['password'] ?? '', PASSWORD_ARGON2ID);
	$confirm_password = $_POST['confirm_password'] ?? '';
	
	$errors = [];
	
	// Validation
	if (empty($fname)) {
		$errors[] = "First Name is required";
	}
	if (empty($lname)) {
		$errors[] = "Last Name is required";
	}
	
	if (empty($email)) {
		$errors[] = "Email is required";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = "Please enter a valid email address";
	}
	
	if (empty($_POST['password'])) {
		$errors[] = "Password is required";
	} elseif (strlen($_POST['password']) < 8) {
		$errors[] = "Password must be at least 8 characters long";
	} elseif($_POST['password'] !== $confirm_password) {
		$errors[] = "Passwords do not match";
	} else {
		if (!preg_match('/[0-9]/', $_POST['password'])) {
			$errors[] = "Password must contain at least one number";
		}
		if (!preg_match('/[A-Z]/', $_POST['password'])) {
			$errors[] = "Password must contain at least one uppercase letter";
		}
		if (!preg_match('/[a-z]/', $_POST['password'])) {
			$errors[] = "Password must contain at least one lowercase letter";
		}
		if (!preg_match('/[\W_]/', $_POST['password'])) {
			$errors[] = "Password must contain at least one special character";
		}
	}
	//Check is not exist errors
	if (empty($errors)) {
			// Check if email already exists
			$isExist = isExist('users', 'email', 'email', $email);
			
			if ($isExist) {
				$_SESSION['errors'] = ["Email already exists, please try another one or login."];
				header("Location: " . BASE_URL . "register");
				exit;
			} else {
				// Insert user into the database
				$isInserte = insert('users',
														['fname', 'lname', 'email', 'password'],
														[$fname, $lname, $email, $password]
													);
				
				if($isInserte) {
					header("Location: " . BASE_URL . "login");
					exit;
				} else {
					$errors[] = "Somthing wrong, Please try agin";
				}
			}
		} else {
			$_SESSION['errors'] = $errors;
			header("Location: " . BASE_URL . "register");
			exit;
		}
} else {
	header("Location: " . BASE_URL . "register");
	exit;
}
?>