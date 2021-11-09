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
<title>Alta de plano</title>
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
	  <td height="30"><h2>Dar de alta nuevo plano </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php?<? echo $linkvar; ?>">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15"></td>
  </tr>
</table>
<form action="plano_alta.php" method="post" enctype="multipart/form-data" name="f" id="f">
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
        <td><input name="dirprov" type="text" id="idDirprov" size="40" value="<? echo $dirProvNombre; ?>" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_direccion" type="text" id="plano_direccion" size="45" value="<? echo $dirNombre; ?>" onkeypress="return pulsar(event)"/></td>
		<td><input name="plano_insert_fecha" type="text" id="plano_insert_fecha" value="<?=date("d/m/Y"); ?>" size="8" align="right" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="263" height="24" valign="bottom"  >C&oacute;d. de trabajo </td>
        <td width="106" valign="bottom"  >N&ordm; Expediente</td>
        <td width="97" height="16" valign="bottom"  >Parcelas </td>
        <td width="134" valign="bottom">Normativa </td>
      </tr>
      <tr>
        <td><input name="plano_codigo" type="text" id="plano_codigo" size="10" onkeypress="return pulsar(event)"/>
        (El &uacute;ltimo cargados es <?=$plano_cod; ?>) </td>
        <td><input name="plano_expte" type="text" id="plano_expte" size="10" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_cantparcelas" type="text" id="plano_cantparcelas" size="11" onkeypress="return pulsar(event)"/></td>
        <td><select name="plano_normativa" id="plano_normativa">
		<option value="0" selected="selected">Seleccione una...</option>
		<option value ="1">Ley 8912</option>
		<option value ="2">Ley 9533</option>
		<option value ="3">Ley 13342</option>
		<option value ="4">Ley 13512</option>
		<option value ="5">Ley 24320</option>
		<option value ="6">Ley 24374</option>
		<option value ="7">Ley 24374/24320</option>
		<option value ="8">Lote con serv.</option>
        </select></td>
      </tr>
    </table>
      </td>
  </tr>
  <tr>
    <td height="7"></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>IDENTIFICACION DEL INMUEBLE </strong></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="206" height="24"  >Partido</td>
        <td width="210"  >Localidad</td>
        <td width="184"  >Barrio</td>
      </tr>
      <tr>
        <td><select name="idPartido" id="idPartido">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select></td>
        <td><input name="plano_localidad" type="text" id="plano_localidad" size="30" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_barrio" type="text" id="plano_barrio" size="29" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="160" height="22" valign="bottom">&nbsp;</td>
        <td width="48" valign="bottom">Circ.</td>
        <td width="48" valign="bottom">Secc.</td>
        <td width="48" valign="bottom">Ch.</td>
        <td width="48" valign="bottom">Qta.</td>
        <td width="48" valign="bottom">Fracc.</td>
        <td width="48" valign="bottom">Mz.</td>
        <td width="48" valign="bottom">Pc.</td>
        <td width="48" valign="bottom">Subpc.</td>
        <td width="56" valign="bottom">Partida</td>
      </tr>
      <tr>
        <td height="25" valign="top"><strong>Nomenclatura catastral:</strong> </td>
        <td><input name="plano_circ" type="text" id="plano_circ" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_secc" type="text" id="plano_secc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_ch" type="text" id="plano_ch" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_qta" type="text" id="plano_qta" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_fracc" type="text" id="plano_fracc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_manzana" type="text" id="plano_manzana" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_parcela" type="text" id="plano_parcela" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_subpc" type="text" id="plano_subpc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_partida" type="text" id="plano_partida" value="-" size="6" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="198" height="16" valign="bottom"  >Inscripci&oacute;n de dominio </td>
        <td width="402" valign="bottom"  >Titular de dominio </td>
      </tr>
      <tr>
        <td><input name="dominio_inscripcion" type="text" id="dominio_inscripcion" size="30" onkeypress="return pulsar(event)"/></td>
        <td><input name="dominio_titular" type="text" id="dominio_titular" size="55" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>ESTADO DEL TRAMITE  </strong></td>
  </tr>
  <tr>
    <td height="15" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="48%" valign="top">&nbsp;</td>
        <td width="52%" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="26" colspan="3" bgcolor="#FFFA9B">
			  <table width="100%" border="0" cellpadding="8" cellspacing="0">
              <tr>
                <td>Atenci&oacute;n: Las fechas deben ser consignadas en formato <strong>dd/mm/aaaa</strong>, de lo contrario no ser&aacute;n consideradas en la base de datos del sistema. </td>
              </tr>
            </table>
			</td>
            </tr>
          <tr>
            <td width="36%" height="28" align="right">&nbsp;</td>
            <td width="35%" align="center"><strong>Fecha ingreso</strong> </td>
            <td width="29%" align="center"><strong>Fecha Salida</strong> </td>
          </tr>
		  <tr>
            <td height="28" align="right">Inf. Dominio </td>
            <td align="center"><input name="infdominio_ingreso" type="text" id="infdominio_ingreso" size="10" /></td>
            <td align="center"><input name="infdominio_salida" type="text" id="infdominio_salida" size="10" /></td>
          </tr>
          <tr>
            <td height="28" align="right">Circular 10 </td>
            <td align="center"><input name="circ10_ingreso" type="text" id="circ10_ingreso" size="10" /></td>
            <td align="center"><input name="circ10_salida" type="text" id="circ10_salida" size="10" /></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado previo</td>
            <td align="center"><input name="previo_ingreso" type="text" id="previo_ingreso" size="10" /></td>
            <td align="center"><input name="previo_salida" type="text" id="previo_salida" size="10" /></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado CPA </td>
            <td align="center"><input name="visadocpa_ingreso" type="text" id="visadocpa_ingreso" size="10" /></td>
            <td align="center"><input name="visdocpa_salida" type="text" id="visdocpa_salida" size="10" /></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado SSTYV </td>
            <td align="center"><input name="visadosst_ingreso" type="text" id="visadosst_ingreso" size="10" /></td>
            <td align="center"><input name="visadosst_salida" type="text" id="visadosst_salida" size="10" /></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado IVBA </td>
            <td align="center"><input name="visadoivba_ingreso" type="text" id="visadoivba_ingreso" size="10" /></td>
            <td align="center"><input name="visadoivba_salida" type="text" id="visadoivba_salida" size="10" /></td>
          </tr>
          <tr>
            <td height="28" align="right">Otro visado </td>
            <td align="center"><input name="visadootro_entrada" type="text" id="visadootro_entrada" size="10" /></td>
            <td align="center"><input name="visadootro_salida" type="text" id="visadootro_salida" size="10" /></td>
          </tr>
		  <tr>
            <td height="28" align="right">Visado municipal </td>
            <td align="center"><input name="visadomuni_entrada" type="text" id="visadomuni_entrada" size="10" /></td>
            <td align="center"><input name="visadomuni_salida" type="text" id="visadomuni_salida" size="10" /></td>
          </tr>
		  <tr>
            <td height="28" align="right">Aprobaci&oacute;n </td>
            <td align="center"><input name="aprobacion_entrada" type="text" id="aprobacion_entrada" size="10" /></td>
            <td align="center"><input name="aprobacion_salida" type="text" id="aprobacion_salida" size="10" /></td>
          </tr>
		  <tr>
            <td height="28" align="right">Registraci&oacute;n </td>
            <td align="center"><input name="registracion_entrada" type="text" id="registracion_entrada" size="10" /></td>
            <td align="center"><input name="registracion_salida" type="text" id="registracion_salida" size="10" /></td>
          </tr>
		  <tr>
            <td height="28" align="right">Comunicaci&oacute;n al Reg. de la prop. </td>
            <td align="center"><input name="comunic_entrada" type="text" id="comunic_entrada" size="10" /></td>
            <td align="center"><input name="comunic_salida" type="text" id="comunic_salida" size="10" /></td>
          </tr>
        </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="5%">&nbsp;</td>
            <td width="95%" height="26"><strong>Observaciones</strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><textarea name="plano_observ" cols="48" rows="23" id="plano_observ"></textarea></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
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
    <td width="481" align="right"><input name="cmdReset" type="reset" id="cmdReset" value="Borrar formulario" /></td>
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