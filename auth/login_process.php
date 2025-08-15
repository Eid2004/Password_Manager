<?php
	require_once dirname(__DIR__) . '/config/bootstrap.php';
	require_once HELPER_PATH . 'db_helper_func.php';
	require_once HELPER_PATH . 'helper_function.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$email = trim($_POST['email'] ?? '');
		$password = $_POST['password'] ?? '';
		
		$errors = [];
		
		// Validation
		if (empty($email)) {
			$errors[] = "Email is required";
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Invalid email format";
		}
		if (empty($password)) {
			$errors[] = "Password is required";
		}

		if(empty($errors)) {
			$isUser = isExist('users', 'email', 'email', $email);
			if($isUser) {
				$data = select('users', ['id', 'fname', 'lname' ,'email', 'password'], "email = '$email'");
				if($data && password_verify($password, $data[0]['password'])) {
					$_SESSION['id'] = $data[0]['id'];
					$_SESSION['email'] = $data[0]['email'];
					$_SESSION['fname'] = $data[0]['fname'];
					$_SESSION['lname'] = $data[0]['lname'];
					header("Location: " . BASE_URL);
					exit();
				} else {
					$_SESSION['errors'] = ["Invalid email or password"];
					header("Location: " . BASE_URL . "login");
					exit();
				}
			} else {
				$_SESSION['errors'] = ["User does not exist."];
				header("Location: " . BASE_URL . "login");
				exit();
			}
		} else {
			$_SESSION['errors'] = $errors;
			header("Location: " . BASE_URL . "login");
			exit();
		}
	}
?>