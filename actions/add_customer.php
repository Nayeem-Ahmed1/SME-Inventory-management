<?php

include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $customer_name = trim($_POST['customer_name']);
  $phone = trim($_POST['phone']);
  $email = trim($_POST['email']);
  $address = trim($_POST['address']);
  $outstanding_money = (float) $_POST['outstanding_money'];

  $sql = "INSERT INTO customers ( customer_name, phone, email, address, outstanding_money ) VALUES( '{$customer_name}', '{$phone}', '{$email}', '{$address}', {$outstanding_money} )";

  dbQuery($sql);

  header(
    'Location: ../dashboard.php?view=all_customers'
  );
  die();
}
