<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];

$idFamilia = $_GET["idFamilia"];

$idTarjeta = $_GET["idTarjeta"];

$res = mysql_query("SELECT * FROM dbo_tarjeta WHERE Tarjeta_nro = $idTarjeta");
$tarjeta = mysql_fetch_array($res);

$res2 = mysql_query("SELECT * FROM dbo_tarjeta_rendicion WHERE Tarjeta_nro = $idTarjeta ORDER BY Pago_fecha ASC");

?>

<h2>Agregar nueva rendición en forma manual</h2>
<p> <a href="javascript:history.back(1)">Volver</a></p>
<form action="rendicion_alta_manual.php" method="post">
<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" align="left" bgcolor="#D8F0C6">&nbsp;</td>
    <td height="30" colspan="2" align="left" bgcolor="#D8F0C6"><strong>Tarjeta:</strong>
    <?=$tarjeta["Tarjeta_numero"]; ?></td>
    <td width="403">&nbsp;</td>
    <td width="85">&nbsp;</td>
  </tr>
  <tr>
    <td width="17" height="30">&nbsp;</td>
    <td width="97">&nbsp;</td>
    <td width="148">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>Fecha de pago</td>
    <td><label for="pago_fecha_dia">
      <input name="pago_fecha_dia" type="text" id="pago_fecha_dia" value="dd" size="2" maxlength="2">
      /
      <input name="pago_fecha_mes" type="text" id="pago_fecha_mes" value="mm" size="2" maxlength="2" />
      / 
      <input name="pago_fecha_anio" type="text" id="pago_fecha_anio" value="aaaa" size="3" maxlength="4" />
    </label></td>
    <td colspan="2">Utilice <strong>DOS</strong> dígitos para día y mes, y <strong>CUATRO</strong> para el año.</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>Sucursal Nº</td>
    <td><input name="pago_sucursal" type="text" id="pago_sucursal" value="0" size="10"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>Terminal Nº</td>
    <td><input name="pago_terminal" type="text" id="pago_terminal" value="0" size="10"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>Transacción</td>
    <td><input name="pago_transacción" type="text" id="pago_transacción" value="0" size="10"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>Monto pago</td>
    <td>$ 
      <input name="pago_monto_entero" type="text" id="pago_monto_entero" size="6" maxlength="6">
      ,
      <input name="pago_monto_decimal" type="text" id="pago_monto_decimal" value="00" size="1" maxlength="2" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="90">&nbsp;</td>
    <td colspan="3">Atención: Esta acción no pude ser revertida ni modificada. Asegúrese haber ingresado correctamente los datos consignados en el ticket antes de cargar el pago.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    <input type="hidden" name="idFamilia" value="<? echo $idFamilia; ?>" />
    <input type="hidden" name="idTarjeta" value="<? echo $idTarjeta; ?>" />
    <input type="submit" name="button" id="button" value="Cargar pago"></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

<? } ?>