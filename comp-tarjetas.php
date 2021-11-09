<?
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$fila = '1';

$sql = "SELECT Familia_tarjeta_nro, Familia_nro FROM dbo_familia WHERE Familia_tarjeta_nro != '0' LIMIT 0,800";
$res = mysql_query($sql);

while ($familia = mysql_fetch_array($res)) {
$familia_nro = $familia["Familia_nro"];

$tarjeta_numero = $familia["Familia_tarjeta_nro"];



$sql2 = "SELECT * FROM dbo_persona WHERE Familia_nro = $familia_nro AND blnActivo = '1' AND Persona_baja != '1' ORDER BY Persona_nro ASC LIMIT 0,1";
$res2 = mysql_query($sql2);
$persona = mysql_fetch_array($res2);
$persona_nro = $persona["Persona_nro"];
$persona_nombre = $persona["Persona_nombre"];
$persona_apellido = $persona["Persona_apellido"];


$sql3 = "SELECT Tarjeta_numero FROM dbo_tarjeta WHERE Persona_nro = $persona_nro";
$res3 = mysql_query($sql3);
$tarjeta2 = mysql_fetch_array($res3);
$tarjeta2_numero = $tarjeta2["Tarjeta_numero"];

if($tarjeta_numero != $tarjeta2_numero) {

echo "Familia: ".$familia_nro." - Tarjeta: ".$tarjeta_numero." | ".$tarjeta2_numero." | </br>";

}
}