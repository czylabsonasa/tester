<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> <?php echo  $user."@".$MAGAM; ?> </title>
    <?php include( "iCss.php" ) ; ?>
  </head>

  <body>
  <?php if(isset($_SESSION["user"])) echo '<h2 style="text-align:right"> <a href="index.php?inc=Lout">Kilépés</a> </h2>' ?>

    <h1><?php echo $user."@".$MAGAM; ?> </h1>

    <?php echo $MSG ; ?>
    <?php 
    foreach( $COLL as $idx => $val ){
      if("prob"==$val[0]){ //feladat
        $h=$val[1];
        echo '<div class="feladat">' ;
        include( "problem/".$h[0]."/statement" ) ; 
        echo '</div>';
        echo '<div class="feladatAla">' ;
        echo '<a href=index.php?sub='.$h[0]."> Feltölt </a>";
        echo '</div>';

        continue;
      }

      if("inc"==$val[0] ){ //include az inc-ből
        include( $val[1] ) ; 
        continue;
      }
      if("probList"==$val[0]){ //ez feladatlistákat hoz be
        $listFile=$val[1];
        include("iProbList.php");
        continue;
      }
    }
    ?>
    <?php include( "iFooter.php" ) ; ?>
  </div>
  </body>
<!--    
<script type='text/javascript' src='MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML,local/local'></script>
-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML' async></script> 

</html>
