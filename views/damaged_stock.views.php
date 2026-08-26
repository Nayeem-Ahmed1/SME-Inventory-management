<?php

$stocks = dbQuery("SELECT inventory.inventory_id, inventory.current_stock, inventory.reserved_stock, inventory.damaged_stock, products.product_name, warehouses.warehouse_name
  FROM inventory
  JOIN products
  ON inventory.product_id = products.product_id
  JOIN warehouses
  ON inventory.warehouse_id = warehouses.warehouse_id
  ORDER BY products.product_name ");

$damaged_stocks = dbQuery(" SELECT inventory.*, products.product_name, warehouses.warehouse_name
  FROM inventory
  JOIN products
  ON inventory.product_id = products.product_id
  JOIN warehouses
  ON inventory.warehouse_id = warehouses.warehouse_id
  WHERE inventory.damaged_stock > 0
  ORDER BY inventory.damaged_stock DESC ");
?>

<div class="damaged_stock_container">
  <div class="damaged_stock_caption">
    Damaged Stock
  </div>

  <form action="actions/mark_damaged_stock.php" method="POST">
    <div>
      <label>Product</label>
      <select name="inventory_id" required>
        <option value="">
          Select Product
        </option>

        <?php foreach ($stocks as $stock) : ?>
          <?php

          $available = $stock['current_stock'] - $stock['reserved_stock'] - $stock['damaged_stock'];
          ?>

          <option value="<?= $stock['inventory_id'] ?>">
            <?= $stock['product_name'] ?>-
            <?= $stock['warehouse_name'] ?>
            (Available: <?= $available ?>)
          </option>

        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>Damaged Quantity</label>
      <input class="special_field" type="number" name="damaged_quantity" min="1" required>
    </div>
    <div>
      <button type="submit">
        Mark as Damaged
      </button>
    </div>
  </form>

  <div class="damaged_stock_table">
    <table>
      <tr>
        <th>Serial</th>
        <th>Product</th>
        <th>Warehouse</th>
        <th>Current Stock</th>
        <th>Reserved</th>
        <th>Damaged</th>
        <th>Available</th>
      </tr>

      <?php if (!empty($damaged_stocks)) : ?>
        <?php for ($i = 0; $i < count($damaged_stocks); $i++) : ?>
          <?php
          $current_stock = $damaged_stocks[$i]['current_stock'];
          $reserved_stock = $damaged_stocks[$i]['reserved_stock'];
          $damaged_stock = $damaged_stocks[$i]['damaged_stock'];

          $available_stock = $current_stock - $reserved_stock - $damaged_stock;
          ?>
          <tr>
            <td>
              <?= $i + 1 ?>
            </td>
            <td>
              <?= $damaged_stocks[$i]['product_name'] ?>
            </td>
            <td>
              <?= $damaged_stocks[$i]['warehouse_name'] ?>
            </td>
            <td>
              <?= $current_stock ?>
            </td>
            <td>
              <?= $reserved_stock ?>
            </td>
            <td>
              <?= $damaged_stock ?>
            </td>
            <td>
              <?= $available_stock ?>
            </td>
          </tr>

        <?php endfor; ?>
      <?php else : ?>
        <tr>
          <td colspan="7">
            No damaged stock found.
          </td>
        </tr>
      <?php endif; ?>
    </table>
  </div>
</div>