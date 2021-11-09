<? session_start();

include ("conec.php");

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
}else{



$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);

$SQLactivo = mysql_query("SELECT * FROM dbo_settings WHERE idSetting = 4");
$setting = mysql_fetch_array($SQLactivo);

if($setting["Valor"] != 1 && $user["Usuario_nivel"] > 2) {

	header ("Location: login.php");

}else{

//include ("conec.php");

//////

//////


$sql789 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre
FROM dbo_barrio
ORDER BY Barrio_nombre ASC",$link);

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];



$hoy = DATE("Y-m-d");
$SQLins_total = mysql_query("SELECT insert_usuario FROM dbo_familia WHERE insert_usuario = $log_usuario",$link);
$cant_insert_total = mysql_num_rows($SQLins_total);

$SQLins_hoy = mysql_query("SELECT insert_usuario FROM dbo_familia WHERE insert_usuario = $log_usuario AND insert_fecha = '".$hoy."'",$link);
$cant_insert_hoy = mysql_num_rows($SQLins_hoy);

include ("cabecera.php");

$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

$strSQL2 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido2 = mysql_query ($strSQL2);

$strSQL3 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido3 = mysql_query ($strSQL3);

?>
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><h2>Panel de administraci&oacute;n </h2></td>
    <td colspan="3" align="right"><span class="user">Usuario: <? echo $usuario_nombre; ?></span><br /></td>
  </tr>
  <tr>
    <td height="36" colspan="2" valign="top"><a href="menu.php">[Volver al menu principal]</a>&nbsp;</td>
    <td colspan="3" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td width="99"><img src="imagen/benef.png" width="80" height="80" /></td>
    <td width="232"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="6%" height="26" bgcolor="#E6E6E6">&nbsp;</td>
        <td width="94%" bgcolor="#E6E6E6"><strong>Beneficiarios</strong></td>
      </tr>
      <tr>
        <td colspan="2">
		<form action="barrios_listar_partido.php" method="get">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2"><p><a href="barrios_listar_exptes.php"></a><a href="exptes-dpes-listar.php"></a></p>            </td>
          </tr>
          <tr>
            <td colspan="2">Alta/consulta beneficio por barrio </td>
          </tr>
          <tr>
            <td width="7"><select name="idPartido" id="idPartido" onChange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart2 = mysql_fetch_array($partido2)) echo "<option value =\"{$rsPart2["Partido_nro"]}\">{$rsPart2["Partido_nombre"]}\r\n"; ?>
      </select></td>
            <td width="28%" align="left"><input type="submit" name="Submit" value="Ver" /></td>
          </tr>
    </table>
		</form>
			<p><a href="benef_buscar_nomenc_form.php">Consulta beneficios por nomenclatura </a></p>
			<p><a href="beneficio_buscar_mat_form.php">Consulta beneficio por matrícula</a></p>
          	<p><a href="persona_buscar_doc_form.php">Consulta beneficio por documento</a></p>	      </td>
        </tr>
      
    </table></td>
    <td width="27" align="center">&nbsp;</td>
    <td width="98" align="center"><img src="imagen/expte.png" width="80" height="80" /></td>
    <td width="244" valign="top"><form action="exptes-dpes-listar-partido.php" method="get"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td colspan="2" bgcolor="#E6E6E6"><strong>Expedientes escrituraci&oacute;n </strong></td>
          </tr>
          <tr>
            <td colspan="3"><p><a href="barrios_listar_exptes.php"></a><a href="exptes-dpes-listar.php">Listar todos los expedientes </a></p>            </td>
          </tr>
          <tr>
            <td colspan="3">Listar expedientes por partido </td>
          </tr>
          <tr>
            <td colspan="2"><select name="idPartido" id="idPartido" onChange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart3 = mysql_fetch_array($partido3)) echo "<option value =\"{$rsPart3["Partido_nro"]}\">{$rsPart3["Partido_nombre"]}\r\n"; ?>
      </select></td>
            <td width="28%" align="left"><input type="submit" name="Submit" value="Ver" /></td>
          </tr>
          <tr>
            <td colspan="3" align="right">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="right"><? echo $setting["Valor"]; ?>&nbsp;- <?=$user["Usuario_nivel"]; ?></td>
          </tr>
    </table>
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><img src="imagen/doc-blue.png" width="80" height="80" /></td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td width="93%" bgcolor="#E6E6E6"><strong>Administraci&oacute;n</strong></td>
          </tr>
          <tr>
            <td colspan="2"><p><a href="persona_buscar_textarea.php?<? echo $linkvar; ?>">Buscar personas por listado</a></p>
      <p><a href="nota-respuesta-form.php?<?=$linkvar ?>">Confeccionar nota</a> </p>	  </td>
          </tr>
        </table></td>
    <td align="center">&nbsp;</td>
    <td align="center"><img src="imagen/exptereg.png" width="80" height="80" /></td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td bgcolor="#E6E6E6"><strong>Expedientes regularizaci&oacute;n </strong></td>
        </tr>
          <tr>
            <td colspan="2"><p><a href="barrios_listar_exptereg.php">Alta/consulta expte (por barrio). </a></p>
              <p><a href="exptesreg_listar.php">Listar todos los expedientes </a></p></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
	<? if ($user["HabSbt"] <= '2' &&  $user["HabSbt"] != '0') { 

$res73 = mysql_query("SELECT * FROM dbo_settings WHERE idSetting = '4'");

$setting = mysql_fetch_array($res73);

$activo = $setting["Valor"];
	
?>	
	<form action="sysactiv.php" method="post">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" rowspan="4">
			  <img src="imagen/tools.png" width="80" height="80" /></td>
            <td width="5%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td colspan="4" bgcolor="#E6E6E6"><strong>&acute;Herramientas del sistema </strong></td>
          </tr>
          <tr>
            <td height="26">&nbsp;</td>
            <td colspan="4">Estado del sistema </td>
          </tr>
          <tr>
            <td height="28">&nbsp;</td>
            <td width="8%"><input name="sysactivo" type="radio" value="1" <? if ($activo == '1') { echo "checked=\"checked\""; } ?> /></td>
            <td width="22%">Activo</td>
            <td width="9%"><input name="sysactivo" type="radio" value="0" <? if ($activo == '0') { echo "checked=\"checked\""; } ?>/></td>
            <td width="26%">Inactivo</td>
          </tr>
          <tr>
            <td height="30">&nbsp;</td>
            <td colspan="4"><a href="usuarios-listar.php">Administrar usuarios </a></td>
          </tr>
    </table></form>
	 <? } ?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if (($user["HabSbt"] <= '2' && $user["HabSbt"] != '0') || ($user["HabSbt"] <= '4' &&  $user["HabSbt"] != '0' && $user["Area_no" == '72'])) { ?><img src="imagen/pagos.png" width="64" height="80"><? } ?></td>
    <td valign="top"><? if (($user["HabSbt"] <= '2' && $user["HabSbt"] != '0') || ($user["HabSbt"] <= '4' &&  $user["HabSbt"] != '0' && $user["Area_no" == '72'])) { ?><form method="get" action="beneficio_porbarrio_ptarjeta.php"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="6%" height="26" bgcolor="#E6E6E6">&nbsp;</td>
        <td width="94%" bgcolor="#E6E6E6"><strong>Control de pagos </strong></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td height="22" colspan="2" valign="top"><a href="#">Cargar rendici&oacute;n de pagos</a></td>
      </tr>
      <tr>
        <td colspan="2">Pedido de tarjetas por barrio </td>
      </tr>
      <tr>
        <td colspan="2"><select name="idBarrio" id="idBarrio">
  <option value="0">Seleccione un barrio</option>
  <?	  while ($barrio = mysql_fetch_array($sql789)) {	

$barrio_nro = $barrio["Barrio_nro"];
$barrio_partido = $barrio["Partido_nombre"];
$barrio_nombre = $barrio["Barrio_nombre"];
?>
  <option value="<? echo $barrio_nro; ?>"><?=$barrio_nombre; ?></option>
  <? } ?>
</select> <input type="submit" name="Submit" value="Ver" /></td>
      </tr>
      <tr>
        <td colspan="2" height="24"><a href="<? if ($user["idUsuario"] == '10') { echo "pedidos-tarjetas-listar.php"; }else{ echo "#"; } ?>">Ver/descargar pedidos generados</a>
		<p><a href="persona_buscar_tarjeta_form.php">Consulta beneficio por Nº tarjeta</a></p></td>
      </tr>
      
    </table>
    </form><? } ?></td>
  </tr>
</table>
<? }} ?>