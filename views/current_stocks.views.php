<div class="all_container">
  <div class="table_caption">
    Current Stocks
  </div>

  <form action="dashboard.php?view=current_stocks" method="POST" class="searchNameForm">
    <label for="search">Search by Product</label>
    <input type="text" placeholder="Enter to Search" name="search">
  </form>

  <?php

  if (!empty($_POST['search'])) {

    $data = '%' . $_POST['search'] . '%';

    $results = dbQuery(" SELECT inventory.*, products.product_name, products.product_image, warehouses.warehouse_name FROM inventory
        JOIN products
        ON inventory.product_id = products.product_id
        JOIN warehouses
        ON inventory.warehouse_id = warehouses.warehouse_id
        WHERE products.product_name LIKE '{$data}'
        ORDER BY warehouses.warehouse_name, products.product_name");
  } else {

    $results = dbQuery(" SELECT inventory.*, products.product_name, products.product_image, warehouses.warehouse_name FROM inventory
      JOIN products
      ON inventory.product_id = products.product_id
      JOIN warehouses
      ON inventory.warehouse_id = warehouses.warehouse_id
      ORDER BY warehouses.warehouse_name, products.product_name ");
  }


  ?>

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
    <?php if (!empty($results)) : ?>
      <?php for ($i = 0; $i < count($results); $i++) : ?>
        <?php
        $current_stock = $results[$i]['current_stock'];
        $reserved_stock = $results[$i]['reserved_stock'];
        $damaged_stock = $results[$i]['damaged_stock'];
        $available_stock = $current_stock - $reserved_stock - $damaged_stock;
        ?>

        <tr>
          <td>
            <?= $i + 1 ?>
          </td>
          <td>
            <?= $results[$i]['product_name'] ?>
          </td>
          <td>
            <?= $results[$i]['warehouse_name'] ?>
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
          No stock found.
        </td>
      </tr>
    <?php endif; ?>
  </table>
</div>