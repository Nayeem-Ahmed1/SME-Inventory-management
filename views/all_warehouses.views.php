<div class="all_container">
  <div class="table_caption">
    All Warehouses List
  </div>

  <table>
    <tr>
      <th>Serial</th>
      <th>Warehouse Name</th>
      <th>Location</th>
      <th>Created At</th>
      <th>Actions</th>
    </tr>

    <?php
    $results = dbQuery(
      "SELECT * FROM warehouses ORDER BY warehouse_id DESC"
    );
    ?>
    <?php if (!empty($results)) : ?>
      <?php for ($i = 0; $i < count($results); $i++) : ?>
        <tr>
          <td>
            <?= $i + 1 ?>
          </td>
          <td>
            <?= $results[$i]['warehouse_name'] ?>
          </td>
          <td>
            <?= $results[$i]['location'] ?>
          </td>
          <td>
            <?= $results[$i]['created_at'] ?>
          </td>
          <td>
            <a href="edit_warehouse.php?id=<?= $results[$i]['warehouse_id'] ?>">
              Edit
            </a>
            <a
              class="delete_button"
              href="inc/delete_warehouse.php?id=<?= $results[$i]['warehouse_id'] ?>">
              Delete
            </a>
          </td>
        </tr>
      <?php endfor; ?>
    <?php else : ?>
      <tr>
        <td colspan="5">
          No warehouses found.
        </td>
      </tr>
    <?php endif; ?>
  </table>
</div>