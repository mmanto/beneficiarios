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

$idTramite = $_GET["idTramite"];

$SQLtramite = "SELECT * FROM dbo_tramite_ley WHERE Tramite_nro = '$idTramite'";
$resTramite = mysql_query($SQLtramite);
$tramite = mysql_fetch_array($resTramite);

$SQLpersona = "SELECT * FROM dbo_persona WHERE Tramite_nro = '$idTramite'";
$resPersona = mysql_query($SQLpersona);
$persona = mysql_fetch_array($resPersona);


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
<form action="tramite-modif.php" method="post">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6"><h1>Modificar tr&aacute;mite </h1></td>
    </tr>
  <tr>
    <td height="50" colspan="2" valign="top"><a href="tramite-informe.php?idTramite=<?=$idTramite; ?>">[Volver] </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="330" rowspan="16" align="left" valign="middle"><table width="95%" border="0" cellspacing="0" cellpadding="0" >
      <tr >
        <td width="5%" height="28" bgcolor="#E7EBD8" >&nbsp;</td>
          <td width="30%" bgcolor="#E7EBD8"><strong class="Estilo8">Completo</strong></td>
          <td width="8%" align="center" bgcolor="#E7EBD8"><input name="completo" type="radio" value="1" <? if($tramite["Tramite_completo"] == '1') {echo "checked=\"checked\"";} ?>/></td>
          <td width="14%" bgcolor="#E7EBD8"><strong>Si</strong></td>
          <td width="8%" align="center" bgcolor="#E7EBD8"><input name="completo" type="radio" value="0" <? if($tramite["Tramite_completo"] == '0') {echo "checked=\"checked\"";} ?>/></td>
          <td width="15%" bgcolor="#E7EBD8"><strong>No</strong></td>
          <td width="8%" align="center" bgcolor="#E7EBD8">&nbsp;</td>
          <td width="12%" bgcolor="#E7EBD8">&nbsp;</td>
        </tr>
      <tr >
        <td height="28">&nbsp;</td>
          <td><span class="Estilo8">C&eacute;dula</span></td>
          <td align="center"><input name="cedula" type="radio" value="0" <? if($tramite["Tramite_cedula"] == '0') {echo "checked=\"checked\"";} ?>/></td>
          <td><strong>S/C</strong></td>
          <td align="center"><input name="cedula" type="radio" value="1" <? if($tramite["Tramite_cedula"] == '1') {echo "checked=\"checked\"";} ?>/></td>
          <td><strong>Pend.</strong></td>
          <td align="center"><input name="cedula" type="radio" value="2" <? if($tramite["Tramite_cedula"] == '2') {echo "checked=\"checked\"";} ?>/></td>
          <td><strong>Adj.</strong></td>
        </tr>
      <tr >
        <td width="5%" height="28" bgcolor="#E7EBD8" >&nbsp;</td>
          <td width="30%" bgcolor="#E7EBD8"><span class="Estilo8">Plancheta</span></td>
          <td width="8%" align="center" bgcolor="#E7EBD8"><input name="plancheta" type="radio" value="0" <? if($tramite["Tramite_plancheta"] == '0') {echo "checked=\"checked\"";} ?>/></td>
          <td width="14%" bgcolor="#E7EBD8"><strong>S/C</strong></td>
          <td width="8%" align="center" bgcolor="#E7EBD8"><input name="plancheta" type="radio" value="1" <? if($tramite["Tramite_plancheta"] == '1') {echo "checked=\"checked\"";} ?>/></td>
          <td width="15%" bgcolor="#E7EBD8"><strong>Pend.</strong></td>
          <td width="8%" align="center" bgcolor="#E7EBD8"><input name="plancheta" type="radio" value="2" <? if($tramite["Tramite_plancheta"] == '2') {echo "checked=\"checked\"";} ?>/></td>
          <td width="12%" bgcolor="#E7EBD8"><strong>Adj.</strong></td>
        </tr>
      <tr>
        <td height="28">&nbsp;</td>
          <td><span class="Estilo8">Inf. dominio </span></td>
          <td align="center"><input name="infdominio" type="radio" value="0" <? if($tramite["Tramite_inf_dom"] == '0') {echo "checked=\"checked\"";} ?>/></td>
          <td><strong>S/C</strong></td>
          <td align="center"><input name="infdominio" type="radio" value="1" <? if($tramite["Tramite_inf_dom"] == '1') {echo "checked=\"checked\"";} ?>/></td>
          <td><strong>Pend.</strong></td>
          <td align="center"><input name="infdominio" type="radio" value="2" <? if($tramite["Tramite_inf_dom"] == '2') {echo "checked=\"checked\"";} ?>/></td>
          <td><strong>Adj.</strong></td>
        </tr>
              <tr>
        <td height="30" bgcolor="#E7EBD8">&nbsp;</td>
          <td colspan="7" valign="bottom" bgcolor="#E7EBD8" class="Estilo8">Titular dominial</td>
          </tr>
      <tr>
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
        <td colspan="7" bgcolor="#E7EBD8"><textarea name="Tramite_titdom" cols="45" id="Tramite_titdom"><? echo $tramite["Tramite_titdom"]; ?></textarea></td>
      </tr>
      <tr>
        <td height="13" colspan="8" bgcolor="#E7EBD8"></td>
        </tr>
      <tr>
        <td height="28">&nbsp;</td>
          <td><span class="Estilo8">Pub. Edicto</span></td>
          <td align="center"><input name="edicto" type="radio" value="0" <? if($tramite["Tramite_edicto"] == '0') {echo "checked=\"checked\"";} ?> /></td>
          <td><strong>S/C</strong></td>
          <td align="center"><input name="edicto" type="radio" value="1" <? if($tramite["Tramite_edicto"] == '1') {echo "checked=\"checked\"";} ?>/></td>
          <td><strong>Pend.</strong></td>
          <td align="center"><input name="edicto" type="radio" value="2" <? if($tramite["Tramite_edicto"] == '2') {echo "checked=\"checked\"";} ?>/></td>
          <td><strong>Adj.</strong></td>
        </tr>
      <tr>
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
          <td bgcolor="#E7EBD8"><span class="Estilo8">C&aacute;mara Elec. </span></td>
          <td align="center" bgcolor="#E7EBD8"><input name="camara" type="radio" value="0" <? if($tramite["Tramite_inf_camara"] == '0') {echo "checked=\"checked\"";} ?>/></td>
          <td bgcolor="#E7EBD8"><strong>S/C</strong></td>
          <td align="center" bgcolor="#E7EBD8"><input name="camara" type="radio" value="1"  <? if($tramite["Tramite_inf_camara"] == '1') {echo "checked=\"checked\"";} ?>/></td>
          <td bgcolor="#E7EBD8"><strong>Pend.</strong></td>
          <td align="center" bgcolor="#E7EBD8"><input name="camara" type="radio" value="2"  <? if($tramite["Tramite_inf_camara"] == '2') {echo "checked=\"checked\"";} ?>/></td>
          <td bgcolor="#E7EBD8"><strong>Adj.</strong></td>
        </tr>
      <tr>
        <td height="28">&nbsp;</td>
        <td colspan="3"><strong class="Estilo8">Oficio cámara:</strong></td>
        <td colspan="4" align="left"><input name="Tramite_oficamara" type="text" size="12" value="<? echo $tramite["Tramite_oficamara"]; ?>"/>&nbsp;</td>
        </tr>
      <tr>
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
          <td bgcolor="#E7EBD8"><span class="Estilo8">Carta Doc. </span></td>
          <td align="center" bgcolor="#E7EBD8"><input name="cartadoc" type="radio" value="0"  <? if($tramite["Tramite_cartadoc"] == '0') {echo "checked=\"checked\"";} ?> /></td>
          <td bgcolor="#E7EBD8"><strong>S/C</strong></td>
          <td align="center" bgcolor="#E7EBD8"><input name="cartadoc" type="radio" value="1" <? if($tramite["Tramite_cartadoc"] == '1') {echo "checked=\"checked\"";} ?> /></td>
          <td bgcolor="#E7EBD8"><strong>Pend.</strong></td>
          <td align="center" bgcolor="#E7EBD8"><input name="cartadoc" type="radio" value="2" <? if($tramite["Tramite_cartadoc"] == '2') {echo "checked=\"checked\"";} ?>/></td>
          <td bgcolor="#E7EBD8"><strong>Adj.</strong></td>
        </tr>
		<tr>
        <td height="28">&nbsp;</td>
          <td><span class="Estilo8">Terminado</span></td>
          <td align="center"><input name="terminado" type="radio" value="1" <? if($tramite["Tramite_terminado"] == '1') {echo "checked=\"checked\"";} ?>/></td>
          <td><strong>Si</strong></td>
          <td align="center"><input name="terminado" type="radio" value="0" <? if($tramite["Tramite_terminado"] == '0') {echo "checked=\"checked\"";} ?> /></td>
          <td><strong>No</strong></td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="30">&nbsp;</td>
          <td colspan="3" valign="middle" class="Estilo8">Fecha terminado:</td>
          <td colspan="4" valign="middle" class="Estilo8"><input name="terminado_fecha" type="text" size="8" value="<? echo cambiaf_a_normal($tramite["Tramite_terminado_fecha"]); ?>"/></td>
          </tr>
        <tr>
        <td height="30" bgcolor="#E7EBD8">&nbsp;</td>
          <td colspan="7" valign="bottom" bgcolor="#E7EBD8" class="Estilo8">Observaciones</td>
          </tr>
      <tr>
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
        <td colspan="7" bgcolor="#E7EBD8"><textarea name="observaciones" cols="45" id="observaciones"><? echo $tramite["Tramite_observaciones"]; ?></textarea></td>
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
    <td width="205" valign="top"><input name="fechainicio" type="text" id="fechainicio" style="font-size:16px;" size="7" value="<? echo $tramite["Tramite_inicio_fecha"]; ?>" />
      (dd/mm/aaaa)    </td>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12%" align="center" bgcolor="#FFFF99"><input name="tramitetipo" type="radio" value="1" <? if($tramite["Tramite_tipo"] == '1') {echo "checked=\"checked\"";} ?> /></td>
        <td width="32%" height="34" bgcolor="#FFFF99">Regularizaci&oacute;n</td>
        <td width="9%" align="center" bgcolor="#FFFF99"><input name="tramitetipo" type="radio" value="2" <? if($tramite["Tramite_tipo"] == '2') {echo "checked=\"checked\"";} ?>/></td>
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
    <td><select name="idPartido" id="idPartido">
	<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) {?><option value="<?=$rsPart["Partido_nro"]; ?>" 
	<? if($rsPart["Partido_nro"] == $tramite["Tramite_partido"]) { echo "selected=\"selected\""; } ?>><?=$rsPart["Partido_nombre"]; ?></option><? } ?>
	</select></td>
    <td><input name="nomenclatura" type="text" id="nomenclatura" style="font-size:16px;" size="12" value="<? echo $tramite["Tramite_nomenc"]; ?>"/>
    &nbsp;</td>
    <td colspan="2">&nbsp;</td>
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
    <td colspan="2"><strong>DNI Titular</strong> (sin puntos)</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="apellido" type="text" id="apellido" style="font-size:16px;" size="18" value="<? echo $persona["Persona_apellido"]; ?>"/>
    &nbsp;</td>
    <td><input name="nombre" type="text" id="nombre" style="font-size:16px;" size="14" value="<? echo $persona["Persona_nombre"]; ?>"/></td>
    <td colspan="2"><input name="TitularDNI" type="text" id="TitularDNI" style="font-size:16px;" size="10" value="<? echo $persona["Persona_dni_nro"]; ?>"/>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><strong>Direcci&oacute;n</strong></td>
    <td><strong>Tel&eacute;fono</strong></td>
    <td colspan="2"><strong>Expediente Ref. </strong></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="direccion" type="text" id="direccion" style="font-size:16px;" size="18" value="<? echo $persona["Persona_direccion"]; ?>"/>&nbsp;</td>
    <td><input name="telefono" type="text" id="telefono" style="font-size:16px;" size="10" value="<? echo $persona["Persona_telefono"]; ?>"/>&nbsp;</td>
    <td colspan="2"><input name="numref" type="text" id="numref" style="font-size:16px;" size="10" value="<? echo $tramite["Tramite_numref"]; ?>"/>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="68%"><strong>Escribano</strong></td>
          <td width="7%">&nbsp;</td>
          <td width="16%">&nbsp;</td>
          <td width="9%">&nbsp;</td>
        </tr>
        <tr>
          <td><input name="escribano" type="text" id="escribano" style="font-size:16px;" size="30" value="<? echo $tramite["Tramite_escribano"]; ?>"/></td>
          <td align="center" bgcolor="#DBDBDB"><input name="archivado" type="checkbox" id="archivado" value="1" <? if($tramite["Tramite_archivado"] == '1') {echo "checked=\"checked\"";} ?>/></td>
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
    <td><input type="hidden" name="idTramite" value="<? echo $idTramite; ?>" />
		<input type="hidden" name="idPersona" value="<? echo $persona["Persona_nro"]; ?>" />
		<input type="hidden" nme ="idUsuario" value="<? echo $log_usuario; ?>"  />&nbsp;</td>
    <td colspan="2" align="left" valign="top"><input type="submit" name="Submit" value="Actualizar tr&aacute;mite" /></td>
    <td width="4" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="40">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="center"><?=$log_usuario; ?>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? include("pie.php"); ?>

<? } ?>