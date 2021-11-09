<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{


include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$exptenro = $_GET["idExpte"];

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_area = $user["Area_nro"];

//Listado partidos
$strSQL2 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido2 = mysql_query ($strSQL2);

$sql = "SELECT * FROM dbo_exptes WHERE Expte_nro = $exptenro";
$res = mysql_query($sql);
$expte = mysql_fetch_array($res);

?>
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>
<form action="expte-modif.php" method="post">
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="13"><h1>Modificar datos del  expediente </h1></td>
  </tr>
  <tr>
    <td width="25">&nbsp;</td>
    <td height="30">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="25">&nbsp;</td>
    <td width="102" height="28" align="left"><strong>Caracter&iacute;stica</strong></td>
    <td align="center" bgcolor="#FFFF99">&nbsp;</td>
    <td align="left" bgcolor="#FFFF99"><strong>Partido</strong></td>
    <td align="center" bgcolor="#FFFF99">&nbsp;</td>
    <td align="left" bgcolor="#FFFF99"><strong>RNRD</strong></td>
    <td width="23" align="center">&nbsp;</td>
    <td width="77" align="left"><strong>Numero</strong></td>
    <td width="75" align="left"><strong>A&ntilde;o</strong></td>
    <td width="79" align="left"><strong>Alcance</strong></td>
    <td width="89"><strong>Cuerpos </strong></td>
    <td width="105"><strong>Fojas (origen) </strong></td>
    <td width="139"><strong>Fojas (actual) </strong></td>
  </tr>
  <tr>
    <td width="25">&nbsp;</td>
    <td height="45" valign="top">
      <input name="caracteristica" type="text" id="caracteristica" style="font-size:20px;" size="3" value="<?=$expte["Expte_caract"]; ?>"/></td>
    <td width="26" align="center" bgcolor="#FFFF99">&nbsp;</td>
    <td width="55" align="left" valign="top" bgcolor="#FFFF99"><input name="partido" type="text" id="partido" style="font-size:20px;" size="1" value="<?=$expte["Expte_partido"]; ?>"/></td>
    <td width="26" align="center" bgcolor="#FFFF99">&nbsp;</td>
    <td width="79" align="left" valign="top" bgcolor="#FFFF99"><input name="rnrd" type="text" id="rnrd" style="font-size:20px;" value="<?=$expte["Expte_rnrd"]; ?>" size="1" /></td>
    <td align="center">&nbsp;</td>
    <td align="left" valign="top"><input name="exptenum" type="text" id="exptenum" style="font-size:20px;" size="1" value="<?=$expte["Expte_num"]; ?>" /></td>
    <td valign="top"><input name="anio" type="text" id="anio" style="font-size:20px;" size="1" value="<?=$expte["Expte_anio"]; ?>"/></td>
    <td valign="top"><input name="alcance" type="text" id="alcance" style="font-size:20px;" size="1" value="<?=$expte["Expte_alcance"]; ?>"/></td>
    <td valign="top"><input name="cuerpos" type="text" id="cuerpos" style="font-size:20px;" size="1" value="<?=$expte["Expte_cuerpos_cant"]; ?>"/></td>
    <td valign="top"><input name="fojas" type="text" id="fojas" style="font-size:20px;" size="1" value="<?=$expte["Expte_fojas_origen"]; ?>"/></td>
    <td valign="top"><input name="fojas_actual" type="text" id="fojas_actual" style="font-size:20px;" size="1" value="<?=$expte["Expte_fojas_actual"]; ?>"/></td>
  </tr>
  <tr>
    <td width="25">&nbsp;</td>
    <td colspan="7"><table width="100%" border="0" cellpadding="8" cellspacing="0">
      <tr>
        <td height="30" align="center" valign="bottom" bgcolor="#FFFF99">Atenci&oacute;n: En el caso que el expediente <strong>NO</strong> corresponda a un<br /> 
          beneficio 
          de la Ley 24.374 dejar estos campos  en valor 0 (cero). </td>
      </tr>
    </table></td>
    <td colspan="5"><table width="240" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="12%" align="center">&nbsp;</td>
          <td width="14%" align="center" bgcolor="#CFDFEF"><input name="consolidacion" type="checkbox" id="consolidacion" value="1" <? if($expte["Expte_ley_cons"]=='1') { echo "checked=\"checked\""; } ?>/></td>
          <td width="74%" bgcolor="#CFDFEF">Tr&aacute;mite de  consolidaci&oacute;n </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    </tr>
  <tr>
    <td width="25">&nbsp;</td>
    <td height="28" colspan="5" valign="top"><strong>Expediente iniciado por: </strong></td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3"><table width="270" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="12%" align="center" bgcolor="#FFCC99"><input name="expte_esc" type="checkbox" value="1" <? if($expte["Expte_esc"]=='1') { echo "checked=\"checked\""; } ?>/></td>
        <td width="88%" bgcolor="#FFCC99">Expediente de escrituraci&oacute;n DPES</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="25" rowspan="7">&nbsp;</td>
    <td height="42" colspan="8" valign="top"><select name ="origen" style="font-size:13px;">
		<?
		
		$sql5 = "SELECT * FROM dbo_area ORDER BY Area_codigo";
			 
		 $res5 = mysql_query($sql5);
		 
		 while ($iniciante = mysql_fetch_array($res5)) { ?>
              <option value="<?=$iniciante["Area_nro"]; ?>" <? if ($iniciante["Area_nro"] == $expte["Expte_origen"]) { ?>selected="selected"<? }  ?>><?=$iniciante["Area_codigo"]; ?> - <?=$iniciante["Area_nombre"]; ?></option>
		<? } ?>
      </select></td>
    <td colspan="4" align="center">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="5" valign="top"><strong>Partido</strong></td>
    <td colspan="7" valign="top"><strong>Escribano</strong></td>
  </tr>
  <tr>
    <td colspan="5" valign="top"><select name="idPartido" id="idPartido">
      <option value="0">Seleccione un Partido...</option>
      <? while($rsPart = mysql_fetch_array($partido2)) {?>
      <option value="<?=$rsPart["Partido_nro"]; ?>" 
	<? if($rsPart["Partido_nro"] == $expte["Partido_nro"]) { echo "selected=\"selected\""; } ?>>
        <?=$rsPart["Partido_nombre"]; ?>
        </option>
      <? } ?>
    </select></td>
    <td colspan="7" valign="top"><input name="escribano" type="text" size="30" value="<?=$expte["Expte_escribano"]; ?>"style="font-size:14px;"/></td>
    </tr>
  <tr>
    <td colspan="8" valign="top">&nbsp;</td>
    <td colspan="4" align="center">&nbsp;</td>
  </tr>
  
  <tr>
    <td height="22" colspan="4"><strong>Extracto</strong></td>
    <td colspan="2">&nbsp;</td>
    <td colspan="4"><strong>Observaciones</strong></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><textarea name="extracto" cols="42" rows="4" id="extracto" style="font-size:14px;"><? echo $expte["Expte_extracto"]; ?></textarea></td>
    <td colspan="7"><textarea name="observaciones" cols="45" rows="4" id="observaciones" style="font-size:14px;"><? echo $expte["Expte_observaciones"]; ?></textarea></td>
    </tr>
  <tr>
    <td width="102">&nbsp;</td>
    <td height="28">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">
	<input type="hidden" name="area" value="<?=$usuario_area; ?>" />
	<input type="hidden" name="expte_nro" value="<?=$exptenro; ?>" />
	<input type="hidden" name="usuario" value="<?=$log_usuario; ?>" />
	<input type="submit" name="Submit" value="Modificar datos"></td>
  </tr>
  <tr>
    <td width="25">&nbsp;</td>
    <td height="50">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? include("pie.php"); ?>

<? } ?>