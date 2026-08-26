<div class="all_container">

  <div class="table_caption">
    All Employees List
  </div>

  <form action="dashboard.php?view=all_employees" method="POST" class="searchNameForm">
    <label for="search">Search by Name</label>
    <input type="text" placeholder="Enter to Search" name="search">
  </form>

  <table>
    <tr>
      <th>Serial</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Role</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
    <?php

    if (!empty($_POST['search'])) {

      $data = '%' . $_POST['search'] . '%';

      $results = dbQuery(" SELECT users.*, roles.role_name FROM users JOIN roles ON users.role_id = roles.role_id WHERE roles.role_name != 'admin' AND users.full_name LIKE '{$data}'");
    } else {

      $results = dbQuery(" SELECT users.*, roles.role_name FROM users JOIN roles ON users.role_id = roles.role_id WHERE roles.role_name != 'admin' ");
    }

    for ($i = 1; $i <= count($results); $i++) :
    ?>
      <tr>
        <td>
          <?= $i ?>
        </td>
        <td>
          <?= $results[$i - 1]['full_name'] ?>
        </td>
        <td>
          <?= $results[$i - 1]['email'] ?>
        </td>
        <td>
          <?= $results[$i - 1]['phone'] ?>
        </td>
        <td>
          <?= $results[$i - 1]['role_name'] ?>
        </td>
        <td>
          <?= $results[$i - 1]['user_status'] ?>
        </td>
        <td>
          <a href="profile.php?id=<?= $results[$i - 1]['user_id'] ?>">
            View
          </a>
          <a href="edit_profile.php?id=<?= $results[$i - 1]['user_id'] ?>">
            Edit
          </a>
          <a class="delete_button" href="inc/delete_profile.php?id=<?= $results[$i - 1]['user_id'] ?>">
            Delete
          </a>
        </td>
      </tr>
    <?php endfor; ?>
  </table>
</div>