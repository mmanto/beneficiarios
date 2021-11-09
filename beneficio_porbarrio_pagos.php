<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

mysql_select_db("MyTierras",$link);

$idBarrio = $_GET["idBarrio"];

//$lista = implode(',',$_POST['seleccion']);

$sql3 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre, Partido_nro FROM dbo_barrio WHERE Barrio_nro = $idBarrio",$link);
$barrio = mysql_fetch_array($sql3);
$barrio_nombre = $barrio["Barrio_nombre"];
$barrio_partido = $barrio["Partido_nro"];

$sql4 = mysql_query("SELECT * FROM dbo_partido WHERE Partido_nro = $barrio_partido",$link);
$partido = mysql_fetch_array($sql4);


$sql = "SELECT * FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = $idBarrio AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


$res = mysql_query($sql);

$cant = mysql_num_rows($res);



?><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="901"><h1>Informe de beneficiarios de tierras </h1></td>
  </tr>
  <tr>
    <td height="30" style="font-size:18px; font-weight:bold;">Partido: <?=$partido["Partido_nombre"]; ?> - Barrio: <? echo $barrio_nombre ?></td>
  </tr>
  <tr>
    <td>La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" valign="bottom"><a href="javascript:window.history.back()">Volver</a></td>
  </tr>
  <tr>
    <td height="28">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td height="25">
	<? if ($cant > 0) { ?>
	<table width="740" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="3%">&nbsp;</td>
          <td width="11%">&nbsp;</td>
          <td width="3%">&nbsp;</td>
          <td width="24%">&nbsp;</td>
          <td width="4%">&nbsp;</td>
          <td width="19%">&nbsp;</td>
          <td width="3%">&nbsp;</td>
          <td width="13%">&nbsp;</td>
          <td width="3%">&nbsp;</td>
          <td width="17%">&nbsp;</td>
        </tr>
      </table>
	<table width="900" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="37" height="30" align="center" class="titulo_dato">Mz. Prov.</td>
	  <td width="32" height="30" align="center" class="titulo_dato">Mz. Def</td>
	  <td width="29" align="center" class="titulo_dato">Pc.</td>
      <td width="435" class="titulo_dato"><p>Apellido, nombre y documento | Pago registrado | saldo</p></td>
      </tr>
      
      
      
  <?


while ($familia = mysql_fetch_array($res)) {

$lote_circ = $familia["Lote_circunscripcion"];
if($familia["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $familia["Lote_seccion"];}
if($familia["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $familia["Lote_chacra"];}
if($familia["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $familia["Lote_quinta"];}
if($familia["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $familia["Lote_fraccion"];}
$manzana_prov = $familia["Lote_manzana_prov"];
if ($manzana_prov == '0') { $manzana_prov = '-'; }
$manzana = $familia["Lote_manzana"];
$parcela = $familia["Lote_parcela"];
$familia_montoadj = $familia["Familia_montoadj"];
$familia_monto_actualizacion = $familia["Familia_monto_actualizacion"];


$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND Persona_baja = '0' AND blnActivo = '1'",$link);


?>
      <tr>
        <td align="center"><? echo $manzana_prov; ?></td>
		<td align="center"><? echo $manzana; ?></td>
      <td align="center"><? echo $parcela; ?></td>
      <td align="center"><table width="99%" border="0" cellspacing="0" cellpadding="1">
        <? while ($persona = mysql_fetch_array($sql2)){
		$persona_nro = $persona["Persona_nro"];	
		 ?>
        <tr>
          <td width="35%"><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
          <td width="15%"><? echo $persona["Persona_dni_nro"]; ?></td>
          <td width="50%">
            <?
		  $sql5 = "SELECT * FROM dbo_tarjeta WHERE Persona_nro = $persona_nro AND blnActivo = '1'";
$res5 = mysql_query($sql5);

if (mysql_num_rows($res5) != '0') {
$tarjeta = mysql_fetch_array($res5);
 ?>
 Monto adj: $ <?=$familia_montoadj; ?> | Pago: $ <?=$tarjeta["Tarjeta_monto_pago"]; ?> | <strong>Saldo: $
<?
				if($familia_monto_actualizacion!= '0') {
				$saldo = $english_format_number = number_format($familia_monto_actualizacion-$tarjeta["Tarjeta_monto_pago"], 2, '.', '');
				}else{
		  $saldo = $english_format_number = number_format($familia_montoadj -$tarjeta["Tarjeta_monto_pago"], 2, '.', ''); }
		   echo $saldo; ?>
            
            &nbsp;<? } ?>
 </strong></td>
          </tr>
        <? } ?>
      </table>	</td>
      </tr>
  <?
}
?>
    </table>
	<? } ?></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
  </tr>
</table>
<? include "pie.php"; ?>