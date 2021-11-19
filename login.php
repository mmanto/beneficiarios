<?php
include("conec.php");

$sql = mysql_query("SELECT * FROM dbo_settings WHERE idSetting = 4");
$set = mysql_fetch_array($sql);

if($set["Valor"] != '1') {

///// Pagina mantenimieno ////////////////
include("cabecera.php");

?>

<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="360" align="center"><h1><img src="imagen/settings.png" width="110" height="110"></h1>
      <h1>Estamos realizando tareas de mantenimiento.</h1>  
      <h2>En breve el sistema estar&aacute; nuevamente<br>disponible,
        disculpe las molestias.</h2><p><a href="login-adm.php">[Acceso administrador]</a></p>
    </td>
  </tr>
</table>
<?php include("pie.php"); 

//// Fin pagina mantenimiento ///////////////

}else{

include("cabecera.php");
if (!isset($_POST["cmdLogin"])) {
 
?>
<form action="login2.php" method="POST"> 

<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><h2>Bienvenido al Sistema de Beneficiarios de Tierras! </h2></td>
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
<?php       
include "pie.php";

 }else{
session_start();

if (!$_POST["Usuario"] || !$_POST["Password"]) {

echo "<h2>Debe completar los datos de acceso</h2><p><a href=\"login2.php\">Volver</a>"; 

}else{

include("conec.php");
session_start();
$username = $_POST["Usuario"];

$password = $_POST["Password"];

$query = mysql_query("SELECT * FROM dbo_usuarios WHERE Usuario = '$username' AND Password = '$password'"); 

$cant = mysql_num_rows($query);

if($cant != 1) { echo "<h2>usuario o contrase&ntilde;a incorrectas</h2><p><a href=\"login2.php\">Volver</a>";

}else{
$row = mysql_fetch_array($query);
$_SESSION["user_id"] = $row['idUsuario'];

#header ("Location: menu.php");
include 'menu.php';
}}}}
?>
