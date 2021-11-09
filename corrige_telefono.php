<?

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

$sql = "SELECT Persona_nro, Persona_telefono, Familia_nro FROM dbo_persona WHERE length(Persona_telefono) = 0";

$res = mysql_query($sql);

$cant = mysql_num_rows($res);

echo "<h2>".$cant."</h2>";

while ($persona = mysql_fetch_array($res)) {

$idFamilia = $persona["Familia_nro"];

$sql2 = "SELECT Familia_telefono FROM dbo_familia WHERE Familia_nro = '$idFamilia'";

$res2 = mysql_query($sql2);

$familia = mysql_fetch_array($res2);

$familia_telefono = $familia["Familia_telefono"];

//$sql3 = "UPDATE dbo_persona SET Persona_telefono = 


echo $persona["Persona_telefono"]." - ".$familia_telefono."</br>";



//echo $persona["Persona_nro"]."-".$persona["Persona_telefono"]."</br>";



}