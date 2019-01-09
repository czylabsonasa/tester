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
        echo '<a href=index.php?prob='.$val[1].'&sub> Feltölt </a>';
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
      


    }
    ?>
    <?php include( "footer.php" ) ; ?>
  </div>

  </body>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.9.0/katex.min.js"></script>
  <script>document.addEventListener("DOMContentLoaded", function () {
    var mathElements = document.getElementsByClassName("math");
    for (var i = 0; i < mathElements.length; i++) {
      var texText = mathElements[i].firstChild;
      if (mathElements[i].tagName == "SPAN") { katex.render(texText.data, mathElements[i], { displayMode: mathElements[i].classList.contains("display"), throwOnError: false } );
    }}});</script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.9.0/katex.min.css">
  






<!--    

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.10.0/dist/katex.min.css" integrity="sha384-9eLZqc9ds8eNjO3TmqPeYcDj8n+Qfa4nuSiGYa6DjLNcv9BtN69ZIulL9+8CqC9Y" crossorigin="anonymous">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.10.0/dist/katex.min.js" integrity="sha384-K3vbOmF2BtaVai+Qk37uypf7VrgBubhQreNQe9aGsz9lB63dIFiQVlJbr92dw2Lx" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.10.0/dist/contrib/auto-render.min.js" integrity="sha384-kmZOZB5ObwgQnS/DuDg6TScgOiWWBiVt0plIRkZCmE6rDZGrEOQeHM5PcHi+nyqe" crossorigin="anonymous"
    onload="renderMathInElement(document.body);"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.10.0/dist/katex.css" integrity="sha384-xNwWFq3SIvM4dq/1RUyWumk8nj/0KFg4TOnNcfzUU4X2gNn3WoRML69gO7waf3xh" crossorigin="anonymous">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.10.0/dist/katex.js" integrity="sha384-UP7zD+aGyuDvxWQEDSRYcvoTxJSD82C6VvuEBktJZGo25CVhDstY9sCDHvyceo9L" crossorigin="anonymous"></script>

<script type='text/javascript' src='MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML,local/local'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML' async></script> 


  <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.9.0/katex.min.js"></script>
  <script>document.addEventListener("DOMContentLoaded", function () {
    var mathElements = document.getElementsByClassName("math");
    for (var i = 0; i < mathElements.length; i++) {
      var texText = mathElements[i].firstChild;
      if (mathElements[i].tagName == "SPAN") { katex.render(texText.data, mathElements[i], { displayMode: mathElements[i].classList.contains("display"), throwOnError: false } );
    }}});</script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.9.0/katex.min.css" />


-->

</html>
