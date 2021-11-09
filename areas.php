<?

include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT * FROM dbo_area WHERE Direccion_nro !='99'");


while ($area = mysql_fetch_array($res)) {


echo $area["Area_codigo"]." - ".$area["Area_nombre"]."</br>";

}



?>