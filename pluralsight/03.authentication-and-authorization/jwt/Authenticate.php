<?php

namespace App;

class Authenticate
{
  public static function isLoggedIn()
  {
    return (!empty($_SESSION['identity']));
  }

  public static function generateCSRFToken()
  {
    if (empty($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(random_bytes(32));
    }
  }

  public static function login(): array
  {
    $errors = [];

    if (!isset($_POST['username']) || empty($_POST['username'])) {
      $errors['username'] = 'Username is missing';
    }

    if (!isset($_POST['password']) || empty($_POST['password'])) {
      $errors['password'] = 'Password is missing';
    }

    if (!isset($_POST['__csrf']) || empty($_POST['__csrf'])) {
      $errors['__csrf'] = 'CSRF token is missing';
    }

    if (!empty($_POST['__csrf'])) {
      if (!hash_equals($_SESSION['token'], $_POST['__csrf'])) {
        $errors['__csrf'] = 'CSRF token is invalid';
      }
    }

    // Check if the user is valid within our application
    $username = 'tronghieu';
    $password = 'thiha';

    if ($_POST['username'] !== $username || $_POST['password'] !== $password) {
      $errors['invalid'] = 'Invalid username or password';
    }

    return $errors;
  }

  public static function logout()
  {
    // Unset all of the session variables
    $_SESSION = [];

    // If it's desired to kill the session, also delete the session cookie
    // Note: this will destroy the session, and not just the session data
    if (ini_get('session.use_cookies')) {
      $params = session_get_cookie_params();

      setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
      );
    }

    // Finally, destroy the session
    session_destroy();

    $_SESSION['token'] = bin2hex(random_bytes(32));
  }

  public static function getFormFieldValue($fieldName): string
  {
    return (!empty($_POST[$fieldName])) ? $_POST[$fieldName] : '';
  }
}
