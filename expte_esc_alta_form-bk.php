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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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

$res = mysql_query("SELECT Plano_codigo FROM dbo_plano ORDER BY Plano_codigo DESC LIMIT 0,1");
$plano = mysql_fetch_array($res);
$plano_cod = $plano["Plano_codigo"];

$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

$resol = mysql_query ("SELECT idResolucion, Resolucion_nombre FROM dbo_resolucion ORDER BY idResolucion ASC", $link);

?>

<!--Script para corroborar si el titular ya existe en la base de datos-->

<script language = "javascript">
function createRequestObject(){
       var peticion;
       var browser = navigator.appName;
             if(browser == "Microsoft Internet Explorer"){
                   peticion = new ActiveXObject("Microsoft.XMLHTTP");
             }else{
                   peticion = new XMLHttpRequest();
 }
 return peticion;
 }  
  
var http = new Array();
 function ObtDatos(url){
       var act = new Date();
       http[act] = createRequestObject();
       http[act].open('get', url);
       http[act].onreadystatechange = function() {
       if (http[act].readyState == 4) {
             if (http[act].status == 200 || http[act].status == 304) {
   var texto
 texto = http[act].responseText
                     var DivDestino = document.getElementById("DivDestino");
                     DivDestino.innerHTML = "<div id='error'>"+texto+"</div>";
                   
 }
 }
 }
 http[act].send(null);
 }
  
 function compUsuario(Tecla) {
      Tecla = (Tecla) ? Tecla: window.event;
      input = (Tecla.target) ? Tecla.target :
      Tecla.srcElement;
      if (Tecla.type == "keyup") {
           var DivDestino = document.getElementById("DivDestino");
           DivDestino.innerHTML = "<div></div>";
           if (input.value) {
                ObtDatos("logdni.php?q=" + input.value);
           }
      }
 }
 </script>
 <table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo expediente </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php?<? echo $linkvar; ?>">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15"></td>
  </tr>
</table>
<form action="expte_esc_alta.php" method="post" enctype="multipart/form-data" name="f" id="f">
<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
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
        <td width="158" height="24" valign="bottom"  >N&ordm; Expediente</td>
        <td height="16" valign="bottom"  >Alcance</td>
        <td height="16" valign="bottom"  >Cuerpo</td>
        <td width="245" valign="bottom">Direcci&oacute;n de origen</td>
      </tr>
      <tr>
        <td><input name="expte_num" type="text" id="expte_num" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="expte_alcance" type="text" id="expte_alcance" onkeypress="return pulsar(event)" value="-" size="6"/></td>
        <td><input name="expte_cuerpo" type="text" id="expte_cuerpo" onkeypress="return pulsar(event)" value="-" size="6"/></td>
        <td><select name="expte_origen" id="expte_origen">
		<option value="0">Seleccione una dirección</option>
		<option value="1">Dirección de Reg. Urbana y Dominial</option>
		<option value="2">Dirección del Plan Familia Propietaria</option>
      </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="90">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="189" height="24" valign="bottom"  >Partido</td>
        <td width="178" valign="bottom"  >Barrio</td>
        <td width="123" height="16" valign="bottom"  >Fecha Env&iacute;o a EGG </td>
        <td width="110" valign="bottom">Cant. beneficios </td>
      </tr>
      <tr>
        <td><select name="idPartido" id="idPartido">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select></td>
        <td><input name="expte_barrio" type="text" id="expte_barrio" size="26" onkeypress="return pulsar(event)" value="<?=$expte_barrio; ?>"/></td>
        <td><input name="expte_envio_egg" type="text" id="expte_envio_egg" size="16" onkeypress="return pulsar(event)"/>&nbsp;</td>
        <td><input name="expte_beneficios" type="text" id="expte_beneficios" size="12" onkeypress="return pulsar(event)"/>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table> 
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="252" height="24" valign="bottom"  >Ultimo movimiento en EGG </td>
        <td width="150" valign="bottom"  >Fecha (&uacute;ltimo mov). </td>
        <td colspan="2" rowspan="2" valign="bottom"  ><table width="100%" border="0" cellpadding="8" cellspacing="0" bgcolor="#FFFF66">
              <tr>
                <td>Atenci&oacute;n: Consignar todas las fechas en formato <strong>dd/mm/aaaa</strong></td>
              </tr>
            </table></td>
        </tr>
      <tr>
        <td><input name="expte_mov" type="text" id="expte_mov" size="40" onkeypress="return pulsar(event)"/></td>
        <td><input name="expte_fechamov" type="text" id="expte_fechamov" size="15" onkeypress="return pulsar(event)"/></td>
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