<?php
echo<<<_HD
  <div>
    A  következő nyelveken lehet feltölteni a feladatokat: 
    <ul>
      <li> c </li>
      <li> c++ </li>
    </ul>
    A programok fordítása (a fenti sorrendnek megfelelően):
    <ul>
      <li> gcc -ansi -lm </li>
      <li> g++ -ansi </li>
    </ul>
    programokkal illetve kapcsolókkal történik. <br>
    A programoknak a <b>szabványos bemenet</b>ről kell olvasniuk az adatokat illetve 
    a <b>szabványos kimenet</b>re kell írniuk az eredményt. A programoknak
    <b>3 másodperc</b>en belül kell a megoldást produkálniuk. Az értékelés 
    kétbetűs kódokkal történik: 
    <ul>
      <li> CE -- fordítási hiba (Compile Error) </li>
      <li> RE -- futás közben történt hiba (Runtime Error) </li> 
      <li> TE -- időkorlát túllépés (Timelimit Exceeded) </li>
      <li> WA -- rossz válasz (Wrong Answer) </li>
      <li> AC -- elfogadva (Accepted) </li> 
    </ul>
    </p>
  </div>
_HD;

?>
