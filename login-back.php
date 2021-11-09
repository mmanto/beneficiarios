<?
//Aquí conexión a base de datos

$link=mysql_connect("localhost","root","pepe") or die ("Error en la conexion");
mysql_select_db("mytierras",$link);

if ($_POST[cmdLogin]) {

$usuario = $_POST["Usuario"];
$password = $_POST["Password"];

$strSQL = "SELECT * FROM dbo_usuarios where Usuario='$usuario' and Password='$password'";
$res = mysql_query ($strSQL); 
	if (mysql_num_rows($res)>0) {
	$row = mysql_fetch_array($res);
	$_SESSION[registrado]=$row[id_Usuario];

	} else { echo "<h3><font color='red'>Usuario o contrase&ntilde;a incorrectos. Int&eacute;ntelo nuevamente.</font></h3>";
	
	}
}

if (!$_SESSION[registrado]) {

header ("Location: menu.php");
	
} else {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Beneficiarios de Tierras</title>
<style type="text/css">
<!--
body {
	margin-left: 100px;
	margin-top: 25px;
}
-->
</style>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo2 {	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 18px;
	color: #666666;
}
-->
</style>
</head>

<body>
<form action="<? $_SERVER['PHP_SELF'] ?>" method="POST">
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="178"><img src="imagen/logosub01.gif" width="115" height="55" /></td>
    <td width="257">&nbsp;</td>
    <td width="285" align="right"><img src="imagen/logomivsp01.gif" width="253" height="50" /></td>
  </tr>
  <tr>
    <td height="25" colspan="3"><img src="imagen/g1.jpg" width="600" height="1" /></td>
  </tr>
</table>
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15" colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><span class="Estilo2">Bienvenido al Sistema de Beneficiarios de Tierras </span></td>
    <td width="31">&nbsp;</td>
  </tr>
  <tr>
    <td width="32" height="36">&nbsp;</td>
    <td width="70">&nbsp;</td>
    <td width="467">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top"><strong>Usuario:</strong></td>
    <td height="30" valign="top"><input name="Usuario" type="text" id="Usuario" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>Password:</strong></td>
    <td><input name="Password" type="password" id="Password" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="cmdLogin" type="submit" id="cmdLogin" value="Ingresar"></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>

<? } ?>