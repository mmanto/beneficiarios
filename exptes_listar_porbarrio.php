<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];
//$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";

include ("funciones.php");

include("cabecera.php");


mysql_select_db("MyTierras",$link);

/////////////////////////////////////////////////////



/*
  
if (!$resolucion_busqueda) {echo "<h2>Por favor, ingrese un n&uacute;mero de resoluci&oacute;n</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{

$sql = "SELECT Familia_nro, Lote_nro FROM dbo_familia where Familia_resolucion = '$resolucion_busqueda'";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);

if ($cant < 1) {echo "<h2>No hay resultados que coincidan con su b&uacute;squeda</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{
*/

$idBarrio = $_GET["idBarrio"];

$sql = mysql_query("SELECT Barrio_nombre,
Partido_nombre 
FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) WHERE Barrio_nro = $idBarrio",$link);
$barrio = mysql_fetch_array($sql);
$barrio_nombre = $barrio["Barrio_nombre"];
$barrio_partido = $barrio["Partido_nombre"];


$sql3 = mysql_query("SELECT
Expte_nro,
Expte_caract,
Expte_num,
Expte_anio,
Expte_alcance,
Expte_cuerpo,
Expte_barrio,
Expte_envio_egg,
Expte_mov,
Expte_fechamov,
Expte_beneficios,
Partido_nombre
FROM (
dbo_expte_esc
INNER JOIN
dbo_partido
ON dbo_expte_esc.idPartido = dbo_partido.Partido_nro
) WHERE Barrio_nro = $idBarrio ORDER BY Expte_caract ASC, Expte_nro ASC, Expte_anio ASC",$link);

$cant = mysql_num_rows ($sql3);

?>

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Expedientes de escrituraci&oacute;n girados a EGG </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema Integral de Gesti&oacute;n de la Subsecretar&iacute;a Social de Tierras y Urbanismo </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="javascript:history.back()">Volver al listado</a> | <a href="exptes_listar_imp.php">Versi&oacute;n para imprimir</a></td>
  </tr>
  <tr>
    <td height="16" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2" bgcolor="e6e6e6"><h3><strong class="titulodato">Expedientes de escrituraci&oacute;n relacionados con el barrio <?=$barrio_nombre; ?> (<?=$barrio_partido; ?>)</strong></h3></td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="right">&nbsp;</td>
  </tr><tr>
    <td height="25">&nbsp;</td>
    <td><table width="760" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="142" height="25" align="center" class="titulo_dato">Expediente</td>
        <td width="74" align="center" class="titulo_dato">Benef.</td>
        <td width="106" align="center" class="titulo_dato">Env&iacute;o EGG</td>
        <td width="187" align="center" class="titulo_dato">Ultimo mov. </td>
        <td width="95" align="center" class="titulo_dato">Fecha ultimo mov. </td>
        <td colspan="4" align="center" class="titulo_dato">Acciones </td>
        </tr>
<?

while ($expte = mysql_fetch_array($sql3)) {	

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_barrio = $expte["Expte_barrio"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];
$plano_circ = $expte["Plano_circ"];
$expte_mov = $expte["Expte_mov"];
$expte_beneficios = $expte["Expte_beneficios"];
$expte_fechamov = cambiaf_a_normal($expte["Expte_fechamov"]);
	if ($expte_fechamov == '00/00/0000') {$expte_fechamov = " "; }
$expte_envio_egg = cambiaf_a_normal($expte["Expte_envio_egg"]);
$expte_partido = $expte["Partido_nombre"];


/*
if($plano["Plano_secc"]=='0'){$plano_secc = " - ";}else{$plano_secc = $plano["Plano_secc"];}
if($plano["Plano_ch"]=='0'){$plano_ch = " - ";}else{$plano_ch = $plano["Plano_ch"];}
if($plano["Plano_qta"]=='0'){$plano_qta = " - ";}else{$plano_qta = $plano["Plano_qta"];}
if($plano["Plano_fracc"]=='0'){$plano_fracc = " - ";}else{$plano_fracc = $plano["Plano_fracc"];}
if($plano["Plano_manzana"]=='0'){$plano_manzana = " - ";}else{$plano_manzana = $plano["Plano_manzana"];}
if($plano["Plano_parcela"]=='0'){$plano_parcela = " - ";}else{$plano_parcela = $plano["Plano_parcela"];}
*/
?>
      <tr>
        <td height="30" align="center" ><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> <? if ($expte_cuerpo != '0') {echo "Cpo ".$expte_cuerpo; }else{ echo " "; } ?></td>
        <td align="center"><?=$expte_beneficios; ?></td>
        <td align="center" ><?=$expte_envio_egg; ?></td>
        <td align="center" ><?=$expte_mov; ?></td>
        <td align="center" ><?=$expte_fechamov; ?></td>
        <td width="28" align="center" ><a href="expte_informe.php?id=<? echo $expte_nro;?> "><img src="imagen/doc.png" alt="Ver informe expte." width="11" height="16" border="0" /></a></td>
        <td width="34" align="center" class="datos-center"><a href="expte_esc_modif_form.php?id=<? echo $expte_nro;?> "><img src="imagen/edit.png" alt="Editar expte." title="Editar expte." width="16" height="16" border="0" /></a></td>
        <td width="28" align="center"><a href="beneficio_expte_listar.php?expte=<? echo $expte_nro; ?>"><img src="imagen/benef.jpg" alt="Listar beneficiarios" title="Listar beneficiarios" width="16" height="19" border="0" /></a></td>
        <td width="46" align="center"><a href="beneficio_expte_alta_form.php?expte=<? echo $expte_nro; ?>"><img src="imagen/benef-add.jpg" alt="Incorporar beneficiarios" title="Incorporar beneficiarios" width="16" height="19" border="0" /></a></td>
      </tr>
		
	  <? } ?>
    </table></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?  
include "pie.php";
?>
<? } ?>