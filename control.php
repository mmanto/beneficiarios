<?
include ("conec.php");

$usuario = $_POST["Usuario"];
$password = $_POST["Password"];

$strSQL = "SELECT * FROM dbo_usuarios where Usuario='$usuario' and Password='$password'";
$res = mysql_query ($strSQL); 
	if (mysql_num_rows($res)>0) {
$SQLuser = mysql_fetch_array($res);
$log_direccion = $SQLuser["Direccion_nro"];
$log_usuario = $SQLuser["idUsuario"];
$log_nivel = $SQLuser["Usuario_nivel"];
	
header ("Location: menu.php?nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel");
	
} else {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
	color: #FF0000;
}
-->
</style>
</head>

<body>
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
    <td width="23"><p class="Estilo2">&nbsp;</p>    </td>
    <td width="546"><span class="Estilo2">Usuario o contrase&ntilde;a incorrectos. <br />
Por favor, intente nuevamente.</span></td>
    <td width="31">&nbsp;</td>
  </tr>
  <tr>
    <td height="36"><a href="login.php"></a></td>
    <td height="36"><a href="login.php">Volver al control de acceso </a></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>