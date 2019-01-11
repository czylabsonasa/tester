<!DOCTYPE html>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> <?php echo  $gUser."@".$gMagam; ?> </title>
    <?php include( "css.php" ) ; ?>
  </head>




  <body>

  <?php if(isset($_SESSION["user"])) echo '<h2 style="text-align:right"> <a href="index.php?inc=lout">Kilépés</a> </h2>' ?>

    <h1><?php echo $gUser."@".$gMagam; ?> </h1>

    <?php echo $gMsg ; ?>
    <?php 
    foreach( $gColl as $idx => $val ){
      if("prob"==$val[0]){ //feladat
        $h=$val[1];
        echo '<div class="feladat">' ;
        include( "problem/".$val[1]."/statement" ) ; 
        echo '</div>';
        echo '<div class="feladatA">' ;
        echo '<a href=index.php?prob='.$val[1].'&sub> feltöltés </a>';
        echo '<a href=index.php?prob='.$val[1].'&res> eredmények </a>';        
        echo '</div>';

        continue;
      }

      if("inc"==$val[0] ){ //include az inc-ből
        include( $val[1] ) ; 
        continue;
      }
      if("probList"==$val[0]){ //ez feladatlistákat hoz be
        echo probList($val[1]) ;
        continue;
      }

      if("sub"==$val[0]){ //feltoltes
        echo '<div class="feladatB">' ;
        echo upload($val[1]) ;
        echo '</div>';
        continue;
      }
      if("res"==$val[0]){ //eredmények
        echo '<div class="feladatB">' ;
        echo result($val[1]) ;
        echo '</div>';
        continue;
      }


    }
    ?>
    <?php include( "footer.php" ) ; ?>
  <!--</div>-->
  

<!-- katex help: mraron -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.10.0-beta/dist/katex.min.css" integrity="sha384-9tPv11A+glH/on/wEu99NVwDPwkMQESOocs/ZGXPoIiLE8MU/qkqUcZ3zzL+6DuH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/katex@0.10.0-beta/dist/katex.min.js" integrity="sha384-U8Vrjwb8fuHMt6ewaCy8uqeUXv4oitYACKdB0VziCerzt011iQ/0TqlSlv8MReCm" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/katex@0.10.0-beta/dist/contrib/auto-render.min.js" integrity="sha384-aGfk5kvhIq5x1x5YdvCp4upKZYnA8ckafviDpmWEKp4afOZEqOli7gqSnh8I6enH" crossorigin="anonymous"></script>

  <script>
    renderMathInElement(document.body, {delimiters: [
            {left: "\\(", right: "\\)", display: false},
            {left: "$$", right: "$$", display: true}
        ]});

  </script>

  </body>






<!--    
<script type='text/javascript' src='MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML,local/local'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML' async></script> 
-->

</html>
