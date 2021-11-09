<? 

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idAgente = $_GET["idAgente"];

$sql = "SELECT agente_nombre, agente_apellido FROM dbo_agentes WHERE agente_nro = $idAgente";
$res = mysql_query($sql);
$agente = mysql_fetch_array($res);

$sql2 = "SELECT * FROM dbo_agente_familia WHERE agente_nro = $idAgente";
$res2 = mysql_query($sql2);

?>
<h1>Grupo familiar del agente <? echo $agente["agente_apellido"].", ".$agente["agente_nombre"]; ?></h1>
<table width="850" border="0" cellspacing="3" cellpadding="7">
  <tr>
    <td height="60" align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="4" align="right"><a href="agente-familiar-alta-form.php?idAgente=<? echo $idAgente; ?>">[Dar de alta nuevo 
    miembro grupo familiar]</a></td>
  </tr>
  <tr>
    <td width="184" height="28" align="center" bgcolor="#D2D8BC"><strong>Apellido y Nombre</strong></td>
    <td width="75" align="center" bgcolor="#D2D8BC"><strong>DNI</strong></td>
    <td width="118" align="center" bgcolor="#D2D8BC"><strong>Fecha Nacimiento</strong></td>
    <td align="center" bgcolor="#D2D8BC"><strong>V&iacute;nculo</strong></td>
    <td align="center" bgcolor="#D2D8BC"><strong>Observaciones</strong></td>
    <td colspan="2" align="center" bgcolor="#D2D8BC"><strong>Acciones</strong></td>
  </tr>
<?
$num_fila = '0';
while ($familiar = mysql_fetch_array($res2)) {
?>
  <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#EBEDE0\""; }else{ echo "bgcolor=\"#E2E4D3\"";} ?>>
    <td><?=$familiar["familiar_apellido"]; ?>, <?=$familiar["familiar_nombre"]; ?>&nbsp;</td>
    <td align="center"><? echo number_format($familiar['familiar_dni_nro'], 0, '', '.'); ?>&nbsp;</td>
    <td align="center"><? echo $familiar["familiar_fechanac"]; ?>&nbsp;</td>
    <td width="78" align="center">
    <? if($familiar["familiar_vinculo"] == '1') {echo "Esposo/a"; }
	elseif ($familiar["familiar_vinculo"] == '2') {echo "Hijo/a"; }
	elseif ($familiar["familiar_vinculo"] == '3') {echo "Padre/Madre"; }
	else { echo "Sin indicar";} 
    ?>
    
    </td>
    <td width="221" align="center"><? echo $familiar["familiar_observaciones"]; ?>&nbsp;</td>
    <td width="24" align="center"><a href="agente-familiar-modif-form.php?idAgente=<?=$idAgente; ?>&idFamiliar=<?=$familiar["familiar_nro"] ?>"><img src="imagen/edit.png" width="16" height="16" title="Modificar" alt="Modificar"/></a></td>
    <td width="28" align="center"><a href="agente-familiar-borrar-confirm.php?idAgente=<?=$idAgente; ?>&idFamiliar=<?=$familiar["familiar_nro"] ?>"><img src="imagen/drop.png" width="16" height="16" title="Eliminar"/></a></td>
  </tr>

<?
$num_fila++;
 } ?>
</table>
<p>&nbsp;</p>
<? include("pie.php"); ?>