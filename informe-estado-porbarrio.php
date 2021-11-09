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

include ("funciones.php");

include("cabecera.php");

//$partido_nro = $_GET["idPartido"];

/*$sql3 = mysql_query("SELECT * FROM dbo_barrio WHERE Partido_nro = '$partido_nro' ORDER BY Barrio_nombre",$link);*/

$sql3 = mysql_query("SELECT Barrio_nro, Partido_nro, Barrio_nombre, Barrio_parcelas_cant FROM dbo_barrio ORDER BY Partido_nro, Barrio_nro LIMIT 0,600",$link);

$cant = mysql_num_rows ($sql3);

/*

*/
?>

<table width="960" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="4"><h2>Listado de barrios en proceso de regularizaci&oacute;n dominial </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="4">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema Integral de Gesti&oacute;n de la Subsecretar&iacute;a Social de Tierras y Urbanismo </td>
  </tr>
  <tr>
    <td height="24" colspan="4" valign="bottom"><a href="sbt-menu.php">Volver al menu</a></td>
  </tr>
  <tr>
    <td height="16" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="16" rowspan="2">&nbsp;</td>
    <td width="542" align="right">&nbsp;</td>
    <td width="7" align="left">&nbsp;</td>
    <td width="165" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="3"><table width="900" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="38" height="25" align="center" class="titulo_dato">Id.</td>
        <td width="218" align="center" class="titulo_dato">Partido</td>
        <td width="273" align="center" class="titulo_dato">Barrio</td>
        <td width="86" align="center" class="titulo_dato">Total lotes</td>
        <td width="86" align="center" class="titulo_dato">Escriturado</td>
        <td width="97" align="center" class="titulo_dato">En trámite</td>
        <td width="86" align="center" class="titulo_dato">Saldo</td>
        </tr>
<?

while ($barrio = mysql_fetch_array($sql3)) {	

$pdonro = $barrio["Partido_nro"];

$res4 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $pdonro");
$pdo = mysql_fetch_array($res4);
$pdoNombre = $pdo["Partido_nombre"];


$barrio_nro = $barrio["Barrio_nro"];

$total_parcelas = $barrio["Barrio_parcelas_cant"];

$sql6 = "SELECT Familia_nro FROM dbo_familia WHERE Barrio_nro = '$barrio_nro' AND Familia_matricula != '0'";
$res6 = mysql_query($sql6);
$lotes_escrit = mysql_num_rows($res6);


$sql7 = "SELECT Familia_nro FROM dbo_familia WHERE Barrio_nro = '$barrio_nro' AND Familia_matricula = '0' AND Expte_esc_nro != '0'";
$res7 = mysql_query($sql7);
$lotes_entramite = mysql_num_rows($res7);

$resto = $total_parcelas - $lotes_escrit - $lotes_entramite;

?>
      <tr>
        <td height="30" align="center" ><?=$barrio["Barrio_nro"] ;?></td>
        <td align="center"><?=$pdoNombre; ?>&nbsp;</td>
        <td align="center"><?=$barrio["Barrio_nombre"] ;?></td>
        <td align="center"><? echo $total_parcelas; ?>&nbsp;</td>
        <td align="center"><? echo $lotes_escrit; ?>&nbsp;</td>
        <td align="center"><? echo $lotes_entramite; ?>&nbsp;</td>
        <td align="center"><? echo $resto; ?></td>
        </tr>
		
	  <? } ?>
    </table></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
<?  
include "pie.php";
?>
<? } ?>