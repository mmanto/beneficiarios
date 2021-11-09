<?

include ("conec.php");


$res = mysql_query("SELECT * FROM dbo_persona WHERE Persona_nombre LIKE '%maria de los%'");
$cant = mysql_num_rows($res);

echo $cant."</br></br>";

while ($persona = mysql_fetch_array($res)) {

$idFamilia = $persona["Persona_nro"];

$res2 = mysql_query("SELECT * FROM dbo_persona_bk_20140310 WHERE Persona_nro = $idFamilia");

$persona2 = mysql_fetch_array($res2);


echo $persona["Persona_nro"]." - ".$persona["Persona_nombre"]." - ".$persona2["Persona_nombre"]." (".$persona2["Persona_nombre_completo"].") </br>";

}

?>