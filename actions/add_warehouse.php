<?php

include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $warehouse_name = trim($_POST['warehouse_name']);
  $location = trim($_POST['location']);

  $sql = "INSERT INTO warehouses (warehouse_name, location) VALUES ('{$warehouse_name}', '{$location}')";

  dbQuery($sql);

  header('Location: ../dashboard.php?view=all_warehouses');
  die();
}
