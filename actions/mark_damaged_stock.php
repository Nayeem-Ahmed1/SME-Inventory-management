<?php

include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $inventory_id = (int) $_POST['inventory_id'];
  $damaged_quantity = (int) $_POST['damaged_quantity'];

  if (
    $inventory_id <= 0 || $damaged_quantity <= 0
  ) {
    die("Invalid damaged stock quantity.");
  }

  $stock = dbQuery(" SELECT * FROM inventory WHERE inventory_id = {$inventory_id} ");

  if (empty($stock)) {
    die("Inventory record not found.");
  }

  $current_stock = (int) $stock[0]['current_stock'];
  $reserved_stock = (int) $stock[0]['reserved_stock'];
  $damaged_stock = (int) $stock[0]['damaged_stock'];
  $available_stock = $current_stock - $reserved_stock - $damaged_stock;

  if ($damaged_quantity > $available_stock) {
    die("Damaged quantity cannot be greater than available stock.");
  }

  dbQuery(" UPDATE inventory SET damaged_stock = damaged_stock + {$damaged_quantity} WHERE inventory_id = {$inventory_id} ");

  header(
    'Location: ../dashboard.php?view=damaged_stock'
  );

  die();
}
