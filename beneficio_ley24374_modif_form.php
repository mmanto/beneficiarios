<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$idFamilia = $_GET["idFamilia"];

/*$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];*/

$sql = "SELECT * FROM dbo_familia WHERE Familia_nro = $idFamilia";
$res = mysql_query($sql);
$familia = mysql_fetch_array($res);
$fecha_escritura = cambiaf_a_normal($familia["Familia_escritura_fecha"]);
$fecha_inscripcion = cambiaf_a_normal($familia["Familia_escritura_insc_fecha"]);

//Listado partidos
$strSQL2 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido2 = mysql_query ($strSQL2);

?>

<style type="text/css">
<!--
.Estilo2 {font-size: 18px}
-->
</style>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Modificar registro</h2></td>
  </tr>
	<tr>
  <td height="50" colspan="2" valign="top"><a href="javascript:history.back()">Volver</a></tr>
</table>

<form action="beneficio_ley24374_modif.php" method="post" name="f" id="f">
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12%">Partido:</td>
        <td colspan="3"><select name="idPartido" id="idPartido">
      <option value="0">Seleccione un Partido...</option>
      <? while($rsPart = mysql_fetch_array($partido2)) {?>
      <option value="<?=$rsPart["Partido_nro"]; ?>" 
	<? if($rsPart["Partido_nro"] == $familia["Partido_nro"]) { echo "selected=\"selected\""; } ?>>
        <?=$rsPart["Partido_nombre"]; ?>
        </option>
      <? } ?>
    </select></td>
      </tr>
      <tr>
        <td height="24" colspan="4">&nbsp;</td>
        </tr>
      <tr>
        <td height="24" colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="17%">Nro. Registro</td>
            <td width="83%">Escribano (Apellido y Nombre) </td>
          </tr>
          <tr>
            <td><input name="escribano_registro" type="text" id="escribano_registro" onkeypress="return pulsar(event)" size="5" value="<? echo $familia["Expte_ley_registro"]; ?>"/></td>
            <td><input name="escribano_nombre" type="text" id="escribano_nombre" onkeypress="return pulsar(event)" size="45" value="<? echo $familia["Expte_ley_escribano_nombre"]; ?>"/></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td height="24">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">Instancia de alta</td>
        <td width="29%" height="24">Nro. Expte. Regularizaci&oacute;n</td>
        <td width="26%">Nro. Expte. Consolidaci&oacute;n</td>
      </tr>
      <tr>
        <td height="24" colspan="2"><table width="90%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8%" height="28" valign="middle" bgcolor="#D7E1EA"><input type="radio" name="alta_instancia" id="radio" value="1" <? if($familia["Expte_ley_alta_instancia"] == '1') { echo "checked=\"checked\""; } ?>/></td>
            <td width="42%" valign="middle" bgcolor="#D7E1EA">Regularización</td>
            <td width="8%" valign="middle" bgcolor="#D7E1EA"><input name="alta_instancia" type="radio" id="radio2" value="2" <? if($familia["Expte_ley_alta_instancia"] == '2') { echo "checked=\"checked\""; } ?> /></td>
            <td width="42%" valign="middle" bgcolor="#D7E1EA">Consolidación</td>
          </tr>
        </table></td>
        <td height="24"><input name="expte_ley_reg_num" type="text" id="expte_ley_reg_num" onkeypress="return pulsar(event)" value="<? echo $familia["Expte_ley_reg_num"]; ?>" size="20"/></td>
        <td height="24"><input name="expte_ley_cons_num" type="text" id="expte_ley_cons_num" onkeypress="return pulsar(event)" value="<? echo $familia["Expte_ley_cons_num"]; ?>" size="20"/></td>
      </tr>
      <tr>
        <td height="24" colspan="2">&nbsp;</td>
        <td height="24">&nbsp;</td>
        <td height="24">&nbsp;</td>
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
        <td bgcolor="#FFE1C4"><input name="lote_circ" type="text" id="lote_circ" onkeypress="return pulsar(event)" value="<? echo $familia["Lote_circunscripcion"]; ?>"  size="3"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_secc" type="text" id="lote_secc" onkeypress="return pulsar(event)" value="<? echo $familia["Lote_seccion"]; ?>"  size="3" /></td>
        <td bgcolor="#FFE1C4"><input name="lote_ch" type="text" id="lote_ch" onkeypress="return pulsar(event)" value="<? echo $familia["Lote_chacra"]; ?>"  size="3" /></td>
        <td bgcolor="#FFE1C4"><input name="lote_qta" type="text" id="lote_qta" onkeypress="return pulsar(event)" value="<? echo $familia["Lote_quinta"]; ?>"  size="3" /></td>
        <td bgcolor="#FFE1C4"><input name="lote_fracc" type="text" id="lote_fracc" onkeypress="return pulsar(event)" value="<? echo $familia["Lote_fraccion"]; ?>" size="3" /></td>
        <td bgcolor="#FFE1C4"><input name="lote_manzana" type="text" id="lote_manzana" value="<? echo $familia["Lote_manzana"]; ?>" size="3" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_parcela" type="text" id="lote_parcela" value="<? echo $familia["Lote_parcela"]; ?>" size="3" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_subpc" type="text" id="lote_subpc" value="<? echo $familia["Lote_subparcela"]; ?>" size="3" onkeypress="return pulsar(event)"/></td>
        </tr>
      <tr>
        <td height="15" colspan="9" valign="top"></td>
        </tr>
  </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="23%" class="nombrecampo">Partida</td>
            <td width="25%" class="nombrecampo">Fecha Escritura</td>
            <td width="24%" class="nombrecampo">N&ordm; escritura</td>
            <td width="28%" class="nombrecampo">Fecha Inscripción</td>
          </tr>
          <tr>
            <td><input name="partida" type="text" id="partida" onkeypress="return pulsar(event)" value="<?=$familia["Lote_partida"]; ?>" size="15"/></td>
            <td><input name="escritura_fecha" type="text" id="escritura_fecha" onkeypress="return pulsar(event)" size="15" value="<? echo $fecha_escritura; ?>" /></td>
            <td><input name="escritura_numero" type="text" id="escritura_numero" onkeypress="return pulsar(event)" size="15" value="<? echo $familia["Familia_escritura"]; ?>" /></td>
            <td><input name="escritura_insc_fecha" type="text" id="escritura_insc_fecha" onkeypress="return pulsar(event)" size="15" value="<? echo $fecha_inscripcion; ?>" /></td>
          </tr>
          <tr><td>&nbsp;</td>
            <td><img src="imagen/flecha-sup-01.jpg" width="19" height="15" /></td>
            <td>&nbsp;</td>
            <td><img src="imagen/flecha-sup-01.jpg" width="19" height="15" /></td>
          </tr>
          <tr>
            <td colspan="4" style="nombrecampo""><table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
                <td bgcolor="#FFFF99"><strong>ATENCIÓN:</strong> Los campos de <strong>fecha</strong><strong></strong> se deben consignar en formato <strong>dd/mm/AAAA</strong> para que el sistema los interprete y actualice correctamente.</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="4" style="nombrecampo"">&nbsp;</td>
          </tr>
      </table></td>
  </tr>
</table>
  <table width="600" border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td colspan="2"></td>
    <td width="269"></td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo"><strong>Observaciones</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="left"><textarea name="observaciones" cols="110" rows="4" id="observaciones"><? echo $familia["Familia_observaciones_esc"]; ?></textarea></td>
    </tr>
  <tr>
    <td width="222" align="right">&nbsp;</td>
    <td width="186" colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="1"><input type="hidden" name="idFamilia" value="<? echo $idFamilia; ?>"/></td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Actualizar beneficio" />&nbsp;</td>
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