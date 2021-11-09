<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$usuario_area = $user["Area_nro"];

$strSQL2 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido2 = mysql_query ($strSQL2);

$sql5 = "SELECT * FROM dbo_area WHERE Area_nro = '$usuario_area' AND blnHab = '1' ORDER BY Area_codigo";
$res5 = mysql_query($sql5);



//$sql = "SELECT * FROM dbo_comisiones WHERE Comision_area = $usuario_area ORDER BY Comision_fecha DESC";

$sql = "SELECT * FROM (
dbo_comisiones
INNER JOIN
dbo_partido
ON dbo_comisiones.Partido_nro = dbo_partido.Partido_nro
INNER JOIN
dbo_comision_estado
ON dbo_comisiones.Comision_estado = dbo_comision_estado.Comision_estado_nro
)
WHERE Comision_area = $usuario_area AND blnActivo = '1' ORDER BY Comision_fecha DESC";
$res = mysql_query($sql);

?>

<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="900" colspan="2"><h1>Historial de comisiones en el &aacute;rea</h1></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><a href="menu.php">Volver al menu</a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="13" align="left"><? if ($user["p785"]=='1') { ?><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="82"><a href="comisiones-listar-completo.php?date=201902"><img src="imagen/reporte-com.png" width="62" height="62" /></a></td>
        <td width="168">Ver reporte de comisiones</td> 
      </tr>
    </table><? } ?></td>
    <td align="right"><? if ($user["p782"]=='1') { ?><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="168">Dar de alta nueva comisión</td>
        <td width="82"><a href="comision-alta-form.php"><img src="imagen/comision-alta.jpg" width="65" height="62" /></a></td>
      </tr>
    </table><? } ?></td>
  </tr>
  <tr>
    <td height="13" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="960" border="0" cellspacing="5" cellpadding="5">
      <tr bgcolor="#EFDCDC">
        <td width="6%" height="30" align="center" bgcolor="#D2D8BC"><strong>Fecha</strong></td>
        <td width="15%" align="center" bgcolor="#D2D8BC"><strong>Destino (Partido)</strong></td>
        <td width="7%" align="center" bgcolor="#D2D8BC"><strong>Días</strong></td>
        <td width="7%" align="center" bgcolor="#D2D8BC"><strong>Agentes</strong></td>
        <td width="17%" align="center" bgcolor="#D2D8BC"><strong>Motivo</strong></td>
        <td width="8%" align="center" bgcolor="#D2D8BC"><strong>Cantidad</strong></td>
        <td width="9%" align="center" bgcolor="#D2D8BC"><strong>Resultado</strong></td>
        <td width="6%" align="center" bgcolor="#D2D8BC"><strong>Dif.</strong></td>
        <td align="center" bgcolor="#D2D8BC"><strong>Estado</strong></td>
        <td width="11%" align="center" bgcolor="#D2D8BC"><strong>Acciones</strong></td>
        </tr>
      <?
	  $num_fila = '0';
	   while($comision = mysql_fetch_array($res)) { 
	  $comision_nro = $comision["Comision_nro"]; 
	  $fecha = cambiaf_a_normal($comision["Comision_fecha"]);
	  $partido = $comision["Partido_nombre"];	  
	  $motivo = $comision["Comision_motivo"];
	  $cantidad = $comision["Comision_tarea_cant"];
	  $resultado = $comision["Comision_resultado_cant"];
	  $estado = $comision["Comision_estado_nombre"];
	  
       ?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#EBEDE0\""; }else{ echo "bgcolor=\"#E2E4D3\"";} ?>>
        <td height="28" align="center"><?=$fecha?></td>
        <td align="center"><?=$partido; ?></td>
        <td align="center"><?=$comision["Comision_dias_cant"]; ?>&nbsp;</td>
        <td align="center"><?=$comision["Comision_agentes_cant"]; ?></td>
        <td align="center"><?=$motivo; ?></td>
        <td align="center"><?=$cantidad; ?></td>
        <td align="center"><?=$resultado; ?></td>
        <td align="center"><? echo $cantidad-$resultado; ?></td>
        <td width="14%" align="center" <? if($estado == 'Pendiente') { ?> style="color:#FF0000;"<? } ?>><? echo $estado; ?></td>
        <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25%" align="center"><a href=javascript:ventana_imprimir('comision-informe.php?idComision=<?=$comision_nro; ?>') >
        <img src="imagen/doc.png" alt="Ver informe comisi&oacute;n" width="11" height="16" border="0" title="Ver detalles de la comisi&oacute;n"/></a></td>
        <td width="46%" align="center"><a href=javascript:ventana_imprimir('comision-pedido-imp.php?idComision=<?=$comision_nro; ?>') ><img src="imagen/imp.png" title="Imprimir pedido comision" width="20" height="20" /></a></td>
        <td width="29%" align="center"><img src="imagen/delete.gif" width="16" height="16" /></td>
      </tr>
    </table></td>
        </tr>
      <?
	  $num_fila++;
	   } ?>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<? include("pie.php");
 } ?>