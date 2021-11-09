<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");
/*
$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];
*/
include ("funciones.php");

include("cabecera.php");

$suma1 = '0';
$suma2 = '0';
$suma3 = '0';


$sql = "SELECT Partido_nro, Partido_nombre FROM dbo_partido ORDER BY Partido_nombre LIMIT 0,150";
$res = mysql_query($sql);



?>
<table width="960" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Listado de barrios en proceso de regularizaci&oacute;n dominial </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema Integral de Gesti&oacute;n de la Subsecretar&iacute;a Social de Tierras y Urbanismo </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="sbt-menu.php">Volver al menu</a></td>
  </tr>
  <tr>
    <td height="16" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="16" rowspan="2">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td><table width="800" border="2" cellpadding="5" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="241" height="25" align="center" class="titulo_dato">Partido</td>
        <td width="553" align="center" class="titulo_dato">Detalle</td>
        </tr>
<?

while ($partido = mysql_fetch_array($res)) {
	
$partido_nro = $partido["Partido_nro"];
	
?>
      <tr>
        <td height="30" align="center"><?=$partido["Partido_nombre"] ;?>&nbsp;</td>
        <td align="center">
<?
$res2 = mysql_query("SELECT * FROM dbo_barrio WHERE Partido_nro = '$partido_nro' ORDER BY Barrio_nombre",$link);

?>        
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
              <td width="52%" height="30" bgcolor="#E1E1E1">Barrio</td>
              <td width="18%" align="center" bgcolor="#E1E1E1">Total lotes</td>
              <td width="16%" align="center" bgcolor="#E1E1E1">Escriturados</td>
              <td width="14%" align="center" bgcolor="#E1E1E1">En trámite</td>
            </tr>
<? while ($barrio = mysql_fetch_array($res2)) {

$barrio_nro = $barrio["Barrio_nro"];
$total_lotes = $barrio['Barrio_parcelas_cant'];


$sql6 = "SELECT COUNT(*) total FROM dbo_familia WHERE Barrio_nro = '$barrio_nro' AND blnActivo != '0' AND Familia_matricula != '0'";
$res6 = mysql_query($sql6);
$fila2 = mysql_fetch_assoc($res6);
$total_esc = $fila2['total'];


$sql7 = "SELECT COUNT(*) total FROM dbo_familia WHERE Barrio_nro = '$barrio_nro' AND blnActivo != '0' AND Familia_matricula = '0' AND Expte_esc_nro !='0'" ;
$res7 = mysql_query($sql7);
$fila3 = mysql_fetch_assoc($res7);
$total_entramite = $fila3['total'];	



 ?>

            <tr>
              <td width="52%"><? echo $barrio["Barrio_nombre"]; ?>&nbsp;</td>
              <td width="18%" align="center"><?=$barrio['Barrio_parcelas_cant']; ?>&nbsp;</td>
              <td width="16%" align="center"><?=$fila2['total']; ?>&nbsp;</td>
              <td width="14%" align="center"><?=$fila3['total']; ?>&nbsp;</td>
            </tr>
            <?
$suma1 = $suma1 + $barrio['Barrio_parcelas_cant'];
$suma2 = $suma2 + $fila2['total'];
$suma3 = $suma3 + $fila3['total'];			
			
			 } ?>
            <tr>
              <td height="26" align="right" bgcolor="#F3F3E9"><strong>Total:</strong></td>
              <td align="center" bgcolor="#F3F3E9"><?=$suma1; ?></td>
              <td align="center" bgcolor="#F3F3E9"><?=$suma2; ?></td>
              <td align="center" bgcolor="#F3F3E9"><?=$suma3; ?></td>
            </tr>
          </table>      
          </td>
        </tr>		
	  <?
$suma1 = '0';
$suma2 = '0';
$suma3 = '0';			  
	   } ?>
    </table></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<? } ?>