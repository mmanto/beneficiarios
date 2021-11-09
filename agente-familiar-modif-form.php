<? 

include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];

$idAgente = $_GET["idAgente"];
$idFamiliar = $_GET["idFamiliar"];

$sql = "SELECT agente_nombre, agente_apellido FROM dbo_agentes WHERE agente_nro = $idAgente";
$res = mysql_query($sql);
$agente = mysql_fetch_array($res);

$sql2 = "SELECT * FROM dbo_agente_familia WHERE familiar_nro = $idFamiliar";
$res2 = mysql_query($sql2);
$familiar = mysql_fetch_array($res2);



?>
<form action="agente-familiar-modif.php" method="post">
  <table width="610" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5"><h1>Modificar miembro de grupo familiar</h1></td>
    </tr>
    <tr>
    <td height="55" colspan="5" valign="middle"><a href="javascript:history.back(1)">[Volver]</a></td>
  </tr>
  <tr>
    <td width="4" height="24">&nbsp;</td>
    <td width="196"><strong>Apellido </strong></td>
    <td width="228"><strong>Nombre  </strong></td>
    <td colspan="2"><strong>DNI </strong> (Sin puntos)</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top"><input name="apellido" type="text" id="apellido" style="font-size:14px;" size="16" value="<? echo $familiar["familiar_apellido"]; ?>"/>
    &nbsp;</td>
    <td valign="top"><input name="nombre" type="text" id="nombre" style="font-size:14px;" size="20" value="<? echo $familiar["familiar_nombre"]; ?>"/></td>
    <td colspan="2"><input name="documento" type="text" id="documento" style="font-size:14px;" size="12" value="<? echo $familiar["familiar_dni_nro"]; ?>"/></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="117">&nbsp;</td>
    <td width="65">&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><strong>Fecha de nacimiento</strong></td>
    <td><strong>V&iacute;nculo</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="fechanac" type="text" id="fechanac" style="font-size:14px;" size="13" value="<? echo $familiar["familiar_fechanac"]; ?>"/></td>
    <td><select name="vinculo" size="1" id="vinculo" style="font-size:14px;">
      <option value="0" <? if($familiar["familiar_vinculo"] == '0') { echo "selected=\"selected\""; } ?>>Sin Indicar</option>
      <option value="1" <? if($familiar["familiar_vinculo"] == '1') { echo "selected=\"selected\""; } ?>>Esposo/Esposa</option>
      <option value="2" <? if($familiar["familiar_vinculo"] == '2') { echo "selected=\"selected\""; } ?>>Hijo/a</option>
      <option value="3" <? if($familiar["familiar_vinculo"] == '3') { echo "selected=\"selected\""; } ?>>Padre/Madre</option>
    </select>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="24">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="68%" height="24"><strong>Observaciones</strong></td>
          <td width="7%">&nbsp;</td>
          <td width="16%">&nbsp;</td>
          <td width="9%">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><textarea name="observaciones" cols="80" rows="4" id="observaciones" style="font-size:14px;"><? echo $familiar["familiar_observaciones"]; ?></textarea></td>
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
    <td><input type="hidden" name="idFamiliar" value="<? echo $idFamiliar; ?>" />
    	<input type="hidden" name="idAgente" value="<? echo $idAgente; ?>" />
    &nbsp;</td>
    <td colspan="2" align="left" valign="top"><input type="submit" name="Submit" value="Actualizar datos" /></td>
    </tr>
  <tr>
    <td height="40">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
    </tr>
</table>
</form>
</body>
</html>
<? include("pie.php"); ?>