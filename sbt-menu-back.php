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

$sql789 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre
FROM dbo_barrio
WHERE Barrio_conurbano = '1'
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
    <td width="232" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
			<p><a href="beneficio_buscar_mat_form.php">Consulta beneficio por matr&iacute;cula</a></p>
            <p><a href="persona_buscar_nmb_form.php">Consulta beneficio por nombre y apellido</a></p>
          	<p><a href="tarjeta-buscar-form.php">Buscar beneficio por n&uacute;mero de tarjeta</a></p>
            <p><a href="persona_buscar_doc_form.php">Consulta beneficio por documento</a></p>	      </td>
        </tr>
      
    </table></td>
    <td align="center">&nbsp;</td>
    <td align="center"><img src="imagen/tramite_ley.png" width="80" height="80" />&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td width="93%" bgcolor="#E6E6E6"><strong>Tr&aacute;mites ley 24374 </strong></td>
          </tr>
          <tr>
            <td colspan="2"><p><? if ($user["p801"] == '1') { ?><a href="tramite-alta-form.php"><? } ?>Dar de alta nuevo tr&aacute;mite </a></p>
              <p><a href="tramite_buscar_nmb_form.php">Buscar tr&aacute;mite por apellido </a> </p>
              <p><a href="tramite_buscar_numref_form.php">Buscar tr&aacute;mite por referencia </a> </p>
              <p><a href="tramite_buscar_nomenc_form.php">Buscar tr&aacute;mite por nomenclatura </a> </p>
              <p><a href="tramite_buscar_titdom_form.php">Buscar tr&aacute;mite por titular dominial </a> </p>
              <p><a href="informe-tramiteley-poranio.php">Reporte tr&aacute;mites por a&ntilde;o (total)</a></p>
              <p><a href="informe-tramiteley-porpartido.php">Reporte tr&aacute;mites por partido y a&ntilde;o</a></p>
              <p><a href="tramites_eliminados_listar.php">Papelera de tr&aacute;mites eliminados</a> </p>
              	  </td>
          </tr>
        </table>&nbsp;</td>
  </tr>
  <tr>
    <td width="99">&nbsp;</td>
    <td width="232" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="6%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
        <td width="94%" bgcolor="#E6E6E6"><strong>Beneficios Ley 24374 </strong></td>
      </tr>
      <tr>
        <td height="23" colspan="2"><a href="beneficio_ley24374_alta_form.php">Alta nuevo beneficio Ley 24374 </a></td>
      </tr>
      <tr>
        <td height="23" colspan="2"><a href="beneficios_ley24374_listar.php">Listar beneficios Ley 24374</a></td>
      </tr>
      <tr>
        <td colspan="2" align="right">&nbsp;</td>
      </tr>
    </table></td>
    <td width="27" align="center">&nbsp;</td>
    <td width="98" align="center"><img src="imagen/expte.png" width="80" height="80" /></td>
    <td width="244" valign="top"><form action="exptes-dpes-listar-partido.php" method="get"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="5%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td colspan="2" bgcolor="#E6E6E6"><strong>Expedientes escrituraci&oacute;n </strong></td>
          </tr>
          <tr>
            <td height="23" colspan="3"><a href="barrios_listar_exptes.php"></a><a href="exptes-dpes-listar.php">Listar todos los expedientes </a>            </td>
          </tr>
          <tr>
            <td height="23" colspan="3"><a href="exptes-gescrit-listar.php">Listar expedientes en el &aacute;rea</a></td>
          </tr>
          <tr>
            <td height="23" colspan="3"><a href="aegg.php">Expedientes salidos a EGG</a></td>
          </tr>
          <tr>
            <td height="23" colspan="3">Listar expedientes por partido </td>
          </tr>
          <tr>
            <td colspan="2"><select name="idPartido" id="idPartido" onChange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart3 = mysql_fetch_array($partido3)) echo "<option value =\"{$rsPart3["Partido_nro"]}\">{$rsPart3["Partido_nombre"]}\r\n"; ?>
      </select></td>
            <td width="27%" align="left"><input type="submit" name="Submit" value="Ver" /></td>
          </tr>
          <tr>
            <td colspan="3" align="right">&nbsp;</td>
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
	<? if ($user["idUsuario"] <= '6' || $user["idUsuario"] == '23') { 

$res73 = mysql_query("SELECT * FROM dbo_settings WHERE idSetting = '4'");

$setting = mysql_fetch_array($res73);

$activo = $setting["Valor"];
	
?>	
	<form action="sysactiv.php" method="post">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" rowspan="7">
			  <img src="imagen/tools.png" width="80" height="80" /></td>
            <td width="5%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td colspan="4" bgcolor="#E6E6E6"><strong>&acute;Herramientas del sistema </strong></td>
          </tr>
          <tr>
            <td height="30">&nbsp;</td>
            <td colspan="4"><a href="usuarios-listar.php">Administrar usuarios </a></td>
          </tr>
          <tr>
            <td height="26" bgcolor="#FFF7BB">&nbsp;</td>
            <td colspan="4" valign="bottom" bgcolor="#FFF7BB">Estado del sistema </td>
          </tr>
          <tr>
            <td height="28" bgcolor="#FFF7BB">&nbsp;</td>
            <td width="8%" bgcolor="#FFF7BB"><input name="sysactivo" type="radio" value="1" <? if ($activo == '1') { echo "checked=\"checked\""; } ?> /></td>
            <td width="22%" bgcolor="#FFF7BB">Activo</td>
            <td width="9%" bgcolor="#FFF7BB"><input name="sysactivo" type="radio" value="0" <? if ($activo == '0') { echo "checked=\"checked\""; } ?>/></td>
            <td width="26%" bgcolor="#FFF7BB">Inactivo</td>
          </tr>
          <tr>
            <td height="30" bgcolor="#FFF7BB">&nbsp;</td>
            <td height="30" bgcolor="#FFF7BB">&nbsp;</td>
            <td height="30" colspan="3" align="center" valign="top" bgcolor="#FFF7BB"><label>
              <input type="submit" name="Submit2" value="Actualizar estado" />
            </label></td>
          </tr>
          <tr>
            <td height="30">&nbsp;</td>
            <td colspan="4">&nbsp;</td>
          </tr>
    </table>
	</form>
	 <? } ?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if ($user["p732"] == '1' && $user["HabSbt"] != '0')  { ?><img src="imagen/pagos.png" width="64" height="80"><? } ?></td>
    <td valign="top"><? if ($user["p732"] == '1' && $user["HabSbt"] != '0')  { ?><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="6%" height="26" bgcolor="#E6E6E6">&nbsp;</td>
        <td width="94%" bgcolor="#E6E6E6"><strong>Control de pagos </strong></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td height="22" colspan="2" valign="top"><a href="rendicion-alta-form.php">Cargar rendici&oacute;n de pagos</a></td>
      </tr>
      <tr>
        <td height="26" colspan="2"><a href="rendicion-historial.php">Ver historial de rendiciones</a></td>
      </tr>
      <tr>
        <td height="26" colspan="2"><a href="tarjetas-pedido-listar.php">Nuevo pedido de tarjetas al banco</a></td>
      </tr>
      <tr>
        <td colspan="2" height="26"><a href="<? if ($user["idUsuario"] == '10') { echo "pedidos-tarjetas-listar.php"; }else{ echo "#"; } ?>">Ver/descargar pedidos generados</a></td>
      </tr>
      <tr>
        <td colspan="2" height="24"><a href="tarjeta-buscar-form.php">Buscar tarjeta por n&uacute;mero</a></td>
      </tr>
      
    </table>
<? } ?></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
</table>
<? }} ?>