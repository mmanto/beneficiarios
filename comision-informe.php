<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

$idComision = $_GET["idComision"];

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
/*
$strSQL2 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido2 = mysql_query ($strSQL2);
*/
$sql = "SELECT * FROM (
dbo_comisiones
INNER JOIN
dbo_partido
ON dbo_comisiones.Partido_nro = dbo_partido.Partido_nro
INNER JOIN
dbo_comision_estado
ON dbo_comisiones.Comision_estado = dbo_comision_estado.Comision_estado_nro
INNER JOIN
dbo_area
ON dbo_comisiones.Comision_area = dbo_area.Area_nro
) WHERE Comision_nro = $idComision";

$res = mysql_query($sql);
$comision = mysql_fetch_array($res);
$fecha = $comision["Comision_fecha"];

$comision_anio = substr($fecha, 0, 4);
$comision_mes = substr($fecha, 5, 2);
$comision_dia = substr($fecha, 8, 2);

/*
$sql5 = "SELECT * FROM dbo_area WHERE Area_comisiona = '1' AND blnHab = '1' ORDER BY Area_codigo";
$res5 = mysql_query($sql5);
*/

$sql2 = "SELECT * FROM (
dbo_comision_agentes
INNER JOIN
dbo_agentes
ON dbo_comision_agentes.Agente_nro = dbo_agentes.agente_nro
) WHERE Comision_nro = $idComision";
$res2 = mysql_query($sql2);
$cant = mysql_num_rows($res2);

?>
<h1>Informe de comisi&oacute;n</h1>
<form action="comision-modif.php" method="post">
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="22" height="35">&nbsp;</td>
    <td width="130" style="font-size:14px"><strong>Fecha comisión:</strong></td>
    <td colspan="4" style="font-size:14px"><?=$comision_dia; ?>/<?=$comision_mes; ?><?=$comision_anio; ?> - <strong>Cant. d&iacute;as:</strong> <?=$comision["Comision_dias_cant"]; ?></td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td style="font-size:14px"><strong>Area solicitante:</strong></td>
    <td colspan="3" style="font-size:14px"><?=$comision["Area_nombre"]; ?>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td style="font-size:14px"><strong>Partido destino:</strong></td>
    <td width="192" style="font-size:14px"><?=$comision["Partido_nombre"]; ?></td>
    <td width="162" style="font-size:14px"><strong>Barrio destino:</strong></td>
    <td width="244" style="font-size:14px"><?=$comision["Comision_barrio"]; ?></td>
    <td width="50" style="font-size:14px">&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td style="font-size:14px"><strong>Domicilio:</strong></td>
    <td colspan="4" style="font-size:14px"><?=$comision["Comision_domicilio"]; ?>&nbsp;</td>
    </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td style="font-size:14px"><strong>Objetivo (cant.):</strong></td>
    <td style="font-size:14px"><?=$comision["Comision_tarea_cant"]; ?></td>
    <td style="font-size:14px"><strong>Objetivo (concepto):</strong></td>
    <td colspan="2" style="font-size:14px"><?=$comision["Comision_tarea_concepto"]; ?></td>
  </tr>
  <tr>
    <td height="35"></td>
    <td style="font-size:14px"><strong>Resultado (cant.):</strong></td>
    <td style="font-size:14px"><?=$comision["Comision_resultado_cant"]; ?></td>
    <td style="font-size:14px"><strong>Estado:</strong></td>
    <td style="font-size:14px"><?=$comision["Comision_estado_nombre"]; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="20" colspan="6"></td>
  </tr>
  <tr>
    <td height="36">&nbsp;</td>
    <td valign="top" style="font-size:14px"><strong>Próxima tarea:</strong></td>
    <td rowspan="2" valign="top" style="font-size:14px"><?=$comision["Comision_proxima_tarea"]; ?></td>
    <td valign="top" style="font-size:14px"><strong>Observaciones:</strong></td>
    <td rowspan="2" valign="top" style="font-size:14px"><?=$comision["Comision_observaciones"]; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td valign="top" style="font-size:14px">&nbsp;</td>
    <td colspan="2" valign="top" style="font-size:14px">&nbsp;</td>
    <td colspan="2" align="right" style="color:#333"><? if ($user["p783"] == '1')  { ?><a href=" comision-modif-form.php?idComision=<?=$idComision; ?>">[Editar información de la comision]</a><? } ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="3" bgcolor="#D7D7D7"></td>
    <td height="3" bgcolor="#D7D7D7"></td>
    <td height="3" bgcolor="#D7D7D7"></td>
    <td height="3" bgcolor="#D7D7D7"></td>
    <td height="3" bgcolor="#D7D7D7"></td>
    <td height="3" bgcolor="#D7D7D7"></td>
  </tr>
  <tr>
    <td height="26" colspan="6"><a href="#"></a></td>
    </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td valign="top" style="font-size:14px"><strong>Integrantes (<?=$cant; ?>):</strong></td>
    <td colspan="2" rowspan="2" valign="top" style="font-size:14px"><table width="90%" border="0" cellspacing="0" cellpadding="5">
      <? while($agente = mysql_fetch_array($res2)) { ?>
      <tr>
        <td height="24" valign="top" style="font-size:14px">- <? echo "<strong>".$agente["agente_apellido"]."</strong>, ".$agente["agente_nombre"]; ?> <? if ($user["p783"] == '1')  { ?><a href="comision-agente-borrar-confirm.php?idComAgente=<?=$agente["Comision_agente_nro"]; ?>&idComision=<?=$idComision; ?>">[Quitar]</a><? } ?></td>
      </tr>
      <? } ?>
      <? if ($user["p783"] == '1' && $comision["Comision_estado"] != '4' && $comision["Comision_estado"] != '5')  { ?><tr>
        <td height="30" align="center" bgcolor="#FFFF66" style="font-size:12px"><a href="comision-agente-alta-form.php?idComision=<? echo $idComision; ?>">[Agregar nuevo integrante]</a></td>
      </tr><? } ?>
    </table></td>
    <td align="right" style="color:#333">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td colspan="3" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<? } ?>