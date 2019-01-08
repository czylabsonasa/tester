<?php
if( isset($_FILES["forras"] ) && $_FILES[ "forras" ][ "size" ] > 0 ) 
{
	if( $_FILES[ "forras" ][ "size" ] > $maxSourceSize )
	{
		echo "A forrás nem lehet nagyobb mint $maxSourceSize bájt" ;
		exit( 1 ) ;
	}
	include( "titok.php" ) ;
	if( ! isset( $titok[ $_POST[ "ember" ] ] ) )
	{
		echo "No such user." ;
		exit( 2 ) ;
	}
	if( $titok[ $_POST[ "ember" ] ] != $_POST[ "jelszo" ] )
	{
		echo "Incorrect passsword." ;
		exit( 3 ) ;
	}
	
	while( true )
	{
		$f_sorszam = fopen( $countFile , 'r+' ) ;
		if( flock( $f_sorszam , LOCK_EX ) == true )
		{
			$sorszam = ( int ) fread( $f_sorszam , 42 ) ;
			$sorszam += 1 ;
			fseek( $f_sorszam , 0 ) ;
			fprintf( $f_sorszam , "%07d" , $sorszam ) ;
//fwrite( $f_sorszam , $sorszam ) ;
			fclose( $f_sorszam ) ;
			break ;
		}
	}

$_ide="index.php?eredmeny=".$_POST[ "feladat" ] ;
echo <<< FELTOLTVE
<b>Ok. A forrás fogadva. Programod sorszáma: $sorszam</b>
<a href=$_ide>  Hadném! </a>
FELTOLTVE;

	$nev = $sorszam."_".$_POST[ "ember" ]."_".$_POST[ "nyelv" ]."_".$_POST[ "feladat" ] ;
	chmod( $_FILES[ 'forras' ][ 'tmp_name' ] , 0660 ) ;
	move_uploaded_file( $_FILES[ 'forras' ][ 'tmp_name' ] , $toBack."/".$nev ) ;

}
else
{
$FN = $_GET[ "feltolt" ] ;
echo <<< FORM
	<form enctype="multipart/form-data" action="$_SERVER[PHP_SELF]" method="post">
		Név:
		<input type="text" name="ember"> </input>
		Jelszó:
		<input type="password" name="jelszo"> </input>
		<br>
		Nyelv:
		<select name="nyelv"> 
		<option value='c' > c </option>
		<option value='cc' > c++ </option>
		</select>
		Forrás:
		<input type="file" name="forras"> </input>
		<br>
		<input type="submit" value="Mehet"> </input>
		<input type="hidden" name="feladat" value=$FN> </input>
	</form>
FORM;
}
?>
