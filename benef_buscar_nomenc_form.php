<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");
$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

$strSQL2 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido2 = mysql_query ($strSQL2);

$strSQL3 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido3 = mysql_query ($strSQL3);

?>
<form action="esc_partido_mz_listar.php" method="GET">
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h2>B&uacute;squeda de Beneficio por Nomenclatura </h2></td>
    <td width="31" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="16" colspan="3"><a href="sbt-menu.php">Volver al panel de administraci&oacute;n </a></td>
  </tr>
  <tr>
    <td height="18" colspan="3" valign="bottom">&nbsp;</td>
    <td rowspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td height="26" colspan="3" align="center" valign="middle" bgcolor="#E4E4E4"><strong>B&Uacute;SQUEDA POR PARTIDO</strong> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="17" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="26" colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="11">
      <tr>
        <td bgcolor="#FFFF99">Atenci&oacute;n: Debido a la amplitud del criterio de b&uacute;squeda, los resultados ser&aacute;n agrupados por manzana, debiendo ingresar a cada una para listar los beneficios individuales. </td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="75" height="17">&nbsp;</td>
    <td width="462">&nbsp;</td>
  </tr>
  <tr>
    <td width="32">&nbsp;</td>
    <td valign="top"><strong>Partido: </strong></td>
    <td height="30" valign="top"><select name="idPartido" id="idPartido">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) { ?><option value ="<?=$rsPart["Partido_nro"]; ?>"><?=$rsPart["Partido_nombre"]; ?></option><? } ?>
      </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="32">&nbsp;</td>
    <td>&nbsp;</td>
    <td><table width="90%" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td width="6%">&nbsp;</td>
        <td width="29%">&nbsp;</td>
        <td width="5%">&nbsp;</td>
        <td width="60%">&nbsp;</td>
      </tr>
      <tr>
        <td><input name="blnEsc" type="radio" value="1" /></td>
        <td>S&oacute;lo escriturados </td>
        <td><input name="blnEsc" type="radio" value="0" checked="checked" /></td>
        <td>Todos los tr&aacute;mites </td>
      </tr>
      <tr>
        <td height="32">&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><input name="cmdLogin" type="submit" id="cmdLogin" value="Buscar"></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td width="32" height="33">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<?       
include "pie.php";
?>
<? } ?>
