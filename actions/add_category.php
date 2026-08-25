<?php

include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $category_name = trim($_POST['category_name']);

  if ($category_name != '') {
    $sql = "INSERT INTO categories(category_name) VALUES('{$category_name}')";

    dbQuery($sql);
  }

  header('Location: ../dashboard.php?view=categories');

  die();
}
