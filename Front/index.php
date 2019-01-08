<?php 
  //header("Cache-Control: no-cache, must-revalidate");
  session_start();
  set_include_path( "inc" );
  include("iPre.php");
  include("iFun.php");

  if(isset($_SESSION["user"])){
      $user=$_SESSION["user"] ;
      array_push($COLL, array("inc","iMenu.php" ));
      cGet();
  }else{
    login() ;
  }

  include( "iCollect.php" ) ;
  
?>
