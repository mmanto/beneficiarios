<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?php
include ("conec.php");


$sql = mysql_query("SELECT * FROM dbo_lote where Partido_nro = '74' AND Lote_seccion = 'R'",$link);

$cant = mysql_num_rows($sql);

while ($lote = mysql_fetch_array($sql)) {

echo $lote["Partido_nro"]." - ".$lote["Lote_circunscripcion"]." -".$lote["Lote_seccion"]."<br />";

}

echo "<p>".$cant."</p>";


/*
$upd = "UPDATE dbo_lote SET Lote_circunscripcion = 'VI' WHERE Partido_nro = '74' AND Lote_seccion = 'R'";

if (mysql_query ($upd,$link)) {echo "Actualizado"; }else{echo "Error<br>";}

*/

?>
</body>
</html>