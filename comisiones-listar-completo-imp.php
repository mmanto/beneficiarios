<?
$date = $_GET["date"];	
	
$anio = substr($_GET["date"], 0, 4);

$mes = substr($_GET["date"], 4, 2);


if($mes == '01') { $mesletras = "Enero"; }
elseif ($mes == '02') { $mesletras = "Febrero"; }
elseif ($mes == '03') { $mesletras = "Marzo"; }
elseif ($mes == '04') { $mesletras = "Abril"; }
elseif ($mes == '05') { $mesletras = "Mayo"; }
elseif ($mes == '06') { $mesletras = "Junio"; }
elseif ($mes == '07') { $mesletras = "Julio"; }
elseif ($mes == '08') { $mesletras = "Agosto"; }
elseif ($mes == '09') { $mesletras = "Septiembre"; }
elseif ($mes == '10') { $mesletras = "Octubre"; }
elseif ($mes == '11') { $mesletras = "Noviembre"; }
else {$mesletras = "Diciembre"; }

include ("conec.php");
include ("funciones.php");
include ("cabecera-impresion.php");

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

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

?>
<table width="800" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="800" height="60" valign="bottom"><h1>Registro de comisiones - <? echo $mesletras; ?> <? echo $anio; ?></h1></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="comisiones-listar-completo.php?date=<?=$date;?>">Volver</a></td>
  </tr>
  <tr>
    <td height="13" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="6">&nbsp;</td>
  </tr>
  <tr>
    <td height="36"><h2><strong>Dir. Gesti&oacute;n Escrituraria</strong></h2></td>
  </tr>
  <tr>
    <td><table width="800" border="1" cellspacing="0" cellpadding="5">
      <tr bgcolor="#EFDCDC">
        <td width="8%" height="30" align="center" bgcolor="#D2D8BC"><strong>Fecha</strong></td>
        <td width="30%" align="center" bgcolor="#D2D8BC"><strong>Partido</strong></td>
        <td width="8%" align="center" bgcolor="#D2D8BC"><strong>Motivo</strong></td>
        <td width="9%" align="center" bgcolor="#D2D8BC"><strong>Estado</strong></td>
        <td width="10%" align="center" bgcolor="#D2D8BC"><strong>Objetivo</strong></td>
        <td width="10%" align="center" bgcolor="#D2D8BC"><strong>Resultado</strong></td>
        <td width="11%" align="center" bgcolor="#D2D8BC"><strong>Efectividad</strong></td>
        <td width="14%" align="center" bgcolor="#D2D8BC"><strong>Observaciones</strong></td>
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
        </tr>
      <?
	  $num_fila++;
	   } ?>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="36"><h2><strong>Depto. Social</strong></h2>
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
$res = mysql_query($sql); ?></td>
  </tr>
  <tr>
    <td><table width="800" border="1" cellspacing="0" cellpadding="5">
      <tr bgcolor="#EFDCDC">
        <td width="8%" height="30" align="center" bgcolor="#D2D8BC"><strong>Fecha</strong></td>
        <td width="30%" align="center" bgcolor="#D2D8BC"><strong>Partido</strong></td>
        <td width="8%" align="center" bgcolor="#D2D8BC"><strong>Motivo</strong></td>
        <td width="9%" align="center" bgcolor="#D2D8BC"><strong>Estado</strong></td>
        <td width="10%" align="center" bgcolor="#D2D8BC"><strong>Objetivo</strong></td>
        <td width="10%" align="center" bgcolor="#D2D8BC"><strong>Resultado</strong></td>
        <td width="11%" align="center" bgcolor="#D2D8BC"><strong>Efectividad</strong></td>
        <td width="14%" align="center" bgcolor="#D2D8BC"><strong>Observaciones</strong></td>
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
      </tr>
      <?
	  $num_fila++;
	   } ?>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="36"><h2><strong>Depto. T&eacute;cnico</strong></h2>
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
$res = mysql_query($sql); ?></td>
  </tr>
  <tr>
    <td><table width="800" border="1" cellspacing="0" cellpadding="5">
      <tr bgcolor="#EFDCDC">
        <td width="8%" height="30" align="center" bgcolor="#D2D8BC"><strong>Fecha</strong></td>
        <td width="30%" align="center" bgcolor="#D2D8BC"><strong>Partido</strong></td>
        <td width="8%" align="center" bgcolor="#D2D8BC"><strong>Motivo</strong></td>
        <td width="9%" align="center" bgcolor="#D2D8BC"><strong>Estado</strong></td>
        <td width="10%" align="center" bgcolor="#D2D8BC"><strong>Objetivo</strong></td>
        <td width="10%" align="center" bgcolor="#D2D8BC"><strong>Resultado</strong></td>
        <td width="11%" align="center" bgcolor="#D2D8BC"><strong>Efectividad</strong></td>
        <td width="14%" align="center" bgcolor="#D2D8BC"><strong>Observaciones</strong></td>
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
      </tr>
      <?
	  $num_fila++;
	   } ?>
    </table></td>
  </tr>
</table>
</body>