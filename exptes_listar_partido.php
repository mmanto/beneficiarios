<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

$idPartido = $_GET["idPartido"]; 

$ordenar = $_GET["ordenar"];

if ($ordenar == "partido") {

$orden = "Partido_nombre ASC";

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
) WHERE Expte_esc = '1' AND Partido_nro = $idPartido AND blnActivo = '1' ORDER BY $orden",$link);




$sql36 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido",$link); 

$part = mysql_fetch_array($sql36);

$partido_nombre = $part["Partido_nombre"];




$cant = mysql_num_rows($sql3);

?>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Expedientes de escrituraci&oacute;n correspondientes a <?=$partido_nombre; ?> </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema Integral de Gesti&oacute;n de la Subsecretar&iacute;a Social de Tierras y Urbanismo </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="sbt-menu.php">Volver al menu</a></td>
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
    <td>
	<form method="post" action="accion-multiple-exptes.php">
	<table width="980" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="172" height="25" align="center" class="titulo_dato">Expediente</td>
		<td width="144" align="center" class="titulo_dato">Partido</td>
		<td width="71" align="center" class="titulo_dato">Benef.</td>
        <td width="203" align="center" class="titulo_dato">Ubicaci&oacute;n seg&uacute;n Sist. expedientes </td>
        <td width="158" align="center" class="titulo_dato">Ultimo mov. </td>
        <td width="90" align="center" class="titulo_dato">Fecha ultimo mov. </td>
        <td colspan="4" align="center">Acciones</td>
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

?>
      <tr>
        <td height="30" align="center" ><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> </td>
		<td align="center"><?=$expte_partido; ?></td>
		<td align="center"><?=$expte_beneficios; ?>&nbsp;</td>
        <td align="center" ><?=$expte_ubicacion; ?>&nbsp;</td>
        <td align="center" ><?=$expte_mov; ?>&nbsp;</td>
        <td align="center" ><?=$expte_fechamov; ?>&nbsp;</td>
        <td width="26" align="center" >
		<a href=javascript:ventana_imprimir('expte-informe.php?idExpte=<?=$expte_nro; ?>')><img src="imagen/doc.png" alt="Ver informe expte." width="11" height="16" border="0" /></a></td>
        <td width="25" align="center" class="datos-center"><a href="
		<? if ($idNivel < '7')  { ?>
		javascript:ventana_modif('expte_esc_modif_form.php?id=<? echo $expte_nro;?>') <? }else{ ?>
		#<? } ?>		
		"><img src="imagen/edit.png" alt="Editar expte." title="Editar expte." width="16" height="16" border="0" /></a></td>
        <td width="35" align="center"><a href="beneficio_expte_listar.php?expte=<? echo $expte_nro; ?>"><img src="imagen/benef.jpg" alt="Listar beneficiarios" title="Listar beneficiarios" width="16" height="19" border="0" /></a></td>
        <td width="34" align="center"><input type="checkbox" name="seleccion[]" value="<? echo $expte_nro;?>" /></td>
      </tr>
		
	  <? } ?>
    </table>
	<? if($user["HabSbt"] <= '5') { ?>
	<table width="980" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  </tr>
	<tr>
		<td width="314" height="80" align="center" bgcolor="#CED8E3">Ubicaci&oacute;n actual de los expedientes marcados:</td>
	    <td width="386" bgcolor="#CED8E3"><select name ="ubicacion" size="1">
			<option value="0" selected="selected">Seleccione una ubicacion...</option>
		<?
		
		if($user["HabSbt"] <= '5') {
			$sql5 = "SELECT * FROM dbo_area ORDER BY Area_codigo";
		}
		 
		 $res5 = mysql_query($sql5);
		 
		 while ($destino = mysql_fetch_array($res5)) { ?>
              <option value="<?=$destino["Area_nro"]; ?>"><?=$destino["Area_codigo"]; ?> - <?=$destino["Area_nombre"]; ?></option>
		<? } ?>
            </select>&nbsp;</td>
	    <td width="230" align="center" bgcolor="#CED8E3"><input type="submit" name="Submit" value="Actualizar ubicaci&oacute;n" /></td>
	</tr>
	</table><? } ?>
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