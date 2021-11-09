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


$sql3 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre,
Partido_nombre
FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) ORDER BY Partido_nombre ASC",$link);

$cant = mysql_num_rows ($sql3);


?>

<table width="730" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Listado de barrios</h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema Integral de Gesti&oacute;n de la Subsecretar&iacute;a Social de Tierras y Urbanismo </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="menu.php">Volver al menu</a></td>
  </tr>
  <tr>
    <td height="16" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="13" rowspan="2">&nbsp;</td>
    <td width="563" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td><table width="88%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="44" height="25" align="center" class="titulo_dato">Id.</td>
        <td width="226" align="center" class="titulo_dato">Partido</td>
        <td width="294" align="center" class="titulo_dato">Barrio</td>
        <td colspan="2" align="center" class="titulo_dato">Acciones</td>
        </tr>
<?

while ($barrio = mysql_fetch_array($sql3)) {	
/*
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
        <td height="30" align="center" ><?=$barrio["Barrio_nro"] ;?></td>
        <td align="center"><?=$barrio["Partido_nombre"] ;?></td>
        <td align="center"><?=$barrio["Barrio_nombre"] ;?></td>
        <td width="28" align="center" ><a href="exptereg_listar_porbarrio.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>"><img src="imagen/expte.jpg" border="0" /></a></td>
        <td width="28" align="center" >
        <? if ($user["p742"] == '1')  { ?>
        <a href="expte_reg_alta_form.php?idBarrio=<?=$barrio["Barrio_nro"]; ?>"><img src="imagen/expte-add.jpg" border="0" /></a><? }else{ ?>-<? } ?>
        </td>
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