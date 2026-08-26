<?php

$warehouses = dbQuery("SELECT * FROM warehouses ORDER BY warehouse_name");
$products = dbQuery("SELECT * FROM products ORDER BY product_name");
?>

<div class="add_stock_container">
  <div class="add_stock_caption">
    Add Stock
  </div>

  <form action="actions/add_stock.php" method="POST">

    <div>
      <label>Warehouse</label>=
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
      <label>Product</label>=
      <select name="product_id" required>
        <option value="">
          Select Product
        </option>
        <?php foreach ($products as $product) : ?>

          <option value="<?= $product['product_id'] ?>">
            <?= $product['product_name'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>Quantity</label>=
      <input class="special_field" type="number" name="quantity" min="1" required>
    </div>
    <div>
      <button type="submit">
        Add Stock
      </button>
    </div>
  </form>
</div>