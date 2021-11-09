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

$partido_nro = $_GET["idPartido"];

$sql3 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre,
Partido_nombre
FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) ORDER BY Partido_nombre, Barrio_nombre LIMIT 0,550",$link);

$cant = mysql_num_rows ($sql3);



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
    <td width="542" align="right"><img src="imagen/barrio.png" width="40" height="30" /></td>
    <td width="7" align="left">&nbsp;</td>
    <td width="165" align="left"><a href="barrio_alta_form.php?idPartido=<? echo $partido_nro; ?>">Dar de alta nuevo barrio</a></td>
  </tr>
  <tr>
    <td colspan="3" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="3"><table width="700" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="232" height="25" align="center" class="titulo_dato">Partido</td>
        <td width="281" align="center" class="titulo_dato">Barrio</td>
        <td width="90" align="center" class="titulo_dato">Total lotes</td>
        <td width="87" align="center" class="titulo_dato">Escriturados</td>
        </tr>
<?

while ($barrio = mysql_fetch_array($sql3)) {
$barrio_conurbano = $barrio ["Barrio_conurbano"];		
if($barrio_conurbano == '1') { $criterio = '13'; }else{ $criterio = '0'; }

$partido_nro = $barrio["Partido_nro"];
$res4 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $partido_nro");
$pdo = mysql_fetch_array($res4);
//$pdoNombre = $pdo["Partido_nombre"];


$barrio_nro = $barrio["Barrio_nro"];

$sql5 = "SELECT COUNT(*) total FROM dbo_familia WHERE Barrio_nro = $barrio_nro";
$res5 = mysql_query($sql5);
$fila = mysql_fetch_assoc($res5);


$sql6 = "SELECT COUNT(*) total FROM dbo_familia WHERE Barrio_nro = '$barrio_nro' AND Familia_matricula != '0'";
$res6 = mysql_query($sql6);
$fila2 = mysql_fetch_assoc($res6);

?>
      <tr>
        <td height="30" align="center"><?=$barrio["Partido_nombre"] ;?>&nbsp;</td>
        <td align="center"><?=$barrio["Barrio_nombre"] ;?></td>
        <td align="center"><?=$fila['total']; ?>&nbsp;</td>
        <td align="center"><?=$fila2['total']; ?>&nbsp;</td>
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