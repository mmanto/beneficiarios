<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

mysql_select_db("MyTierras",$link);



$cadena = "gal000000000021";

$code = substr($cadena, 0,3); 

$num = substr($cadena,-4);

//$num = str_replace("0","",$num);

$sql = "SELECT * FROM dbo_persona where Persona_nro = '$num'";
$res = mysql_query($sql);
$persona = mysql_fetch_array($res);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>


<?

echo $num."<br><br>";


echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"];




?>
</body>
</html>