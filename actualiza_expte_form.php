<?
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$origen = $_GET["origen"];
$familia = $_GET["idFamilia"];
?>
<form action="actualiza_expte_form2.php" method="post">
<table width="600" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td colspan="3"><h1>Ingrese un criterio de b&uacute;squeda </h1>
	  <p>Puede indicar sólo uno de los parámetros, o ambos para acotar la b&uacute;squeda. <strong>Si desea quitar el expediente actualmente relacionado, ingrese cualquier n&uacute;mero y seleccione la opci&oacute;n correspondiente en la pr&oacute;xima pantalla</strong>. </p>
	  <p><a href="javascript:history.back()">Volver</a></p>
	  </td>

  </tr>
  <tr>
    <td width="130" style="font-family:Arial, Helvetica, sans-serif; font-size:16px"><u>Caracter&iacute;stica</u></td>
    <td width="151" style="font-family:Arial, Helvetica, sans-serif; font-size:16px"><u>N&uacute;mero</u></td>
    <td width="277" style="font-family:Arial, Helvetica, sans-serif; font-size:16px">&nbsp;</td>
  </tr>
  <tr>
    <td><input name="expte-caract" type="text" style="font-size:24px" size="5"></td>
    <td><input name="expte-num" type="text" style="font-size:24px" size="6"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="85" colspan="2">
	<input type="hidden" name="origen" value="<?=$origen; ?>">
	<input type="hidden" name="idFamilia" value="<?=$familia; ?>">
	<input type="submit" name="Submit" value="Buscar expediente"></td>
    </tr>
</table>
</form>