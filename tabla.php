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


$url = 'http://test.analitica.com.co/AZDigital_Pruebas/WebServices/SOAP/index.php'; 

$xmlr =  '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsds="http://www.analitica.com.co/AZDigital/xsds/">
   <soapenv:Header/>
   <soapenv:Body>
      <xsds:BuscarArchivo >
         <Condiciones>
            <!--1 or more repetitions:-->
            <Condicion Tipo="FechaInicial" Expresion="2019-07-01 00:00:00"/>
         </Condiciones>
      </xsds:BuscarArchivo>
   </soapenv:Body>
</soapenv:Envelope>' ; 


$opciones = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $xmlr
    )
);

$contexto = stream_context_create($opciones);

$resultado = file_get_contents($url, false, $contexto);
$lineas = preg_split('/\r\n|\r|\n/', $resultado);

foreach ($lineas as $value){
  $linea= explode("\"",$value) ; 
  $findme   = 'Archivo ';
  $pos = strpos($value, $findme);
  if ($pos === false) {}else{
    echo $linea[1]."  -----  ".$linea[3]."<br>";
    
    
    
    $enlace=conectar();
    mysqli_query($enlace,"

    INSERT INTO   tabla1
    ( id,
    nombre  )
    VALUES
    ( '".$linea[1]."',
      '".$linea[3]."' );
    " );
     desconectar($enlace);
     
    
  }// si es valido
}//fin for
 
echo 'FIN';
?> 
