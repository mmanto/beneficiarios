<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT Persona_nro, Persona_nombre_completo FROM dbo_persona_bk_201403102 WHERE blnConv1 = '0' AND Persona_idmigra != '0' ORDER BY Persona_nro ASC LIMIT 10000");

$cant = mysql_num_rows($res);


echo "Actualizando registros: </br>";


while ($persona = mysql_fetch_array($res)) {

$idPersona = $persona["Persona_nro"];

$nombre = $persona["Persona_nombre_completo"];

$nombre = explode(" ",$nombre);

$apellido = strtolower($nombre[0]);

$nomb02 = strtolower($nombre[1]);

$nomb03 = strtolower($nombre[2]);

$nomb04 = strtolower($nombre[3]);


//Apellido
$apellido_new = ucwords($apellido);

//Nombre

$nomb02a = ucwords($nomb02);

$nomb03a = ucwords($nomb03);

$nomb04a = ucwords($nomb04);

$nombre_new = $nomb02a." ".$nomb03a." ".$nomb04a;

//echo $nombre_new." ".$apellido_new;


$upd = "UPDATE dbo_persona_bk_201403102 SET 
Persona_apellido = '$apellido_new',
Persona_nombre = '$nombre_new',
blnConv1 = '1'
where Persona_nro = '$idPersona '";


echo $idPersona;

if (mysql_query($upd,$link))  { 

echo "Ok</br>";

 }else{ echo "error"; }


}




?>