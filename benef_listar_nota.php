<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idPartido = $_GET["partido"];

$circ = $_GET["circunscripcion"];

$seccion = $_GET["seccion"];

$chacra = $_GET["chacra"];

$manzana = $_GET["manzana"];

//$quinta = $_GET["quinta"];



mysql_select_db("MyTierras",$link);

/////////// NUEVO ///////////|

$sql = "SELECT * FROM dbo_lote WHERE Partido_nro = $idPartido AND Lote_circunscripcion = '$circ' AND Lote_seccion = '$seccion' AND Lote_chacra = '$chacra' AND blnActivo != '0' ORDER BY Lote_manzana ASC, Lote_parcela ASC, Lote_subparcela ASC";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);


/*
$sql = "SELECT * FROM dbo_lote WHERE Partido_nro = $idPartido AND Lote_circunscripcion = '$circ' AND Lote_seccion = '$seccion' AND Lote_chacra = '$chacra' AND Lote_manzana = '$manzana' ORDER BY Lote_circunscripcion ASC, Lote_seccion ASC, Lote_chacra ASC, Lote_quinta ASC, Lote_fraccion ASC, Lote_manzana ASC, Lote_parcela ASC, Lote_subparcela ASC";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);
*/
/////////////////////////////|


$sql3 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido",$link); 

$partido = mysql_fetch_array($sql3);

$partido_nombre = $partido["Partido_nombre"];

if ($cant < 1) {echo "<h2>No hay registros</h2><p><a href=\"javascript:history.go(-1)\">Volver</a></p><p>&nbsp;</p>";}else{

?><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Listado beneficiarios en <? echo $partido_nombre ?> (Chacra <?=$chacra; ?>) </h2></td>
  </tr>
  <tr>
    <td width="10">&nbsp;</td>
    <td width="713" align="right">&nbsp;</td>
  </tr><tr>
    <td height="25">&nbsp;</td>
    <td><table width="710" border="1" cellspacing="0" cellpadding="3">
  <tr>
    <td width="46" height="30" align="center" class="titulo_dato">Mz.</td>
    <td width="41" align="center" class="titulo_dato">Pc.</td>
    <td width="338" class="titulo_dato">Apellido, nombre y documento </td>
    <td width="63" align="center" class="titulo_dato">Docum.<br />
      Completa</td>
    <td width="180" align="center" class="titulo_dato">Observ.</td>
  </tr>



<?


while ($lote = mysql_fetch_array($res)) {

$loteNum = $lote["Lote_nro"];

$sql8 = "SELECT Familia_nro, Familia_apellido, Familia_doc_completa, Familia_observaciones
FROM dbo_familia where Lote_nro = $loteNum";
$res8 = mysql_query($sql8);
$familia = mysql_fetch_array ($res8);
//$usuario_alta = $familia["insert_usuario"];


/*
$sql9 = "SELECT * FROM dbo_usuarios WHERE idUsuario = $usuario_alta";
$res9 = mysql_query($sql9);
$useralta = mysql_fetch_array($sql9);
$user_alta = $useralta["Nombre"];
*/

//
//Lote


$lote_circ = $lote["Lote_circunscripcion"];
/*
if($lote["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $lote["Lote_seccion"];}
if($lote["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $lote["Lote_chacra"];}
if($lote["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $lote["Lote_quinta"];}
if($lote["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $lote["Lote_fraccion"];}
*/

$lote_secc = $lote["Lote_seccion"];
$lote_ch = $lote["Lote_chacra"];
$lote_qta = $lote["Lote_quinta"];
$lote_fr = $lote["Lote_fraccion"];
$manzana = $lote["Lote_manzana"];
$parcela = $lote["Lote_parcela"];
$matricula = $lote["Lote_matricula"];
//

$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_nombre_completo, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]}",$link);
?>
  <tr>
    <td align="center"><? echo $manzana; ?></td>
    <td align="center"><? echo $parcela; ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <? while ($persona = mysql_fetch_array($sql2)){ ?>
	  <tr>
        <td width="76%"><? echo $persona["Persona_apellido"]." ".$persona["Persona_nombre"]; ?><? echo $persona["Persona_nombre_completo"]; ?></td>
        <td width="24%" align="center"><strong><? echo $persona["Persona_dni_nro"]; ?></strong></td>
      </tr>
	  <? } ?>
    </table>	</td>
    <td align="center"><? if($familia["Familia_doc_completa"]=='1') {echo "SI";}else{echo "<strong>NO</strong>";} ?></td>
    <td align="center"><?=$familia["Familia_observaciones"]; ?></td>
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
