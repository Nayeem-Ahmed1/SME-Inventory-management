<?php

session_start();

include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $from_warehouse = (int) $_POST['from_warehouse'];
  $to_warehouse = (int) $_POST['to_warehouse'];
  $product_id = (int) $_POST['product_id'];
  $quantity = (int) $_POST['quantity'];
  $transfer_date = $_POST['transfer_date'];
  $user_id = (int) $_SESSION['user_id'];

  if ($from_warehouse == $to_warehouse) {
    die("Source and destination warehouse cannot be the same.");
  }

  if ($quantity <= 0) {
    die("Invalid transfer quantity.");
  }

  $source_stock = dbQuery(" SELECT * FROM inventory WHERE warehouse_id = {$from_warehouse} AND product_id = {$product_id} ");

  if (empty($source_stock)) {
    die("This product is not available in the source warehouse.");
  }

  $current_stock = (int) $source_stock[0]['current_stock'];
  $reserved_stock = (int) $source_stock[0]['reserved_stock'];
  $damaged_stock = (int) $source_stock[0]['damaged_stock'];
  $available_stock = $current_stock - $reserved_stock - $damaged_stock;

  if ($quantity > $available_stock) {
    die("Not enough available stock for transfer.");
  }

  dbQuery(" INSERT INTO warehouse_transfers ( from_warehouse, to_warehouse, transfer_date, user_id) VALUES ( {$from_warehouse}, {$to_warehouse}, '{$transfer_date}',{$user_id}) ");

  $new_transfer = dbQuery(" SELECT transfer_id FROM warehouse_transfers ORDER BY transfer_id DESC LIMIT 1 ");

  $transfer_id = (int) $new_transfer[0]['transfer_id'];

  dbQuery("INSERT INTO transfer_items ( transfer_id, product_id, quantity ) VALUES ( {$transfer_id}, {$product_id},{$quantity}) ");

  dbQuery(" UPDATE inventory SET current_stock = current_stock - {$quantity} WHERE warehouse_id = {$from_warehouse} AND product_id = {$product_id} ");

  $destination_stock = dbQuery(" SELECT * FROM inventory WHERE warehouse_id = {$to_warehouse} AND product_id = {$product_id} ");


  if (!empty($destination_stock)) {

    dbQuery("UPDATE inventory
     SET current_stock = current_stock + {$quantity}
      WHERE warehouse_id = {$to_warehouse} 
      AND product_id = {$product_id} 
    ");
  } else {

    dbQuery(" INSERT INTO inventory ( warehouse_id, product_id, current_stock ) VALUES ( {$to_warehouse}, {$product_id}, {$quantity}) ");
  }
  header(
    'Location: ../dashboard.php?view=transfers'
  );
  die();
}
