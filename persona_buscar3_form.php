<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

?>
<form action="persona_buscar_doc3.php" method="POST">
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h2>B&uacute;squeda de ficha </h2></td>
    <td width="248" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="16" colspan="3"><a href="zonas-listar.php">Volver al panel de administraci&oacute;n </a></td>
  </tr>
  <tr>
    <td width="32" rowspan="5">&nbsp;</td>
    <td width="165" height="35">&nbsp;</td>
    <td width="155">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><strong>Búsqueda por  Nro. de DNI: </strong></td>
    <td height="30" valign="top"><input name="docfind" type="text" id="docfind" /></td>
    <td valign="top">(ingrese el DNI sin puntos)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="cmdLogin" type="submit" id="cmdLogin" value="Buscar"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="2" colspan="4" bgcolor="#999999"></td>
    </tr>
</table>
</form>
<form action="persona_buscar_apell3.php" method="POST">
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="32" rowspan="5">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td height="30" valign="top">&nbsp;</td>
    <td width="31">&nbsp;</td>
  </tr>
  <tr>
    <td width="168" valign="top"><strong>Búsqueda por apellido: </strong></td>
    <td width="369" height="30" valign="top"><input name="apellido" type="text" id="apellido" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="cmdLogin" type="submit" id="cmdLogin" value="Buscar"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="2" colspan="4" bgcolor="#999999"></td>
    </tr>
</table>
</form>
<form action="ficha_buscar.php" method="POST">
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="32" rowspan="5">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td height="30" valign="top">&nbsp;</td>
    <td width="31">&nbsp;</td>
  </tr>
  <tr>
    <td width="168" valign="top"><strong>Búsqueda por Nro. de ficha: </strong></td>
    <td width="369" height="30" valign="top"><input name="ficha" type="text" id="ficha" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="cmdLogin" type="submit" id="cmdLogin" value="Buscar"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="2" colspan="4" bgcolor="#999999"></td>
    </tr>
</table>
</form>
<form action="ficha_buscar_refcarto.php" method="POST">
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="32" rowspan="5">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td height="30" valign="top">&nbsp;</td>
    <td width="31">&nbsp;</td>
  </tr>
  <tr>
    <td width="168" valign="top"><strong>Búsqueda por ref. carto.</strong></td>
    <td width="369" height="30" valign="top"><input name="refcarto" type="text" id="ficha" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="cmdLogin" type="submit" id="cmdLogin" value="Buscar"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="2" colspan="4" bgcolor="#999999"></td>
    </tr>
</table>
</form>
<?       
include "pie.php";
?>
<? } ?>
