<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idPartido = $_GET["partido"];

$circ = $_GET["circunscripcion"];

$seccion = $_GET["seccion"];

$chacra = $_GET["chacra"];

$manzana = $_GET["manzana"];

$blnEsc = $_GET["blnEsc"];

mysql_select_db("MyTierras",$link);

/////////// NUEVO ///////////

if ($blnEsc == '1') {

$sql = "SELECT * FROM dbo_familia WHERE Partido_nro = $idPartido AND Lote_circunscripcion = '$circ' AND Lote_seccion = '$seccion' AND Lote_chacra = '$chacra' AND Lote_manzana = '$manzana' AND Familia_matricula != '0' AND blnActivo != '0' ORDER BY Lote_circunscripcion ASC, Lote_seccion ASC, Lote_chacra ASC, Lote_quinta ASC, Lote_fraccion ASC, Lote_manzana ASC, Lote_parcela ASC, Lote_subparcela ASC";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);

}else{

$sql = "SELECT * FROM  dbo_familia WHERE Partido_nro = $idPartido AND Lote_circunscripcion = '$circ' AND Lote_seccion = '$seccion' AND Lote_chacra = '$chacra' AND Lote_manzana = '$manzana' AND blnActivo != '0'  ORDER BY Lote_circunscripcion ASC, Lote_seccion ASC, Lote_chacra ASC, Lote_quinta ASC, Lote_fraccion ASC, Lote_manzana ASC, Lote_parcela ASC, Lote_subparcela ASC";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);

}

/////////////////////////////|


$sql3 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido",$link); 

$partido = mysql_fetch_array($sql3);

$partido_nombre = $partido["Partido_nombre"];

if ($cant < 1) {echo "<h2>No hay registros | ".$cant."</h2><p><a href=\"javascript:history.go(-1)\">Volver</a></p><p>&nbsp;</p>";}else{

?><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Beneficios  en <? echo $partido_nombre ?> (Manzana <?=$manzana; ?>) </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="javascript:history.go(-1)"></a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2"><table width="700" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="36" height="30" align="center" class="titulo_dato">Circ.</td>
      <td width="45" align="center" class="titulo_dato">Secc.</td>
      <td width="26" align="center" class="titulo_dato">Ch.</td>
      <td width="39" align="center" class="titulo_dato">Qta.</td>
      <td width="51" align="center" class="titulo_dato">Fracc.</td>
      <td width="39" align="center" class="titulo_dato">Mz.</td>
      <td width="41" align="center" class="titulo_dato">Pc.</td>
      <td width="79" align="center" class="titulo_dato">Matricula</td>
      <td width="270" class="titulo_dato">Apellido, nombre y documento </td>
      </tr>
      
      
      
  <?


while ($familia = mysql_fetch_array($res)) {

$lote_circ = $familia["Lote_circunscripcion"];
$lote_secc = $familia["Lote_seccion"];
$lote_ch = $familia["Lote_chacra"];
$lote_qta = $familia["Lote_quinta"];
$lote_fr = $familia["Lote_fraccion"];
$manzana = $familia["Lote_manzana"];
$parcela = $familia["Lote_parcela"];
$matricula = $familia["Familia_matricula"];


$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_nombre_completo, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND Persona_baja = '0' AND blnActivo = '1'",$link);
?>
      <tr>
        <td align="center"><? if ($lote_circ == '0') { echo "-"; }else{ echo $lote_circ;} ?></td>
      <td align="center"><? if ($lote_secc == '0') { echo "-"; }else{ echo $lote_secc;} ?></td>
      <td align="center"><? if ($lote_ch == '0') { echo "-"; }else{ echo $lote_ch;} ?></td>
      <td align="center"><? if ($lote_qta == '0') { echo "-"; }else{ echo $lote_qta;} ?></td>
      <td align="center"><? if ($lote_fr == '0') { echo "-"; }else{ echo $lote_fr;} ?></td>
      <td align="center"><? echo $manzana; ?></td>
      <td align="center"><? echo $parcela; ?></td>
      <td align="center"><? echo $matricula; ?></td>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <? while ($persona = mysql_fetch_array($sql2)){ ?>
        <tr>
          <td width="78%"><? echo $persona["Persona_apellido"]." ".$persona["Persona_nombre"]; ?><? echo $persona["Persona_nombre_completo"]; ?></td>
          <td width="22%"><strong><? echo $persona["Persona_dni_nro"]; ?></strong></td>
        </tr>
        <? } ?>
        </table>	</td>
      </tr>
  <?
}
?>
    </table></td>
  </tr>
  <tr>
    <td width="13" height="25">&nbsp;</td>
    <td width="563">&nbsp;</td>
  </tr>
</table>
<?  } 

include "pie.php"; ?>
