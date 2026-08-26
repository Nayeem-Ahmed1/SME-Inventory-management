<?php

if (empty($_GET['sale_id'])) {
  echo "Order not found.";
  return;
}

$sale_id = (int) $_GET['sale_id'];

$order = dbQuery(" SELECT sales_orders.*, customers.customer_name, warehouses.warehouse_name
FROM sales_orders
JOIN customers
ON sales_orders.customer_id = customers.customer_id
JOIN warehouses
ON sales_orders.warehouse_id = warehouses.warehouse_id
WHERE sales_orders.sale_id = {$sale_id} ");

if (empty($order)) {
  echo "Order not found.";
  return;
}

$warehouse_id = (int) $order[0]['warehouse_id'];

$products = dbQuery(" SELECT products.product_id, products.product_name, products.selling_price, inventory.current_stock, inventory.reserved_stock, inventory.damaged_stock
FROM inventory
JOIN products
ON inventory.product_id = products.product_id
WHERE inventory.warehouse_id = {$warehouse_id}
AND (
    inventory.current_stock - inventory.reserved_stock - inventory.damaged_stock
  ) > 0
ORDER BY products.product_name ");

$items = dbQuery(" SELECT sales_items.*, products.product_name FROM sales_items
JOIN products
ON sales_items.product_id = products.product_id
WHERE sales_items.sale_id = {$sale_id} ");

?>

<div class="order_items_container">
  <div class="order_items_caption">
    Add Order Items
  </div>

  <div class="order_information">
    <p>
      <strong>Order ID:</strong>
      #<?= $sale_id ?>
    </p>
    <p>
      <strong>Customer:</strong>
      <?= $order[0]['customer_name'] ?>
    </p>
    <p>
      <strong>Warehouse:</strong>
      <?= $order[0]['warehouse_name'] ?>
    </p>
    <p>
      <strong>Date:</strong>
      <?= $order[0]['sale_date'] ?>
    </p>
  </div>

  <form action="actions/add_order_item.php" method="POST" class="order_item_form">

    <input type="hidden" name="sale_id" value="<?= $sale_id ?>">

    <div>
      <label>Product</label>
      <select name="product_id" required>

        <option value="">
          Select Product
        </option>

        <?php foreach ($products as $product) : ?>
          <?php

          $available = $product['current_stock'] - $product['reserved_stock'] - $product['damaged_stock'];

          ?>
          <option value="<?= $product['product_id'] ?>">
            <?= $product['product_name'] ?>-
            ৳<?= number_format($product['selling_price'], 2) ?>
            (Available: <?= $available ?>)
          </option>

        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>Quantity</label>
      <input class="special_field" type="number" name="quantity" min="1" required>
    </div>

    <div>
      <button type="submit">
        Add Item
      </button>
    </div>
  </form>

  <div class="order_items_table">
    <table>
      <tr>
        <th>Serial</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Subtotal</th>
      </tr>

      <?php if (!empty($items)) : ?>
        <?php for ($i = 0; $i < count($items); $i++) : ?>

          <tr>
            <td>
              <?= $i + 1 ?>
            </td>
            <td>
              <?= $items[$i]['product_name'] ?>
            </td>
            <td>
              <?= $items[$i]['quantity'] ?>
            </td>
            <td>
              ৳<?= number_format($items[$i]['selling_price'], 2) ?>
            </td>
            <td>
              ৳<?= number_format($items[$i]['subtotal'], 2) ?>
            </td>
          </tr>

        <?php endfor; ?>
      <?php else : ?>

        <tr>
          <td colspan="5">
            No products added yet.
          </td>
        </tr>
      <?php endif; ?>

    </table>
  </div>

  <div class="order_total">
    Total Amount:
    <strong>
      ৳<?= number_format((float) $order[0]['total_amount'], 2) ?>
    </strong>
  </div>
</div>