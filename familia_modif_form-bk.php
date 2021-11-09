<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$idDireccion = $user["Direccion_nro"];
$idNivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

/*
$sqlDir = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dir = mysql_fetch_array($sqlDir);
$dirNombre = $dir["Direccion_nombre"];

$sqlDirProv = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dirprov = mysql_fetch_array($sqlDirProv);
$dirProvNombre = $dir["Direccion_dirprov"];
*/
//////////////////////////////////////////////////////////////////

$familia_nro = $_GET["idFamilia"];

$sql = "SELECT * FROM dbo_familia WHERE Familia_nro = $familia_nro";
$resFlia = mysql_query($sql);
$familia = mysql_fetch_array($resFlia);

$idFamilia = $familia["Familia_nro"];

$lote_partido = $familia["Partido_nro"];
$lote_circ = $familia["Lote_circunscripcion"];
$lote_secc = $familia["Lote_seccion"];
$lote_ch = $familia["Lote_chacra"];
$lote_qta = $familia["Lote_quinta"];
$lote_fr = $familia["Lote_fraccion"];
$lote_mz = $familia["Lote_manzana"];
$lote_pc = $familia["Lote_parcela"];
$lote_subpc = $familia["Lote_subparcela"];
$lote_matricula = $familia["Lote_matricula"];

$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

$sql567 = mysql_query("SELECT * FROM dbo_expte_esc ORDER BY Expte_caract ASC, Expte_num ASC, Expte_anio ASC, Expte_alcance ASC, Expte_cuerpo ASC",$link);

?>

<style type="text/css">
<!--
.Estilo2 {font-size: 18px}
-->
</style>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Modificar informaci&oacute;n del  beneficio</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="javascript:history.back()">Volver</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="familia_modif.php" method="post">
<input type="hidden" name="idFamilia" value="<? echo $idFamilia; ?>"/>
<input type="hidden" name="origen" value="<?=basename($_SERVER['PHP_SELF']); ?>"/>



<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="11%"><strong>Partido:</strong></td>
        <td width="37%"><select name="idPartido" id="idPartido">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) { ?><option value ="<?=$rsPart["Partido_nro"]; ?>"
	<? if($rsPart["Partido_nro"] == $lote_partido) { ?>selected="selected"<? } ?>><?=$rsPart["Partido_nombre"]; ?></option><? } ?>
      </select></td>
        <td width="52%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="107" height="22" valign="bottom">&nbsp;</td>
        <td width="64" valign="bottom">Circ.</td>
        <td width="63" valign="bottom">Secc.</td>
        <td width="65" valign="bottom">Ch.</td>
        <td width="61" valign="bottom">Qta.</td>
        <td width="62" valign="bottom">Fracc.</td>
        <td width="53" valign="bottom">Mz.</td>
        <td width="52" valign="bottom">Pc.</td>
        <td width="73" valign="bottom">Subpc.</td>
        </tr>
      <tr>
        <td height="25" valign="top">Nomenclatura:</td>
        <td><input name="lote_circ" type="text" id="lote_circ" size="1" onkeypress="return pulsar(event)" value="<?=$lote_circ; ?>"/></td>
        <td><input name="lote_secc" type="text" id="lote_secc" size="1" onkeypress="return pulsar(event)" value="<?=$lote_secc; ?>"/></td>
        <td><input name="lote_ch" type="text" id="lote_ch" size="1" onkeypress="return pulsar(event)" value="<?=$lote_ch; ?>"/></td>
        <td><input name="lote_qta" type="text" id="lote_qta" size="1" onkeypress="return pulsar(event)" value="<?=$lote_qta; ?>"/></td>
        <td><input name="lote_fracc" type="text" id="lote_fracc" size="1" onkeypress="return pulsar(event)" value="<?=$lote_fr; ?>"/></td>
        <td><input name="lote_manzana" type="text" id="lote_manzana" size="1" onkeypress="return pulsar(event)" value="<?=$lote_mz; ?>"/></td>
        <td><input name="lote_parcela" type="text" id="lote_parcela" size="1" onkeypress="return pulsar(event)" value="<?=$lote_pc; ?>"/></td>
        <td><input name="lote_subpc" type="text" id="lote_subpc" size="1" onkeypress="return pulsar(event)" value="<?=$lote_subpc; ?>"/></td>
        </tr>
      <tr>
        <td height="14" colspan="9" valign="top"></td>
        </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="34%" class="nombrecampo">Tel&eacute;fono</td>
            <td width="33%" class="nombrecampo">Resoluci&oacute;n   N&ordm; </td>
            <td width="33%" class="nombrecampo">Matr&iacute;cula</td>
          </tr>
          <tr>
            <td><input name="familia_telefono" type="text" id="familia_telefono" onkeypress="return pulsar(event)" size="18" value="<?=$familia["Familia_telefono"]; ?>"/></td>
            <td><input name="resolucion" type="text" id="resolucion" onkeypress="return pulsar(event)" size="15" value="<?=$familia["Familia_res_adj"]; ?>"/></td>
            <td><input name="matricula" type="text" id="resolucion" onkeypress="return pulsar(event)" size="15" value="<?=$familia["Familia_matricula"]; ?>"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
  </tr>
</table>
  <table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="250"></td>
  </tr>
  <tr>
    <td width="233" align="left">&nbsp;</td>
    <td width="194" colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="28" align="left"><table width="200" border="0" cellpadding="3" cellspacing="0" bgcolor="#DBDBDB">
      <tr>
        <td width="11%" align="center"><input name="doc_completa" type="checkbox" id="doc_completa" value="1" <? if($familia["Familia_doc_completa"]=='1') {echo "checked=\"checked\"";} ?>/></td>
        <td width="89%">Documentaci&oacute;n completa </td>
      </tr>
    </table></td>
    <td colspan="-1"><table width="160" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFF66">
      <tr>
        <td width="11%" align="center"><input name="pagocancelado" type="checkbox" id="pagocancelado" value="1" <? if($familia["Familia_pagocancelado"]=='1') {echo "checked=\"checked\"";} ?>/></td>
        <td width="89%">Pagos cancelados</td>
      </tr>
    </table></td>
    <td><table width="200" border="0" cellpadding="3" cellspacing="0" bgcolor="#D9E294">
      <tr>
        <td width="11%" align="center"><input name="condescrit" type="checkbox" id="condescrit" value="1" <? if($familia["Familia_cond_escrit"]=='1') {echo "checked=\"checked\"";} ?>/></td>
        <td width="89%">En condiciones de escriturar </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="nombrecampo"><table width="160" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFCC99">
      <tr>
        <td width="11%" align="center"><input name="pendiente" type="checkbox" id="pendiente" value="1" <? if($familia["Familia_tramitependiente"]=='1') {echo "checked=\"checked\"";} ?>/></td>
        <td width="89%">Tr&aacute;mite pendiente </td>
      </tr>
    </table></td>
    <td align="left" class="nombrecampo">&nbsp;</td>
    <td align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="nombrecampo">Expediente escrituraci&oacute;n n&uacute;mero: </td>
<td align="left" class="nombrecampo">
<select name="expte_esc_nro" id="expte_esc_nro">
<option value="0">Sin expediente asignado</option>
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
</select></td>
    <td align="left" class="nombrecampo"></td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo"><strong>Observaciones</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="left"><textarea name="observaciones" cols="103" rows="4" id="observaciones"><? echo $familia["Familia_observaciones"]; ?></textarea></td>
    </tr>
  <tr>
    <td height="26" align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Actualizar informaci&oacute;n" />
    &nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>