<?php 
  session_start();
  if(!empty($_SESSION['user_id'])) :

  $title = 'Dashboard';

  include __DIR__ . '/views/header.php';
?>

  <div class="dashboard_container">
    <div class="nav"></div>
    <div class="sidebar"></div>
    <div class="main"></div>
  </div>

</body>
</html>

<?php else : header('Location: login.php'); die(); endif ?>
