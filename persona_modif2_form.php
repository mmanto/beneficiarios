
<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$idPersona = $_GET["idPersona"];
$idFicha = $_GET["idFicha"];

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];

$resPer = mysql_query("SELECT * FROM dbo_persona WHERE Persona_nro = $idPersona");
$persona = mysql_fetch_array($resPer);
?>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Modificar datos de la persona </h2></td>
  </tr>
  <tr>
    <td height="30"><a href="ficha_informe.php?idFicha=<?=$idFicha; ?>">[Cancelar]</a></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td><form method="post" action="persona_modif2.php">
<table width="100%" border="1" cellspacing="0" cellpadding="4">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="48%">Nombre(s)</td>
        <td width="52%">Apellido(s)</td>
      </tr>
      <tr>
        <td><input name="t1_nombre" type="text" id="t1_nombre" size="20" value="<?=$persona["Persona_nombre"]; ?>" onkeypress="return pulsar(event)"/>
&nbsp;</td>
        <td><input name="t1_apellido" type="text" id="t1_apellido" size="25" value="<?=$persona["Persona_apellido"]; ?>" onkeypress="return pulsar(event)"/>&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="31%">N&uacute;mero Doc.</td>
        <td width="69%">Observaciones sobre el Doc. </td>
      </tr>
      <tr>
        <td><input name="t1_doc_nro" type="text" id="t1_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="<?=$persona["Persona_dni_nro"]; ?>" size="8" maxlength="8"/>
          &nbsp;</td>
        <td><input name="t1_doc_obs" type="text" id="t1_doc_obs" size="20" value="<?=$persona["Persona_dni_obs"]; ?>" onkeypress="return pulsar(event)"/>
          &nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="217"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Parentesco</td>
      </tr>
      <tr>
        <td><select name="t1_parentesco" id="t1_parentesco">
                <option value="1" <? if ($persona["Persona_parentesco"] == '1') { echo "selected=\"selected\""; } ?>>Jefe/a</option>
                <option value="2" <? if ($persona["Persona_parentesco"] == '2') { echo "selected=\"selected\""; } ?>>C&oacute;nyuge/Pareja</option>
                <option value="3" <? if ($persona["Persona_parentesco"] == '3') { echo "selected=\"selected\""; } ?>>Hijo/a</option>
                <option value="4" <? if ($persona["Persona_parentesco"] == '4') { echo "selected=\"selected\""; } ?>>Yerno/Nuera</option>
                <option value="5" <? if ($persona["Persona_parentesco"] == '5') { echo "selected=\"selected\""; } ?>>Nieto/a</option>
                <option value="6" <? if ($persona["Persona_parentesco"] == '6') { echo "selected=\"selected\""; } ?>>Padre/Madre</option>
                <option value="7" <? if ($persona["Persona_parentesco"] == '7') { echo "selected=\"selected\""; } ?>>Suegro/a</option>
                <option value="8" <? if ($persona["Persona_parentesco"] == '8') { echo "selected=\"selected\""; } ?>>Otros familiares</option>
                <option value="9" <? if ($persona["Persona_parentesco"] == '9') { echo "selected=\"selected\""; } ?>>Otros no familiares</option>
              </select></td>
      </tr>
    </table></td>
    <td width="156"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Edad</td>
      </tr>
      <tr>
        <td><input name="t1_edad" type="text" id="t1_edad" value="<?=$persona["Persona_edad"]; ?>" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="4" maxlength="8"/>&nbsp;</td>
      </tr>
    </table></td>
    <td width="115"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4">Género</td>
      </tr>
      <tr>
        <td width="16%">V</td>
        <td width="36%"><input name="t1_sexo" type="radio" value="1" <? if ($persona["Persona_sexo_int"] == '1') { echo "checked=\"checked\""; } ?>/></td>
        <td width="19%">M</td>
        <td width="29%"><input name="t1_sexo" type="radio" value="2" <? if ($persona["Persona_sexo_int"] == '2') { echo "checked=\"checked\""; } ?>/></td>
      </tr>
    </table></td>
    <td width="270"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Nacionalidad</td>
      </tr>
      <tr>
        <td><select name="t1_nacion" id="t1_nacion">
                <option value="1" <? if ($persona["Persona_nacionalidad_int"] == '1') { echo "selected=\"selected\""; } ?>>Argentina</option>
                <option value="2" <? if ($persona["Persona_nacionalidad_int"] == '2') { echo "selected=\"selected\""; } ?>>Brasil</option>
                <option value="3" <? if ($persona["Persona_nacionalidad_int"] == '3') { echo "selected=\"selected\""; } ?>>Bolivia</option>
                <option value="4" <? if ($persona["Persona_nacionalidad_int"] == '4') { echo "selected=\"selected\""; } ?>>Chile</option>
                <option value="5" <? if ($persona["Persona_nacionalidad_int"] == '5') { echo "selected=\"selected\""; } ?>>Paraguay</option>
                <option value="6" <? if ($persona["Persona_nacionalidad_int"] == '6') { echo "selected=\"selected\""; } ?>>Per&uacute;</option>
                <option value="7" <? if ($persona["Persona_nacionalidad_int"] == '7') { echo "selected=\"selected\""; } ?>>Uruguay</option>
                <option value="8" <? if ($persona["Persona_nacionalidad_int"] == '8') { echo "selected=\"selected\""; } ?>>Otro pa&iacute;s</option>
                <option value="9" <? if ($persona["Persona_nacionalidad_int"] == '9') { echo "selected=\"selected\""; } ?>>Sin indicar</option>
              </select></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4">Asiste a establ. educ. </td>
      </tr>
      <tr>
        <td width="12%">Si</td>
        <td width="24%"><input name="t1_asisteEE" type="radio" value="1" <? if ($persona["Persona_asisteEE"] == '1') { echo "checked=\"checked\""; } ?>/></td>
        <td width="15%">No</td>
        <td width="49%"><input name="t1_asisteEE" type="radio" value="2" <? if ($persona["Persona_asisteEE"] == '2') { echo "checked=\"checked\""; } ?>/></td>
      </tr>
    </table></td>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="58%">Nivel educativo </td>
        <td width="42%">&Uacute;ltimo grado</td>
      </tr>
      <tr>
        <td><select name="t1_nivel" id="t1_nivel">
                <option value="1" <? if ($persona["Persona_educ_nivel"] == '1') { echo "selected=\"selected\""; } ?>>Inicial</option>
                <option value="2" <? if ($persona["Persona_educ_nivel"] == '2') { echo "selected=\"selected\""; } ?>>Primario</option>
                <option value="3" <? if ($persona["Persona_educ_nivel"] == '3') { echo "selected=\"selected\""; } ?>>EGB</option>
                <option value="4" <? if ($persona["Persona_educ_nivel"] == '4') { echo "selected=\"selected\""; } ?>>Secundario</option>
                <option value="5" <? if ($persona["Persona_educ_nivel"] == '5') { echo "selected=\"selected\""; } ?>>Polimodal</option>
                <option value="6" <? if ($persona["Persona_educ_nivel"] == '6') { echo "selected=\"selected\""; } ?>>Sup. no univ.</option>
                <option value="7" <? if ($persona["Persona_educ_nivel"] == '7') { echo "selected=\"selected\""; } ?>>Univ. o m&aacute;s</option>
                <option value="8" <? if ($persona["Persona_educ_nivel"] == '8') { echo "selected=\"selected\""; } ?>>Educ. especial</option>
                <option value="9" <? if ($persona["Persona_educ_nivel"] == '9') { echo "selected=\"selected\""; } ?>>Sin escolaridad</option>
                <option value="10" <? if ($persona["Persona_educ_nivel"] == '10') { echo "selected=\"selected\""; } ?>>Ignorado</option>
          </select></td>
        <td><input name="t1_grado" type="text" id="t1_grado" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="3" maxlength="8" value="<?=$persona["Persona_educ_grado"]; ?>"/></td>
      </tr>
    </table></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Situaci&oacute;n ocupacional </td>
      </tr>
      <tr>
        <td><select name="t1_sit_ocup" id="t1_sit_ocup">
            <option value="0" <? if ($persona["Persona_sit_ocup"] == '0') { echo "selected=\"selected\""; } ?>>Sin indicar</option>
            <option value="1" <? if ($persona["Persona_sit_ocup"] == '1') { echo "selected=\"selected\""; } ?>>Trabajador por cuenta propia</option>
            <option value="2" <? if ($persona["Persona_sit_ocup"] == '2') { echo "selected=\"selected\""; } ?>>Changas</option>
            <option value="3" <? if ($persona["Persona_sit_ocup"] == '3') { echo "selected=\"selected\""; } ?>>Obrero/empleado (rel. de dependencia)</option>
            <option value="4" <? if ($persona["Persona_sit_ocup"] == '4') { echo "selected=\"selected\""; } ?>>Serv. dom&eacute;stico</option>
            <option value="5" <? if ($persona["Persona_sit_ocup"] == '5') { echo "selected=\"selected\""; } ?>>Trabajo fliar. no remunerado</option>
            <option value="6" <? if ($persona["Persona_sit_ocup"] == '6') { echo "selected=\"selected\""; } ?>>Patr&oacute;n</option>
            <option value="7" <? if ($persona["Persona_sit_ocup"] == '7') { echo "selected=\"selected\""; } ?>>Empleo rural transitorio</option>
            <option value="8" <? if ($persona["Persona_sit_ocup"] == '8') { echo "selected=\"selected\""; } ?>>Cartonero</option>
            <option value="9" <? if ($persona["Persona_sit_ocup"] == '9') { echo "selected=\"selected\""; } ?>>Cooperativista</option>
            <option value="10" <? if ($persona["Persona_sit_ocup"] == '10') { echo "selected=\"selected\""; } ?>>Desocupado</option>
            <option value="11" <? if ($persona["Persona_sit_ocup"] == '11') { echo "selected=\"selected\""; } ?>>Jubilado/pensionado</option>
            <option value="12" <? if ($persona["Persona_sit_ocup"] == '12') { echo "selected=\"selected\""; } ?>>Ama de casa</option>
        </select></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17%">Oficio:</td>
        <td width="83%"><select name="t1_oficio" id="t1_oficio">
                <option value="1" <? if ($persona["Persona_oficio"] == '1') { echo "selected=\"selected\""; } ?>>Computaci&oacute;n</option>
                <option value="2" <? if ($persona["Persona_oficio"] == '2') { echo "selected=\"selected\""; } ?>>Alba&ntilde;il</option>
                <option value="3" <? if ($persona["Persona_oficio"] == '3') { echo "selected=\"selected\""; } ?>>Electricista</option>
                <option value="4" <? if ($persona["Persona_oficio"] == '4') { echo "selected=\"selected\""; } ?>>Pintor</option>
                <option value="5" <? if ($persona["Persona_oficio"] == '5') { echo "selected=\"selected\""; } ?>>Plomero</option>
                <option value="6" <? if ($persona["Persona_oficio"] == '6') { echo "selected=\"selected\""; } ?>>Soldador</option>
                <option value="7" <? if ($persona["Persona_oficio"] == '7') { echo "selected=\"selected\""; } ?>>Docente</option>
                <option value="8" <? if ($persona["Persona_oficio"] == '8') { echo "selected=\"selected\""; } ?>>Jardiner&iacute;a</option>
                <option value="9" <? if ($persona["Persona_oficio"] == '9') { echo "selected=\"selected\""; } ?>>Gastronom&iacute;a</option>
                <option value="10" <? if ($persona["Persona_oficio"] == '10') { echo "selected=\"selected\""; } ?>>Artesano</option>
                <option value="11" <? if ($persona["Persona_oficio"] == '11') { echo "selected=\"selected\""; } ?>>Carpintero/Herrero</option>
                <option value="12" <? if ($persona["Persona_oficio"] == '12') { echo "selected=\"selected\""; } ?>>Peluquer&iacute;a</option>
                <option value="13" <? if ($persona["Persona_oficio"] == '13') { echo "selected=\"selected\""; } ?>>Corte y confecci&oacute;n</option>
                <option value="14" <? if ($persona["Persona_oficio"] == '14') { echo "selected=\"selected\""; } ?>>Mecan./Metalurg.</option>
                <option value="15" <? if ($persona["Persona_oficio"] == '15') { echo "selected=\"selected\""; } ?>>Trabajdador rural</option>
                <option value="16" <? if ($persona["Persona_oficio"] == '16') { echo "selected=\"selected\""; } ?>>Enfermero/a</option>
                <option value="99" <? if ($persona["Persona_oficio"] == '99') { echo "selected=\"selected\""; } ?>>Otros</option>
                <option value="00" <? if ($persona["Persona_oficio"] == '00') { echo "selected=\"selected\""; } ?>>Sin oficio declarado</option>
          </select></td>
      </tr>
    </table></td>
    <td colspan="2" align="right"><input name="idPersona" value="<?=$idPersona; ?>" type="hidden"/><input name="idFicha" value="<?=$idFicha; ?>" type="hidden"/><input type="submit" name="Submit" value="Actualizar datos" /></td>
  </tr>
</table></form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<? } ?>
