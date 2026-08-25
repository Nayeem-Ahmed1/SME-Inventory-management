<?php
$units = dbQuery("SELECT * FROM units ORDER BY unit_id DESC");
?>

<div class="unit_container">
  <div class="unit_caption">
    Units
  </div>

  <form action="actions/add_unit.php" method="POST">
    <div>
      <label>Unit Name</label>
      <input class="special_field" type="text" name="unit_name" placeholder="Enter unit name" required>
    </div>
    <button type="submit">
      Add Unit
    </button>
  </form>

  <div class="unit_table">
    <table>
      <tr>
        <th>Serial</th>
        <th>Unit Name</th>
        <th>Created At</th>
      </tr>

      <?php for ($i = 0; $i < count($units); $i++) : ?>
        <tr>
          <td>
            <?= $i + 1 ?>
          </td>
          <td>
            <?= $units[$i]['unit_name'] ?>
          </td>
          <td>
            <?= $units[$i]['created_at'] ?>
          </td>
        </tr>

      <?php endfor; ?>
    </table>
  </div>
</div>