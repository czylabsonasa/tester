<?php 
	print "<table border=0>" ;
echo <<< _TXT
<tr>
<td><tab>          </tab></td>
<td><tab>          </tab</td>
</tr>
_TXT;
  
  $f=fopen( $showList , "r" ) ;
  while( $line = fgets( $f ) )
  {
    $tok=explode( '_' , $line ) ;
echo <<< _EGY
<tr>
<td>$tok[1]</td>
<td><a href="index.php?prob=$tok[0]"> $tok[2] </a> </td>
</tr>
_EGY;
  }
	print "</table>" ;
fclose($f)
?>
