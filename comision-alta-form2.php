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

$strSQL2 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido2 = mysql_query ($strSQL2);

$sql5 = "SELECT * FROM dbo_area WHERE Area_comisiona = '1' AND blnHab = '1' ORDER BY Area_codigo";
$res5 = mysql_query($sql5);

//Listado de agentes

$sql = "SELECT agente_nro, agente_apellido, agente_nombre FROM dbo_agentes WHERE agente_comisiona = '1' AND blnActivo = '1' ORDER BY agente_apellido";
$res = mysql_query($sql);

$i = '1';

?>

<h1>Dar de alta nueva comisi&oacute;n</h1>
<p> <a href="comisiones-listar-area.php">Volver</a></p>
<form action="comision-alta2.php" method="post">
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="22" height="45">&nbsp;</td>
    <td width="95">Fecha comisión:</td>
    <td colspan="4"><input name="comision_fecha_dia" type="text" id="pago_fecha_dia" value="dd" size="2" maxlength="2">
      /
      <input name="comision_fecha_mes" type="text" id="pago_fecha_mes" value="mm" size="2" maxlength="2" />
      / 
      <input name="comision_fecha_anio" type="text" id="pago_fecha_anio" value="aaaa" size="3" maxlength="4" />      
      Utilice <strong>DOS</strong> d&iacute;gitos para d&iacute;a, <strong>DOS</strong> para mes, y <strong>CUATRO</strong> para el a&ntilde;o.</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>Hora salida:</td>
    <td><input name="comision_hora_salida" type="text" id="comision_hora_salida" size="3" /> 
      (formato hh:mm)</td>
    <td>Area solicitante:</td>
    <td><select name="comision_area" onchange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
      <option value="0">Seleccione un &aacute;rea...</option>
  <?      while ($area = mysql_fetch_array($res5)) { ?>
      <option value="<?=$area["Area_nro"]; ?>" <? if($area["Area_nro"] == $user["Area_nro"]) { ?>selected="selected" <? } ?>><?=$area["Area_codigo"]; ?> - <?=$area["Area_nombre"]; ?></option>
      <? } ?>
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>Partido destino:</td>
    <td width="235"><select name="partido_nro" id="partido_nro" onChange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
	<? while($rsPart2 = mysql_fetch_array($partido2)) { ?><option value =<?=$rsPart2["Partido_nro"]; ?>><?=$rsPart2["Partido_nombre"]; } ?>
    </select></td>
    <td width="118">Barrio destino:</td>
    <td width="259"><label for="comision_barrio"></label>
    <input type="text" name="comision_barrio" id="comision_barrio"></td>
    <td width="71">&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>Domicilio destino</td>
    <td colspan="3"><input name="comision_domicilio" type="text" id="comision_domicilio" size="60" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>Motivo:</td>
    <td colspan="3"><input name="comision_motivo" type="text" id="comision_motivo" size="80" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>Cant. días:</td>
    <td><input name="comision_dias_cant" type="text" id="comision_dias_cant" size="3"> 
      (sólo valor numérico)</td>
    <td>Cant. agentes:</td>
    <td><input name="comision_agentes_cant" type="text" id="comision_agentes_cant" size="3">
(sólo valor numérico)</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td valign="bottom">Objetivo (cant.):</td>
    <td valign="bottom"><input name="comision_tarea_cant" type="text" id="comision_tarea_cant" size="3"> 
    (sólo valor numérico)</td>
    <td valign="bottom">Objetivo (concepto):</td>
    <td colspan="2" valign="bottom"><input name="comision_tarea_concepto" type="text" id="comision_tarea_concepto" size="30"></td>
  </tr>
  <tr>
    <td></td>
    <td height="20">&nbsp;</td>
    <td height="20">&nbsp;</td>
    <td height="20">&nbsp;</td>
    <td height="20">(Por ej: censos/trámites/parcelas)</td>
  </tr>
  <tr>
    <td height="45"></td>
    <td height="20">Resultado:</td>
    <td height="20"><input name="comision_resultado" type="text" id="comision_resultado" size="3" />
(sólo valor numérico)</td>
    <td height="20">Estado:</td>
    <td height="20"><select name="comision_estado" onchange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
      <option value="1">Pendiente</option>
      <option value="4">Cancelada</option>
      <option value="5">Cumplida</option>
    </select></td>
  </tr>
  <tr>
  	<td height="20" colspan="5"></td>
  </tr>
  <tr>
    <td height="36">&nbsp;</td>
    <td valign="top">Próxima tarea:</td>
    <td rowspan="2" valign="top"><textarea name="comision_proxima_tarea" cols="32" rows="4" id="comision_proxima_tarea"></textarea></td>
    <td valign="top">Observaciones:</td>
    <td rowspan="2" valign="top"><textarea name="comision_observaciones" cols="40" rows="4" id="comision_observaciones"></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td colspan="5"><h2>Seleccione los agentes que integrarán la comisión</h2></td>
    </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td colspan="5"><table width="688" border="0" cellspacing="2" cellpadding="3">
  <? while($agente = mysql_fetch_array($res)) { ?>
  <tr>
    <td width="64">&nbsp;</td>
    <td width="20"><input type="checkbox" name="seleccion[]" value="<?=$agente["agente_nro"]; ?>"></td>
    <td width="271"><strong><?=$agente["agente_apellido"]; ?></strong>, <?=$agente["agente_nombre"]; ?></td>
    <td width="299">&nbsp;</td>
  </tr>
  <? $i++;
   } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</td>
    </tr>
  <tr>
    <td height="120">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td colspan="2" align="center" valign="top"><input type="submit" name="button" id="button" value="Dar de alta comisi&oacute;n"></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<? } ?>