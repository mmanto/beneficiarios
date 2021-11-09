<? session_start();

include ("conec.php");

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
}else{

include ("cabecera.php");	
$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);

$sql789 = mysql_query("SELECT
Barrio_nro,
Barrio_nombre
FROM dbo_barrio
WHERE Barrio_conurbano = '1'
ORDER BY Barrio_nombre ASC",$link);

$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

$strSQL2 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido2 = mysql_query ($strSQL2);

$strSQL3 = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido3 = mysql_query ($strSQL3);

?>
<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="377"><h2>Panel de administraci&oacute;n</h2></td>
    <td width="18">&nbsp;</td>
    <td width="355" align="right" style="font-size:16px; color:#818F43; font-weight: bold;">Usuario: <? echo $user["Nombre"]; ?></td>
  </tr>
  <tr>
    <td><a href="menu.php">[Volver al menu principal]</a>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="40">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="32%" rowspan="6" align="center"><img src="imagen/benef.png" width="80" height="80" /></td>
        <td width="6%" height="28" bgcolor="#E6E6E6">&nbsp;</td>
        <td width="62%" bgcolor="#E6E6E6"><strong>Beneficiarios</strong></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><form action="barrios_listar_partido.php" method="get">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
		</form></td>
      </tr>
      <tr>
        <td height="26" colspan="2"><a href="benef_buscar_nomenc_form.php">Consulta beneficios por nomenclatura </a></td>
      </tr>
      <tr>
        <td height="26" colspan="2"><a href="beneficio_buscar_mat_form.php">Consulta beneficio por matr&iacute;cula</a></td>
      </tr>
      <tr>
        <td height="26" colspan="2"><a href="persona_buscar_doc_form.php">Consulta beneficio por documento</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="32%" rowspan="5" align="center"><img src="imagen/doc-blue.png" width="80" height="80" /></td>
          <td width="6%" height="28" bgcolor="#E6E6E6">&nbsp;</td>
          <td width="62%" bgcolor="#E6E6E6"><strong>Administraci&oacute;n</strong></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td height="26" colspan="2"><a href="tramite-alta-form.php">Buscar persona por listado</a></td>
        </tr>
        <tr>
          <td height="26" colspan="2"><a href="tramite_buscar_nmb_form.php">Confeccionar nota respuesta</a></td>
        </tr>
        <tr>
          <td height="26" colspan="2">Gestionar informaci&oacute;n partidos</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table><form action="sysactiv.php" method="post">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" rowspan="7">
			  <img src="imagen/tools.png" width="80" height="80" /></td>
            <td width="5%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td colspan="4" bgcolor="#E6E6E6"><strong>Herramientas del sistema </strong></td>
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
	</form></td>
    <td>&nbsp;</td>
    <td>
    <? if ($user["p801"] == '1' || $user["p802"] == '1' || $user["p803"] == '1' || $user["p804"] == '1' ) { ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="32%" rowspan="6" align="center"><img src="imagen/tramite_ley.png" width="80" height="80" /></td>
        <td width="6%" height="28" bgcolor="#E6E6E6">&nbsp;</td>
        <td width="62%" bgcolor="#E6E6E6"><strong>Tr&aacute;mites ley 24374</strong></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td height="26" colspan="2"><a href="tramite-alta-form.php">Dar de alta nuevo tr&aacute;mite </a>&nbsp;</td>
      </tr>
      <tr>
        <td height="26" colspan="2"><a href="tramite_buscar_nmb_form.php">Buscar tr&aacute;mite por apellido </a></td>
      </tr>
      <tr>
        <td height="26" colspan="2">Buscar tr&aacute;mite por referencia</td>
      </tr>
      <tr>
        <td height="26" colspan="2">Buscar tr&aacute;mite por nomenclatura</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table>    <? } ?>
    <form action="exptes-dpes-listar-partido.php" method="get"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          	<td width="32%" rowspan="5" align="center"><img src="imagen/expte.png" width="80" height="80" /></td>
            <td width="6%" height="28" bgcolor="#E6E6E6">&nbsp;</td>
            <td colspan="2" bgcolor="#E6E6E6"><strong>Expedientes escrituraci&oacute;n </strong></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td height="26" colspan="3"><p><a href="barrios_listar_exptes.php"></a><a href="exptes-dpes-listar.php">Listar todos los expedientes </a></p>            </td>
          </tr>
          <tr>
            <td height="26" colspan="3">Listar expedientes por partido </td>
          </tr>
          <tr>
            <td height="26" colspan="2"><select name="idPartido" id="idPartido" onChange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
              <option value="0">Seleccione un Partido...</option>
              <? while($rsPart3 = mysql_fetch_array($partido3)) echo "<option value =\"{$rsPart3["Partido_nro"]}\">{$rsPart3["Partido_nombre"]}\r\n"; ?>
            </select></td>
            <td width="18%" align="left"><input type="submit" name="Submit" value="Ver" /></td>
          </tr>
          <tr>
            <td width="32%" align="center">&nbsp;</td>
            <td colspan="3" align="right">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="right">&nbsp;</td>
          </tr>
    </table></form>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="32%" rowspan="4" align="center"><img src="imagen/exptereg.png" width="80" height="80" /></td>
        <td width="6%" height="28" bgcolor="#E6E6E6">&nbsp;</td>
        <td width="62%" bgcolor="#E6E6E6"><strong>Expedientes regularizaci&oacute;n</strong></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td height="26" colspan="2"><a href="barrios_listar_exptereg.php">Alta/consulta expte (por barrio)</a></td>
      </tr>
      <tr>
        <td height="26" colspan="2"><a href="exptesreg_listar.php">Listar todos los expedientes </a></td>
      </tr>
      <tr>
        <td width="32%" align="center">&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table>
    <? if ($user["p732"] == '1' && $user["HabSbt"] != '0')  { ?><form method="get" action="beneficio_porbarrio_ptarjeta.php">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="32%" rowspan="8" align="center"><img src="imagen/pagos.png" width="64" height="80" /></td>
        <td width="6%" height="28" bgcolor="#E6E6E6">&nbsp;</td>
        <td width="62%" bgcolor="#E6E6E6"><strong>Control de pagos</strong></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td height="26" colspan="2"><a href="rendicion-alta-form.php">Cargar rendici&oacute;n de pagos</a></td>
      </tr>
      <tr>
        <td height="26" colspan="2"><a href="rendicion-historial.php">Ver historial de rendiciones</a></td>
      </tr>
      <tr>
        <td height="26" colspan="2">Pedido de tarjetas por barrio:</td>
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
        <td colspan="2"><a href="tarjeta-buscar-form.php">Buscar tarjeta por n&uacute;mero</a></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table>
    </form><? } ?>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?
include("pie.php");
} ?>