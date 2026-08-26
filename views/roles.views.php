<?php

$roles = dbQuery("SELECT * FROM roles ORDER BY role_id DESC");
?>

<div class="role_container">
  <div class="role_caption">
    Roles
  </div>

  <form action="actions/add_role.php" method="POST">
    <div>
      <label>Role Name</label>
      <input class="special_field" type="text" name="role_name" placeholder="Enter role name" required>
    </div>
    <button type="submit">
      Add Role
    </button>
  </form>

  <div class="role_table">

    <table>
      <tr>
        <th>Serial</th>
        <th>Role Name</th>
        <th>Created At</th>
      </tr>

      <?php for ($i = 0; $i < count($roles); $i++) : ?>

        <tr>
          <td>
            <?= $i + 1 ?>
          </td>
          <td>
            <?= $roles[$i]['role_name'] ?>
          </td>
          <td>
            <?= $roles[$i]['created_at'] ?>
          </td>
        </tr>
      <?php endfor; ?>

    </table>
  </div>
</div>