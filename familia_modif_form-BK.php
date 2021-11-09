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
$familia_barrio = $familia["Barrio_nro"];
$adjudicacion_pendiente = $familia["Adjudicacion_pendiente"];

//$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
//$partido = mysql_query ($strSQL);

$sql567 = mysql_query("SELECT * FROM dbo_expte_esc ORDER BY Expte_caract ASC, Expte_num ASC, Expte_anio ASC, Expte_alcance ASC, Expte_cuerpo ASC",$link);

$sql645 = mysql_query("SELECT * FROM dbo_expte_reg ORDER BY Expte_caract ASC, Expte_num ASC, Expte_anio ASC, Expte_alcance ASC, Expte_cuerpo ASC",$link);

?><table width="600" border="0" cellpadding="0" cellspacing="0">
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
        <td width="11%"><strong>Barrio:</strong></td>
        <td width="50%"><select name="barrio_nro" id="barrio_nro">
  <option value="0">Seleccione un barrio</option>
  <?	  while ($barrio = mysql_fetch_array($sql789)) {	

$barrio_nro = $barrio["Barrio_nro"];
$barrio_partido = $barrio["Partido_nombre"];
$barrio_nombre = $barrio["Barrio_nombre"];
?>
  <option value="<? echo $barrio_nro; ?>"
<? if($barrio_nro == $familia_barrio) { ?>selected="selected"<? } ?>><?=$barrio_partido; ?> - <?=$barrio_nombre; ?></option>
  <? } ?>
</select></td>
        <td width="12%"><strong>Matr&iacute;cula:</strong></td>
        <td width="27%"><input name="matricula" type="text" id="resolucion" onkeypress="return pulsar(event)" size="15" value="<?=$familia["Familia_matricula"]; ?>"/></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
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
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="7" height="12"></td>
          </tr>
          <tr>
            <td width="21%" class="nombrecampo">Tel&eacute;fono</td>
            <td width="19%" class="nombrecampo">Resoluci&oacute;n   N&ordm; </td>
            <td width="5%" class="nombrecampo">&nbsp;</td>
            <td colspan="4" class="nombrecampo">&nbsp;</td>
          </tr>
          <tr>
            <td height="28"><input name="familia_telefono" type="text" id="familia_telefono" onkeypress="return pulsar(event)" size="13" value="<?=$familia["Familia_telefono"]; ?>"/></td>
            <td><input name="resolucion" type="text" id="resolucion" onkeypress="return pulsar(event)" size="10" value="<?=$familia["Familia_res_adj"]; ?>"/></td>
            <td align="center" bgcolor="#D0DCFB"><input name="adjudicacion_pendiente" type="checkbox" id="adjudicacion_pendiente" value="1" <? if($adjudicacion_pendiente  == '1') { echo "checked=\"checked\""; }?>/></td>
            <td width="25%" bgcolor="#D0DCFB">Adjudicaci&oacute;n pendiente </td>
            <td width="4%">&nbsp;</td>
            <td width="5%" align="center" bordercolor="#D14421" bgcolor="#D14421"><input name="familia_ocupacion_verificar" type="checkbox" id="familia_ocupacion_verificar" value="1" <? if($familia["Familia_ocupacion_verificar"]=='1') {echo "checked=\"checked\"";} ?>/></td>
            <td width="21%" bordercolor="#D14421" bgcolor="#D14421"><font color="#FFFFFF">Verificar ocupaci&oacute;n</font></td>
          </tr>
          <tr>
            <td colspan="7">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="7"><hr /></td>
          </tr>
          <tr>
            <td colspan="7">&nbsp;</td>
          </tr>
      </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="44%" height="30"><table width="220" border="0" cellpadding="3" cellspacing="0" bgcolor="#B5CEFD">
      <tr>
        <td width="12%" align="center"><input name="blnBoleto" type="checkbox" id="blnBoleto" value="1" <? if($familia["blnBoleto"]=='1') {echo "checked=\"checked\"";} ?>/></td>
        <td colspan="2">Boleto Compra-Venta PFP </td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td width="23%">Fecha: </td>
        <td width="65%"><input name="boleto_fecha" type="text" id="boleto_fecha" size="8" value="<?= $familia["Boleto_fecha"]; ?>"/></td>
      </tr>
    </table></td>
        <td width="3%">&nbsp;</td>
        <td width="21%">Monto adjudicaci&oacute;n: </td>
        <td width="27%">$ <input name="familia_montoadj" type="text" value="<?=$familia["Familia_montoadj"]; ?>" size="10" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="30"><table width="220" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFC184">
      <tr>
        <td width="11%" align="center"><input name="doc_completa" type="checkbox" id="doc_completa" value="1" <? if($familia["Familia_doc_completa"]=='1') {echo "checked=\"checked\"";} ?>/></td>
        <td width="89%">Document. completa </td>
      </tr>
    </table></td>
        <td>&nbsp;</td>
        <td>Monto actualizaci&oacute;n: </td>
        <td>$ <input name="familia_montoact" type="text" value="<?=$familia["Familia_monto_actualizacion"]; ?>" size="10" />&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="30"><table width="220" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFF66">
      <tr>
        <td width="11%" align="center"><input name="pagocancelado" type="checkbox" id="pagocancelado" value="1" <? if($familia["Familia_pagocancelado"]=='1') {echo "checked=\"checked\"";} ?>/></td>
        <td width="89%">Pagos cancelados</td>
      </tr>
    </table></td>
        <td>&nbsp;</td>
        <td>Monto pagado: </td>
        <td>$ <input name="familia_montoadj_pago" type="text" id="familia_montoadj_pago" value="<?=$familia["Familia_montoadj_pago"]; ?>" size="10" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="30"><table width="220" border="0" cellpadding="3" cellspacing="0" bgcolor="#D3D5FE">
      <tr>
        <td width="11%" align="center"><input name="procrear" type="checkbox" id="procrear" value="1" <? if($familia["blnProcrear"]=='1') {echo "checked=\"checked\"";} ?>/></td>
        <td width="89%">Es PRO.CRE.AR. </td>
      </tr>
    </table></td>
        <td>&nbsp;</td>
        <td>Saldo restante: </td>
        <td><strong>$ <?
		$saldo = $familia["Familia_montoadj"] - $familia["Familia_montoadj_pago"];
		echo $saldo;		
		?>&nbsp;</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="30"><table width="220" border="0" cellpadding="3" cellspacing="0" bgcolor="#D9E294">
      <tr>
        <td width="11%" align="center"><input name="condescrit" type="checkbox" id="condescrit" value="1" <? if($familia["Familia_cond_escrit"]=='1') {echo "checked=\"checked\"";} ?>/></td>
        <td width="89%">En cond. de escriturar </td>
      </tr>
    </table></td>
        <td>&nbsp;</td>
        <td>Monto de cancelaci&oacute;n: </td>
        <td>$ <input name="familia_cancelacion_monto" type="text" value="<?=$familia["Familia_cancelacion_monto"]; ?>" size="10" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="32">&nbsp;</td>
        <td>&nbsp;</td>
        <td>Fecha de cancelaci&oacute;n: </td>
        <td><input name="familia_cancelacion_fecha" type="text" value="<?=$familia["Familia_cancelacion_fecha"]; ?>" size="10" /></td>
      </tr>
    </table></td>
  </tr>
</table>
  <table width="600" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td colspan="5"></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td height="28" align="left" class="nombrecampo">&nbsp;</td>
    <td height="22" align="left" bgcolor="#C4D7F4" class="nombrecampo">&nbsp;</td>
    <td align="left" valign="bottom" bgcolor="#C4D7F4" >Expediente de regularizaci&oacute;n </td>
    <td align="left" class="nombrecampo">&nbsp;</td>
    <td align="left" bgcolor="#DEEACE" class="nombrecampo">&nbsp;</td>
    <td width="255" align="left" valign="bottom" bgcolor="#DEEACE" >Expediente de escrituraci&oacute;n </td>
    <td width="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td width="5" height="35" align="left" class="nombrecampo">&nbsp;</td>
    <td width="11" align="left" bgcolor="#C4D7F4" class="nombrecampo">&nbsp;</td>
    <td width="274" align="left" valign="top" bgcolor="#C4D7F4" class="nombrecampo">
<select name="expte_reg_nro" id="expte_reg_nro">
<option value="0">Sin expediente asignado</option>
<?	  while ($expte = mysql_fetch_array($sql645)) {	

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_barrio = $expte["Barrio_nombre"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];

?>
<option value="<? echo $expte_nro; ?>" <? if ($expte_nro == $familia["Expte_reg_nro"]) {echo "selected=\"selected\"";} ?>><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> <? if ($expte_cuerpo != '0') {echo "Cpo ".$expte_cuerpo; }else{ echo " "; } ?></option>
<? } ?>
</select></td>
    <td width="8" align="left" class="nombrecampo">&nbsp;</td>
    <td width="2" align="left" bgcolor="#DEEACE" class="nombrecampo">&nbsp;</td>
    <td align="left" valign="top" bgcolor="#DEEACE" class="nombrecampo"><select name="expte_esc_nro" id="expte_esc_nro">
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
    <td colspan="7" align="left" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="left" ><strong>Observaciones</strong></td>
  </tr>
  <tr>
    <td colspan="7" align="left"><textarea name="observaciones" cols="95" rows="4" id="observaciones"><? echo $familia["Familia_observaciones"]; ?></textarea></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="2" align="center"><input name="cmdAccion" type="submit" id="cmdAccion" value="Actualizar informaci&oacute;n" />
    &nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>