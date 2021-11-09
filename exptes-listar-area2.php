<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: menu.php");
    
} else{

include ("conec.php");
include ("funciones.php");

$noback = "1"; 

include("cabecera.php");

$ordenar = $_GET["ordenar"];

if ($ordenar == '1') {

$orden = "Expte_caract";

}elseif ($ordenar == '2'){

$orden = "Expte_partido";

}elseif ($ordenar == '3'){

$orden = "Expte_rnrd";

}elseif ($ordenar == '4'){

$orden = "Expte_num";

}elseif ($ordenar == '5'){

$orden = "Expte_anio";

}elseif ($ordenar == '6'){

$orden = "Expte_alcance";

}else{

$orden = "Expte_caract ASC, Expte_num ASC, Expte_anio ASC, Expte_alcance ASC";

}

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$idNivel = $log_nivel;
$usuario_nombre = $user["Nombre"];
$usuario_area = $user["Area_nro"];


$sql3 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_ubicacion_area = '$usuario_area' AND blnActivo = '1' ORDER BY $orden",$link);

$cant = mysql_num_rows($sql3);

?>
<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h1>Expedientes actualmente en el &aacute;rea (cant: <?=$cant; ?>) </h1></td>
  </tr>
  <tr>
    <td width="778" height="6">Listado de expedientes actualmente en el &aacute;rea. Para realizar un pase  seleccione los expedientes correspondientes, indique el &aacute;rea de destino y pulse el bot&oacute;n &quot;confirmar pase&quot;. Una vez efectuado el pase podr&aacute; imprimir el remito correspondiente a la operaci&oacute;n. Para buscar en pantalla un expediente presione la combinaci&oacute;n Ctrl+F. </td>
    <td width="122">&nbsp;</td>
  </tr>
  <tr>
    <td height="36" colspan="2" valign="middle"><a href="menu.php">[Volver al menu]</a></td>
  </tr>
  <tr>
    <td height="60" colspan="2" align="right" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="21%" align="right"><? if ($user["HabExp"] <= '3' || ($user["HabExp"] <= '5' && $user["Area_nro"] == '63')) { ?><table width="170" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="54" align="center"><a href="exptes-archivo.php"><img src="imagen/archivo.png" width="40" height="40" border="0" /></a></td>
            <td width="116">Ver  expedientes archivados </td>
          </tr>
        </table><? } ?></td>
        <td width="22%" align="right"><? if ($user["HabExp"] <= '6') { ?>
		<table width="190" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="60" align="center"><a href="exptes-salida.php"><img src="imagen/expte-salida.png" width="40" height="40" border="0" /></a></td>
            <td width="190">Ver expedientes<br />
              fuera del organismo  </td>
          </tr>
        </table><? } ?></td>
        <td width="21%" align="right">
		<? if ($user["HabExp"] <= '6') { ?>
		<table width="190" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="51" align="center"><a href="expte-alta-form.php"><img src="imagen/expte-crear.png" width="40" height="40" border="0" /></a></td>
            <td width="149">Dar de alta<br />
              nuevo expediente </td>
          </tr>
        </table><? } ?></td>
        <td width="5%"><a href="expte-buscar.php"><img src="imagen/expte-buscar.png" width="40" height="40" border="0" /></a></td>
        <td width="15%">Buscar expediente<br />
          en todas las &aacute;reas </td>
        <td width="5%"><a href="remitos-listar-area.php"><img src="imagen/remito-buscar.png" width="40" height="40" border="0" /></a></td>
        <td width="11%">Ver historial<br />
          de 
          movimientos</td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td height="60" colspan="2" valign="middle">
	  <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td width="10%">Ordenar por: </td>
        <td width="31%"><form>
		<select name="ListeUrl" onChange="ChangeUrl(this.form)">
		<option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=1" <? if ($ordenar == '1') { ?> selected="selected" <? } ?>>Caracteristica</option>
		<option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=2" <? if ($ordenar == '2') { ?> selected="selected" <? } ?>>Partido</option>
		<option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=3" <? if ($ordenar == '3') { ?> selected="selected" <? } ?>>RNRD</option>
	  	<option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=4" <? if ($ordenar == '4') { ?> selected="selected" <? } ?>>Número</option>
	  	<option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=5" <? if ($ordenar == '5') { ?> selected="selected" <? } ?>>Año</option>
		<option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=6" <? if ($ordenar == '6') { ?> selected="alcance" <? } ?>>Alcance</option>
    </select>
    </form> </td>
        <td width="59%">&nbsp;</td>
      </tr>
    </table>	</td>
  </tr>
  <tr>
    <td height="25" colspan="2">
	<form method="post" action="exptes-pase-confirm.php">
	<table width="900" border="0" cellpadding="4" cellspacing="5">
      <tr bgcolor="#CCCCCC">
        <td width="50" height="24" align="center" bgcolor="#E9D28F" class="titulo_dato">Caract.</td>
		  <td width="29" align="center" bgcolor="#E9D28F" class="titulo_dato">Pdo.</td>
		  <td width="43" align="center" bgcolor="#E9D28F" class="titulo_dato">RNRD</td>
		  <td width="53" align="center" bgcolor="#E9D28F" class="titulo_dato">N&uacute;mero</td>
		  <td width="29" align="center" bgcolor="#E9D28F" class="titulo_dato">A&ntilde;o</td>
          <td width="25" align="center" bgcolor="#E9D28F" class="titulo_dato">Alc.</td>
          <td width="37" align="center" bgcolor="#E9D28F" class="titulo_dato">Cpos.</td>
          <td width="410" align="center" bgcolor="#E9D28F" class="titulo_dato">Extracto</td>
          <td colspan="2" align="center" bgcolor="#E9D28F" class="titulo_dato">Acciones</td>
          <td align="center" bgcolor="#E9D28F"><input type="checkbox" onclick="marcar(this);" /></td>
        </tr>
  <?
$num_fila = '1'; 

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
	
$extracto_res = substr($expte["Expte_extracto"], 0,60); 

$expte_fojas = $expte["Expte_fojas"];

$expte_cuerpos_cant = $expte["Expte_cuerpos_cant"];

$expte_area = $expte["Expte_ubicacion_area"];

?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#F0EEA4\""; }else{ echo "bgcolor=\"#F7F4CA\"";} ?>>
        <td align="center" ><?=$expte_caract; ?></td>
		  <td align="center"><?=$expte_partido; ?></td>
		  <td align="center"><?=$expte_rnrd; ?></td>
		  <td align="center"><?=$expte_num; ?></td>
		  <td align="center"><?=$expte_anio ?></td>		
          <td align="center"><?=$expte_alcance; ?>&nbsp;</td>
          <td align="center" ><?=$expte_cuerpos_cant; ?>&nbsp;</td>
          <td align="center" ><?=$extracto_res;  ?>[...]&nbsp;</td>
          <td width="26" align="center" ><a href="expte_informe.php?id=<? echo $expte_nro;	?>"><a href=javascript:ventana_imprimir('expte-informe.php?idExpte=<?=$expte_nro; ?>')><img src="imagen/doc.png" alt="Ver informe expte." width="11" height="16" border="0" title="Ver detalles del expediente"/></a></td>
          <td width="17" align="center" class="datos-center"><? if ($user["HabExp"] <= '4')  { ?><a href=javascript:ventana_imprimir('expte-modif-form.php?idExpte=<?=$expte_nro; ?>') ><img src="imagen/edit.png" alt="Editar expte." title="Editar expte." width="16" height="16" border="0" /></a><? }else{ ?><img src="imagen/edit.png" alt="Editar expte." title="Editar expte." width="16" height="16" border="0" /><? } ?></td>
         <td width="33" align="center"><? if ($user["HabExp"] <= '7') { ?> <input type="checkbox" name="seleccion[]" value="<?=$expte["Expte_nro"]; ?>" /><? }else{ ?> - <? } ?></td>
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
	    <td colspan="11" align="right"><? if ($user["HabExp"] <= '7') { ?><table width="98%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="27%" height="45" align="right" bgcolor="#D6CCC7">Pasar los expedientes marcados a: </td>
            <td colspan="2" bgcolor="#D6CCC7">
			
			<select name ="destino" size="1">
			<option value="0" selected="selected">Seleccione un destino para el pase...</option>
			<option value="5000" selected="selected">ARCHIVO EN EL AREA</option>
		<?
		
		if($usuario_area == '63') {
			$sql5 = "SELECT * FROM dbo_area WHERE Area_nro != $usuario_area AND blnHab = '1' ORDER BY Area_codigo";
		}else{
			$sql5 = "SELECT * FROM dbo_area WHERE Direccion_nro != '99' AND Area_nro != $usuario_area AND blnHab = '1' ORDER BY Area_codigo";
		}
		 
		 $res5 = mysql_query($sql5);
		 
		 while ($destino = mysql_fetch_array($res5)) { ?>
              <option value="<?=$destino["Area_nro"]; ?>"><?=$destino["Area_codigo"]; ?> - <?=$destino["Area_nombre"]; ?></option>
		<? } ?>
            </select>			</td>
            <td width="14%" bgcolor="#D6CCC7">
			<input type="hidden" name="idUsuario" value="<?=$log_usuario; ?>" />
			<input type="hidden" name="origen" value="<?=$usuario_area; ?>" />
			<input type="hidden" name="reingreso" value="0" />			</td>
          </tr>
          <tr>
            <td height="45" align="right" valign="top" bgcolor="#D6CCC7">Observaciones sobre el pase: </td>
            <td width="43%" bgcolor="#D6CCC7"><textarea name="pase_observaciones" cols="50" rows="2"></textarea></td>
            <td width="16%" bgcolor="#D6CCC7"><input type="submit" name="Submit" value="Pasar expedientes" /></td>
            <td bgcolor="#D6CCC7">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" bgcolor="#D6CCC7">&nbsp;</td>
            <td bgcolor="#D6CCC7">&nbsp;</td>
            <td bgcolor="#D6CCC7">&nbsp;</td>
            <td bgcolor="#D6CCC7">&nbsp;</td>
          </tr>
        </table><? } ?></td>
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