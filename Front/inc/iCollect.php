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
        echo '<div class="feladat">' ;
        include( $val[1] ) ; 
        echo '</div>';
        continue;
      }

      if("inc"==$val[0] || "prob"==$val[0]){ //include az inc-ből
        include( $val[1] ) ; 
        continue;
      }
      if("list"==$val[0]){ //ez feladatlistákat hoz be
        $showList=$val[1];
        include("iList.php");
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
