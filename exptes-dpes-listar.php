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
INNER JOIN
dbo_area
ON dbo_exptes.Expte_ubicacion_area = dbo_area.Area_nro
) WHERE Expte_esc = '1' AND blnActivo = '1' ORDER BY $orden",$link);



/*
$sql36 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido",$link); 

$part = mysql_fetch_array($sql36);

$partido_nombre = $part["Partido_nombre"];
*/



$cant = mysql_num_rows($sql3);

?>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Expedientes con intervenci&oacute;n de la la D.P.E.S. </h2></td>
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
        <td><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td width="10%">Ordenar por: </td>
        <td width="31%"><form><select name="ListeUrl" onChange="ChangeUrl(this.form)">
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=expediente" <? if ($ordenar == 'expediente') { ?> selected="selected" <? } ?>>Nro. de expediente</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=partido" <? if ($ordenar == 'partido') { ?> selected="selected" <? } ?>>Partido</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=ubicacion" <? if ($ordenar == 'ubicacion') { ?> selected="selected" <? } ?>>Ubicacion actual</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=envioegg" <? if ($ordenar == 'envioegg') { ?> selected="selected" <? } ?>>Envio a EGG</option>
    </select>
    </form> </td>
        <td width="59%"><a href="exptes-dpes-listar-imp.php?ordenar=<?=$ordenar; ?>">[Version para imprimir] </a></td>
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
	<table width="980" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="189" height="25" align="center" class="titulo_dato">Expediente</td>
		<td width="158" align="center" class="titulo_dato">Partido</td>
		<td width="78" align="center" class="titulo_dato">Benef.</td>
        <td width="157" align="center" class="titulo_dato">Ubicaci&oacute;n seg&uacute;n<br />
          Sist. expedientes </td>
        <td width="97" align="center" class="titulo_dato">Envío a EGG&nbsp;</td>
        <td width="161" align="center" class="titulo_dato">Ultimo mov. </td>
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

if($expte["Expte_salida"] == '0000-00-00') { $expte_envio_egg = "--"; }else{ $expte_envio_egg = cambiaf_a_normal($expte["Expte_salida"]); }

?>
      <tr>
        <td height="30" align="center" ><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;} ?> 
		<? if($expte["Expte_extracto"] == "COMPLETAR EXTRACTO") { echo "<img src='imagen/alerta.png'>"; } ?>
		</td>
		<td align="center"><?=$expte_partido; ?></td>
		<td align="center"><?=$expte_beneficios; ?>&nbsp;</td>
        <td align="center" >
		<? if($expte_ubicacion == 'Sin definir ubicación') { echo "<img src='imagen/sindef.jpg'>"; }else echo $expte_ubicacion; ?>
		&nbsp;</td>
        <td align="center" ><?=$expte_envio_egg; ?>&nbsp;</td>
        <td align="center" ><?=$expte_mov; ?>&nbsp;</td>
        <td width="26" align="center" >
		<a href=javascript:ventana_imprimir('expte-informe.php?idExpte=<?=$expte_nro; ?>')><img src="imagen/doc.png" alt="Ver informe expte." width="11" height="16" border="0" /></a></td>
        <td width="28" align="center" class="datos-center"><a href="
		<? if($user["p753"] == '1') { ?>
		javascript:ventana_modif('expte-esc-modif-form.php?idExpte=<? echo $expte_nro;?>') <? }else{ ?>
		#<? } ?>		
		"><img src="imagen/edit.png" alt="Editar expte." title="Editar expte." width="16" height="16" border="0" /></a></td>
        <td width="32" align="center"><a href="beneficio_expte_listar.php?expte=<? echo $expte_nro; ?>"><img src="imagen/benef.jpg" alt="Listar beneficiarios" title="Listar beneficiarios" width="16" height="19" border="0" /></a></td>
        <td width="32" align="center"><input type="checkbox" name="seleccion[]" value="<? echo $expte_nro;?>" /></td>
      </tr>
		
	  <? } ?>
    </table>
	<? if($user["HabSbt"] <= '3') { ?>
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
		
		if($user["HabSbt"] <= '3') {
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