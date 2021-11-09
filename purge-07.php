<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre FROM dbo_persona_bk_201403102 WHERE blnConv = '0' ORDER BY Persona_nro ASC LIMIT 5000");

$cant = mysql_num_rows($res);


echo "Actualizando registros: ";



while ($persona = mysql_fetch_array($res)) {

$idPersona = $persona["Persona_nro"];



$apellido = $persona["Persona_apellido"];

$apellido1 = strtolower($apellido);

$apellido2 = ucwords($apellido1);

//echo $apellido2;

//echo "</br>";

$nombre = $persona["Persona_nombre"];

$nombre= explode(" ",$nombre);

$nomb01 = strtolower($nombre[0]);

$nomb02 = strtolower($nombre[1]);

$nomb03 = strtolower($nombre[2]);

$nomb01a = ucwords($nomb01);

$nomb02a = ucwords($nomb02);

$nomb03a = ucwords($nomb03);

$nombre2 = $nomb01a." ".$nomb02a." ".$nomb03a;


$upd = "UPDATE dbo_persona_bk_201403102 SET 
Persona_apellido = '$apellido2',
Persona_nombre = '$nombre2',
blnConv = '1'
where Persona_nro = '$idPersona '";


echo $idPersona;

if (mysql_query($upd,$link))  { 

echo "Ok</br>";

 }else{ echo "error"; }


}

echo "</br></br>Registros actualizados correctamente.";