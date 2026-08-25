<div class="all_container">
  <div class="table_caption">
    All Suppliers List
  </div>

  <table>

    <tr>
      <th>Serial</th>
      <th>Company Name</th>
      <th>Contact Person</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Payment Terms</th>
      <th>Actions</th>
    </tr>
    <?php
    $results = dbQuery("SELECT * FROM suppliers");

    for ($i = 1; $i <= count($results); $i++) :
    ?>

      <tr>
        <td><?= $i ?></td>
        <td>
          <?= $results[$i - 1]['company_name'] ?>
        </td>
        <td>
          <?= $results[$i - 1]['contact_person'] ?>
        </td>
        <td>
          <?= $results[$i - 1]['phone'] ?>
        </td>
        <td>
          <?= $results[$i - 1]['email'] ?>
        </td>
        <td>
          <?= $results[$i - 1]['payment_terms'] ?>
        </td>
        <td>
          <a href="supplier_profile.php?id=<?= $results[$i - 1]['supplier_id'] ?>">
            View
          </a>
          <a href="edit_supplier.php?id=<?= $results[$i - 1]['supplier_id'] ?>">
            Edit
          </a>
          <a class="delete_button" href="inc/delete_supplier.php?id=<?= $results[$i - 1]['supplier_id'] ?>">
            Delete
          </a>
        </td>

      </tr>

    <?php endfor; ?>

  </table>

</div>