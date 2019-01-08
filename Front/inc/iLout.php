<?php
  $_SESSION["user"]=null;
  unset($_SESSION["user"]);
  session_unset();
  session_destroy();
  //$_SESSION=null;
  header("location: index.php");
  exit;
?>

