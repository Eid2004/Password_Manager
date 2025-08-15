<?php

/**
 * Generate a randome password with a specific policy
 * @param int Length of password
 * @param bool include upper case
 * @param bool include numbers
 * @param bool include symbols
 * @param bool include lower case
 */
function generatePassword(int $length = 8, bool $includeUpper, bool $includeNumbers, bool $includeSymbols, bool $includeLower = true): string {
  $upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $lower = "abcdefghijklmnopqrstuvwxyz";
  $numbers = "0123456789";
  $symbols = "!@#$%^&*()_+-={}[]|:;<>,.?/";

  $char = "";
  if ($includeLower) $char .= $lower;
  if ($includeUpper) $char .= $upper;
  if ($includeNumbers) $char .= $numbers;
  if ($includeSymbols) $char .= $symbols;

  $password = "";

  for ($i = 0; $i < $length; $i++) {
    $password .= $char[mt_rand(0, strlen($char) - 1)];
  }
  return str_shuffle($password);
}

/**
 * Encrypt the password
 * @param string Password
 * @param mixed $key
 * @return string Cipher Password
 */
function encrypt(string $password, $key): string {
  $cipher_algorithm = "AES-256-CBC";
  $ivlength = openssl_cipher_iv_length($cipher_algorithm);
  $iv = openssl_random_pseudo_bytes($ivlength);
  $cipher_password = openssl_encrypt($password, $cipher_algorithm, $key, 0, $iv);
  return base64_encode($iv . $cipher_password);
}

/**
 * Decrypt the Password
 * @param string Cipher passwrord
 * @param mixed key
 * @return string Plaintext of password
 */
function decrypt(string $cipher_password, $key): string {
  $cipher_algorithm = "AES-256-CBC";
  $ivlength = openssl_cipher_iv_length($cipher_algorithm);
  $password = base64_decode($cipher_password);
  $iv = substr($password, 0, $ivlength);
  $ciphertext = substr($password, $ivlength);
  $plain_password = openssl_decrypt($ciphertext, $cipher_algorithm, $key, 0, $iv);
  return $plain_password;
}

  /**
   * Function to display error
   */
  function displayError() :void {
    if (isset($_SESSION['errors'])):
      //echo '<div class="error-container">'; // Added container for styling
        foreach ($_SESSION['errors'] as $error):
          echo '<div class="error-message"><i class="fas fa-exclamation-triangle"></i>' . htmlspecialchars($error) . '</div>'; // Added error-message class
        endforeach;
      //echo '</div>'; // Close container
      unset($_SESSION['errors']);
    endif;
  }

  /**
   * Function to display success
   */
  function displaySuccess() :void {
    if (isset($_SESSION['success'])):
      echo '<div class="success-message">';
        echo '<i class="fas fa-check-circle"></i>' . $_SESSION['success'];
      echo '</div>';
      unset($_SESSION['success']);
    endif;
  }

