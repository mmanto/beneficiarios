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

$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

?>
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo beneficio</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="persona_buscar_doc_form.php">Volver </a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>
<form action="beneficio_alta_simp.php" method="post" enctype="multipart/form-data" name="f" id="f">

<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="32%">Partido</td>
        <td width="68%">&nbsp;</td>
      </tr>
      <tr>
        <td><select name="idPartido" id="idPartido" onChange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select></td>
        <td rowspan="2" bgcolor="#E4E4E4"><table width="100%" border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td colspan="3" valign="bottom"><strong>Direcci&oacute;n de origen del beneficio </strong></td>
        </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><input name="beneficio_origen" type="radio" value="1" /></td>
              <td width="87%" valign="bottom">Dir. Reg.Urb. y Dom.</td>
            </tr>
          </table></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><input name="beneficio_origen" type="radio" value="2" checked="checked" /></td>
              <td width="87%" valign="middle">Plan Familia Prop.</td>
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
        <td>&nbsp;</td>
        </tr>
    </table>
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="22" colspan="9" valign="bottom"><strong>Nomenclatura catastral</strong> </td>
        </tr>
      <tr>
        <td width="53" height="22" valign="bottom">Circ.</td>
        <td width="60" valign="bottom">Secc.</td>
        <td width="67" valign="bottom">Ch.</td>
        <td width="64" valign="bottom">Qta.</td>
        <td width="69" valign="bottom">Fracc.</td>
        <td width="63" valign="bottom">Mz.</td>
        <td width="59" valign="bottom">Pc.</td>
        <td width="74" valign="bottom">Subpc.</td>
        <td width="91" rowspan="2" bgcolor="#E4E4E4"><table width="100%" border="0" cellspacing="0" cellpadding="4">
          <tr>
            <td valign="bottom">Matr&iacute;cula</td>
          </tr>
          <tr>
            <td><input name="lote_matricula" type="text" id="lote_matricula" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="5" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="25" valign="top"><input name="lote_circ" type="text" id="lote_circ" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_secc" type="text" id="lote_secc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_ch" type="text" id="lote_ch" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_qta" type="text" id="lote_qta" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_fracc" type="text" id="lote_fracc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_manzana" type="text" id="lote_manzana" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_parcela" type="text" id="lote_parcela" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_subpc" type="text" id="lote_subpc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        </tr>
      <tr>
        <td height="10" colspan="9" valign="top">&nbsp;</td>
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
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="87" height="16" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="164" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="78" valign="bottom">&nbsp;</td>
            <td width="16" valign="bottom">&nbsp;</td>
            <td width="165" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="90" valign="bottom">&nbsp;</td>
          </tr>
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
        <td><input name="t2_doc_nro" type="text" id="t2_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>&nbsp;</td>
        <td><input name="t2_apellido" type="text" id="t2_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t2_nombre" type="text" id="t2_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 3 </strong> </td>
          </tr>
          <tr>
            <td>
			<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="123" valign="bottom" class="nombrecampo">Tipo Doc. </td>
        <td width="117" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
		<td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
      </tr>
      <tr>
        <td><select name="t3_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1" selected="selected">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t3_doc_nro" type="text" id="t3_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>
        &nbsp;</td>
		<td><input name="t3_apellido" type="text" id="t3_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t3_nombre" type="text" id="t3_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar beneficio" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
			</td>
          </tr>
        </table></td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>