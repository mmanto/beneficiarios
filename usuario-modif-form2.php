<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

$idusuario = $_GET["idusuario"];

$tipo = '2';

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$sql = "SELECT * FROM dbo_usuarios WHERE idUsuario = $idusuario";

$res = mysql_query($sql);

$usuario = mysql_fetch_array($res);


?>
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. --><h2>Modificar datos de usuario</h2>
<p>&nbsp;</p>
<form method="post" action="usuario-modif.php">
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="22" height="35">&nbsp;</td>
    <td width="151"><strong>Nombre completo: </strong></td>
    <td colspan="2"><input name="nombre" type="text" id="nombre" value="<?=$usuario["Nombre"]; ?>"></td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td><strong>Nombre usuario: </strong></td>
    <td colspan="2"><input name="usuario" type="text" id="usuario" value="<?=$usuario["Usuario"]; ?>" maxlength="20"> 
      (M&aacute;x: 20 caracteres) </td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><a href="password-modif-form.php?idUsuario=<?=$idusuario; ?>">Resetear contrase&ntilde;a</a> (si olvid&oacute; o desea modificar la contrase&ntilde;a) </td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td><strong>&Aacute;rea de pertenencia: </strong></td>
    <td colspan="2"><select name ="area" size="1">
			<option value="0" selected="selected">Seleccione un area...</option>
		<?
			$sql5 = "SELECT * FROM dbo_area WHERE Direccion_nro != '99' ORDER BY Area_codigo";
		 	$res5 = mysql_query($sql5);		 
		 while ($area = mysql_fetch_array($res5)) { ?>
              <option value="<?=$area["Area_nro"]; ?>" <? 
			  if($usuario["Area_nro"] == $area["Area_nro"]) { ?> selected <? }?>><?=$area["Area_codigo"]; ?> - <?=$area["Area_nombre"]; ?></option>
		<? } ?>
    </select></td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td colspan="3"><table width="80%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" colspan="11"><h2>Permisos de usuario </h2></td>
      </tr>
      <tr>
        <td height="30" colspan="11"><strong>Sistema de expedientes </strong></td>
        </tr>
      <tr>
        <td width="3%">&nbsp;</td>
        <td width="4%"><input name="601" type="checkbox" id="601" value="checkbox" /></td>
        <td width="13%">Consulta</td>
        <td width="4%"><input name="602" type="checkbox" id="602" value="checkbox" /></td>
        <td width="16%">Alta</td>
        <td width="4%"><input name="603" type="checkbox" id="603" value="checkbox" /></td>
        <td width="16%">Modificaci&oacute;n</td>
        <td width="5%"><input name="604" type="checkbox" id="604" value="checkbox" /></td>
        <td>Baja</td>
        <td><input name="605" type="checkbox" id="605" value="checkbox" /></td>
        <td>Pase</td>
      </tr>
      <tr>
        <td colspan="11">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" colspan="4" bgcolor="#E5E5E5"><strong>Beneficiarios</strong></td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Consulta </td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Alta nuevo </td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox3" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Modificaci&oacute;n</td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox4" value="checkbox" /></td>
        <td width="13%" bgcolor="#E5E5E5">Baja</td>
        <td width="4%" bgcolor="#E5E5E5">&nbsp;</td>
        <td width="18%" bgcolor="#E5E5E5">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
      </tr>
      <tr>
        <td height="30">&nbsp;</td>
        <td height="30" colspan="4"><strong>Personas</strong></td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="checkbox" name="checkbox7" value="checkbox" /></td>
        <td>Consulta</td>
        <td><input type="checkbox" name="checkbox9" value="checkbox" /></td>
        <td>Alta nuevo </td>
        <td><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td>Modificaci&oacute;n</td>
        <td><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td>Baja</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
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
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" colspan="4" bgcolor="#E5E5E5"><strong>Barrios</strong></td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox8" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Consulta</td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Alta nuevo </td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Modificaci&oacute;n</td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Baja</td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Asignaci&oacute;n</td>
      </tr>
      <tr>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
      </tr>
      <tr>
        <td height="30">&nbsp;</td>
        <td height="30" colspan="4"><strong>Tarjeta de recaudaci&oacute;n </strong></td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td>Consulta</td>
        <td><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td colspan="3">Generaci&oacute;n nuevo pedido </td>
        <td><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td colspan="3">Reiteraci&oacute;n pedido </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
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
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" colspan="4" bgcolor="#E5E5E5"><strong>Expediente de regularizaci&oacute;n </strong></td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
        <td height="30" bgcolor="#E5E5E5">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Consulta</td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Alta nuevo </td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Modificaci&oacute;n</td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Baja</td>
        <td bgcolor="#E5E5E5"><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td bgcolor="#E5E5E5">Asignaci&oacute;n</td>
      </tr>
      <tr>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
        <td bgcolor="#E5E5E5">&nbsp;</td>
      </tr>
      <tr>
        <td height="30">&nbsp;</td>
        <td height="30" colspan="4"><strong>Expediente de Escrituraci&oacute;n </strong></td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td>Consulta</td>
        <td><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td>Alta nuevo </td>
        <td><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td>Modificaci&oacute;n</td>
        <td><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td>Baja</td>
        <td><input type="checkbox" name="checkbox2" value="checkbox" /></td>
        <td>Asignaci&oacute;n</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>

    </table></td>
    </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="351" align="right"><input type="hidden" name="idusuario" value="<?=$idusuario; ?>" />
	<input type="submit" name="Submit" value="Actualizar datos" /></td>
    <td width="176" align="center">&nbsp;	</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>

<? include ("pie.php"); ?>
<? } ?>