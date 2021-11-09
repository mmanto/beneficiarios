<? 

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idAgente = $_GET["idAgente"];
$idLicencia = $_GET["idLicencia"];

$sql = "SELECT agente_nombre, agente_apellido FROM dbo_agentes WHERE agente_nro = $idAgente";
$res = mysql_query($sql);
$agente = mysql_fetch_array($res);

$sql3 = "SELECT * FROM dbo_agente_licencia_anual WHERE licencia_anual_nro = $idLicencia";
$res3 = mysql_query($sql3);
$licanual = mysql_fetch_array($res3);

?>
<h1>Otorgar licencia anual (Agente: <? echo $agente["agente_apellido"].", ".$agente["agente_nombre"]; ?>)</h1>
<p><a href="agente-licencias.php?idAgente=<? echo $idAgente; ?>">Volver</a></p>
<p>&nbsp;</p>
<form method="post" action="agente-licencia-anual-otorgar.php">
<table width="850" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td width="97" height="30" align="center" bgcolor="#C0D1D0"><strong>Corresp. a&ntilde;o</strong></td>
    <td width="103" align="center" bgcolor="#C0D1D0"><strong>Disponible</strong></td>
    <td width="155" align="center" bgcolor="#C0D1D0"><strong>Desde (dd/mm/aaaa)</strong></td>
    <td width="165" align="center" bgcolor="#C0D1D0"><strong>Hasta (dd/mm/aaaa)</strong></td>
    <td width="282" align="center" bgcolor="#C0D1D0"><strong>Observaciones</strong></td>
  </tr>

    <tr>
      <td height="36" align="center" bgcolor="#E8EEEE"><? echo $licanual["licencia_anual_anio"]; ?></td>
      <td height="40" align="center" bgcolor="#E8EEEE"><? echo $licanual["licencia_anual_restante"]; ?> dias</td>
    <td align="center" bgcolor="#E8EEEE"><input name="desde" type="text" id="desde" size="7" style="font-size:14px;" /></td>
    <td align="center" bgcolor="#E8EEEE"><input name="hasta" type="text" id="hasta" size="7" style="font-size:14px;"/> 
    (inclusive)</td>
    <td align="center" bgcolor="#E8EEEE"><input name="observaciones" type="text" id="observaciones" size="25" style="font-size:14px;"/></td>
  </tr>
 <tr>
   <td height="35" colspan="5" align="right">
   <input type ="hidden" name="licencia_tipo" value="1"/>
   <input type ="hidden" name="dias_disp" value="<? echo $licanual["licencia_anual_restante"]; ?>"/>
   <input type ="hidden" name="idLicencia" value="<? echo $idLicencia; ?>"/>
   <input type ="hidden" name="agente" value="<? echo $idAgente; ?>"/><input type="submit" name="button2" id="button2" value="Otorgar licencia" /></td></tr>
</table>
</form>
<p>&nbsp;</p>
<? include("pie.php"); ?>