<?

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

$sql = "SELECT * FROM dbo_familia WHERE length(Familia_telefono) != 0 AND blnConv3 = 0 LIMIT 0,200";

$res = mysql_query($sql);

$cant = mysql_num_rows($res);

echo "<h2>".$cant."</h2>";

while ($familia = mysql_fetch_array($res)) {

$familia_nro = $familia["Familia_nro"];
$familia_telefono = $familia["Familia_telefono"];


echo $familia_nro." - ".$familia_telefono." ***** ";

$sql2 = "SELECT Persona_nro FROM dbo_persona WHERE Familia_nro = $familia_nro ORDER BY Persona_nro";

$res2 = mysql_query($sql2);

while ($persona = mysql_fetch_array($res2)) {

$persona_nro = $persona["Persona_nro"];

//echo $persona_nro.", ";

$sql3 = "UPDATE dbo_persona SET
		Persona_telefono = '$familia_telefono'		
		WHERE Persona_nro = $persona_nro AND length(Persona_telefono) = 0";

if(!mysql_query($sql3)) { echo "ERROR, "; }else{  echo "OK, "; }

}

$sql4 = "UPDATE dbo_familia SET
		blnConv3 = '1'		
		WHERE Familia_nro = $familia_nro";
		
if(!mysql_query($sql4)) {echo " ERROR"; }else{ echo " OK "; }	

echo "</br>";

}
