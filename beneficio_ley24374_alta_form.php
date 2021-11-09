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

//Listado partidos
$strSQL2 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido2 = mysql_query ($strSQL2);

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
	  <td height="30"><h2>Dar de alta nuevo registro</h2></td>
  </tr>
	<tr>
	  <td height="30" colspan="2"><a href="sbt-menu.php">Volver al menu </a>	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="beneficio_ley24374_alta.php" method="post" name="f" id="f">
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12%">Partido:</td>
        <td colspan="3"><select name="idPartido" id="idPartido">
      <option value="0">Seleccione un Partido...</option>
      <? while($rsPart = mysql_fetch_array($partido2)) {?>
      <option value="<?=$rsPart["Partido_nro"]; ?>" 
	<? if($rsPart["Partido_nro"] == $expte["Partido_nro"]) { echo "selected=\"selected\""; } ?>>
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
            <td><input name="escribano_registro" type="text" id="escribano_registro" onkeypress="return pulsar(event)" value="0" size="5"/></td>
            <td><input name="escribano_nombre" type="text" id="escribano_nombre" onkeypress="return pulsar(event)" size="45"/></td>
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
            <td width="8%" height="28" valign="middle" bgcolor="#D7E1EA"><input type="radio" name="alta_instancia" id="radio" value="1" /></td>
            <td width="42%" valign="middle" bgcolor="#D7E1EA">Regularización</td>
            <td width="8%" valign="middle" bgcolor="#D7E1EA"><input name="alta_instancia" type="radio" id="radio2" value="2" checked="checked" /></td>
            <td width="42%" valign="middle" bgcolor="#D7E1EA">Consolidación</td>
          </tr>
        </table></td>
        <td height="24"><input name="expte_ley_reg_num" type="text" id="expte_ley_reg_num" onkeypress="return pulsar(event)" value="0" size="20"/></td>
        <td height="24"><input name="expte_ley_cons_num" type="text" id="expte_ley_cons_num" onkeypress="return pulsar(event)" value="0" size="20"/></td>
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
        <td bgcolor="#FFE1C4"><input name="lote_circ" type="text" id="lote_circ" onkeypress="return pulsar(event)" value="0"  size="3"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_secc" type="text" id="lote_secc" onkeypress="return pulsar(event)" value="0"  size="3" /></td>
        <td bgcolor="#FFE1C4"><input name="lote_ch" type="text" id="lote_ch" onkeypress="return pulsar(event)" value="0"  size="3" /></td>
        <td bgcolor="#FFE1C4"><input name="lote_qta" type="text" id="lote_qta" onkeypress="return pulsar(event)" value="0"  size="3" /></td>
        <td bgcolor="#FFE1C4"><input name="lote_fracc" type="text" id="lote_fracc" onkeypress="return pulsar(event)" value="0" size="3" /></td>
        <td bgcolor="#FFE1C4"><input name="lote_manzana" type="text" id="lote_manzana" value="0" size="3" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_parcela" type="text" id="lote_parcela" value="0" size="3" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_subpc" type="text" id="lote_subpc" value="0" size="3" onkeypress="return pulsar(event)"/></td>
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
            <td><input name="partida" type="text" id="partida" onkeypress="return pulsar(event)" value="0" size="15"/></td>
            <td><input name="escritura_fecha" type="text" id="escritura_fecha" onkeypress="return pulsar(event)" size="15"/></td>
            <td><input name="escritura_numero" type="text" id="escritura_numero" onkeypress="return pulsar(event)" size="15"/></td>
            <td><input name="escritura_insc_fecha" type="text" id="escritura_insc_fecha" onkeypress="return pulsar(event)" size="15"/></td>
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
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 1</strong> </td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
	  <tr>
        <td height="12" colspan="4" valign="bottom" class="nombrecampo"></td>
        </tr>
        <td width="123" valign="bottom" class="nombrecampo">Tipo Doc. </td>
		<td width="117" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
		<td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
      </tr>
      <tr>
	  <td><select name="t1_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1" selected="selected">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t1_doc_nro" type="text" id="t1_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>&nbsp;</td>
        <td><input name="t1_apellido" type="text" id="t1_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t1_nombre" type="text" id="t1_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="600" height="12"></td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
        </table>
      </td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 2 </strong> </td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="12" colspan="4" valign="bottom" class="nombrecampo"></td>
        </tr>
      <tr>
        <td width="123" valign="bottom" class="nombrecampo">Tipo Doc. </td>
		<td width="117" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
		<td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
      </tr>
      <tr>
	  <td><select name="t2_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1" selected="selected">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t2_doc_nro" type="text" id="t2_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>
        &nbsp;</td>
        <td><input name="t2_apellido" type="text" id="t2_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t2_nombre" type="text" id="t2_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
      </table>
      </td>
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
    <td colspan="3" align="left"><textarea name="observaciones" cols="110" rows="4" id="observaciones">Sin observaciones</textarea></td>
    </tr>
  <tr>
    <td width="222" align="right">&nbsp;</td>
    <td width="186" colspan="-1">&nbsp;</td>
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