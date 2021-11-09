<?

$idAgente = $_GET["idAgente"];

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

//Select agente
$res = mysql_query("SELECT * FROM dbo_agentes WHERE agente_nro = $idAgente");
$agente = mysql_fetch_array($res); 

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
<form action="agente-modif.php" method="post">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6"><h1>Modificar datos de  agente </h1></td>
    </tr>
  <tr>
    <td height="30" colspan="2" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="289" rowspan="30" align="left" valign="middle">&nbsp;</td>
    </tr>
  
  <tr>
    <td width="17" height="24">&nbsp;</td>
    <td width="184"><strong>Fecha de ingreso</strong></td>
    <td width="191"><strong>Situci&oacute;n de revista</strong></td>
    <td width="111"><strong>Legajo</strong></td>
    <td width="104">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="middle"><input name="fechaingreso" type="text" id="fechaingreso" size="7" style="font-size:14px;" value="<? echo cambiaf_a_normal($agente["agente_ingreso_fecha"]); ?>"/>
(dd/mm/aaaa) </td>
    <td><select name="revista" size="1" id="SitRevista" style="font-size:12px;" >
      <option value="1" <? if($agente["agente_revista_tipo"] == '1') { echo "selected='selected'"; } ?>>Planta Perm. c/estabilidad</option>
      <option value="2" <? if($agente["agente_revista_tipo"] == '2') { echo "selected='selected'"; } ?>>Planta Perm s/estabilidad</option>
      <option value="3" <? if($agente["agente_revista_tipo"] == '3') { echo "selected='selected'"; } ?>>Planta Temporaria</option>
      <option value="4" <? if($agente["agente_revista_tipo"] == '4') { echo "selected='selected'"; } ?>>Contrato Colegio de Esc.</option>
      <option value="5" <? if($agente["agente_revista_tipo"] == '5') { echo "selected='selected'"; } ?>>Contrato locaci&oacute;n de obras</option>
    </select></td>
    <td><input name="legajo" type="text" id="legajo" style="font-size:14px;" size="12" value="<? echo $agente["agente_legajo"]; ?>" /></td>
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
    <td valign="top"><input name="apellido" type="text" id="apellido" style="font-size:14px;" size="16" value="<? echo $agente["agente_apellido"]; ?>"/>
    &nbsp;</td>
    <td valign="top"><input name="nombre" type="text" id="nombre" style="font-size:14px;" size="18" value="<? echo $agente["agente_nombre"]; ?>"/></td>
    <td colspan="2"><input name="documento" type="text" id="documento" style="font-size:14px;" size="12" value="<? echo $agente["agente_dni_nro"]; ?>"/></td>
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
    <td colspan="2"><strong>Fecha nacimiento</strong></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><select name="ecivil" size="1" id="ecivil">
          <option value="10" <? if($agente["agente_ecivil"] == '10') { echo "selected='selected'"; } ?> >Sin Indicar</option>
          <option value="1" <? if($agente["agente_ecivil"] == '1') { echo "selected='selected'"; } ?>>Soltero/a</option>
          <option value="3" <? if($agente["agente_ecivil"] == '3') { echo "selected='selected'"; } ?>>Casado/a</option>
          <option value="4" <? if($agente["agente_ecivil"] == '4') { echo "selected='selected'"; } ?>>Divorciado/a</option>
          <option value="5" <? if($agente["agente_ecivil"] == '5') { echo "selected='selected'"; } ?>>Separado/a</option>         
          <option value="8" <? if($agente["agente_ecivil"] == '8') { echo "selected='selected'"; } ?>>Viudo/a</option>
          <option value="9" <? if($agente["agente_ecivil"] == '9') { echo "selected='selected'"; } ?>>Otro</option>
      </select></td>
    <td><input name="telefono" type="text" id="telefono" style="font-size:14px;" size="16" value="<? echo $agente["agente_telefono"]; ?>"/></td>
    <td colspan="2"><input name="fechanac" type="text" id="fechanac" style="font-size:14px;" size="7" value="<? echo cambiaf_a_normal($agente["agente_fechanac"]); ?>"/></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left">(dd/mm/aaaa)</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><strong>CUIL</strong></td>
    <td><strong>Categoria </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><input name="cuil" type="text" id="cuil" style="font-size:14px;" size="14" value="<? echo $agente["agente_cuil"]; ?>"/></td>
    <td><select name="categoria" size="1" id="categoria">
      <option value="0" selected="selected">Sin indicar</option>
      <option value="1" <? if($agente["agente_categoria"] == '1') { echo "selected='selected'"; } ?>>Administrativo</option>
      <option value="2" <? if($agente["agente_categoria"] == '2') { echo "selected='selected'"; } ?>>T&eacute;cnico</option>
      <option value="3" <? if($agente["agente_categoria"] == '3') { echo "selected='selected'"; } ?>>Profesional</option>
      <option value="4" <? if($agente["agente_categoria"] == '4') { echo "selected='selected'"; } ?>>Jefe Depto. (A/C)</option>
      <option value="5" <? if($agente["agente_categoria"] == '5') { echo "selected='selected'"; } ?>>Jefe Departamento</option>
      <option value="6" <? if($agente["agente_categoria"] == '6') { echo "selected='selected'"; } ?>>Funcionario</option>
      <option value="7" <? if($agente["agente_categoria"] == '7') { echo "selected='selected'"; } ?>>Chofer</option>
    </select></td>
    <td colspan="2"><table width="90%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td width="41%" height="30" align="center" bgcolor="#FFFF99">Comisiona</td>
        <td width="14%" align="center" valign="middle" bgcolor="#FFFF99"><input name="comisiona" type="radio" id="radio" value="1" <? if ($agente["agente_comisiona"] == '1') { echo "checked=\"checked\""; } ?> /></td>
        <td width="16%" bgcolor="#FFFF99">Si</td>
        <td width="14%" bgcolor="#FFFF99"><input type="radio" name="comisiona" id="radio2" value="0" <? if ($agente["agente_comisiona"] == '0') { echo "checked=\"checked\""; } ?>/></td>
        <td width="15%" bgcolor="#FFFF99">No</td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="48%">&nbsp;</td>
        <td width="52%">&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Domicilio</strong></td>
        <td><strong>Ciudad</strong></td>
      </tr>
      <tr>
        <td><input name="domicilio" type="text" id="domicilio" style="font-size:14px;" size="26" value="<? echo $agente["agente_domicilio"]; ?>"/></td>
        <td><input name="ciudad" type="text" id="ciudad" style="font-size:14px;" size="30" value="<? echo $agente["agente_domicilio_ciudad"]; ?>"/></td>
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
          <td width="68%"><strong>Observaciones</strong></td>
          <td width="7%">&nbsp;</td>
          <td width="16%">&nbsp;</td>
          <td width="9%">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4"><textarea name="observaciones" cols="88" rows="4" id="observaciones" style="font-size:14px;"><? echo $agente["agente_observaciones"]; ?></textarea></td>
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
    <td colspan="3" align="right">
    <input type="hidden" name="idAgente" value="<?=$idAgente; ?>" />
    <input type="submit" name="Submit" value="Modificar datos de agente" /></td>
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
