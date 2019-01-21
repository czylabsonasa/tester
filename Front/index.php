<?php 
  //header("Cache-Control: no-cache, must-revalidate");
  session_start();
  set_include_path( "inc" );
  include("pre.php");
  include("fun.php");

  if(isset($_SESSION["uname"])){
      $gUname=$_SESSION["uname"] ;
      $uH=getInfo("user/name/".$gUname);
//print_r($uH);
      $gUid=$uH[0];
      // echo "uname=".$gUname;
      // echo "<br>";
      // echo "uid=".$gUid;
      // echo "<br>";

      array_push($gColl, array("inc","menu.php" ));
      collectGets();
  }else{
    login() ;
  }

  include( "collect.php" ) ;
  
?>

