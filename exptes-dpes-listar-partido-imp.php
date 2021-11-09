<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

$idPartido = $_GET["idPartido"]; 

$ordenar = $_GET["ordenar"];

if ($ordenar == "envioegg") {

$orden = "Expte_salida DESC";

}elseif($ordenar == "ubicacion") {

$orden = "Expte_ubicacion_area";

}else{

$orden = "Expte_caract ASC, Expte_num ASC, Expte_anio ASC, Expte_alcance ASC";

}

include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$idNivel = $log_nivel;
$usuario_nombre = $user["Nombre"];


$sql3 = mysql_query("SELECT * FROM (
dbo_exptes
INNER JOIN
dbo_area
ON dbo_exptes.Expte_ubicacion_area = dbo_area.Area_nro
) WHERE Expte_esc = '1' AND Partido_nro = '$idPartido' AND blnActivo = '1' ORDER BY $orden",$link);


$sql36 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido",$link); 

$part = mysql_fetch_array($sql36);

$partido_nombre = $part["Partido_nombre"];




$cant = mysql_num_rows($sql3);

?>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Expedientes de escrituraci&oacute;n girados a EGG por Partido </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema Integral de Gesti&oacute;n de la Subsecretar&iacute;a Social de Tierras y Urbanismo </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="javascript:window.history.back();">Volver</a></td>
  </tr>
  <tr>
    <td height="8" colspan="2">&nbsp;</td>
  </tr><tr>
    <td height="25" bgcolor="e6e6e6">&nbsp;</td>
    <td height="25" bgcolor="e6e6e6"><h3>Total expedientes correspondientes al partido: <?=$cant; ?></h3></td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="right">&nbsp;</td>
  </tr><tr>
    <td height="25">&nbsp;</td>
    <td>
	<table width="854" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="179" height="25" align="center" class="titulo_dato">Expediente</td>
		<td width="159" align="center" class="titulo_dato">Partido</td>
		<td width="66" align="center" class="titulo_dato">Benef.</td>
        <td width="193" align="center" class="titulo_dato">Ubicaci&oacute;n seg&uacute;n Sist. expedientes </td>
        <td width="94" align="center" class="titulo_dato">Env&iacute;o a EEG&nbsp;</td>
        <td width="149" align="center" class="titulo_dato">Ultimo mov. </td>
        </tr>
<?

while ($expte = mysql_fetch_array($sql3)) {	

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_barrio = $expte["Barrio_nro"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];
$plano_circ = $expte["Plano_circ"];
$expte_mov = $expte["Expte_ubicacion_detalle"];
$expte_beneficios = $expte["Expte_beneficios"];
$expte_fechamov = cambiaf_a_normal($expte["Expte_ubicacion_detalle_fecha"]);
	if ($expte_fechamov == '00/00/0000') {$expte_fechamov = " "; }
//$expte_envio_egg = cambiaf_a_normal($expte["Expte_envio_egg"]);
$expte_partido = $expte["Partido_nombre"];
$expte_destino = $expte["Expte_salida_destino"];
$expte_ubicacion = $expte["Area_nombre"];
		
if($expte["Expte_salida"] == '0000-00-00') { $expte_envio_egg = "--"; }else{ $expte_envio_egg = cambiaf_a_normal($expte["Expte_salida"]); }

?>
      <tr>
        <td height="30" align="center" ><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> </td>
		<td align="center"><?=$partido_nombre; ?></td>
		<td align="center"><?=$expte_beneficios; ?>&nbsp;</td>
        <td align="center" ><?=$expte_ubicacion; ?>&nbsp;</td>
        <td align="center" ><?=$expte_envio_egg; ?>&nbsp;</td>
        <td align="center" ><?=$expte_mov; ?>&nbsp;</td>
        </tr>
		
	  <? } ?>
    </table>	</td>
  </tr>
  <tr><td colspan="10">&nbsp;</td></tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
</table>
<?  
include "pie.php";
?>
<? } ?>