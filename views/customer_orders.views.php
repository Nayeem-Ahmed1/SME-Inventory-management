<div class="all_container">
  <div class="table_caption">
    Customer Orders
  </div>

  <?php

  $orders = dbQuery(" SELECT sales_orders.*,customers.customer_name, users.full_name FROM sales_orders
  JOIN customers
  ON sales_orders.customer_id = customers.customer_id
  JOIN users
  ON sales_orders.user_id = users.user_id
  ORDER BY sales_orders.sale_id DESC");
  ?>

  <table>
    <tr>
      <th>Serial</th>
      <th>Order ID</th>
      <th>Customer</th>
      <th>Order Date</th>
      <th>Total Amount</th>
      <th>Processed By</th>
      <th>Actions</th>
    </tr>

    <?php if (!empty($orders)) : ?>
      <?php for ($i = 0; $i < count($orders); $i++) : ?>

        <tr>
          <td>
            <?= $i + 1 ?>
          </td>
          <td>
            #<?= $orders[$i]['sale_id'] ?>
          </td>
          <td>
            <?= $orders[$i]['customer_name'] ?>
          </td>
          <td>
            <?= $orders[$i]['sale_date'] ?>
          </td>
          <td>
            ৳ <?= number_format((float) $orders[$i]['total_amount'], 2) ?>
          </td>
          <td>
            <?= $orders[$i]['full_name'] ?>
          </td>
          <td>
            <a href="order_details.php?id=<?= $orders[$i]['sale_id'] ?>">
              View
            </a>
          </td>
        </tr>
      <?php endfor; ?>

    <?php else : ?>

      <tr>
        <td colspan="7">
          No customer orders found.
        </td>

      </tr>
    <?php endif; ?>
  </table>
</div>