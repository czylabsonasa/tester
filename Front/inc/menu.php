<?php
  echo "<ul>" ;
  foreach( $MenuElem as $elem => $arr )
  {
    if( isset( $arr[ "mutat" ] ) )
    {
$_tmp = $arr[ "nev" ] ;
echo <<< EgyElem
<li><a href="index.php?menuelem=$elem">$_tmp</a></li>
EgyElem;
echo "\n" ;
    }
  }
  echo "</ul>" ;
?>
