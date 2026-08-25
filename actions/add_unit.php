<?php

include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $unit_name = trim($_POST['unit_name']);
  if ($unit_name != '') {
    $sql = "INSERT INTO units(unit_name)
            VALUES('{$unit_name}')";
    dbQuery($sql);
  }

  header('Location: ../dashboard.php?view=units');
  die();
}
