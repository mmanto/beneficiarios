<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$res = mysql_query("Select distinct Plano_num FROM dbo_familia WHERE Plano_num != '0' AND blnActivo = '1' ORDER BY Plano_num");

$cant = mysql_num_rows($res);

echo "Planos: ".$cant."</br></br>";

while ($familia = mysql_fetch_array($res)) {
	
$planoOrig = $familia["Plano_num"];

$anio2 = substr($planoOrig, -2);	

list($pdo,$num,$anio) = explode("-",$planoOrig);



$plano1 = $cadena[0];



	
	echo $planoOrig." ** ".$pdo."-".$num."-".$anio2."</br>";
	
	
	

}