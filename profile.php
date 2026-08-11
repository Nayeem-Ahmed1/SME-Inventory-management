<?php
  session_start();
  if(!empty($_SESSION['user_id'])) :

  $title = 'Profile';

  include __DIR__ . '/views/header.php';
  include __DIR__ . '/config/db.config.php';

  $id = (int) $_SESSION['user_id'];

  $result = dbQuery("SELECT * FROM users WHERE users.user_id = {$id}");
?>

<div class="profile_container">
    <div class="left_side">
      <div class="top">
        <?php if($result[0]['profile_picture'] != NULL) : ?>
        <img src="uploads/<?= $result[0]['profile_picture'] ?>" alt="pp">
        <?php else :  ?>
        <img src="uploads/default.jpeg" alt="pp">
        <?php endif ; ?>
      </div>
      <h3>
        <?php echo $result[0]['full_name'] ?>
      </h3>
    </div>
    <div class="right_side">
      <div class="top">
          <h4>Personal Details :</h4>
          <p>&emsp;&emsp; Full Name : <?= $result[0]['full_name'] ?></p>
          <p>&emsp;&emsp; Email : <?= $result[0]['email'] ?> </p>
          <p>&emsp;&emsp; Phone : <?= $result[0]['phone'] ?></p>
      </div>
      <div class="bottom">
          <h4>Account Information :</h4>
          <p>&emsp;&emsp; Role : <?= $_SESSION['role_name'] ?></p>
          <p>&emsp;&emsp; Status : <?= $result[0]['user_status'] ?> </p>
          <?php $time = strtotime($result[0]['created_at']) ?>
          <p>&emsp;&emsp; Joined Date : <?= date('d/m/y',$time) ?></p>
          <br>
          <div>
            <a class="edit_option" href="edit_profile.php">Edit -></a>
          </div>
      </div>
    </div>
    <a class="back_to_dashboard" href="dashboard.php"><- Back to Dashboard</a>
</div>

<?php else : header('Location: login.php'); die(); endif; ?>