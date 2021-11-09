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

$expte_nro = $_GET["expte"];

$sql3 = mysql_query("SELECT * FROM dbo_expte_esc WHERE Expte_nro = $expte_nro",$link);

$expte = mysql_fetch_array($sql3);

$exptenum = $expte["Expte_num"];
$expte_caract = $expte["Expte_caract"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);

?>

<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo beneficio (Expte. <? echo $expte_caract; ?>-<? echo $exptenum; ?>/<? echo $expte_anio_res; ?>)</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="javascript:history.go(-1)">Volver al listado </a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>
<form action="beneficio_expte_alta.php" method="post" enctype="multipart/form-data" name="f" id="f">

<input type="hidden" name="expte_nro" value="<? echo $expte_nro; ?>" onkeypress="return pulsar(event)"/>
<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="160" height="22" valign="bottom">&nbsp;</td>
        <td width="48" valign="bottom">Circ.</td>
        <td width="48" valign="bottom">Secc.</td>
        <td width="48" valign="bottom">Ch.</td>
        <td width="48" valign="bottom">Qta.</td>
        <td width="48" valign="bottom">Fracc.</td>
        <td width="48" valign="bottom">Mz.</td>
        <td width="48" valign="bottom">Pc.</td>
        <td width="61" valign="bottom">Subpc.</td>
        <td width="43" valign="bottom">.</td>
      </tr>
      <tr>
        <td height="25" valign="top"><strong>Nomenclatura catastral:</strong> </td>
        <td><input name="lote_circ" type="text" id="lote_circ" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_secc" type="text" id="lote_secc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_ch" type="text" id="lote_ch" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_qta" type="text" id="lote_qta" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_fracc" type="text" id="lote_fracc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_manzana" type="text" id="lote_manzana" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_parcela" type="text" id="lote_parcela" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_subpc" type="text" id="lote_subpc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="10" colspan="10" valign="top">&nbsp;</td>
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
        <td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
        <td width="127" valign="bottom" class="nombrecampo">Tipo Doc. </td>
        <td width="113" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
      </tr>
      <tr>
        <td><input name="t1_apellido" type="text" id="t1_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t1_nombre" type="text" id="t1_nombre" size="25" onkeypress="return pulsar(event)"/></td>
        <td><select name="t1_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t1_doc_nro" type="text" id="t1_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>&nbsp;</td>
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
        <td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
        <td width="127" valign="bottom" class="nombrecampo">Tipo Doc. </td>
        <td width="113" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
      </tr>
      <tr>
        <td><input name="t2_apellido" type="text" id="t2_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t2_nombre" type="text" id="t2_nombre" size="25" onkeypress="return pulsar(event)"/></td>
        <td><select name="t2_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t2_doc_nro" type="text" id="t2_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>&nbsp;</td>
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
        <td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
        <td width="127" valign="bottom" class="nombrecampo">Tipo Doc. </td>
        <td width="113" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
      </tr>
      <tr>
        <td><input name="t3_apellido" type="text" id="t3_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t3_nombre" type="text" id="t3_nombre" size="25" onkeypress="return pulsar(event)"/></td>
        <td><select name="t3_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t3_doc_nro" type="text" id="t3_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>
        &nbsp;</td>
      </tr>
    </table>
			</td>
          </tr>
        </table></td>
  </tr>
</table>
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"></td>
    <td width="112"></td>
  </tr>
  <tr>
    <td colspan="3" align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="276" align="right">Resoluci&oacute;n</td>
    <td width="139" align="right"><input name="resolucion" type="text" id="resolucion" size="20" onkeypress="return pulsar(event)"/>&nbsp;</td>
    <td width="64" align="right">&nbsp;</td>
    <td width="9">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar beneficio" />&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>