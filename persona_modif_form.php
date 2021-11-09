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

$idPersona = $_GET["idPersona"];

$origen = $_GET["origen"];

$sql2 = mysql_query("SELECT * FROM dbo_persona WHERE Persona_nro = $idPersona",$link);

$b1 = mysql_fetch_array($sql2);

$b1_numero = $idPersona;
$b1_familia = $b1["Familia_nro"];
$b1_apellido = $b1["Persona_apellido"];
$b1_nombre = $b1["Persona_nombre"];
$b1_nombre_completo = $b1["Persona_nombre_completo"];
$b1_doc_tipo = $b1["Documento_tipo_nro"];
$b1_doc_nro = $b1["Persona_dni_nro"];

//
$b1_ecivil = $b1["Estado_civil_nro"];
$b1_sep_hecho = $b1["Ecivil_sep_hecho"];
$b1_nacionalidad = $b1["Persona_nacionalidad"];
$b1_lugar_nac = $b1["Persona_lugar_nac"];
$b1_fecha_nac = $b1["Persona_fecha_nac"];
$b1_telefono = $b1["Persona_telefono"];


$b1_conyuge_apellido = $b1["Persona_conyuge_apellido"];
$b1_conyuge_nombre = $b1["Persona_conyuge_nombre"];

$b1_padre_nmbcompleto = $b1["Persona_padre_nombrecompleto"];

$b1_madre_nmbcompleto = $b1["Persona_madre_nombrecompleto"];
$b1_baja = $b1["Persona_baja"];

$adjudicacion_pendiente = $b1["Adjudicacion_pendiente"];

$baja_resolucion = $b1["Persona_baja_resolucion"];
$baja_res_alta = $b1["Persona_baja_res_alta"];
$baja_observaciones = $b1["Persona_baja_obs"];

$idFamilia = $b1["Familia_nro"];

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
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Modificar informaci&oacute;n de la persona </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="javascript:history.back()">Volver </a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="persona_modif.php" method="post" enctype="multipart/form-data" name="f" id="f">
<input type="hidden" name="Persona_nro" id="Persona_nro" value="<?=$idPersona; ?>" />
<input type="hidden" name="Familia_nro" id="Familia_nro" value="<?=$idFamilia; ?>" />
<input type="hidden" name="origen" id="origen" value="<?=$origen; ?>" />
<table width="600" border="0" cellspacing="0" cellpadding="0">
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
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
              <option value="1" <? if ($b1_doc_tipo == '1') { echo "selected=\"selected\""; } ?>>DNI</option>
              <option value="2" <? if ($b1_doc_tipo == '2') { echo "selected=\"selected\""; } ?>>LE</option>
              <option value="3" <? if ($b1_doc_tipo == '3') { echo "selected=\"selected\""; } ?>>LC</option>
              <option value="4" <? if ($b1_doc_tipo == '4') { echo "selected=\"selected\""; } ?>>CI</option>
              <option value="5" <? if ($b1_doc_tipo == '5') { echo "selected=\"selected\""; } ?>>CF</option>
              <option value="6" <? if ($b1_doc_tipo == '6') { echo "selected=\"selected\""; } ?>>Ext.</option>
            </select></td>
        <td><input name="t1_doc_nro" type="text" id="t1_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8" value="<?=$b1_doc_nro; ?>"/>&nbsp;</td>
        <td><input name="t1_apellido" type="text" id="t1_apellido" size="20" onkeypress="return pulsar(event)" value="<?=$b1_apellido; ?>"/></td>
        <td><input name="t1_nombre" type="text" id="t1_nombre" size="30" onkeypress="return pulsar(event)" value="<?=$b1_nombre; ?>"/></td>
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
            <td width="127" height="16" valign="bottom" class="nombrecampo">Lugar de nacimiento </td>
            <td width="91" valign="bottom" class="nombrecampo">Fecha nac. </td>
            <td width="148" valign="bottom">Nacionalidad</td>
            <td width="119" valign="bottom">Estado Civil </td>
            <td colspan="2" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td height="16" valign="bottom" class="nombrecampo"><input name="t1_lugar_nac" type="text" id="t1_lugar_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="15" value="<?=$b1_lugar_nac; ?>"/></td>
            <td valign="bottom" class="nombrecampo"><input name="t1_fecha_nac" type="text" id="t1_fecha_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="10" value="<?=$b1_fecha_nac;  ?>"/></td>
            <td valign="bottom"><input name="t1_nacionalidad" type="text" id="t1_nacionalidad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="18" value="<?=$b1_nacionalidad; ?>"/></td>
            <td valign="bottom"><select name="t1_ecivil" size="1" id="t1_ecivil">
                <option value="10" <? if ($b1_ecivil == '10') { echo "selected=\"selected\""; } ?>>Sin Indicar</option>
				<option value="1" <? if ($b1_ecivil == '1') { echo "selected=\"selected\""; } ?>>Soltero/a</option>
                <option value="3" <? if ($b1_ecivil == '3') { echo "selected=\"selected\""; } ?>>Casado/a</option>
                <option value="4" <? if ($b1_ecivil == '4') { echo "selected=\"selected\""; } ?>>Divorciado/a</option>
				<option value="7" <? if ($b1_ecivil == '7') { echo "selected=\"selected\""; } ?>>Emancipado</option>
				<option value="8" <? if ($b1_ecivil == '8') { echo "selected=\"selected\""; } ?>>Viudo/a</option>
				<option value="9" <? if ($b1_ecivil == '9') { echo "selected=\"selected\""; } ?>>Otro</option>
              </select></td>
            <td width="36" align="center" valign="middle" bgcolor="#FAE8CF"><input name="sep_hecho" type="checkbox" id="sep_hecho" value="1" <? if ($b1_sep_hecho == '1') { echo "checked=\"checked\""; } ?> /></td>
            <td width="79" height="26" valign="middle" bgcolor="#FAE8CF">Sep. Hecho</td>
          </tr>
          <tr>
            <td height="10" colspan="6"></td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="22" valign="bottom" class="nombrecampo">Apellidos del c&oacute;nyuge </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s del c&oacute;nyuge </td>
            <td width="122" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t1_conyuge_apellido" type="text" id="t1_conyuge_apellido" size="30" onkeypress="return pulsar(event)" value="<?=$b1_conyuge_apellido ; ?>"/></td>
            <td><input name="t1_conyuge_nombre" type="text" id="t1_conyuge_nombre" size="30" onkeypress="return pulsar(event)" value="<?=$b1_conyuge_nombre ; ?>"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" height="8px"></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="226" height="18" valign="bottom" class="nombrecampo">Nombre y apellidos del padre </td>
            <td width="232" valign="bottom" class="nombrecampo">Nombre y apellidos de la madre </td>
            <td width="12" valign="bottom" bgcolor="#FFF1A4" class="nombrecampo">&nbsp;</td>
            <td width="130" valign="bottom" bgcolor="#FFF1A4" class="nombrecampo">Tel&eacute;fono</td>
          </tr>
          <tr>
            <td><input name="t1_padre_nmbcompleto" type="text" id="t1_padre_nmbcompleto" size="27" onkeypress="return pulsar(event)" value="<? echo $b1_padre_nmbcompleto; ?>"/></td>
            <td><input name="t1_madre_nmbcompleto" type="text" id="t1_madre_nmbcompleto" size="27" onkeypress="return pulsar(event)" value="<? echo $b1_madre_nmbcompleto; ?>"/></td>
            <td bgcolor="#FFF1A4">&nbsp;</td>
            <td bgcolor="#FFF1A4"><span class="nombrecampo">
              <input name="t1_telefono" type="text" id="t1_telefono" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="15" value="<?=$b1_telefono;  ?>"/>
            </span></td>
          </tr>
          <tr>
            <td height="8px"></td>
            <td></td>
            <td bgcolor="#FFF1A4"></td>
            <td bgcolor="#FFF1A4"></td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="600" height="24"></td>
          </tr>
          <tr>
            <td height="11"><table width="600" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="10" colspan="8" align="center" bgcolor="#E4DCDF"></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="right" bgcolor="#E4DCDF">&nbsp;</td>
                <td height="26" align="center" bgcolor="#E4DCDF"><input name="baja_persona" type="checkbox" id="baja_persona" value="1" <? if($b1_baja == '1') { echo "checked=\"checked\""; }?>/></td>
                <td width="191" bgcolor="#E4DCDF">Dar de baja persona</td>
                <td width="33" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="25" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="143" bgcolor="#E4DCDF"> Resoluci&oacute;n de baja: </td>
                <td colspan="2" bgcolor="#E4DCDF"><input name="baja_resolucion" type="text" id="baja_resolucion" value="<?=$baja_resolucion; ?>" size="6" /></td>
                <td width="10">&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="28" align="left" valign="top" bgcolor="#E4DCDF">&nbsp;</td>
                <td colspan="2" align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">Resoluci&oacute;n alta orig.: </td>
                <td colspan="2" align="left" bgcolor="#E4DCDF"><input name="baja_res_alta" type="text" id="baja_res_alta" value="<?=$baja_res_alta; ?>" size="6" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="23" height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td colspan="7" align="left" bgcolor="#E4DCDF">Observaciones sobre la baja </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td height="26" colspan="7" align="left" bgcolor="#E4DCDF"><textarea name="persona_baja_obs" cols="75" id="persona_baja_obs"><?=$baja_observaciones; ?></textarea></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="24" colspan="8" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="24" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td height="24" align="center" bgcolor="#E4DCDF"><input name="baja_persona_nuevoalta" type="checkbox" id="baja_persona_nuevoalta" value="1"/></td>
                <td height="24" colspan="2" bgcolor="#E4DCDF">Copiar datos para nueva alta </td>
                <td height="24" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td height="24" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td height="24" colspan="2" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="12" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td height="12" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td height="12" colspan="5" bgcolor="#E4DCDF"><strong>Atenci&oacute;n:</strong> Si selecciona esta opci&oacute;n se generar&aacute; un nuevo alta de adjudicaci&oacute;n para esta misma persona en este lote. Utilice esta acci&oacute;n responsablemente.</td>
                <td width="54" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td rowspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td height="12" colspan="8" align="center" bgcolor="#E4DCDF">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
      </table>      </td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top"><input name="cmdAccion" type="submit" id="cmdAccion" value="Actualizar" />&nbsp;</td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="top">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>