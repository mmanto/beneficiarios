<?
$noback = '1';

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idPartido = $_GET["idPartido"];

mysql_select_db("MyTierras",$link);

/////////// NUEVO ///////////

$blnEsc = $_GET["blnEsc"];

if($_GET["blnEsc"] == '1') {

$sql = "SELECT DISTINCT (Lote_manzana), Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion FROM dbo_familia WHERE Familia_matricula != '0' AND Partido_nro = $idPartido AND blnActivo = '1' ORDER BY Lote_circunscripcion ASC, Lote_seccion ASC, Lote_chacra ASC, Lote_quinta ASC, Lote_fraccion ASC, Lote_manzana ASC";

}else{

$sql = "SELECT DISTINCT (Lote_manzana), Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion FROM dbo_familia WHERE Partido_nro = $idPartido AND blnActivo = '1' ORDER BY Lote_circunscripcion ASC, Lote_seccion ASC, Lote_chacra ASC, Lote_quinta ASC, Lote_fraccion ASC, Lote_manzana ASC";

}

$res = mysql_query($sql);
$cant = mysql_num_rows($res);

/////////////////////////////


$sql3 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido",$link); 

$partido = mysql_fetch_array($sql3);

$partido_nombre = $partido["Partido_nombre"];

if ($cant < 1) {echo "<h2>No hay registros para mostrar</h2><p><a href=\"javascript:history.go(-1)\">Volver</a></p><p>&nbsp;</p>";}else{

?><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Beneficios en <? echo $partido_nombre ?></h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="benef_buscar_nomenc_form.php">Volver</a></td>
  </tr>
  <tr>
    <td height="16" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="right">&nbsp;</td>
  </tr>
  <tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td><table width="376" border="1" cellspacing="0" cellpadding="3">
  <tr>
    <td width="33" height="30" align="center" class="titulo_dato">Circ.</td>
    <td width="35" align="center" class="titulo_dato">Secc.</td>
    <td width="33" align="center" class="titulo_dato">Ch.</td>
    <td width="37" align="center" class="titulo_dato">Qta.</td>
    <td width="42" align="center" class="titulo_dato">Fracc.</td>
    <td width="36" align="center" class="titulo_dato">Mz.</td>
    <td width="102" align="center" class="titulo_dato">Acciones</td>
  </tr>



<?


while ($lote = mysql_fetch_array($res)) {

$loteNum = $lote["Lote_nro"];

//
//Lote


$lote_circ = $lote["Lote_circunscripcion"];
$lote_secc = $lote["Lote_seccion"];
$lote_ch = $lote["Lote_chacra"];
$lote_qta = $lote["Lote_quinta"];
$lote_fr = $lote["Lote_fraccion"];
$manzana = $lote["Lote_manzana"];
//


?>
  <tr>
    <td align="center"><? echo $lote_circ; ?></td>
    <td align="center"><? if ($lote_secc == '0') { echo "-"; }else{ echo $lote_secc;} ?></td>
    <td align="center"><? if ($lote_ch == '0') { echo "-"; }else{ echo $lote_ch;} ?></td>
    <td align="center"><? if ($lote_qta == '0') { echo "-"; }else{ echo $lote_qta;} ?></td>
    <td align="center"><? if ($lote_fr == '0') { echo "-"; }else{ echo $lote_fr;} ?></td>
    <td align="center"><? echo $manzana; ?></td>
    <td align="center"><a href="esc_partido_listar.php?partido=<?=$idPartido; ?>&circunscripcion=<?=$lote_circ; ?>&seccion=<?=$lote_secc; ?>&chacra=<?=$lote_ch; ?>&manzana=<?=$manzana; ?>&blnEsc=<?=$blnEsc; ?>">Ver beneficios</a></td>
  </tr>
<?
}
?></table></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td><? echo $_GET["blnEsc"]; ?>&nbsp;</td>
  </tr>
</table>
<? }

include "pie.php"; ?>
