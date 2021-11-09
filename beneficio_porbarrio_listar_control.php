<?php session_start();

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

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Nombre, Boleto_fecha
FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND Familia_matricula != '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '2') {

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Nombre, Boleto_fecha
FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND Expte_esc_nro != '0' AND Familia_matricula = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


}elseif ($criterio == '3'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Nombre, Boleto_fecha
FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND Familia_cond_escrit = '1' AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}elseif ($criterio == '5'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Nombre, Boleto_fecha
FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) WHERE Barrio_nro = '$idBarrio' AND Familia_matricula = '0' AND Adjudicacion_pendiente = '1' AND Expte_esc_nro = '0' AND Familia_doc_completa = '1' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";


}elseif ($criterio == '4'){

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Nombre, Boleto_fecha
FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND Adjudicacion_pendiente = '1'  AND Expte_esc_nro = '0' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";

}else{

$sql = "SELECT Familia_nro, Lote_manzana, Lote_parcela, Familia_matricula, Expte_esc_condicion, Expte_esc_nro, Familia_cond_escrit, Familia_ocupacion_verificar, Adjudicacion_pendiente, Familia_doc_completa, Familia_res_adj, Barrio_nro, Nombre, Boleto_fecha
FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) where Barrio_nro = '$idBarrio' AND blnActivo = '1' ORDER BY Lote_manzana, Lote_parcela ASC";
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
<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><h1>Generar listado de control municipio</h1></td>
  </tr>
  <tr>
    <td height="30" colspan="4" style="font-size:18px; font-weight:bold;">Partido: <?=$partido["Partido_nombre"]; ?> - Barrio: <?php echo $barrio_nombre ?></td>
  </tr>
  <tr>
    <td colspan="4">Seleccione los beneficios que desee incluir en el listado a generar.</td>
  </tr>
  <tr>
    <td height="24" colspan="4" valign="bottom"><a href="barrios_listar_partido.php?idPartido=<?=$barrio_partido; ?>">Volver al listado general</a></td>
  </tr>
  <tr>
    <td height="8" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="84" height="8">Mostrando:</td>
    <td width="221"><form><select name="ListeUrl" onChange="ChangeUrl(this.form)">
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=0" <?php if ($criterio == '0') { ?> selected="selected" <?php } ?>>Todos</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=4" <?php if ($criterio == '4') { ?> selected="selected" <?php } ?>>Adjudicaci&oacute;n pendiente</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=5" <?php if ($criterio == '5') { ?> selected="selected" <?php } ?>>En condiciones de adjudicar</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=3" <?php if ($criterio == '3') { ?> selected="selected" <?php } ?>>En condiciones de escriturar</option>
	  <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=2" <?php if ($criterio == '2') { ?> selected="selected" <?php } ?>>En tr&aacute;mite de escrituraci&oacute;n</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?idBarrio=<?=$idBarrio; ?>&criterio=1" <?php if ($criterio == '1') { ?> selected="selected" <?php } ?>>Escriturados</option>      
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
	<?php if ($cant > 0) { ?>
	<table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="3%"><img src="imagen/escrit-ico.jpg" width="16" height="16" /></td>
          <td width="9%">Escriturado</td>
		  <td colspan="2"><img src="imagen/tramitesc-ico.jpg" width="16" height="16" /></td>
          <td width="18%">En tr&aacute;mite de escrit. </td>
          <td width="2%"><img src="imagen/cond-esc-ico.jpg" /></td>
          <td width="17%"> En cond. de escriturar </td>
          <td width="3%"><img src="imagen/adj-pendiente-ico.jpg" width="16" height="16" /></td>
          <td width="16%">Adjudicaci&oacute;n pendiente </td>
          <td width="3%"><img src="imagen/verif.png" width="16" height="16" /></td>
          <td width="8%">Verificar</td>
          <td width="3%"><img src="imagen/faltadoc-ico.jpg" /></td>
          <td width="15%">Falta documentaci&oacute;n</td>
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
        </tr>
        <tr>
          <td colspan="3" bgcolor="#FFCCCC">&nbsp;</td>
          <td width="1%" align="center">:</td>
          <td>Beneficiario dado de baja </td>
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
          <td colspan="3">&nbsp;</td>
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
      </table>
	 <form method="post" action="listado-control.php">	  
	<table width="850" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="24" height="30" align="center" class="titulo_dato">Mz.</td>
      <td width="20" align="center" class="titulo_dato">Pc.</td>
      <td width="333" class="titulo_dato">Apellido, nombre y documento </td>
      <td width="141" align="center" class="titulo_dato">Estado</td>
      <td width="117" align="center" class="titulo_dato">Fecha boleto</td>
      <td width="129" align="center" class="titulo_dato">Alta por </td>
      <td width="28" align="center" class="titulo_dato"><input type="checkbox" onclick="marcar(this);" /></td>
      </tr>
      
  <?php
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
        <td align="center"><?php echo $manzana; ?></td>
      <td align="center"><?php echo $parcela; ?></td>
      <td align="center"><table width="98%" border="0" cellspacing="0" cellpadding="1">
        <?php while ($persona = mysql_fetch_array($sql2)){ ?>
        <tr>
          <td width="82%" <?php if($persona["Persona_baja"]=='1'){ ?>bgcolor="#FFCCCC"<?php } ?>><?php echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
          <td width="18%" <?php if($persona["Persona_baja"]=='1'){  
		  ?>bgcolor="#FFCCCC"<?php } ?>><?php echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?></td>
        </tr>
        <?php } ?>
        </table>	</td>
      <td align="center" valign="middle">
        <?php if ($familia["Familia_matricula"] != '0') {?><img src="imagen/escrit-ico.jpg" /><?php }else{ ?>
        <?php if ($familia["Expte_esc_condicion"] == '3') {?><img src="imagen/escrit-anul-ico.jpg" /><?php }else{ ?>
		<?php if ($familia["Expte_esc_nro"] != '0') {?>&nbsp;<img src="imagen/tramitesc-ico.jpg" /><?php } ?>
		<?php if ($familia["Familia_cond_escrit"] == '1') {?>&nbsp;<img src="imagen/cond-esc-ico.jpg" /><?php } ?>
		<?php if ($familia["Familia_ocupacion_verificar"] != '0') {?>&nbsp;<img src="imagen/verif.png" /> <?php } ?>
		<?php if ($familia["Adjudicacion_pendiente"] == '1') {?>&nbsp;<img src="imagen/adj-pendiente-ico.jpg" /><?php } ?>
		<?php if ($familia["Familia_doc_completa"] != '1') {?>&nbsp;<img src="imagen/faltadoc-ico.jpg" /><?php } ?><?php }} ?></td>
      <td align="center"><?php	   if($familia["Boleto_fecha"] == '0'){ echo "S/D"; }else{ echo $familia["Boleto_fecha"]; } ?></td>
      <td align="center"><?=$familia["Nombre"] ?></td>
      <td align="center"><input type="checkbox" name="seleccion[]" value="<?=$familia["Familia_nro"]; ?>" /></td>
      </tr>
  <?php
}
?><tr>
    <td colspan="6" align="right">Marcar/desmarcar todos </td>
    <td align="right"><input type="checkbox" onclick="marcar(this);" /></td>
    </tr>
    </table>
	<table width="850" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td width="712" align="right">
    <input type="hidden" name="idBarrio" value="<? echo $idBarrio; ?>" />
    <input type="submit" name="button" id="button" value="Generar listado" /></td>
  </tr>
</table>
	 </form>
	<?php } ?></td>
  </tr>
  <tr>
    <td height="25" colspan="4">&nbsp;</td>
  </tr>
</table>
<?php } ?>
<?php include "pie.php"; ?>
