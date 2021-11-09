<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: menu.php");
    
} else{

include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$criterio = $_POST["criterio"];

$exptecaract = $_POST["exptecaract"];
$exptepart = $_POST["exptepart"];
$expternrd = $_POST["expternrd"];
$exptenum = $_POST["exptenum"];
$exptenum1 = $_POST["exptenum1"];
$expteanio = $_POST["expteanio"];
$exptealc = $_POST["exptealc"];

$extracto = $_POST["extracto"];

$extracto = "%".$extracto."%";

$orden = "Expte_caract ASC, Expte_num ASC, Expte_anio ASC, Expte_alcance ASC";

//Query búsqueda expedientes internos

if ($criterio == '1') {$res = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_caract = '$exptecaract' AND Expte_partido = '$exptepart' AND Expte_rnrd = '$expternrd' AND Expte_num = '$exptenum1' AND Expte_anio = '$expteanio' AND Expte_alcance = '$exptealc' AND Expte_ubicacion_direccion != '99' AND blnActivo = '1' ORDER BY $orden",$link);}


if ($criterio == '2') { $res = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_num = '$exptenum' AND Expte_ubicacion_direccion != '99' AND blnActivo = '1' ORDER BY $orden",$link);}

if ($criterio == '3') { $res = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_extracto LIKE '$extracto' AND Expte_ubicacion_direccion != '99' AND blnActivo = '1' ORDER BY $orden",$link);}

$cant = mysql_num_rows($res);

//Query búsqueda expedientes externos

if ($criterio == '1') {$res2 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_caract = '$exptecaract' AND Expte_partido = '$exptepart' AND Expte_rnrd = '$expternrd' AND Expte_num = '$exptenum1' AND Expte_anio = '$expteanio' AND Expte_alcance = '$exptealc' AND Expte_ubicacion_direccion = '99' AND blnActivo = '1' ORDER BY $orden",$link);}


if ($criterio == '2') { $res2 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_num = '$exptenum' AND Expte_ubicacion_direccion = '99' AND blnActivo = '1' ORDER BY $orden",$link);}

if ($criterio == '3') { $res2 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_extracto LIKE '$extracto' AND Expte_ubicacion_direccion = '99' AND blnActivo = '1' ORDER BY $orden",$link);}

$cant2 = mysql_num_rows($res2);

$cant_total = $cant+$cant2;






$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$idNivel = $log_nivel;
$usuario_nombre = $user["Nombre"];
$usuario_area = $user["Area_nro"];


if($cant_total < '1') { echo "<h2>No hay expedientes que coincidan con su b&uacute;squeda</h2>
<p><a href='expte-buscar.php'>Volver</a></p>
<p>&nbsp;</p>";

?><p>Criterio: <?=$criterio; ?> - Caract: <?=$exptecaract; ?> - Partido: <?=$exptepart; ?> - RNRD: <?=$expternrd; ?> - Numero: <?=$exptenum1; ?> - A&ntilde;o: <?=$expteanio; ?></p> <?
}else{
?>
<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="3"><h1>Expedientes que coinciden con su b&uacute;squeda  (cant: <?=$cant_total; ?>) </h1></td>
  </tr>
  <tr>
    <td width="778" height="6"> Para realizar un pase  seleccione los expedientes correspondientes, indique el &aacute;rea de destino y pulse el bot&oacute;n &quot;confirmar pase&quot;. Una vez efectuado el pase podr&aacute; imprimir el remito correspondiente a la operaci&oacute;n. Para buscar en pantalla un expediente presione la combinaci&oacute;n Ctrl+F. </td>
    <td width="61">&nbsp;</td>
    <td width="61">&nbsp;</td>
  </tr>
  <tr>
    <td height="36" colspan="3" valign="middle"><a href="expte-buscar.php">[Volver a la busqueda]</a></td>
  </tr>
  <tr>
    <td height="20" colspan="3" align="left" valign="middle">Caract: <?=$exptecaract; ?> - Partido: <?=$exptepart; ?> - RNRD: <?=$expternrd; ?> - Numero: <?=$exptenum1; ?> - A&ntilde;o: <?=$expteanio; ?> </td>
  </tr>
  <tr>
    <td height="20" colspan="3" align="left" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td height="6" colspan="3" valign="bottom"><h2>Expedientes dentro del organismo (Cant.: <?=$cant; ?>) </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="3" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="3">
	<form method="post" action="exptes-pase-confirm.php">
	<table width="900" border="0" cellpadding="4" cellspacing="5">
      <tr bgcolor="#CCCCCC">
        <td width="45" height="24" align="center" bgcolor="#E9CBAD" class="titulo_dato">Caract.</td>
		  <td width="36" align="center" bgcolor="#E9CBAD" class="titulo_dato">Pdo.</td>
		  <td width="43" align="center" bgcolor="#E9CBAD" class="titulo_dato">RNRD</td>
		  <td width="50" align="center" bgcolor="#E9CBAD" class="titulo_dato">N&uacute;mero</td>
		  <td width="45" align="center" bgcolor="#E9CBAD" class="titulo_dato">A&ntilde;o</td>
          <td width="38" align="center" bgcolor="#E9CBAD" class="titulo_dato">Alc.</td>
          <td width="38" align="center" bgcolor="#E9CBAD" class="titulo_dato">Cpos.</td>
          <td width="330" align="center" bgcolor="#E9CBAD" class="titulo_dato">Extracto</td>
          <td colspan="3" align="center" bgcolor="#E9CBAD" class="titulo_dato">Acciones</td>
          <td align="center" bgcolor="#E9CBAD">&nbsp;</td>
        </tr>
  <?
$num_fila = '1'; 

while ($expte = mysql_fetch_array($res)) {	

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

$expte_padre = $expte["Expte_padre"];

?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#EFDFC2\""; }else{ echo "bgcolor=\"#F4EAD5\"";} ?>>
        <td align="center" ><?=$expte_caract; ?></td>
		  <td align="center" ><?=$expte_partido; ?>&nbsp;</td>
		  <td align="center" ><?=$expte_rnrd; ?>&nbsp;</td>
		  <td align="center"><?=$expte_num; ?></td>
		  <td align="center"><?=$expte_anio ?></td>		
          <td align="center"><?=$expte_alcance; ?>&nbsp;</td>
          <td align="center" ><?=$expte_cuerpos_cant; ?>&nbsp;</td>
          <td align="center" ><?=$extracto_res;  ?>[...]&nbsp;<? if($expte_padre != '0') { echo "<strong>--Expediente agregado--</strong>"; } ?></td>
          <td width="26" align="center" ><a href=javascript:ventana_imprimir('expte-informe.php?idExpte=<?=$expte_nro; ?>')><img src="imagen/doc.png" alt="Ver informe expte." width="11" height="16" border="0" /></a></td>
          <td width="32" align="center" class="datos-center"><? if ($user["p603"] == '1')  { ?><a href=javascript:ventana_imprimir('expte-modif-form.php?idExpte=<?=$expte_nro; ?>') ><? } ?><img src="imagen/edit.png" alt="Editar expte." title="Editar expte." width="16" height="16" border="0" /></a></td>
          <td width="28" align="center" class="datos-center"> <? if ($user["p606"] == '1' && $expte_padre == '0')  { ?><a href="exptes-agregar-form.php?idExpte=<?=$expte_nro; ?>" ><img src="imagen/agregar.png" alt="Agregar/Desglosar a este expediente" title="Agregar/Desglosar a este expediente" width="16" height="16" border="0" /></a><? }else{ ?><img src="imagen/agregar-no.png" alt="Agregar/Desglosar a este expediente" title="Agregar/Desglosar a este expediente" width="16" height="16" border="0" /><? } ?>
          </td>
          <td width="28" align="center">		  
		  <? if (($user["p605"] == '1' && $expte_padre == '0' && $expte_area == $usuario_area) OR ($user["p608"] == '1')) { ?>
          <input type="checkbox" name="seleccion[]" value="<?=$expte["Expte_nro"]; ?>" /><? }else{ ?> - <? } ?>
          </td>
		</tr>
      
      <? 
	  $num_fila++; 	  
	  } ?>
	  <tr>
	  	<td colspan="3">&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td colspan="2">&nbsp;</td>
	  	<td>&nbsp;</td>
	</tr>
	  <tr>
	    <td colspan="12" align="right">
		<? if ($user["HabExp"] <= '7') { ?>
		<table width="98%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="27%" height="45" align="right" bgcolor="#D6CCC7">Pasar los expedientes marcados a: </td>
            <td colspan="2" bgcolor="#D6CCC7">
			
			<select name ="destino" size="1">
			<option value="0" selected="selected">Seleccione un destino para el pase...</option>
		<?		
		if($log_nivel <= '2') {
		$sql5 = "SELECT * FROM dbo_area WHERE blnHab = '1' ORDER BY Area_codigo";	
		}else{
			if($usuario_area == '63') {
			$sql5 = "SELECT * FROM dbo_area WHERE blnHab = '1' ORDER BY Area_codigo";
			}else{
			$sql5 = "SELECT * FROM dbo_area WHERE Direccion_nro != '99' AND Area_nro != $usuario_area AND blnHab = '1' ORDER BY Area_codigo";
			}
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
            <td width="43%" bgcolor="#D6CCC7"><textarea name="pase_observaciones" cols="50" rows="2" id="pase_observaciones"></textarea></td>
            <td width="16%" bgcolor="#D6CCC7"><input type="submit" name="Submit" value="Confirmar pase" /></td>
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
  <tr><td colspan="11">&nbsp;</td></tr>
<tr>
    <td colspan="11"><h2>Expedientes en otros organismos (Cant.: <?=$cant2; ?>)</h2></td>
  </tr>
  <tr>
    <td colspan="11">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="11"><form method="post" action="exptes-pase-confirm.php">
	<table width="900" border="0" cellpadding="4" cellspacing="5">
      <tr bgcolor=>
        <td width="45" height="24" align="center" bgcolor="#C0CBDE" class="titulo_dato">Caract.</td>
		  <td width="41" align="center" bgcolor="#C0CBDE" class="titulo_dato">Pdo.</td>
		  <td width="32" align="center" bgcolor="#C0CBDE" class="titulo_dato">RNRD</td>
		  <td width="60" align="center" bgcolor="#C0CBDE" class="titulo_dato">N&uacute;mero</td>
		  <td width="43" align="center" bgcolor="#C0CBDE" class="titulo_dato">A&ntilde;o</td>
          <td width="46" align="center" bgcolor="#C0CBDE" class="titulo_dato">Alc.</td>
          <td width="52" align="center" bgcolor="#C0CBDE" class="titulo_dato">Cuerpos</td>
          <td width="346" align="center" bgcolor="#C0CBDE" class="titulo_dato">Extracto</td>
          <td colspan="2" align="center" bgcolor="#C0CBDE" class="titulo_dato">Acciones</td>
          <td align="center" bgcolor="#C0CBDE">&nbsp;</td>
        </tr>
  <?
$num_fila = '1'; 

while ($expte2 = mysql_fetch_array($res2)) {	

$expte_nro = $expte2["Expte_nro"];
$expte_partido = $expte2["Expte_partido"];
$expte_rnrd = $expte2["Expte_rnrd"];
$expte_caract = $expte2["Expte_caract"];
$expte_num = $expte2["Expte_num"];
$expte_anio = $expte2["Expte_anio"];
$expte_alcance = $expte2["Expte_alcance"];
$expte_cuerpos = $expte2["Expte_cuerpos"];
$expte_fechamov = cambiaf_a_normal($expte2["Expte_fechamov"]);
	if ($expte_fechamov == '00/00/0000') {$expte_fechamov = " "; }
	
$extracto_res = substr($expte2["Expte_extracto"], 0,60); 

$expte_fojas = $expte2["Expte_fojas"];

$expte_cuerpos_cant = $expte2["Expte_cuerpos_cant"];

$expte_area = $expte2["Expte_ubicacion_area"];

$expte_padre = $expte2["Expte_padre"];

?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DFE4EE\""; }else{ echo "bgcolor=\"#BDC8DD\"";} ?>>
        <td align="center" ><?=$expte_caract; ?></td>
		  <td align="center" ><?=$expte_partido; ?></td>
		  <td align="center" ><?=$expte_rnrd; ?></td>
		  <td align="center"><?=$expte_num; ?></td>
		  <td align="center"><?=$expte_anio ?></td>		
          <td align="center"><?=$expte_alcance; ?>&nbsp;</td>
          <td align="center" ><?=$expte_cuerpos_cant; ?>&nbsp;</td>
          <td align="center" ><?=$extracto_res;  ?>[...]&nbsp;<? if($expte_padre != '0') { echo "<strong>--Expediente agregado--</strong>"; } ?> </td>
          <td width="29" align="center" ><a href="
		<? if (($idNivel < '4') or ($idNivel < '7' and $idDireccion == $familia["Direccion_nro"])) { ?>
		expte_informe.php?id=<? echo $expte_nro;
		}else{ ?>#<? } ?>"><a href=javascript:ventana_imprimir('expte-informe.php?idExpte=<?=$expte_nro; ?>')><img src="imagen/doc.png" alt="Ver informe expte." width="11" height="16" border="0" /></a></td>
          <td width="20" align="center" class="datos-center"><? if ($user["HabExp"] <= '5')  { ?><a href=javascript:ventana_imprimir('expte-modif-form.php?idExpte=<?=$expte_nro; ?>') ><? } ?><img src="imagen/edit.png" alt="Editar expte." title="Editar expte." width="16" height="16" border="0" /></a></td>
          <td width="38" align="center">		  
          
		  <? if ($user["p607"] == '1') { ?>         
          <input type="checkbox" name="seleccion[]" value="<?=$expte2["Expte_nro"]; ?>" /><? }else{ echo "-"; } ?>
		  
		  </td>
		</tr>
      
      <? 
	  $num_fila++; 	  
	  } ?>
	  <tr>
	  	<td colspan="3">&nbsp;</td>
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
	    <td colspan="11" align="right">
		<? if ($user["HabExp"] <= '3' || ($user["HabExp"] <= '5' && $user["Area_nro"] == '63')) { ?>
		<table width="98%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="27%" height="45" align="right" bgcolor="#DFE4EE">Pasar los expedientes marcados a: </td>
            <td colspan="2" bgcolor="#DFE4EE">
			<select name ="destino" size="1">
			<option value="63" selected="selected">Mesa de entradas SSTUyV</option>
		    </select> 
			(Reingreso	al	organismo)	</td>
            <td width="14%" bgcolor="#DFE4EE">
			<input type="hidden" name="idUsuario" value="<?=$log_usuario; ?>" />
			<input type="hidden" name="origen" value="<?=$expte_area; ?>" />
			<input type="hidden" name="reingreso" value="1" />			</td>
          </tr>
          <tr>
            <td height="45" align="right" valign="top" bgcolor="#DFE4EE">Observaciones sobre el pase: </td>
            <td width="43%" bgcolor="#DFE4EE"><textarea name="pase_observaciones" cols="50" rows="2" id="pase_observaciones"></textarea></td>
            <td colspan="2" bgcolor="#DFE4EE"><input type="submit" name="Submit" value="Confirmar reingreso" /></td>
            </tr>
          <tr>
            <td align="right" bgcolor="#DFE4EE">&nbsp;</td>
            <td bgcolor="#DFE4EE">&nbsp;</td>
            <td width="16%" bgcolor="#DFE4EE">&nbsp;</td>
            <td bgcolor="#DFE4EE">&nbsp;</td>
          </tr>
        </table>
		<? } ?></td>
	    </tr>
    </table>
    </form></td>
  </tr>
  <tr>
    <td colspan="11">&nbsp;</td>
  </tr>
</table>
<?  }
include("pie.php");

 } ?>	