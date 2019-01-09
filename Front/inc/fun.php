<?php

function checkPwd(){ // check pwd
  include ( "password.php" ) ;
  return ( isset( $_POST[ "user" ] ) && isset( $pwd[ $_POST[ "user" ] ] ) && ( $pwd[ $_POST[ "user" ] ] == $_POST[ "password" ] ) );
}

function login(){
  global $gMagam, $gMsg, $gColl,$gUser;
  if(true==checkPwd()){
    $_SESSION[ "user" ] = $_POST[ "user" ] ;
    $gUser=$_SESSION[ "user" ];
    array_push($gColl,array("inc","menu.php")) ;
    //mraron solution (dont resend the login datas with "browser back" problem)
    header("location: index.php");
    return;
  }
  $gMagam .= "/belépés"; 
  array_push($gColl,array("inc","login.php") ) ;
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

function collectGets(){// collect get params
  global $gColl,$gMagam,$gNevek;

  if(isset($_GET[ "inc" ])){ // ezek fájlok az inc-ben
    $elem=$_GET[ "inc" ];
    $gMagam.="/".$gNevek[$elem];
    $w=$elem.".php";
    array_push( $gColl, array("inc",$w ) ) ;
    return;
  }

  if(isset($_GET[ "probList" ])){ // ezeket kell listazni tablazat formaban
    $elem=$_GET[ "probList" ];
    $gMagam.="/".$gNevek[$elem];
    $w="problem/view/".$elem."/list";
    array_push( $gColl, array("probList",$w) ) ;
    return;
  }

  if(isset($_GET[ "prob" ])){ // feladatok
    $elem=$_GET[ "prob" ]; // ez a száma
    $h=getHead($elem);
    $gMagam.="/feladatok/".$h[1];
    array_push( $gColl, array("prob",$elem ) ) ;
    if(isset($_GET[ "sub" ])){ // feltöltés
      $gMagam.="/feltöltés";
      array_push( $gColl, array("sub",$elem ) ) ;
    }
  
    return;
  }

}


function upload($prob){
  global $gUser, $gSrcMaxSize;
	if( $_FILES[ "source" ][ "size" ] > 0 ) {

    if( $_FILES[ "source" ][ "size" ] > $gSrcMaxSize ){
      return "Hiba. A forrás nem lehet nagyobb mint $gSrcMaxSize bájt" ;
		}

    $count=0;
    while( true ) {
      $f = fopen( 'sub/count' , 'r+' ) ; // az r+ az irhat is.
      if( flock( $f, LOCK_EX ) == true ) {
        $count = ( int ) fread( $f, 42 ) ;
        $count += 1 ;
        fseek( $f, 0 ) ;
        fwrite( $f , sprintf( "%07d" , $count ) ) ;
        fclose( $f ) ;
        break ;
      }
    }
    

    $sName = $count."_".$gUser."_".$_POST[ 'lang' ]."_".$prob ;
    chmod( $_FILES[ 'source' ][ 'tmp_name' ] , 0666 ) ; // tmp_name nevu file jon letre feltolteskor
//echo $_FILES[ 'source' ][ 'tmp_name' ] ;    
    move_uploaded_file( $_FILES[ 'source' ][ 'tmp_name' ] , 'work/toBack/'.$sName ) ;    
//    header("location: index.php?prob=".$prob);

    return "<b>Ok. A forrás továbbítva ($count)</b>" ;

  }else{
return <<< FORM
	<form enctype="multipart/form-data" action="index.php?prob=$prob&sub" method="post">
  	Forrás:
  	<input type="file" name="source"> </input>
    Nyelv:
    <select name="lang"> 
      <option value='c' > c </option>  
      <option value='cc' > c++ </option>  
    </select>

  	<input type="submit" value="Mehet"> </input>
    <input type="hidden" name="problem" value="$prob"> </input>
  </form>
FORM;
  }


}


function probList($listFile){
  $f=fopen( $listFile , "r" ) ;
  $ret= "<table border=0>" ;
  while( $line = fgets( $f ) ) {
    $tok=explode( '_' , $line ) ;
$ret.= <<< _HD
<tr>
<td>$tok[1]</td>
<td><a href="index.php?prob=$tok[0]"> $tok[2] </a> </td>
</tr>
_HD;
  }
  fclose($f);

  $ret.="</table>" ;
  return $ret;
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
