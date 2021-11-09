<?
include("cabecera.php");
include ("conec.php");

$resolucion_busqueda = "628/07";
$fam_nro = "3034";

$res = mysql_query("SELECT * FROM dbo_familia where Familia_resolucion = '$resolucion_busqueda'",$link);
//$res = mysql_query("SELECT * FROM dbo_familia where Familia_nro = $fam_nro",$link);

-
$cant = mysql_num_rows ($res);

while($fam = mysql_fetch_array($res))
{
$familia_numero = $fam["Familia_nro"];
$res_num = $fam["Familia_resolucion"];
$familia_apellido = $fam["Familia_apellido"];

echo $familia_numero." - ".$familia_apellido." - ".$res_num."<br />";

}

echo $cant."<br>";
?>