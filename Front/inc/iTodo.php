<?php
include( "Akt.php" ) ;
$F="aux/".$FELADAT.".pdf" ;
$IO="aux/".$FELADAT."_IO.tgz" ;
echo <<< XXX
	Beadási határidő: <b> $HATARIDO </b>.<br>
  Az aktuális <a href=$F> feladat</a>.<br>
  Példa <a href=$IO> IO </a> az aktuális feladathoz. <br>
XXX;
?>
