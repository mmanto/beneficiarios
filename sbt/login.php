<?

//Aquí conexión a base de datos

$link=mysql_connect("localhost","root","pepe") or die ("Error en la conexion");
mysql_select_db("mytierras",$link);

include("cabecera.php");
?>

<form action="control.php" method="POST">
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><h2>Bienvenido al Sistema de Beneficiarios de Tierras </h2></td>
    <td width="33">&nbsp;</td>
  </tr>
  <tr>
    <td width="122" rowspan="4" align="center"><img src="imagen/ic_login.gif" width="70" height="70" /></td>
    <td width="68">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="220" rowspan="4">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><strong>Usuario:</strong></td>
    <td width="157" height="30" valign="top"><input name="Usuario" type="text" id="Usuario" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Password:</strong></td>
    <td><input name="Password" type="password" id="Password" /></td>
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
    <td colspan="2"><input name="cmdLogin" type="submit" id="cmdLogin" value="Ingresar"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<?       
include "pie.php";
?>
