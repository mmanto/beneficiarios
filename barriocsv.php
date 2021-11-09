<?
include("cabecera.php");
include ("conec.php");

$idBarrio = "41";

$sql = "SELECT * FROM dbo_familia where Barrio_nro = '$idBarrio' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela";

$res = mysql_query($sql);

$cant = mysql_num_rows($res);

echo $cant."</br>";

$nmbArchivo = "PBOLETO".date("Y").date("m").date("d").".csv";

//$file = fopen($nmbArchivo, "a+");


while ($familia = mysql_fetch_array($res)) {


$fliaNum = $familia["Familia_nro"];
$manzana = familia["Lote_manzana"];
$parcela = familia["Lote_parcela"];

echo $manzana." - ".$parcela."\r\n";

//fwrite($file, $manzana.";".$parcela."\r\n");

/*
$res2 = mysql_query("SELECT * FROM dbo_persona WHERE Familia_nro = $fliaNum AND Persona_baja != '1' AND blnActivo = '1'",$link);

while ($persona = mysql_fetch_array($res2);

$titular_dni = $persona["Persona_dni_nro"];
$titular_apellido = $persona["Persona_apellido"];
$titular_nombre = $persona["Persona_nombre"];


fwrite($file, $titular_dni.";".$titular_apellido.", ".$titular_nombre);

} 
fwrite($file, "/r/n");


*/

}

//fclose($file);


?>