<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include ("conec.php");
include ("funciones.php");

$idFamilia = $_GET["idFamilia"];
$idTarjeta = $_GET["idTarjeta"];

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];

$res = mysql_query("SELECT * FROM dbo_tarjeta WHERE Tarjeta_nro = $idTarjeta");
$tarjeta = mysql_fetch_array($res);

$res2 = mysql_query("SELECT * FROM dbo_tarjeta_rendicion WHERE Tarjeta_nro = $idTarjeta AND blnActivo = '1' ORDER BY Pago_fecha ASC");

/*
$sql4 = "SELECT * FROM dbo_tarjeta WHERE Tarjeta_nro = $idTarjeta AND blnActivo = '1'";
$res4 = mysql_query($sql4);
$tarjeta = mysql_fetch_array($res4);
*/

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$idDireccion = $user["Direccion_nro"];
$idNivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

$sql = "SELECT * FROM dbo_familia WHERE Familia_nro = $idFamilia";
$resFlia = mysql_query($sql);
$familia = mysql_fetch_array($resFlia);
$lote_circ = $familia["Lote_circunscripcion"];
$lote_secc = $familia["Lote_seccion"];
$lote_ch = $familia["Lote_chacra"];
$lote_qta = $familia["Lote_quinta"];
$lote_fr = $familia["Lote_fraccion"];
$lote_mz = $familia["Lote_manzana"];
$lote_pc = $familia["Lote_parcela"];
$lote_subpc = $familia["Lote_subparcela"];
$altabenef = cambiaf_a_normal($familia["insert_fecha"]);
$modifbenef = cambiaf_a_normal($familia["modif_fecha"]);
$familia_montoadj = $familia["Familia_montoadj"];
$familia_montoact = $familia["Familia_monto_actualizacion"];



//Partido
$partido_nro = $familia["Partido_nro"];

$sqlPdo = "SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $partido_nro";
$resPdo = mysql_query($sqlPdo);
$partido = mysql_fetch_array($resPdo);
$partido_nombre = $partido["Partido_nombre"];


//Barrio
$idBarrio = $familia["Barrio_nro"];
$sqlb = "SELECT
Barrio_nro,
Barrio_nombre,
Partido_nombre
FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) WHERE Barrio_nro = $idBarrio";
$bar = mysql_query($sqlb);
$barrio = mysql_fetch_array($bar);
$barrio_nombre = $barrio["Barrio_nombre"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema de Expedientes</title>
<style type="text/css">
<!--
body {
	margin-left: 30px;
	margin-top: 20px;
}
</style>

<link href="estilos-impresion.css" rel="stylesheet" type="text/css" />
</head>

<body onLoad="window.print()">
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="75" align="right" valign="top"><img src="imagen/logo-ba3.jpg" alt="Buenos Aires" width="800" height="70" /></td>
  </tr>
</table>
<style type="text/css">
<!--
.Estilo2 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 14px}
-->
</style>
<? if ($count == '0') { echo "No"; }else{ ?>
<table width="800" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="80" align="center"><h2>Detalle de estado contable</h2></td>
  </tr>
</table>
  <table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="4%" height="20" align="center" bgcolor="#629D75" style="color:#FFF;"><a href="javascript:history.back(1)" title="Volver">&laquo;</a></td>
        <td width="30%" height="30">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="40" colspan="2"> <strong>Partido:</strong> <? echo $partido_nombre; ?> </td>
		<td colspan="2"><strong>Barrio:</strong> <? echo $barrio_nombre; ?>&nbsp;</td>
		</tr>

      <tr>
        <td height="36" colspan="4" align="left"> <strong>Nomenc. Catastral: Circ</strong>.  <? echo $lote_circ; ?> -  <strong>Secc.</strong> <? echo $lote_secc; ?> - <strong>Ch.</strong> <? echo $lote_ch; ?> - <strong>Qta.</strong>  <? echo $lote_qta; ?>  - <strong>Fracc.</strong>  <? echo $lote_fr; ?>  - <strong>Mz.</strong>  <? echo $lote_mz; ?>  - <strong>Pc.</strong>  <? echo $lote_pc; ?>  - <strong>Subpc.</strong>  <? echo $lote_subpc; ?> </td>
      </tr>
	  <? if($familia["Familia_res_adj"] != '0') { ?>
	  <tr>
        <td height="42" colspan="3" align="left"><strong>Resoluci&oacute;n de adjudicaci&oacute;n:</strong>          <?=$familia["Familia_res_adj"]; ?></td>
        <td width="36%" height="36" align="left">&nbsp;</td>
      </tr>
	  <? } ?>
    </table></td>
  </tr>
</table>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="28" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" <? if($b1_baja =='1' ) { echo "bgcolor=\"#EAE1E4\""; } if($b1_adj_pendiente =='1' ) { echo "bgcolor=\"#D0DCFB\""; }?> ><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="53" height="36" valign="top"><u><strong>INFORMACION CONTABLE</strong></u></td>
        </tr>
          <tr>
            <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td height="30" colspan="4" align="left"><strong>Tarjeta n&uacute;mero:</strong>
      <?=$tarjeta["Tarjeta_numero"]; ?></td>
    <td colspan="4"> Titular s/tarjeta: <?=$tarjeta["Tarjeta_titular_apellido"].", ".$tarjeta["Tarjeta_titular_nombre"]; ?></td>
    </tr>
  <tr>
    <td height="10" colspan="8"></td>
  </tr>
  <tr>
    <td width="106" height="30" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Fecha  pago</strong></td>
    <td width="86" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Sucursal</strong></td>
    <td width="69" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Terminal</strong></td>
    <td width="96" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Transacci&oacute;n</strong></td>
    <td width="165" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Registro rendici&oacute;n</strong></td>
    <td width="99" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Monto</strong></td>
    <td width="125" align="center" valign="bottom" STYLE="border-bottom:2px solid #333;"><strong>Tipo rendición</strong></td>
    <td width="6" align="center">&nbsp;</td>
  </tr>
  <tr>
  	<td colspan="8" height="5px"></td>
  </tr> 
  
<? 
$pago_total = '0';
while($pago = mysql_fetch_array($res2)) { ?>  
  <tr>
    <td height="22" align="center"><? echo cambiaf_a_normal($pago["Pago_fecha"]); ?></td>
    <td align="center"><? echo $pago["Pago_sucursal"]; ?></td>
    <td align="center"><? echo $pago["Pago_terminal"]; ?></td>
    <td align="center"><? echo $pago["Pago_transaccion"]; ?></td>
    <td align="center"><? echo $pago["Archivo"]; ?></td>
    <td align="center">$ <? echo $pago["Pago_monto"]; ?></td>
    <td align="center"><? if($pago["Rendicion_tipo"] == '1') {echo "Electr&oacute;nica";}else{ echo "Manual";} ?></td>
    <td align="center">&nbsp;</td>
  </tr>
 <?
 $pago_total = $pago_total+$pago["Pago_monto"]; 
  } ?>
  <tr>
    <td colspan="5">&nbsp;</td>
    <td colspan="3" align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" colspan="5">Monto original: $ <?=$familia["Familia_montoadj"]; ?></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" colspan="4">Monto actualizado: $ <?=$familia["Familia_monto_actualizacion"]; ?></td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" colspan="4">Intereses por mora: $ <?=$tarjeta["Tarjeta_monto_intereses"]; ?></td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" colspan="4">Monto total a pagar: $ <?
	
	if($familia["Familia_monto_actualizacion"] == '0') { $total_a_pagar = $familia["Familia_montoadj"] + $tarjeta["Tarjeta_monto_intereses"]; }else{ $total_a_pagar = $familia["Familia_monto_actualizacion"] + $tarjeta["Tarjeta_monto_intereses"]; }
	
	 echo $total_a_pagar; ?></td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" colspan="4"><strong>Pagado a la fecha: $ <? echo $pago_total; ?></strong>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" colspan="4">Saldo deudor $ <? echo $total_a_pagar-$pago_total; ?></td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
            </table></td>
          </tr>

        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="3">
          
    </table></td>
  </tr>
<tr><td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="60" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="67%" height="80" rowspan="2" align="right" valign="bottom">&nbsp;</td>
                  <td width="33%" align="right" valign="bottom">&nbsp;</td>
        </tr>
                <tr>
                  <td align="center" valign="top">&nbsp;</td>
                </tr>
              </table>
</td></tr>
</table>
<? } 
}
?>
