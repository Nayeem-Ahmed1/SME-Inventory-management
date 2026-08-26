<?php
include __DIR__ . '/../config/db.config.php';

if (isset($_GET['id'])) {
  $warehouse_id = (int) $_GET['id'];

  $inventory = dbQuery("SELECT inventory_id FROM inventory WHERE warehouse_id = {$warehouse_id}");

  $transfers = dbQuery(
    "SELECT transfer_id FROM warehouse_transfers WHERE from_warehouse = {$warehouse_id} OR to_warehouse = {$warehouse_id}"
  );

  if (!empty($inventory) || !empty($transfers)) {

    die("This warehouse cannot be deleted because it is already being used.");
  }

  dbQuery("DELETE FROM warehouses WHERE warehouse_id = {$warehouse_id}");
}

header('Location: ../dashboard.php?view=all_warehouses');
die();
