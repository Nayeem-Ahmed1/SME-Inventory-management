<?php
include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $company_name = trim($_POST['company_name']);
  $contact_person = trim($_POST['contact_person']);
  $phone = trim($_POST['phone']);
  $email = trim($_POST['email']);
  $address = trim($_POST['address']);
  $payment_terms = trim($_POST['payment_terms']);

  $sql = "INSERT INTO suppliers ( company_name, contact_person, phone, email, address, payment_terms)VALUES('{$company_name}', '{$contact_person}', '{$phone}', '{$email}', '{$address}', '{$payment_terms}')";

  dbQuery($sql);

  header('Location: ../dashboard.php?view=all_suppliers');

  die();
}
