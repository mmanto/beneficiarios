<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Modificar datos de plano</title>
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
	
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
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

$log_direccion = $_GET["nbsp567"];
$log_usuario = $_GET["qprst645"];
$log_nivel = $_GET["ghlst251"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";


/////////
$idPlano = $_GET["idPlano"];
$res = mysql_query("SELECT * FROM dbo_plano WHERE Plano_nro = $idPlano");
$plano = mysql_fetch_array($res);

$plano_normativa = $plano["Plano_normativa"];

////////




$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

$strSQL2 = "SELECT * FROM dbo_direccion ORDER BY Direccion_nro ASC";
$direc = mysql_query ($strSQL2);

$strSQL3 = mysql_query ("SELECT * FROM dbo_direccion where Direccion_nro=".$log_direccion."", $link);
$res_dirprov = mysql_fetch_array($strSQL3);

$resol = mysql_query ("SELECT idResolucion, Resolucion_nombre FROM dbo_resolucion ORDER BY idResolucion ASC", $link);



?>

<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Actualizar datos del plano </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="javascript:history.back(1)">Volver al listado</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>
<form action="plano_modif.php" method="post" enctype="multipart/form-data" name="f" id="f">
<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" />
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" />
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" />
<input type="hidden" name="idPlano" value="<? echo $idPlano; ?>" />
<input type="hidden" name="linkvar" value="<? echo $linkvar; ?>" />
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="245"  ><strong>DIRECCION PROVINCIAL </strong></td>
        <td width="274"  ><strong>DIRECCION</strong></td>
        <td width="81"  ><strong>FECHA ALTA </strong></td>
      </tr>
      <tr>
        <td><input name="dirprov" type="text" id="idDirprov" size="40" value="<? echo $res_dirprov["Direccion_dirprov"]; ?>" onkeypress="return pulsar(event)"/></td>
        <td><input name="direccion" type="text" id="idDirprov" size="45" value="<? echo $res_dirprov["Direccion_nombre_res"]; ?>" onkeypress="return pulsar(event)"/></td>
		<td><input name="plano_insert_fecha" type="text" id="plano_insert_fecha" value="<? echo cambiaf_a_normal($plano["Plano_insert_fecha"]); ?>" size="8" align="right" onkeypress="return pulsar(event)"/></td>
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
        <td><input name="plano_codigo" type="text" id="plano_codigo" size="10" onkeypress="return pulsar(event)" value="<?=$plano["Plano_codigo"]; ?>"/></td>
        <td><input name="plano_expte" type="text" id="plano_expte" size="10" onkeypress="return pulsar(event)" value="<?=$plano["Plano_expte"]; ?>"/></td>
        <td><input name="plano_cantparcelas" type="text" id="plano_cantparcelas" size="11" onkeypress="return pulsar(event)" value="<?=$plano["Plano_cantparcelas"]; ?>"/></td>
        <td><select name="plano_normativa" id="plano_normativa">
		<option value="0" >Seleccione una...</option>
		<option value ="1" <? if($plano_normativa == '1') { echo "selected=\"selected\""; } ?>>Ley 8912</option>
		<option value ="2" <? if($plano_normativa == '2') { echo "selected=\"selected\""; } ?>>Ley 9533</option>
		<option value ="3" <? if($plano_normativa == '3') { echo "selected=\"selected\""; } ?>>Ley 13342</option>
		<option value ="4" <? if($plano_normativa == '4') { echo "selected=\"selected\""; } ?>>Ley 13512</option>
		<option value ="5" <? if($plano_normativa == '5') { echo "selected=\"selected\""; } ?>>Ley 24320</option>
		<option value ="6" <? if($plano_normativa == '6') { echo "selected=\"selected\""; } ?>>Ley 24374</option>
		<option value ="7" <? if($plano_normativa == '7') { echo "selected=\"selected\""; } ?>>Ley 24374/24320</option>
		<option value ="8" <? if($plano_normativa == '8') { echo "selected=\"selected\""; } ?>>Lote con serv.</option>
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
        <td><?=$plano["idPartido"]; ?></td>
        <td><input name="plano_localidad" type="text" id="plano_localidad" size="30" onkeypress="return pulsar(event)" value="<?=$plano["Plano_localidad"]; ?>"/></td>
        <td><input name="plano_barrio" type="text" id="plano_barrio" size="29" onkeypress="return pulsar(event)" value="<?=$plano["Plano_barrio"]; ?>"/></td>
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
        <td><input name="plano_circ" type="text" id="plano_circ" size="1" onkeypress="return pulsar(event)" value="<?=$plano["Plano_circ"]; ?>"/></td>
        <td><input name="plano_secc" type="text" id="plano_secc" value="<?=$plano["Plano_secc"]; ?>" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_ch" type="text" id="plano_ch" value="<?=$plano["Plano_ch"]; ?>" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_qta" type="text" id="plano_qta" value="<?=$plano["Plano_qta"]; ?>" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_fracc" type="text" id="plano_fracc" value="<?=$plano["Plano_fracc"]; ?>" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_manzana" type="text" id="plano_manzana" value="<?=$plano["Plano_manzana"]; ?>" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_parcela" type="text" id="plano_parcela" value="<?=$plano["Plano_parcela"]; ?>" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_subpc" type="text" id="plano_subpc" value="<?=$plano["Plano_subpc"]; ?>" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="plano_partida" type="text" id="plano_partida" size="6" onkeypress="return pulsar(event)" value="<?=$plano["Plano_partida"]; ?>"/></td>
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
        <td><input name="dominio_inscripcion" type="text" id="dominio_inscripcion" size="30" onkeypress="return pulsar(event)" value="<?=$plano["Dominio_inscripcion"]; ?>"/></td>
        <td><input name="dominio_titular" type="text" id="dominio_titular" size="72" onkeypress="return pulsar(event)" value="<?=$plano["Dominio_titular"]; ?>"/></td>
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
                <td>Atenci&oacute;n: Las fechas deben ser consignadas en formato <strong>dd/mm/aaaa</strong>, de lo contrario no ser&aacute;n correctamente asentadas en la base de datos. </td>
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
            <td align="center"><input name="infdominio_ingreso" type="text" id="infdominio_ingreso" size="10" value="<?
			if($plano["infdominio_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["infdominio_ingreso"]); } ?>"/></td>
            <td align="center"><input name="infdominio_salida" type="text" id="infdominio_salida" size="10" value="<?
			if($plano["infdominio_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["infdominio_salida"]); } ?>"/></td>
          </tr>
          <tr>
            <td height="28" align="right">Circular 10 </td>
            <td align="center"><input name="circ10_ingreso" type="text" id="circ10_ingreso" size="10" value="<?
			if($plano["circ10_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["circ10_ingreso"]); } ?>"/></td>
            <td align="center"><input name="circ10_salida" type="text" id="circ10_salida" size="10" value="<? if($plano["circ10_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["circ10_salida"]); } ?>"/></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado previo</td>
            <td align="center"><input name="previo_ingreso" type="text" id="previo_ingreso" size="10" value="<? if($plano["previo_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["previo_ingreso"]); } ?>"/></td>
            <td align="center"><input name="previo_salida" type="text" id="previo_salida" size="10"  value="<?	if($plano["previo_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["previo_salida"]); } ?>"/></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado CPA </td>
            <td align="center"><input name="visadocpa_ingreso" type="text" id="visadocpa_ingreso" size="10" value="<?	if($plano["visadocpa_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadocpa_ingreso"]); } ?>"/></td>
            <td align="center"><input name="visdocpa_salida" type="text" id="visdocpa_salida" size="10" value="<?
			if($plano["visadocpa_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadocpa_salida"]); } ?>" /></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado SSTYV </td>
            <td align="center"><input name="visadosst_ingreso" type="text" id="visadosst_ingreso" size="10" value="<?
			if($plano["visadosst_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadosst_ingreso"]); } ?>"/></td>
            <td align="center"><input name="visadosst_salida" type="text" id="visadosst_salida" size="10" value="<?
			if($plano["visadosst_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadosst_salida"]); } ?>"/></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado IVBA </td>
            <td align="center"><input name="visadoivba_ingreso" type="text" id="visadoivba_ingreso" size="10" value="<?
			if($plano["visadoivba_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadoivba_ingreso"]); } ?>"/></td>
            <td align="center"><input name="visadoivba_salida" type="text" id="visadoivba_salida" size="10" value="<?
			if($plano["visadoivba_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadoivba_salida"]); } ?>" /></td>
          </tr>
          <tr>
            <td height="28" align="right">Otro visado </td>
            <td align="center"><input name="visadootro_entrada" type="text" id="visadootro_entrada" size="10" value="<?
			if($plano["visadootro_entrada"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadootro_entrada"]); } ?>"/></td>
            <td align="center"><input name="visadootro_salida" type="text" id="visadootro_salida" size="10" value="<?
			if($plano["visadootro_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadootro_salida"]); } ?>"/></td>
          </tr>
		  <tr>
            <td height="28" align="right">Visado municipal </td>
            <td align="center"><input name="visadomuni_entrada" type="text" id="visadomuni_entrada" size="10" value="<?
			if($plano["visadomuni_entrada"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadomuni_entrada"]); } ?>"/></td>
            <td align="center"><input name="visadomuni_salida" type="text" id="visadomuni_salida" size="10" value="<?
			if($plano["visadomuni_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadomuni_salida"]); } ?>"/></td>
          </tr>
		  <tr>
            <td height="28" align="right">Aprobaci&oacute;n </td>
            <td align="center"><input name="aprobacion_entrada" type="text" id="aprobacion_entrada" size="10" value="<?
			if($plano["aprobacion_entrada"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["aprobacion_entrada"]); } ?>"/></td>
            <td align="center"><input name="aprobacion_salida" type="text" id="aprobacion_salida" size="10" value="<?
			if($plano["aprobacion_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["aprobacion_salida"]); } ?>"/></td>
          </tr>
		  <tr>
            <td height="28" align="right">Registraci&oacute;n </td>
            <td align="center"><input name="registracion_entrada" type="text" id="registracion_entrada" size="10" value="<?
			if($plano["registracion_entrada"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["registracion_entrada"]); } ?>"/></td>
            <td align="center"><input name="registracion_salida" type="text" id="registracion_salida" size="10" value="<?
			if($plano["registracion_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["registracion_salida"]); } ?>"/></td>
          </tr>
		  <tr>
            <td height="28" align="right">Comunicaci&oacute;n al Reg. de la prop. </td>
            <td align="center"><input name="comunic_entrada" type="text" id="comunic_entrada" size="10" value="<?
			if($plano["comunic_entrada"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["comunic_entrada"]); } ?>"/></td>
            <td align="center"><input name="comunic_salida" type="text" id="comunic_salida" size="10" value="<?
			if($plano["comunic_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["comunic_salida"]); } ?>"/></td>
          </tr>
        </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="5%">&nbsp;</td>
            <td width="95%" height="26"><strong>Observaciones</strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><textarea name="plano_observ" cols="48" rows="23" id="plano_observ"><?=$plano["plano_observ"]; ?></textarea></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
  <table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="167"></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="399" align="right"></td>
    <td width="34">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Actualizar informaci&oacute;n"  /></td>
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
