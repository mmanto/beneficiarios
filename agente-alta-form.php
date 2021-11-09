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
<form action="agente-alta.php" method="post">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6"><h1>Dar de alta  agente </h1></td>
    </tr>
  <tr>
    <td height="40" colspan="2" valign="top"><a href="agentes-listar.php">[Volver] </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="330" rowspan="31" align="left" valign="middle">&nbsp;</td>
    </tr>
  
  <tr>
    <td width="17" height="24">&nbsp;</td>
    <td width="182"><strong>Fecha de ingreso</strong></td>
    <td width="193"><strong>Situci&oacute;n de revista</strong></td>
    <td width="126"><strong>Legajo</strong></td>
    <td width="48">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="middle"><input name="fechaingreso" type="text" id="fechaingreso" size="7" style="font-size:14px;" />
(dd/mm/aaaa) </td>
    <td><select name="revista" size="1" id="SitRevista" style="font-size:12px;" >
      <option value="1">Planta Perm. c/estabilidad</option>
      <option value="2">Planta Perm s/estabilidad</option>
      <option value="3">Planta Temporaria</option>
      <option value="4" selected="selected">Contrato Colegio de Esc.</option>
      <option value="5">Contrato locaci&oacute;n de obras</option>
    </select></td>
    <td><input name="legajo" type="text" id="legajo" style="font-size:14px;" size="12" /></td>
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
    <td><strong>Apellido agente</strong></td>
    <td><strong>Nombre agente </strong></td>
    <td colspan="2"><strong>DNI </strong> (Sin puntos)</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top"><input name="apellido" type="text" id="apellido" style="font-size:14px;" size="16"/>
    &nbsp;</td>
    <td valign="top"><input name="nombre" type="text" id="nombre" style="font-size:14px;" size="18"/></td>
    <td colspan="2"><input name="documento" type="text" id="documento" style="font-size:14px;" size="12" /></td>
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
    <td><strong>Estado civil</strong></td>
    <td><strong>Tel&eacute;fono</strong></td>
    <td><strong>Fecha nacimiento</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><select name="ecivil" size="1" id="ecivil">
      <option value="10" selected="selected">Sin Indicar</option>
      <option value="1">Soltero/a</option>
      <option value="3">Casado/a</option>
      <option value="4">Divorciado/a</option>
      <option value="5">Separado/a</option>
      <option value="8">Viudo/a</option>
      <option value="9">Otro</option>
    </select></td>
    <td><input name="telefono" type="text" id="telefono" style="font-size:14px;" size="16"/></td>
    <td colspan="2"><input name="fechanac" type="text" id="fechanac" style="font-size:14px;" size="7"/></td>
    </tr>
  <tr>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">(dd/mm/aaaa)</td>
    </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"><strong>No. de CUIL</strong></td>
        <td><strong>Categor&iacute;a</strong></td>
      </tr>
      <tr>
        <td colspan="2"><input name="cuil" type="text" id="cuil" style="font-size:14px;" size="12" /> 
          (Pueden usarse guiones)</td>
        <td><select name="categoria" size="1" id="categoria">
          <option value="0" selected="selected">Sin indicar</option>
          <option value="1">Administrativo</option>
          <option value="2">T&eacute;cnico</option>
          <option value="3">Profesional</option>
          <option value="4">Jefe Depto. (A/C).</option>
          <option value="5">Jefe Departamento</option>
          <option value="6">Funcionario</option>
          <option value="7">Chofer</option>
        </select></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td width="45%">&nbsp;</td>
      </tr>
      <tr>
        <td height="24" colspan="2"><strong>Domicilio</strong></td>
        <td><strong>Ciudad</strong></td>
      </tr>
      <tr>
        <td colspan="2"><input name="domicilio" type="text" id="domicilio" style="font-size:14px;" size="30"/></td>
        <td><input name="ciudad" type="text" id="ciudad" style="font-size:14px;" size="23"/></td>
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
    <td>&nbsp;</td>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="68%" height="24"><strong>Observaciones</strong></td>
          <td width="7%">&nbsp;</td>
          <td width="16%">&nbsp;</td>
          <td width="9%">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><textarea name="observaciones" cols="80" rows="4" id="observaciones" style="font-size:14px;"></textarea></td>
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
    <td colspan="2" align="left" valign="top"><input type="submit" name="Submit" value="Dar de alta agente" /></td>
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