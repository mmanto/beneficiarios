<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

$idusuario = $_GET["idusuario"];

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$sql = "SELECT * FROM dbo_usuarios WHERE idUsuario = $idusuario";

$res = mysql_query($sql);

$usuario = mysql_fetch_array($res);


?>

<h1>Dar de alta nuevo usuario</h1>
<p><a href="usuarios-listar.php">Volver</a></p>
<p>&nbsp;</p>
<form method="post" action="usuario-alta.php">
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21" height="35">&nbsp;</td>
    <td width="145"><strong>Nombre completo: </strong></td>
    <td colspan="2"><input name="nombre" type="text" id="nombre"></td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td><strong>Nombre usuario: </strong></td>
    <td colspan="2"><input name="usuario" type="text" id="usuario" maxlength="20"> 
      (M&aacute;x: 20 caracteres) </td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td><strong>Contrase&ntilde;a:</strong></td>
    <td colspan="2"><input name="password" type="text" id="password" maxlength="12"> 
      (M&aacute;x. 12 caracteres) </td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td><strong>&Aacute;rea de pertenencia: </strong></td>
    <td colspan="2"><select name ="area" size="1">
		<?
			$sql5 = "SELECT * FROM dbo_area WHERE Direccion_nro != '99' ORDER BY Area_codigo";
		 	$res5 = mysql_query($sql5);		 
		 while ($area = mysql_fetch_array($res5)) { ?>
              <option value="<?=$area["Area_nro"]; ?>" <? 
			  if($area["Area_nro"]=='90') { ?> selected <? }?>><?=$area["Area_codigo"]; ?> - <?=$area["Area_nombre"]; ?></option>
		<? } ?>
    </select></td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="176">&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td colspan="2" align="center"><h2><u>Jerarqu&iacute;a del usuario</u></h2></td>
    <td width="176" rowspan="6" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td colspan="2">La jerarqu&iacute;a refiere al conjunto de permisos que dispone el usuario en su interacci&oacute;n con el sistema, contando con cinco niveles disponibles para cada m&oacute;dulo. <strong>El valor 0 (cero) indica la inhabilitaci&oacute;n de uso para el m&oacute;dulo correspondiente. </strong></td>
  </tr>
  <tr>
    <td height="20" colspan="3" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" colspan="3" align="right"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="166" height="36" style="font-size: 14px"><strong>M&oacute;dulo Expedientes: </strong></td>
        <td width="334" ><select name="HabExp" style="font-size: 13px">
      <option value="0" <? if($usuario["HabExp"] == '0') { ?>selected <? } ?>>Sin acceso al sistema</option>
	  <option value="8" <? if($usuario["HabExp"] == '8') { ?>selected <? } ?>>Sólo consulta</option>
      <option value="7" <? if($usuario["HabExp"] == '7') { ?>selected <? } ?>>Pase de expedientes</option>
      <option value="6" <? if($usuario["HabExp"] == '6') { ?>selected <? } ?>>Pase y alta de exptes.</option>
      <option value="5" <? if($usuario["HabExp"] == '5') { ?>selected <? } ?>>Pase, alta y reingreso</option>
      <option value="4" <? if($usuario["HabExp"] == '4') { ?>selected <? } ?>>Pase, alta, reingreso y modif.</option>
    </select></td>
      </tr>
      <tr>
        <td height="36" valign="bottom" style="font-size: 14px"><strong>M&oacute;dulo Beneficiarios: </strong></td>
        <td valign="bottom"><select name="HabSbt" style="font-size: 13px">
      <option value="0" <? if($usuario["HabSbt"] == '0') { ?>selected <? } ?>>Sin acceso al sistema</option>
	  <option value="8" <? if($usuario["HabSbt"] == '8') { ?>selected <? } ?>>Sólo consulta de beneficios</option>
      <option value="7" <? if($usuario["HabSbt"] == '7') { ?>selected <? } ?>>Alta de beneficios</option>
      <option value="6" <? if($usuario["HabSbt"] == '6') { ?>selected <? } ?>>Alta y modificación de beneficios</option>
      <option value="5" <? if($usuario["HabSbt"] == '5') { ?>selected <? } ?>>Modificación de barrios</option>
      <option value="4" <? if($usuario["HabSbt"] == '4') { ?>selected <? } ?>>Anteriores + pedidos tarjetas</option>
    </select></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="358">&nbsp;</td>
  </tr>
  
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">
	<input type="hidden" name="idusuario" value="<?=$idusuario; ?>" />
	<input type="submit" name="Submit" value="Actualizar datos" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table></form>

<? include ("pie.php"); ?>
<? } ?>