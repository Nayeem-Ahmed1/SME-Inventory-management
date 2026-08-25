<?php

$roles = dbQuery("SELECT * FROM roles WHERE role_name != 'admin'");
?>

<div class="add_employee_container">

  <div class="add_employee_caption">
    Add New Employee
  </div>

  <form action="actions/add_employee.php" method="POST" enctype="multipart/form-data">

    <div>
      <label>Full Name</label>
      <input type="text" name="full_name" class="special_field" required>
    </div>

    <div>
      <label>Email</label>
      <input type="email" name="email" class="special_field" required>
    </div>

    <div>
      <label>Phone</label>
      <input type="text" name="phone" class="special_field" required>
    </div>

    <div>
      <label>Role</label>
      <select name="role_id" required>
        <option value="">
          Select Role
        </option>
        <?php foreach ($roles as $role) : ?>
          <option value="<?= $role['role_id'] ?>">
            <?= $role['role_name'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label>Password</label>
      <input type="password" name="password" class="special_field" required>
    </div>

    <div>
      <label>Confirm Password</label>
      <input type="password" name="c_password" class="special_field" required>
    </div>

    <div>
      <label>Profile Picture</label>
      <input type="file" name="pp" accept="image/*">
    </div>

    <div>
      <button type="submit">
        Add Employee
      </button>
    </div>
  </form>
</div>