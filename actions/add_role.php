<?php

include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $role_name = trim($_POST['role_name']);

  if ($role_name != '') {

    $role_name = strtolower($role_name);
    $role_name = str_replace(' ', '_', $role_name);

    $sql = "INSERT INTO roles(role_name) VALUES('{$role_name}')";

    dbQuery($sql);
  }

  header('Location: ../dashboard.php?aside=Roles');
  die();
}
