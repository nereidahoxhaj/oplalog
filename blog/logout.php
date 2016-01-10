<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   $_SESSION['valid'] = false;
   
   echo 'You have cleaned session';
   header('Refresh: 1; URL = login.php');
?>