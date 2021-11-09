<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

mysql_select_db("MyTierras",$link);


$idPartido = $_GET["idPartido"];

$sql = "SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido"; 

$res = mysql_query($sql);

$partido = mysql_fetch_array($res);

//////// Escriturados ///////

$sql5 = "SELECT Familia_nro FROM dbo_familia WHERE Partido_nro = $idPartido AND Familia_matricula != 0";

$res5 = mysql_query($sql5);

$cant5 = mysql_num_rows($res5);

echo $partido["Partido_nombre"]."<br><br>";
echo $cant5;

?>