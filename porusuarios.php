<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?
include ("conec.php");

$cant_total = 25;

$res= mysql_query("SELECT * FROM dbo_familia WHERE insert_usuario = 13 limit 0,$cant_total",$link);
$cant = mysql_num_rows($res);
echo "<b>".$cant."</b><br><br>";

while ($familia = mysql_fetch_array($res)) {
echo $familia["Familia_apellido"]."<br>";
}

?>
</body>
</html>