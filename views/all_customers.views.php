<div class="all_container">
  <div class="table_caption">
    All Customers List
  </div>

  <?php

  $results = dbQuery("SELECT * FROM customers ORDER BY customer_id DESC");
  ?>

  <table>
    <tr>
      <th>Serial</th>
      <th>Customer Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Address</th>
      <th>Outstanding Balance</th>
      <th>Actions</th>
    </tr>

    <?php if (!empty($results)) : ?>
      <?php for ($i = 0; $i < count($results); $i++) : ?>
        <tr>
          <td>
            <?= $i + 1 ?>
          </td>
          <td>
            <?= $results[$i]['customer_name'] ?>
          </td>
          <td>
            <?= $results[$i]['phone'] ?>
          </td>
          <td>
            <?= $results[$i]['email'] ?>
          </td>
          <td>
            <?= $results[$i]['address'] ?>
          </td>
          <td>
            ৳ <?= number_format((float)$results[$i]['outstanding_money'], 2) ?>
          </td>
          <td>
            <a href="edit_customer.php?id=<?= $results[$i]['customer_id'] ?>">
              Edit
            </a>
            <a class="delete_button" href="inc/delete_customer.php?id=<?= $results[$i]['customer_id'] ?>">
              Delete
            </a>
          </td>
        </tr>

      <?php endfor; ?>

    <?php else : ?>
      <tr>
        <td colspan="7">
          No customers found.
        </td>
      </tr>

    <?php endif; ?>
  </table>
</div>