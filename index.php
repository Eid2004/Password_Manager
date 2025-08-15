<?php

  if(session_status() === PHP_SESSION_NONE) session_start();
  require_once  './config/bootstrap.php';
  if(isset($_SESSION['id'])) {
    header("Location: " . BASE_URL ."home");
    exit();
  } else {
    header("Location: " . BASE_URL ."login");
    exit();
  }