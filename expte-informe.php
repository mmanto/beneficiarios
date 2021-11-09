<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Expediente</title>
<style type="text/css">
<!--
body {
	margin-left: 70px;
	margin-top: 20px;
}
</style>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 52px;
	font-weight: bold;
}
.Estilo2 {
	font-size: 15px;
	font-weight: bold;
}
-->
</style>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo3 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
-->
</style>
</head>
<body>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="75" align="right" valign="top"><img src="imagen/cabecera-800.jpg" alt="Buenos Aires" width="800" height="70" /></td>
  </tr>
</table>

<?

include ("conec.php");
include ("funciones.php");

$exptenro = $_GET["idExpte"];

$sql = "SELECT * FROM (
dbo_exptes
INNER JOIN
dbo_area
ON dbo_exptes.Expte_origen = dbo_area.Area_nro
INNER JOIN
dbo_usuarios
ON dbo_exptes.Expte_alta_usuario = dbo_usuarios.idUsuario
) WHERE Expte_nro = $exptenro";


$res = mysql_query($sql);
$expte = mysql_fetch_array($res);
$expte_ubicacion = $expte["Expte_ubicacion_area"];
if($expte["Expte_fojas_origen"] == '0') {$fojas_origen = "S/I"; }else{ $fojas_origen = $expte["Expte_fojas_origen"]; }

$sql2 = "SELECT * FROM dbo_exptes_mov WHERE Expte_nro = $exptenro AND blnActivo = '1' ORDER BY Expte_mov_nro ASC";
$res2 = mysql_query($sql2);


$sql3 = "SELECT Area_codigo, Area_nombre FROM dbo_area WHERE Area_nro = $expte_ubicacion";
$res3 = mysql_query($sql3);
$dbarea = mysql_fetch_array($res3);
$ubicacion_codigo = $dbarea["Area_codigo"];
$ubicacion_nombre = $dbarea["Area_nombre"];

?>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3">&nbsp;</td>
    <td width="11">&nbsp;</td>
    <td width="366" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="left"><span class="Estilo1">Expte. <?=$expte["Expte_caract"]; ?>-<? if ($expte["Expte_partido"] != 0) {echo $expte["Expte_partido"]."-"; }
	   if ($expte["Expte_rnrd"] != 0) {echo $expte["Expte_rnrd"]."-"; }	
	echo $expte["Expte_num"]; ?>/<?=$expte["Expte_anio"]; ?>
	<? if($expte["Expte_alcance"]!='0') { echo "Alc. ".$expte["Expte_alcance"]; } ?>
	
	</span></td>
  </tr>
  <tr>
    <td height="45" colspan="2"><? if ($_GET["noback"] == '0') {echo "<a href='javascript:window.history.back();'>&laquo; Volver al informe</a>";} ?>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="11" height="25" valign="middle" bgcolor="#E9E9E9">&nbsp;</td>
    <td width="388" height="26" valign="bottom" bgcolor="#E9E9E9"><u>Extracto:</u>&nbsp;</td>
    <td width="24" bgcolor="#E9E9E9">&nbsp;</td>
    <td bgcolor="#E9E9E9">:</td>
    <td bgcolor="#E9E9E9">&nbsp;</td>
  </tr>
  <tr>
    <td height="40" bgcolor="#E9E9E9">&nbsp;</td>
    <td height="40" colspan="4" bgcolor="#E9E9E9"><span class="Estilo2"><?=$expte["Expte_extracto"]; ?>&nbsp;</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="25" valign="middle" bgcolor="#E9E9E9">&nbsp;</td>
    <td bgcolor="#E9E9E9"><u>Iniciado por:</u>&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="middle" bgcolor="#E9E9E9">&nbsp;</td>
    <td valign="middle" bgcolor="#E9E9E9"><u>Usuario y fecha de alta </u>&nbsp;</td>
  </tr>
  <tr>
    <td height="28" bgcolor="#E9E9E9">&nbsp;</td>
    <td height="28" bgcolor="#E9E9E9"><span class="Estilo2"><?=$expte["Area_nombre"]; ?></span>&nbsp;</td>
    <td>&nbsp;</td>
    <td bgcolor="#E9E9E9">&nbsp;</td>
    <td bgcolor="#E9E9E9"><span class="Estilo2"><?=$expte["Nombre"]; ?> (<? echo cambiaf_a_normal($expte["Expte_alta_fecha"]); ?>)</span>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="25" valign="middle" bgcolor="#E9E9E9">&nbsp;</td>
    <td bgcolor="#E9E9E9"><u>Observaciones:</u>&nbsp;</td>
    <td bgcolor="#E9E9E9">&nbsp;</td>
    <td bgcolor="#E9E9E9">&nbsp;</td>
    <td bgcolor="#E9E9E9">&nbsp;</td>
  </tr>
  <tr>
    <td height="28" bgcolor="#E9E9E9"></span>&nbsp;</td>
    <td height="28" colspan="4" bgcolor="#E9E9E9"><span class="Estilo2"><?=$expte["Expte_observaciones"]; ?>&nbsp;</span></td>
  </tr>
  <tr>
    <td height="6" colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="50" colspan="5" align="center"><table width="100%" border="0" cellspacing="2" cellpadding="3">
      <tr>
        <td width="100%">
<?

$res76 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_padre = $exptenro");
$cant76 = mysql_num_rows($res76);

if($cant76 > '0') { ?>

<table width="100%" cellpadding="3" cellspacing="0" bordercolor="#FFCC66">
          <tr>
        <td align="left" bgcolor="#F8E9C9" style="border: 2px solid #F4DEB0">
        <span class="Estilo2">El presente tiene agregados los siguientes expedientes: 
<?
while ($expteAgr = mysql_fetch_array($res76)) {

echo $expteAgr["Expte_caract"];
if($expteAgr["Expte_partido"] != '0') { echo "-".$expteAgr["Expte_partido"]; }
if($expteAgr["Expte_rnrd"] != '0') { echo "-".$expteAgr["Expte_rnrd"]; }
echo "-".$expteAgr["Expte_num"]."/".$expteAgr["Expte_anio"]." Alc. ".$expteAgr["Expte_alcance"]."; "; ?>   
         <? } ?></span></td>
        </tr>
          <tr>
            <td align="left" height="2"></td>
          </tr>
        </table>
<? } ?>

<? if($expte["Expte_padre"] != '0') {
	
$padre = $expte["Expte_padre"];	

$res4 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_nro = $padre");

$exptePadre = mysql_fetch_array($res4); ?>

<table width="100%" cellpadding="3" cellspacing="0" bordercolor="#FFCC66">
          <tr>
        <td align="left" bgcolor="#F8E9C9" style="border: 2px solid #F4DEB0">
        <span class="Estilo2">Atención: El presente  est&aacute; agregado al expediente <? echo $exptePadre["Expte_caract"]."-".$exptePadre["Expte_partido"]."-".$exptePadre["Expte_rnrd"]."-".$exptePadre["Expte_num"]."/".$exptePadre["Expte_anio"]." Alc. ".$exptePadre["Expte_alcance"]; ?>   
        
        </span> </td>
        </tr>
          <tr>
            <td align="left" height="2"></td>
          </tr>
        </table>
<? } ?>
        <table width="100%" cellpadding="7" cellspacing="0" bordercolor="#FFCC66">
          <tr>
        <td align="left" bgcolor="#FFFF99" style="border: 2px solid #FFCC66"><span class="Estilo2">Ubicaci&oacute;n actual del expediente: <? echo $ubicacion_codigo." - ".$ubicacion_nombre; ?> <? if($expte["Expte_ubicacion_direccion"] != '99') { echo "(SSTUV)"; } ?></span> </td>
        </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5" align="center"><table width="100%" border="0" cellspacing="5" cellpadding="4">
      <tr>
        <td height="26" colspan="5" align="center" bgcolor="#95A8A8"><span class="Estilo3">HISTORIAL DE MOVIMIENTOS DEL EXPEDIENTE</span></td>
        </tr>
      <tr>
        <td width="12%" height="20" align="center" bgcolor="#C0D1D0">Fecha</td>
        <td width="12%" align="center" bgcolor="#C0D1D0">Hora</td>
        <td width="6%" align="center" bgcolor="#C0D1D0">Fs.</td>
        <td width="53%" align="center" bgcolor="#C0D1D0">Novedad</td>
        <td width="17%" align="center" bgcolor="#C0D1D0">N&ordm; Remito</td>
      </tr>
	  <tr>
        <td width="12%" align="center" bgcolor="#DEE7E6"><strong><? echo cambiaf_a_normal($expte["Expte_alta_fecha"]); ?></strong></td>
        <td width="12%" align="center" bgcolor="#DEE7E6"><strong><? echo $expte["Expte_alta_hora"]; ?></strong></td>
        <td width="6%" align="center" bgcolor="#DEE7E6"><strong><? echo $fojas_origen; ?></strong>&nbsp;</td>
        <td width="53%" align="center" bgcolor="#DEE7E6"><strong>Alta del expediente en sistema (<?=$expte["Nombre"]; ?>)</strong></td>
        <td width="17%" align="center" bgcolor="#DEE7E6">--</td>
      </tr>
<? 

$num_fila = '1';

while ($exptemov = mysql_fetch_array($res2)) {

$expte_mov_fecha = cambiaf_a_normal($exptemov["Expte_mov_fecha"]);
$expte_mov_hora = $exptemov["Expte_mov_hora"];
$expte_mov_remito = $exptemov["Remito_nro"];
if($exptemov["Expte_fojas"] == '0') {$expte_mov_fojas = "S/I"; }else{ $expte_mov_fojas = $exptemov["Expte_fojas"];}

$origen = $exptemov["Expte_origen"];
$destino = $exptemov["Expte_destino"];

$res5 = mysql_query("SELECT Area_nombre FROM dbo_area WHERE Area_nro = $destino");
$dest = mysql_fetch_array($res5);
$expte_mov_destino = $dest["Area_nombre"];

$res6 = mysql_query("SELECT Area_nombre FROM dbo_area WHERE Area_nro = $origen");
$movorigen = mysql_fetch_array($res6);
$expte_mov_origen = $movorigen["Area_nombre"];


?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DEE7E6\""; }else{ echo "bgcolor=\"#D2DFDE\"";} ?>>
        <td align="center"><?=$expte_mov_fecha; ?>&nbsp;</td>
        <td align="center"><?=$expte_mov_hora; ?>&nbsp;</td>
        <td align="center"><?=$expte_mov_fojas; ?>&nbsp;</td>
        <td align="center">
		<? if ($exptemov["Expte_mov_reingreso"] == '1') {
		echo "<strong>Reingreso desde ".$expte_mov_origen."</strong>";		
		}else{
		?>
		Pase a <?=$expte_mov_destino; ?>
		<? } ?>&nbsp;</td>
        <td align="center"><?=$expte_mov_remito; ?>&nbsp;</td>
      </tr>
<? 

$num_fila++;
} ?>
    <tr>
        <td align="center">&nbsp;</td>
        <td colspan="2" align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
	</table></td>
  </tr>
</table>
<? } ?>