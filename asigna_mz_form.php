<?
include("cabecera.php");
include ("conec.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<form action="asigna_mz.php" method="post">
<table width="650" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td width="130">ID Barrio</td>
    <td width="492">&nbsp;</td>
  </tr>
  <tr>
    <td><label>
      <input name="Barrio_nro" type="text" id="Barrio_nro" size="3" />
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Mz. Provisoria </td>
    <td>Mz. Definitiva </td>
  </tr>
  <tr>
    <td><input name="Mz_prov" type="text" id="Mz_prov" size="6" /></td>
    <td><input name="Mz_def" type="text" id="Mz_def" size="6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>
      <input type="submit" name="cmdAccion" value="Procesar" />
    </label></td>
  </tr>
</table>
</form>
</body>
</html>