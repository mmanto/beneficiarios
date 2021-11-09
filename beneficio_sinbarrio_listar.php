<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido3 = mysql_query ($strSQL);


$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$idDireccion = $user["Direccion_nro"];
$idNivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

mysql_select_db("MyTierras",$link);

$idPartido = $_GET["idPartido"];

$sql367 = "SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido";
$res367 = mysql_query($sql367);
$partido = mysql_fetch_array($res367);

$idBarrio = '0';


$sql = "SELECT Familia_nro, Familia_apellido, Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion, Lote_manzana, Lote_parcela,  Familia_res_adj, Familia_doc_completa, Familia_pagocancelado, Familia_cond_escrit, Familia_tramitependiente, Expte_esc_nro, Familia_matricula, Familia_idmigra, insert_fecha, Nombre FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND Partido_nro = '$idPartido' AND blnActivo = '1' ORDER BY Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_manzana, Lote_parcela ASC";


$res = mysql_query($sql);

$cant = mysql_num_rows($res);

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

?>
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h1>Informe de beneficiarios de tierras </h1></td>
  </tr>
  <tr>
    <td height="30" colspan="3" style="font-size:18px; font-weight:bold;">Partido: <?=$partido["Partido_nombre"]; ?> - Barrio sin identificar </td>
  </tr>
  <tr>
    <td colspan="3">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" colspan="3" valign="bottom"><a href="menu.php">Volver al men&uacute;</a></td>
  </tr>
  <tr>
    <td height="8" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="83" height="8"><strong>Mostrando:</strong></td>
    <td width="278"><strong>Todos (<?=$cant; ?> resultados) </strong></td>
    <td width="725">&nbsp;</td>
  </tr>
  <tr>
    <td height="28" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td height="25" colspan="3">
	<? if ($cant > 0) { ?>
	<form method="post" action="asigna-barrio-multiple.php">	  
	<table width="1000" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="29" align="center" class="titulo_dato">C.</td>
        <td width="29" align="center" class="titulo_dato">S.</td>
        <td width="26" align="center" class="titulo_dato">Ch.</td>
        <td width="31" align="center" class="titulo_dato">Q.</td>
        <td width="31" align="center" class="titulo_dato">Fr.</td>
        <td width="39" height="30" align="center" class="titulo_dato">Mz.</td>
      <td width="41" align="center" class="titulo_dato">Pc.</td>
      <td width="266" class="titulo_dato">Apellido, nombre y documento </td>
      <td width="95" align="center" class="titulo_dato">Tipo de alta </td>
      <td width="76" align="center" class="titulo_dato">Fecha alta </td>
      <td width="118" align="center" class="titulo_dato">Alta por </td>
      <td width="70" align="center" class="titulo_dato">Acciones</td>
      <td width="43" align="center" class="titulo_dato"><input type="checkbox" onclick="marcar(this);" /></td>
      </tr>
      
      
      
  <?


while ($familia = mysql_fetch_array($res)) {

$lote_circ = $familia["Lote_circunscripcion"];
if($familia["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $familia["Lote_seccion"];}
if($familia["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $familia["Lote_chacra"];}
if($familia["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $familia["Lote_quinta"];}
if($familia["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $familia["Lote_fraccion"];}
$manzana = $familia["Lote_manzana"];
$parcela = $familia["Lote_parcela"];


$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND blnActivo = '1'",$link);
?>
      <tr>
        <td align="center"><? echo $lote_circ; ?></td>
        <td align="center"><? echo $lote_secc; ?></td>
        <td align="center"><? echo $lote_ch; ?></td>
        <td align="center"><? echo $lote_qta; ?></td>
        <td align="center"><? echo $lote_fr; ?></td>
        <td align="center"><? echo $manzana; ?></td>
      <td align="center"><? echo $parcela; ?></td>
      <td align="center"><table width="98%" border="0" cellspacing="0" cellpadding="1">
        <? while ($persona = mysql_fetch_array($sql2)){ ?>
        <tr>
          <td width="82%"><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
          <td width="18%"><? echo $persona["Persona_dni_nro"]; ?></td>
        </tr>
        <? } ?>
        </table>	</td>
      <td align="center" valign="middle">
	  <? if ($familia["Familia_idmigra"] != '0') { ?>
	  <img src="imagen/migra-ico.jpg" />
	  <? }else{ ?>
	  <img src="imagen/manual-ico.jpg" />
	  <? } ?>	  </td>
      <td align="center"><?=cambiaf_a_normal($familia["insert_fecha"]); ?></td>
      <td align="center"><?=$familia["Nombre"] ?></td>
      <td align="center"><a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$familia["Familia_nro"]; ?>')>Ver informe</a></td>
      <td align="center"><input type="checkbox" name="seleccion[]" value="<?=$familia["Familia_nro"]; ?>" /></td>
      </tr>
  <?
}
?><tr>
    <td colspan="12" align="right">Marcar/desmarcar todos </td><td align="center"><input type="checkbox" onclick="marcar(this);" /></td></tr>
    </table>
	<table width="740" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="21">&nbsp;</td>
    <td width="691" align="left">
	<? if ($idNivel < '5') { ?>
	<table width="585" border="0" cellpadding="4" cellspacing="0" bgcolor="#dedede">
      <tr>
        <td height="28" valign="top" style="font-size:14px; font-weight:bold">&nbsp;</td>
        <td height="34" colspan="5" valign="middle" style="font-size:14px; font-weight:bold">Asignar barrio a los beneficios seleccionados </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="4">ATENCI&Oacute;N: Tenga presente que la acci&oacute;n afectar&aacute; a todos los beneficios seleccionados, y que la misma no puede ser revertida autom&aacute;ticamente. <strong>Sea prudente en el uso de esta herramienta. </strong></td>
        <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td width="1">&nbsp;</td>
        <td width="23"><input name="accion" type="radio" value="1" checked="checked" /></td>
        <td width="116">Asignar al barrio: </td>
        <td colspan="3"><select name="barrio_nro" id="barrio_nro">
<option value="0">Seleccione un barrio</option>
<?	  while ($barrio = mysql_fetch_array($sql789)) {	

$barrio_nro = $barrio["Barrio_nro"];
$barrio_partido = $barrio["Partido_nombre"];
$barrio_nombre = $barrio["Barrio_nombre"];
?>
<option value="<? echo $barrio_nro; ?>"><?=$barrio_partido; ?> - <?=$barrio_nombre; ?></option>
<? } ?>
</select></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="idPartido" value="<?=$idPartido; ?>" />&nbsp;		</td>
        <td colspan="2" align="left">&nbsp;</td>
        <td width="206" align="left"><input name="enviar" type="submit" id="enviar" value="Actualizar" /></td>
        <td width="7" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td width="184" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
    </table>
	<? } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	</td>
  </tr>
</table>
	 </form>
	<? } ?></td>
  </tr>
  <tr>
    <td height="25" colspan="3">&nbsp;</td>
  </tr>
</table>
<? } ?>
<? include "pie.php"; ?>
