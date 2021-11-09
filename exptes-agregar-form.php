<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: menu.php");
    
} else{

$idExpte = $_GET["idExpte"];

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


$sql = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_nro = $idExpte AND blnActivo = '1' ORDER BY $orden",$link);
$exptePadre = mysql_fetch_array($sql);

$sql3 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_ubicacion_area = '$usuario_area' AND Expte_nro != $idExpte AND Expte_padre = '0' AND blnActivo = '1' ORDER BY $orden",$link);

$cant = mysql_num_rows($sql3);

$res76 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_padre = $idExpte");
$cant76 = mysql_num_rows($res76);

?>
<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h1>Agregar o desglosar del expediente <?=$exptePadre["Expte_caract"]; ?>-<?=$exptePadre["Expte_partido"];?>-<?=$exptePadre["Expte_rnrd"];?>-<?=$exptePadre["Expte_num"];?>/<?=$exptePadre["Expte_anio"];?> Alc. <?=$exptePadre["Expte_alcance"];?></h1></td>
  </tr>
  <tr>
    <td width="778" height="6">Seleccione los expedientes que desea agregar al expediente indicado.</td>
    <td width="122">&nbsp;</td>
  </tr>
  <tr>
    <td height="36" colspan="2" valign="middle"><a href="exptes-listar-area.php">[Volver al menu]</a></td>
  </tr>
  <tr>
    <td height="12" colspan="2" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="12" colspan="2" valign="bottom">
<? 
if($cant76 != 0) { ?>     
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
        <td width="4%" height="28" bgcolor="#EBF1F1">&nbsp;</td>
        <td width="36%" valign="bottom" bgcolor="#EBF1F1">El presente expediente tiene agregados los siguientes:</td>
        <td width="22%" bgcolor="#EBF1F1">&nbsp;</td>
        <td width="38%" bgcolor="#EBF1F1">&nbsp;</td>
      </tr>
<?
while ($expteAgr = mysql_fetch_array($res76)) { ?>      
      <tr>
        <td bgcolor="#EBF1F1">&nbsp;</td>
        <td height="24" bgcolor="#EBF1F1">&nbsp;</td>
        <td bgcolor="#EBF1F1"><strong><? echo $expteAgr["Expte_caract"];
if($expteAgr["Expte_partido"] != '0') { echo "-".$expteAgr["Expte_partido"]; }
if($expteAgr["Expte_rnrd"] != '0') { echo "-".$expteAgr["Expte_rnrd"]; }
echo "-".$expteAgr["Expte_num"]."/".$expteAgr["Expte_anio"]." Alc. ".$expteAgr["Expte_alcance"]; ?></strong></td>
        <td bgcolor="#EBF1F1"><a href="expte-desglosar.php?idExpte=<?=$expteAgr["Expte_nro"]; ?>&idPadre=<?=$idExpte; ?>">[Desglosar expediente]</a></td>
      </tr>
<? } ?>      
      <tr>
        <td bgcolor="#EBF1F1">&nbsp;</td>
        <td bgcolor="#EBF1F1">&nbsp;</td>
        <td bgcolor="#EBF1F1">&nbsp;</td>
        <td bgcolor="#EBF1F1">&nbsp;</td>
      </tr>

</table><? } ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="12" colspan="2" align="center" valign="bottom"><h1>AGREGAR EXPEDIENTES</h1></td>
  </tr>
  <tr>
    <td height="25" colspan="2">
	<form method="post" action="exptes-agregar.php">
	<table width="900" border="0" cellpadding="4" cellspacing="5">
      <tr>
        <td width="50" height="24" align="center" bgcolor="#CADFE6" class="titulo_dato">Caract.</td>
		  <td width="29" align="center" bgcolor="#CADFE6" class="titulo_dato">Pdo.</td>
		  <td width="43" align="center" bgcolor="#CADFE6" class="titulo_dato">RNRD</td>
		  <td width="53" align="center" bgcolor="#CADFE6" class="titulo_dato">N&uacute;mero</td>
		  <td width="29" align="center" bgcolor="#CADFE6" class="titulo_dato">A&ntilde;o</td>
          <td width="25" align="center" bgcolor="#CADFE6" class="titulo_dato">Alc.</td>
          <td width="37" align="center" bgcolor="#CADFE6" class="titulo_dato">Cpos.</td>
          <td width="410" align="center" bgcolor="#CADFE6" class="titulo_dato">Extracto</td>
          <td align="center" bgcolor="#CADFE6" class="titulo_dato">Acciones</td>
          <td align="center" bgcolor="#CADFE6"><input type="checkbox" onclick="marcar(this);" /></td>
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
	
$extracto_res = substr($expte["Expte_extracto"], 0,60); 

$expte_fojas = $expte["Expte_fojas"];

$expte_cuerpos_cant = $expte["Expte_cuerpos_cant"];

$expte_area = $expte["Expte_ubicacion_area"];

?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#EFF8FA\""; }else{ echo "bgcolor=\"#DEF2F5\"";} ?>>
        <td align="center" ><?=$expte_caract; ?></td>
		  <td align="center"><?=$expte_partido; ?></td>
		  <td align="center"><?=$expte_rnrd; ?></td>
		  <td align="center"><?=$expte_num; ?></td>
		  <td align="center"><?=$expte_anio ?></td>		
          <td align="center"><?=$expte_alcance; ?>&nbsp;</td>
          <td align="center" ><?=$expte_cuerpos_cant; ?>&nbsp;</td>
          <td align="center" ><?=$extracto_res;  ?>[...]&nbsp;</td>
          <td align="center" ><a href=javascript:ventana_imprimir('expte-informe.php?idExpte=<?=$expte_nro; ?>')><img src="imagen/doc.png" alt="Ver informe expte." width="11" height="16" border="0" title="Ver detalles del expediente"/></a></td>
          <td width="33" align="center"><? if ($user["p606"] == '1') { ?> <input type="checkbox" name="seleccion[]" value="<?=$expte["Expte_nro"]; ?>" /><? }else{ ?> - <? } ?></td>
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
	</tr>
	  <tr>
	    <td colspan="10" align="right"><? if ($user["HabExp"] <= '4') { ?><table width="98%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td height="45" colspan="3" align="center" bgcolor="#CADFE6"><h2>Agregar seleccionados al expediente </h2></td>
            <td width="14%" bgcolor="#CADFE6">
			<input type="hidden" name="idUsuario" value="<?=$log_usuario; ?>" />
            <input type="hidden" name="exptePadre" value="<?=$exptePadre["Expte_nro"]; ?>" />
			</td>
          </tr>
          <tr>
            <td width="27%" height="45" align="right" valign="top" bgcolor="#CADFE6">&nbsp;</td>
            <td width="41%" bgcolor="#CADFE6">&nbsp;</td>
            <td colspan="2" bgcolor="#CADFE6"><input name="Submit" type="submit" id="Submit" value="Agregar expedientes" /></td>
            </tr>
          <tr>
            <td align="right" bgcolor="#CADFE6">&nbsp;</td>
            <td bgcolor="#CADFE6">&nbsp;</td>
            <td width="18%" bgcolor="#CADFE6">&nbsp;</td>
            <td bgcolor="#CADFE6">&nbsp;</td>
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