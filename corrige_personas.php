<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

//$sql = "SELECT * FROM dbo_persona WHERE Persona_nro > 91631 AND Persona_nro < 91721";

//$sql = "SELECT * FROM dbo_persona WHERE Persona_nro > 91720 AND Persona_nro < 91810";

//$sql = "SELECT * FROM dbo_persona WHERE Persona_nro > 91809 AND Persona_nro < 91899";

//$sql = "SELECT * FROM dbo_persona WHERE Persona_nro > 91898 AND Persona_nro < 91992";

$sql = "SELECT Persona_dni_nro, Persona_apellido, Persona_nombre FROM dbo_persona WHERE Persona_nro > 82000 AND Persona_nro < 92000";



$res = mysql_query($sql); 

$cant = mysql_num_rows($res); ?>

<form action="corrige_personas_proceso.php" method="post">

<table width="400" border="0" cellspacing="5" cellpadding="0">
  <tr bgcolor="#EFEFEF"><td width="34%" height="30" align="center"><strong>Apellido</strong></td>
  <td width="39%" align="center"><strong>Nombre</strong></td>
  <td width="27%" align="center"><strong>Documento</strong></td></tr>
  <? 
$num_fila = 0; //inicializo variable para contar numero de filas.

$i = 1;
  
  while ($persona = mysql_fetch_array($res)) { ?>
  
  <input type="hidden" name="id<?=$i ?>" value="<?=$persona["Persona_nro"] ?>">
  <input type="hidden" name="cant" value="<? echo $cant; ?>">

<tr><td><strong><?=$persona["Persona_apellido"]?></strong></td><td><?=$persona["Persona_nombre"]?></td><td><input name="documento<?=$i ?>" type="text" id="documento<?=$i ?>" size="8" value="<?=$persona["Persona_dni_nro"]?>"/></td></tr>

<?
	$num_fila++;

	$i++;

}
?>
</table>
<p>&nbsp;  </p>
<p>
  <input name="enviar" type="submit" id="enviar" value="Corregir" />
</p>
</form>
</body>
</html>
