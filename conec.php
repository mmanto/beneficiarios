<?
$link=mysql_connect("tierrasDatabase:3306","root","manto21") or die ("Error en la conexion");
#$link=mysqli_connect("127.0.0.1","root","manto21", "mytierras",3306) or die ("Error en la conexion");
mysql_select_db("mytierras",$link);
mysql_set_charset('utf8');
error_reporting(E_ERROR);
?>
