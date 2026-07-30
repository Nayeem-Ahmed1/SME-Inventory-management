<?php 
  $title = 'Login Page';

  include __DIR__ . '/views/header.php';
?>

  <div class="outer_container_login">
      <div class="login_card">
        <h2>Login</h2>
        <form action="" method="post">
          <div class="email_container">
            <Label for="email">EMAIL:</Label>
            <input id="email" type="text"/>
          </div>
          <div class="password_container">
            <Label for="pass">PASSWORD:</Label>
            <input id="pass" type="password"/>
          </div>
          <button type="submit">LOGIN</button>
        </form>
      </div>
</div>

</body>
</html>