<?php
	print "<table border=1>" ;
	$jelzo=0 ;
	if( $_GET[ "eredmeny" ] == "_MIND_" ) $jelzo=1 ;
// fejlec
	print "<tr>" ;
	$reszek = array( 'Sorszám' , 'Ember' , 'Nyelv' , 
	'Feladat' , 'Érkezés' , '<a href=index.php?eredmeny='.$_GET[ "eredmeny" ].'> Eredmény </a>' ) ;
	if( $jelzo == 0 ) unset( $reszek[ 3 ] ) ;
	foreach( $reszek as $d )
	{
		print "<td>".$d."</td>" ;
	}
	print "</tr>" ;

// tobbi
	$ered=fopen( $subList , "r" ) ;
	while( $egy = fgets( $ered ) )
	{
		$reszek=explode( '_' , $egy ) ;
		if( ( $jelzo == 1 ) || ( $reszek[ 3 ] == $_GET[ "eredmeny" ] ) )
		{
			if( $jelzo == 0 )
				unset( $reszek[ 3 ] ) ;

			print "<tr>" ;
			foreach( $reszek as $d )
			{
				print "<td>".$d."</td>" ;
			}
			print "</tr>" ;
		}

	}

	print "</table>" ;
?>
