<div class="all_container">
  <div class="table_caption">
    Low Stock Products
  </div>
  <?php

  $results = dbQuery(" SELECT inventory.*,products.product_name, warehouses.warehouse_name FROM inventory
    JOIN products
    ON inventory.product_id = products.product_id
    JOIN warehouses
    ON inventory.warehouse_id = warehouses.warehouse_id
    WHERE ( inventory.current_stock - inventory.reserved_stock - inventory.damaged_stock
      ) > 0
    AND ( inventory.current_stock - inventory.reserved_stock - inventory.damaged_stock
      ) <= 10
    ORDER BY ( 
        inventory.current_stock - inventory.reserved_stock - inventory.damaged_stock ) ASC ");
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
          No low stock products found.
        </td>
      </tr>

    <?php endif; ?>
  </table>
</div>