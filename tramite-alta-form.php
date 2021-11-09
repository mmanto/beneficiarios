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
<style type="text/css">
<!--
.Estilo8 {font-size: 13px; font-weight: bold; }
-->
</style>

<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>
<form action="tramite-alta.php" method="post">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6"><h1>Dar de alta nuevo tr&aacute;mite </h1></td>
    </tr>
  <tr>
    <td height="40" colspan="2" valign="top"><a href="sbt-menu.php">[Volver al inicio] </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="330" rowspan="17" align="left" valign="middle"><table width="95%" border="0" cellspacing="0" cellpadding="0" >
      <tr >
        <td width="5%" height="28" bgcolor="#E7EBD8" >&nbsp;</td>
          <td width="30%" bgcolor="#E7EBD8"><strong class="Estilo8">Completo</strong></td>
          <td width="8%" align="center" bgcolor="#E7EBD8"><input name="completo" type="radio" value="1" /></td>
          <td width="14%" bgcolor="#E7EBD8"><strong>Si</strong></td>
          <td width="8%" align="center" bgcolor="#E7EBD8"><input name="completo" type="radio" value="0" checked="checked" /></td>
          <td width="15%" bgcolor="#E7EBD8"><strong>No</strong></td>
          <td width="8%" align="center" bgcolor="#E7EBD8">&nbsp;</td>
          <td width="12%" bgcolor="#E7EBD8">&nbsp;</td>
        </tr>
      <tr >
        <td height="28">&nbsp;</td>
          <td><span class="Estilo8">C&eacute;dula</span></td>
          <td align="center"><input name="cedula" type="radio" value="0" checked="checked" /></td>
          <td><strong>S/C</strong></td>
          <td align="center"><input name="cedula" type="radio" value="1" /></td>
          <td><strong>Pend.</strong></td>
          <td align="center"><input name="cedula" type="radio" value="2" /></td>
          <td><strong>Adj.</strong></td>
        </tr>
      <tr >
        <td width="5%" height="28" bgcolor="#E7EBD8" >&nbsp;</td>
          <td width="30%" bgcolor="#E7EBD8"><span class="Estilo8">Plancheta</span></td>
          <td width="8%" align="center" bgcolor="#E7EBD8"><input name="plancheta" type="radio" value="0" checked="checked" /></td>
          <td width="14%" bgcolor="#E7EBD8"><strong>S/C</strong></td>
          <td width="8%" align="center" bgcolor="#E7EBD8"><input name="plancheta" type="radio" value="1" /></td>
          <td width="15%" bgcolor="#E7EBD8"><strong>Pend.</strong></td>
          <td width="8%" align="center" bgcolor="#E7EBD8"><input name="plancheta" type="radio" value="2" /></td>
          <td width="12%" bgcolor="#E7EBD8"><strong>Adj.</strong></td>
        </tr>
      <tr>
        <td height="28">&nbsp;</td>
          <td><span class="Estilo8">Inf. dominio </span></td>
          <td align="center"><input name="infdominio" type="radio" value="0" checked="checked" /></td>
          <td><strong>S/C</strong></td>
          <td align="center"><input name="infdominio" type="radio" value="1" /></td>
          <td><strong>Pend.</strong></td>
          <td align="center"><input name="infdominio" type="radio" value="2" /></td>
          <td><strong>Adj.</strong></td>
        </tr>
      <tr>
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
          <td bgcolor="#E7EBD8"><span class="Estilo8">Pub. Edicto</span></td>
          <td align="center" bgcolor="#E7EBD8"><input name="edicto" type="radio" value="0" checked="checked" /></td>
          <td bgcolor="#E7EBD8"><strong>S/C</strong></td>
          <td align="center" bgcolor="#E7EBD8"><input name="edicto" type="radio" value="1" /></td>
          <td bgcolor="#E7EBD8"><strong>Pend.</strong></td>
          <td align="center" bgcolor="#E7EBD8"><input name="edicto" type="radio" value="2" /></td>
          <td bgcolor="#E7EBD8"><strong>Adj.</strong></td>
        </tr>
      <tr>
        <td height="28">&nbsp;</td>
          <td><span class="Estilo8">C&aacute;mara Elec. </span></td>
          <td align="center"><input name="camara" type="radio" value="0" checked="checked" /></td>
          <td><strong>S/C</strong></td>
          <td align="center"><input name="camara" type="radio" value="1" /></td>
          <td><strong>Pend.</strong></td>
          <td align="center"><input name="camara" type="radio" value="2" /></td>
          <td><strong>Adj.</strong></td>
        </tr>
      <tr>
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
          <td bgcolor="#E7EBD8"><span class="Estilo8">Carta Doc. </span></td>
          <td align="center" bgcolor="#E7EBD8"><input name="cartadoc" type="radio" value="0" checked="checked" /></td>
          <td bgcolor="#E7EBD8"><strong>S/C</strong></td>
          <td align="center" bgcolor="#E7EBD8"><input name="cartadoc" type="radio" value="1" /></td>
          <td bgcolor="#E7EBD8"><strong>Pend.</strong></td>
          <td align="center" bgcolor="#E7EBD8"><input name="cartadoc" type="radio" value="2" /></td>
          <td bgcolor="#E7EBD8"><strong>Adj.</strong></td>
        </tr>
		<tr>
        <td height="28">&nbsp;</td>
          <td><span class="Estilo8">Terminado</span></td>
          <td align="center"><input name="terminado" type="radio" value="1" /></td>
          <td><strong>Si</strong></td>
          <td align="center"><input name="terminado" type="radio" value="0" checked="checked" /></td>
          <td><strong>No</strong></td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="30" bgcolor="#E7EBD8">&nbsp;</td>
          <td colspan="7" valign="bottom" bgcolor="#E7EBD8" class="Estilo8">Observaciones</td>
          </tr>
      <tr>
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
        <td colspan="7" bgcolor="#E7EBD8"><textarea name="observaciones" cols="45" id="observaciones"></textarea></td>
      </tr>
      <tr>
        <td height="13" colspan="8" bgcolor="#E7EBD8"></td>
        </tr>
    </table></td>
    </tr>
  
  <tr>
    <td width="17" height="24">&nbsp;</td>
    <td width="205"><strong>Fecha de inicio </strong></td>
    <td width="179"><strong>Tipo de tr&aacute;mite </strong></td>
    <td width="117">&nbsp;</td>
    <td width="48">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="205" valign="top"><input name="fechainicio" type="text" id="fechainicio" style="font-size:16px;" size="7" value="<?=date("d/m/Y"); ?>" />
      (dd/mm/aaaa)    </td>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12%" align="center" bgcolor="#FFFF99"><input name="tramitetipo" type="radio" value="1" checked="checked" /></td>
        <td width="32%" height="34" bgcolor="#FFFF99">Regularizaci&oacute;n</td>
        <td width="9%" align="center" bgcolor="#FFFF99"><input name="tramitetipo" type="radio" value="2" /></td>
        <td width="36%" bgcolor="#FFFF99">Consolidaci&oacute;n</td>
        <td width="11%">&nbsp;</td>
      </tr>
    </table></td>
    <td></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><strong>Partido</strong></td>
    <td><strong>Nomenclatura</strong></td>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><select name="idPartido" id="idPartido" style="font-size:13px;">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select>&nbsp;</td>
    <td><input name="nomenclatura" type="text" id="nomenclatura" style="font-size:16px;" size="12" />
    &nbsp;</td>
    <td colspan="2">&nbsp; </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><strong>Apellido titular </strong></td>
    <td><strong>Nombre titular </strong></td>
    <td colspan="2"><strong>DNI Titular</strong> (Sin puntos)</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="apellido" type="text" id="apellido" style="font-size:16px;" size="18"/>
    &nbsp;</td>
    <td><input name="nombre" type="text" id="nombre" style="font-size:16px;" size="14"/></td>
    <td colspan="2"><input name="TitularDNI" type="text" id="TitularDNI" style="font-size:16px;" size="10" />&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><strong>Direcci&oacute;n</strong></td>
    <td><strong>Tel&eacute;fono</strong></td>
    <td><strong>Exp. Ref. </strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="direccion" type="text" id="direccion" style="font-size:16px;" size="18"/>&nbsp;</td>
    <td><input name="telefono" type="text" id="telefono" style="font-size:16px;" size="14"/>&nbsp;</td>
    <td><input name="numref" type="text" id="numref" style="font-size:16px;" size="10"/>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="68%"><strong>Escribano</strong></td>
          <td width="7%">&nbsp;</td>
          <td width="16%">&nbsp;</td>
          <td width="9%">&nbsp;</td>
        </tr>
        <tr>
          <td><input name="escribano" type="text" id="escribano" style="font-size:16px;" size="30"/></td>
          <td align="center" bgcolor="#DBDBDB"><input name="archivado" type="checkbox" id="archivado" value="1" /></td>
          <td bgcolor="#DBDBDB">Archivado</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="left" valign="top"><input type="submit" name="Submit" value="Dar de alta tr&aacute;mite" /></td>
    <td width="4" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="40">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? include("pie.php"); ?>

<? } ?>