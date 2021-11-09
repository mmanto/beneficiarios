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

$strSQL2 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido2 = mysql_query ($strSQL2);

$sql = "SELECT * FROM dbo_comisiones WHERE Comision_nro = $idComision";
$res = mysql_query($sql);
$comision = mysql_fetch_array($res);
$fecha = $comision["Comision_fecha"];

$comision_anio = substr($fecha, 0, 4);
$comision_mes = substr($fecha, 5, 2);
$comision_dia = substr($fecha, 8, 2);


$sql5 = "SELECT * FROM dbo_area WHERE Area_comisiona = '1' AND blnHab = '1' ORDER BY Area_codigo";
$res5 = mysql_query($sql5);

?>
<h1>Modificar datos comisi&oacute;n</h1>
<form action="comision-modif.php" method="post">
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="15" colspan="6"><a href="comision-informe.php?idComision=<?=$idComision; ?>">[Volver]</a></td>
    </tr>
  <tr>
    <td height="15">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="22" height="45">&nbsp;</td>
    <td width="95">Fecha comisión:</td>
    <td colspan="4"><input name="comision_fecha_dia" type="text" id="pago_fecha_dia" value="<?=$comision_dia; ?>" size="2" maxlength="2">
      /
      <input name="comision_fecha_mes" type="text" id="pago_fecha_mes" value="<?=$comision_mes; ?>" size="2" maxlength="2" />
      / 
      <input name="comision_fecha_anio" type="text" id="pago_fecha_anio" value="<?=$comision_anio; ?>" size="3" maxlength="4" />      
      Utilice <strong>DOS</strong> d&iacute;gitos para d&iacute;a, <strong>DOS</strong> para mes, y <strong>CUATRO</strong> para el a&ntilde;o.</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>Hora salida:</td>
    <td><input name="comision_hora_salida" type="text" id="comision_hora_salida" size="6" value="<?=$comision["Comision_hora_salida"]; ?>" /> 
      (formato hh:mm)</td>
    <td>Area solicitante:</td>
    <td><select name="comision_area" onchange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
      <option value="0">Seleccione un &aacute;rea...</option>
  <?      while ($area = mysql_fetch_array($res5)) { ?>
      <option value="<?=$area["Area_nro"]; ?>" <? if($comision["Comision_area"] == $area["Area_nro"]) { ?> selected="selected"<? } ?> ><?=$area["Area_codigo"]; ?> - <?=$area["Area_nombre"]; ?></option>
      <? } ?>
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>Partido destino:</td>
    <td width="235"><select name="partido_nro" id="partido_nro" onChange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart2 = mysql_fetch_array($partido2)) { ?> <option value = <? echo $rsPart2["Partido_nro"]; ?> <? if($rsPart2["Partido_nro"] == $comision["Partido_nro"]) { ?>selected="selected"<? } ?>><? echo $rsPart2["Partido_nombre"]; } ?>
    </select></td>
    <td width="118">Barrio destino:</td>
    <td width="308"> <input type="text" name="comision_barrio" id="comision_barrio" value="<?=$comision["Comision_barrio"]; ?>"></td>
    <td width="22">&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>Domicilio destino</td>
    <td colspan="2"><input name="comision_domicilio" type="text" id="comision_domicilio" size="50" value="<?=$comision["Comision_domicilio"]; ?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>Motivo:</td>
    <td colspan="2"><input name="comision_motivo" type="text" id="comision_motivo" size="50" value="<?=$comision["Comision_motivo"]; ?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>Cant. días:</td>
    <td><input name="comision_dias_cant" type="text" id="comision_dias_cant" size="3" value="<?=$comision["Comision_dias_cant"]; ?>"> 
      (sólo valor numérico)</td>
    <td>Cant. agentes:</td>
    <td><input name="comision_agentes_cant" type="text" id="comision_agentes_cant" size="3" value="<?=$comision["Comision_agentes_cant"]; ?>">
(sólo valor numérico)</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>Objetivo (cant.):</td>
    <td><input name="comision_tarea_cant" type="text" id="comision_tarea_cant" size="3" value="<?=$comision["Comision_tarea_cant"]; ?>"> 
    (sólo valor numérico)</td>
    <td>Objetivo (concepto):</td>
    <td colspan="2"><input name="comision_tarea_concepto" type="text" id="comision_tarea_concepto" value="<?=$comision["Comision_tarea_concepto"]; ?>" size="35"></td>
  </tr>
  <tr>
    <td height="45"></td>
    <td height="45">Resultado:</td>
    <td height="45"><input name="comision_resultado_cant" type="text" id="comision_resultado_cant" size="3" value="<?=$comision["Comision_resultado_cant"]; ?>"/>
(sólo valor numérico)</td>
    <td height="45">Estado:</td>
    <td height="45"><select name="comision_estado" onchange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
      <option value="0">Seleccione un estado...</option>
      <option value="1" <? if($comision["Comision_estado"] == '1') { ?> selected="selected"<? } ?> >Pendiente</option>
      <option value="4" <? if($comision["Comision_estado"] == '4') { ?> selected="selected"<? } ?> >Cancelada</option>
      <option value="5" <? if($comision["Comision_estado"] == '5') { ?> selected="selected"<? } ?> >Cumplida</option>
    </select></td>
  </tr>
  <tr>
  	<td height="20" colspan="5"></td>
  </tr>
  <tr>
    <td height="36">&nbsp;</td>
    <td valign="top">Próxima tarea:</td>
    <td rowspan="2" valign="top"><textarea name="comision_proxima_tarea" cols="32" rows="8" id="comision_proxima_tarea"><?=$comision["Comision_proxima_tarea"]; ?></textarea></td>
    <td valign="top">Observaciones:</td>
    <td rowspan="2" valign="top"><textarea name="comision_observaciones" cols="45" rows="8" id="comision_observaciones"><?=$comision["Comision_observaciones"]; ?></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top"><input type="hidden" name="comision_nro" value="<?=$idComision; ?>" >&nbsp;</td>
    <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Actualizar datos comisión"></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<? } ?>