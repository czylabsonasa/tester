<?php

function checkPwd(){ // check pwd
  include ( "udata.php" ) ;
  return ( isset( $_POST[ "uname" ] ) && isset( $uData[ $_POST[ "uname" ] ] ) && ( $uData[ $_POST[ "uname" ] ]["pwd"] == $_POST[ "password" ] ) );
}

function login(){
  global $gMagam, $gMsg, $gColl;
  if(true==checkPwd()){
    $_SESSION[ "uname" ] = $_POST[ "uname" ] ;
    array_push($gColl,array("inc","menu.php")) ;
    //mraron solution (dont resend the login datas with "browser back" problem)
    header("location: index.php");
    return;
  }
  $gMagam .= "/belépés"; 
  array_push($gColl,array("inc","login.php") ) ;
}

function getInfo($ut){
  $f=fopen($ut."/info","r");
  $h=explode("_",fgets($f));
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
    array_push( $gColl, array("inc",$elem.".php" ) ) ;
    return;
  }

  if(isset($_GET[ "view" ])){ // ezeket kell listazni tablazat formaban
    $elem=$_GET[ "view" ];
    $gMagam.="/".$gNevek[$elem];
    $w="problem/view/".$elem;
    array_push( $gColl, array("view",$w) ) ;
    return;
  }

  if(isset($_GET[ "prob" ])){ // feladatok
    $elem=$_GET[ "prob" ]; // ez a száma
    $h=getInfo("problem/id/".$elem);
    $gMagam.="/feladatok/".$h[1];
    array_push( $gColl, array("prob",$elem ) ) ;
    if(isset($_GET[ "sub" ])){ // feltöltés
      $gMagam.="/feltöltés";
      array_push( $gColl, array("sub",$elem ) ) ;
    }
    if(isset($_GET[ "res" ])){ // results
      $gMagam.="/eredmények";
      array_push( $gColl, array("res",$elem ) ) ;
    }

    
    return;
  }

}

// function userData($name){
//   $f=fopen("user/pool/".$name."/list","r");
//   $h=explode("_",fgets($f,1024));
//   fclose($f);
//   return $h;
// }

function pairs2file($arr, $ut){
  $f=fopen($ut,"w");
  foreach($arr as $k=>$v){
    fprintf($f,"%s=\"%s\"\n",$k,$v);
  }
  fclose($f);
}

function upload($pId){
//  echo "upload par=".$pId;
  global $gUname, $gUid, $gSrcMaxSize;

	if( isset($_FILES["source"]) && ($_FILES[ "source" ][ "size" ] > 0 )) {
    if( $_FILES[ "source" ][ "size" ] > $gSrcMaxSize ){
      return "Hiba. A forrás nem lehet nagyobb mint $gSrcMaxSize bájt" ;
    }

  if(file_exists("lock/".$gUid."_".$pId)){
    return "Hiba. Még van feldolgozatlan feltöltésed erre a feladatra.";
  }

  $subId=0;
  while( true ) {
    $f = fopen( "sub/count" , "r+" ) ; // az r+ az irhat is.
    if( flock( $f, LOCK_EX ) == true ) {
      $subId = ( int ) fread( $f, 42 ) ;
      $subId += 1 ;
      fseek( $f, 0 ) ;
      fwrite( $f , sprintf( "%d" , $subId ) ) ;
      fclose( $f ) ;
      break ;
    }
  }
  
  $uHead=getInfo("user/id/".$gUid);
  $pHead=getInfo("problem/id/".$pId);
// echo "---------------------------------------";
// echo "<br>";
// print_r($uHead);
// echo "---------------------------------------";
// echo "<br>";

  $arr=array(
    "subId"=>$subId,
    "problemId"=>$pId,
    "problemName"=>$pHead[1],
    "problemTitle"=>trim($pHead[2]),
    "userId"=>$uHead[0],
    "userName"=>$uHead[1],
    "langName"=>$_POST[ "lang" ]
  );
  
  pairs2file($arr, "work/toBack/".$subId."_data");

  chmod( $_FILES[ "source" ][ "tmp_name" ] , 0666 ) ; // tmp_name nevu file jon letre feltolteskor
//echo $_FILES[ 'source' ][ 'tmp_name' ] ;    
  move_uploaded_file( $_FILES[ "source" ][ "tmp_name" ] , "work/toBack/".$subId."_src" ) ;    
//    header("location: index.php?prob=".$prob);

  return "<b>Ok. A forrás továbbítva ($subId)</b>" ;

  }else{
return <<< FORM
	<form enctype="multipart/form-data" action="index.php?prob=$pId&sub" method="post">

  	<input type="submit" value="Mehet"> </input>
    <select name="lang"> 
      <option value='c++' > c++ </option>  
      <option value='julia' > julia </option>  
      <option value='octave' > octave/matlab </option>  
      <option value='c' > c </option>  
      </select>
    <input type="hidden" name="problem" value="$pId"> </input>
    <input type="file" name="source"> </input> 

    </form>
FORM;
  }


}


function view2table($ut){ // problem list-eknél
  $ret= "<table border=0>" ;
  $f=fopen( $ut."/head" , "r" ) ;
  $ret.=arr2row(explode("_",fgets($f)));
  fclose($f);

  $f=fopen( $ut."/list" , "r" ) ;

  while( $line = fgets( $f ) ) {
    $tok=explode( "_" , $line ) ;
$ret.= <<< _HD
<tr>
<td>$tok[0]</td>
<td>$tok[1]</td>
<td><a href="index.php?prob=$tok[0]"> $tok[2] </a> </td>
</tr>
_HD;
  }
  fclose($f);

  $ret.="</table>" ;
  return $ret;
}




function arr2row($arr){
  $ret="<tr> " ;
  foreach( $arr as $d ){
    $ret.=" <td>".$d."</td> " ;
  }
  $ret.=" </tr>\n" ;
  return $ret;
}


function list2table($ut){ // pl sub/list-nél
  $ret="<table border=1>\n" ;
  $f=fopen($ut."/head","r");
  $ret.=arr2row(explode("_",fgets($f)));
  fclose($f);

  
// tobbi            
  $f=fopen($ut."/list","r");

  while($line=fgets($f)) {
    $words=explode("_",$line);
//    echo count($words)."<br>";

    // if(0==count($words)){
    //   break;
    // }
    $ret.=arr2row($words);
  }
  $ret.="</table>\n" ;
  fclose($f);
  return $ret ;
}  

?>
