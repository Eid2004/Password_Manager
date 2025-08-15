<?php

require_once dirname(__DIR__) . '/config/bootstrap.php';
require_once AUTH_PATH . 'auth.php';

  if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $isFind = isExist('passwords', 'id', 'id', $id);
    if($isFind) {
      global $conn;
      $query = "DELETE FROM passwords WHERE id = $id";
      $runQuery = mysqli_query($conn, $query);
      if($runQuery) {
        $_SESSION['success'] = "Password delete successfuly";
        header("Location:" . BASE_URL . 'viewPasswords');
        exit();
      } else {
        $_SESSION['errors'] = ["Something wrong"];
        header("Location:" . BASE_URL . 'viewPasswords');
        exit();
      }
    } else {
      header("Location:" . BASE_URL);
      exit();
    }
    
  } else {
    header("Location:" . BASE_URL);
    exit();
  }