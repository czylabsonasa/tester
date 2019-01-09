<?php

function cP(){ //
  include ( "iPassword.php" ) ;
  return ( isset( $_POST[ "user" ] ) && isset( $pwd[ $_POST[ "user" ] ] ) && ( $pwd[ $_POST[ "user" ] ] == $_POST[ "password" ] ) );
}

function login(){
  global $MAGAM, $MSG, $COLL,$user;
  if(true==cP()){
    $_SESSION[ "user" ] = $_POST[ "user" ] ;
    $user=$_SESSION[ "user" ];
    array_push($COLL,array("inc","iMenu.php")) ;
    //mraron solution (dont resend the login datas with "browser back" problem)
    header("location: index.php");
    return;
  }
  $MAGAM .= "/belépés"; 
  array_push($COLL,array("inc","iLogin.php") ) ;
}

function getHead($num){
  $f=fopen("problem/".$num."/head","r");
  $h=explode("_",fgets($f,1024));
  fclose($f);
  return $h;
}

// function cProb($num){

//   $ut="problem/".$num;
// //print_r($h);
//   return array("rovid"=>$h[1],"hosszu"=>$h[2],"statement"=>$ut."/statement");
// }

function cGet(){// collect get params
  global $COLL,$MAGAM,$nevek;

  if(isset($_GET[ "inc" ])){ // ezek fájlok az inc-ben
    $elem=$_GET[ "inc" ];
    $MAGAM.="/".$nevek[$elem];
    $w="i".$elem.".php";
    array_push( $COLL, array("inc",$w ) ) ;
    return;
  }

  if(isset($_GET[ "probList" ])){ // ezeket kell listazni tablazat formaban
    $elem=$_GET[ "probList" ];
    $MAGAM.="/".$nevek[$elem];
    $w="problem/view/".$elem."/list";
    array_push( $COLL, array("probList",$w) ) ;
    return;
  }

  if(isset($_GET[ "prob" ])){ // feladatok
    $h=getHead($_GET[ "prob" ]);
    $MAGAM.="/feladatok/".$h[1];
    array_push( $COLL, array("prob",$h ) ) ;
    return;
  }
  if(isset($_GET[ "sub" ])){ // feltöltés
    $h=getHead($_GET[ "sub" ]);
    $MAGAM.="/feladatok/".$h[1]."/feltölt";
    array_push( $COLL, array("inc",$h ) ) ;
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
