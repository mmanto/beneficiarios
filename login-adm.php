<?
include("cabecera.php");

if (!isset($_POST["cmdLogin"])) {
 
?>
<form action="login-adm.php" method="POST">
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><h2>ACCESO ADMINISTRADOR </h2></td>
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

 }else{
//session_start();

if (!$_POST["Usuario"] || !$_POST["Password"]) {

echo "<h2>Debe completar los datos de acceso</h2><p><a href=\"login-adm.php\">Volver</a>"; 

}else{
session_start();
include("conec.php");

$username = $_POST["Usuario"];

$password = $_POST["Password"];

$query = mysql_query("SELECT * FROM dbo_usuarios WHERE Usuario = '$username' AND Password = '$password' AND Usuario_nivel < '3'"); 

$cant = mysql_num_rows($query);

if($cant != 1) { ?>

<h2>La contrase&ntilde;a ingresada es incorrecta o Ud. no cuenta con permiso de administrador</h2>
<p><a href="login-adm.php">Volver</a>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<? include("pie.php");

}else{
$row = mysql_fetch_array($query);
$_SESSION["user_id"] = $row['idUsuario'];
header ("Location: menu.php");

}
}
}
?>