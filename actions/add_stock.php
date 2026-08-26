<?php
include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $warehouse_id = (int) $_POST['warehouse_id'];
  $product_id = (int) $_POST['product_id'];
  $quantity = (int) $_POST['quantity'];

  if ($warehouse_id <= 0 || $product_id <= 0 || $quantity <= 0) {

    die("Invalid stock information.");
  }

  $inventory = dbQuery(
    "SELECT * FROM inventory WHERE warehouse_id = {$warehouse_id} AND product_id = {$product_id}"
  );

  if (!empty($inventory)) {

    $inventory_id =
      (int) $inventory[0]['inventory_id'];

    dbQuery("UPDATE inventory SET current_stock = current_stock + {$quantity} WHERE inventory_id = {$inventory_id}");
  } else {

    dbQuery("INSERT INTO inventory(warehouse_id,product_id,current_stock) VALUES( {$warehouse_id}, {$product_id},{$quantity})");
  }

  header(
    'Location: ../dashboard.php?view=current_stocks'
  );
  die();
}
