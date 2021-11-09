<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
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
$partido = mysql_query ($strSQL2);

$sql = "SELECT * FROM dbo_exptes WHERE Expte_nro = $exptenro";
$res = mysql_query($sql);
$expte = mysql_fetch_array($res);
$expte_fecha_detalle = $expte["Expte_ubicacion_detalle_fecha"];
$fecha_detalle = cambiaf_a_normal($expte_fecha_detalle);

$expte_envio_egg = cambiaf_a_normal($expte["Expte_salida"]);

$expte_gescrit_estado = $expte["Expte_gescrit_estado"];


?>
<form action="expte-esc-modif.php" method="post">
<table width="925" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="14"><h1>Modificar datos del  expediente </h1></td>
  </tr>
  <tr>
    <td height="22" colspan="7"><a href="exptes-listar-area.php"></a></td>
    <td colspan="2">&nbsp;</td>
    <td width="82">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="14">&nbsp;</td>
    <td colspan="13"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="24" height="30" bgcolor="#E4E4E4">&nbsp;</td>
        <td width="126" bgcolor="#E4E4E4"><strong>Caracter&iacute;stica</strong></td>
        <td width="122" bgcolor="#E4E4E4"><strong>N&uacute;mero</strong></td>
        <td width="123" bgcolor="#E4E4E4"><strong>A&ntilde;o</strong></td>
        <td width="105" bgcolor="#E4E4E4"><strong>Alcance</strong></td>
        </tr>
      <tr>
        <td height="60" bgcolor="#E4E4E4">&nbsp;</td>
        <td valign="top" bgcolor="#E4E4E4" style="font-size:36px; font-weight:bold;"><?=$expte["Expte_caract"]; ?>&nbsp;</td>
        <td valign="top" bgcolor="#E4E4E4" style="font-size:36px; font-weight:bold;"><?=$expte["Expte_num"]; ?>&nbsp;</td>
        <td valign="top" bgcolor="#E4E4E4" style="font-size:36px; font-weight:bold;"><?=$expte["Expte_anio"]; ?>&nbsp;</td>
        <td valign="top" bgcolor="#E4E4E4" style="font-size:36px; font-weight:bold;"><?=$expte["Expte_alcance"]; ?>&nbsp;</td>
        </tr>
    </table></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="99">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td width="14">&nbsp;</td>
    <td colspan="2">Extracto</td>
    <td width="41">&nbsp;</td>
    <td width="57">&nbsp;</td>
    <td width="37">&nbsp;</td>
    <td width="72">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td colspan="6">Observaciones</td>
    </tr>
  <tr>
    <td width="14">&nbsp;</td>
    <td colspan="7"><textarea name="extracto" cols="55" rows="3" id="extracto" style="font-size:12px;"><? echo $expte["Expte_extracto"]; ?></textarea></td>
    <td colspan="6"><textarea name="observaciones" cols="35" rows="3" id="observaciones" style="font-size:12px;"><? echo $expte["Expte_esc_observaciones"]; ?></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="31">&nbsp;</td>
    <td width="24" bgcolor="#CCE1EE">&nbsp;</td>
    <td width="224" bgcolor="#CCE1EE"><strong>Estado del expediente en el &aacute;rea</strong></td>
    <td width="159">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Partido de origen: </td>
    <td colspan="4"><select name="idPartido" id="idPartido">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) { ?>
	<option value ="<? echo $rsPart["Partido_nro"]; ?>" <? if($rsPart["Partido_nro"] == $expte["Partido_nro"]) { echo "selected=\"selected\""; } ?>><? echo $rsPart["Partido_nombre"]; } ?>
      </select></td>
    <td colspan="2">Beneficios:</td>
    <td><input name="beneficios" type="text" size="5" value="<? echo $expte["Expte_beneficios"] ?>"/>&nbsp;</td>
    <td>&nbsp;</td>
    <td bgcolor="#CCE1EE">&nbsp;</td>
    <td bgcolor="#CCE1EE"><select name="expte_gescrit_estado" id="select">
      <option value="0" <? if($expte_gescrit_estado == '0') { ?> selected="selected" <? } ?>>Sin indicar</option>
      <option value="1" <? if($expte_gescrit_estado == '1') { ?> selected="selected" <? } ?>>Esperando revisi&oacute;n</option>
      <option value="2" <? if($expte_gescrit_estado == '2') { ?> selected="selected" <? } ?>>Esperando documentaci&oacute;n</option>
      <option value="3" <? if($expte_gescrit_estado == '3') { ?> selected="selected" <? } ?>>Esperando firma</option>
      <option value="4" <? if($expte_gescrit_estado == '4') { ?> selected="selected" <? } ?>>Archivado en el &aacute;rea</option>
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td bgcolor="#CCE1EE">&nbsp;</td>
    <td bgcolor="#CCE1EE">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td colspan="6" align="center" bgcolor="#E2ECC4">Salida del expediente a Escriban&iacute;a Gral de Gobierno: </td>
    <td colspan="2" align="center" bgcolor="#E2ECC4"><input type="text" name="envio_egg" style="font-size:14px;" value="<? echo $expte_envio_egg; ?>" size="7"/></td>
    <td bgcolor="#E2ECC4">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td width="14">&nbsp;</td>
    <td height="22" colspan="6"><strong>Detalle sobre la ubicaci&oacute;n el expte. <br />
      (s&oacute;lo si el expte se ubica en EGG).</strong></td>
    <td colspan="5">Ubicaci&oacute;n desde </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="14">&nbsp;</td>
    <td height="80" colspan="6" valign="top"><textarea name="detalle" cols="42" rows="4" id="detalle" style="font-size:14px;"><? echo $expte["Expte_ubicacion_detalle"]; ?></textarea></td>
    <td colspan="3" valign="top"><table width="100" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <input name="detalle_fecha" type="text" id="detalle_fecha" style="font-size:18px;" value="<? echo $fecha_detalle; ?>" size="10"/>        </td>
      </tr>
      <tr>
        <td height="7"></td>
      </tr>
      <tr>
        <td height="50" align="center" bgcolor="#FFFF99">Consignar en formato<strong><br />
          dd/mm/AAAA</strong></td>
      </tr>
    </table></td>
    <td colspan="4">&nbsp;</td>
    </tr>
  
  <tr>
    <td width="14">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td height="28">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="14">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="5">
	<input type="hidden" name="expte_nro" value="<?=$exptenro; ?>" />
	<input type="hidden" name="usuario" value="<?=$log_usuario; ?>" />
	<input type="submit" name="Submit" value="Actualizar datos"></td>
    </tr>
  <tr>
    <td width="14">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td height="50">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? include("pie.php"); ?>

<? } ?>