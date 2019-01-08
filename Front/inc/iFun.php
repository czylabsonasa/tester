<?php
function login(){
  global $MAGAM, $MSG, $COLL,$user;
  
  include ( "iPassword.php" ) ;
//  print_r($pwd);
  if( isset( $_POST[ "user" ] ) && isset( $pwd[ $_POST[ "user" ] ] ) ){
    //mraron solution, (dont resend the login datas with back problem)
    //header("location: index.php");
    if( $pwd[ $_POST[ "user" ] ] == $_POST[ "password" ] ){
      $_SESSION[ "user" ] = $_POST[ "user" ] ;
      $user=$_SESSION[ "user" ];
      array_push($COLL,array("inc","iMenu.php")) ;
      //mraron solution:
      header("location: index.php");
      return;
    }
  }
  $MAGAM .= "/belépés"; 
  array_push($COLL,array("inc","iLogin.php") ) ;
}

function cProb($num){
  $ut="home/problem/".$num;
  $f=fopen($ut."/title","r");
  $tit=explode("_",fgets($f,1024));
  fclose($f);
  return array("rovid"=>$tit[0],"hosszu"=>$tit[1],"st"=>$ut."/statement");
}

function cGet(){// collect get params
  global $COLL,$MAGAM,$nevek;

  if(isset($_GET[ "inc" ])){ // ezek fájlok az inc-ben
    $elem=$_GET[ "inc" ];
    $MAGAM.="/".$nevek[$elem];
    $w="i".$elem.".php";
    array_push( $COLL, array("inc",$w ) ) ;
    return;
  }

  if(isset($_GET[ "list" ])){ // ezeket kell listazni tablazat formaban
    $elem=$_GET[ "list" ];
    $MAGAM.="/".$nevek[$elem];
    $w="home/cat/".$elem."/list";
    array_push( $COLL, array("list",$w) ) ;
    return;
  }

  if(isset($_GET[ "prob" ])){ // feladatok
    $arr=cProb($_GET[ "prob" ]);
    $MAGAM.="/feladatok/".$arr["rovid"];
    array_push( $COLL, array("prob",$arr["st"]) ) ;
    return;
  }
}



function cRes($spec=false){ // collect res file
  $ret="<table border=1>" ;
  $ret.="\n<tr>" ;
  $words = array('Sorszám' , 'Nyelv' , 'Érkezés' , 'Eredmény' ) ;
  if(true==$spec){
    $words = array('Sorszám' , 'User','Nyelv' , 'Érkezés' , 'Eredmény' ) ;
  }
  foreach( $words as $d )
  {
    $ret.="<td>".$d."</td>" ;
  }
  $ret.="</tr>\n" ;
  
// tobbi            
  $f_res=fopen( "./res" , "r" ) ;
  while( $line = fgets( $f_res ) )
  {
    $words=explode( '_' , $line ) ;
//        array_splice( $words , 6 ) ;
    unset( $words[ 3 ] ) ; // ez a feladat
    if(true==$spec || $words[ 1 ]==$_SESSION[ "user" ] )
    {
      if(true != $spec ){ unset( $words[ 1 ] ) ; }
      $ret.="<tr>" ;
      foreach( $words as $d )
      {
        $ret.="<td>".$d."</td>" ;
      }
      $ret.="</tr>\n" ;
    }
  }
  $ret.="</table>\n" ;

  return $ret ;
}  

?>
