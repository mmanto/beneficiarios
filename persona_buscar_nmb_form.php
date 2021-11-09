<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

?>
<form action="persona_buscar_nmb.php" method="GET">
<table width="750" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5"><h2>B&uacute;squeda de Beneficio por nombre y apellido</h2></td>
    </tr>
  <tr>
    <td height="16" colspan="5"><a href="sbt-menu.php">Volver al panel de administraci&oacute;n </a></td>
    </tr>
  <tr>
    <td width="44" rowspan="6">&nbsp;</td>
    <td width="92" height="35">&nbsp;</td>
    <td width="135">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2"><strong>Apellido</strong></td>
    <td colspan="2"><strong>Nombres</strong></td>
  </tr>
  <tr>
    <td height="26" colspan="2" valign="top"><input name="apellfind" type="text" id="apellfind" size="28" /></td>
    <td colspan="2" valign="top"><input name="nmbfind" type="text" id="nmbfind" size="55" /></td>
    </tr>
  <tr>
    <td height="32" colspan="2" valign="top">(campo obligatorio)</td>
    <td colspan="2" valign="top">(No obligatorio. Puede completar para restringir resultados)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="275">&nbsp;</td>
    <td width="204"><input name="cmdLogin" type="submit" id="cmdLogin" value="Buscar" /></td>
  </tr>
  <tr>
    <td height="96">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>
<?       
include "pie.php";
?>
<? } ?>
