<?
include("cabecera-impresion.php");
include ("conec.php");
include ("funciones.php");

$remito_nro = $_GET["idRemito"];


$sql3 = "SELECT * FROM dbo_exptesmov_remitos WHERE Remito_nro = $remito_nro";

$res3 = mysql_query($sql3);

$remito = mysql_fetch_array($res3);

//$remito_anio = $remito["Remito_anio"];

$remito_fecha = cambiaf_a_normal($remito["Remito_fecha"]);

$remito_hora = $remito["Remito_hora"];

$sql = "SELECT * FROM dbo_exptes_mov WHERE Remito_nro = $remito_nro";

$res = mysql_query($sql);

?>

<table width="800" border="0" cellspacing="0" cellpadding="4">
  
  <tr>
    <td height="60" colspan="2" align="center">&nbsp;</td>
    <td width="382" align="center" valign="bottom"><h1><span class="Estilo6">REMITO MOVILIZADO</span></h1></td>
    <td width="215" align="center" valign="bottom"><table width="220" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#E4E4E4">
      <tr>
        <td height="36" align="right" class="Estilo1">N&ordm; <?=$remito_nro; ?>&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="126" height="40"> </span></td>
    <td colspan="3" align="right" valign="top"> </span> <strong><?=$remito_fecha;?></strong> @<?=$remito_hora; ?></span></td>
  </tr>
  <tr>
    <td height="32"> <strong>Remitente:</strong></span></td>
    <td colspan="3" align="center"> </span> </span> </span></td>
  </tr>
  <tr>
    <td height="32"> <strong>Destinatario:</strong></span></td>
    <td colspan="3" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="70" colspan="4"><span class="Estilo3"><u>Expedientes en pase</u></span></td>
  </tr>

<tr>
	<td height="640" colspan="4" align="right" valign="top" class="Estilo1">
<table width="95%">
<?
while ($mov = mysql_fetch_array($res)) {

$exptenro = $mov["Expte_nro"];

$sql2 = "SELECT * FROM dbo_exptes WHERE Expte_nro = $exptenro";

$res2 = mysql_query($sql2);

$expte = mysql_fetch_array($res2);

$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpos = $expte["Expte_cuerpos_cant"];

?>
<tr>
    <td class="Estilo1">- <? echo $expte_caract."-".$expte_num."/".$expte_anio." Alc. ".$expte_alcance." (".$expte_cuerpos." cuerpos)";?></td>
</tr>

<?  } ?>
</table>	</td>
  </tr>
<tr>
  <td colspan="4" align="right" valign="bottom" class="Estilo1"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="8%">&nbsp;</td>
        <td width="42%" class="Estilo1">Firma y sello remitente </td>
        <td width="40%" align="right" class="Estilo1">Firma y sello receptor </td>
        <td width="10%">&nbsp;</td>
      </tr>
    </table></td>
</tr>
<tr>
  <td height="80" colspan="4" align="right" valign="bottom" class="Estilo1">&nbsp;</td>
  </tr>	
</table>
<? include("pie.php"); ?>