<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

?>
<form action="tramite_buscar_nmb.php" method="GET">
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h2>B&uacute;squeda de Beneficio por Apellido  </h2></td>
    <td width="31" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="16" colspan="3"><a href="sbt-menu.php">Volver al panel de administraci&oacute;n </a></td>
  </tr>
  <tr>
    <td width="32" rowspan="5">&nbsp;</td>
    <td width="135" height="35">&nbsp;</td>
    <td width="402">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><strong>Ingrese apellido: </strong></td>
    <td height="30" valign="top"><input name="apellfind" type="text" id="apellfind" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="cmdLogin" type="submit" id="cmdLogin" value="Buscar"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<?       
include "pie.php";
?>
<? } ?>
