<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Informe de plano</title>
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



$log_direccion = $_GET["nbsp567"];
$log_usuario = $_GET["qprst645"];
$log_nivel = $_GET["ghlst251"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";

/*
$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

$strSQL2 = "SELECT * FROM dbo_direccion ORDER BY Direccion_nro ASC";
$direc = mysql_query ($strSQL2);

$strSQL3 = mysql_query ("SELECT * FROM dbo_direccion where Direccion_nro=".$log_direccion."", $link);
$res_dirprov = mysql_fetch_array($strSQL3);

$resol = mysql_query ("SELECT idResolucion, Resolucion_nombre FROM dbo_resolucion ORDER BY idResolucion ASC", $link);
*/

$idPlano = $_GET["idPlano"];
$res = mysql_query("SELECT * FROM dbo_plano WHERE Plano_nro = $idPlano");
$plano = mysql_fetch_array($res);
/*
if($plano["Plano_normativa"] == '1') {$plano_normativa = 'Ley 8912';}
elseif ($plano["Plano_normativa"] == '2') {$plano_normativa = 'Ley 9533';}
elseif ($plano["Plano_normativa"] == '3') {$plano_normativa = 'Ley 13342';}
elseif ($plano["Plano_normativa"] == '4') {$plano_normativa = 'Ley 13512';}
elseif ($plano["Plano_normativa"] == '5') {$plano_normativa = 'Ley 24320';}
elseif ($plano["Plano_normativa"] == '6') {$plano_normativa = 'Ley 24374';}
elseif ($plano["Plano_normativa"] == '7') {$plano_normativa = 'Ley 24374/24320';}
elseif ($plano["Plano_normativa"] == '8') {$plano_normativa = 'Lote con serv.';}
else { $plano_normativa = 'Sin indicar'; }
*/
?>
 <table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Informe de plano </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="javascript:history.back(1)">Volver al listado</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
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
        <td width="230"  ><strong>DIRECCION</strong></td>
        <td width="125"  ><strong>FECHA ALTA </strong></td>
      </tr>
      <tr>
        <td>Dir. Prov. de Escrituraci&oacute;n Social </td>
        <td>Direcci&oacute;n de Gesti&oacute;n Escrituraria </td>
		<td><? echo cambiaf_a_normal($plano["Plano_insert_fecha"]); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="143" height="24" valign="bottom"  ><strong>C&oacute;d. de trabajo </strong></td>
        <td width="134" valign="bottom"  ><strong>N&ordm; Expediente</strong></td>
        <td width="148" height="16" valign="bottom"  ><strong>Parcelas</strong> </td>
        <td width="175" valign="bottom"><strong>Normativa</strong> </td>
      </tr>
      <tr>
        <td><?=$plano["Plano_codigo"]; ?></td>
        <td><?=$plano["Plano_expte"]; ?></td>
        <td><?=$plano["Plano_cantparcelas"]; ?></td>
        <td><?=$plano_normativa; ?></td>
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
        <td width="206" height="24"  ><strong>Partido:</strong> <?=$plano["idPartido"]; ?></td>
        <td width="198"  ><strong>Localidad:</strong> <?=$plano["Plano_localidad"]; ?></td>
        <td width="196"  ><strong>Barrio:</strong> <?=$plano["Plano_barrio"]; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="54" height="26" valign="bottom">Circ. <?=$plano["Plano_circ"]; ?></td>
        <td width="64" valign="bottom">Secc. <?=$plano["Plano_secc"]; ?></td>
        <td width="54" valign="bottom">Ch. <?=$plano["Plano_ch"]; ?></td>
        <td width="62" valign="bottom">Qta. <?=$plano["Plano_qta"]; ?></td>
        <td width="64" valign="bottom">Fr. <?=$plano["Plano_fracc"]; ?></td>
        <td width="66" valign="bottom">Mz. <?=$plano["Plano_manzana"]; ?></td>
        <td width="50" valign="bottom">Pc. <?=$plano["Plano_parcela"]; ?></td>
        <td width="68" valign="bottom">Subpc. <?=$plano["Plano_subpc"]; ?></td>
        <td width="118" valign="bottom">Partida <?=$plano["Plano_partida"]; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="211" height="12" valign="top"  >&nbsp;</td>
        <td width="389" valign="top"  >&nbsp;</td>
      </tr>
	  <tr>
        <td width="211" height="36" valign="top"  ><strong>Insc. dominio:</strong>  <?=$plano["Dominio_inscripcion"]; ?></td>
        <td width="389" valign="top"  ><strong>Titular de dominio:</strong> <?=$plano["Dominio_titular"]; ?></td>
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
            <td width="33%" height="28" align="right">&nbsp;</td>
            <td width="31%" align="center"><strong>Ingreso</strong> </td>
            <td width="36%" align="center"><strong>Salida</strong> </td>
          </tr>
		  <tr>
            <td height="28" align="right">Inf. Dominio </td>
            <td align="center"><?
			if($plano["infdominio_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["infdominio_ingreso"]); } ?> </td>
            <td align="center"><?
			if($plano["infdominio_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["infdominio_salida"]); } ?></td>
          </tr>
          <tr>
            <td height="28" align="right">Circular 10 </td>
            <td align="center"><?
			if($plano["circ10_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["circ10_ingreso"]); } ?> </td>
            <td align="center"><?
			if($plano["circ10_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["circ10_salida"]); } ?></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado previo</td>
            <td align="center"><?
			if($plano["previo_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["previo_ingreso"]); } ?></td>
            <td align="center"><?
			if($plano["previo_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["previo_salida"]); } ?></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado CPA </td>
            <td align="center"><?
			if($plano["visadocpa_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadocpa_ingreso"]); } ?></td>
            <td align="center"><?
			if($plano["visadocpa_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadocpa_salida"]); } ?></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado SSTYV </td>
            <td align="center"><?
			if($plano["visadosst_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadosst_ingreso"]); } ?></td>
            <td align="center"><?
			if($plano["visadosst_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadosst_salida"]); } ?></td>
          </tr>
          <tr>
            <td height="28" align="right">Visado IVBA </td>
            <td align="center"><?
			if($plano["visadoivba_ingreso"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadoivba_ingreso"]); } ?></td>
            <td align="center"><?
			if($plano["visadoivba_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadoivba_salida"]); } ?></td>
          </tr>
          <tr>
            <td height="28" align="right">Otro visado </td>
            <td align="center"><?
			if($plano["visadootro_entrada"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadootro_entrada"]); } ?></td>
            <td align="center"><?
			if($plano["visadootro_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadootro_salida"]); } ?></td>
          </tr>
		  <tr>
            <td height="28" align="right">Visado municipal </td>
            <td align="center"><?
			if($plano["visadomuni_entrada"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadomuni_entrada"]); } ?></td>
            <td align="center"><?
			if($plano["visadomuni_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["visadomuni_salida"]); } ?></td>
          </tr>
		  <tr>
            <td height="28" align="right">Aprobaci&oacute;n </td>
            <td align="center"><?
			if($plano["aprobacion_entrada"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["aprobacion_entrada"]); } ?></td>
            <td align="center"><?
			if($plano["aprobacion_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["aprobacion_salida"]); } ?></td>
          </tr>
		  <tr>
            <td height="28" align="right">Registraci&oacute;n </td>
            <td align="center"><?
			if($plano["registracion_entrada"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["registracion_entrada"]); } ?></td>
            <td align="center"><?
			if($plano["registracion_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["registracion_salida"]); } ?></td>
          </tr>
		  <tr>
            <td height="28" align="right">Comunicaci&oacute;n al Reg. de la prop. </td>
            <td align="center"><?
			if($plano["comunic_entrada"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["comunic_entrada"]); } ?></td>
            <td align="center"><?
			if($plano["comunic_salida"] == '0000-00-00') { echo "--"; }else{
			echo cambiaf_a_normal($plano["comunic_salida"]); } ?></td>
          </tr>
        </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8%">&nbsp;</td>
            <td width="92%" height="26"><strong>Observaciones</strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><?=$plano["Observaciones"]; ?></td>
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
    <td width="481" align="right">&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td>&nbsp;</td>
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
