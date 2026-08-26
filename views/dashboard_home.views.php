<?php

$product_result = dbQuery("SELECT COUNT(*) AS total FROM products ");

$total_products = $product_result[0]['total'];

$customer_result = dbQuery("SELECT COUNT(*) AS total FROM customers ");

$total_customers = $customer_result[0]['total'];

$supplier_result = dbQuery("SELECT COUNT(*) AS total FROM suppliers ");

$total_suppliers = $supplier_result[0]['total'];

$warehouse_result = dbQuery("SELECT COUNT(*) AS total FROM warehouses ");

$total_warehouses = $warehouse_result[0]['total'];

$low_stock_result = dbQuery(" SELECT COUNT(*) AS total FROM inventory WHERE
          ( current_stock - reserved_stock- damaged_stock) > 0
          AND
          ( current_stock - reserved_stock - damaged_stock) <= 10 ");

$total_low_stock = $low_stock_result[0]['total'];

$out_stock_result = dbQuery("SELECT COUNT(*) AS total FROM inventory WHERE
          (current_stock- reserved_stock- damaged_stock) <= 0
          ");

$total_out_stock = $out_stock_result[0]['total'];

$recent_orders = dbQuery("SELECT sales_orders.*, customers.customer_name 
FROM sales_orders 
JOIN customers
ON sales_orders.customer_id = customers.customer_id
ORDER BY sales_orders.sale_id DESC
LIMIT 5
");
?>

<div class="dashboard_home">
  <div class="dashboard_title">
    Dashboard Overview
  </div>

  <div class="dashboard_cards">
    <div class="dashboard_card">
      <div class="card_title">
        Total Products
      </div>
      <div class="card_number">
        <?= $total_products ?>
      </div>
    </div>

    <div class="dashboard_card">
      <div class="card_title">
        Total Customers
      </div>
      <div class="card_number">
        <?= $total_customers ?>
      </div>
    </div>

    <div class="dashboard_card">
      <div class="card_title">
        Total Suppliers
      </div>
      <div class="card_number">
        <?= $total_suppliers ?>
      </div>
    </div>

    <div class="dashboard_card">
      <div class="card_title">
        Warehouses
      </div>
      <div class="card_number">
        <?= $total_warehouses ?>
      </div>
    </div>

    <div class="dashboard_card">
      <div class="card_title">
        Low Stock
      </div>
      <div class="card_number">
        <?= $total_low_stock ?>
      </div>
    </div>

    <div class="dashboard_card">
      <div class="card_title">
        Out of Stock
      </div>
      <div class="card_number">
        <?= $total_out_stock ?>
      </div>
    </div>
  </div>

  <div class="dashboard_section">
    <div class="section_title">
      Recent Orders
    </div>

    <table>
      <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Date</th>
        <th>Total</th>
        <th>Status</th>
      </tr>

      <?php if (!empty($recent_orders)) : ?>
        <?php foreach ($recent_orders as $order) : ?>

          <tr>
            <td>
              #<?= $order['sale_id'] ?>
            </td>
            <td>
              <?= $order['customer_name'] ?>
            </td>
            <td>
              <?= $order['sale_date'] ?>
            </td>
            <td>
              ৳<?= number_format((float) $order['total_amount'], 2) ?>
            </td>
            <td>
              <?= ucfirst($order['order_status']) ?>
            </td>
          </tr>
        <?php endforeach; ?>

      <?php else : ?>

        <tr>
          <td colspan="5">
            No orders found.
          </td>
        </tr>
      <?php endif; ?>

    </table>
  </div>
</div>