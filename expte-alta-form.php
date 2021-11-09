<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{


include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_area = $user["Area_nro"];
$usuario_direccion = $user["Direccion_nro"];

//Listado partidos
$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

?>
<form action="expte-alta.php" method="post">
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="12"><h1>Dar de alta nuevo expediente </h1></td>
  </tr>
  <tr>
    <td height="30" colspan="6"><a href="exptes-listar-area.php">[Volver al listado de expedientes]</a></td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="37" height="28">&nbsp;</td>
    <td width="108" align="left"><strong>Carcter&iacute;sitca</strong></td>
    <td align="center" bgcolor="#FFFF99">&nbsp;</td>
    <td align="left" bgcolor="#FFFF99"><strong>Partido</strong></td>
    <td align="center" bgcolor="#FFFF99">&nbsp;</td>
    <td align="left" bgcolor="#FFFF99"><strong>RNRD</strong></td>
    <td width="18" align="center">&nbsp;</td>
    <td width="83" align="left"><strong>Numero</strong></td>
    <td width="91" align="left"><strong>A&ntilde;o</strong></td>
    <td width="85" align="left"><strong>Alcance</strong></td>
    <td width="87"><strong>Cuerpos </strong></td>
    <td width="200"><strong>Fojas</strong></td>
  </tr>
  <tr>
    <td height="45">&nbsp;</td>
    <td valign="top">
      <input name="caracteristica" type="text" id="caracteristica" style="font-size:20px;" size="3"/></td>
    <td width="27" align="center" bgcolor="#FFFF99">&nbsp;</td>
    <td width="64" align="left" valign="top" bgcolor="#FFFF99"><input name="partido" type="text" id="partido" style="font-size:20px;" value="0" size="1"/></td>
    <td width="22" align="center" bgcolor="#FFFF99">&nbsp;</td>
    <td width="78" align="left" valign="top" bgcolor="#FFFF99"><input name="rnrd" type="text" id="rnrd" style="font-size:20px;" value="0" size="1" /></td>
    <td align="center">&nbsp;</td>
    <td align="left" valign="top"><input name="exptenum" type="text" id="exptenum" style="font-size:20px;" size="1" /></td>
    <td valign="top"><input name="anio" type="text" id="anio" style="font-size:20px;" size="2" /></td>
    <td valign="top"><input name="alcance" type="text" id="alcance" style="font-size:20px;" value="0" size="1" /></td>
    <td valign="top"><input name="cuerpos" type="text" id="cuerpos" style="font-size:20px;" value="1" size="1" /></td>
    <td valign="top"><input name="fojas" type="text" id="fojas" style="font-size:20px;" size="1" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="7"><table width="100%" border="0" cellpadding="8" cellspacing="0">
      <tr>
        <td height="30" align="center" valign="bottom" bgcolor="#FFFF99">Atenci&oacute;n: En el caso que el expediente <strong>NO</strong> corresponda a un<br /> 
          beneficio 
          de la Ley 24.374 dejar estos campos  en valor 0 (cero). </td>
      </tr>
    </table></td>
    <td colspan="4"><table width="240" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="12%" align="center">&nbsp;</td>
          <td width="14%" align="center" bgcolor="#CFDFEF"><input name="consolidacion" type="checkbox" id="consolidacion" value="1"/></td>
          <td width="74%" bgcolor="#CFDFEF">Tr&aacute;mite de  consolidaci&oacute;n </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><strong>Expediente iniciado por: </strong></td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td colspan="8"><select name ="origen" style="font-size:13px;">
		<?
		
		$sql5 = "SELECT * FROM dbo_area ORDER BY Area_codigo";
			 
		 $res5 = mysql_query($sql5);
		 
		 while ($iniciante = mysql_fetch_array($res5)) { ?>
              <option value="<?=$iniciante["Area_nro"]; ?>" 
			  <? if ($iniciante["Area_nro"] == '83' && $usuario_direccion == '7') { echo "selected=\"selected\""; } ?>><?=$iniciante["Area_codigo"]; ?> - <?=$iniciante["Area_nombre"]; ?></option>
		<? } ?>
            </select></td>
    <td colspan="3" rowspan="7" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="3">

      <tr>
        <td width="4%">&nbsp;</td>
        <td width="4%" bgcolor="#E7EBD8">&nbsp;</td>
        <td height="24" colspan="2" valign="bottom" bgcolor="#E7EBD8" style="border-bottom:1px solid #000000"><strong>Exclusivo para uso de la D.P.E.S. </strong></td>
        <td width="4%" valign="middle" bgcolor="#E7EBD8">&nbsp;</td>
      </tr>
      <tr>
        <td height="24">&nbsp;</td>
        <td bgcolor="#E7EBD8">&nbsp;</td>
        <td width="41%" valign="bottom" bgcolor="#E7EBD8">Expte. de escrituraci&oacute;n </td>
        <td colspan="2" valign="bottom" bgcolor="#E7EBD8"><input name="blnEsc" type="checkbox" id="blnEsc" value="1" <? if($usuario_direccion == '7') { echo "checked='checked'"; } ?> /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td bgcolor="#E7EBD8">&nbsp;</td>
        <td bgcolor="#E7EBD8">Fecha  de env&iacute;o a EGG: </td>
        <td colspan="2" bgcolor="#E7EBD8"><input name="envio_egg" type="text" id="envio_egg" size="7" /> 
          (dd/mm/AAAA) </td>
      </tr>
      <tr>
        <td height="26">&nbsp;</td>
        <td bgcolor="#E7EBD8">&nbsp;</td>
        <td valign="middle" bgcolor="#E7EBD8">Cant. de beneficios: </td>
        <td valign="middle" bgcolor="#E7EBD8"><input name="beneficios" type="text" id="envio_egg" size="5" />&nbsp;</td>
        <td valign="top" bgcolor="#E7EBD8">&nbsp;</td>
      </tr>
      <tr>
        <td height="55">&nbsp;</td>
        <td bgcolor="#E7EBD8">&nbsp;</td>
        <td colspan="2" valign="middle" bgcolor="#E7EBD8">(<strong>ATENCI&Oacute;N</strong>: Completar el campo fecha de env&iacute;o <strong>&uacute;nicamente</strong>          en
          caso que el expediente sea remitido<br />
          a EGG 
          para 
          la confecci&oacute;n de escrituras). </td>
        <td valign="top" bgcolor="#E7EBD8">&nbsp;</td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>Partido</strong></td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2"><strong>Escribano</strong></td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><select name="idPartido" id="idPartido">
      <option value="0">Seleccione un Partido...</option>
      <? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
    </select>&nbsp;</td>
    <td colspan="5"><input name="escribano" type="text" id="escribano" size="38" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  
  <tr>
    <td height="22">&nbsp;</td>
    <td><strong>Extracto</strong></td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="3"><strong>Observaciones</strong></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><textarea name="extracto" cols="36" rows="7" id="extracto" style="font-size:14px;"></textarea></td>
    <td colspan="3"><textarea name="observaciones" cols="23" rows="7" id="observaciones" style="font-size:14px;"></textarea></td>
    </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">
	<input type="hidden" name="area" value="<?=$usuario_area; ?>" />
	<input type="hidden" name="usuario" value="<?=$log_usuario; ?>" />
	<input type="submit" name="Submit" value="Dar de alta expediente"></td>
  </tr>
  <tr>
    <td height="50">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? include("pie.php"); ?>

<? } ?>