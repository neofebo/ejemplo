<?php


define("DB_SERVER", "localhost");
define("DB_USER", "beto");
define("DB_PASS", "happy123");
define("DB_NAME", "EJEMPLO");


function conectar() {
  $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  $mysqli->set_charset("utf8");
  return $mysqli;
}

function desconectar($mysqli) {
    @mysqli_close($mysqli);
}



    $enlace=conectar();
    $result_que_user =mysqli_query($enlace,"

    SELECT COUNT(*) as contador FROM `tabla1` WHERE `nombre` LIKE '%.pdf%' LIMIT 50
    " );
while($rowgrup = mysqli_fetch_array($result_que_user, MYSQLI_ASSOC)) {
     echo 'total de pdf '. $rowgrup["contador"];
   }
     desconectar($enlace);


     $enlace=conectar();
    $result_que_user =mysqli_query($enlace,"

    SELECT COUNT(*) as contador FROM `tabla1` WHERE `nombre` LIKE '%.xml%' LIMIT 50
    " );
while($rowgrup = mysqli_fetch_array($result_que_user, MYSQLI_ASSOC)) {
     echo '<br>total de xml '. $rowgrup["contador"];
   }
     desconectar($enlace);
?> 
