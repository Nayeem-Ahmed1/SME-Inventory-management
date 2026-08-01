<?php 
  session_start();
  if(!empty($_SESSION['user_id'])) :

  $title = 'Dashboard';

  include __DIR__ . '/views/header.php';
?>

  This is dashboard <br><br>

  <?php 
  var_dump($_SESSION);
   ?>

</body>
</html>

<?php else : header('Location: login.php'); die(); endif ?>
