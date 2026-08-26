<?php

include __DIR__ . '/../config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $sale_id = (int) $_POST['sale_id'];
  $product_id = (int) $_POST['product_id'];
  $quantity = (int) $_POST['quantity'];

  if (
    $sale_id <= 0 || $product_id <= 0 || $quantity <= 0
  ) {
    die("Invalid order item.");
  }

  $order = dbQuery(" SELECT warehouse_id
    FROM sales_orders
    WHERE sale_id = {$sale_id}
  ");

  if (empty($order)) {
    die("Order not found.");
  }

  $warehouse_id = (int) $order[0]['warehouse_id'];

  $stock = dbQuery(" SELECT inventory.*, products.selling_price FROM inventory
  JOIN products
  ON inventory.product_id = products.product_id
  WHERE inventory.warehouse_id = {$warehouse_id}
  AND inventory.product_id = {$product_id} ");


  if (empty($stock)) {
    die("Product is not available in this warehouse.");
  }

  $current_stock = (int) $stock[0]['current_stock'];
  $reserved_stock = (int) $stock[0]['reserved_stock'];
  $damaged_stock = (int) $stock[0]['damaged_stock'];

  $available_stock = $current_stock - $reserved_stock - $damaged_stock;

  if ($quantity > $available_stock) {
    die("Not enough available stock.");
  }

  $selling_price = (float) $stock[0]['selling_price'];

  $subtotal =  $quantity * $selling_price;

  $existing_item = dbQuery("SELECT * FROM sales_items WHERE sale_id = {$sale_id} AND product_id = {$product_id} ");

  if (!empty($existing_item)) {

    $sale_item_id = (int) $existing_item[0]['sale_item_id'];

    dbQuery(" UPDATE sales_items SET quantity = quantity + {$quantity}, subtotal = (quantity + {$quantity}) * selling_price
    WHERE sale_item_id = {$sale_item_id} ");
  } else {

    dbQuery(" INSERT INTO sales_items( sale_id, product_id, quantity, selling_price, subtotal ) VALUES ( {$sale_id}, {$product_id}, {$quantity}, {$selling_price}, {$subtotal}) ");
  }

  dbQuery(" UPDATE inventory SET reserved_stock = reserved_stock + {$quantity} WHERE warehouse_id = {$warehouse_id} AND product_id = {$product_id} ");

  $total = dbQuery(" SELECT SUM(subtotal) AS total 
  FROM sales_items
  WHERE sale_id = {$sale_id} ");

  $total_amount = (float) $total[0]['total'];

  dbQuery(" UPDATE sales_orders SET total_amount = {$total_amount} WHERE sale_id = {$sale_id} ");

  header(
    "Location: ../dashboard.php?view=add_order_items&sale_id={$sale_id}"
  );
  die();
}
