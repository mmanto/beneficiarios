<?php

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$log_direccion = $_GET["nbsp567"];
$log_usuario = $_GET["qprst645"];
$log_nivel = $_GET["ghlst251"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";


$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

$strSQL2 = "SELECT * FROM dbo_direccion ORDER BY Direccion_nro ASC";
$direc = mysql_query ($strSQL2);

$strSQL3 = mysql_query ("SELECT * FROM dbo_direccion where Direccion_nro=".$log_direccion."", $link);
$res_dirprov = mysql_fetch_array($strSQL3);

$resol = mysql_query ("SELECT idResolucion, Resolucion_nombre FROM dbo_resolucion ORDER BY idResolucion ASC", $link);

?>

<!--Script para corroborar si el titular ya existe en la base de datos-->

<script language = "javascript">
function createRequestObject(){
       var peticion;
       var browser = navigator.appName;
             if(browser == "Microsoft Internet Explorer"){
                   peticion = new ActiveXObject("Microsoft.XMLHTTP");
             }else{
                   peticion = new XMLHttpRequest();
 }
 return peticion;
 }  
  
var http = new Array();
 function ObtDatos(url){
       var act = new Date();
       http[act] = createRequestObject();
       http[act].open('get', url);
       http[act].onreadystatechange = function() {
       if (http[act].readyState == 4) {
             if (http[act].status == 200 || http[act].status == 304) {
   var texto
 texto = http[act].responseText
                     var DivDestino = document.getElementById("DivDestino");
                     DivDestino.innerHTML = "<div id='error'>"+texto+"</div>";
                   
 }
 }
 }
 http[act].send(null);
 }
  
 function compUsuario(Tecla) {
      Tecla = (Tecla) ? Tecla: window.event;
      input = (Tecla.target) ? Tecla.target :
      Tecla.srcElement;
      if (Tecla.type == "keyup") {
           var DivDestino = document.getElementById("DivDestino");
           DivDestino.innerHTML = "<div></div>";
           if (input.value) {
                ObtDatos("logdni.php?q=" + input.value);
           }
      }
 }
 </script>
 <table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta informaci&oacute;n de beneficio </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php?<? echo $linkvar; ?>">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>
<form action="enc_alta_dorso.php" method="post" enctype="multipart/form-data" name="f" id="f">
<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="245" class="nombrecampo"><strong>DIRECCION PROVINCIAL </strong></td>
        <td width="274" class="nombrecampo"><strong>DIRECCION</strong></td>
        <td width="81" class="nombrecampo"><strong>FECHA </strong></td>
      </tr>
      <tr>
        <td><input name="dirprov" type="text" id="idDirprov" size="40" value="<? echo $res_dirprov["Direccion_dirprov"]; ?>" onkeypress="return pulsar(event)"/></td>
        <td><input name="direccion" type="text" id="idDirprov" size="45" value="<? echo $res_dirprov["Direccion_nombre_res"]; ?>" onkeypress="return pulsar(event)"/></td>
		<td><input name="encuesta_fecha" type="text" id="encuesta_fecha" value="<?=date("d/m/Y"); ?>" size="8" align="right" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="386" height="16" valign="bottom">PROYECTO</td>
        <td width="78" height="16" valign="bottom">Res. IVBA </td>
        <td width="136" valign="bottom">Res. de Adjudicaci&oacute;n. </td>
      </tr>
      <tr>
        <td><input name="encuesta_proyecto" type="text" id="encuesta_proyecto" size="65" onkeypress="return pulsar(event)"/></td>
        <td><input name="res_ivba" type="text" id="res_ivba" value="-" size="6" onkeypress="return pulsar(event)"/></td>
        <td><select name="Familia_resolucion" id="Familia_resolucion">
		<option value="0">Seleccione una...</option>
	<? while($rsRes = mysql_fetch_array($resol)) echo "<option value =\"{$rsRes["idResolucion"]}\">{$rsRes["Resolucion_nombre"]}\r\n"; ?>
      </select></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="7"></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>IDENTIFICACION DEL INMUEBLE </strong></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="206" height="18" class="nombrecampo">Partido</td>
        <td width="210" class="nombrecampo">Localidad</td>
        <td width="184" class="nombrecampo">Barrio</td>
      </tr>
      <tr>
        <td><select name="idPartido" id="idPartido">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select></td>
        <td><input name="lote_localidad" type="text" id="lote_localidad" size="30" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_barrio" type="text" id="lote_barrio" size="29" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="160" height="22" valign="bottom">&nbsp;</td>
        <td width="48" valign="bottom">Circ.</td>
        <td width="48" valign="bottom">Secc.</td>
        <td width="48" valign="bottom">Ch.</td>
        <td width="48" valign="bottom">Qta.</td>
        <td width="48" valign="bottom">Fracc.</td>
        <td width="48" valign="bottom">Mz.</td>
        <td width="48" valign="bottom">Pc.</td>
        <td width="48" valign="bottom">Subpc.</td>
        <td width="56" valign="bottom">Partida</td>
      </tr>
      <tr>
        <td height="25" valign="top"><strong>Nomenclatura catastral:</strong> </td>
        <td><input name="lote_circ" type="text" id="lote_circ" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_secc" type="text" id="lote_secc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_ch" type="text" id="lote_ch" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_qta" type="text" id="lote_qta" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_fracc" type="text" id="lote_fracc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_manzana" type="text" id="lote_manzana" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_parcela" type="text" id="lote_parcela" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_subpc" type="text" id="lote_subpc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_partida" type="text" id="lote_partida" value="-" size="6" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="185" height="16" valign="bottom" class="nombrecampo">Domicilio</td>
        <td width="63" valign="bottom" class="nombrecampo">Edificio</td>
        <td width="62" valign="bottom" class="nombrecampo">Monob.</td>
        <td width="52" valign="bottom" class="nombrecampo">Sector</td>
        <td width="60" valign="bottom" class="nombrecampo">Escalera</td>
        <td width="48" valign="bottom" class="nombrecampo">Piso</td>
        <td width="47" valign="bottom" class="nombrecampo">Depto.</td>
        <td width="83" valign="bottom" class="nombrecampo">Casa N&ordm;</td>
      </tr>
      <tr>
        <td><input name="Familia_domic" type="text" id="Familia_domic" size="30" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_edificio" type="text" id="Familia_domic_edificio" size="5" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_monoblock" type="text" id="Familia_domic_monoblock" size="5" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_sector" type="text" id="Familia_domic_sector" size="3" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_escalera" type="text" id="Familia_domic_escalera" size="4" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_piso" type="text" id="Familia_domic_piso" size="2" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_depto" type="text" id="Familia_domic_depto" size="2" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_casa_num" type="text" id="Familia_casa_num" size="3" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2" align="right"><span class="nombrecampo">Tel&eacute;fono:&nbsp;</span></td>
        <td height="30"><input name="Familia_telefono" type="text" id="Familia_telefono" size="12" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td height="15" align="center">&nbsp;</td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 1</strong> </td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="214" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
        <td width="122" valign="bottom" class="nombrecampo">Fecha de Nacimiento </td>
      </tr>
      <tr>
        <td><input name="t1_apellido" type="text" id="t1_apellido" size="35" onkeypress="return pulsar(event)"/></td>
        <td><input name="t1_nombre" type="text" id="t1_nombre" size="45" onkeypress="return pulsar(event)"/></td>
        <td><input name="t1_fecha_nac_dia" type="text" id="t1_fecha_nac_dia" onkeypress="return pulsar(event)" size="1" maxlength="2"/> 
        <input name="t1_fecha_nac_mes" type="text" id="t1_fecha_nac_mes" onkeypress="return pulsar(event)" size="1" maxlength="2"/> 
        <input name="t1_fecha_nac_anio" type="text" id="t1_fecha_nac_anio" onkeypress="return pulsar(event)" size="2" maxlength="4"/> </td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="87" height="16" valign="bottom" class="nombrecampo">Edad</td>
            <td width="164" valign="bottom" class="nombrecampo">Lugar de nacimiento</td>
            <td colspan="2" valign="bottom">&nbsp;<span class="nombrecampo">Sexo</span></td>
            <td width="16" valign="bottom">&nbsp;</td>
            <td width="165" valign="bottom" class="nombrecampo">Nacionalidad</td>
            <td width="90" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t1_edad" type="text" id="t1_edad" size="1" onkeypress="return pulsar(event)"/>
              a&ntilde;os </td>
            <td><input name="t1_lugar_nac" type="text" id="t1_lugar_nac" size="22" onkeypress="return pulsar(event)"/></td>
            <td width="39" align="center" bgcolor="#EBEBEB">&nbsp;M
              <input name="t1_sexo" type="radio" value="m" checked="checked" onkeypress="return pulsar(event)"/></td>
            <td width="39" bgcolor="#EBEBEB">F
              <input name="t1_sexo" type="radio" value="f" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
            <td><input name="t1_nacionalidad" type="text" id="t1_nacionalidad" value="Argentina" size="25" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" valign="bottom" class="nombrecampo">Tipo Documento </td>
            <td height="20" valign="bottom" class="nombrecampo">N&ordm; de documento </td>
            <td width="122" valign="bottom" class="nombrecampo">CUIL/CUIT </td>
            <td width="258" valign="bottom" class="nombrecampo">Domicilio que figura en el documento</td>
          </tr>
          <tr>
            <td width="111"><select name="t1_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
                                    </select></td>
            <td width="109"><input name="t1_doc_nro" type="text" id="t1_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/></td>
            <td><input name="t1_cuil" type="text" id="t1_cuil" size="15" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_domicilio" type="text" id="t1_domicilio" size="40" onkeypress="return pulsar(event)"/></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="4" valign="bottom"><div id = "DivDestino"></div></td>
          </tr>
          <tr>
            <td width="146" height="20" valign="bottom" class="nombrecampo">Estado civil </td>
            <td width="180" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="98" class="nombrecampo">N&ordm; Nupcias </td>
            <td width="176" class="nombrecampo">Fecha de sep./div./viudez </td>
          </tr>
          <tr>
            <td><select name="t1_ecivil" size="1" id="t1_ecivil">
                <option value="1">Soltero/a</option>
                <option value="2">Concubino/a</option>
                <option value="3">Casado/a</option>
                <option value="4">Divorciado/a</option>
				<option value="5">Sep. de hecho</option>
				<option value="6">Unión de hecho</option>
				<option value="7">Emancipado</option>
				<option value="8">Viudo/a</option>
				<option value="9">Otro</option>
				<option value="10" selected="selected">Sin Indicar</option>
              </select>            </td>
            <td>&nbsp;<?  /*<select name="t1_eotros" size="1" id="t1_eotros">
                <option value="0" selected="selected">Seleccione uno...</option>
                <option value="1">Separado de hecho</option>
                <option value="2">Uni&oacute;n de hecho</option>
                <option value="3">Emancipado</option>
            </select>*/ ?></td>
            <td><input name="t1_nupcias" type="text" id="t1_nupcias" size="12" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_fechasep" type="text" id="t1_fechasep" size="25" onkeypress="return pulsar(event)"/></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="22" valign="bottom" class="nombrecampo">Apellidos del c&oacute;nyuge </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s del c&oacute;nyuge </td>
            <td width="122" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t1_conyuge_apellido" type="text" id="t1_conyuge_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_conyuge_nombre" type="text" id="t1_conyuge_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="18" valign="bottom" class="nombrecampo">Apellidos del padre </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s del padre </td>
            <td width="122" valign="bottom" class="nombrecampo">Vive? </td>
          </tr>
          <tr>
            <td><input name="t1_padre_apellido" type="text" id="t1_padre_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_padre_nombre" type="text" id="t1_padre_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_padre_vive" type="text" id="t1_padre_vive" size="3" onkeypress="return pulsar(event)"/></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="62" height="30">Tipo doc.: </td>
          <td width="45">DNI
            <input name="t1_padre_doctipo" type="radio" value="1" checked="checked" onkeypress="return pulsar(event)" /></td>
          <td width="51"> LE
            <input name="t1_padre_doctipo" type="radio" value="2" onkeypress="return pulsar(event)" /></td>
          <td width="51">LC
            <input name="t1_padre_doctipo" type="radio" value="3" onkeypress="return pulsar(event)" /></td>
          <td width="51">CI
            <input name="t1_padre_doctipo" type="radio" value="4" onkeypress="return pulsar(event)" /></td>
          <td width="51">CF.
            <input name="t1_padre_doctipo" type="radio" value="5" onkeypress="return pulsar(event)" /></td>
          <td width="51">Ext.
            <input name="t1_padre_doctipo" type="radio" value="6" onkeypress="return pulsar(event)" /></td>
          <td width="65">N&uacute;mero: </td>
          <td width="125"><input name="t1_padre_doc" type="text" id="t1_padre_doc" size="15" onkeypress="return pulsar(event)" style="font-weight:bold;"/></td>
          <td width="48">&nbsp;</td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="18" valign="bottom" class="nombrecampo">Apellidos de la madre </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s de la madre </td>
            <td width="122" valign="bottom" class="nombrecampo">Vive?</td>
          </tr>
          <tr>
            <td><input name="t1_madre_apellido" type="text" id="t1_madre_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_madre_nombre" type="text" id="t1_madre_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_madre_vive" type="text" id="t1_madre_vive" size="3" onkeypress="return pulsar(event)"/></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="62" height="30" class="nombrecampo">Tipo doc.: </td>
          <td width="45">DNI
            <input name="t1_madre_doctipo" type="radio" value="1" checked="checked" onkeypress="return pulsar(event)" /></td>
          <td width="51"> LE
            <input name="t1_madre_doctipo" type="radio" value="2" onkeypress="return pulsar(event)" /></td>
          <td width="51">LC
            <input name="t1_madre_doctipo" type="radio" value="3" onkeypress="return pulsar(event)" /></td>
          <td width="51">CI
            <input name="t1_madre_doctipo" type="radio" value="4" onkeypress="return pulsar(event)" /></td>
          <td width="51">CF.
            <input name="t1_madre_doctipo" type="radio" value="5" onkeypress="return pulsar(event)" /></td>
          <td width="51">Ext.
            <input name="t1_madre_doctipo" type="radio" value="6" onkeypress="return pulsar(event)" /></td>
          <td width="65" class="nombrecampo">N&uacute;mero: </td>
          <td width="125"><input name="t1_madre_doc" type="text" id="t1_madre_doc" size="15" onkeypress="return pulsar(event)" style="font-weight:bold;"/></td>
          <td width="48">&nbsp;</td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="18" colspan="2" valign="bottom" class="nombrecampo">Renuncia a ser adjudicatario?</td>
            <td width="30" valign="bottom">&nbsp;</td>
            <td valign="bottom" class="nombrecampo">Situaci&oacute;n laboral</td>
            <td colspan="2" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td width="51">Si
              <input name="t1_renuncia" type="radio" value="1" onkeypress="return pulsar(event)"/></td>
            <td width="122">No
              <input name="t1_renuncia" type="radio" value="0" checked="checked" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
            <td valign="bottom"><select name="t1_sitlaboral" size="1" id="t1_sitlaboral">
                <option value="Empleado" selected="selected">Empleado</option>
                <option value="Jornal">Jornal</option>
                <option value="Ama de casa">Ama de casa</option>
                <option value="Cuenta propia">Cuenta propia</option>
                <option value="Jubil/Pens.">Jubil/Pens.</option>
                <option value="Desocupado">Desocupado</option>
                <option value="Plan Social">Plan Social</option>
                <option value="Otro">Otro</option>
            </select></td>
            <td width="212">&nbsp;</td>
            <td width="47">&nbsp;</td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="204" height="26" valign="bottom" class="nombrecampo">Lugar de trabajo </td>
            <td width="212" valign="bottom" class="nombrecampo">Conocimiento de oficio/Actividad </td>
            <td width="184" valign="bottom" class="nombrecampo">&nbsp;Ingresos</td>
          </tr>
          <tr>
            <td><input name="t1_lugar_trabajo" type="text" id="t1_lugar_trabajo" size="30" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_oficio" type="text" id="t1_oficio" size="30" onkeypress="return pulsar(event)"/></td>
            <td>$
              <input name="t1_ingresos" type="text" id="t1_ingresos" size="20" onkeypress="return pulsar(event)"/></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="135" height="30" class="nombrecampo">V&iacute;nculo con el titular 2: </td>
            <td width="265"><input name="t1_vinculo_t2" type="text" id="t1_vinculo_t2" size="30" onkeypress="return pulsar(event)"/></td>
            <td width="200">&nbsp;</td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="212" height="35" class="nombrecampo">A&ntilde;o desde el cual reside en el lugar: </td>
            <td width="75"><input name="t1_resid" type="text" id="t1_resid" size="7" onkeypress="return pulsar(event)"/></td>
            <td width="172" class="nombrecampo">Lugar de residencia anterior:</td>
            <td width="141"><input name="t1_resid_anterior" type="text" id="t1_resid_anterior" size="20" onkeypress="return pulsar(event)"/></td>
          </tr>
      </table></td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 2 </strong> </td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="214" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
        <td width="122" valign="bottom" class="nombrecampo">Fecha de Nacimiento </td>
      </tr>
      <tr>
        <td><input name="t2_apellido" type="text" id="t2_apellido" size="35" onkeypress="return pulsar(event)"/></td>
        <td><input name="t2_nombre" type="text" id="t2_nombre" size="45" onkeypress="return pulsar(event)"/></td>
        <td><input name="t2_fecha_nac_dia" type="text" id="t2_fecha_nac_dia" onkeypress="return pulsar(event)" size="1" maxlength="2"/> 
        <input name="t2_fecha_nac_mes" type="text" id="t2_fecha_nac_mes" onkeypress="return pulsar(event)" size="1" maxlength="2"/> 
        <input name="t2_fecha_nac_anio" type="text" id="t2_fecha_nac_anio" onkeypress="return pulsar(event)" size="2" maxlength="4"/> </td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="87" height="16" valign="bottom" class="nombrecampo">Edad</td>
            <td width="164" valign="bottom" class="nombrecampo">Lugar de nacimiento</td>
            <td colspan="2" valign="bottom">&nbsp;<span class="nombrecampo">Sexo</span></td>
            <td width="16" valign="bottom">&nbsp;</td>
            <td width="165" valign="bottom" class="nombrecampo">Nacionalidad</td>
            <td width="90" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t2_edad" type="text" id="t2_edad" size="1" onkeypress="return pulsar(event)"/>
              a&ntilde;os </td>
            <td><input name="t2_lugar_nac" type="text" id="t2_lugar_nac" size="22" onkeypress="return pulsar(event)"/></td>
            <td width="39" align="center" bgcolor="#EBEBEB">&nbsp;M
              <input name="t2_sexo" type="radio" value="m" checked="checked" onkeypress="return pulsar(event)"/></td>
            <td width="39" bgcolor="#EBEBEB">F
              <input name="t2_sexo" type="radio" value="f" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
            <td><input name="t2_nacionalidad" type="text" id="t2_nacionalidad" value="Argentina" size="25" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="105" height="20" valign="bottom" class="nombrecampo">Tipo documento </td>
            <td width="105" valign="bottom" class="nombrecampo">N&ordm; de documento </td>
            <td width="132" valign="bottom" class="nombrecampo">CUIL/CUIT </td>
            <td width="258" valign="bottom" class="nombrecampo">Domicilio que figura en el Doc.</td>
          </tr>
          <tr>
            <td><select name="t2_doc_tipo" size="1" id="t2_doc_tipo">
              <option value="0">Seleccione...</option>
              <option value="1">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
            <td><input name="t2_doc_nro" type="text" id="t2_doc_nro" size="13" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_cuil" type="text" id="t2_cuil" size="15" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_domicilio" type="text" id="t2_domicilio" size="40" onkeypress="return pulsar(event)"/></td>
          </tr>	  
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="146" height="20" valign="bottom" class="nombrecampo">Estado civil </td>
            <td width="180" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="98" class="nombrecampo">N&ordm; Nupcias </td>
            <td width="176" class="nombrecampo">Fecha de sep./div./viudez </td>
          </tr>
          <tr>
            <td><select name="t2_ecivil" size="1" id="t2_ecivil">
                <option value="1">Soltero/a</option>
                <option value="2">Concubino/a</option>
                <option value="3">Casado/a</option>
                <option value="4">Divorciado/a</option>
				<option value="5">Sep. de hecho</option>
				<option value="6">Unión de hecho</option>
				<option value="7">Emancipado/a</option>
				<option value="8">Viudo/a</option>
				<option value="9">Otro</option>
				<option value="10" selected="selected">Sin Indicar</option>
              </select>
            </td>
            <td><? /*<select name="t2_eotros" size="1" id="select2">
                <option value="0" selected="selected">Seleccione uno...</option>
                <option value="1">Separado de hecho</option>
                <option value="2">Uni&oacute;n de hecho</option>
                <option value="3">Emancipado</option>
           */ ?> </select></td>
            <td><input name="t2_nupcias" type="text" id="t2_nupcias" size="12" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_fechasep" type="text" id="t2_fechasep" size="25" onkeypress="return pulsar(event)"/></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="22" valign="bottom" class="nombrecampo">Apellidos del c&oacute;nyuge </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s del c&oacute;nyuge </td>
            <td width="122" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t2_conyuge_apellido" type="text" id="t2_conyuge_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_conyuge_nombre" type="text" id="t2_conyuge_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="18" valign="bottom" class="nombrecampo">Apellidos del padre </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s del padre </td>
            <td width="122" valign="bottom" class="nombrecampo">Vive? </td>
          </tr>
          <tr>
            <td><input name="t2_padre_apellido" type="text" id="t2_padre_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_padre_nombre" type="text" id="t2_padre_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_padre_vive" type="text" id="t2_padre_vive" size="3" onkeypress="return pulsar(event)"/></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="62" height="30">Tipo doc.: </td>
          <td width="45">DNI
            <input name="t2_padre_doctipo" type="radio" value="1" checked="checked" onkeypress="return pulsar(event)" /></td>
          <td width="51">LE
            <input name="t2_padre_doctipo" type="radio" value="2" onkeypress="return pulsar(event)" /></td>
          <td width="51">LC
            <input name="t2_padre_doctipo" type="radio" value="3" onkeypress="return pulsar(event)" /></td>
          <td width="51">CI
            <input name="t2_padre_doctipo" type="radio" value="4" onkeypress="return pulsar(event)" /></td>
          <td width="51">CF
            <input name="t2_padre_doctipo" type="radio" value="5" onkeypress="return pulsar(event)" /></td>
          <td width="51">Ext.
            <input name="t2_padre_doctipo" type="radio" value="6" onkeypress="return pulsar(event)" /></td>
          <td width="65">N&uacute;mero: </td>
          <td width="125"><input name="t2_padre_doc" type="text" id="t2_padre_doc" size="15" onkeypress="return pulsar(event)" style="font-weight:bold;"/></td>
          <td width="48">&nbsp;</td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="18" valign="bottom" class="nombrecampo">Apellidos de la madre </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s de la madre </td>
            <td width="122" valign="bottom" class="nombrecampo">Vive?</td>
          </tr>
          <tr>
            <td><input name="t2_madre_apellido" type="text" id="t2_madre_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_madre_nombre" type="text" id="t2_madre_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_madre_vive" type="text" id="t2_madre_vive" size="3" onkeypress="return pulsar(event)"/></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="62" height="30">Tipo doc.: </td>
          <td width="45">DNI
            <input name="t2_madre_doctipo" type="radio" value="1" checked="checked" onkeypress="return pulsar(event)" /></td>
          <td width="51"> LE
            <input name="t2_madre_doctipo" type="radio" value="2" onkeypress="return pulsar(event)" /></td>
          <td width="51">LC
            <input name="t2_madre_doctipo" type="radio" value="3" onkeypress="return pulsar(event)" /></td>
          <td width="51">CI
            <input name="t2_madre_doctipo" type="radio" value="4" onkeypress="return pulsar(event)" /></td>
          <td width="51">CF.
            <input name="t2_madre_doctipo" type="radio" value="5" onkeypress="return pulsar(event)" /></td>
          <td width="51">Ext.
            <input name="t2_madre_doctipo" type="radio" value="6" onkeypress="return pulsar(event)" /></td>
          <td width="65">N&uacute;mero: </td>
          <td width="125"><input name="t2_madre_doc" type="text" id="t2_madre_doc" size="15" onkeypress="return pulsar(event)" style="font-weight:bold;"/></td>
          <td width="48">&nbsp;</td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="18" colspan="2" valign="bottom" class="nombrecampo">Renuncia a ser adjudicatario?</td>
            <td width="30" valign="bottom">&nbsp;</td>
            <td valign="bottom" class="nombrecampo">Situaci&oacute;n laboral</td>
            <td colspan="2" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td width="51">Si
              <input name="t2_renuncia" type="radio" value="1" onkeypress="return pulsar(event)"/></td>
            <td width="122">No
              <input name="t2_renuncia" type="radio" value="0" checked="checked" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
            <td valign="bottom"><select name="t2_sitlaboral" size="1" id="t2_sitlaboral">
                <option value="Empleado" selected="selected">Empleado</option>
                <option value="Jornal">Jornal</option>
                <option value="Ama de casa">Ama de casa</option>
                <option value="Cuenta propia">Cuenta propia</option>
                <option value="Jubil/Pens.">Jubil/Pens.</option>
                <option value="Desocupado">Desocupado</option>
                <option value="Plan Social">Plan Social</option>
                <option value="Otro">Otro</option>
            </select></td>
            <td width="212">&nbsp;</td>
            <td width="47">&nbsp;</td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="204" height="26" valign="bottom" class="nombrecampo">Lugar de trabajo </td>
            <td width="212" valign="bottom" class="nombrecampo">Conocimiento de oficio/Actividad </td>
            <td width="184" valign="bottom" class="nombrecampo">&nbsp;Ingresos</td>
          </tr>
          <tr>
            <td><input name="t2_lugar_trabajo" type="text" id="t2_lugar_trabajo" size="30" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_oficio" type="text" id="t2_oficio" size="30" onkeypress="return pulsar(event)"/></td>
            <td>$
              <input name="t2_ingresos" type="text" id="t2_ingresos" size="20" onkeypress="return pulsar(event)"/></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="135" height="30">V&iacute;nculo con el titular 1: </td>
            <td width="265"><input name="t2_parentesco" type="text" id="t2_parentesco" size="30" onkeypress="return pulsar(event)"/></td>
            <td width="200">&nbsp;</td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="212" height="35" class="nombrecampo">A&ntilde;o desde el cual reside en el lugar: </td>
            <td width="75"><input name="t2_resid" type="text" id="t2_resid" size="7" onkeypress="return pulsar(event)"/></td>
            <td width="175" class="nombrecampo">Lugar de residencia anterior:</td>
            <td width="138"><input name="t2_resid_anterior" type="text" id="t2_resid_anterior" size="20" onkeypress="return pulsar(event)"/></td>
          </tr>
          <tr>
            <td height  ="5" colspan="4" bgcolor="#EBEBEB"></td>
          </tr>
      </table></td>
  </tr>
</table>
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="99"></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="481" align="right"><input name="cmdReset" type="reset" id="cmdReset" value="Borrar formulario" /></td>
    <td width="10">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Siguiente &gt;&gt;" /></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
