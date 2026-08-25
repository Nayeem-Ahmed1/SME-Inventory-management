<?php
include __DIR__ . '/../config/db.config.php';

if (isset($_GET['id'])) {

  $supplier_id = (int) $_GET['id'];

  $products = dbQuery(
    "SELECT product_id FROM products
     WHERE supplier_id = {$supplier_id}"
  );

  $purchases = dbQuery(
    "SELECT purchase_id FROM purchase_orders
     WHERE supplier_id = {$supplier_id}"
  );

  if (!empty($products) || !empty($purchases)) {
    die("This supplier cannot be deleted because it is already being used.");
  }
  dbQuery(
    "DELETE FROM suppliers
     WHERE supplier_id = {$supplier_id}"
  );
}

header('Location: ../dashboard.php?view=all_suppliers');
die();
