<?php
include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $brand_name = trim($_POST['brand_name']);
  if ($brand_name != '') {
    $sql = "INSERT INTO brands(brand_name) VALUES('{$brand_name}')";

    dbQuery($sql);
  }

  header('Location: ../dashboard.php?view=brands');
  die();
}
