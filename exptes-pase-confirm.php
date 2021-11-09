<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idUsuario = $_POST["idUsuario"];

$pase_origen = $_POST["origen"];

$expte_destino = $_POST["destino"];

$expte_reingreso = $_POST["reingreso"];

$pase_observaciones = $_POST["pase_observaciones"];

$lista = implode(',',$_POST['seleccion']); 

//Comprueba si hay expedientes seleccionados

$seleccion = $_POST['seleccion'];

$cant = count($_POST['seleccion']);


if ($cant < 1) { ?>

	<h1>Debe seleccionar al menos un expediente para realizar un pase</h1>
	<p>&nbsp;</p>
	<p><a href="javascript:window.history.back();">Volver al listado de expedientes</a></p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	
 <? }else{ 
 
//Comprueba si se selecciono un destino para el pase
 
if ($expte_destino == '0') { ?>

	<h1>Debe seleccionar un destino para el pase</h1>
	<p>&nbsp;</p>
	<p><a href="javascript:window.history.back();">Volver al listado de expedientes</a></p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>

<? }else{ 
 
$sql = "SELECT * FROM dbo_exptes WHERE Expte_nro IN(".$lista.") OR Expte_padre IN(".$lista.")";
$res = mysql_query($sql);
$cant2 = mysql_num_rows($res);
 
 
?> 
 
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h1>&iquest;Confirma el pase de <?=$cant; ?> expediente<? if($can2t > '1') { echo "s";}  ?> y sus agregados?</h1></td>
  </tr>
  <tr>
    <td height="30">Por favor antes de confirmar la operaci&oacute;n s&iacute;rvase indicar en cada caso la cantidad de de fojas que lo conforman. </td>
  </tr>
  <tr>
    <td height="26"><a href="javascript:window.history.back();">Volver al listado de expedientes</a> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<form method="post" action="exptes-pase.php">
	<table width="800" border="0" cellspacing="5" cellpadding="4">
      <tr>
        <td width="72" height="28" align="center" bgcolor="#C0C0C0"><strong>Caract.</strong></td>
        <td width="83" align="center" bgcolor="#C0C0C0"><strong>Pdo.</strong></td>
        <td width="66" align="center" bgcolor="#C0C0C0"><strong>RNRD</strong></td>
        <td width="101" align="center" bgcolor="#C0C0C0"><strong>Numero</strong></td>
        <td width="67" align="center" bgcolor="#C0C0C0"><strong>A&ntilde;o</strong></td>
        <td width="68" align="center" bgcolor="#C0C0C0"><strong>Alc.</strong></td>
        <td width="61" align="center" bgcolor="#C0C0C0"><strong>Cuerpos</strong></td>
        <td width="81" align="center" bgcolor="#C0C0C0"><strong>Tipo</strong></td>
        <td width="79" align="center" bgcolor="#C0C0C0"><strong>Fojas</strong></td>
      </tr>
<?

$i = 1;
$num_fila = 1;
while ($expte = mysql_fetch_array($res)) {

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
if($expte["Expte_partido"] == '0') {$expte_partido = '-';}else{$expte_partido = $expte["Expte_partido"];}
if($expte["Expte_rnrd"] == '0') {$expte_rnrd = '-';}else{$expte_rnrd = $expte["Expte_rnrd"];}
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpos = $expte["Expte_cuerpos"];
$expte_fojas = $expte["Expte_fojas_actual"];
$expte_ubicacion_area = $expte["Expte_ubicacion_area"];

?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DDDDDD\""; }else{ echo "bgcolor=\"#E9E9E9\"";} ?>>
        <td align="center"><?=$expte_caract; ?></td>
        <td align="center"><?=$expte_partido;?>&nbsp;</td>
        <td align="center"><?=$expte_rnrd;?>&nbsp;</td>
        <td align="center"><?=$expte_num;?>&nbsp;</td>
        <td align="center"><?=$expte_anio;?>&nbsp;</td>
        <td align="center"><?=$expte_alcance;?>&nbsp;</td>
        <td align="center"><?=$expte_cuerpos;?>&nbsp;</td>
        <td align="center"><? if ($expte["Expte_padre"] != '0') { echo "<strong>Agregado</strong>"; } ?> &nbsp;</td>
        <td align="center">
          <input type="hidden" name="ubicacion<?=$i ?>" value="<? echo $expte_ubicacion_area; ?>"/>
          <input type="hidden" name="pase_observaciones" value="<? echo $pase_observaciones; ?>" />
          <input type="hidden" name="id<?=$i ?>" value="<?=$expte["Expte_nro"]; ?>">
          <input name="fojas<?=$i ?>" type="text" size="1" value="<? echo $expte_fojas; ?>">
          
        </td>
      </tr>
<? 
$i++;
$num_fila++;
} ?>
      <tr>
        <td height="45" align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td colspan="3" align="center">
		<input type="hidden" name="cant" value="<?=$cant2; ?>"> 
		<input type="hidden" name="idUsuario" value="<?=$idUsuario; ?>">
		<input type="hidden" name="origen" value="<?=$pase_origen; ?>">
		<input type="hidden" name="destino" value="<?=$expte_destino; ?>">
		<input type="hidden" name="pase_observaciones" value="<?=$pase_observaciones; ?>">
		<input type="hidden" name="reingreso" value="<?=$expte_reingreso; ?>" />
          <input type="submit" name="Submit" value="Confirmar pase"></td>
        </tr>
    </table>
	</form></td>
  </tr>
</table>
<?		 } 

	} 
	
 include("pie.php"); ?>