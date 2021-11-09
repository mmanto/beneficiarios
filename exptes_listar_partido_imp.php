<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{


$ordenar = $_GET["ordenar"];

if ($ordenar == "envioegg") {

$orden = "Expte_envio_egg DESC";

}elseif($ordenar == "destino") {

$orden = "Expte_salida_destino";

}else{

$orden = "Expte_caract ASC, Expte_num ASC, Expte_anio ASC, Expte_alcance ASC, Expte_cuerpo ASC";

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


$idPartido = $_GET["idPartido"];

$sql3 = mysql_query("SELECT * FROM (
dbo_expte_esc
INNER JOIN
dbo_partido
ON dbo_expte_esc.idPartido = dbo_partido.Partido_nro) WHERE idPartido = $idPartido ORDER BY $orden",$link);




$sql36 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido",$link); 

$part = mysql_fetch_array($sql36);

$partido_nombre = $part["Partido_nombre"];




$cant = mysql_num_rows($sql3);

?>

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Expedientes de escrituraci&oacute;n girados a EGG </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema Integral de Gesti&oacute;n de la Subsecretar&iacute;a Social de Tierras y Urbanismo </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="javascript:history.back(1)">Volver</a></td>
  </tr>
  <tr>
    <td height="8" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
<tr>
  <td height="4" colspan="2">&nbsp;</td>
  </tr><tr>
    <td height="25" bgcolor="e6e6e6">&nbsp;</td>
    <td height="25" bgcolor="e6e6e6"><h3>Total expedientes en sistema: <?=$cant; ?></h3></td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="right">&nbsp;</td>
  </tr><tr>
    <td height="25">&nbsp;</td>
    <td><table width="773" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="120" height="25" align="center" class="titulo_dato">Expediente</td>
		<td width="127" align="center" class="titulo_dato">Partido</td>
		<td width="127" align="center" class="titulo_dato">Barrio</td>
        <td width="50" align="center" class="titulo_dato">Benef.</td>
        <td width="88" align="center" class="titulo_dato">Destino</td>
        <td width="88" align="center" class="titulo_dato">Fecha salida </td>
        <td width="82" align="center" class="titulo_dato">Ultimo mov. </td>
        <td width="73" align="center" class="titulo_dato">Fecha ultimo mov. </td>
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
$expte_mov = $expte["Expte_mov"];
$expte_beneficios = $expte["Expte_beneficios"];
$expte_fechamov = cambiaf_a_normal($expte["Expte_fechamov"]);
	if ($expte_fechamov == '00/00/0000') {$expte_fechamov = " "; }
$expte_envio_egg = cambiaf_a_normal($expte["Expte_envio_egg"]);
$expte_partido = $expte["Partido_nombre"];
$expte_destino = $expte["Expte_salida_destino"];


?>
      <tr>
        <td height="30" align="center" ><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> <? if ($expte_cuerpo != '0') {echo "Cpo ".$expte_cuerpo; }else{ echo " "; } ?></td>
		<td align="center"><?=$expte_partido; ?></td>
		<td align="center"><?
		if ($expte_barrio == '0') { echo "<img src=\"imagen/sindef.jpg\">"; }else{ 
		$sql567 = mysql_query("SELECT Barrio_nombre FROM dbo_barrio WHERE Barrio_nro = $expte_barrio");
	$barrio = mysql_fetch_array($sql567);
	$barrio_nombre = $barrio["Barrio_nombre"];		
		echo $barrio_nombre; }?></td>		
        <td align="center"><?=$expte_beneficios; ?>&nbsp;</td>
        <td align="center" ><?
		if ($expte_destino == 1) {
		echo "EGG";
		}elseif ($expte_destino == 2) {
		echo "Municipalidad";
		}elseif ($expte_destino == 3) {
		echo "Ministerio de Infraestructura";
		}elseif ($expte_destino == 4) {
		echo "Instituto de la Vivienda";
		}elseif ($expte_destino == 5) {
		echo "Susbs. Social de Tierras"; }else{
		echo "Sin indicar";}		
		 ?>&nbsp;</td>
        <td align="center" ><?=$expte_envio_egg; ?>&nbsp;</td>
        <td align="center" ><?=$expte_mov; ?>&nbsp;</td>
        <td align="center" ><?=$expte_fechamov; ?>&nbsp;</td>
        </tr>
		
	  <? } ?>
    </table></td>
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