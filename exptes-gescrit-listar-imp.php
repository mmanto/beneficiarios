<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{


$ordenar = $_GET["ordenar"];

if ($ordenar == "partido") {

$orden = "Partido_nombre ASC";

}elseif($ordenar == "envioegg") {

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
dbo_partido
ON dbo_exptes.Partido_nro = dbo_partido.Partido_nro
) WHERE Expte_esc = '1' AND blnActivo = '1' AND Expte_ubicacion_area = '83' ORDER BY $orden",$link);



/*
$sql36 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido",$link); 

$part = mysql_fetch_array($sql36);

$partido_nombre = $part["Partido_nombre"];
*/



$cant = mysql_num_rows($sql3);

?>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Expedientes en la Direcci&oacute;n de Gesti&oacute;n Escrituraria</h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los expedientes ubicados en esta Dirección.</td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="exptes-gescrit-listar.php">Volver al listado comun</a></td>
  </tr>
  <tr>
    <td height="8" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td width="10%">Ordenar por: </td>
        <td width="31%"><form><select name="ListeUrl" onChange="ChangeUrl(this.form)">
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=expediente" <? if ($ordenar == 'expediente') { ?> selected="selected" <? } ?>>Nro. de expediente</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=partido" <? if ($ordenar == 'partido') { ?> selected="selected" <? } ?>>Partido</option>
    </select>
    </form> </td>
        <td width="59%"><a href="exptes-gescrit-listar-imp.php?ordenar=<?=$ordenar; ?>">[Version para imprimir] </a></td>
      </tr>
    </table></td>
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
    <td>
	<form method="post" action="accion-multiple-exptes.php">
	<table width="850" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="221" height="25" align="center" class="titulo_dato">Expediente</td>
		<td width="139" align="center" class="titulo_dato">Partido</td>
		<td width="65" align="center" class="titulo_dato">Benef.</td>
        <td width="151" align="center" class="titulo_dato">Estado</td>
        <td width="203" align="center" class="titulo_dato">Observaciones</td>
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
$expte_esc_observaciones = $expte["Expte_esc_observaciones"];
$expte_gescrit_estado = $expte["Expte_gescrit_estado"];


if($expte["Expte_salida"] == '0000-00-00') { $expte_envio_egg = "--"; }else{ $expte_envio_egg = cambiaf_a_normal($expte["Expte_salida"]); }

?>
      <tr>
        <td height="40" align="center" ><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;} ?> 
		<? if($expte["Expte_extracto"] == "COMPLETAR EXTRACTO") { echo "<img src='imagen/alerta.png'>"; } ?>
		</td>
		<td align="center"><?=$expte_partido; ?></td>
		<td align="center"><?=$expte_beneficios; ?>&nbsp;</td>
        <td align="center" valign="middle" >
        <? if ($expte_gescrit_estado == '1') {
			echo "Esperando revisi&oacute;n"; }
			elseif
				($expte_gescrit_estado == '2') {
			echo "Esperando documentaci&oacute;n"; }
			elseif
				($expte_gescrit_estado == '3') {
			echo "Esperando firma"; }
			elseif
				($expte_gescrit_estado == '4') {
			echo "Archivado en el &aacute;rea"; }
			else{
			echo "Sin indicar"; }
					?>	
        </td>
        <td align="center" ><?=$expte_esc_observaciones; ?>&nbsp;</td>
        </tr>
		
	  <? } ?>
    </table>
	</form>
	</td>
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