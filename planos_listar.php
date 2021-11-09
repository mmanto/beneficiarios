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
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";

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

?>

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Informe de beneficiario de tierras </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema Integral de Gesti&oacute;n de la Subsecretar&iacute;a Social de Tierras y Urbanismo </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="menu.php?<?=$linkvar; ?>">Volver al menu</a></td>
  </tr>
  <tr>
    <td height="16" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2" bgcolor="#F0F0F0"><h3><strong class="titulodato">Listado de planos incorporados al sistema </strong></h3></td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="right">&nbsp;</td>
  </tr><tr>
    <td height="25">&nbsp;</td>
    <td><table width="715" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="56" height="25" class="titulo_dato">Codigo</td>
        <td width="121" class="titulo_dato">Barrio</td>
        <td width="121" class="titulo_dato">Partido</td>
        <td width="35" class="titulo_dato">Circ.</td>
        <td width="36" class="titulo_dato">Secc.</td>
        <td width="37" class="titulo_dato">Ch.</td>
        <td width="43" class="titulo_dato">Qta.</td>
        <td width="42" class="titulo_dato">Fracc.</td>
        <td width="35" class="titulo_dato">Mz.</td>
        <td width="41" class="titulo_dato">Pc.</td>
        <td width="45" class="titulo_dato">Subpc.</td>
        <td colspan="3" class="titulo_dato">Acciones </td>
        </tr>
<?

$sql3 = mysql_query("SELECT
Plano_nro,
Plano_codigo,
Plano_barrio,
Plano_circ,
Plano_secc,
Plano_ch,
Plano_qta,
Plano_fracc,
Plano_manzana,
Plano_parcela,
Partido_nombre
FROM (
dbo_plano
INNER JOIN
dbo_partido
ON dbo_plano.idPartido = dbo_partido.Partido_nro
)",$link);

while ($plano = mysql_fetch_array($sql3)) {	

$plano_nro = $plano["Plano_nro"];
$plano_codigo = $plano["Plano_codigo"];
$plano_barrio = $plano["Plano_barrio"];
$plano_partido = $plano["Partido_nombre"];
$plano_circ = $plano["Plano_circ"];
if($plano["Plano_secc"]=='0'){$plano_secc = " - ";}else{$plano_secc = $plano["Plano_secc"];}
if($plano["Plano_ch"]=='0'){$plano_ch = " - ";}else{$plano_ch = $plano["Plano_ch"];}
if($plano["Plano_qta"]=='0'){$plano_qta = " - ";}else{$plano_qta = $plano["Plano_qta"];}
if($plano["Plano_fracc"]=='0'){$plano_fracc = " - ";}else{$plano_fracc = $plano["Plano_fracc"];}
if($plano["Plano_manzana"]=='0'){$plano_manzana = " - ";}else{$plano_manzana = $plano["Plano_manzana"];}
if($plano["Plano_parcela"]=='0'){$plano_parcela = " - ";}else{$plano_parcela = $plano["Plano_parcela"];}

?>
      <tr>
        <td height="30" class="datos-center"><?=$plano_codigo; ?></td>
        <td class="datos-center"><?=$plano_barrio; ?></td>
        <td class="datos-center"><?=$plano_partido; ?></td>
        <td class="datos-center"><?=$plano_circ; ?></td>
        <td class="datos-center"><?=$plano_secc; ?></td>
        <td class="datos-center"><?=$plano_ch; ?></td>
        <td class="datos-center"><?=$plano_qta; ?></td>
        <td class="datos-center"><?=$plano_fracc; ?></td>
        <td class="datos-center"><?=$plano_manzana; ?></td>
        <td class="datos-center"><?=$plano_parcela; ?></td>
        <td class="datos-center">&nbsp;</td>
        <td width="25" class="datos-center"><a href="plano_informe.php?idPlano=<? echo $plano_nro ; ?>" title="Ver informe"><img src="imagen/doc.png" alt="Ver informe" width="11" height="16" border="0" /></a></td>
        <td width="25" class="datos-center"><a href="plano_modif_form.php?idPlano=<? echo $plano_nro ; ?>&<?=$linkvar; ?>"><img src="imagen/edit.png" alt="Editar informe" width="16" height="16" border="0" /></td>
        <td width="23" class="datos-center"><img src="imagen/drop.png" alt="Borrar" width="16" height="16" border="0" /></td>
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
