<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$idFamilia = $_GET["idFamilia"];

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];

$idTarjeta = $_GET["idTarjeta"];

$res = mysql_query("SELECT * FROM dbo_tarjeta WHERE Tarjeta_nro = $idTarjeta");
$tarjeta = mysql_fetch_array($res);

$res2 = mysql_query("SELECT * FROM dbo_tarjeta_rendicion WHERE Tarjeta_nro = $idTarjeta AND blnActivo = '1' ORDER BY Pago_fecha ASC");

$sql4 = "SELECT * FROM dbo_tarjeta WHERE Tarjeta_nro = $idTarjeta AND blnActivo = '1'";
$res4 = mysql_query($sql4);
$tarjeta = mysql_fetch_array($res4); 

$res3 = mysql_query("SELECT * FROM dbo_familia WHERE Familia_nro = $idFamilia");

$familia = mysql_fetch_array($res3);



if($familia["Familia_monto_actualizacion"] == '0') { $total_a_pagar = $familia["Familia_montoadj"] + $tarjeta["Tarjeta_monto_intereses"]; }else{ $total_a_pagar = $familia["Familia_monto_actualizacion"] + $tarjeta["Tarjeta_monto_intereses"]; }

?>




<h2>Rendici&oacute;n de pagos - <?=$user["p774"]; ?></h2>
<p> <a href="beneficio_informe.php?idFamilia=<?=$idFamilia; ?>">Volver</a></p>
<table width="750" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td height="30" align="left" bgcolor="#D8F0C6">&nbsp;</td>
    <td height="30" colspan="3" align="left" bgcolor="#D8F0C6"><strong>Tarjeta n&uacute;mero:</strong>
    <?=$tarjeta["Tarjeta_numero"]; ?></td>
    <td width="83">&nbsp;</td>
    <td width="136">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" valign="top"style="font-size:14px">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" align="center" bgcolor="#E9E9E9">&nbsp;</td>
    <td height="30" colspan="9" align="left" bgcolor="#E9E9E9"><strong>Historial de pagos</strong> (Seg&uacute;n rendici&oacute;n del Banco de la Provincia de Buenos Aires/Verificación presencial)</td>
  </tr>
  <tr>
  	<td height="10" colspan="10"></td>
  </tr>
  <tr>
    <td width="1" align="center">&nbsp;</td>
    <td width="100" height="30" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Fecha de pago</strong></td>
    <td width="81" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Sucursal</strong></td>
    <td width="60" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Terminal</strong></td>
    <td align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Transacci&oacute;n</strong></td>
    <td align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Registro rendici&oacute;n</strong></td>
    <td width="138" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Monto</strong></td>
    <td colspan="2" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Tipo rendición</strong></td>
    <td width="14" align="center">&nbsp;</td>
  </tr>
  <tr>
  	<td colspan="10" height="5px"></td>
  </tr> 
  
<? 
$pago_total = '0';
while($pago = mysql_fetch_array($res2)) { ?>  
  <tr <? if($pago["Rendicion_tipo"] == '2') { ?>style="color:#36F"<? } ?>>
    <td align="center" height="22">&nbsp;</td>
    <td align="center"><? echo cambiaf_a_normal($pago["Pago_fecha"]); ?></td>
    <td align="center"><? echo $pago["Pago_sucursal"]; ?></td>
    <td align="center"><? echo $pago["Pago_terminal"]; ?></td>
    <td align="center"><? echo $pago["Pago_transaccion"]; ?></td>
    <td align="center"><? echo $pago["Archivo"]; ?></td>
    <td align="center">$ <? echo $pago["Pago_monto"]; ?></td>
    <td width="57" align="center"><? if($pago["Rendicion_tipo"] == '1') {echo "Electr&oacute;nica";}else{ echo "Manual ";} ?>
    </td>
    <td width="20" align="center"><? if($pago["Rendicion_tipo"] != '1' && $user["p774"] == '1') { ?> <a href="pago-borrar-confirm.php?idPago=<?=$pago["Pago_nro"]; ?>&idTarjeta=<?=$idTarjeta; ?>&idFamilia=<?=$idFamilia; ?>"><img src="imagen/drop.png" width="16" height="16" Tile="Eliminar pago"/></a>    <? } ?>  
    </td>    
    <td align="center">&nbsp;</td>
  </tr>
 <?
 $pago_total = $pago_total+$pago["Pago_monto"]; 
  } ?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="4" align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td colspan="4" align="center" valign="middle" bgcolor="#DDE8F0"><? if ($user["p772"]=='1') { ?> <a href="rendicion_alta_manual_form.php?idTarjeta=<? echo $idTarjeta; ?>&idFamilia=<? echo $idFamilia; ?>">[Agregar nueva rendici&oacute;n manual]</a><? } ?></td>
  </tr>
  <tr>
    <td height="22">&nbsp;</td>
    <td colspan="5">Monto original: $ <?=$familia["Familia_montoadj"]; ?></td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="22">&nbsp;</td>
    <td colspan="4">Monto actualizado: $ <?=$familia["Familia_monto_actualizacion"]; ?></td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="22">&nbsp;</td>
    <td colspan="4">Intereses aplicados: $ <?=$tarjeta["Tarjeta_monto_intereses"]; ?>  <? if($user["p733"]) { ?><a href="tarjeta-modif-form.php?idTarjeta=<?=$tarjeta["Tarjeta_nro"]; ?>&idFamilia=<?=$idFamilia; ?>"><img src="imagen/edit.png" width="16" height="16" /></a><? } ?></td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="22">&nbsp;</td>
    <td colspan="4">Monto total a pagar: $ <?=$total_a_pagar; ?></td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="22">&nbsp;</td>
    <td colspan="4"><strong>Pagado a la fecha: $ <? echo $pago_total; ?></strong>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" bgcolor="#FFFF99">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFF99">Saldo a pagar: $ <? echo $total_a_pagar-$pago_total; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="50">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>

<? include("pie.php");

}
?>