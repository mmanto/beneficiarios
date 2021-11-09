<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");
require ("funciones.php");
require ('xajax/xajax_core/xajax.inc.php');
$xajax = new xajax(); 
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true);


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
//////////////////////////////////////////////////////////////////


$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

$strSQL2 = "SELECT * FROM dbo_direccion ORDER BY Direccion_nro ASC";
$direc = mysql_query ($strSQL2);

/*$strSQL3 = mysql_query ("SELECT * FROM dbo_direccion where Direccion_nro=".$log_direccion."", $link);
$res_dirprov = mysql_fetch_array($strSQL3);*/

$resol = mysql_query ("SELECT idResolucion, Resolucion_nombre FROM dbo_resolucion ORDER BY idResolucion ASC", $link);


function select_combinado($nro_partido){ 
   	$qryBarrios = "SELECT Barrio_nro, Barrio_nombre
  		FROM dbo_barrio
  		WHERE Partido_nro = $nro_partido";
	$resBarrios = armar_matriz($qryBarrios);
	$totalBarrios = count($resBarrios);
	
	$nuevo_select = '<select name="lote_barrio" id="lote_barrio">';
	$nuevo_select .= '<option value=0>Seleccione Barrio</option>';
	for ($i=0; $i<$totalBarrios; $i++){
	$codigoBarrio = $resBarrios[$i]['Barrio_nro'];
	$barrio = $resBarrios[$i]['Barrio_nombre'];
	$nuevo_select .= '<option value= "'. $codigoBarrio.'">'. $barrio .'</option>';
	}
	$nuevo_select .= '</select>';
	return $nuevo_select;
}

function generar_select($nro_partido){
	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding('ISO-8859-1'); 
	 
	$nuevo_select = select_combinado($nro_partido);
	$respuesta->Assign("seleccombinado","innerHTML",$nuevo_select);
   
	return $respuesta;
}

function controlar_dni_2($tipo, $dni){
	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding('ISO-8859-1'); 
	$sqlp = "SELECT Persona_nro, Persona_dni_nro 
			FROM dbo_Persona 
			WHERE Persona_dni_nro= '$dni'
			AND Documento_tipo_nro =  '$tipo'
			AND Familia_nro IS NOT NULL";
	$respersona = armar_matriz($sqlp);	
	if ($respersona[0]['Persona_nro'] != '') {	
	$mensajeDNI2 = "<span style='color: red;'><b>ATENCION: Esta persona ya posee asignado un beneficio</b></span>";
	}
	$respuesta->Assign("DivDestinoDNI2","innerHTML",$mensajeDNI2);
	return $respuesta;	
}

function controlar_dni_1($tipo, $dni){
	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding('ISO-8859-1'); 
	$sqlp = "SELECT Persona_nro, Persona_dni_nro 
			FROM dbo_Persona 
			WHERE Persona_dni_nro= '$dni'
			AND Documento_tipo_nro =  '$tipo'
			AND Familia_nro IS NOT NULL";
	$respersona = armar_matriz($sqlp);	
	if ($respersona[0]['Persona_nro'] != '') {	
	$mensajeDNI2 = "<span style='color: red;'><b>ATENCION: Esta persona ya posee asignado un beneficio</b></span>";
	}
	$respuesta->Assign("DivDestinoDNI1","innerHTML",$mensajeDNI2);
	return $respuesta;	
}

$xajax->register(XAJAX_FUNCTION, 'generar_select'); 
$xajax->register(XAJAX_FUNCTION, 'controlar_dni_1'); 
$xajax->register(XAJAX_FUNCTION, 'controlar_dni_2'); 
$xajax->processRequest();
include ("cabecera.php");

?>

<html>
<head>
<?php
//En el <head> indicamos al objeto xajax se encargue de generar el javascript necesario
$xajax->printJavascript("xajax/");
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

 function validarBarrio(){
	 if (document.getElementById('lote_barrio').value == 0){ 
		 confirmar=confirm("No se ingreso el Barrio. Desea continuar?"); 
		 if (confirmar) 
		 return true;
		 else 
		 return false;
	 }
	 return true
 }
 </script>
 </head>
 <body>
 <table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo censo </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>
<form action="censo_alta.php" method="post" enctype="multipart/form-data" name="f" id="f">
<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="600" border="0" cellspacing="0" cellpadding="0">
    </table></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="279" height="16" valign="bottom">Programa</td>
        <td width="173" height="16" valign="bottom">Ordenanza Adj. (PFP) </td>
        <td width="148" valign="bottom">Resoluci&oacute;n Adj (RUD). </td>
      </tr>
      <tr>
        <td><input name="Familia_programa" type="text" id="Censo_programa" onKeyPress="return pulsar(event)" size="36"/></td>
        <td><input name="Familia_ordenanza" type="text" id="Familia_ordenanza" onKeyPress="return pulsar(event)" value="-" size="18"/></td>
        <td><input name="Familia_resolucion" type="text" id="Familia_resolucion" onKeyPress="return pulsar(event)" value="-" size="18"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="7"></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL INMUEBLE </strong></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="206" height="18" class="nombrecampo">Partido</td>
        <td width="60" class="nombrecampo">&nbsp;</td>
        <td width="334" class="nombrecampo">Barrio</td>
      </tr>
      <tr>
        <td><select name="idPartido" id="idPartido" onChange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select></td>
        <td>&nbsp;</td>
        <td>
        <div id="seleccombinado">
			<select name="lote_barrio" id="lote_barrio">
			<option value=0>Seleccione Barrio...</option>
			</select>
		</div>
        </td>
<!--        <input name="lote_barrio" type="text" id="lote_barrio" size="29" onkeypress="return pulsar(event)"/>-->
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
        <td><input name="lote_circ" type="text" id="lote_circ" value="-" size="1" onKeyPress="return pulsar(event)"/></td>
        <td><input name="lote_secc" type="text" id="lote_secc" value="-" size="1" onKeyPress="return pulsar(event)"/></td>
        <td><input name="lote_ch" type="text" id="lote_ch" value="-" size="1" onKeyPress="return pulsar(event)"/></td>
        <td><input name="lote_qta" type="text" id="lote_qta" value="-" size="1" onKeyPress="return pulsar(event)"/></td>
        <td><input name="lote_fracc" type="text" id="lote_fracc" value="-" size="1" onKeyPress="return pulsar(event)"/></td>
        <td><input name="lote_manzana" type="text" id="lote_manzana" value="-" size="1" onKeyPress="return pulsar(event)"/></td>
        <td><input name="lote_parcela" type="text" id="lote_parcela" value="-" size="1" onKeyPress="return pulsar(event)"/></td>
        <td><input name="lote_subpc" type="text" id="lote_subpc" value="-" size="1" onKeyPress="return pulsar(event)"/></td>
        <td><input name="lote_partida" type="text" id="lote_partida" value="-" size="6" onKeyPress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td height="10" colspan="10" valign="top">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="10"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <? /*<tr>
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
      </tr> */?>
    </table>
	  <table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td bgcolor="#FFFF66">Atenci&oacute;n: Para los valores de superficie y monto <strong>no utilice</strong> separador de miles. Utilice el signo punto (.) en lugar de coma (,) como separador decimal (ejemplo: 1234.56 en lugar de 1234,56). </td>
        </tr>
      </table>
	  <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" valign="bottom" class="nombrecampo">Superficie lote </td>
            <td height="20" valign="bottom" class="nombrecampo">Valor m&sup2; </td>
            <td width="119" valign="bottom" class="nombrecampo">Valor mensura </td>
            <td width="108" valign="bottom" class="nombrecampo">Cant. cuotas </td>
            <td width="81" valign="bottom" class="nombrecampo">&nbsp;</td>
          </tr>
          <tr>
            <td width="161"><input name="lote_superficie" type="text" id="lote_superficie" size="12" onKeyPress="return pulsar(event)"/>
            &nbsp;m&sup2;</td>
            <td width="131">$ 
              <input name="lote_valor_m2" type="text" id="lote_valor_m2" size="12" onKeyPress="return pulsar(event)"/>
            &nbsp;</td>
            <td>$ 
              <input name="lote_valor_mensura" type="text" id="lote_valor_mensura" size="12" onKeyPress="return pulsar(event)"/>
            &nbsp;</td>
            <td><input name="lote_cant_cuotas" type="text" id="lote_cant_cuotas" size="5" onKeyPress="return pulsar(event)"/>
            &nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table> 
	</td>
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
        <td width="122" valign="bottom" class="nombrecampo">&nbsp;</td>
      </tr>
      <tr>
        <td><input name="t1_apellido" type="text" id="t1_apellido" size="35" onKeyPress="return pulsar(event)"/></td>
        <td><input name="t1_nombre" type="text" id="t1_nombre" size="45" onKeyPress="return pulsar(event)"/></td>
        <td><? /*<input name="t1_fecha_nac_dia" type="text" id="t1_fecha_nac_dia" onkeypress="return pulsar(event)" size="1" maxlength="2"/> 
        <input name="t1_fecha_nac_mes" type="text" id="t1_fecha_nac_mes" onkeypress="return pulsar(event)" size="1" maxlength="2"/> 
        <input name="t1_fecha_nac_anio" type="text" id="t1_fecha_nac_anio" onkeypress="return pulsar(event)" size="2" maxlength="4"/> */?></td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="87" height="16" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="164" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="78" valign="bottom">&nbsp;</td>
            <td width="16" valign="bottom">&nbsp;</td>
            <td width="165" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="90" valign="bottom">&nbsp;</td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" valign="bottom" class="nombrecampo">Tipo Documento </td>
            <td height="20" valign="bottom" class="nombrecampo">N&ordm; de documento </td>
            <td width="113" valign="bottom" class="nombrecampo">CUIL/CUIT </td>
            <td valign="bottom" class="nombrecampo">Ingresos</td>
            <td valign="bottom" class="nombrecampo">Tel&eacute;fono</td>
          </tr>
          <tr>
            <td width="133"><select name="t1_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
            <td width="135">
            <input name="t1_doc_nro" type="text" id="t1_doc_nro"
            onKeyPress="return pulsar(event)" size="13" maxlength="8"
            onkeyup="xajax_controlar_dni_1(document.f.t1_doc_tipo.options[document.f.t1_doc_tipo.selectedIndex].value, document.f.t1_doc_nro.value )"
            /></td>
            <td><input name="t1_cuil" type="text" id="t1_cuil" size="15" onKeyPress="return pulsar(event)"/></td>
            <td width="104">$ 
            <input name="t1_ingresos" type="text" id="t1_ingresos" size="5" onKeyPress="return pulsar(event)"/></td>
            <td width="115"><input name="Familia_telefono" type="text" id="Familia_telefono" size="12" onKeyPress="return pulsar(event)"/></td>
          </tr>
		  <tr>
            <td colspan="5" valign="bottom"><div id = "DivDestinoDNI1"></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
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
        <td width="214" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
        <td width="122" valign="bottom" class="nombrecampo">&nbsp;</td>
      </tr>
      <tr>
        <td><input name="t2_apellido" type="text" id="t2_apellido" size="35" onKeyPress="return pulsar(event)"/></td>
        <td><input name="t2_nombre" type="text" id="t2_nombre" size="45" onKeyPress="return pulsar(event)"/></td>
        <td><? /*<input name="t2_fecha_nac_dia" type="text" id="t2_fecha_nac_dia" onkeypress="return pulsar(event)" size="1" maxlength="2"/> 
        <input name="t2_fecha_nac_mes" type="text" id="t2_fecha_nac_mes" onkeypress="return pulsar(event)" size="1" maxlength="2"/> 
        <input name="t2_fecha_nac_anio" type="text" id="t2_fecha_nac_anio" onkeypress="return pulsar(event)" size="2" maxlength="4"/>*/?> </td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="128" height="20" valign="bottom" class="nombrecampo">Tipo documento </td>
            <td width="141" valign="bottom" class="nombrecampo">N&ordm; de documento </td>
            <td width="146" valign="bottom" class="nombrecampo">CUIL/CUIT </td>
            <td width="185" valign="bottom" class="nombrecampo">Ingresos</td>
          </tr>
          <tr>
            <td><select name="t2_doc_tipo" size="1" id="t2_doc_tipo" >
              <option value="0">Seleccione...</option>
              <option value="1">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
            <td><input name="t2_doc_nro" type="text" id="t2_doc_nro" size="13" 
            onKeyPress="return pulsar(event)"
            onkeyup="xajax_controlar_dni_2(document.f.t2_doc_tipo.options[document.f.t2_doc_tipo.selectedIndex].value, document.f.t2_doc_nro.value )"
            /></td>
            <td><input name="t2_cuil" type="text" id="t2_cuil" size="15" onKeyPress="return pulsar(event)"/></td>
            <td>$
              <input name="t2_ingresos" type="text" id="t2_ingresos" size="20" onKeyPress="return pulsar(event)"/>&nbsp;</td>
          </tr>	 
          <tr>
            <td colspan="5" valign="bottom"><div id = "DivDestinoDNI2"></div></td>
          </tr> 
        </table>        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="25" valign="bottom" class="nombrecampo">Observaciones</td>
          </tr>
          <tr>
            <td><textarea name="familia_observaciones" cols="105" rows="6" id="familia_observaciones"></textarea></td>
          </tr>
        </table></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
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
    <td width="481" align="right">&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar censo" onclick="return validarBarrio()" /></td>
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
<? } ?>