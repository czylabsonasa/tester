<?php 
  //header("Cache-Control: no-cache, must-revalidate");
  session_start();
  set_include_path( "inc" );
  include("pre.php");
  include("fun.php");

  if(isset($_SESSION["user"])){
      $gUser=$_SESSION["user"] ;
      array_push($gColl, array("inc","menu.php" ));
      collectGets();
  }else{
    login() ;
  }

  include( "collect.php" ) ;
  
?>

