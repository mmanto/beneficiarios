<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idPartido = $_POST["idPartido"];

mysql_select_db("MyTierras",$link);



$sql = "SELECT Familia_nro, Familia_apellido, Familia_res_adj, Lote_nro FROM dbo_familia where Partido_nro = '$idPartido' AND blnEscritura = '1' ORDER BY Familia_nro ASC";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);


$sql3 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido",$link); 

$partido = mysql_fetch_array($sql3);

$partido_nombre = $partido["Partido_nombre"];

if ($cant < 1) {echo "<h2>No hay registros para este barrio</h2><p><a href=\"javascript:history.go(-1)\">Volver</a></p><p>&nbsp;</p>";}else{

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
    <td height="25" colspan="2" bgcolor="#F0F0F0"><h3><strong class="titulodato">Partido: <? echo $partido_nombre ?></strong></h3></td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="right">&nbsp;</td>
  </tr>
  <tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td><table width="700" border="1" cellspacing="0" cellpadding="3">
  <tr>
    <td width="37" height="30" class="titulo_dato">Circ.</td>
    <td width="39" class="titulo_dato">Secc.</td>
    <td width="45" class="titulo_dato">Ch.</td>
    <td width="48" class="titulo_dato">Qta.</td>
    <td width="49" class="titulo_dato">Fracc.</td>
    <td width="43" class="titulo_dato">Mz.</td>
    <td width="41" class="titulo_dato">Pc.</td>
    <td width="322" class="titulo_dato">Apellido, nombre y documento </td>
    <td width="82" align="center" class="titulo_dato">Acciones</td>
  </tr>



<?


while ($familia = mysql_fetch_array($res)) {


//Lote

$sql3 = mysql_query("SELECT * FROM dbo_lote WHERE Lote_nro = {$familia["Lote_nro"]}",$link);
$lote = mysql_fetch_array($sql3);
$lote_circ = $lote["Lote_circunscripcion"];
if($lote["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $lote["Lote_seccion"];}
if($lote["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $lote["Lote_chacra"];}
if($lote["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $lote["Lote_quinta"];}
if($lote["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $lote["Lote_fraccion"];}
$manzana = $lote["Lote_manzana"];
$parcela = $lote["Lote_parcela"];
//

$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_nombre_completo, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]}",$link);
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
        <td width="76%"><? echo $persona["Persona_apellido"]." ".$persona["Persona_nombre"]; ?><? echo $persona["Persona_nombre_completo"]; ?></td>
        <td width="24%"><? echo $persona["Persona_dni_nro"]; ?></td>
      </tr>
	  <? } ?>
    </table>	</td>
    <td align="center"><a href="beneficio_informe.php?idFamilia=<?=$familia["Familia_nro"]; ?>">Ver informe</a></td>
  </tr>
<?
}
?></table></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<? }

include "pie.php"; ?>
