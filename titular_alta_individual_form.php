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

$idFamilia = $_GET["idFamilia"];

?>

<style type="text/css">
<!--
.Estilo2 {font-size: 18px}
-->
</style>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo titular </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="javascript:history.back()">Cancelar </a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="titular_alta_individual.php" method="post" enctype="multipart/form-data" name="f" id="f">
<input type="hidden" name="idFamilia" value="<? echo $idFamilia; ?>" onkeypress="return pulsar(event)"/>
<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL NUEVO TITULAR</strong></td>
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
          <tr>
            <td width="122" height="16" valign="bottom" class="nombrecampo">Lugar de nacimiento </td>
            <td width="87" valign="bottom" class="nombrecampo">Fecha nacim. </td>
            <td width="115" valign="bottom">Nacionalidad</td>
            <td width="133" valign="bottom">Estado Civil </td>
            <td width="12" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td height="16" valign="bottom" class="nombrecampo"><input name="t1_lugar_nac" type="text" id="t1_lugar_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="15"/></td>
            <td valign="bottom" class="nombrecampo"><input name="t1_fecha_nac" type="text" id="t1_fecha_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="dd/mm/aaaa" size="10"/></td>
            <td valign="bottom"><input name="t1_nacionalidad" type="text" id="t1_nacionalidad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="12"/></td>
            <td valign="bottom"><select name="t1_ecivil" size="1" id="t1_ecivil">
                <option value="10" selected="selected">Sin Indicar</option>
				<option value="1">Soltero/a</option>
                <option value="2">Concubino/a</option>
                <option value="3">Casado/a</option>
                <option value="4">Divorciado/a</option>
				<option value="6">Unión de hecho</option>
				<option value="7">Emancipado</option>
				<option value="8">Viudo/a</option>
				<option value="9">Otro</option>
              </select></td>
            <td valign="bottom">&nbsp;</td>
            <td width="39" align="center" valign="middle" bgcolor="#FAE8CF"><input name="t1_sep_hecho" type="checkbox" id="t1_sep_hecho" value="1" /></td>
            <td width="92" height="26" valign="middle" bgcolor="#FAE8CF">Sep. Hecho</td>
          </tr>
          <tr>
            <td height="10" colspan="5"></td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="22" valign="bottom" class="nombrecampo">Apellidos del c&oacute;nyuge </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s del c&oacute;nyuge </td>
            <td width="122" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t1_conyuge_apellido" type="text" id="t1_conyuge_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_conyuge_nombre" type="text" id="t1_conyuge_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" height="8px"></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="18" valign="bottom" class="nombrecampo">Nombre y apellido del padre </td>
            <td width="126" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="260" rowspan="2" valign="bottom" class="nombrecampo"><table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td width="5%" height="22" bgcolor="#FFFFC4">&nbsp;</td>
                <td width="90%" valign="bottom" bgcolor="#FFFFC4">Tel&eacute;fono</td>
                <td width="5%">&nbsp;</td>
                </tr>
              <tr>
                <td height="26" bgcolor="#FFFFC4">&nbsp;</td>
                <td valign="top" bgcolor="#FFFFC4"><input name="t1_telefono" type="text" id="t1_telefono" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="28"/></td>
                <td>&nbsp;</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="2"><input name="t1_padre_nmbcompleto" type="text" id="t1_padre_nmbcompleto" size="50" onkeypress="return pulsar(event)"/></td>
          </tr>
          <tr>
            <td colspan="3" height="8"></td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="18" valign="bottom" class="nombrecampo">Nombre y apellido de la madre</td>
            <td width="264" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="122" valign="bottom" class="nombrecampo">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><input name="t1_madre_nmbcompleto" type="text" id="t1_madre_nmbcompleto" size="50" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" height="8px"></td>
          </tr>
        </table>
      </td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="260"></td>
  </tr>
  <tr>
    <td width="232" align="left">&nbsp;</td>
    <td width="185" colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar titular" />&nbsp;</td>
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