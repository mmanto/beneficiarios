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

$sqlDir = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dir = mysql_fetch_array($sqlDir);
$dirNombre = $dir["Direccion_nombre"];

$sqlDirProv = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dirprov = mysql_fetch_array($sqlDirProv);
$dirProvNombre = $dir["Direccion_dirprov"];

//////////////////////////////////////////////////////////////////

$idBarrio = $_GET["idBarrio"];

$sqlb = "SELECT * FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) WHERE Barrio_nro = $idBarrio";
$bar = mysql_query($sqlb);
$barrio = mysql_fetch_array($bar);
$barrio_nombre = $barrio["Barrio_nombre"];
$partido_nombre = $barrio["Partido_nombre"];

$sql567 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_esc = '1' ORDER BY Expte_nro DESC",$link);


$resPlanViv = mysql_query("SELECT * FROM dbo_planvivienda ORDER BY Planvivienda_nro",$link);

?>

<style type="text/css">
<!--
.Estilo2 {font-size: 18px}
-->
</style>
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo lote sin beneficiarios</h2></td>
  </tr>
	<tr>
	  <td height="30" colspan="2"><a href="barrios_listar_partido.php?idPartido=<? echo $barrio["Partido_nro"]; ?>">Volver al listado </a>	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="lote_alta_porbarrio.php" method="post" name="f" id="f">
<input type="hidden" name="idBarrio" value="<? echo $idBarrio; ?>" onkeypress="return pulsar(event)"/>
<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="48%"><table width="250" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="29%" height="28" class="Estilo2">Partido:</td>
            <td width="4%" bgcolor="#FFFF99" class="Estilo2">&nbsp;</td>
            <td class="Estilo2" width="67%" bgcolor="#FFFF99"><? echo $partido_nombre; ?></td>
          </tr>
        </table></td>
        <td width="52%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%" height="28" class="Estilo2">Barrio:</td>
            <td width="4%" bgcolor="#FFFF99" class="Estilo2">&nbsp;</td>
            <td class="Estilo2" width="76%" bgcolor="#FFFF99"><? echo $barrio_nombre; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="24">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="16%">Fecha carga </td>
          <td width="3%">&nbsp;</td>
          <td width="81%" colspan="3" rowspan="2" bgcolor="#E4E4E4"><table width="100%" border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td colspan="3" valign="bottom"><strong>Direcci&oacute;n de origen del beneficio </strong></td>
        </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><input name="beneficio_origen" type="radio" value="1" <? if ($idDireccion != '2') { echo "checked=\"checked\""; } ?> /></td>
              <td width="87%" valign="bottom">Dir. Reg.Urb. y Dominial </td>
            </tr>
          </table></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><input name="beneficio_origen" type="radio" value="2" <? if ($idDireccion == '2') { echo "checked=\"checked\""; } ?>/></td>
              <td width="87%" valign="middle">Plan Familia Propietaria  </td>
            </tr>
          </table></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><input name="beneficio_origen" type="radio" value="3" /></td>
              <td width="87%" valign="middle">Ley 24374  </td>
            </tr>
          </table></td>
      </tr>
    </table></td>
          </tr>
        <tr>
          <td><input name="censo_fecha" type="text" id="censo_fecha" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="<?=date("d/m/Y"); ?>" size="10"/></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td colspan="5" height="8px"></td>
          </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td height="26" colspan="9" align="center" valign="bottom" bgcolor="#FFE1C4"><strong><u>NOMENCLATURA CATASTRAL</u></strong></td>
        </tr>
      <tr>
        <td colspan="9" align="center" valign="middle" bgcolor="#FFE1C4"><strong>Atenci&oacute;n:</strong>  Reemplazar en cada campo el valor 0 (cero) por el correspondiente. En caso de no contener la nomenclatura algunos de los datos indicados, conservar el valor por defecto 0 (cero). </td>
        </tr>
      <tr>
        <td width="25" valign="bottom" bgcolor="#FFE1C4">&nbsp;</td>
        <td width="65" valign="bottom" bgcolor="#FFE1C4"><strong>Circ.</strong></td>
        <td width="68" valign="bottom" bgcolor="#FFE1C4"><strong>Secc.</strong></td>
        <td width="65" valign="bottom" bgcolor="#FFE1C4"><strong>Ch.</strong></td>
        <td width="59" valign="bottom" bgcolor="#FFE1C4"><strong>Qta.</strong></td>
        <td width="65" valign="bottom" bgcolor="#FFE1C4"><strong>Fracc.</strong></td>
        <td width="73" valign="bottom" bgcolor="#FFE1C4"><strong>Mz.</strong></td>
        <td width="62" valign="bottom" bgcolor="#FFE1C4"><strong>Pc.</strong></td>
        <td width="64" valign="bottom" bgcolor="#FFE1C4"><strong>Subpc.</strong></td>
        </tr>
      <tr>
        <td height="25" valign="top" bgcolor="#FFE1C4">&nbsp;</td>
        <td bgcolor="#FFE1C4"><input name="lote_circ" type="text" id="lote_circ"  size="3" onkeypress="return pulsar(event)" value="<?=$barrio["Barrio_circunscripcion"]; ?>"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_secc" type="text" id="lote_secc"  size="3" onkeypress="return pulsar(event)" value="<?=$barrio["Barrio_seccion"]; ?>"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_ch" type="text" id="lote_ch"  size="3" onkeypress="return pulsar(event)" value="<?=$barrio["Barrio_chacra"]; ?>"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_qta" type="text" id="lote_qta"  size="3" onkeypress="return pulsar(event)" value="<?=$barrio["Barrio_quinta"]; ?>"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_fracc" type="text" id="lote_fracc" size="3" onkeypress="return pulsar(event)" value="<?=$barrio["Barrio_fraccion"]; ?>"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_manzana" type="text" id="lote_manzana" value="0" size="3" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_parcela" type="text" id="lote_parcela" value="0" size="3" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_subpc" type="text" id="lote_subpc" value="0" size="3" onkeypress="return pulsar(event)"/></td>
        </tr>
      <tr>
        <td height="6" colspan="9" valign="top"></td>
        </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="53%" class="nombrecampo">Domicilio</td>
            <td width="19%" class="nombrecampo">&nbsp;</td>
            <td width="28%" class="nombrecampo">Matr&iacute;cula   N&ordm; </td>
          </tr>
          <tr>
            <td><input name="domicilio" type="text" id="domicilio" onkeypress="return pulsar(event)" size="50"/></td>
            <td>&nbsp;</td>
            <td><input name="matricula" type="text" id="matricula" onkeypress="return pulsar(event)" value="0" size="15"/></td>
          </tr>
          <tr>
            <td height="20">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" style="nombrecampo""><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="21%">Res./Decreto Adj.N&ordm;: </td>
                              <td width="13%"><input name="resolucion" type="text" id="resolucion" onkeypress="return pulsar(event)" size="9"/></td>
                              <td width="3%">&nbsp;</td>
                              <td width="22%">Monto adjudicaci&oacute;n: $ </td>
                              <td width="13%"><input name="familia_montoadj" type="text" value="0" size="8" /></td>
                              <td width="13%">Cant. cuotas: </td>
                              <td width="15%"><input name="familia_montoadj_cuotas" type="text" id="familia_montoadj_cuotas" size="3" /></td>
                            </tr>
                            <tr>
                              <td height="56" colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="34" colspan="5" align="left" valign="bottom">&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td colspan="2" valign="bottom">Plan de vivienda </td>
                                </tr>
                                <tr>
                                  <td width="12%" height="36" align="center" bgcolor="#CEE1F4">Plano No : </td>
                                  <td width="12%" bgcolor="#CEE1F4"><input name="plano_numero" type="text" id="plano_numero" value="<?=$barrio["Barrio_plano"]; ?>" size="7" /></td>
                                  <td width="11%" align="right" bgcolor="#CEE1F4">Aprobado:</td>
                                  <td width="2%" bgcolor="#CEE1F4">&nbsp;</td>
                                  <td width="17%" bgcolor="#CEE1F4"><input name="plano_aprobado_fecha" type="text" id="plano_aprobado_fecha" value="<? echo cambiaf_a_normal($barrio["Barrio_plano_aprob_fecha"]); ?>" size="8" /></td>
                                  <td width="3%" align="center">&nbsp;</td>
                                  <td colspan="2"><select name="planvivienda" id="planvivienda">
              <option value="0" <? if($familia["Planvivienda_nro"] == '0') {echo "selected=\"selected\"";} ?>>Sin plan de vivienda</option>
                <?	  while ($planvivienda = mysql_fetch_array($resPlanViv)) {	

$planvivienda_nro = $planvivienda["Planvivienda_nro"];
$planvivienda_nombre = $planvivienda["Planvivienda_nombre"];
?>
                <option value="<? echo $planvivienda_nro; ?>" <? if($planvivienda_nro == $barrio["Planvivienda_nro"]) {echo "selected=\"selected\"";} ?>>
                  <?=$planvivienda_nombre; ?>
                  </option>
                <? } ?>
                </select></td>
                                </tr>
                                <tr>
                                  <td height="22" align="center" bgcolor="#CEE1F4">&nbsp;</td>
                                  <td align="center" bgcolor="#CEE1F4">&nbsp;</td>
                                  <td colspan="3" align="center" valign="top" bgcolor="#CEE1F4">(Formato <strong>dd/mm/aaaa</strong>)</td>
                                  <td align="center">&nbsp;</td>
                                  <td width="22%" align="center">Decreto compra/afec.</td>
                                  <td width="21%" align="left"><input name="decreto_compra" type="text" id="decreto_compra" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="<? echo $barrio["Barrio_decreto_compra"]; ?>" size="14" /></td>
                                </tr>
                                <tr>
                                  <td align="center">&nbsp;</td>
                                  <td align="center">&nbsp;</td>
                                  <td align="center">&nbsp;</td>
                                  <td align="center">&nbsp;</td>
                                  <td align="center">&nbsp;</td>
                                  <td align="center">&nbsp;</td>
                                  <td align="center">&nbsp;</td>
                                  <td align="center">&nbsp;</td>
                                </tr>
                              </table></td>
                            </tr>
                          </table></td>
          </tr>
        </table></td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="269"></td>
  </tr>
  <tr>
    <td width="222" align="left">&nbsp;</td>
    <td width="186" colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="28" align="left"><table width="190" border="0" cellpadding="3" cellspacing="0" bgcolor="#DBDBDB">
      <tr>
        <td width="11%" align="center"><input name="doc_completa" type="checkbox" id="doc_completa" value="1" /></td>
        <td width="89%">Documentaci&oacute;n completa </td>
      </tr>
    </table></td>
    <td colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#BFD5FF">
      <tr>
        <td width="7%" align="center"><input name="blnBoleto" type="checkbox" id="blnBoleto" value="1" /></td>
        <td width="38%">Boleto Compra Venta </td>
        <td width="21%">Fecha  Boleto: </td>
        <td width="34%"><input name="boleto_fecha" type="text" id="boleto_fecha" size="12" /></td>
      </tr>
      
    </table></td>
    </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="nombrecampo"><table width="190" border="0" cellpadding="3" cellspacing="0" bgcolor="#CBCFFE">
      <tr>
        <td width="11%" align="center"><input name="procrear" type="checkbox" id="procrear" value="1" /></td>
        <td width="89%">Plan PROCREAR </td>
      </tr>
    </table></td>
    <td align="left" class="nombrecampo"><table width="155" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFF66">
      <tr>
        <td width="11%" align="center"><input name="pagocancelado" type="checkbox" id="pagocancelado" value="1" /></td>
        <td width="89%">Pagos cancelados</td>
      </tr>
    </table></td>
    <td align="left" class="nombrecampo"><table width="210" border="0" cellpadding="3" cellspacing="0" bgcolor="#D9E294">
      <tr>
        <td width="11%" align="center"><input name="condescrit" type="checkbox" id="condescrit" value="1" /></td>
        <td width="89%">En condiciones de escriturar </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="4%" height="28" align="center" bgcolor="#FFD5FF"><input name="ausente" type="checkbox" id="ausente" value="1"/></td>
                                  <td width="19%" align="center" bgcolor="#FFD5FF">Ausente en censo</td>
                                  <td width="12%">&nbsp;</td>
                                  <td width="4%" align="center" bgcolor="#D0DCFB"><input name="adjudicacion_pendiente" type="checkbox" id="adjudicacion_pendiente" value="1"/></td>
                                  <td width="23%" align="center" bgcolor="#D0DCFB">Adjudicaci&oacute;n pendiente </td>
                                  <td width="13%">&nbsp;</td>
                                  <td width="3%" align="center" bgcolor="#F7D2CA"><input name="familia_ocupacion_verificar" type="checkbox" id="familia_ocupacion_verificar" value="1"/></td>
                                  <td width="22%" align="center" bgcolor="#F7D2CA">Verificar ocupaci&oacute;n</td>
                                </tr>
      </table></td>
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
<option value="<? echo $expte_nro; ?>" ><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?></option>
<? } ?>
</select></td>
    <td align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo"><strong>Observaciones</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="left"><textarea name="observaciones" cols="110" rows="4" id="observaciones">Sin observaciones</textarea></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar beneficio" />&nbsp;</td>
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