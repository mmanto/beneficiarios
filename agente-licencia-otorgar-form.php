<? 

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idAgente = $_GET["idAgente"];

$sql = "SELECT agente_nombre, agente_apellido FROM dbo_agentes WHERE agente_nro = $idAgente";
$res = mysql_query($sql);
$agente = mysql_fetch_array($res);

?>
<h1>Otorgar nueva licencia (Agente: <? echo $agente["agente_apellido"].", ".$agente["agente_nombre"]; ?>)</h1>
<p><a href="agente-licencias.php?idAgente=<? echo $idAgente; ?>">Volver</a></p>
<p>&nbsp;</p>
<form method="post" action="agente-licencia-otorgar.php">
<table width="850" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td width="166" height="28" align="center" bgcolor="#EAD5D5"><strong>Concepto</strong></td>
    <td width="154" align="center" bgcolor="#EAD5D5"><strong>Desde (dd/mm/aaaa)</strong></td>
    <td width="161" align="center" bgcolor="#EAD5D5"><strong>Hasta (dd/mm/aaaa)</strong></td>
    <td width="330" align="center" bgcolor="#EAD5D5"><strong>Observaciones</strong></td>
  </tr>

    <td height="40" align="center" bgcolor="#F8F1F1"><select name="licencia_tipo" id="licencia_tipo" style="font-size:14px;">
      <option value="0">Seleccione uno...</option>
      <option value="2">Ausente c/aviso</option>
      <option value="3">Pre examen</option>
      <option value="4">Examen</option>
      <option value="5">Carpeta m&eacute;dica</option>
      <option value="6">Atenci&oacute;n familiar</option>
      <option value="7">Matrimonio</option>
      <option value="8">Nacimiento hijo</option>
      <option value="9">Duelo</option>
      <option value="10">Lic. colegio esc.</option>
    </select></td>
    <td align="center" bgcolor="#F8F1F1"><input name="desde" type="text" id="desde" size="7" style="font-size:14px;" /></td>
    <td align="center" bgcolor="#F8F1F1"><input name="hasta" type="text" id="hasta" size="7" style="font-size:14px;"/> 
    (inclusive)</td>
    <td align="center" bgcolor="#F8F1F1"><input name="observaciones" type="text" id="observaciones" size="33" style="font-size:14px;"/></td>
  </tr>
 <tr>
   <td height="35" colspan="4" align="right"><input type ="hidden" name="agente" value="<? echo $idAgente; ?>"/><input type="submit" name="button2" id="button2" value="Otorgar" /></td></tr>
</table>
</form>
<p>&nbsp;</p>
<? include("pie.php"); ?>