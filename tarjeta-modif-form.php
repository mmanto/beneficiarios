<? session_start();

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$idTarjeta = $_GET["idTarjeta"];
$idFamilia = $_GET["idFamilia"];

$res = mysql_query("SELECT * FROM dbo_tarjeta WHERE Tarjeta_nro = $idTarjeta");
$tarjeta = mysql_fetch_array($res);

?>
<form action="tarjeta-modif" method="post">
<table width="680" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="36" colspan="4"><h2>Modificar informaci&oacute;n sociada a la tarjeta</h2></td>
  </tr>
  <tr>
    <td height="36" colspan="4"><a href="tarjeta-pagos-historial.php?idTarjeta=<?=$idTarjeta; ?>&idFamilia=<?=$idFamilia; ?>">Volver</a></td>
  </tr>
  <tr>
    <td width="5" height="30">&nbsp;</td>
    <td width="133">Tarjeta n&uacute;mero:</td>
    <td width="203"><strong>
      <?=$tarjeta["Tarjeta_numero"]; ?>
    &nbsp;</strong></td>
    <td width="331" rowspan="6" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="13">
      <tr>
        <td bgcolor="#FFFF99" style="border: 2px solid #FFCC99;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="3"><strong>Atenci&oacute;n:</strong> En todos los casos usar el punto como separador de decimales y <strong>NO </strong>como separador de  miles. Ejemplo: </td>
            </tr>
          <tr>
            <td height="20" align="right" valign="bottom" style="font-size:16px"><strong>13248.36</strong></td>
            <td height="20" align="center" valign="bottom" style="font-size:16px">&nbsp;</td>
            <td height="26" valign="bottom" style="font-size:16px"><strong>&raquo; Correcto</strong></td>
            </tr>
          <tr>
            <td width="48%" height="28" align="right" valign="bottom" style="font-size:16px">13.248,36</td>
            <td width="3%" align="center" valign="bottom" style="font-size:16px">&nbsp;</td>
            <td width="49%" valign="bottom" style="font-size:16px; color:#FF0000;" ><strong>&raquo; Incorrecto</strong></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>Cantidad de cuotas:</td>
    <td><input name="Tarjeta_monto_cuotas" type="text" id="Tarjeta_monto_cuotas" size="7" value="<?=$tarjeta["Tarjeta_monto_cuotas"]; ?>"></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>Intereses aplicados:</td>
    <td>$
    <input name="Tarjeta_monto_intereses" type="text" id="Tarjeta_monto_intereses" size="7" value="<?=$tarjeta["Tarjeta_monto_intereses"]; ?>"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">
      <input type="hidden" name="idTarjeta" value="<?=$idTarjeta; ?>" />
      <input type="hidden" name="idFamilia" value="<?=$idFamilia; ?>" /> 
      <input type="submit" name="button" id="button" value="Actualizar"></td>
    <td width="8">&nbsp;</td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>
<? include("pie.php"); ?>