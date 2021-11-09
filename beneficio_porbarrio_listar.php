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
$barrio_conurb = $barrio ["Barrio_conurbano"];


$sql567 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_esc = '1' ORDER BY Expte_nro DESC",$link);

$sql652 = mysql_query("SELECT * FROM dbo_expte_reg WHERE blnActivo = '1' ORDER BY Expte_nro DESC",$link);

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

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, blnBoleto, Boleto_fecha, insert_tipo
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Familia_matricula != '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '2') {

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha, insert_tipo
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Expte_esc_nro != '0' AND Familia_matricula = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


}elseif ($criterio == '3'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha, insert_tipo
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Familia_cond_escrit = '1' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '5'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha, insert_tipo
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Adjudicacion_pendiente = '1' AND Expte_esc_nro = '0' AND Familia_doc_completa = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '6'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha, insert_tipo
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Familia_pagocancelado = '1' AND Expte_esc_nro = '0' AND Familia_doc_completa = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '7'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente,  Boleto_fecha, insert_tipo
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Familia_censo_ausente = '1' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '8'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha, insert_tipo
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Familia_tarjeta_solicitar = '1' AND Expte_esc_nro = '0' AND Familia_doc_completa = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '9'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha, insert_tipo
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '10'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, blnBoleto, Boleto_fecha, insert_tipo
FROM dbo_familia WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Expte_esc_nro = '0' AND blnBoleto = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


}elseif ($criterio == '4'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha, insert_tipo
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Adjudicacion_pendiente = '1'  AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '11'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha, insert_tipo
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Adjudicacion_pendiente = '1' AND Familia_doc_completa = '0' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '12'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha, insert_tipo
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Familia_res_adj != '0' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '13'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Familia_tarjeta_solicitar, Familia_censo_ausente, Boleto_fecha, insert_tipo
FROM dbo_familia where Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


}else{	
	

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_conflicto, Familia_pagocancelado, Familia_tarjeta_solicitar, Familia_censo_ausente, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, blnBoleto, Boleto_fecha, insert_tipo FROM dbo_familia where Barrio_nro = '$idBarrio' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";
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
    <td colspan="4"><h1>Informe de beneficiarios de tierras </h1></td>
  </tr>
  <tr>
    <td height="30" colspan="4" style="font-size:18px; font-weight:bold;">Partido: <?=$partido["Partido_nombre"]; ?> - Barrio: <? echo $barrio_nombre ?></td>
  </tr>
  <tr>
    <td colspan="4">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" colspan="4" valign="bottom"><a href="barrios_listar_partido.php?idPartido=<?=$barrio_partido; ?>">Volver al listado de barrios</a>&nbsp;</td>
  </tr>
  <tr>
    <td height="24" colspan="4" valign="bottom"><a href="beneficio_porbarrio_obs_seleccionar.php?idBarrio=<?=$idBarrio;?>&amp;criterio=<?=$criterio; ?>">Ver informe con observaciones</a>
	<? if($user["p723"] == '1') { ?>	 | <a href="beneficio-informe-02.php?idBarrio=<?=$idBarrio;?>">Ver listado de ocupantes </a> | <a href="superficie-asigna-form.php?idBarrio=<?=$idBarrio; ?>">Asignar sup. y valores</a> | <a href="adj-anexo-altas-xls.php?idBarrio=<?=$idBarrio; ?>">Descargar anexo altas</a> |	<a href="adj-anexo-bajas-xls.php?idBarrio=<?=$idBarrio; ?>">Descargar anexo bajas</a> | <? } ?><a href="certificado-cancelacion-porbarrio-select.php?idBarrio=<?=$idBarrio; ?>">Imprimir certificado cancelación</a></td>
  </tr>
  <tr>
    <td height="28" colspan="4">ssss</td>
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
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=13" <? if ($criterio == '13') { ?> selected="selected" <? } ?>>En gesti&oacute;n de regularizaci&oacute;n</option>
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
        <td height="28" align="center" bgcolor="#FFFF66"><a href="beneficio_alta_porbarrio_form.php?idBarrio=<?=$idBarrio; ?>">[Agregar nuevo beneficio a este barrio]</a></td>
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
	<table width="900" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td width="25"><img src="imagen/escrit-ico.jpg" alt="" width="16" height="16" /></td>
	    <td width="87">Escriturado</td>
	    <td colspan="2"><img src="imagen/escrit-anul-ico.jpg" /></td>
	    <td width="110">Escrit. anulada</td>
	    <td width="25"><img src="imagen/tramitesc-ico.jpg" width="16" height="16" /></td>
	    <td width="109">En tr&aacute;mite escrit.</td>
	    <td width="26"><img src="imagen/gescrit-ico.jpg" alt="" /></td>
	    <td width="106">En gesti&oacute;n escrit.</td>
	    <td width="30"><img src="imagen/faltadoc-ico.jpg" /></td>
	    <td width="91">Falta docum.</td>
	    <td width="23"><img src="imagen/pagoscancelados.jpg" width="16" height="16" /></td>
	    <td width="125">Pagos. cancelados</td>
	    <td width="24"><img src="imagen/adj-pendiente-ico.jpg" width="16" height="16" /></td>
	    <td width="91">Adj. pendiente</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td colspan="2">&nbsp;</td>
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
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td bgcolor="#FFCCCC">&nbsp;</td>
	    <td bgcolor="#FFCCCC">&nbsp;</td>
	    <td width="14" align="center" bgcolor="#FFCCCC">&nbsp;</td>
	    <td width="14" align="center">:</td>
	    <td>Dado de baja</td>
	    <td><img src="imagen/boleto-ico.jpg" width="16" height="16" /></td>
	    <td>Con Boleto C/V</td>
	    <td><img src="imagen/tarjeta-solic-ico.jpg" /></td>
	    <td>Solicitar tarjeta</td>
	    <td><img src="imagen/ausente-ico.jpg" /></td>
	    <td>Ausente</td>
	    <td><img src="imagen/verif.png" width="16" height="16" /></td>
	    <td>Verificar</td>
	    <td><img src="imagen/conflicto-ico.jpg" /></td>
	    <td>Conflitco</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td align="center">&nbsp;</td>
	    <td align="center">&nbsp;</td>
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
	  </table>
	 <form method="post" action="accion-multiple.php">	  
	   <table width="900" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="24" height="30" align="center" class="titulo_dato">Mz.</td>
      <td width="20" align="center" class="titulo_dato">Pc.</td>
      <td width="309" class="titulo_dato">Apellido, nombre y documento </td>
      <td width="117" align="center" class="titulo_dato">Estado</td>
      <td width="86" align="center" class="titulo_dato">Resoluci&oacute;n</td>
      <td width="97" align="center" class="titulo_dato">Fecha boleto</td>
      <td width="82" align="center" class="titulo_dato">Tipo
        alta</td>
      <td colspan="2" align="center" class="titulo_dato">Acciones</td>
      <td width="32" align="center" class="titulo_dato"><input type="checkbox" onclick="marcar(this);" /></td>
      </tr>
      
      
      
  <?


while ($familia = mysql_fetch_array($res)) {

$familia_nro = $familia["Familia_nro"];
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
      <td align="center">
<?     
      
$cant = mysql_num_rows ($sql2);
      
if($cant != 0) { ?>    

      <table width="98%" border="0" cellspacing="0" cellpadding="1">
        <? while ($persona = mysql_fetch_array($sql2)){ ?>
        <tr>
          <td width="82%" <? if($persona["Persona_baja"]=='1'){ ?>bgcolor="#FFCCCC"<? } ?>><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
          <td width="18%" <? if($persona["Persona_baja"]=='1'){  
		  ?>bgcolor="#FFCCCC"<? } ?>><? echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?></td>
        </tr>
        <? } ?>
        </table>
        
<? }else{ echo "--"; } ?>        
        	</td>
      <td align="center" valign="middle"><? include "referencias-benef.php"; ?></td>
      <td align="center"><?=$familia["Familia_res_adj"] ?></td>
      <td align="center"><?	   if($familia["Boleto_fecha"] == '0'){ echo "S/D"; }else{ echo $familia["Boleto_fecha"]; } ?></td>
      <td align="center">
      <? if($familia["insert_tipo"] == '2') { ?> <img src="imagen/migra-ico.jpg" width="71" height="20" /><? }else{ ?><img src="imagen/manual-ico.jpg" width="71" height="20" /><? } ?>
      
      
      </td>
      <td width="29" align="center"><a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$familia["Familia_nro"]; ?>')><img src="imagen/doc.png" width="11" height="16" border="0" title="Ver informe"/></a></td>
      <td width="22" align="center"><a href=javascript:ventana_modif('beneficio_informe_imp.php?idFamilia=<?=$familia["Familia_nro"]; ?>')><img src="imagen/imp.png" alt="Imprimir planilla de datos" title="Imprimir planilla de datos" width="18" height="18" border="0" /></a></td>
      <td align="center"><input type="checkbox" name="seleccion[]" value="<?=$familia["Familia_nro"]; ?>" /></td>
      </tr>
  <?
}
?><tr>
    <td colspan="9" align="right">Marcar/desmarcar todos </td><td align="center"><input type="checkbox" onclick="marcar(this);" /></td></tr>
    </table>
	<table width="740" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="21">&nbsp;</td>
    <td width="691" align="left"><? if ($idNivel < '5') { ?>
	<table width="620" border="0" cellpadding="4" cellspacing="0" bgcolor="#dedede">
      <tr>
        <td height="28" valign="top" style="font-size:14px; font-weight:bold">&nbsp;</td>
        <td height="34" colspan="6" valign="middle" style="font-size:14px; font-weight:bold">Aplicar la siguiente acci&oacute;n a todos los beneficios seleccionados </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="5">ATENCI&Oacute;N: Tenga presente que la acci&oacute;n afectar&aacute; a todos los beneficios seleccionados, y que la misma no puede ser revertida autom&aacute;ticamente. <strong>Sea prudente en el uso de esta herramienta. </strong></td>
        <td>&nbsp;</td>
      </tr>
	  <? if($user["p755"] == '1') { ?>	  
      <tr>
        <td width="1">&nbsp;</td>
        <td width="20"><input name="accion" type="radio" value="1" /></td>
        <td width="188">Asignar expte. escrituraci&oacute;n: </td>
        <td colspan="4"><select name="expte_esc_nro" id="expte_esc_nro">
  <option value="0">Quitar el expediente asignado</option>
  <?	  while ($expte = mysql_fetch_array($sql567)) {	
$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_alcance = $expte["Expte_alcance"];

?>
  <option value="<? echo $expte_nro; ?>" <? if ($expte_nro == $familia["Expte_esc_nro"]) {echo "selected=\"selected\"";} ?>><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> </option>
  <? } ?>
</select> </td>
        </tr><? } ?>
        <? if($user["p745"] == '1') { ?>
      <tr>
        <td width="1">&nbsp;</td>
        <td width="20"><input name="accion" type="radio" value="13" /></td>
        <td width="188">Asignar expte. Regularizaci&oacute;n: </td>
        <td colspan="4"><select name="expte_reg_nro" id="expte_reg_nro">
  <option value="0">Quitar el expediente asignado</option>
  <?	  while ($exptereg = mysql_fetch_array($sql652)) {	
$exptereg_nro = $exptereg["Expte_nro"];
$exptereg_caract = $exptereg["Expte_caract"];
$exptereg_num = $exptereg["Expte_num"];
$exptereg_anio = $exptereg["Expte_anio"];
$exptereg_anio_res = substr($expte_anio, 2, 2);
$exptereg_alcance = $exptereg["Expte_alcance"];

?>
  <option value="<? echo $exptereg_nro; ?>" <? if ($exptereg_nro == $familia["Expte_reg_nro"]) {echo "selected=\"selected\"";} ?>><?=$exptereg_caract; ?>-<?=$exptereg_num; ?>/<?=$exptereg_anio_res ?> <? if($exptereg_alcance != '0') {echo "Alc. ".$exptereg_alcance;}else{ echo " ";} ?> </option>
  <? } ?>
</select> </td>
        </tr>
	  <? } ?>
	  <tr>
	    <td width="1">&nbsp;</td>
        <td width="20"><input name="accion" type="radio" value="2" /></td>
        <td width="188">Asignar al siguiente barrio: </td>
        <td colspan="4"><select name="barrio_nro" id="barrio_nro">
<option value="0">Seleccione un barrio</option>
<?	  while ($barrio = mysql_fetch_array($sql789)) {	

$barrio_nro = $barrio["Barrio_nro"];
$barrio_partido = $barrio["Partido_nombre"];
$barrio_nombre = $barrio["Barrio_nombre"];
?>
<option value="<? echo $barrio_nro; ?>"><?=$barrio_partido; ?> - <?=$barrio_nombre; ?></option>
<? } ?>
</select></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="9" /></td>
        <td>Asignar resoluci&oacute;n n&uacute;mero:</td>
        <td><input name="res_adj" type="text" id="res_adj" value="0" size="6" /></td>
        <td width="111" align="center">Fecha resoluci&oacute;n:</td>
        <td width="144"><input name="res_adj_fecha" type="text" id="res_adj_fecha" size="6" /></td>
        <td>&nbsp;</td>
        </tr>
        
        <? /////////////////////////////////////////// Para boleton compra-venta //////////////////////////////////////// ?>
         
        <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="16" /></td>
        <td colspan="2">Marcar <strong><u>tiene boleto compraventa</u></strong></td>
        <td width="111" align="center">Fecha boleto:</td>
        <td colspan="2"><input name="boleto_fecha" type="text" id="boleto_fecha" size="6" /> 
          (formato dd/mm/aaaa)</td>
        </tr>
        
        <? ////////////////////////////////////// Fin select boleto-compra venta ////////////////////////////////////// ?>
        
	  <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="7" /></td>
        <td colspan="5">Marcar <u><strong>en gesti&oacute;n escrituraria</strong></u> </td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="8" /></td>
        <td colspan="5">Quitar marca en gesti&oacute;n esctrituraria</td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="11" /></td>
        <td colspan="5">Marcar <strong>escritura anulada</strong> </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="3" /></td>
        <td colspan="5">Marcar documentaci&oacute;n <strong>completa</strong> </td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="4" /></td>
        <td colspan="5">Marcar documentaci&oacute;n incompleta </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="5" /></td>
        <td colspan="5">Marcar <strong>pagos cancelados</strong> </td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="6" /></td>
        <td colspan="5">Desmarcar pagos cancelados </td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td><input name="accion" type="radio" value="14" /></td>
	    <td colspan="5">Ausente en censo</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td><input name="accion" type="radio" value="15" /></td>
	    <td colspan="5">Pedir tarjeta de pagos</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="10" /></td>
        <td colspan="5">Indicar que en el lote <strong>hay bajas</strong>  (el anexo de bajas se generar&aacute; en funci&oacute;n de este dato) </td>
      </tr>
      <tr>
	    <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="12" /></td>
        <td colspan="5">Quitar condicion "<strong>hay bajas</strong>"(solo cuando se asegure que en lote no hay bajas)</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="hidden" name="barrio_origen" value="<?=$idBarrio; ?>" />
		<input type="hidden" name="pag_origen" value="<? echo $nombre_archivo; ?>" />		
		&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td width="59" align="right">&nbsp;</td>
        <td colspan="2" align="right"><input name="enviar" type="submit" id="enviar" value="Actualizar" /></td>
        <td width="41" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td colspan="2" align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
    </table>
	<? } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
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
