<?php
session_start();
if (!empty($_SESSION['user_id'])) {

  $title = 'Delete-Profile';

  include __DIR__ . '/../config/db.config.php';

  if (!empty($_GET['id'])) {
    $id = (int) $_GET['id'];
  } else {
    $id = (int) $_SESSION['user_id'];
  }

  $result = dbQuery("DELETE FROM users where user_id = {$id}");

  header('Location: ../dashboard.php');
  die();
}
