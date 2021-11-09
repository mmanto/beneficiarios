<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?php
include ("conec.php");


$sql = mysql_query("SELECT * FROM dbo_familia where Familia_nro = 2619
OR Familia_nro = 2619
OR Familia_nro = 2620
OR Familia_nro = 2621
OR Familia_nro = 2622
OR Familia_nro = 2624
OR Familia_nro = 2625
OR Familia_nro = 2627
",$link);

while ($fam = mysql_fetch_array($sql)) {

echo $fam["Familia_apellido"]." - ".$fam["Familia_resolucion"]."<br />";

}

/*
$upd = "UPDATE dbo_familia SET Familia_resolucion = '675/07' WHERE Familia_nro = 2619
OR Familia_nro = 2619
OR Familia_nro = 2620
OR Familia_nro = 2621
OR Familia_nro = 2622
OR Familia_nro = 2624
OR Familia_nro = 2625
OR Familia_nro = 2627";

if (mysql_query ($upd,$link)) {echo "Actualizado"; }else{echo "Error<br>";}

*/
?>
</body>
</html>
