<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$idDireccion = $user["Direccion_nro"];
$idNivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

$sqlDir = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dir = mysql_fetch_array($sqlDir);
$dirNombre = $dir["Direccion_nombre"];

$sqlDirProv = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dirprov = mysql_fetch_array($sqlDirProv);
$dirProvNombre = $dir["Direccion_dirprov"];

//////////////////////////////////////////////////////////////////

$idBarrio = $_GET["idBarrio"];

$sqlb = "SELECT * FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) WHERE Barrio_nro = $idBarrio";
$bar = mysql_query($sqlb);
$barrio = mysql_fetch_array($bar);
$barrio_nombre = $barrio["Barrio_nombre"];
$partido_nombre = $barrio["Partido_nombre"];

$sql567 = mysql_query("SELECT * FROM dbo_exptes WHERE Expte_esc = '1' ORDER BY Expte_nro DESC",$link);


$resPlanViv = mysql_query("SELECT * FROM dbo_planvivienda ORDER BY Planvivienda_nro",$link);

?>

<style type="text/css">
<!--
.Estilo2 {font-size: 18px}
-->
</style>
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo beneficio</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="barrios_listar_partido.php?idPartido=<? echo $barrio["Partido_nro"]; ?>">Volver al listado </a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="beneficio_alta_porbarrio_multiple.php" method="post" name="f" id="f">
<input type="hidden" name="idBarrio" value="<? echo $idBarrio; ?>" onkeypress="return pulsar(event)"/>
<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="48%"><table width="250" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="29%" height="28" class="Estilo2">Partido:</td>
            <td width="4%" bgcolor="#FFFF99" class="Estilo2">&nbsp;</td>
            <td class="Estilo2" width="67%" bgcolor="#FFFF99"><? echo $partido_nombre; ?></td>
          </tr>
        </table></td>
        <td width="52%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="21%" height="28" class="Estilo2">Barrio:</td>
            <td width="4%" bgcolor="#FFFF99" class="Estilo2">&nbsp;</td>
            <td class="Estilo2" width="75%" bgcolor="#FFFF99"><? echo $barrio_nombre; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="24">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="16%">Fecha carga </td>
          <td width="3%">&nbsp;</td>
          <td width="81%" colspan="3" rowspan="2" bgcolor="#E4E4E4"><table width="100%" border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td colspan="3" valign="bottom"><strong>Direcci&oacute;n de origen del beneficio </strong></td>
        </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><input name="beneficio_origen" type="radio" value="1" <? if ($idDireccion != '2') { echo "checked=\"checked\""; } ?> /></td>
              <td width="87%" valign="bottom">Dir. Reg.Urb. y Dominial </td>
            </tr>
          </table></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><input name="beneficio_origen" type="radio" value="2" <? if ($idDireccion == '2') { echo "checked=\"checked\""; } ?>/></td>
              <td width="87%" valign="middle">Plan Familia Propietaria  </td>
            </tr>
          </table></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><input name="beneficio_origen" type="radio" value="3" /></td>
              <td width="87%" valign="middle">Ley 24374  </td>
            </tr>
          </table></td>
      </tr>
    </table></td>
          </tr>
        <tr>
          <td><input name="censo_fecha" type="text" id="censo_fecha" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="<?=date("d/m/Y"); ?>" size="10"/></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td colspan="5" height="8px"></td>
          </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td height="26" colspan="9" align="center" valign="bottom" bgcolor="#FFE1C4"><strong><u>NOMENCLATURA CATASTRAL</u></strong></td>
        </tr>
      <tr>
        <td colspan="9" align="center" valign="middle" bgcolor="#FFE1C4"><strong>Atenci&oacute;n:</strong>  Reemplazar en cada campo el valor 0 (cero) por el correspondiente. En caso de no contener la nomenclatura algunos de los datos indicados, conservar el valor por defecto 0 (cero). </td>
        </tr>
      <tr>
        <td width="25" valign="bottom" bgcolor="#FFE1C4">&nbsp;</td>
        <td width="65" valign="bottom" bgcolor="#FFE1C4"><strong>Circ.</strong></td>
        <td width="68" valign="bottom" bgcolor="#FFE1C4"><strong>Secc.</strong></td>
        <td width="65" valign="bottom" bgcolor="#FFE1C4"><strong>Ch.</strong></td>
        <td width="59" valign="bottom" bgcolor="#FFE1C4"><strong>Qta.</strong></td>
        <td width="65" valign="bottom" bgcolor="#FFE1C4"><strong>Fracc.</strong></td>
        <td width="73" valign="bottom" bgcolor="#FFE1C4"><strong>Mz.</strong></td>
        <td width="62" valign="bottom" bgcolor="#FFE1C4"><strong>Pc.</strong></td>
        <td width="64" valign="bottom" bgcolor="#FFE1C4"><strong>Subpc.</strong></td>
        </tr>
      <tr>
        <td height="25" valign="top" bgcolor="#FFE1C4">&nbsp;</td>
        <td bgcolor="#FFE1C4"><input name="lote_circ" type="text" id="lote_circ"  size="3" onkeypress="return pulsar(event)" value="<?=$barrio["Barrio_circunscripcion"]; ?>"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_secc" type="text" id="lote_secc"  size="3" onkeypress="return pulsar(event)" value="<?=$barrio["Barrio_seccion"]; ?>"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_ch" type="text" id="lote_ch"  size="3" onkeypress="return pulsar(event)" value="<?=$barrio["Barrio_chacra"]; ?>"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_qta" type="text" id="lote_qta"  size="3" onkeypress="return pulsar(event)" value="<?=$barrio["Barrio_quinta"]; ?>"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_fracc" type="text" id="lote_fracc" size="3" onkeypress="return pulsar(event)" value="<?=$barrio["Barrio_fraccion"]; ?>"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_manzana" type="text" id="lote_manzana" value="0" size="3" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_parcela" type="text" id="lote_parcela" value="0" size="3" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_subpc" type="text" id="lote_subpc" value="0" size="3" onkeypress="return pulsar(event)"/></td>
        </tr>
      <tr>
        <td height="6" colspan="9" valign="top"></td>
        </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="nombrecampo">Domicilio</td>
            <td width="24%" class="nombrecampo">&nbsp;</td>
            <td width="23%" class="nombrecampo">Matr&iacute;cula   N&ordm; </td>
          </tr>
          <tr>
            <td><input name="domicilio" type="text" id="domicilio" onkeypress="return pulsar(event)" size="40"/></td>
            <td>&nbsp;</td>
            <td><input name="matricula" type="text" id="matricula" onkeypress="return pulsar(event)" value="0" size="15"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" style="nombrecampo""><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="21%">Res./Decreto Adj.N&ordm;: </td>
                              <td width="13%"><input name="resolucion" type="text" id="resolucion" onkeypress="return pulsar(event)" size="9"/></td>
                              <td width="3%">&nbsp;</td>
                              <td width="22%">Monto adjudicaci&oacute;n: $ </td>
                              <td width="13%"><input name="familia_montoadj" type="text" value="0" size="8" /></td>
                              <td width="13%">Cant. cuotas: </td>
                              <td width="15%"><input name="familia_montoadj_cuotas" type="text" id="familia_montoadj_cuotas" size="3" /></td>
                            </tr>
                            <tr>
                              <td height="56" colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="34" colspan="5" align="left" valign="bottom">&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td valign="bottom">Plan de vivienda </td>
                                </tr>
                                <tr>
                                  <td width="12%" height="30" align="center" bgcolor="#CEE1F4">Plano No : </td>
                                  <td width="14%" bgcolor="#CEE1F4"><input name="plano_numero" type="text" id="plano_numero" value="<?=$barrio["Barrio_plano"]; ?>" size="7" /></td>
                                  <td width="13%" align="right" bgcolor="#CEE1F4">Aprobado el:</td>
                                  <td width="2%" bgcolor="#CEE1F4">&nbsp;</td>
                                  <td width="18%" bgcolor="#CEE1F4"><input name="plano_aprobado_fecha" type="text" id="plano_aprobado_fecha" value="<? echo cambiaf_a_normal($barrio["Barrio_plano_aprob_fecha"]); ?>" size="8" /></td>
                                  <td width="3%" align="center">&nbsp;</td>
                                  <td width="38%"><select name="planvivienda" id="planvivienda">
                                    <option value="0">Sin plan de vivienda</option>
                                    <?	  while ($planvivienda = mysql_fetch_array($resPlanViv)) {	

$planvivienda_nro = $planvivienda["Planvivienda_nro"];
$planvivienda_nombre = $planvivienda["Planvivienda_nombre"];
?>
                                    <option value="<? echo $planvivienda_nro; ?>">
                                      <?=$planvivienda_nombre; ?>
                                    </option>
                                    <? } ?>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td height="22" align="center" bgcolor="#CEE1F4">&nbsp;</td>
                                  <td align="center" bgcolor="#CEE1F4">&nbsp;</td>
                                  <td colspan="3" align="center" valign="top" bgcolor="#CEE1F4">(Formato <strong>dd/mm/aaaa</strong>)</td>
                                  <td align="center">&nbsp;</td>
                                  <td align="center">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td colspan="7" align="center">&nbsp;</td>
                                </tr>
                              </table></td>
                            </tr>
                          </table></td>
          </tr>
        </table></td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 1</strong> </td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
	  <tr>
        <td height="12" colspan="4" valign="bottom" class="nombrecampo"></td>
        </tr>
        <td width="123" valign="bottom" class="nombrecampo">Tipo Doc. </td>
		<td width="117" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
		<td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
      </tr>
      <tr>
	  <td><select name="t1_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1" selected="selected">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t1_doc_nro" type="text" id="t1_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>&nbsp;</td>
        <td><input name="t1_apellido" type="text" id="t1_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t1_nombre" type="text" id="t1_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="122" height="16" valign="bottom" class="nombrecampo">Lugar de nacimiento </td>
            <td width="87" valign="bottom" class="nombrecampo">Fecha nacim. </td>
            <td width="101" valign="bottom">Nacionalidad</td>
            <td width="145" valign="bottom">Estado Civil </td>
            <td width="26" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td height="16" valign="bottom" class="nombrecampo"><input name="t1_lugar_nac" type="text" id="t1_lugar_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="15"/></td>
            <td valign="bottom" class="nombrecampo"><input name="t1_fecha_nac" type="text" id="t1_fecha_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="dd/mm/aaaa" size="10"/></td>
            <td valign="bottom"><input name="t1_nacionalidad" type="text" id="t1_nacionalidad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="12"/></td>
            <td valign="bottom"><select name="t1_ecivil" size="1" id="t1_ecivil">
                <option value="10" selected="selected">Sin Indicar</option>
				<option value="1">Soltero/a</option>
                <option value="2">Concubino/a</option>
                <option value="3">Casado/a</option>
                <option value="4">Divorciado/a</option>
				<option value="6">Uni�n de hecho</option>
				<option value="7">Emancipado</option>
				<option value="8">Viudo/a</option>
				<option value="9">Otro</option>
              </select></td>
            <td valign="bottom">&nbsp;</td>
            <td width="40" align="center" valign="middle" bgcolor="#FAE8CF"><input name="t1_sep_hecho" type="checkbox" id="t1_sep_hecho" value="1" /></td>
            <td width="79" height="26" valign="middle" bgcolor="#FAE8CF">Sep. Hecho</td>
          </tr>
          <tr>
            <td height="10" colspan="5"></td>
          </tr>
        </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="215" height="22" valign="bottom" class="nombrecampo">Apellidos del c&oacute;nyuge </td>
            <td width="224" valign="bottom" class="nombrecampo">Nombre/s completo/s del c&oacute;nyuge </td>
            <td width="13" valign="bottom" bgcolor="#FFF0B7">&nbsp;</td>
            <td width="148" valign="bottom" bgcolor="#FFF0B7">Tel&eacute;fono del titular</td>
          </tr>
          <tr>
            <td><input name="t1_conyuge_apellido" type="text" id="t1_conyuge_apellido" size="30" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_conyuge_nombre" type="text" id="t1_conyuge_nombre" size="30" onkeypress="return pulsar(event)"/></td>
            <td bgcolor="#FFF0B7">&nbsp;</td>
            <td bgcolor="#FFF0B7"><input name="t1_telefono" type="text" id="t1_telefono" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="17"/></td>
          </tr>
          <tr>
            <td height="10"></td>
            <td height="8px"></td>
            <td height="8px" colspan="2" bgcolor="#FFF0B7"></td>
          </tr>
          <tr>
            <td height="8px"><span class="nombrecampo">Nombre y apellido del padre</span></td>
            <td height="8px"><span class="nombrecampo">Nombre y apellido de la madre</span></td>
            <td height="8px" colspan="2"></td>
          </tr>
          <tr>
            <td height="8px"><input name="t1_padre_nmbcompleto" type="text" id="t1_padre_nmbcompleto" size="30" onkeypress="return pulsar(event)"/></td>
            <td height="8px"><input name="t1_madre_nmbcompleto" type="text" id="t1_madre_nmbcompleto" size="30" onkeypress="return pulsar(event)"/></td>
            <td height="8px" colspan="2"></td>
          </tr>
          <tr>
            <td colspan="4" height="12"></td>
          </tr>
        </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="600" height="8px">
            <table width="600" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="10" colspan="7" align="center" bgcolor="#E4DCDF"></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26" colspan="2" align="right" bgcolor="#E4DCDF"><input name="t1_baja_persona" type="checkbox" id="t1_baja_persona" value="1" /> </td>
                <td width="158" bgcolor="#E4DCDF">Dar de baja adjudicaci&oacute;n </td>
                <td width="35" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="22" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="130" bgcolor="#E4DCDF"> Resoluci&oacute;n de baja: </td>
                <td width="152" bgcolor="#E4DCDF"><input name="t1_baja_resolucion" type="text" id="t1_baja_resolucion" size="6" /></td>
                <td width="41">&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="22" align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">Resoluci&oacute;n alta orig.: </td>
                <td align="left" bgcolor="#E4DCDF"><input name="t1_baja_res_alta" type="text" id="t1_baja_res_alta" size="6" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="40" height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td colspan="6" align="left" bgcolor="#E4DCDF">Observaciones sobre la baja </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td height="26" colspan="6" align="left" bgcolor="#E4DCDF"><textarea name="t1_persona_baja_obs" cols="75" id="t1_persona_baja_obs"></textarea></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="24" colspan="7" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 2 </strong> </td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="12" colspan="4" valign="bottom" class="nombrecampo"></td>
        </tr>
      <tr>
        <td width="123" valign="bottom" class="nombrecampo">Tipo Doc. </td>
		<td width="117" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
		<td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
      </tr>
      <tr>
	  <td><select name="t2_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1" selected="selected">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t2_doc_nro" type="text" id="t2_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>
        &nbsp;</td>
        <td><input name="t2_apellido" type="text" id="t2_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t2_nombre" type="text" id="t2_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="114" height="16" valign="bottom" class="nombrecampo">Lugar de nacimiento </td>
            <td width="80" valign="bottom" class="nombrecampo">Fecha nacim. </td>
            <td width="99" valign="bottom">Nacionalidad</td>
            <td width="149" valign="bottom">Estado Civil </td>
          </tr>
          <tr>
            <td height="16" valign="bottom" class="nombrecampo"><input name="t2_lugar_nac" type="text" id="t2_lugar_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="15"/></td>
            <td valign="bottom" class="nombrecampo"><input name="t2_fecha_nac" type="text" id="t2_fecha_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="dd/mm/aaaa" size="10"/></td>
            <td valign="bottom"><input name="t2_nacionalidad" type="text" id="t2_nacionalidad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="12"/></td>
            <td valign="bottom"><select name="t2_ecivil" size="1" id="t2_ecivil">
				<option value="10" selected="selected">Sin Indicar</option>
                <option value="1">Soltero/a</option>
                <option value="2">Concubino/a</option>
                <option value="3">Casado/a</option>
                <option value="4">Divorciado/a</option>
				<option value="6">Uni�n de hecho</option>
				<option value="7">Emancipado</option>
				<option value="8">Viudo/a</option>
				<option value="9">Otro</option>
              </select></td>
              <td width="31" valign="bottom">&nbsp;</td>
            <td width="40" align="center" valign="middle" bgcolor="#FAE8CF"><input name="t2_sep_hecho" type="checkbox" id="t1_sep_hecho" value="1" /></td>
            <td width="87" height="26" valign="middle" bgcolor="#FAE8CF">Sep. Hecho</td>
          </tr>
          <tr>
            <td height="10" colspan="4"></td>
          </tr>
        </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="215" height="22" valign="bottom" class="nombrecampo">Apellidos del c&oacute;nyuge </td>
            <td width="224" valign="bottom" class="nombrecampo">Nombre/s completo/s del c&oacute;nyuge </td>
            <td width="13" valign="bottom" bgcolor="#FFF0B7">&nbsp;</td>
            <td width="148" valign="bottom" bgcolor="#FFF0B7">Tel&eacute;fono del titular</td>
          </tr>
          <tr>
            <td><input name="t2_conyuge_apellido" type="text" id="t2_conyuge_apellido" size="30" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_conyuge_nombre" type="text" id="t2_conyuge_nombre" size="30" onkeypress="return pulsar(event)"/></td>
            <td bgcolor="#FFF0B7">&nbsp;</td>
            <td bgcolor="#FFF0B7"><input name="t2_telefono" type="text" id="t2_telefono" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="17"/></td>
          </tr>
          <tr>
            <td height="10"></td>
            <td height="8px"></td>
            <td height="8px" colspan="2" bgcolor="#FFF0B7"></td>
          </tr>
          <tr>
            <td height="8px"><span class="nombrecampo">Nombre y apellido del padre</span></td>
            <td height="8px"><span class="nombrecampo">Nombre y apellido de la madre</span></td>
            <td height="8px" colspan="2"></td>
          </tr>
          <tr>
            <td height="8px"><input name="t2_padre_nmbcompleto" type="text" id="t2_padre_nmbcompleto" size="30" onkeypress="return pulsar(event)"/></td>
            <td height="8px"><input name="t2_madre_nmbcompleto" type="text" id="t2_madre_nmbcompleto" size="30" onkeypress="return pulsar(event)"/></td>
            <td height="8px" colspan="2"></td>
          </tr>
          <tr>
            <td colspan="4" height="12"></td>
          </tr>
        </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="600" height="8px"><table width="600" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="10" colspan="7" align="center" bgcolor="#E4DCDF"></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26" colspan="2" align="right" bgcolor="#E4DCDF"><input name="t2_baja_persona" type="checkbox" id="t2_baja_persona" value="1" /> </td>
                <td width="158" bgcolor="#E4DCDF">Dar de baja adjudicaci&oacute;n </td>
                <td width="35" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="22" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="130" bgcolor="#E4DCDF"> Resoluci&oacute;n de baja: </td>
                <td width="152" bgcolor="#E4DCDF"><input name="t2_baja_resolucion" type="text" id="t2_baja_resolucion" size="6" /></td>
                <td width="41">&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="22" align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">Resoluci&oacute;n alta orig.: </td>
                <td align="left" bgcolor="#E4DCDF"><input name="t2_baja_res_alta" type="text" id="t2_baja_res_alta" size="6" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="40" height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td colspan="6" align="left" bgcolor="#E4DCDF">Observaciones sobre la baja </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td height="26" colspan="6" align="left" bgcolor="#E4DCDF"><textarea name="t2_persona_baja_obs" cols="75" id="t2_persona_baja_obs"></textarea></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="24" colspan="7" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
        </table>
      </td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 3 </strong> </td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="12" colspan="4" valign="bottom" class="nombrecampo"></td>
        </tr>
      <tr>
        <td width="123" valign="bottom" class="nombrecampo">Tipo Doc. </td>
		<td width="117" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
		<td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
      </tr>
      <tr>
	  <td><select name="t3_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1" selected="selected">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t3_doc_nro" type="text" id="t3_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>
        &nbsp;</td>
        <td><input name="t3_apellido" type="text" id="t3_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t3_nombre" type="text" id="t3_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="114" height="16" valign="bottom" class="nombrecampo">Lugar de nacimiento </td>
            <td width="80" valign="bottom" class="nombrecampo">Fecha nacim. </td>
            <td width="99" valign="bottom">Nacionalidad</td>
            <td width="149" valign="bottom">Estado Civil </td>
          </tr>
          <tr>
            <td height="16" valign="bottom" class="nombrecampo"><input name="t3_lugar_nac" type="text" id="t3_lugar_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="15"/></td>
            <td valign="bottom" class="nombrecampo"><input name="t3_fecha_nac" type="text" id="t3_fecha_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="dd/mm/aaaa" size="10"/></td>
            <td valign="bottom"><input name="t3_nacionalidad" type="text" id="t3_nacionalidad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="12"/></td>
            <td valign="bottom"><select name="t3_ecivil" size="1" id="t3_ecivil">
				<option value="10" selected="selected">Sin Indicar</option>
                <option value="1">Soltero/a</option>
                <option value="2">Concubino/a</option>
                <option value="3">Casado/a</option>
                <option value="4">Divorciado/a</option>
				<option value="6">Uni�n de hecho</option>
				<option value="7">Emancipado</option>
				<option value="8">Viudo/a</option>
				<option value="9">Otro</option>
            </select></td>
              <td width="31" valign="bottom">&nbsp;</td>
            <td width="40" align="center" valign="middle" bgcolor="#FAE8CF"><input name="t3_sep_hecho" type="checkbox" id="t1_sep_hecho" value="1" /></td>
            <td width="87" height="26" valign="middle" bgcolor="#FAE8CF">Sep. Hecho</td>
          </tr>
          <tr>
            <td height="10" colspan="4"></td>
          </tr>
        </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="215" height="22" valign="bottom" class="nombrecampo">Apellidos del c&oacute;nyuge </td>
            <td width="224" valign="bottom" class="nombrecampo">Nombre/s completo/s del c&oacute;nyuge </td>
            <td width="13" valign="bottom" bgcolor="#FFF0B7">&nbsp;</td>
            <td width="148" valign="bottom" bgcolor="#FFF0B7">Tel&eacute;fono del titular</td>
          </tr>
          <tr>
            <td><input name="t3_conyuge_apellido" type="text" id="t3_conyuge_apellido" size="30" onkeypress="return pulsar(event)"/></td>
            <td><input name="t3_conyuge_nombre" type="text" id="t3_conyuge_nombre" size="30" onkeypress="return pulsar(event)"/></td>
            <td bgcolor="#FFF0B7">&nbsp;</td>
            <td bgcolor="#FFF0B7"><input name="t3_telefono" type="text" id="t3_telefono" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="17"/></td>
          </tr>
          <tr>
            <td height="10"></td>
            <td height="8px"></td>
            <td height="8px" colspan="2" bgcolor="#FFF0B7"></td>
          </tr>
          <tr>
            <td height="8px"><span class="nombrecampo">Nombre y apellido del padre</span></td>
            <td height="8px"><span class="nombrecampo">Nombre y apellido de la madre</span></td>
            <td height="8px" colspan="2"></td>
          </tr>
          <tr>
            <td height="8px"><input name="t3_padre_nmbcompleto" type="text" id="t3_padre_nmbcompleto" size="30" onkeypress="return pulsar(event)"/></td>
            <td height="8px"><input name="t3_madre_nmbcompleto" type="text" id="t3_madre_nmbcompleto" size="30" onkeypress="return pulsar(event)"/></td>
            <td height="8px" colspan="2"></td>
          </tr>
          <tr>
            <td colspan="4" height="12"></td>
          </tr>
        </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="600" height="8px"><table width="600" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="10" colspan="7" align="center" bgcolor="#E4DCDF"></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26" colspan="2" align="right" bgcolor="#E4DCDF"><input name="t3_baja_persona" type="checkbox" id="t3_baja_persona" value="1" /> </td>
                <td width="158" bgcolor="#E4DCDF">Dar de baja adjudicaci&oacute;n </td>
                <td width="35" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="22" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="130" bgcolor="#E4DCDF"> Resoluci&oacute;n de baja: </td>
                <td width="152" bgcolor="#E4DCDF"><input name="t3_baja_resolucion" type="text" id="t3_baja_resolucion" size="6" /></td>
                <td width="41">&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="22" align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">Resoluci&oacute;n alta orig.: </td>
                <td align="left" bgcolor="#E4DCDF"><input name="t3_baja_res_alta" type="text" id="t3_baja_res_alta" size="6" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="40" height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td colspan="6" align="left" bgcolor="#E4DCDF">Observaciones sobre la baja </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td height="26" colspan="6" align="left" bgcolor="#E4DCDF"><textarea name="t3_persona_baja_obs" cols="75" id="t3_persona_baja_obs"></textarea></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="24" colspan="7" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
        </table>
      </td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 4 </strong> </td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="12" colspan="4" valign="bottom" class="nombrecampo"></td>
        </tr>
      <tr>
        <td width="123" valign="bottom" class="nombrecampo">Tipo Doc. </td>
		<td width="117" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
		<td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
      </tr>
      <tr>
	  <td><select name="t4_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1" selected="selected">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t4_doc_nro" type="text" id="t4_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>
        &nbsp;</td>
        <td><input name="t4_apellido" type="text" id="t4_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t4_nombre" type="text" id="t4_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="114" height="16" valign="bottom" class="nombrecampo">Lugar de nacimiento </td>
            <td width="80" valign="bottom" class="nombrecampo">Fecha nacim. </td>
            <td width="99" valign="bottom">Nacionalidad</td>
            <td width="149" valign="bottom">Estado Civil </td>
          </tr>
          <tr>
            <td height="16" valign="bottom" class="nombrecampo"><input name="t4_lugar_nac" type="text" id="t4_lugar_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="15"/></td>
            <td valign="bottom" class="nombrecampo"><input name="t4_fecha_nac" type="text" id="t4_fecha_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="dd/mm/aaaa" size="10"/></td>
            <td valign="bottom"><input name="t4_nacionalidad" type="text" id="t4_nacionalidad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="12"/></td>
            <td valign="bottom"><select name="t4_ecivil" size="1" id="t4_ecivil">
				<option value="10" selected="selected">Sin Indicar</option>
                <option value="1">Soltero/a</option>
                <option value="2">Concubino/a</option>
                <option value="3">Casado/a</option>
                <option value="4">Divorciado/a</option>
				<option value="6">Uni�n de hecho</option>
				<option value="7">Emancipado</option>
				<option value="8">Viudo/a</option>
				<option value="9">Otro</option>
            </select></td>
              <td width="31" valign="bottom">&nbsp;</td>
            <td width="40" align="center" valign="middle" bgcolor="#FAE8CF"><input name="t4_sep_hecho" type="checkbox" id="t1_sep_hecho" value="1" /></td>
            <td width="87" height="26" valign="middle" bgcolor="#FAE8CF">Sep. Hecho</td>
          </tr>
          <tr>
            <td height="10" colspan="4"></td>
          </tr>
        </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="215" height="22" valign="bottom" class="nombrecampo">Apellidos del c&oacute;nyuge </td>
            <td width="224" valign="bottom" class="nombrecampo">Nombre/s completo/s del c&oacute;nyuge </td>
            <td width="13" valign="bottom" bgcolor="#FFF0B7">&nbsp;</td>
            <td width="148" valign="bottom" bgcolor="#FFF0B7">Tel&eacute;fono del titular</td>
          </tr>
          <tr>
            <td><input name="t4_conyuge_apellido" type="text" id="t4_conyuge_apellido" size="30" onkeypress="return pulsar(event)"/></td>
            <td><input name="t4_conyuge_nombre" type="text" id="t4_conyuge_nombre" size="30" onkeypress="return pulsar(event)"/></td>
            <td bgcolor="#FFF0B7">&nbsp;</td>
            <td bgcolor="#FFF0B7"><input name="t4_telefono" type="text" id="t4_telefono" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="17"/></td>
          </tr>
          <tr>
            <td height="10"></td>
            <td height="8px"></td>
            <td height="8px" colspan="2" bgcolor="#FFF0B7"></td>
          </tr>
          <tr>
            <td height="8px"><span class="nombrecampo">Nombre y apellido del padre</span></td>
            <td height="8px"><span class="nombrecampo">Nombre y apellido de la madre</span></td>
            <td height="8px" colspan="2"></td>
          </tr>
          <tr>
            <td height="8px"><input name="t4_padre_nmbcompleto" type="text" id="t4_padre_nmbcompleto" size="30" onkeypress="return pulsar(event)"/></td>
            <td height="8px"><input name="t4_madre_nmbcompleto" type="text" id="t4_madre_nmbcompleto" size="30" onkeypress="return pulsar(event)"/></td>
            <td height="8px" colspan="2"></td>
          </tr>
          <tr>
            <td colspan="4" height="12"></td>
          </tr>
        </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="600" height="8px"><table width="600" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="10" colspan="7" align="center" bgcolor="#E4DCDF"></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26" colspan="2" align="right" bgcolor="#E4DCDF"><input name="t4_baja_persona" type="checkbox" id="t4_baja_persona" value="1" /> </td>
                <td width="158" bgcolor="#E4DCDF">Dar de baja adjudicaci&oacute;n </td>
                <td width="35" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="22" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="130" bgcolor="#E4DCDF"> Resoluci&oacute;n de baja: </td>
                <td width="152" bgcolor="#E4DCDF"><input name="t4_baja_resolucion" type="text" id="t4_baja_resolucion" size="6" /></td>
                <td width="41">&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td width="22" align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">&nbsp;</td>
                <td align="left" bgcolor="#E4DCDF">Resoluci&oacute;n alta orig.: </td>
                <td align="left" bgcolor="#E4DCDF"><input name="t4_baja_res_alta" type="text" id="t4_baja_res_alta" size="6" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="40" height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td colspan="6" align="left" bgcolor="#E4DCDF">Observaciones sobre la baja </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td height="26" colspan="6" align="left" bgcolor="#E4DCDF"><textarea name="t4_persona_baja_obs" cols="75" id="t4_persona_baja_obs"></textarea></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="24" colspan="7" align="center" bgcolor="#E4DCDF">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
        </table>
      </td>
  </tr>
</table>
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="269"></td>
  </tr>
  <tr>
    <td width="222" align="left">&nbsp;</td>
    <td width="186" colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="28" align="left"><table width="190" border="0" cellpadding="3" cellspacing="0" bgcolor="#DBDBDB">
      <tr>
        <td width="11%" align="center"><input name="doc_completa" type="checkbox" id="doc_completa" value="1" /></td>
        <td width="89%">Documentaci&oacute;n completa </td>
      </tr>
    </table></td>
    <td colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#BFD5FF">
      <tr>
        <td width="7%" align="center"><input name="blnBoleto" type="checkbox" id="blnBoleto" value="1" /></td>
        <td width="38%">Boleto Compra Venta </td>
        <td width="21%">Fecha  Boleto: </td>
        <td width="34%"><input name="boleto_fecha" type="text" id="boleto_fecha" size="12" /></td>
      </tr>
      
    </table></td>
    </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="nombrecampo"><table width="190" border="0" cellpadding="3" cellspacing="0" bgcolor="#CBCFFE">
      <tr>
        <td width="11%" align="center"><input name="procrear" type="checkbox" id="procrear" value="1" /></td>
        <td width="89%">Plan PROCREAR </td>
      </tr>
    </table></td>
    <td align="left" class="nombrecampo"><table width="155" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFF66">
      <tr>
        <td width="11%" align="center"><input name="pagocancelado" type="checkbox" id="pagocancelado" value="1" /></td>
        <td width="89%">Pagos cancelados</td>
      </tr>
    </table></td>
    <td align="left" class="nombrecampo"><table width="210" border="0" cellpadding="3" cellspacing="0" bgcolor="#D9E294">
      <tr>
        <td width="11%" align="center"><input name="condescrit" type="checkbox" id="condescrit" value="1" /></td>
        <td width="89%">En condiciones de escriturar </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="33%" height="28">&nbsp;</td>
                                  <td width="5%" align="center" bgcolor="#D0DCFB"><input name="adjudicacion_pendiente" type="checkbox" id="adjudicacion_pendiente" value="1"/></td>
                                  <td width="26%" align="center" bgcolor="#D0DCFB">Adjudicaci&oacute;n pendiente </td>
                                  <td width="7%">&nbsp;</td>
                                  <td width="5%" align="center" bgcolor="#F7D2CA"><input name="familia_ocupacion_verificar" type="checkbox" id="familia_ocupacion_verificar" value="1"/></td>
                                  <td width="24%" align="center" bgcolor="#F7D2CA">Verificar ocupaci&oacute;n</td>
                                </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="nombrecampo">Expediente escrituraci&oacute;n n&uacute;mero: </td>
<td align="left" class="nombrecampo">
<select name="expte_esc_nro" id="expte_esc_nro">
<option value="0">Sin expediente asignado</option>
<?	  while ($expte = mysql_fetch_array($sql567)) {	

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_barrio = $expte["Barrio_nombre"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];

?>
<option value="<? echo $expte_nro; ?>" ><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?></option>
<? } ?>
</select></td>
    <td align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo"><strong>Observaciones</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="left"><textarea name="observaciones" cols="110" rows="4" id="observaciones">Sin observaciones</textarea></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar beneficio" />&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>