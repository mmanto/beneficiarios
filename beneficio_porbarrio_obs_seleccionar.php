<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

$noback = '1';

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$idDireccion = $user["Direccion_nro"];
$idNivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

//mysql_select_db("MyTierras",$link);



$idBarrio = $_GET["idBarrio"];

$criterio = $_GET["criterio"];

$origen = $_GET["origen"];

$sql3 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre, Partido_nro FROM dbo_barrio WHERE Barrio_nro = $idBarrio",$link);
$barrio = mysql_fetch_array($sql3);
$barrio_nombre = $barrio["Barrio_nombre"];
$barrio_partido = $barrio["Partido_nro"];

$sql567 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_esc = '1' ORDER BY Expte_nro DESC",$link);

$sql789 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre,
Partido_nombre
FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) ORDER BY Partido_nombre ASC",$link);


$sql4 = mysql_query("SELECT * FROM dbo_partido WHERE Partido_nro = $barrio_partido",$link);
$partido = mysql_fetch_array($sql4);

if ($criterio == '1') {

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, blnBoleto, Boleto_fecha
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Familia_matricula != '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '2') {

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Expte_esc_nro != '0' AND Familia_matricula = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


}elseif ($criterio == '3'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Familia_cond_escrit = '1' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '5'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Adjudicacion_pendiente = '1' AND Expte_esc_nro = '0' AND Familia_doc_completa = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '6'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Familia_pagocancelado = '1' AND Expte_esc_nro = '0' AND Familia_doc_completa = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '7'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente,  Boleto_fecha
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Familia_censo_ausente = '1' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '8'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Familia_tarjeta_solicitar = '1' AND Expte_esc_nro = '0' AND Familia_doc_completa = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '9'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '10'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, blnBoleto, Boleto_fecha
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Expte_esc_nro = '0' AND blnBoleto = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


}elseif ($criterio == '4'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Adjudicacion_pendiente = '1'  AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '11'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Adjudicacion_pendiente = '1' AND Familia_doc_completa = '0' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '12'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Familia_res_adj != '0' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


}else{	
	

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_tarjeta_solicitar, Familia_censo_ausente, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, blnBoleto, Boleto_fecha FROM dbo_familia where Barrio_nro = '$idBarrio' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";
}

$res = mysql_query($sql);

$cant = mysql_num_rows($res);

/*
$nombre_archivo = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
//verificamos si en la ruta nos han indicado el directorio en el que se encuentra
if ( strpos($nombre_archivo, '/') !== FALSE )
    //de ser asi, lo eliminamos, y solamente nos quedamos con el nombre y su extension
    $nombre_archivo = array_pop(explode('/', $nombre_archivo));
*/

?>
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><h1>Seleccione los beneficios que desea incluir en el informe</h1></td>
  </tr>
  <tr>
    <td height="30" colspan="4" style="font-size:18px; font-weight:bold;">Partido: <?=$partido["Partido_nombre"]; ?> - Barrio: <? echo $barrio_nombre ?></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="24" colspan="4" valign="bottom"><a href="beneficio_porbarrio_listar.php?idBarrio=<?=$idBarrio; ?>&criterio=<?=$criterio; ?>">Volver</a></td>
  </tr>
  <tr>
    <td height="8" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="84" height="8">Mostrando:</td>
    <td width="221"><form><select name="ListeUrl" onChange="ChangeUrl(this.form)">
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=0" <? if ($criterio == '0') { ?> selected="selected" <? } ?>>Todos</option>      
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=7" <? if ($criterio == '7') { ?> selected="selected" <? } ?>>Ausente en censo</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=8" <? if ($criterio == '8') { ?> selected="selected" <? } ?>>Solicitar tarjeta</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=4" <? if ($criterio == '4') { ?> selected="selected" <? } ?>>Adjudicaci&oacute;n pendiente</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=11" <? if ($criterio == '11') { ?> selected="selected" <? } ?>>Adjudicaci&oacute;n pendiente + adeuda docum.</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=5" <? if ($criterio == '5') { ?> selected="selected" <? } ?>>En condiciones de adjudicar</option>      
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=9" <? if ($criterio == '9') { ?> selected="selected" <? } ?>>Sin gesti&oacute;n escrituraria</option> 
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=6" <? if ($criterio == '6') { ?> selected="selected" <? } ?>>Con pago cancelado</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=10" <? if ($criterio == '10') { ?> selected="selected" <? } ?>>Con boleto de compraventa</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=12" <? if ($criterio == '12') { ?> selected="selected" <? } ?>>En condiciones de escriturar</option> 
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=3" <? if ($criterio == '3') { ?> selected="selected" <? } ?>>En gesti&oacute;n escrituraria</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=2" <? if ($criterio == '2') { ?> selected="selected" <? } ?>>En tr&aacute;mite de escrituraci&oacute;n</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=1" <? if ($criterio == '1') { ?> selected="selected" <? } ?>>Escriturados</option>      
    </select>
    </form>    </td>
    <td width="139"><strong>(
      <?=$cant; ?> 
    resultados) </strong></td>
    <td width="642"><table width="250" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="28" align="center">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="28" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"></td>
  </tr>
  <tr>
    <td height="25" colspan="4">
	<? if ($cant > 0) { ?>
	<form method="post" action="beneficio_porbarrio_obs.php">	  
	  <table width="900" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="33" height="30" align="center" class="titulo_dato">Mz.</td>
      <td width="30" align="center" class="titulo_dato">Pc.</td>
      <td width="306" class="titulo_dato">Apellido, nombre y documento </td>
      <td width="147" align="center" class="titulo_dato">Resoluci&oacute;n</td>
      <td width="138" align="center" class="titulo_dato">Fecha boleto</td>
      <td width="164" align="center" class="titulo_dato">Alta por </td>
      <td width="24" align="center" class="titulo_dato"><input type="checkbox" onclick="marcar(this);" /></td>
      </tr>
      
      
      
  <?


while ($familia = mysql_fetch_array($res)) {

$lote_circ = $familia["Lote_circunscripcion"];
if($familia["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $familia["Lote_seccion"];}
if($familia["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $familia["Lote_chacra"];}
if($familia["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $familia["Lote_quinta"];}
if($familia["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $familia["Lote_fraccion"];}
$manzana = $familia["Lote_manzana"];
$parcela = $familia["Lote_parcela"];


$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_dni_nro, Persona_baja, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND blnActivo = '1'",$link);
?>
      <tr>
        <td align="center"><? echo $manzana; ?></td>
      <td align="center"><? echo $parcela; ?></td>
      <td align="center"><table width="98%" border="0" cellspacing="0" cellpadding="1">
        <? while ($persona = mysql_fetch_array($sql2)){ ?>
        <tr>
          <td width="82%" <? if($persona["Persona_baja"]=='1'){ ?>bgcolor="#FFCCCC"<? } ?>><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
          <td width="18%" <? if($persona["Persona_baja"]=='1'){ ?>bgcolor="#FFCCCC"<? } ?>><? echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?></td>
        </tr>
        <? } ?>
        </table>	</td>
      <td align="center" valign="middle"><?=$familia["Familia_res_adj"] ?></td>
      <td align="center"><?	   if($familia["Boleto_fecha"] == '0'){ echo "S/D"; }else{ echo $familia["Boleto_fecha"]; } ?></td>
      <td align="center"><?=$familia["Nombre"] ?></td>
      <td align="center"><input type="checkbox" name="seleccion[]" value="<?=$familia["Familia_nro"]; ?>" /></td>
      </tr>
  <?
}
?><tr>
    <td colspan="6" align="right">Marcar/desmarcar todos </td><td align="center"><input type="checkbox" onclick="marcar(this);" /></td></tr>
    </table>
	<table width="900" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td height="60" colspan="2" align="right" valign="bottom"><input type="hidden" name="idBarrio" value="<?=$idBarrio; ?>" /><input type="submit" name="button" id="button" value="Generar informe con observaciones" /></td>
  </tr>
  <tr>
    <td width="21">&nbsp;</td>
    <td width="691" align="right">&nbsp;</td>
  </tr>
</table>
	 </form>
	<? } ?></td>
  </tr>
  <tr>
    <td height="25" colspan="4">&nbsp;</td>
  </tr>
</table>
<? } ?>
<? include "pie.php"; ?>
