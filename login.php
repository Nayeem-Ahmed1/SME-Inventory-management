<?php 
  $title = 'Login Page';

  include __DIR__ . '/views/header.php';
  include __DIR__ . '/config/db.config.php';
?>

  <?php

      $wrong_creds = false;

      if(!empty($_POST)){
        $email = $_POST['email'];
        $pass = $_POST['password'];

        var_dump($email);
        var_dump($pass);
        
        $result_pass = dbQuery("SELECT user_password FROM users WHERE email = '{$email}'");
        
        if(!empty($result_pass)) {

          $is_verified = password_verify($pass,$result_pass[0]['user_password']);
          
          if($is_verified) {
              session_start();

              $result_user = dbQuery("SELECT user_id,role_name,full_name FROM users JOIN roles ON roles.role_id = users.role_id WHERE email = '{$email}'");

              $_SESSION['user_id'] = $result_user[0]['user_id'];
              $_SESSION['role_name'] = $result_user[0]['role_name'];
              $_SESSION['full-name'] = $result_user[0]['full_name'];

              header("Location: dashboard.php");
              die();
          } else $wrong_creds = true;

        } else $wrong_creds = true;

      }
  ?>

  <div class="outer_container_login">
      <div class="login_card">
        <h2>Login</h2>
        <form action="login.php" method="post">
          <div class="email_container">
            <Label for="email">EMAIL:</Label>
            <input id="email" name="email" type="text" required/>
          </div>
          <div class="password_container">
            <Label for="pass">PASSWORD:</Label>
            <input id="pass" name="password" type="password" required/>
          </div>
          <?php if($wrong_creds) : ?>
          <div class="error_message">
            Email or Password is incorrect!
          </div>
          <?php endif ?>
          <button type="submit">LOGIN</button>
        </form>
      </div>
  </div>

</body>
</html>