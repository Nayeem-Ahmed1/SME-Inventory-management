<div class="all_admins_container">
  <div class="admins_table_caption">
    All Admins List
  </div>
  <table>
    <tr>
      <th>Serial</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
    <?php
    $results = dbQuery('SElECT * FROM users WHERE role_id = 1');

    for ($i = 1; $i <= count($results); $i++) :
    ?>
      <tr>
        <td><?= $i ?></td>
        <td><?= $results[$i - 1]['full_name'] ?></td>
        <td><?= $results[$i - 1]['email'] ?></td>
        <td><?= $results[$i - 1]['phone'] ?></td>
        <td><?= $results[$i - 1]['user_status'] ?></td>
        <td>
          <a href="profile.php?id=<?= $results[$i - 1]['user_id'] ?>">View</a>
          <a href="edit_profile.php?id=<?= $results[$i - 1]['user_id'] ?>">Edit</a>
          <a class="delete_button" href="inc/delete_profile.php?id=<?= $results[$i - 1]['user_id'] ?>">Delete</a>
        </td>
      </tr>
    <?php endfor; ?>

  </table>
</div>