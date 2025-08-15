<?php

	if(session_status() === PHP_SESSION_NONE) session_start();

	require_once dirname(__DIR__) . '/config/bootstrap.php';
	require_once AUTH_PATH . 'auth.php';
	include_once HELPER_PATH . 'helper_function.php';
	include_once HELPER_PATH . 'db_helper_func.php';
	$key = include_once CONFIG_PATH . 'key.php';

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$platform_title = htmlspecialchars(trim($_POST['title']));
		$platform_username = htmlspecialchars(trim($_POST['username']));
		$password = encrypt($_POST['password'], $key);
		$platform_url = $_POST['url'];
		$user_id = $_SESSION['id'];
		$notes = htmlspecialchars(trim($_POST['notes']));

		$errors = [];
		//validate
		if(empty($platform_title)) {
			$errors[] = "Title is required";
		}
		if(empty($platform_username)) { 
			$errors[] = "Platform username is required";
		}
		if(empty($_POST['password'])) {
			$errors[] = "Password is required";
		}
		if(empty($platform_url)) {
			$errors[] = "Platform url is required";
		} else if(!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
			$errors[] = "Please enter a valid URL";
		}

		if(empty($errors)) {
			$result = insert('passwords',
				['platforme_name','user_id','platforme_username','platform_password','platform_url','notes'],
				[$platform_title,$user_id,$platform_username,$password,$platform_url,$notes]
			);
			if($result) {
				$_SESSION['success'] = "Password stored successfully";
				header("Location: " . BASE_URL . "storePass");
				exit();
			} else {
				$_SESSION['errors']= ["Somthing error, Please try agin"];
				header("Location: " . BASE_URL . "storePass");
				exit();	
			}
		} else {
			
			$_SESSION['errors'] = $errors;
			header("Location: " . BASE_URL . "storePass");
			exit();
		}
	}
