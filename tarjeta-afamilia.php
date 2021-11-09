<?

include ("conec.php");
include ("funciones.php");


$sql = "SELECT * FROM dbo_tarjeta WHERE Persona_nro != '0' AND blnConv = '0' ORDER BY Tarjeta_numero LIMIT 0,500";

$res = mysql_query($sql);

$cant = mysql_num_rows($res);

echo "<strong>".$cant."</strong></br></br>";

while($tarjeta = mysql_fetch_array($res)) {

$tarjeta_nro = $tarjeta["Tarjeta_nro"];	
$persona_nro = $tarjeta["Persona_nro"];
	
$sql2 = "SELECT Familia_nro FROM dbo_persona WHERE Persona_nro = $persona_nro";

$res2 = mysql_query($sql2);		

$persona = mysql_fetch_array($res2);
$familia_nro = $persona["Familia_nro"];

$sql3 = "UPDATE dbo_tarjeta SET
		Familia_nro = '$familia_nro',
		blnConv = '1'
		WHERE Tarjeta_nro = '$tarjeta_nro'";

if(!mysql_query($sql3)) {

echo "ERROR</br>";

}else{
	
echo "OK - ".$tarjeta["Tarjeta_numero"]." - Persona: ".$persona_nro." - Familia: ".$familia_nro."</br>";
}
}
?>