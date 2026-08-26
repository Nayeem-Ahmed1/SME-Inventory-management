<div class="all_container">
  <div class="table_caption">
    Sales Orders
  </div>

  <form action="dashboard.php?view=orders" method="POST" class="searchNameForm">
    <label for="search">Search Customer Name</label>
    <input type="text" placeholder="Enter to Search" name="search">
  </form>

  <?php

  if (!empty($_POST['search'])) {

    $data = '%' . $_POST['search'] . '%';

    $orders = dbQuery("SELECT sales_orders.*, customers.customer_name, warehouses.warehouse_name, users.full_name
    FROM sales_orders
    JOIN customers
    ON sales_orders.customer_id = customers.customer_id
    JOIN warehouses
    ON sales_orders.warehouse_id = warehouses.warehouse_id
    JOIN users
    ON sales_orders.user_id = users.user_id
    WHERE customers.customer_name LIKE '{$data}'
    ORDER BY sales_orders.sale_id DESC ");
  } else {

    $orders = dbQuery("SELECT sales_orders.*, customers.customer_name, warehouses.warehouse_name, users.full_name
    FROM sales_orders
    JOIN customers
    ON sales_orders.customer_id = customers.customer_id
    JOIN warehouses
    ON sales_orders.warehouse_id = warehouses.warehouse_id
    JOIN users
    ON sales_orders.user_id = users.user_id
    ORDER BY sales_orders.sale_id DESC ");
  }

  ?>

  <table>
    <tr>
      <th>Serial</th>
      <th>Order ID</th>
      <th>Customer</th>
      <th>Warehouse</th>
      <th>Date</th>
      <th>Total</th>
      <th>Processed By</th>
      <th>Status</th>
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
            <?= $orders[$i]['warehouse_name'] ?>
          </td>
          <td>
            <?= $orders[$i]['sale_date'] ?>
          </td>
          <td>
            ৳<?= number_format((float) $orders[$i]['total_amount'], 2) ?>
          </td>
          <td>
            <?= $orders[$i]['full_name'] ?>
          </td>
          <td>
            <?= $orders[$i]['order_status'] ?>
          </td>
          <td>
            <?php if ($orders[$i]['order_status'] == 'pending') : ?>

              <form action="actions/confirm_order.php" method="POST" class="confirm_order_form">

                <input type="hidden" name="sale_id" value="<?= $orders[$i]['sale_id'] ?>">
                <button type="submit">
                  Confirm
                </button>
              </form>

            <?php else : ?>
              <span>
                Confirmed
              </span>

            <?php endif; ?>
          </td>
        </tr>
      <?php endfor; ?>

    <?php else : ?>

      <tr>
        <td colspan="9">
          No orders found.
        </td>
      </tr>
    <?php endif; ?>
  </table>
</div>