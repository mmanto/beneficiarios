<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: menu.php");
    
} else{

//$fecha = $_POST["fecha"];

$fecha = "2020-01-20"; 

$orden = "Expte_caract ASC, Expte_num ASC, Expte_anio ASC, Expte_alcance ASC";

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
$usuario_area = $user["Area_nro"];
$expte_area = $expte["Expte_ubicacion_area"];


$sql = mysql_query("SELECT Expte_nro FROM dbo_exptes_mov WHERE Expte_destino = '$usuario_area' AND Expte_mov_fecha = '$fecha' AND BlnActivo = '1'");

$cant = mysql_num_rows($sql);

?>
<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h1>Expedientes ingresados al área el día <? echo cambiaf_a_normal($fecha); ?> (cant: <?=$cant; ?>) </h1></td>
  </tr>
  <tr>
    <td width="778" height="6">Listado de expedientes actualmente en el &aacute;rea. Para realizar un pase  seleccione los expedientes correspondientes, indique el &aacute;rea de destino y pulse el bot&oacute;n &quot;confirmar pase&quot;. Una vez efectuado el pase podr&aacute; imprimir el remito correspondiente a la operaci&oacute;n. Para buscar en pantalla un expediente presione la combinaci&oacute;n Ctrl+F. </td>
    <td width="122">&nbsp;</td>
  </tr>
  <tr>
    <td height="36" colspan="2" valign="middle"><a href="exptes-listar-area.php">[Volver al menu]</a></td>
  </tr>
  <tr>
    <td height="12" colspan="2" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2">
	<form method="post" action="exptes-noreservar.php">
	<table width="900" border="0" cellpadding="4" cellspacing="5">
      <tr>
        <td height="24" align="center" bgcolor="#C0D1D0" class="titulo_dato">Expediente</td>
		  <td width="509" align="center" bgcolor="#C0D1D0" class="titulo_dato">Extracto</td>
          <td colspan="2" align="center" bgcolor="#C0D1D0" class="titulo_dato">Acciones</td>
          <td align="center" bgcolor="#C0D1D0"><input type="checkbox" onclick="marcar(this);" /></td>
        </tr>
  <?
$num_fila = '0'; 

while ($exptemov = mysql_fetch_array($sql)) {	

$expte_nro = $exptemov["Expte_nro"];

$sql3 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_nro = '$expte_nro' AND blnActivo = '1' ORDER BY $orden",$link);

$expte = mysql_fetch_array($sql3);

$expte_caract = $expte["Expte_caract"];
if($expte["Expte_partido"] == '0') {$expte_partido = '-';}else{$expte_partido = $expte["Expte_partido"];}
if($expte["Expte_rnrd"] == '0') {$expte_rnrd = '-';}else{$expte_rnrd = $expte["Expte_rnrd"];}
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpos = $expte["Expte_cuerpos"];
$expte_fechamov = cambiaf_a_normal($expte["Expte_fechamov"]);
	if ($expte_fechamov == '00/00/0000') {$expte_fechamov = " "; }
	
//$extracto_res = substr($expte["Expte_extracto"], 0,50); 

$extracto = $expte["Expte_extracto"];

$expte_fojas = $expte["Expte_fojas"];

$expte_cuerpos_cant = $expte["Expte_cuerpos_cant"];

$expte_area = $expte["Expte_ubicacion_area"];

?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DEE7E6\""; }else{ echo "bgcolor=\"#D2DFDE\"";} ?>>
       <td align="center" > 
        <? if($expte["Expte_rnrd"] != '0') { ?> 
        
        <?=$expte_caract; ?> - <?=$expte_partido; ?> - <?=$expte_rnrd; ?> - <?=$expte_num; ?>/<?=$expte_anio ?> Alc. <?=$expte_alcance; ?> 
        
        <? }else{ ?>
			
         <?=$expte_caract; ?> - <?=$expte_num; ?>/<?=$expte_anio ?> Alc. <?=$expte_alcance; ?>   
            
		<? } ?>	</td>
        
        
        
		  <td align="center" ><?=$extracto;  ?>&nbsp;</td>
          <td width="24" align="center" ><a href="expte_informe.php?id=<? echo $expte_nro;	?>"><a href=javascript:ventana_imprimir('expte-informe.php?idExpte=<?=$expte_nro; ?>')><img src="imagen/doc.png" alt="Ver informe expte." width="11" height="16" border="0" title="Ver detalles del expediente"/></a></td>
          <td width="22" align="center" class="datos-center"><? if ($user["p603"] == '1')  { ?><a href=javascript:ventana_imprimir('expte-modif-form.php?idExpte=<?=$expte_nro; ?>') ><img src="imagen/edit.png" alt="Editar expte." title="Editar expte." width="16" height="16" border="0" /></a><? }else{ ?><img src="imagen/edit-no.png" alt="Editar expte." title="Editar expte." width="16" height="16" border="0" /><? } ?></td>
         <td width="41" align="center"><? if ($user["p605"] == '1') { ?> <input type="checkbox" name="seleccion[]" value="<?=$expte["Expte_nro"]; ?>" /><? }else{ ?> - <? } ?></td>
        </tr>
      
      <? 
	  $num_fila++; 	  
	  } ?>
	  <tr>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	</tr>
	  
    </table>
	</form></td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td></tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
</table>
<?  
include("pie.php");

 }
 
?>