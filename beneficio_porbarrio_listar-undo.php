<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$idDireccion = $user["Direccion_nro"];
$idNivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

mysql_select_db("MyTierras",$link);

$idBarrio = $_GET["idBarrio"];

$criterio = $_GET["criterio"];

$sql3 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre, Partido_nro FROM dbo_barrio WHERE Barrio_nro = $idBarrio",$link);
$barrio = mysql_fetch_array($sql3);
$barrio_nombre = $barrio["Barrio_nombre"];
$barrio_partido = $barrio["Partido_nro"];

$sql567 = mysql_query("SELECT * FROM dbo_expte_esc ORDER BY Expte_nro DESC",$link);

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


$sql4 = mysql_query("SELECT * FROM dbo_partido WHERE Partido_nro = $barrio_partido",$link);
$partido = mysql_fetch_array($sql4);

if ($criterio == '1') {

$sql = "SELECT Familia_nro, Familia_apellido, Familia_res_adj, Familia_doc_completa, Familia_pagocancelado, Familia_cond_escrit, Familia_tramitependiente, Expte_esc_nro, Familia_matricula, Nombre FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND Familia_matricula != '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '2') {

$sql = "SELECT Familia_nro, Familia_apellido, Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion, Lote_manzana, Lote_parcela, Familia_res_adj, Familia_doc_completa, Familia_pagocancelado, Familia_cond_escrit, Familia_tramitependiente, Expte_esc_nro, Familia_matricula,  Nombre FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND Expte_esc_nro != '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


}elseif ($criterio == '3'){

$sql = "SELECT Familia_nro, Familia_apellido, Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion, Lote_manzana, Lote_parcela,  Familia_res_adj, Familia_doc_completa, Familia_pagocancelado, Familia_cond_escrit, Familia_tramitependiente, Expte_esc_nro, Familia_matricula, Nombre FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND Familia_cond_escrit = '1' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}else{

$sql = "SELECT Familia_nro, Familia_apellido, Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion, Lote_manzana, Lote_parcela,  Familia_res_adj, Familia_doc_completa, Familia_pagocancelado, Familia_cond_escrit, Familia_tramitependiente, Expte_esc_nro, Familia_matricula, Nombre FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";
}

$res = mysql_query($sql);

$cant = mysql_num_rows($res);

$nombre_archivo = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
//verificamos si en la ruta nos han indicado el directorio en el que se encuentra
if ( strpos($nombre_archivo, '/') !== FALSE )
    //de ser asi, lo eliminamos, y solamente nos quedamos con el nombre y su extension
    $nombre_archivo = array_pop(explode('/', $nombre_archivo));


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
    <td height="30" colspan="3" style="font-size:18px; font-weight:bold;">Partido: <?=$partido["Partido_nombre"]; ?> - Barrio: <? echo $barrio_nombre ?></td>
  </tr>
  <tr>
    <td colspan="3">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" colspan="3" valign="bottom"><a href="barrios_listar_benef.php">Volver al listado de barrios</a> | <a href="informe_porbarrio_01.php?idBarrio=<?=$idBarrio;?>&criterio=<?=$criterio; ?>">Ver informe con observaciones</a></td>
  </tr>
  <tr>
    <td height="8" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="70" height="8">Mostrando:</td>
    <td width="201"><form><select name="ListeUrl" onChange="ChangeUrl(this.form)">
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=0" <? if ($criterio == '0') { ?> selected="selected" <? } ?>>Todos</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=1" <? if ($criterio == '1') { ?> selected="selected" <? } ?>>Escriturados</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=2" <? if ($criterio == '2') { ?> selected="selected" <? } ?>>En tr&aacute;mite de escrituraci&oacute;n</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=3" <? if ($criterio == '3') { ?> selected="selected" <? } ?>>En condiciones de escriturar</option>
    </select>
    </form>    </td>
    <td width="630"><strong>(
      <?=$cant; ?> 
    resultados) </strong></td>
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
	<table width="740" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="3%"><img src="imagen/escrit-ico.jpg" width="16" height="16" /></td>
          <td width="11%">Escriturado</td>
		  <td width="3%"><img src="imagen/tramitesc-ico.jpg" width="16" height="16" /></td>
          <td width="24%">En tr&aacute;mite de escrituraci&oacute;n </td>
          <td width="4%"><img src="imagen/cond-esc-ico.jpg" /></td>
          <td width="19%"> En cond. de escriturar </td>
          <td width="3%"><img src="imagen/faltapago-ico.jpg" /></td>
          <td width="13%">Faltan pagos </td>
          <td width="3%"><img src="imagen/faltadoc-ico.jpg" /></td>
          <td width="17%">Falta documentaci&oacute;n</td>
	    </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
	 <form method="post" action="accion-multiple.php">	  
	<table width="740" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="26" height="30" align="center" class="titulo_dato">Mz.</td>
      <td width="27" align="center" class="titulo_dato">Pc.</td>
      <td width="285" class="titulo_dato">Apellido, nombre y documento </td>
      <td width="106" align="center" class="titulo_dato">Estado</td>
      <td width="131" align="center" class="titulo_dato">Alta por </td>
      <td width="75" align="center" class="titulo_dato">Acciones</td>
      <td width="32" align="center" class="titulo_dato"><input type="checkbox" onclick="marcar(this);" /></td>
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
) WHERE Familia_nro = {$familia["Familia_nro"]}",$link);
?>
      <tr>
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
        <? if ($familia["Familia_matricula"] != '0') {?><img src="imagen/escrit-ico.jpg" /><? }else{ ?>
	<? if ($familia["Expte_esc_nro"] != '0') {?>&nbsp;<img src="imagen/tramitesc-ico.jpg" /><? }else{ ?>
		<? if ($familia["Familia_cond_escrit"] == '1') {?>&nbsp;<img src="imagen/cond-esc-ico.jpg" /><? }else{
		if ($familia["Familia_pagocancelado"] != '1') {?>&nbsp;<img src="imagen/faltapago-ico.jpg" /><? }
		if ($familia["Familia_doc_completa"] != '1') {?>&nbsp;<img src="imagen/faltadoc-ico.jpg" /><? }
 } ?>
<? } } ?></td>
      <td align="center"><?=$familia["Nombre"] ?></td>
      <td align="center"><a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$familia["Familia_nro"]; ?>')>Ver informe</a></td>
      <td align="center"><input type="checkbox" name="seleccion[]" value="<?=$familia["Familia_nro"]; ?>" /></td>
      </tr>
  <?
}
?><tr>
    <td colspan="6" align="right">Marcar/desmarcar todos </td><td align="center"><input type="checkbox" onclick="marcar(this);" /></td></tr>
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
        <td height="34" colspan="5" valign="middle" style="font-size:14px; font-weight:bold">Aplicar la siguiente acci&oacute;n a todos los beneficios seleccionados </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="4">ATENCI&Oacute;N: Tenga presente que la acci&oacute;n afectar&aacute; a todos los beneficios seleccionados, y que la misma no puede ser revertida autom&aacute;ticamente. <strong>Sea prudente en el uso de esta herramienta. </strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="1">&nbsp;</td>
        <td width="23"><input name="accion" type="radio" value="1" /></td>
        <td width="116">Asignar expediente: </td>
        <td width="209"><select name="expte_esc_nro" id="expte_esc_nro">
<option value="0">Quitar el expediente asignado</option>
<?	  while ($expte = mysql_fetch_array($sql567)) {	

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_barrio = $expte["Barrio_nombre"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];

?>
<option value="<? echo $expte_nro; ?>" <? if ($expte_nro == $familia["Expte_esc_nro"]) {echo "selected=\"selected\"";} ?>><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> <? if ($expte_cuerpo != '0') {echo "Cpo ".$expte_cuerpo; }else{ echo " "; } ?></option>
<? } ?>
</select> </td>
        <td colspan="2"><a href="#">[Dar de alta nuevo expediente] </a></td>
      </tr>
	  <tr>
	    <td width="1">&nbsp;</td>
        <td width="23"><input name="accion" type="radio" value="2" /></td>
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
        <td><input name="accion" type="radio" value="7" /></td>
        <td colspan="4">Marcar <u><strong>en condiciones de escriturar</strong></u> </td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="8" /></td>
        <td colspan="4">Quitar marca en condiciones de escriturar</td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="3" /></td>
        <td colspan="4">Marcar documentaci&oacute;n <strong>completa</strong> </td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="4" /></td>
        <td colspan="4">Marcar documentaci&oacute;n incompleta </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="5" /></td>
        <td colspan="4">Marcar <strong>pagos cancelado</strong> </td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="6" /></td>
        <td colspan="4">Marcar pagos incompletos </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="barrio_origen" value="<?=$idBarrio; ?>" />
		<input type="hidden" name="pag_origen" value="<? echo $nombre_archivo; ?>" />		
		&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td width="181" align="right"><input name="enviar" type="submit" id="enviar" value="Actualizar" /></td>
        <td width="7" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
    </table><? } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
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
