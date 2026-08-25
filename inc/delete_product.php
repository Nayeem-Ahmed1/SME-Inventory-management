<?php
include __DIR__ . '/../config/db.config.php';

if (isset($_GET['id'])) {
  $product_id = (int) $_GET['id'];

  $product = dbQuery(
    "SELECT * FROM products WHERE product_id = {$product_id}"
  );

  if (!empty($product)) {
    $purchase_items = dbQuery(
      "SELECT purchase_item_id FROM purchase_items WHERE product_id = {$product_id}"
    );

    $sales_items = dbQuery(
      "SELECT sale_item_id FROM sales_items WHERE product_id = {$product_id}"
    );

    $inventory = dbQuery(
      "SELECT inventory_id FROM inventory WHERE product_id = {$product_id}"
    );

    $transfer_items = dbQuery("SELECT transfer_item_id FROM transfer_items WHERE product_id = {$product_id}");

    if (!empty($purchase_items) || !empty($sales_items) || !empty($inventory) || !empty($transfer_items)) {
      die("This product cannot be deleted because it is already being used.");
    }

    dbQuery(
      "DELETE FROM products WHERE product_id = {$product_id}"
    );
  }
}

header('Location: ../dashboard.php?view=all_products');

die();
