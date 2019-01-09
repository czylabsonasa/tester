<?php
	if( $_FILES[ "source" ][ "size" ] > 0 ) {
		if( $_FILES[ "source" ][ "size" ] > $gSrcMaxSize){
      echo "Hiba. A forrás nem lehet nagyobb mint $gSrcMaxSize bájt" ;
      exit( 1 ) ;
		}

    while( true ) {
      $f_cntr = fopen( 'cntr' , 'r+' ) ;
      if( flock( $f_cntr , LOCK_EX ) == true ) {
        $cntr = ( int ) fread( $f_cntr , 42 ) ;
        $cntr += 1 ;
        fseek( $f_cntr , 0 ) ;
        $cntr = sprintf( "%07d" , $cntr ) ;
        fwrite( $f_cntr , $cntr ) ;
        fclose( $f_cntr ) ;
        break ;
      }
    }
    
    echo "<b>Ok. A forrás továbbítva. Programod sorszáma: $cntr</b>" ;

    $cntr = $cntr."_".$_SESSION[ "user" ]."_".$_POST[ 'lang' ]."_".$FELADAT ;
    chmod( $_FILES[ 'source' ][ 'tmp_name' ] , 0666 ) ;
 		move_uploaded_file( $_FILES[ 'source' ][ 'tmp_name' ] , 'temp_web/'.$cntr ) ;    
	}else{
echo <<< FORM
	<form enctype="multipart/form-data" action="$_SERVER[PHP_SELF]" method="post">
  	Forrás:
  	<input type="file" name="source"> </input>
    Nyelv:
    <select name="lang"> 
      <option value='c' > c </option>  
      <option value='cc' > c++ </option>  
    </select>

  	<input type="submit" value="Mehet"> </input>
  	<input type="hidden" name="MAX_FILE_SIZE" value=32768> </input>
    <input type="hidden" name="problem" value="$FELADAT"> </input>
  </form>
FORM;
  }
?>
