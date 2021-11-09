<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<META HTTP-EQUIV="REFRESH" CONTENT="30;URL=http://10.31.5.18/sbt/migracion.php"> 
<title>Migracion ley 24.374</title>
</head>

<body>
<?php

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

$sql = "SELECT * FROM dbo_familia ORDER BY RAND() LIMIT 0,100000";

$fam = mysql_query($sql);

$row = 1;




?>
<h2>&nbsp;</h2>
<?

while ($familia = mysql_fetch_array ($fam)) {


echo $familia["Familia_nro"]." - ".$familia["Familia_apellido"]." - Proceso exitoso!<br/>";


$row++;
}

?>

<h2>Procesando...</h2>
</body>
</html>