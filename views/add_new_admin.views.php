<div class="add_new_admin_container">
  <div class="add_new_caption">
    Add New Admin
  </div>
  <form action="actions/add_admin.php" enctype="multipart/form-data" method="POST">
    <div>
      <label for="full_name">Full Name :</label>
      <input type="text" class="special_field" name="full_name" required>
    </div>
    <div>
      <label for="email">Email :</label>
      <input type="email" class="special_field" name="email" required>
    </div>
    <div>
      <label for="phone">Phone :</label>
      <input type="text" name="phone" class="special_field">
    </div>
    <div>
      <label for="password">Password :</label>
      <input type="password" class="special_field" name="password" required>
    </div>
    <div>
      <label for="c_password">Confirm Password :</label>
      <input type="password" name="c_password" class="special_field">
    </div>
    <div>
      <label for="pp">Choose Photo :</label>
      <input type="file" name="pp" accept="image/*">
    </div>
    <div>
      <button type="submit">CREATE</button>
    </div>
  </form>
</div>