<?

include ("conec.php");

$log_direccion = $_GET["nbsp567"];
$log_usuario = $_GET["qprst645"];
$log_nivel = $_GET["ghlst251"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema Beneficiarios de Tierras</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="benef_informe.php" method="POST">
<input type="hidden" name="log_usuario" value="$log_usuario" />
<input type="hidden" name="log_direccion" value="$log_direccion" />
<input type="hidden" name="log_nivel" value="$log_nivel" />
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
    <td colspan="3"><h2>B&uacute;squeda de Beneficio por N&ordm; de documento  </h2></td>
    <td width="31" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="35" colspan="3">Volver al panel de administracion </td>
  </tr>
  <tr>
    <td width="32" rowspan="5">&nbsp;</td>
    <td width="187">&nbsp;</td>
    <td width="350">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><strong>Ingrese n&uacute;mero de documento: </strong></td>
    <td height="30" valign="top"><input name="dni_busqueda" type="text" id="dni_busqueda" /></td>
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
