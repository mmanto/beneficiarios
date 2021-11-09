<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$idDireccion = $user["Direccion_nro"];
$idNivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

$sqlDir = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dir = mysql_fetch_array($sqlDir);
$dirNombre = $dir["Direccion_nombre"];

$sqlDirProv = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dirprov = mysql_fetch_array($sqlDirProv);
$dirProvNombre = $dir["Direccion_dirprov"];

$sql789 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre,
Partido_nombre
FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) ORDER BY Partido_nombre ASC",$link);

//////////////////**************////////////////////

include ("funciones.php");

$exptenum = $_GET["id"];

$sql = "SELECT * FROM dbo_expte_reg WHERE Expte_nro = $exptenum";

$sql3 = mysql_query($sql);

$expte = mysql_fetch_array($sql3);	

$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_barrio = $expte["Barrio_nro"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];
$expte_partido = $expte["idPartido"];
$expte_origen = $expte["Expte_origen"];
$expte_observaciones = $expte["Expte_observaciones"];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Modificar expediente escrituración</title>
<style type="text/css">
<!--
body {
	margin-left: 70px;
	margin-top: 20px;
}
</style>

<link href="estilos.css" rel="stylesheet" type="text/css" />

<script>
function pulsar(e) {
  tecla = (document.all) ? e.keyCode :e.which;
  return (tecla!=13);
}
</script> 

<script language=JavaScript>
<!--

function inhabilitar(){
    alert ("No puede utilizar el boton derecho del mouse.\nPor favor, utilice sólo los comandos en pantalla.\nMuchas Gracias.")
    return false
}

document.oncontextmenu=inhabilitar

// -->
</script>
	
</head>

<body>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="75" valign="top"><img src="imagen/logo-ba2.jpg" width="720" height="70" /></td>
  </tr>
</table>
<?php

//include ("cabecera.php");
include ("conec.php");

$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);



?>

<!--Script para corroborar si el titular ya existe en la base de datos-->

 <table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Modificar informaci&oacute;n de expediente </h2></td>
  </tr>
</table>
<form action="expte_reg_modif.php" method="post" enctype="multipart/form-data" name="f" id="f">
<input type="hidden" name="Expte_nro" value="<? echo $exptenum; ?>" />
<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="67" height="24" valign="bottom"  >Caract.</td>
        <td width="70" valign="bottom"  >N&uacute;m.</td>
        <td width="82" valign="bottom"  >A&ntilde;o</td>
        <td height="16" valign="bottom"  >Alcance</td>
        <td width="68" height="16" valign="bottom"  >Cuerpo</td>
        <td width="245" valign="bottom">Direcci&oacute;n de origen</td>
      </tr>
      <tr>
        <td><input name="expte_caract" type="text" id="expte_caract" size="5" value="<?=$expte_caract; ?>" onkeypress="return pulsar(event)"/></td>
        <td><input name="expte_num" type="text" id="expte_num" size="5" value="<?=$expte_num; ?>" onkeypress="return pulsar(event)"/></td>
        <td><input name="expte_anio" type="text" id="expte_anio" size="4" value="<?=$expte_anio; ?>" onkeypress="return pulsar(event)"/></td>
        <td><input name="expte_alcance" type="text" id="expte_alcance" value="<?=$expte_alcance; ?>"  onkeypress="return pulsar(event)" value="-" size="4" />
	</td>
        <td><input name="expte_cuerpo" type="text" id="expte_cuerpo" value="<?=$expte_cuerpo; ?>" onkeypress="return pulsar(event)" value="-" size="4"/></td>
        <td><select name="expte_origen" id="expte_origen">
		<option value="0">Seleccione una dirección</option>
		<option value="1" <? if ($expte_origen == '1') { ?> selected <? } ?>>Dirección de Reg. Urbana y Dominial</option>
		<option value="2" <? if ($expte_origen == '2') { ?> selected <? } ?>>Dirección del Plan Familia Propietaria</option>
      </select></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td width="68">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	<table width="580" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="369" valign="bottom"  >Barrio</td>
        <td width="118" height="24" valign="bottom"  >&nbsp;</td>
        <td width="93" valign="bottom">&nbsp;</td>
      </tr>
      <tr>
        <td><select name="barrio_nro" id="barrio_nro">
  <option value="0">Seleccione un barrio</option>
  <?	  while ($barrio = mysql_fetch_array($sql789)) {	

$barrio_nro = $barrio["Barrio_nro"];
$barrio_partido = $barrio["Partido_nombre"];
$barrio_nombre = $barrio["Barrio_nombre"];
?>
  <option value="<? echo $barrio_nro; ?>"
<? if($barrio_nro == $expte_barrio) { ?>selected="selected"<? } ?>><?=$barrio_partido; ?> - <?=$barrio_nombre; ?></option>
  <? } ?>
</select></td>
        <td>&nbsp;</td>
        <td>&nbsp;        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table> 
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="252">&nbsp;</td>
        <td width="150">&nbsp;</td>
        <td valign="bottom"  >&nbsp;</td>
      </tr>
      <tr>
        <td>Observaciones</td>
        <td>&nbsp;</td>
        <td valign="bottom"  >&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><label>
          <textarea name="expte_obs" cols="110" rows="5" id="expte_obs"><? echo $expte_observaciones; ?></textarea>
        </label></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="7"></td>
  </tr>
</table>
  <table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="99"></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="481" align="right">&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Actualizar"  /></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?=$expte_barrio; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>
