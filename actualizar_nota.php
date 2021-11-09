<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$nueva_nota = $_POST["nota_num"];


$suma = mysql_query("UPDATE dbo_settings SET valor = '$nueva_nota' WHERE idSetting = 1"); 


?>
<form action="actualizar_nota.php" method="POST">
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h2>Actualizar n&uacute;mero de nota   </h2></td>
    <td width="31" rowspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="65" colspan="3">El n&uacute;mero de nota ha sido correctamente actualizado. </td>
  </tr>
  <tr>
    <td height="16" colspan="3"><a href="menu.php">Volver al panel de administraci&oacute;n </a></td>
  </tr>
  <tr>
    <td width="32" rowspan="5">&nbsp;</td>
    <td width="187" height="35">&nbsp;</td>
    <td width="350">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td height="30" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
