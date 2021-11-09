<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

$idusuario = $_GET["idUsuario"];

$tipo = '2';

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

?>

<h2>Modificar contrase&ntilde;a </h2>
<p>&nbsp;</p>
<form method="post" action="password-modif.php">
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="22" height="35">&nbsp;</td>
    <td width="185"><strong>Indique la nueva contrase&ntilde;a : </strong></td>
    <td><input name="password" type="text" id="password" size="12" maxlength="12"> </td>
    <td>(Longitud m&aacute;xima: 12 caracteres) &nbsp;</td>
  </tr>
  <tr>
    <td height="80">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td width="385" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="108" align="right">&nbsp;</td>
    <td align="left"><input type="hidden" name="idusuario" value="<?=$idusuario; ?>" />
	<input type="submit" name="Submit" value="Actualizar contrase&ntilde;a" />&nbsp;	</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
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