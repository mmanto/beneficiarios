<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

$remito_nro = $_POST["remito_nro"];

include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$ResUsr = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($ResUsr);
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];
$usuario_area = $user["Area_nro"];

$sql3 = mysql_query("SELECT* FROM dbo_exptesmov_remitos WHERE Remito_nro = '$remito_nro' AND blnActivo = '1' ORDER BY Remito_nro DESC",$link);

$cant = mysql_num_rows($sql3);


?>
<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h1>Remitos coincidentes con su b&uacute;squeda  (cant: <?=$cant; ?>) </h1></td>
  </tr>
  <tr>
    <td width="746" height="6">Listado de remitos correspondientes a los pases generados por el &aacute;rea.. </td>
    <td width="154">&nbsp;</td>
  </tr>
  <tr>
    <td height="36" colspan="2" valign="middle"><a href="expte-buscar.php">[Volver a la b&uacute;squeda]</a></td>
  </tr>
  <tr>
    <td height="30" colspan="2" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center">
	<table width="860" border="0" cellpadding="4" cellspacing="5">
      <tr bgcolor="#CCCCCC">
        <td width="91" height="24" align="center" bgcolor="#DFE2A9" class="titulo_dato">Remito N&ordm;</td>
		  <td width="73" align="center" bgcolor="#DFE2A9" class="titulo_dato">Fecha</td>
		  <td width="70" align="center" bgcolor="#DFE2A9" class="titulo_dato">Hora</td>
          <td width="242" align="center" bgcolor="#DFE2A9" class="titulo_dato">Origen</td>
          <td width="242" align="center" bgcolor="#DFE2A9" class="titulo_dato">Destino</td>
          <td width="67" align="center" bgcolor="#DFE2A9" class="titulo_dato">&nbsp;</td>
        </tr>
  <?
$num_fila = '0'; 

while ($remito = mysql_fetch_array($sql3)) {	

$remito_nro = $remito["Remito_nro"];
$remito_fecha = cambiaf_a_normal($remito_fecha = $remito["Remito_fecha"]);
$remito_hora = $remito["Remito_hora"];

//Origen remito
//Destino remito
$area_origen = $remito["Remito_area_origen"];
$res9 = mysql_query("SELECT Area_nombre FROM dbo_area WHERE Area_nro = '$area_origen'");
$origen = mysql_fetch_array($res9);
$remito_origen = $origen["Area_nombre"];

//Destino remito
$area_destino = $remito["Remito_area_destino"];
$res6 = mysql_query("SELECT Area_nombre FROM dbo_area WHERE Area_nro = '$area_destino'");
$destino = mysql_fetch_array($res6);
$remito_destino = $destino["Area_nombre"];




?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#E8EBD6\""; } ?>>
        <td align="center" ><?=$remito_nro; ?></td>
		  <td align="center"><?=$remito_fecha; ?></td>
		  <td align="center"><?=$remito_hora; ?></td>		
          <td align="center"><?=$remito_origen; ?>&nbsp;</td>
          <td align="center"><?=$remito_destino; ?></td>
          <td align="center" ><a href=javascript:ventana_imprimir('remito-imp.php?idRemito=<?=$remito_nro; ?>')>Ver remito </a></td>
        </tr>
      
      <? 
	  $num_fila++; 	  
	  } ?>
	  <tr>
	  	<td>&nbsp;</td><td>&nbsp;</td>
	  	<td>&nbsp;</td>
	  	<td colspan="2">&nbsp;</td>
	  	<td>&nbsp;</td>
	  	</tr>
	  <tr>
	    <td colspan="6" align="right">&nbsp;</td>
	    </tr>
    </table>
	</td>
  </tr>
  <tr><td colspan="10">&nbsp;</td></tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
</table>
<?  
include("pie.php");

 } ?>