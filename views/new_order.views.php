<?php

$customers = dbQuery(" SELECT * FROM customers ORDER BY customer_name ");

$warehouses = dbQuery(" SELECT * FROM warehouses ORDER BY warehouse_name");
?>

<div class="new_order_container">
  <div class="new_order_caption">
    Create New Sales Order
  </div>

  <form
    action="actions/create_order.php"
    method="POST">
    <div>
      <label>Customer</label>
      <select name="customer_id" required>
        <option value="">
          Select Customer
        </option>

        <?php foreach ($customers as $customer) : ?>

          <option value="<?= $customer['customer_id'] ?>">
            <?= $customer['customer_name'] ?>
          </option>

        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>Warehouse</label>
      <select name="warehouse_id" required>
        <option value="">
          Select Warehouse
        </option>

        <?php foreach ($warehouses as $warehouse) : ?>

          <option value="<?= $warehouse['warehouse_id'] ?>">
            <?= $warehouse['warehouse_name'] ?>
          </option>

        <?php endforeach; ?>

      </select>
    </div>
    <div>
      <label>Sale Date</label>
      <input class="special_field" type="date" name="sale_date" value="<?= date('d-m-Y') ?>" required>
    </div>

    <div>
      <button type="submit">
        Create Order
      </button>
    </div>

  </form>
</div>