<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
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

$lote_mz_prov = $familia["Lote_manzana_prov"];
$lote_pc_prov = $familia["Lote_parcela_prov"];

$lote_pc = $familia["Lote_parcela"];
$lote_subpc = $familia["Lote_subparcela"];
$lote_matricula = $familia["Lote_matricula"];
$familia_barrio = $familia["Barrio_nro"];
$adjudicacion_pendiente = $familia["Adjudicacion_pendiente"];
$familia_planvivienda = $familia["Planvivienda_nro"];

//$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
//$partido = mysql_query ($strSQL);

$sql567 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_esc = '1' AND blnActivo = '1' ORDER BY Expte_caract, Expte_num, Expte_anio, Expte_alcance",$link);

$sql645 = mysql_query("SELECT * FROM dbo_expte_reg ORDER BY Expte_caract ASC, Expte_num ASC, Expte_anio ASC, Expte_alcance ASC, Expte_cuerpo ASC",$link);

$resPlanViv = mysql_query("SELECT * FROM dbo_planvivienda ORDER BY Planvivienda_nro",$link);

?>
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
  <table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" colspan="2" valign="top"><strong>Barrio:</strong></td>
        <td colspan="2" valign="top"><select name="barrio_nro" id="barrio_nro">
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
        <td width="20%">&nbsp;</td>
        <td width="27%">&nbsp;</td>
      </tr>
      <tr>
        <td width="2%" height="40" bgcolor="#FFFF99">&nbsp;</td>
        <td width="12%" bgcolor="#FFFF99"><strong>Matr&iacute;cula:</strong></td>
        <td width="17%" bgcolor="#FFFF99"><input name="matricula" type="text" onkeypress="return pulsar(event)" size="15" value="<?=$familia["Familia_matricula"]; ?>"/></td>
        <td width="22%" bgcolor="#FFFF99">Fecha de escritura: </td>
        <td bgcolor="#FFFF99"><input name="fecha_escritura" type="text" onkeypress="return pulsar(event)" size="7" value="<? echo cambiaf_a_normal($familia["Familia_escritura_fecha"]); ?>"/>&nbsp;</td>
        <td bgcolor="#FFFF99">&nbsp;</td>
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
        <td height="25" valign="top">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32" colspan="2" valign="middle" bgcolor="#E6E6E6">Manzana antigua o provisoria:</td>
        <td height="25" valign="middle" bgcolor="#E6E6E6"><input name="lote_manzana_prov" type="text" id="lote_manzana" size="1" onkeypress="return pulsar(event)" value="<?=$lote_mz_prov; ?>"/></td>
        <td colspan="3" bgcolor="#E6E6E6">Parcela antigua o provisoria:</td>
        <td bgcolor="#E6E6E6"><input name="lote_parcela_prov" type="text" id="lote_parcela" size="1" onkeypress="return pulsar(event)" value="<?=$lote_pc_prov; ?>"/></td>
        <td bgcolor="#E6E6E6">&nbsp;</td>
        <td bgcolor="#E6E6E6">&nbsp;</td>
      </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="8" height="12"></td>
          </tr>
          <tr>
            <td width="20%" class="nombrecampo">Domicilio</td>
            <td width="15%" class="nombrecampo">&nbsp;</td>
            <td class="nombrecampo">&nbsp;</td>
            <td class="nombrecampo">&nbsp;</td>
            <td colspan="4" class="nombrecampo">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="8" class="nombrecampo"><label>
              <input name="familia_domic" type="text" id="familia_domic" onkeypress="return pulsar(event)" size="60" value="<?=$familia["Familia_domic"]; ?>"/>
            </label></td>
          </tr>
          <tr>
            <td height="26" class="nombrecampo">&nbsp;</td>
            <td class="nombrecampo">&nbsp;</td>
            <td class="nombrecampo">&nbsp;</td>
            <td class="nombrecampo">&nbsp;</td>
            <td class="nombrecampo">&nbsp;</td>
            <td class="nombrecampo">&nbsp;</td>
            <td align="center" bgcolor="#C53A3A" class="nombrecampo"><input name="familia_conflicto" type="checkbox" id="familia_conflicto" value="1" <? if($familia["Familia_conflicto"]=='1') {echo "checked=\"checked\"";} ?>/></td>
            <td bgcolor="#C53A3A" style="color:#E4E4E4;">Conflicto</td>
          </tr>
          <tr>
            <td class="nombrecampo">Resoluci&oacute;n   N&ordm; </td>
            <td class="nombrecampo">Plano Nro. </td>
            <td width="18%" class="nombrecampo">Fecha aprobado</td>
            <td width="4%" class="nombrecampo">&nbsp;</td>
            <td colspan="4" class="nombrecampo">&nbsp;</td>
          </tr>
          <tr>
            <td height="28"><input name="resolucion" type="text" id="resolucion" onkeypress="return pulsar(event)" size="9" value="<?=$familia["Familia_res_adj"]; ?>"/></td>
            <td height="28"><input name="plano_num" type="text" id="plano_num" onkeypress="return pulsar(event)" size="10" value="<?=$familia["Plano_num"]; ?>"/></td>
            <td><input name="plano_aprobado_fecha" type="text" id="plano_fecha" onkeypress="return pulsar(event)" size="10" value="<? echo cambiaf_a_normal($familia["Plano_aprobado_fecha"]); ?>"/></td>
            <td align="center" bgcolor="#D0DCFB"><input name="adjudicacion_pendiente" type="checkbox" id="adjudicacion_pendiente" value="1" <? if($adjudicacion_pendiente  == '1') { echo "checked=\"checked\""; }?>/></td>
            <td width="16%" bgcolor="#D0DCFB">Adj. pendiente </td>
            <td width="2%">&nbsp;</td>
            <td width="5%" align="center" bordercolor="#D14421" bgcolor="#EFA592"><input name="familia_ocupacion_verificar" type="checkbox" id="familia_ocupacion_verificar" value="1" <? if($familia["Familia_ocupacion_verificar"]=='1') {echo "checked=\"checked\"";} ?>/></td>
            <td width="20%" bordercolor="#D14421" bgcolor="#EFA592">Verificar ocupaci&oacute;n</td>
          </tr>
          <tr>
            <td height="10" colspan="8"></td>
          </tr>
          <tr>
            <td height="28" colspan="2" align="center">Decreto  compra/afectaci&oacute;n (PFP):</td>
            <td height="28"><input name="decreto_compra" type="text" id="decreto_compra" onkeypress="return pulsar(event)" size="10" value="<? echo $familia["Familia_decreto_compra"]; ?>"/></td>
            <td height="28" align="center" bgcolor="#FFC1FF"><input name="ausente" type="checkbox" id="ausente" value="1" <? if($familia["Familia_censo_ausente"]  == '1') { echo "checked=\"checked\""; }?>/></td>
            <td height="28" bgcolor="#FFC1FF">Ausente</td>
            <td height="28">&nbsp;</td>
            <td height="28" align="center" bgcolor="#AECEA6"><input name="tarjeta_solic" type="checkbox" id="tarjeta_solic" value="1" <? if($familia["Familia_tarjeta_solicitar"]=='1') {echo "checked=\"checked\"";} ?>/></td>
            <td height="28" bgcolor="#AECEA6">Solicitar tarjeta</td>
          </tr>
          <tr>
            <td colspan="8">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="8"><hr /></td>
          </tr>
          <tr>
            <td colspan="8">&nbsp;</td>
          </tr>
      </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      
          <tr>
              <td height="31" colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="34%" height="30" bgcolor="#E2EAF1">Plan de vivienda: </td>
                  <td width="66%" bgcolor="#E2EAF1"><select name="planvivienda" id="planvivienda">
                    <option value="0" <? if($familia["Planvivienda_nro"] == '0') {echo "selected=\"selected\"";} ?>>Sin plan de vivienda</option>
                    <?	  while ($planvivienda = mysql_fetch_array($resPlanViv)) {	

$planvivienda_nro = $planvivienda["Planvivienda_nro"];
$planvivienda_nombre = $planvivienda["Planvivienda_nombre"];
?>
                    <option value="<? echo $planvivienda_nro; ?>" <? if($planvivienda_nro == $familia["Planvivienda_nro"]) {echo "selected=\"selected\"";} ?>>
                      <?=$planvivienda_nombre; ?>
                      </option>
                    <? } ?>
                  </select></td>
                </tr>
              </table></td>
            <td width="3%" rowspan="7">&nbsp;</td>
            <td width="48%" rowspan="8" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="30" colspan="3" align="center" bgcolor="#E9E9E9">VALOR TIERRA Y PAGOS</td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <td height="30">Monto original:</td>
                  <td height="30" colspan="2">$ 
                    <? if($user["p763"] == '1') { ?>
                    <input name="familia_montoadj" type="text" value="<?=$familia["Familia_montoadj"]; ?>" size="10" /><? 
				}else{ ?>
                    <input name="familia_montoadj" type="hidden" value="<?=$familia["Familia_montoadj"]; ?>" />	
                    <?=$familia["Familia_montoadj"]; ?>
                    <? } ?>
                  </td>
                </tr>
                <tr>
                  <td width="37%" height="30">Cantidad de cuotas: </td>
                  <td colspan="2"><input name="familia_montoadj_cuotas" type="text" value="<?=$familia["Familia_montoadj_cuotas"]; ?>" size="10" /></td>
                </tr>
                <tr>
                  <td height="30">Monto  actualizaci&oacute;n: </td>
                  <td colspan="2">$
                    <input name="familia_montoact" type="text" value="<?=$familia["Familia_monto_actualizacion"]; ?>" size="10" />
                  &nbsp;</td>
                </tr>
                <tr>
                  <td height="30">Fecha actualizaci&oacute;n:</td>
                  <td width="31%"><input name="familia_monto_actualizacion_fecha" type="text" value="<?=cambiaf_a_normal($familia["Familia_monto_actualizacion_fecha"]); ?>" size="8" /></td>
                  <td width="32%">(dd/mm/aaaa)</td>
                </tr>
                <tr>
                  <td height="30">Monto hipoteca:</td>
                  <td>$
                    <input name="familia_hipoteca_monto" type="text" value="<?=$familia["Familia_hipoteca_monto"]; ?>" size="10" />
&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td height="30">Fecha  hipoteca:</td>
                  <td><input name="familia_hipoteca_monto_fecha" type="text" value="<? echo $familia["Familia_hipoteca_monto_fecha"]; ?>" size="8" /></td>
                  <td>(dd/mm/aaaa)</td>
                </tr>
            </table></td>
          </tr>
          <tr>
              <td height="31" colspan="3">&nbsp;</td>
          </tr>
          <tr>
          <td width="3%" height="31">&nbsp;</td>
          <td colspan="2"><table width="220" border="0" cellpadding="3" cellspacing="0" bgcolor="#B5CEFD">
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
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30" colspan="2"><table width="220" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFC184">
            <tr>
              <td width="11%" align="center"><input name="doc_completa" type="checkbox" id="doc_completa" value="1" <? if($familia["Familia_doc_completa"]=='1') {echo "checked=\"checked\"";} ?>/></td>
              <td width="89%">Document. completa </td>
              </tr>
          </table></td>
          </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="30" colspan="2"><table width="220" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFF66">
          <tr>
            <td width="11%" align="center"><input name="pagocancelado" type="checkbox" id="pagocancelado" value="1" <? if($familia["Familia_pagocancelado"]=='1') {echo "checked=\"checked\"";} ?>/></td>
            <td width="89%">Pagos cancelados</td>
            </tr>
        </table></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="30" colspan="2"><table width="220" border="0" cellpadding="3" cellspacing="0" bgcolor="#D3D5FE">
          <tr>
            <td width="11%" align="center"><input name="procrear" type="checkbox" id="procrear" value="1" <? if($familia["blnProcrear"]=='1') {echo "checked=\"checked\"";} ?>/></td>
            <td width="89%">Es PRO.CRE.AR. </td>
            </tr>
        </table></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="30" colspan="2"><table width="220" border="0" cellpadding="3" cellspacing="0" bgcolor="#D9E294">
          <tr>
            <td width="11%" align="center"><input name="condescrit" type="checkbox" id="condescrit" value="1" <? if($familia["Familia_cond_escrit"]=='1') {echo "checked=\"checked\"";} ?>/></td>
            <td width="89%">En gesti&oacute;n de escrituraci&oacute;n</td>
            </tr>
        </table></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="32" colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="650" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td colspan="5"></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td width="6" height="28" align="left" class="nombrecampo">&nbsp;</td>
    <td width="13" height="22" align="left" bgcolor="#C4D7F4" class="nombrecampo">&nbsp;</td>
    <td width="256" align="left" valign="middle" bgcolor="#C4D7F4" >
	<? if ($user["p745"] == '1') {  ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="26">Expediente de regularizaci&oacute;n </td>
      </tr>
      <tr>
        <td><select name="expte_reg_nro" id="expte_reg_nro">
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
      </tr>
    </table><? } ?></td>
    <td width="10" align="left" class="nombrecampo">&nbsp;</td>
    <td width="7" align="left" bgcolor="#DEEACE" class="nombrecampo">&nbsp;</td>
    <td width="359" align="left" valign="middle" bgcolor="#DEEACE" >
	<? if ($user["p755"] == '1') {  ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="26" colspan="6">Expediente de escrituracion </td>
      </tr>
      <tr>
        <td colspan="6"><select name="expte_esc_nro" id="expte_esc_nro">
<option value="0">Sin expediente asignado</option>
<?	  while ($expte = mysql_fetch_array($sql567)) {	

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_alcance = $expte["Expte_alcance"];

?>
<option value="<? echo $expte_nro; ?>" <? if ($expte_nro == $familia["Expte_esc_nro"]) {echo "selected=\"selected\"";} ?>><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> </option>
<? } ?>
</select></td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td width="7%"><input name="expte_esc_condicion" type="radio" value="1" <? if($familia["Expte_esc_condicion"] == '1') { echo "checked='checked'"; } ?>/></td>
        <td width="19%">En tr&aacute;mite </td>
        <td width="7%"><input name="expte_esc_condicion" type="radio" value="2" <? if($familia["Expte_esc_condicion"] == '2') { echo "checked='checked'"; } ?>/></td>
        <td width="30%">Esc. entregada </td>
        <td width="7%"><input name="expte_esc_condicion" type="radio" value="3" <? if($familia["Expte_esc_condicion"] == '3') { echo "checked='checked'"; } ?>/></td>
        <td width="30%">Esc. anulada </td>
      </tr>
    </table>
	<? }else{ ?> <input type="hidden" name="expte_esc_nro" value="<?=$familia["Expte_esc_nro"]; ?>" /><?=$familia["Expte_esc_nro"]; ?><? } ?>	
	</td>
    <td width="7" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="left" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="left" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="36"><strong>Observaciones (gestión de adjudicación)</strong></td>
        <td><strong>Observaciones (gestión escrituraria)</strong></td>
      </tr>
      <tr>
        <td><textarea name="observaciones" cols="45" rows="4" id="observaciones"><? echo $familia["Familia_observaciones"]; ?></textarea></td>
        <td><textarea name="observaciones_esc" cols="45" rows="4" id="observaciones_esc"><? echo $familia["Familia_observaciones_esc"]; ?></textarea></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="7" align="left">&nbsp;</td>
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