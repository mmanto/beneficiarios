
<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$idFicha = $_GET["idFicha"];

/*
$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
*/

?>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>Dar de alta persona (<?=$idFicha; ?>)</h2></td>
  </tr>
  <tr>
    <td height="30"><a href="ficha_informe.php?idFicha=<?=$idFicha; ?>">[Cancelar]</a></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td><form method="post" action="persona_alta2.php">
<table width="100%" border="1" cellspacing="0" cellpadding="4">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="48%">Nombre(s)</td>
        <td width="52%">Apellido(s)</td>
        </tr>
      <tr>
        <td><input name="t1_nombre" type="text" id="t1_nombre" size="20" onkeypress="return pulsar(event)"/>
          &nbsp;</td>
        <td><input name="t1_apellido" type="text" id="t1_apellido" size="22" onkeypress="return pulsar(event)"/>
          &nbsp;</td>
        </tr>
    </table></td>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="36%">N&uacute;mero Doc.</td>
        <td width="64%">Observaciones sobre el Doc. </td>
      </tr>
      <tr>
        <td><input name="t1_doc_nro" type="text" id="t1_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="0" size="8" maxlength="8"/>
          &nbsp;</td>
        <td><input name="t1_doc_obs" type="text" id="t1_doc_obs" size="20" onkeypress="return pulsar(event)"/>
          &nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="226"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Parentesco</td>
      </tr>
      <tr>
        <td><select name="t1_parentesco" id="t1_parentesco">
            <option value="1" selected="selected">Jefe/a</option>
            <option value="2">C&oacute;nyuge/Pareja</option>
            <option value="3">Hijo/a</option>
            <option value="4">Yerno/Nuera</option>
            <option value="5">Nieto/a</option>
            <option value="6">Padre/Madre</option>
            <option value="7">Suegro/a</option>
            <option value="8">Otros familiares</option>
            <option value="9">Otros no familiares</option>
        </select></td>
      </tr>
    </table></td>
    <td width="144"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Edad</td>
      </tr>
      <tr>
        <td><input name="t1_edad" type="text" id="t1_edad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="4" maxlength="8"/>&nbsp;</td>
      </tr>
    </table></td>
    <td width="110"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4">Género</td>
      </tr>
      <tr>
        <td width="16%">V</td>
        <td width="36%"><input name="t1_sexo" type="radio" value="1" checked="checked"/></td>
        <td width="19%">M</td>
        <td width="29%"><input name="t1_sexo" type="radio" value="2"/></td>
      </tr>
    </table></td>
    <td width="240"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Nacionalidad</td>
      </tr>
      <tr>
        <td><select name="t1_nacion" id="t1_nacion">
                <option value="1" selected="selected">Argentina</option>
                <option value="2">Brasil</option>
                <option value="3">Bolivia</option>
                <option value="4">Chile</option>
                <option value="5">Paraguay</option>
                <option value="6">Per&uacute;</option>
                <option value="7">Uruguay</option>
                <option value="8">Otro pa&iacute;s</option>
                <option value="9">Sin indicar</option>
              </select></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4">Asiste a estab. educativo </td>
      </tr>
      <tr>
        <td width="12%">Si</td>
        <td width="27%"><input name="t1_asisteEE" type="radio" value="1"/></td>
        <td width="12%">No</td>
        <td width="49%"><input name="t1_asisteEE" type="radio" value="2"/></td>
      </tr>
    </table></td>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="58%">Nivel educativo </td>
        <td width="42%">&Uacute;ltimo grado</td>
      </tr>
      <tr>
        <td><select name="t1_nivel" id="t1_nivel">
                <option value="1" selected="selected">Inicial</option>
                <option value="2">Primario</option>
                <option value="3">EGB</option>
                <option value="4">Secundario</option>
                <option value="5">Polimodal</option>
                <option value="6">Sup. no univ.</option>
                <option value="7">Univ. o m&aacute;s</option>
                <option value="8">Educ. especial</option>
                <option value="9">Sin escolaridad</option>
                <option value="10">Ignorado</option>
          </select></td>
        <td><input name="t1_grado" type="text" id="t1_grado" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="3" maxlength="8"/></td>
      </tr>
    </table></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Situaci&oacute;n ocupacional </td>
      </tr>
      <tr>
        <td><select name="t1_sit_ocup" id="t1_sit_ocup">
            <option value="0" selected="selected">Sin indicar</option>
			<option value="1">Trab. por cuenta propia</option>
            <option value="2">Changas</option>
            <option value="3">Obrero/empleado (rel. de dep.)</option>
            <option value="4">Serv. dom&eacute;stico</option>
            <option value="5">Trabajo fliar. no remunerado</option>
            <option value="6">Patr&oacute;n</option>
            <option value="7">Empleo rural transitorio</option>
            <option value="8">Cartonero</option>
            <option value="9">Cooperativista</option>
            <option value="10">Desocupado</option>
            <option value="11">Jubilado/pensionado</option>
            <option value="12">Ama de casa</option>
                </select></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17%">Oficio:</td>
        <td width="83%"><select name="t1_oficio" id="t1_oficio">
            <option value="0" selected="selected">Seleccione uno...</option>
            <option value="1">Computaci&oacute;n</option>
            <option value="2">Alba&ntilde;il</option>
            <option value="3">Electricista</option>
            <option value="4">Pintor</option>
            <option value="5">Plomero</option>
            <option value="6">Soldador</option>
            <option value="7">Docente</option>
            <option value="8">Jardiner&iacute;a</option>
            <option value="9">Gastronom&iacute;a</option>
            <option value="10">Artesano</option>
            <option value="11">Carpintero/Herrero</option>
            <option value="12">Peluquer&iacute;a</option>
            <option value="13">Corte y confecci&oacute;n</option>
            <option value="14">Mecan./Metalurg.</option>
            <option value="15">Trabajdador rural</option>
            <option value="16">Enfermero/a</option>
            <option value="99">Otros</option>
            <option value="00">Sin oficio</option>
        </select></td>
      </tr>
    </table></td>
    <td colspan="2" align="right"><input name ="idFicha" type="hidden" value="<?=$idFicha; ?>" /><input type="submit" name="Submit" value="Agregar persona" /></td>
  </tr>
</table></form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<? } ?>
