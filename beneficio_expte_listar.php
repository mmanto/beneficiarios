<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$expte_nro = $_GET["expte"];

mysql_select_db("MyTierras",$link);
$sql = "SELECT * FROM dbo_familia where Expte_esc_nro = '$expte_nro' AND blnActivo = '1' ORDER BY Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_manzana, Lote_parcela ASC";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);


$sql3 = mysql_query("SELECT * FROM dbo_expte_esc WHERE Expte_nro = $expte_nro",$link);

$expte = mysql_fetch_array($sql3);

$exptenum = $expte["Expte_num"];
$expte_caract = $expte["Expte_caract"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];

if ($cant < 1) {echo "<h2>No hay registros para este expediente</h2><p><a href=\"javascript:history.go(-1)\">Volver</a></p><p>&nbsp;</p>";}else{

?><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Informe de beneficiarios de tierras </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="javascript:history.go(-1)">Volver</a></td>
  </tr>
  <tr>
    <td height="16" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2" bgcolor="#F0F0F0"><h3><strong class="titulodato">Expediente N&ordm; <? echo $expte_caract; ?>-<? echo $exptenum; ?>/<? echo $expte_anio_res; ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> <? if ($expte_cuerpo != '0') {echo "Cpo ".$expte_cuerpo; }else{ echo " "; } ?></strong></h3></td>
  </tr>
  <tr>
    <td width="13" rowspan="3">&nbsp;</td>
    <td width="563" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">Cantidad de beneficios: <?=$cant; ?></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td><table width="882" border="1" cellspacing="0" cellpadding="3">
  <tr>
    <td width="33" height="30" class="titulo_dato">Circ.</td>
    <td width="38" class="titulo_dato">Secc.</td>
    <td width="34" align="center" class="titulo_dato">Ch.</td>
    <td width="42" align="center" class="titulo_dato">Qta.</td>
    <td width="43" align="center" class="titulo_dato">Fr.</td>
    <td width="52" align="center" class="titulo_dato">Mz.</td>
    <td width="36" align="center" class="titulo_dato">Pc.</td>
    <td width="303" class="titulo_dato">Apellido, nombre y documento </td>
    <td width="60" class="titulo_dato">Res. Adj. </td>
    <td width="71" class="titulo_dato">Matricula</td>
    <td width="80" align="center" class="titulo_dato">Acciones</td>
  </tr>



<?


while ($familia = mysql_fetch_array($res)) {


//Lote


$lote_circ = $familia["Lote_circunscripcion"];
if($familia["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $familia["Lote_seccion"];}
if($familia["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $familia["Lote_chacra"];}
if($familia["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $familia["Lote_quinta"];}
if($familia["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $familia["Lote_fraccion"];}
$manzana = $familia["Lote_manzana"];
$parcela = $familia["Lote_parcela"];
//

$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND Persona_baja = '0' AND blnActivo = '1'",$link);
?>
  <tr>
    <td align="center"><? echo $lote_circ; ?></td>
    <td align="center"><? echo $lote_secc; ?></td>
    <td align="center"><? echo $lote_ch; ?></td>
    <td align="center"><? echo $lote_qta; ?></td>
    <td align="center"><? echo $lote_fr; ?></td>
    <td align="center"><? echo $manzana; ?></td>
    <td align="center"><? echo $parcela; ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <? while ($persona = mysql_fetch_array($sql2)){ ?>
	  <tr>
        <td width="76%"><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
        <td width="24%"><? echo $persona["Persona_dni_nro"]; ?></td>
      </tr>
	  <? } ?>
    </table>	</td>
    <td align="center"><? echo $familia["Familia_res_adj"] ?></td>
    <td align="center"><? echo $familia["Familia_matricula"] ?></td>
    <td align="center"><a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$familia["Familia_nro"]; ?>')>Informe</a></td>
  </tr><? } ?>
</table></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<? 
}
include "pie.php"; ?>
