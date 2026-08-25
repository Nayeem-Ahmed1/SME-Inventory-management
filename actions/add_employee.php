<?php
include __DIR__ . '/../config/db.config.php';
include __DIR__ . '/../inc/func/image_resize.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = trim($_POST['full_name']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $role_id = (int) $_POST['role_id'];
  $password = $_POST['password'];
  $c_password = $_POST['c_password'];

  if ($password !== $c_password) {
    die("Passwords do not match.");
  }

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO users( role_id, full_name, phone, email,user_password) VALUES( {$role_id}, '{$name}', '{$phone}', '{$email}', '{$hashed_password}')";

  dbQuery($sql);

  $new_user = dbQuery("SELECT user_id FROM users WHERE email = '{$email}'");

  if (!empty($new_user)) {

    $new_user_id = (int) $new_user[0]['user_id'];

    if (isset($_FILES['pp']) && $_FILES['pp']['error'] === 0) {

      $file_name = 'pp_' . time() . '.jpg';
      $new_path = __DIR__ . '/../uploads/' . $file_name;

      resizeImage(
        $_FILES['pp']['tmp_name'],
        $new_path
      );

      dbQuery(" UPDATE users SET profile_picture =  '{$file_name}' WHERE user_id = {$new_user_id} ");
    }
  }

  header('Location: ../dashboard.php?view=all_employees');

  die();
}
