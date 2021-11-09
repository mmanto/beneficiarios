<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";



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

?>
<table width="650" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="9"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="47%"><h2>Panel de administraci&oacute;n </h2></td>
          <td width="53%" align="right"><span class="user">Usuario: <? echo $usuario_nombre; ?></span><br />            <a href="logout.php">Salir del sistema</a> </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="36" colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td height="2" colspan="9"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15%" valign="top"><img src="imagen/benef.png" width="80" height="80" /></td>
        <td width="36%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td width="93%" bgcolor="#E6E6E6"><strong>Beneficiarios</strong></td>
          </tr>
          <tr>
            <td colspan="2"><p><a href="barrios_listar_benef.php">Alta/consulta beneficio (por barrio) </a></p>
			<? // <p><a href="beneficio_alta_simp_form.php">Alta nuevo beneficio (sin barrio)</a></p> ?>
			<p><a href="benef_buscar_nomenc_form.php">Consulta beneficios por nomenclatura </a></p>
            <p><a href="persona_buscar_doc_form.php">Consulta beneficio por documento</a></p>			  </td>
          </tr>
        </table></td>
        <td width="16%" align="center" valign="top"><img src="imagen/expte.png" width="80" height="80" /></td>
        <td width="33%" valign="top">
		<form action="exptes_listar_partido.php" method="get">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td colspan="2" bgcolor="#E6E6E6"><strong>Expedientes escrituraci&oacute;n </strong></td>
            </tr>
          <tr>
            <td colspan="3"><p><a href="barrios_listar_exptes.php">Alta/consulta expte (por barrio). </a></p>
              <p><a href="exptes_listar.php">Listar todos los expedientes </a></p></td>
          </tr>
          <tr>
            <td colspan="3">Listar expedientes por partido </td>
          </tr>
          <tr>
            <td colspan="2"><select name="idPartido" id="idPartido" onChange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart2 = mysql_fetch_array($partido2)) echo "<option value =\"{$rsPart2["Partido_nro"]}\">{$rsPart2["Partido_nombre"]}\r\n"; ?>
      </select></td>
            <td width="32%" align="center"><input type="submit" name="Submit" value="Ver" /></td>
          </tr>
          <tr>
            <td colspan="3" align="right">&nbsp;</td>
          </tr>
        </table></form></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>

      <tr>
        <td><img src="imagen/doc-blue.png" width="80" height="80" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td width="93%" bgcolor="#E6E6E6"><strong>DPES</strong></td>
          </tr>
          <tr>
            <td colspan="2"><p><a href="persona_buscar_textarea.php?<? echo $linkvar; ?>">Buscar personas por listado</a></p>
      <p><a href="nota-respuesta-form.php?<?=$linkvar ?>">Confeccionar nota</a> </p>
	  <p><a href="actualizar_nota_form.php?<?=$linkvar ?>">Actualizar N&ordm; de  nota</a> </p>	  </td>
          </tr>
        </table></td>
        <td align="center"><img src="imagen/expte.png" width="80" height="80" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td colspan="2" bgcolor="#E6E6E6"><strong>Expedientes regularizaci&oacute;n </strong></td>
            </tr>
          <tr>
            <td colspan="3"><p><a href="barrios_listar_exptereg.php">Alta/consulta expte (por barrio). </a></p>
              <p><a href="exptesreg_listar.php">Listar todos los expedientes </a></p></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
            </tr>
          <tr>
            <td colspan="3" align="right">&nbsp;</td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><img src="imagen/system-icon.png" width="80" height="80" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td width="93%" bgcolor="#E6E6E6"><strong>Sistema</strong></td>
          </tr>
          <tr>
            <td height="12" colspan="2">&nbsp;              </td>
          </tr>
          <tr>
            <td height="13" colspan="2"><form action="beneficio_sinbarrio_listar.php" method="get"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="22">Asignar barrio a beneficios sin barrio</td>
              </tr>
              <tr>
                <td height="26"><select name="idPartido" id="idPartido" onChange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select></td>
              </tr>
              <tr>
                <td height="28" align="center"><input type="submit" name="Submit" value="Enviar" /></form></td>
              </tr>
            </table></td>
        <td align="center"><img src="imagen/plano.gif" width="80" height="69" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%" height="24" bgcolor="#E6E6E6">&nbsp;</td>
            <td width="93%" bgcolor="#E6E6E6"><strong>Planos</strong></td>
          </tr>
          <tr>
            <td colspan="2"><p><a href="plano_alta_form.php">Dar de alta nuevo plano </a></p>
      <p><a href="planos_listar.php">Listar planos </a></p></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
        </table></td>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
    </table></td>
  </tr> 
  <tr>
    <td>&nbsp;</td>
    <td height="40" colspan="2" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="12">&nbsp;</td>
    <td width="180" colspan="2" valign="top"><? echo $cant_insert_hoy."/".$cant_insert_total;  ?></td>
    <td width="12">&nbsp;</td>
    <td width="180" colspan="2" valign="top">&nbsp;</td>
    <td width="12">&nbsp;</td>
    <td width="180" colspan="2">&nbsp;</td>
  </tr>
</table>
<?       
include "pie.php";

?>
<? } ?>