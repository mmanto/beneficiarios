<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{
	
$date = $_GET["date"];	
	
$anio = substr($_GET["date"], 0, 4);

$mes = substr($_GET["date"], 4, 2);

//$anio = $_GET["anio"];
//$mes = $_GET["mes"];

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
WHERE Comision_area = 83 AND Comision_anio = $anio AND Comision_mes = $mes AND blnActivo = '1' ORDER BY Comision_fecha DESC";
$res = mysql_query($sql);




?>

<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><h1>Registro de comisiones de la Dirección Provincial</h1></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><a href="comisiones-listar-area.php">Volver</a></td>
  </tr>
  <tr>
    <td height="13" colspan="3" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td width="126" height="6">Mostrar mes y año:</td>
    <td width="195" height="6">
    <form><select name="ListeUrl" onChange="ChangeUrl(this.form)">
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?date=201904" <? if ($date == '201904') { ?> selected="selected" <? } ?>>Abril 2019</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?date=201903" <? if ($date == '201903') { ?> selected="selected" <? } ?>>Marzo 2019</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?date=201902" <? if ($date == '201902') { ?> selected="selected" <? } ?>>Febrero 2019</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?date=201901" <? if ($date == '201901') { ?> selected="selected" <? } ?>>Enero 2019</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?date=201812" <? if ($date == '201812') { ?> selected="selected" <? } ?>>Diciembre 2018</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?date=201811" <? if ($date == '201811') { ?> selected="selected" <? } ?>>Noviembre 2018</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?date=201810" <? if ($date == '201810') { ?> selected="selected" <? } ?>>Octubre 2018</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?date=201809" <? if ($date == '201809') { ?> selected="selected" <? } ?>>Septiembre 2018</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?date=201808" <? if ($date == '201808') { ?> selected="selected" <? } ?>>Agosto 2018</option>
      <option value="<?=basename($_SERVER['PHP_SELF']); ?>?date=201807" <? if ($date == '201807') { ?> selected="selected" <? } ?>>Julio 2018</option>
    </select></form></td>
    <td width="679"><a href="comisiones-listar-completo-imp.php?date=<?=$date; ?>">[Versión para imprimir]</a></td>
  </tr>
  <tr>
    <td height="6" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" colspan="3"><h2><strong>Dir. Gestión Escrituraria</strong></h2></td>
  </tr>
  <tr>
    <td colspan="3"><table width="1000" border="0" cellspacing="5" cellpadding="5">
      <tr bgcolor="#EFDCDC">
        <td width="8%" height="30" align="center" bgcolor="#D2D8BC"><strong>Fecha</strong></td>
        <td width="15%" align="center" bgcolor="#D2D8BC"><strong>Destino (Partido)</strong></td>
        <td width="13%" align="center" bgcolor="#D2D8BC"><strong>Motivo</strong></td>
        <td width="11%" align="center" bgcolor="#D2D8BC"><strong>Estado</strong></td>
        <td width="8%" align="center" bgcolor="#D2D8BC"><strong>Objetivo</strong></td>
        <td width="8%" align="center" bgcolor="#D2D8BC"><strong>Resultado</strong></td>
        <td width="9%" align="center" bgcolor="#D2D8BC"><strong>Efectividad</strong></td>
        <td width="24%" align="center" bgcolor="#D2D8BC"><strong>Observaciones</strong></td>
        <td width="4%" align="center" bgcolor="#D2D8BC">&nbsp;</td>
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
        <td align="center"><?=$motivo; ?></td>
        <td align="center"><? echo $estado; ?></td>
        <td align="center"><?=$cantidad; ?></td>
        <td align="center"><?=$resultado; ?></td>
        <td align="center"><?
		$efect = ($resultado/$cantidad)*100;		
		echo round($efect, 1) ?> %</td>
        <td align="center"><?=$comision["Comision_observaciones"];?>&nbsp;</td>
        <td align="center"><a href=javascript:ventana_imprimir('comision-informe.php?idComision=<?=$comision_nro; ?>') >
        <img src="imagen/doc.png" alt="Ver informe comisi&oacute;n" width="11" height="16" border="0" title="Ver detalles de la comisi&oacute;n"/></a></td>
      </tr>
      <?
	  $num_fila++;
	   } ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><h2><strong>Depto. Social</strong></h2>
<?
$sql = "SELECT * FROM (
dbo_comisiones
INNER JOIN
dbo_partido
ON dbo_comisiones.Partido_nro = dbo_partido.Partido_nro
INNER JOIN
dbo_comision_estado
ON dbo_comisiones.Comision_estado = dbo_comision_estado.Comision_estado_nro
)
WHERE Comision_area = 72 AND Comision_anio = $anio AND Comision_mes = $mes AND blnActivo = '1' ORDER BY Comision_fecha DESC";
$res = mysql_query($sql); ?>    
    
</td>
  </tr>
  <tr>
    <td colspan="3"><table width="1000" border="0" cellspacing="5" cellpadding="5">
      <tr bgcolor="#EFDCDC">
        <td width="8%" height="30" align="center" bgcolor="#D2D8BC"><strong>Fecha</strong></td>
        <td width="15%" align="center" bgcolor="#D2D8BC"><strong>Destino (Partido)</strong></td>
        <td width="13%" align="center" bgcolor="#D2D8BC"><strong>Motivo</strong></td>
        <td width="11%" align="center" bgcolor="#D2D8BC"><strong>Estado</strong></td>
        <td width="8%" align="center" bgcolor="#D2D8BC"><strong>Objetivo</strong></td>
        <td width="8%" align="center" bgcolor="#D2D8BC"><strong>Resultado</strong></td>
        <td width="9%" align="center" bgcolor="#D2D8BC"><strong>Efectividad</strong></td>
        <td width="24%" align="center" bgcolor="#D2D8BC"><strong>Observaciones</strong></td>
        <td width="4%" align="center" bgcolor="#D2D8BC">&nbsp;</td>
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
        <td align="center"><?=$motivo; ?></td>
        <td align="center"><? echo $estado; ?></td>
        <td align="center"><?=$cantidad; ?></td>
        <td align="center"><?=$resultado; ?></td>
        <td align="center"><?
		$efect = ($resultado/$cantidad)*100;		
		echo round($efect, 1) ?>
          %</td>
        <td align="center"><?=$comision["Comision_observaciones"];?>
          &nbsp;</td>
        <td align="center"><a href="javascript:ventana_imprimir('comision-informe.php?idComision=<?=$comision_nro; ?>')" > <img src="imagen/doc.png" alt="Ver informe comisión" width="11" height="16" border="0" title="Ver detalles de la comisión"/></a></td>
      </tr>
      <?
	  $num_fila++;
	   } ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><h2><strong>Depto. Técnico</strong></h2>
<?
$sql = "SELECT * FROM (
dbo_comisiones
INNER JOIN
dbo_partido
ON dbo_comisiones.Partido_nro = dbo_partido.Partido_nro
INNER JOIN
dbo_comision_estado
ON dbo_comisiones.Comision_estado = dbo_comision_estado.Comision_estado_nro
)
WHERE Comision_area = 73 AND Comision_anio = $anio AND Comision_mes = $mes AND blnActivo = '1' ORDER BY Comision_fecha DESC";
$res = mysql_query($sql); ?>    
    
</td>
  </tr>
  <tr>
    <td colspan="3"><table width="1000" border="0" cellspacing="5" cellpadding="5">
      <tr bgcolor="#EFDCDC">
        <td width="8%" height="30" align="center" bgcolor="#D2D8BC"><strong>Fecha</strong></td>
        <td width="15%" align="center" bgcolor="#D2D8BC"><strong>Destino (Partido)</strong></td>
        <td width="13%" align="center" bgcolor="#D2D8BC"><strong>Motivo</strong></td>
        <td width="11%" align="center" bgcolor="#D2D8BC"><strong>Estado</strong></td>
        <td width="8%" align="center" bgcolor="#D2D8BC"><strong>Objetivo</strong></td>
        <td width="8%" align="center" bgcolor="#D2D8BC"><strong>Resultado</strong></td>
        <td width="9%" align="center" bgcolor="#D2D8BC"><strong>Efectividad</strong></td>
        <td width="24%" align="center" bgcolor="#D2D8BC"><strong>Observaciones</strong></td>
        <td width="4%" align="center" bgcolor="#D2D8BC">&nbsp;</td>
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
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#EBEDE0\""; }else{ echo "bgcolor=\"#E2E4D3\"";} ?> 
      <? if ($estado == "Pendiente") { ?>style="color:#666";  <? } ?>
      
      >
        <td height="28" align="center"><?=$fecha?></td>
        <td align="center"><?=$partido; ?></td>
        <td align="center"><?=$motivo; ?></td>
        <td align="center"><? echo $estado; ?></td>
        <td align="center"><?=$cantidad; ?></td>
        <td align="center"><?=$resultado; ?></td>
        <td align="center"><?
		$efect = ($resultado/$cantidad)*100;		
		echo round($efect, 1) ?>
          %</td>
        <td align="center"><?=$comision["Comision_observaciones"];?>
          &nbsp;</td>
        <td align="center"><a href="javascript:ventana_imprimir('comision-informe.php?idComision=<?=$comision_nro; ?>')" > <img src="imagen/doc.png" alt="Ver informe comisión" width="11" height="16" border="0" title="Ver detalles de la comisión"/></a></td>
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