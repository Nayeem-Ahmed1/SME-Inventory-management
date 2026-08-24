<?php
session_start();
if (!empty($_SESSION['user_id'])) :

  $title = 'Edit Profile';

  include __DIR__ . '/views/header.php';
  include __DIR__ . '/config/db.config.php';
  include __DIR__ . '/inc/func/image_resize.php';

  if (!empty($_GET['id'])) {
    $id = (int) $_GET['id'];
  } else {
    $id = (int) $_SESSION['user_id'];
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    $password = $_POST['password'];
    $c_password = $_POST['c_password'];

    if (!empty($password) && $password !== $c_password) {
      die("Passwords do not match.");
    }

    $sql = "UPDATE users SET full_name = '{$name}',phone = '{$phone}',email = '{$email}'WHERE user_id = {$id}";

    dbQuery($sql);

    $_SESSION['full_name'] = $name;

    if (!empty($password)) {

      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $sql = "UPDATE users SET user_password = '{$hashed_password}' WHERE user_id = {$id}";

      dbQuery($sql);
    }

    if ($_SESSION['role_name'] === 'admin') {

      $status = $_POST['status'];
      $role_id = (int) $_POST['role'];

      $sql = "UPDATE users SET user_status = '{$status}' WHERE user_id = {$id}";
      dbQuery($sql);

      $sql = "UPDATE users SET role_id = {$role_id} WHERE user_id = {$id}";
      dbQuery($sql);
    }

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {

      $file_name = 'pp_' . (string) time() . '.jpg';

      $new_path = __DIR__ . '/uploads/' . $file_name;

      resizeImage($_FILES['profile_picture']['tmp_name'], $new_path);

      dbQuery("UPDATE users SET profile_picture = '{$file_name}' WHERE user_id = {$id}");
    }

    header("Location: profile.php?id={$id}");
    die();
  }

  $result_cur = dbQuery("SELECT * FROM users WHERE users.user_id = {$id}");
?>

  <div class="edit_profile_container">
    <form class="edit_card" action="edit_profile.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">

      <div class="pp">
        <?php if ($result_cur[0]['profile_picture'] != NULL) : ?>
          <img src="uploads/<?= $result_cur[0]['profile_picture'] ?>" alt="pp">
        <?php else :  ?>
          <img src="uploads/default.jpeg" alt="pp">
        <?php endif; ?>
      </div>
      <div class="upload_pp">
        <input type="file" accept="image/*" name="profile_picture" />
      </div>

      <?php if ($_SESSION['role_name'] === 'admin') : ?>

        <div>
          <label for="status">Change Status :</label>

          <select name="status" id="status">
            <option value="active"
              <?= $result_cur[0]['user_status'] === 'active' ? 'selected' : '' ?>>
              Active
            </option>

            <option value="inactive"
              <?= $result_cur[0]['user_status'] === 'inactive' ? 'selected' : '' ?>>
              Inactive
            </option>
          </select>
        </div>


        <?php
        $roles = dbQuery("SELECT role_id, role_name FROM roles");
        ?>

        <div>
          <label for="role">Change Role :</label>

          <select name="role" id="role">

            <?php foreach ($roles as $role) : ?>

              <option value="<?= $role['role_id'] ?>" <?= $role['role_id'] == $result_cur[0]['role_id'] ?  'selected' : '' ?>>
                <?= $role['role_name'] ?>
              </option>

            <?php endforeach; ?>

          </select>
        </div>

      <?php endif; ?>

      <div class="edit_details">
        <h3>Edit Details :</h3>
        <br>
        <div>
          <label for="name">Full Name :</label>
          <input type="text" id="name" value="<?= $result_cur[0]['full_name']; ?>" name="name" required>
        </div>
        <br>
        <div>
          <label for="phone">Phone :</label>
          <input type="text" id="phone" value="<?= $result_cur[0]['phone']; ?>" name="phone" required>
        </div>
        <br>
        <div>
          <label for="email">Email :</label>
          <input type="email" id="email" value="<?= $result_cur[0]['email'] ?>" name="email" required>
        </div>
        <br>
        <div>
          <label for="password">New Password :</label>
          <input type="password" id="password" placeholder="type.." name="password">
        </div>
        <br>
        <div>
          <label for="c_password">Confirm Password :</label>
          <input type="password" id="c_password" placeholder="type.." name="c_password">
        </div>
      </div>

      <button type="submit">
        Save Changes
      </button>

    </form>
    <a class="back_to_dashboard" href="dashboard.php"><- Back to Dashboard</a>
  </div>

<?php else : header('Location: login.php');
  die();
endif; ?>