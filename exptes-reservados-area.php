<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: menu.php");
    
} else{


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


$sql3 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_ubicacion_area = '$usuario_area' AND Expte_reservado = '1' AND blnActivo = '1' ORDER BY $orden",$link);

$cant = mysql_num_rows($sql3);

?>
<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h1>Expedientes reservados en el &aacute;rea (cant: <?=$cant; ?>) </h1></td>
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
        <td width="45" height="24" align="center" bgcolor="#C0D1D0" class="titulo_dato">Caract.</td>
		  <td width="29" align="center" bgcolor="#C0D1D0" class="titulo_dato">Pdo.</td>
		  <td width="43" align="center" bgcolor="#C0D1D0" class="titulo_dato">RNRD</td>
		  <td width="50" align="center" bgcolor="#C0D1D0" class="titulo_dato">N&uacute;mero</td>
		  <td width="26" align="center" bgcolor="#C0D1D0" class="titulo_dato">A&ntilde;o</td>
          <td width="25" align="center" bgcolor="#C0D1D0" class="titulo_dato">Alc.</td>
          <td width="37" align="center" bgcolor="#C0D1D0" class="titulo_dato">Cpos.</td>
          <td width="410" align="center" bgcolor="#C0D1D0" class="titulo_dato">Extracto</td>
          <td colspan="2" align="center" bgcolor="#C0D1D0" class="titulo_dato">Acciones</td>
          <td align="center" bgcolor="#C0D1D0"><input type="checkbox" onclick="marcar(this);" /></td>
        </tr>
  <?
$num_fila = '0'; 

while ($expte = mysql_fetch_array($sql3)) {	

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
if($expte["Expte_partido"] == '0') {$expte_partido = '-';}else{$expte_partido = $expte["Expte_partido"];}
if($expte["Expte_rnrd"] == '0') {$expte_rnrd = '-';}else{$expte_rnrd = $expte["Expte_rnrd"];}
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpos = $expte["Expte_cuerpos"];
$expte_fechamov = cambiaf_a_normal($expte["Expte_fechamov"]);
	if ($expte_fechamov == '00/00/0000') {$expte_fechamov = " "; }
	
$extracto_res = substr($expte["Expte_extracto"], 0,50); 

$expte_fojas = $expte["Expte_fojas"];

$expte_cuerpos_cant = $expte["Expte_cuerpos_cant"];

$expte_area = $expte["Expte_ubicacion_area"];

?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DEE7E6\""; }else{ echo "bgcolor=\"#D2DFDE\"";} ?>>
        <td align="center" ><?=$expte_caract; ?></td>
		  <td align="center"><?=$expte_partido; ?></td>
		  <td align="center"><?=$expte_rnrd; ?></td>
		  <td align="center"><?=$expte_num; ?></td>
		  <td align="center"><?=$expte_anio ?></td>		
          <td align="center"><?=$expte_alcance; ?>&nbsp;</td>
          <td align="center" ><?=$expte_cuerpos_cant; ?>&nbsp;</td>
          <td align="center" ><?=$extracto_res;  ?>[...]&nbsp;</td>
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
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	</tr>
	  <tr>
	    <td colspan="11" align="right"><? if ($user["p605"] == '1') { ?><table width="98%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="68%" height="50" align="right" valign="middle" bgcolor="#C0D1D0">Quitar condici&oacute;n de &quot;reservados&quot; a los expedientes seleccionados</td>
            <td width="32%" bgcolor="#C0D1D0"><input type="submit" name="Submit" value="Confirmar operaci&oacute;n" /><input type="hidden" name="idUsuario" value="<?=$log_usuario; ?>" />
              <input type="hidden" name="destino" value="63" />
              <input type="hidden" name="origen" value="23" />
              <input type="hidden" name="reingreso" value="0" />
              </td>
          </tr>
        </table>
	    <? } ?></td>
	    </tr>
    </table>
	</form></td>
  </tr>
  <tr><td colspan="10">&nbsp;</td></tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
</table>
<?  
include("pie.php");

 }
 
?>