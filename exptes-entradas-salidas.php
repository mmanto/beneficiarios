<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: menu.php");
    
} else{

include ("conec.php");
include ("funciones.php");

$fecha = cambiaf_a_mysql($_POST["fecha_consulta"]);

//$fecha = "2020-01-24";

$orden = "Expte_caract ASC, Expte_num ASC, Expte_anio ASC, Expte_alcance ASC";


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


$sql = mysql_query("SELECT Expte_nro, Area_nombre FROM (
dbo_exptes_mov
INNER JOIN
dbo_area
ON dbo_exptes_mov.Expte_origen = dbo_area.Area_nro
) WHERE Expte_mov_reingreso = '1' AND Expte_mov_fecha = '$fecha' AND BlnActivo = '1'");
$cant = mysql_num_rows($sql);

/*******************/

$sql2 = mysql_query("SELECT * FROM (
dbo_exptes
INNER JOIN
dbo_area
ON dbo_exptes.Expte_origen = dbo_area.Area_nro
) WHERE Expte_alta_fecha = '$fecha' AND BlnActivo = '1'");
$cant2 = mysql_num_rows($sql2);

/******************/

$sql3 = mysql_query("SELECT Expte_nro, Area_nombre FROM (
dbo_exptes_mov
INNER JOIN
dbo_area
ON dbo_exptes_mov.Expte_destino = dbo_area.Area_nro
) WHERE Expte_mov_salida = '1' AND Expte_mov_fecha = '$fecha' AND BlnActivo = '1'");
$cant3 = mysql_num_rows($sql3);

?>
<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h1>Entradas y salidas de expedientes </h1></td>
  </tr>
  <tr>
    <td width="778" height="6">Listado de expedientes que han ingresado o salido del organismo.</td>
    <td width="122">&nbsp;</td>
  </tr>
  <tr>
    <td height="36" colspan="2" valign="middle"><a href="exptes-listar-area.php">[Volver al menu]</a></td>
  </tr>
  <tr>
    <td height="36" colspan="2" valign="bottom"><h2>Expedientes ingresados al organismo el <? echo cambiaf_a_normal($fecha); ?> (cant: <?=$cant; ?>)</h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2">
	<table width="900" border="0" cellpadding="4" cellspacing="5">
      <tr>
        <td width="179" height="24" align="center" bgcolor="#C0D1D0" class="titulo_dato">Expediente</td>
		  <td width="332" align="center" bgcolor="#C0D1D0" class="titulo_dato">Extracto </td>
		  <td width="179" align="center" bgcolor="#C0D1D0" class="titulo_dato">Origen</td>
		  <td width="153" align="center" bgcolor="#C0D1D0" class="titulo_dato">Escribano</td>
          </tr>
  <?
$num_fila = '0'; 

while ($exptemov = mysql_fetch_array($sql)) {	

$origen_mov = $exptemov["Area_nombre"];

$expte_nro = $exptemov["Expte_nro"];

$sql4 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_nro = '$expte_nro' AND blnActivo = '1' ORDER BY $orden",$link);

$expte = mysql_fetch_array($sql4);

$expte_caract = $expte["Expte_caract"];
if($expte["Expte_partido"] == '0') {$expte_partido = '-';}else{$expte_partido = $expte["Expte_partido"];}
if($expte["Expte_rnrd"] == '0') {$expte_rnrd = '-';}else{$expte_rnrd = $expte["Expte_rnrd"];}
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];

$expte_alcance = $expte["Expte_alcance"];
$expte_escribano = $expte["Expte_escribano"];

$expte_cuerpos = $expte["Expte_cuerpos"];
$expte_fechamov = cambiaf_a_normal($expte["Expte_fechamov"]);
	if ($expte_fechamov == '00/00/0000') {$expte_fechamov = " "; }
	
//$extracto_res = substr($expte["Expte_extracto"], 0,50); 

$extracto = $expte["Expte_extracto"];

$expte_fojas = $expte["Expte_fojas"];

$expte_cuerpos_cant = $expte["Expte_cuerpos_cant"];



//$expte_area = $expte["Expte_ubicacion_area"];



?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DEE7E6\""; }else{ echo "bgcolor=\"#D2DFDE\"";} ?>>
       <td align="center" > 
       
       <?=$expte_caract; ?> -
       
       
        <? if($expte["Expte_rnrd"] != '0') { ?> 
        
        	<?=$expte["Expte_partido"] ?> - <?=$expte_rnrd; ?>  
        
        <? }else{ ?>
			
         	-    
            
		<? } ?>	<?=$expte_num; ?> / <?=$expte_anio ?> 
        
        
        <? if ($expte_alcance != '0') { ?>Alc. <?=$expte_alcance; ?> <? } ?></td>
        
        
        
		  <td align="center" ><?=$extracto; ?>&nbsp;</td>
		  <td align="center" ><?=$origen_mov; ?></td>
		  <td align="center" ><?=$expte_escribano; ?>&nbsp;&nbsp;</td>
          </tr>
      
      <? 
	  $num_fila++; 	  
	  } ?>
	  <tr>
	  	<td>&nbsp;</td>
	  	<td colspan="3">&nbsp;</td>
	  	</tr>
	  
    </table>
		</td>
  </tr>
<tr>
    <td height="36" colspan="2" valign="bottom"><h2>Expedientes dados de alta el <? echo cambiaf_a_normal($fecha); ?> (cant: <?=$cant2; ?>)</h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2">
	<table width="900" border="0" cellpadding="4" cellspacing="5">
      <tr>
        <td width="179" height="24" align="center" bgcolor="#C0D1D0" class="titulo_dato">Expediente</td>
		  <td width="331" align="center" bgcolor="#C0D1D0" class="titulo_dato">Extracto </td>
		  <td width="182" align="center" bgcolor="#C0D1D0" class="titulo_dato">Iniciado por</td>
		  <td width="151" align="center" bgcolor="#C0D1D0" class="titulo_dato">Escribano</td>
		  </tr>
  <?
$num_fila2 = '0'; 

while ($expte = mysql_fetch_array($sql2)) {	


$expte_nro = $expte["Expte_nro"];

$expte_caract = $expte["Expte_caract"];
if($expte["Expte_partido"] == '0') {$expte_partido = '-';}else{$expte_partido = $expte["Expte_partido"];}
if($expte["Expte_rnrd"] == '0') {$expte_rnrd = '-';}else{$expte_rnrd = $expte["Expte_rnrd"];}
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_escribano = $expte["Expte_escribano"];

$expte_alcance = $expte["Expte_alcance"];

$expte_cuerpos = $expte["Expte_cuerpos"];
$expte_fechamov = cambiaf_a_normal($expte["Expte_fechamov"]);
	if ($expte_fechamov == '00/00/0000') {$expte_fechamov = " "; }
	
//$extracto_res = substr($expte["Expte_extracto"], 0,50); 

$extracto = $expte["Expte_extracto"];

$expte_iniciado = $expte["Area_nombre"];

$expte_fojas = $expte["Expte_fojas"];

$expte_cuerpos_cant = $expte["Expte_cuerpos_cant"];



?>
      <tr <? if ($num_fila2%2==0) { echo "bgcolor=\"#DEE7E6\""; }else{ echo "bgcolor=\"#D2DFDE\"";} ?>>
       <td align="center" > 
       
       <?=$expte_caract; ?> -
       
       
        <? if($expte["Expte_rnrd"] != '0') { ?> 
        
        	<? echo $expte_partido." - ".$expte_rnrd."- "; ?>  
        
            
		<? } ?>	<?=$expte_num; ?> / <?=$expte_anio ?> 
        
        
        <? if ($expte_alcance != '0') { ?>Alc. <?=$expte_alcance; ?> <? } ?></td>
        
        
        
		  <td align="center" ><?=$extracto; ?>&nbsp;</td>
		  <td align="center" ><?=$expte_iniciado; ?>&nbsp;</td>
		  <td align="center" ><?=$expte_escribano; ?>&nbsp;&nbsp;</td>
		  </tr>
      
      <? 
	  $num_fila2++; 	  
	  } ?>
	  <tr>
	  	<td>&nbsp;</td>
	  	<td colspan="3">&nbsp;</td>
	  	</tr>
	  
    </table>
	</td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td height="36" colspan="2" valign="bottom"><h2>Expedientes salidos del organismo el <? echo cambiaf_a_normal($fecha); ?> (cant: <?=$cant3; ?>)</h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2">
	<table width="900" border="0" cellpadding="4" cellspacing="5">
      <tr>
        <td width="179" height="24" align="center" bgcolor="#C0D1D0" class="titulo_dato">Expediente</td>
		  <td width="332" align="center" bgcolor="#C0D1D0" class="titulo_dato">Extracto </td>
		  <td width="179" align="center" bgcolor="#C0D1D0" class="titulo_dato">Destino</td>
		  <td width="153" align="center" bgcolor="#C0D1D0" class="titulo_dato">Escribano</td>
          </tr>
  <?
$num_fila3 = '0'; 

while ($exptemov = mysql_fetch_array($sql3)) {	

$destino_mov = $exptemov["Area_nombre"];

$expte_nro = $exptemov["Expte_nro"];

$sql4 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_nro = '$expte_nro' AND blnActivo = '1' ORDER BY $orden",$link);

$expte = mysql_fetch_array($sql4);

$expte_caract = $expte["Expte_caract"];
if($expte["Expte_partido"] == '0') {$expte_partido = '-';}else{$expte_partido = $expte["Expte_partido"];}
if($expte["Expte_rnrd"] == '0') {$expte_rnrd = '-';}else{$expte_rnrd = $expte["Expte_rnrd"];}
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];

$expte_alcance = $expte["Expte_alcance"];
$expte_escribano = $expte["Expte_escribano"];

$expte_cuerpos = $expte["Expte_cuerpos"];
$expte_fechamov = cambiaf_a_normal($expte["Expte_fechamov"]);
	if ($expte_fechamov == '00/00/0000') {$expte_fechamov = " "; }
	
//$extracto_res = substr($expte["Expte_extracto"], 0,50); 

$extracto = $expte["Expte_extracto"];

$expte_fojas = $expte["Expte_fojas"];

$expte_cuerpos_cant = $expte["Expte_cuerpos_cant"];



//$expte_area = $expte["Expte_ubicacion_area"];



?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DEE7E6\""; }else{ echo "bgcolor=\"#D2DFDE\"";} ?>>
       <td align="center" > 
       
       <?=$expte_caract; ?> -
       
       
        <? if($expte["Expte_rnrd"] != '0') { ?> 
        
        	<?=$expte["Expte_partido"] ?> - <?=$expte_rnrd; ?>  
        
        <? }else{ ?>
			
         	-    
            
		<? } ?>	<?=$expte_num; ?> / <?=$expte_anio ?> 
        
        
        <? if ($expte_alcance != '0') { ?>Alc. <?=$expte_alcance; ?> <? } ?></td>
        
        
        
		  <td align="center" ><?=$extracto; ?>&nbsp;</td>
		  <td align="center" ><?=$destino_mov; ?></td>
		  <td align="center" ><?=$expte_escribano; ?>&nbsp;&nbsp;</td>
          </tr>
      
      <? 
	  $num_fila3++; 	  
	  } ?>
	  <tr>
	  	<td>&nbsp;</td>
	  	<td colspan="3">&nbsp;</td>
	  	</tr>
	  
    </table>
		</td>
  </tr>
</table>
<?  
include("pie.php");

 }
 
?>