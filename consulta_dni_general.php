<?
include ("cabecera.php");
include ("conec.php");
include ("funciones.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?

$fp = fopen ("personas_dni.txt","r"); 

$row = 0;

while ($data = fgetcsv ($fp, 10000, ";")) 

	{ 
	
	$persona_dni_nro = $data[0];
	
	$res = mysql_query("SELECT * FROM dbo_persona WHERE Persona_dni_nro = $persona_dni_nro",$link);
	
	$rsArt = mysql_fetch_array($res);
	
	$cant = mysql_num_rows($res);
	
	if($cant > 0) {
	
	$row++;
	
	echo "<h2>".$row." - ".$rsArt["Persona_dni_nro"]." - ".$rsArt["Persona_apellido"]." </td><td> ".$rsArt["Persona_nombre"]." ".$rsArt["Persona_nombre_completo"]."</h2>";


		}
	
	}

fclose ($fp); 	

if ($row=='0') {echo "<h2>No hay registros que coincidan con la b&uacute;squeda</h2>";}

?>
<a href="javascript:history.go(-1)">Volver al panel de administracion</a>
</body>
</html>
