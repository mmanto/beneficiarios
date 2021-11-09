<? 

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idAgente = $_GET["idAgente"];

$sql = "SELECT agente_nombre, agente_apellido FROM dbo_agentes WHERE agente_nro = $idAgente";
$res = mysql_query($sql);
$agente = mysql_fetch_array($res);

$sql2 = "SELECT * FROM dbo_agente_licencia WHERE agente_nro = $idAgente AND blnActivo = '1'";
$res2 = mysql_query($sql2);

$sql3 = "SELECT * FROM dbo_agente_licencia_anual WHERE agente_nro = $idAgente ORDER BY licencia_anual_anio";
$res3 = mysql_query($sql3);

?>
<h1>Gesti&oacute;n de licencias (Agente: <? echo $agente["agente_apellido"].", ".$agente["agente_nombre"]; ?>)</h1>
<table width="850" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td height="33" colspan="3" align="left" valign="bottom"><h2>Licencias disponibles (anual)</h2></td>
    <td height="33" align="left">&nbsp;</td>
    <td height="33" align="left">&nbsp;</td>
    <td height="33" align="left">&nbsp;</td>
    <td height="33" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="15" colspan="4" align="left" valign="top"><table width="100%" border="0" cellspacing="3" cellpadding="5">
      <tr>
        <td width="22%" height="28" align="center" bgcolor="#C0D1D0"><strong>A&ntilde;o</strong></td>
        <td width="21%" align="center" bgcolor="#C0D1D0"><strong>Total</strong></td>
        <td width="17%" align="center" bgcolor="#C0D1D0"><strong>Utilizados</strong></td>
        <td width="19%" align="center" bgcolor="#C0D1D0"><strong>Disponibles</strong></td>
        <td width="21%" align="center" bgcolor="#C0D1D0"><strong>Acciones</strong></td>
        </tr>
      <? 
	  $num_fila = '0';
	  while($anual = mysql_fetch_array($res3)) {
	  $dias_utilizados = $anual["licencia_anual_total"] - $anual["licencia_anual_restante"];
	 ?>
      <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DEE7E6\""; }else{ echo "bgcolor=\"#D2DFDE\"";} ?>>
        <td align="center"><? echo $anual["licencia_anual_anio"]; ?>&nbsp;</td>
        <td align="center"><? echo $anual["licencia_anual_total"]; ?> dias</td>
        <td align="center"><? echo $dias_utilizados; ?>&nbsp;dias</td>
        <td align="center"><? echo $anual["licencia_anual_restante"]; ?> dias</td>
        <td align="center">
        <? if($anual["licencia_anual_restante"] != '0') { ?>
        <a href="agente-licencia-anual-otorgar-form.php?idLicencia=<? echo $anual["licencia_anual_nro"]; ?>&idAgente=<? echo $idAgente; ?>">Utilizar licencia</a><? }else{ ?>-<? } ?></td>
        </tr>
      <?
	  $num_fila++;
	   } ?>
      </table></td>
    <td height="15" colspan="3" align="right"><form method="post" action="licencia_anual_alta.php">
      <table width="90%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" bgcolor="#E6E6E6">&nbsp;</td>
          <td height="28" colspan="3" bgcolor="#E6E6E6"><strong>Asignar nuevo cupo de licencia anual</strong></td>
          </tr>
        <tr>
          <td width="5%" bgcolor="#E6E6E6">&nbsp;</td>
          <td width="37%" bgcolor="#E6E6E6">A&ntilde;o corresp.</td>
          <td colspan="2" bgcolor="#E6E6E6">Cant. d&iacute;as </td>
          </tr>
        <tr>
          <td bgcolor="#E6E6E6">&nbsp;</td>
          <td bgcolor="#E6E6E6"><input name="anio" type="text" id="anio" size="7" /></td>
          <td width="30%" bgcolor="#E6E6E6"><input name="dias" type="text" id="dias" size="6" /></td>
          <td width="28%" bgcolor="#E6E6E6">
            <input type="hidden" name="idAgente" value="<? echo $idAgente; ?>" />
            <input type="submit" name="submit" id="submit" value="Asignar" /></td>
          </tr>
        <tr>
          <td bgcolor="#E6E6E6">&nbsp;</td>
          <td bgcolor="#E6E6E6">&nbsp;</td>
          <td colspan="2" align="center" bgcolor="#E6E6E6">&nbsp;</td>
          </tr>
    </table></form></td>
  </tr>
  <tr>
    <td height="15" colspan="7" align="left" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="33" colspan="2" align="left" valign="bottom"><h2>Historial de licencias y permisos </h2></td>
    <td height="33" colspan="5" align="right" valign="middle"><a href="agente-licencia-otorgar-form.php?idAgente=<? echo $idAgente; ?>">Autorizar nueva licencia</a></td>
  </tr>
  <tr>
    <td width="200" height="28" align="center" bgcolor="#D2D8BC"><strong>Licencia tipo</strong></td>
    <td width="89" align="center" bgcolor="#D2D8BC"><strong>Cant. d&iacute;as</strong></td>
    <td width="96" align="center" bgcolor="#D2D8BC"><strong>Desde</strong></td>
    <td align="center" bgcolor="#D2D8BC"><strong>Hasta</strong></td>
    <td align="center" bgcolor="#D2D8BC"><strong>Observaciones</strong></td>
    <td colspan="2" align="center" bgcolor="#D2D8BC"><strong>Acciones</strong></td>
  </tr>
<?
$num_fila = '0';
while ($licencia = mysql_fetch_array($res2)) {
	
	
?>
  <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#EBEDE0\""; }else{ echo "bgcolor=\"#E2E4D3\"";} ?>>
    <td height="24" align="center">
	<? if($licencia["licencia_tipo"] == '1') {echo "Anual"; }
	elseif ($licencia["licencia_tipo"] == '2') {echo "Ausente c/aviso"; }
	elseif ($licencia["licencia_tipo"] == '3') {echo "Pre examen"; }
	elseif ($licencia["licencia_tipo"] == '4') {echo "Examen"; }
	elseif ($licencia["licencia_tipo"] == '5') {echo "Capeta m&eacute;dica"; }
	elseif ($licencia["licencia_tipo"] == '6') {echo "Atenci&oacute;n familiar"; }
	elseif ($licencia["licencia_tipo"] == '7') {echo "Matrimonio"; }
	elseif ($licencia["licencia_tipo"] == '8') {echo "Nacimiento hijo"; }
	elseif ($licencia["licencia_tipo"] == '9') {echo "Duelo"; }
	elseif ($licencia["licencia_tipo"] == '10') {echo "Lic. Colegio Escribanos"; }
	else { echo "Sin indicar";} 
    ?>
    </td>
    <td align="center"><? echo $licencia["licencia_dias_total"]; ?>&nbsp;</td>
    <td align="center"><? echo cambiaf_a_normal($licencia["licencia_inicio"]); ?>&nbsp;</td>
    <td width="120" align="center"><? echo cambiaf_a_normal($licencia["licencia_fin"]); ?>&nbsp;
    
    </td>
    <td width="224" align="center"><? echo $licencia["licencia_observaciones"]; ?>&nbsp;</td>
    <td width="25" align="center"><img src="imagen/edit.png" width="16" height="16" title="Modificar" alt="Modificar"/></td>
    <td width="30" align="center"><a href="licencia-borrar-confirm.php?idLicencia=<?=$licencia["licencia_nro"]; ?>&idAgente=<?=$idAgente; ?>"><img src="imagen/drop.png" width="16" height="16" title="Eliminar"/></a></td>
  </tr>

<?
$num_fila++;
 } ?>
 <tr>
   <td height="35" colspan="7">&nbsp;</td></tr>
</table>
<p>&nbsp;</p>
<? include("pie.php"); ?>