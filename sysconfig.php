<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT * FROM dbo_settings WHERE idSetting = '5'");
$ExpActivo = mysql_fetch_array($res);

$res2 = mysql_query("SELECT * FROM dbo_settings WHERE idSetting = '6'");
$SbtActivo = mysql_fetch_array($res2);

$res3 = mysql_query("SELECT * FROM dbo_settings WHERE idSetting = '7'");
$RHActivo = mysql_fetch_array($res3);


?>
<h2>Configuraci&oacute;n general del sistema</h2>
<p><a href="menu.php">Volver</a></p>
<p>&nbsp;</p>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="395"><table width="300" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td height="25" colspan="6" align="center" bgcolor="#F2F2F2"><strong>Habilitar/deshabilitar m&oacute;dulos</strong></td>
        </tr>
      <tr>
        <td height="4" colspan="6"></td>
        </tr>
      <tr>
        <td width="3%" height="30" bgcolor="#F7F99D">&nbsp;</td>
        <td width="41%" bgcolor="#F7F99D">M&oacute;dulo Expedientes</td>
        <td width="9%" align="center" bgcolor="#F7F99D"><input name="ExpActivo" type="radio" value="1" <? if ($ExpActivo["Valor"] == '1') { echo "checked=\"checked\""; } ?> /></td>
        <td width="19%" bgcolor="#F7F99D">Activo</td>
        <td width="9%" align="center" bgcolor="#F7F99D"><input name="ExpActivo" type="radio" value="0" <? if ($ExpActivo["Valor"] == '0') { echo "checked=\"checked\""; } ?> /></td>
        <td width="19%" bgcolor="#F7F99D">Inactivo</td>
      </tr>
      <tr>
        <td height="4" colspan="6"></td>
        </tr>
      <tr>
        <td height="30" bgcolor="#FFE1A4">&nbsp;</td>
        <td bgcolor="#FFE1A4">M&oacute;dulo Beneficiarios</td>
        <td align="center" bgcolor="#FFE1A4"><input name="SbtActivo" type="radio" value="1" <? if ($SbtActivo["Valor"] == '1') { echo "checked=\"checked\""; } ?> /></td>
        <td bgcolor="#FFE1A4">Activo</td>
        <td align="center" bgcolor="#FFE1A4"><input name="SbtActivo" type="radio" value="1" <? if ($SbtActivo["Valor"] == '0') { echo "checked=\"checked\""; } ?> /></td>
        <td bgcolor="#FFE1A4">Inactivo</td>
      </tr>
      <tr>
        <td height="4" colspan="6"></td>
        </tr>
      <tr>
        <td height="30" bgcolor="#D0E6F4">&nbsp;</td>
        <td bgcolor="#D0E6F4">M&oacute;dulo RRHH</td>
        <td align="center" bgcolor="#D0E6F4"><input name="RHActivo" type="radio" value="1" <? if ($RHActivo["Valor"] == '1') { echo "checked=\"checked\""; } ?> /></td>
        <td bgcolor="#D0E6F4">Activo</td>
        <td align="center" bgcolor="#D0E6F4"><input name="RHActivo" type="radio" value="1" <? if ($RHActivo["Valor"] == '0') { echo "checked=\"checked\""; } ?> /></td>
        <td bgcolor="#D0E6F4">Inactivo</td>
      </tr>
      <tr>
        <td height="50" colspan="6" align="right"><input type="submit" name="submit" id="submit" value="Actualizar estado"></td>
        </tr>
    </table></td>
    <td width="405">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?
include("pie.php");
}
?>