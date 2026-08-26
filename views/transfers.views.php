<?php

$warehouses = dbQuery(" SELECT * FROM warehouses ORDER BY warehouse_name");

$products = dbQuery(" SELECT * FROM products ORDER BY product_name ");

$transfers = dbQuery(" SELECT warehouse_transfers.transfer_id,warehouse_transfers.transfer_date,transfer_items.quantity,products.product_name,from_wh.warehouse_name AS from_warehouse_name,to_wh.warehouse_name AS to_warehouse_name,users.full_name
FROM warehouse_transfers
JOIN transfer_items
ON warehouse_transfers.transfer_id = transfer_items.transfer_id
JOIN products
ON transfer_items.product_id = products.product_id
JOIN warehouses AS from_wh
ON warehouse_transfers.from_warehouse = from_wh.warehouse_id
JOIN warehouses AS to_wh
ON warehouse_transfers.to_warehouse = to_wh.warehouse_id
JOIN users
ON warehouse_transfers.user_id = users.user_id
ORDER BY warehouse_transfers.transfer_id DESC ");

?>


<div class="transfer_container">

  <div class="transfer_caption">
    Warehouse Transfer
  </div>

  <form action="actions/add_transfer.php" method="POST">

    <div>
      <label>From Warehouse</label>
      <select name="from_warehouse" required>
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
      <label>To Warehouse</label>
      <select name="to_warehouse" required>
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
      <label>Product</label>
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
      <label>Quantity</label>
      <input class="special_field" type="number" name="quantity" min="1" required>

    </div>

    <div>
      <label>Transfer Date</label>
      <input class="special_field" type="date" name="transfer_date" value="<?= date('d-m-Y') ?>" required>

    </div>

    <div>
      <button type="submit">
        Transfer -
      </button>
    </div>
  </form>

  <div class="transfer_table">

    <table>
      <tr>
        <th>Serial</th>
        <th>Transfer ID</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>From</th>
        <th>To</th>
        <th>Date</th>
        <th>Transferred By</th>
      </tr>

      <?php if (!empty($transfers)) : ?>

        <?php for ($i = 0; $i < count($transfers); $i++) : ?>

          <tr>
            <td>
              <?= $i + 1 ?>
            </td>
            <td>
              #<?= $transfers[$i]['transfer_id'] ?>
            </td>
            <td>
              <?= $transfers[$i]['product_name'] ?>
            </td>
            <td>
              <?= $transfers[$i]['quantity'] ?>
            </td>
            <td>
              <?= $transfers[$i]['from_warehouse_name'] ?>
            </td>
            <td>
              <?= $transfers[$i]['to_warehouse_name'] ?>
            </td>
            <td>
              <?= $transfers[$i]['transfer_date'] ?>
            </td>
            <td>
              <?= $transfers[$i]['full_name'] ?>
            </td>
          </tr>

        <?php endfor; ?>

      <?php else : ?>

        <tr>
          <td colspan="8">
            No warehouse transfers found.
          </td>
        </tr>

      <?php endif; ?>
    </table>
  </div>
</div>