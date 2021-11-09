<?
include ("conec.php");
include ("funciones.php");

$idPartido = $_GET["partido"];

$circ = $_GET["circunscripcion"];

$seccion = $_GET["seccion"];

$chacra = $_GET["chacra"];

$manzana = $_GET["manzana"];

$blnEsc = $_GET["blnEsc"];

mysql_select_db("MyTierras",$link);

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

$sql567 = mysql_query("SELECT * FROM dbo_expte_esc ORDER BY Expte_nro DESC",$link);

$sql4 = mysql_query("SELECT * FROM dbo_partido WHERE Partido_nro = $barrio_partido",$link);
$partido = mysql_fetch_array($sql4);

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

if ($cant < 1) {echo "<h2>No hay registros | </h2><p><a href=\"benef_buscar_nomenc_form.php\">Volver</a></p><p>&nbsp;</p>";}else{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema Beneficiarios de Tierras</title>
<meta name="description" value="Sistema de Beneficiarios de Tierras" />
<meta name="author" content="Andrés J. Bilstein">
<style type="text/css">
<!--
body {
	margin-left: 50px;
	margin-top: 20px;
}
</style>

<link href="estilos.css" rel="stylesheet" type="text/css" />

<script>
function pulsar(e) {
  tecla = (document.all) ? e.keyCode :e.which;
  return (tecla!=13);
}
</script> 

<script language=JavaScript>
<!--

function inhabilitar(){
    alert ("No puede utilizar el boton derecho del mouse.\nPor favor, utilice sólo los comandos en pantalla.\nMuchas Gracias.")
    return false
}

document.oncontextmenu=inhabilitar

// -->
</script>
<script language="JavaScript">
function ventana_modif (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=860, height=760, top=70, left=80";
window.open(pagina,"",opciones);
}
</script>

<script language="JavaScript">
function ventana_imprimir (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=950, height=700, top=70, left=50";
window.open(pagina,"",opciones);
}
</script>


<?php include ("hintbox.php"); ?>
<!-- Menu desplegable -->	
	<script language="JavaScript">
function ChangeUrl(form)
{
 	  		location.href = form.ListeUrl.options[form.ListeUrl.selectedIndex].value;
}
</script>
<script type="text/javascript">
	function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
</script>	
</head>

<body onload="nobackbutton();">
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="75" align="right" valign="top"><img src="imagen/logo-ba2.jpg" alt="Buenos Aires" width="900" height="70" /></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Beneficios  en <? echo $partido_nombre ?> (Manzana <?=$manzana; ?>) </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="esc_partido_mz_listar.php?idPartido=<? echo $idPartido; ?>">Volver</a> | <a href="esc_partido_listar_imp.php?partido=<?=$idPartido; ?>&circunscripcion=<?=$circ; ?>&seccion=<?=$seccion; ?>&chacra=<?=$chacra; ?>&manzana=<?=$manzana; ?>&blnEsc=<?=$blnEsc; ?>" target="_blank">Versi&oacute;n para imprimir </a></td>
  </tr>
  <tr>
    <td height="16" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2">
<form method="post" action="accion-multiple2.php">	
	<table width="760" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="31" height="30" align="center" class="titulo_dato">Circ.</td>
      <td width="36" align="center" class="titulo_dato">Secc.</td>
      <td width="25" align="center" class="titulo_dato">Ch.</td>
      <td width="35" align="center" class="titulo_dato">Qta.</td>
      <td width="43" align="center" class="titulo_dato">Fracc.</td>
      <td width="36" align="center" class="titulo_dato">Mz.</td>
      <td width="36" align="center" class="titulo_dato">Pc.</td>
      <td width="68" align="center" class="titulo_dato">Matricula</td>
      <td width="247" class="titulo_dato">Apellido, nombre y documento </td>
      <td width="81" align="center" class="titulo_dato">Acciones</td>
      <td width="32" align="center" class="titulo_dato"><input type="checkbox" onclick="marcar(this);" /></td>
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
      <td align="center"><? if ($matricula !=0) {?><table cellpadding="5">
        <tr><td bgcolor="#FFFF33"><strong><?=$matricula;?></strong></td>
        </tr></table><? }else{
	  if ($familia["Expte_esc_nro"] != '0') {?>&nbsp;<img src="imagen/tramitesc-ico.jpg" /><? }else{ echo "0"; }} ?>
</td>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <? while ($persona = mysql_fetch_array($sql2)){ ?>
        <tr>
          <td width="76%"><? echo $persona["Persona_apellido"]." ".$persona["Persona_nombre"]; ?></td>
          <td width="24%"><strong><? echo $persona["Persona_dni_nro"]; ?></strong></td>
        </tr>
        <? } ?>
        </table>	</td>
      <td align="center"><a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$familia["Familia_nro"]; ?>')>Ver informe</a></td>
      <td align="center"><input type="checkbox" name="seleccion[]" value="<?=$familia["Familia_nro"]; ?>" /></td>
      </tr>
  <?
}
?><tr>
    <td colspan="10" align="right">Marcar/desmarcar todos </td><td align="center"><input type="checkbox" onclick="marcar(this);" /></td></tr>
    </table>
	<table width="740" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="21">&nbsp;</td>
    <td width="691" align="left">
	<? if ($idNivel < '5') { ?>
	<table width="585" border="0" cellpadding="4" cellspacing="0" bgcolor="#dedede">
      <tr>
        <td height="28" valign="top" style="font-size:14px; font-weight:bold">&nbsp;</td>
        <td height="34" colspan="5" valign="middle" style="font-size:14px; font-weight:bold">Aplicar la siguiente acci&oacute;n a todos los beneficios seleccionados </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="4">ATENCI&Oacute;N: Tenga presente que la acci&oacute;n afectar&aacute; a todos los beneficios seleccionados, y que la misma no puede ser revertida autom&aacute;ticamente. <strong>Sea prudente en el uso de esta herramienta. </strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="1">&nbsp;</td>
        <td width="23"><input name="accion" type="radio" value="1" /></td>
        <td width="116">Asignar expediente: </td>
        <td width="209"><select name="expte_esc_nro" id="expte_esc_nro">
<option value="0">Quitar el expediente asignado</option>
<?	  while ($expte = mysql_fetch_array($sql567)) {	

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_barrio = $expte["Barrio_nombre"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];

?>
<option value="<? echo $expte_nro; ?>" <? if ($expte_nro == $familia["Expte_esc_nro"]) {echo "selected=\"selected\"";} ?>><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> <? if ($expte_cuerpo != '0') {echo "Cpo ".$expte_cuerpo; }else{ echo " "; } ?></option>
<? } ?>
</select> </td>
        <td colspan="2"><a href="#">[Dar de alta nuevo expediente] </a></td>
      </tr>
	  <tr>
	    <td width="1">&nbsp;</td>
        <td width="23"><input name="accion" type="radio" value="2" /></td>
        <td width="116">Asignar al barrio: </td>
        <td colspan="3"><select name="barrio_nro" id="barrio_nro">
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
        <td>Asignar resoluci&oacute;n </td>
        <td><input name="res_adj" type="text" id="res_adj" value="0" size="6" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="7" /></td>
        <td colspan="4">Marcar <u><strong>en condiciones de escriturar</strong></u> </td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="8" /></td>
        <td colspan="4">Quitar marca en condiciones de escriturar</td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="3" /></td>
        <td colspan="4">Marcar documentaci&oacute;n <strong>completa</strong> </td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="4" /></td>
        <td colspan="4">Marcar documentaci&oacute;n incompleta </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="5" /></td>
        <td colspan="4">Marcar <strong>pagos cancelado</strong> </td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
        <td><input name="accion" type="radio" value="6" /></td>
        <td colspan="4">Desmarcar pagos cancelados </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
		<input type="hidden" name="partido" value="<? echo $idPartido; ?>" />
		<input type="hidden" name="circunscripcion" value="<? echo $circ; ?>" />
		<input type="hidden" name="seccion" value="<? echo $seccion; ?>" />
		<input type="hidden" name="chacra" value="<? echo $chacra; ?>" />
		<input type="hidden" name="manzana" value="<? echo $manzana; ?>" />
		<input type="hidden" name="blnEsc" value="<? echo $blnEsc; ?>" />	
		&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td width="181" align="right"><input name="enviar" type="submit" id="enviar" value="Actualizar" /></td>
        <td width="7" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
    </table>
	<? } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><? echo $idPartido." - ".$circ." - ".$seccion." - ".$chacra." - ".$manzana." - ".$blnEsc; ?>&nbsp;</td>
  </tr>
</table></form></td>
  </tr>
  <tr>
    <td width="13" height="25">&nbsp;</td>
    <td width="563">&nbsp;</td>
  </tr>
</table>
<?  } 

include "pie.php"; ?>
