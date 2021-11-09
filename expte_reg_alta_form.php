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

$idBarrio = $_GET["idBarrio"];

$sqlBo = mysql_query("SELECT * FROM dbo_barrio WHERE Barrio_nro = $idBarrio",$link);

$barrio1 = mysql_fetch_array($sqlBo);

$idPartido = $barrio1["Partido_nro"]; 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Alta expediente escrituración</title>
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
    <td height="75" valign="top"><img src="imagen/logo.jpg" width="600" height="63" /></td>
  </tr>
</table>
<?php

//include ("cabecera.php");
include ("conec.php");
require ("funciones.php");
/*
$res = mysql_query("SELECT Plano_codigo FROM dbo_plano ORDER BY Plano_codigo DESC LIMIT 0,1");
$plano = mysql_fetch_array($res);
$plano_cod = $plano["Plano_codigo"];

$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

$resol = mysql_query ("SELECT idResolucion, Resolucion_nombre FROM dbo_resolucion ORDER BY idResolucion ASC", $link);
*/
?>

<!--Script para corroborar si el titular ya existe en la base de datos-->

 <table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo expediente </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="javascript:history.back()">Volver</a></td>
	</tr>
	<tr>
	  <td height="15"></td>
  </tr>
</table>
<form action="expte_reg_alta.php" method="post" enctype="multipart/form-data" name="f" id="f">
<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
<input name="expte_barrio" type="hidden" id="expte_barrio" value="<?=$idBarrio; ?>"/>
<input name="idPartido" type="hidden" id="idPartido" value="<?=$idPartido; ?>"/>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="245"  ><strong>DIRECCION PROVINCIAL </strong></td>
        <td width="274"  ><strong>DIRECCION</strong></td>
        <td width="81"  ><strong>FECHA </strong></td>
      </tr>
      <tr>
        <td><input name="expte_dirprov" type="text" id="idDirprov" size="38" value="<? echo $dirProvNombre; ?>" onkeypress="return pulsar(event)"/></td>
        <td><input name="expte_direccion" type="text" id="expte_direccion" size="40" value="<? echo $dirNombre; ?>" onkeypress="return pulsar(event)"/></td>
		<td><input name="expte_insert_fecha" type="text" id="expte_insert_fecha" value="<?=date("d/m/Y"); ?>" size="8" align="right" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
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
        <td><input name="expte_caract" type="text" id="expte_caract" size="5" onkeypress="return pulsar(event)"/></td>
        <td><input name="expte_num" type="text" id="expte_num" size="5" onkeypress="return pulsar(event)"/></td>
        <td><input name="expte_anio" type="text" id="expte_anio" size="4" onkeypress="return pulsar(event)"/></td>
        <td><input name="expte_alcance" type="text" id="expte_alcance" onkeypress="return pulsar(event)" value="-" size="4"/></td>
        <td><input name="expte_cuerpo" type="text" id="expte_cuerpo" onkeypress="return pulsar(event)" value="-" size="4"/></td>
        <td><select name="expte_origen" id="expte_origen">
		<option value="0">Seleccione una dirección</option>
		<option value="1" selected="selected">Dirección de Reg. Urbana y Dominial</option>
		<option value="2">Dirección del Plan Familia Propietaria</option>
		<option value="7">Dirección de Gestión Escrituraria</option>
        </select></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td width="68">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	</td>
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
    <td>Observaciones</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><label>
      <textarea name="expte_obs" cols="110" rows="5" id="expte_obs"></textarea>
    </label></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="481" align="left">Bo: <?=$idBarrio; ?> - Part.: <?=$idPartido; ?>&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar"  /></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>