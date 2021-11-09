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

$sql = "SELECT * FROM dbo_familia WHERE Partido_nro = $idPartido AND Lote_circunscripcion = '$circ' AND Lote_seccion = '$seccion' AND Lote_chacra = '$chacra' AND Lote_manzana = '$manzana' AND blnActivo != '0'  ORDER BY Lote_circunscripcion ASC, Lote_seccion ASC, Lote_chacra ASC, Lote_quinta ASC, Lote_fraccion ASC, Lote_manzana ASC, Lote_parcela ASC, Lote_subparcela ASC";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);

}

/////////////////////////////|


$sql3 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $idPartido",$link); 

$partido = mysql_fetch_array($sql3);

$partido_nombre = $partido["Partido_nombre"];

if ($cant < 1) {echo "<h2>No hay registros</h2><p><a href=\"javascript:history.go(-1)\">Volver</a></p><p>&nbsp;</p>";}else{

?><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Beneficios  en <? echo $partido_nombre ?> (Manzana <?=$manzana; ?>) </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="javascript:history.go(-1)">Volver</a> | <a href="esc_partido_listar_imp.php?partido=<?=$idPartido; ?>&manzana=<?=$manzana; ?>" target="_blank">Versi&oacute;n para imprimir </a></td>
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
    <td><table width="780" border="1" cellspacing="0" cellpadding="3">
  <tr>
    <td width="30" height="30" align="center" class="titulo_dato">Circ.</td>
    <td width="34" align="center" class="titulo_dato">Secc.</td>
    <td width="24" align="center" class="titulo_dato">Ch.</td>
    <td width="33" align="center" class="titulo_dato">Qta.</td>
    <td width="41" align="center" class="titulo_dato">Fracc.</td>
    <td width="34" align="center" class="titulo_dato">Mz.</td>
    <td width="34" align="center" class="titulo_dato">Pc.</td>
    <td width="60" align="center" class="titulo_dato">Matricula</td>
    <td width="233" class="titulo_dato">Apellido, nombre y documento </td>
    <td width="91" align="center" class="titulo_dato">Alta por </td>
    <td width="76" align="center" class="titulo_dato">Acciones</td>
  </tr>



<?


while ($lote = mysql_fetch_array($res)) {

$loteNum = $lote["Lote_nro"];

$sql8 = "SELECT Familia_nro, Familia_apellido, Familia_matricula, Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion, Lote_manzana, Lote_parcela, insert_usuario, Nombre FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Lote_nro = $loteNum";
$res8 = mysql_query($sql8);
$familia = mysql_fetch_array ($res8);
$usuario_alta = $familia["insert_usuario"];

/*
$sql9 = "SELECT * FROM dbo_usuarios WHERE idUsuario = $usuario_alta";
$res9 = mysql_query($sql9);
$useralta = mysql_fetch_array($sql9);
$user_alta = $useralta["Nombre"];
*/

//
//Lote


$lote_circ = $familia["Lote_circunscripcion"];
/*
if($lote["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $lote["Lote_seccion"];}
if($lote["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $lote["Lote_chacra"];}
if($lote["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $lote["Lote_quinta"];}
if($lote["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $lote["Lote_fraccion"];}
*/

$lote_secc = $familia["Lote_seccion"];
$lote_ch = $familia["Lote_chacra"];
$lote_qta = $familia["Lote_quinta"];
$lote_fr = $familia["Lote_fraccion"];
$manzana = $familia["Lote_manzana"];
$parcela = $familia["Lote_parcela"];
$matricula = $familia["Familia_matricula"];
//

$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_nombre_completo, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]}",$link);
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
        <td width="76%"><? echo $persona["Persona_apellido"]." ".$persona["Persona_nombre"]; ?><? echo $persona["Persona_nombre_completo"]; ?></td>
        <td width="24%"><strong><? echo $persona["Persona_dni_nro"]; ?></strong></td>
      </tr>
	  <? } ?>
    </table>	</td>
    <td><?=$familia["Nombre"] ?>&nbsp;</td>
    <td align="center"><a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$familia["Familia_nro"]; ?>')>Ver informe</a></td>
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
