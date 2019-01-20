<?php
  $ret='<h2><a href="index.php?inc=info">infó</a></h2><br>';

  $f=fopen("problem/view/list","r");
  while( $line=fgets($f) ){
    $arr=explode("_",$line);
    $ret.="<h2><a href=index.php?view=".$arr[0].">".$arr[1]."</a></h2>";
  }
  echo $ret;

?>
