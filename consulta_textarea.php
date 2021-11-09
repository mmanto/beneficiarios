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

$textArea = $_POST["textArea"];

$textArea = explode("\n", $textArea);
$i = 0;

foreach($textArea as $ta)
{
       	$res = mysql_query("SELECT * FROM dbo_persona WHERE Persona_dni_nro = $ta",$link);
    
		$rsArt = mysql_fetch_array($res);
		
		$cant = mysql_num_rows($res);
	
	if($cant > 0) {
	
		echo "<h2>".$rsArt["Persona_dni_nro"]." - ".$rsArt["Persona_apellido"].", ".$rsArt["Persona_nombre"]."</h2>";
		$i++;
	}	
		
		
}
echo "<h2>Se han encontrado ". $i ." coincidencias</h2>"; ?>
<a href="javascript:history.go(-1)">Volver</a>  

</body>
</html>
