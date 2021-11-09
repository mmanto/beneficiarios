<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$idFamilia = $_GET["idFamilia"];


?>
<form action="tarjeta-asignar.php" method="POST">
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h2>Asociar tarjeta al beneficiario</h2></td>
    <td width="31" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="24" colspan="3"><a href="javascript:window.history.back();">Volver</a></td>
  </tr>
  <tr>
    <td width="32" rowspan="8">&nbsp;</td>
    <td width="138" height="35">&nbsp;</td>
    <td width="399">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><strong>N&uacute;mero de tarjeta: </strong></td>
    <td height="30" valign="top">620000149000 <input name="tarjeta" type="text" size="10" maxlength="6" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30"><strong>Apellido Titular:</strong></td>
    <td><input name="titular_apellido" id="titular_apellido" type="text" size="30" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30"><strong>Nombre Titular:</strong></td>
    <td><input name="titular_nombre" id="titular_nombre" type="text" size="30" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="55">&nbsp;</td>
    <td valign="bottom">ATENCIÓN: Cosigne los datos TAL CUAL aparecen en el frente de la tarjeta de pago.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <input type="hidden" name="idFamilia" value="<? echo $idFamilia; ?>" />
    <input name="cmdLogin" type="submit" id="cmdLogin" value="Asignar tarjeta"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td><?=$idFamilia; ?> / &nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<?       
include "pie.php";
?>
<? } ?>
