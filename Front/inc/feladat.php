<?php 
	print "<table border=1>" ;
// fejlec
echo <<< _TETEJE
<tr>
<td> Feladat </td>
<td> Feltöltés </td>
<td> <a href="index.php?eredmeny=_MIND_"> Eredmény </a> </td>
</tr>
_TETEJE;

// tobbi
		$_f=fopen( $problemList , "r" ) ;
		while( $_fnev = fgets( $_f ) )
		{
echo <<< _EGY
<tr>
<td><a href='index.php?mutat=$_fnev'> $_fnev </a></td>
<td><a href='index.php?feltolt=$_fnev'> + </a> </td>
<td><a href='index.php?eredmeny=$_fnev'> + </a> </td>
</tr>
_EGY;
		}
	print "</table>" ;
?>
