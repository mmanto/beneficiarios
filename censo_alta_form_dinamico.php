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

//Avisa si la persona existe y ya tiene asignada una familia
function controlar_dni_1($tipo, $dni, $id){
	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding('ISO-8859-1'); 
	$sqlp = "SELECT Persona_nro, Persona_dni_nro 
			FROM dbo_Persona 
			WHERE Persona_dni_nro= '$dni'
			AND Documento_tipo_nro =  '$tipo'
			AND Familia_nro IS NOT NULL";
	$respersona = armar_matriz($sqlp);	
	if ($respersona[0]['Persona_nro'] != '' && $dni != '') {	
	$mensajeDNI2 = "<span style='color: red;'><b>ATENCION: Esta persona ya posee asignado un beneficio</b></span>";
	}
	$div = "DivDestinoDNI".$id;
	$respuesta->Assign($div,"innerHTML",$mensajeDNI2);
	return $respuesta;	
}

$xajax->register(XAJAX_FUNCTION, 'generar_select'); 
$xajax->register(XAJAX_FUNCTION, 'controlar_dni_1'); 
$xajax->processRequest();
include ("cabecera.php");

?>

<html>
<head>
<?php
//En el <head> indicamos al objeto xajax se encargue de generar el javascript necesario
$xajax->printJavascript("xajax/");
?>
<script language = "javascript">
var id = 0;
//TODO: el barrio es requerido los otros datos del formulario son requeridos
//function validarBarrio(){
//	 if (document.getElementById('lote_barrio').value == 0){ 
//		 confirmar=confirm("No se ingreso el Barrio. Desea continuar?"); 
//		 if (confirmar) 
//		 return true;
//		 else 
//		 return false;
//	 }
//	 return true
//}


function validaciones(){
	return validarDatosTitulares();
}

function validarDatosTitulares(){
	alert("id " + id);
	for(i = 0; i < id; i++){
		var apellido = document.getElementById("t1_apellido"+i).value;
		var nombre = document.getElementById("t1_nombre"+i).value;
		var tipoDNI = document.getElementById("selectTipoDoc" +i).value;
		var DNI = document.getElementById("t1_doc_nro"+i).value;
		if (apellido != '' && (nombre == '' || tipoDNI == '0' || DNI == '')){
			alert("Es obligatorio ingresar nombre, tipo de documento y  número de documento para cada uno de los titulares.");
			return false;			
		}
	}
	return true;
}



 
function agregarTitular(){
	
	var tabla = document.getElementById("titulares");
	var tr = document.createElement("tr");
	var td = document.createElement("td");

	var tablaTitular = armarTablaTitular(); 

	var encabezadoTablaTitular = armarEncabezadoTitular();
	var encabezadoNomApe = armarEncabezadoNomApe();
	var InputNomApe = armarInputNomApe();
	var salto = saltoDeLinea();
	var encabezadoDatos = armarEncabezadoDatos();
	var inputDatos = crearImputDatos();
	var divDestinoDni = crearDivDestinoDni();
	var salto2 = saltoDeLinea();
	
	tablaTitular.appendChild(encabezadoTablaTitular);
	tablaTitular.appendChild(encabezadoNomApe);
	tablaTitular.appendChild(InputNomApe);
	tablaTitular.appendChild(salto);
	tablaTitular.appendChild(encabezadoDatos);
	tablaTitular.appendChild(inputDatos);
	tablaTitular.appendChild(divDestinoDni);
	tablaTitular.appendChild(salto2);
	
	td.appendChild(tablaTitular);
	tr.appendChild(td);
	tabla.appendChild(tr);

	id++;

	document.getElementById("cantTitulares").value = id;

}

function armarTablaTitular(){
	tablaTitular = document.createElement("table");
	tablaTitular.setAttribute("id", "tr" + String(id));
	tablaTitular.setAttribute("width", "600");
	tablaTitular.setAttribute("border", "0");
	tablaTitular.setAttribute("cellspacing", "0");
	tablaTitular.setAttribute("cellpadding", "0");
	return tablaTitular;
}

function armarEncabezadoTitular(){
	var trDatosDelTitular = document.createElement("tr");
	var tdDatosDelTitular = document.createElement("td");
	tdDatosDelTitular.setAttribute("colspan", "5");
	tdDatosDelTitular.setAttribute("height", "25");
	tdDatosDelTitular.setAttribute("align", "center");
	tdDatosDelTitular.setAttribute("bgcolor", "#E4E4E4");
	var strongDatosDelTitular = document.createElement("strong");
	var textoTitular = document.createTextNode(" DATOS DEL TITULAR " + String(id+1));
	strongDatosDelTitular.appendChild(textoTitular);
	tdDatosDelTitular.appendChild(strongDatosDelTitular);
	trDatosDelTitular.appendChild(tdDatosDelTitular);
	return trDatosDelTitular;	
}

function armarEncabezadoNomApe(){
	var trEncabezadoNomApe = document.createElement("tr");

	var tdEncabezadoApe = document.createElement("td");
	tdEncabezadoApe.setAttribute("colspan", "2");
	tdEncabezadoApe.setAttribute("width", "214");
	tdEncabezadoApe.setAttribute("height", "18");
	tdEncabezadoApe.setAttribute("valign", "bottom");
	tdEncabezadoApe.setAttribute("class", "nombrecampo");
	var textoApellido = document.createTextNode("Apellidos");
	tdEncabezadoApe.appendChild(textoApellido);
	
	var tdEncabezadoNom = document.createElement("td");
	tdEncabezadoNom.setAttribute("colspan", "3");
	tdEncabezadoNom.setAttribute("width", "264");
	tdEncabezadoNom.setAttribute("valign", "bottom");
	tdEncabezadoNom.setAttribute("class", "nombrecampo");
	var textoNombre = document.createTextNode("Nombre/s completo/s");
	tdEncabezadoNom.appendChild(textoNombre);

	trEncabezadoNomApe.appendChild(tdEncabezadoApe);
	trEncabezadoNomApe.appendChild(tdEncabezadoNom);

	return trEncabezadoNomApe;
}

function armarInputNomApe(){
	var trInputNomApe = document.createElement("tr");

	var tdInputApe = document.createElement("td");
	tdInputApe.setAttribute("colspan", "2");
	var inputApe = document.createElement("input");
	inputApe.setAttribute("name", "t1_apellido" + String(id));
	inputApe.setAttribute("id", "t1_apellido" + String(id));
	inputApe.setAttribute("type", "text");
	inputApe.setAttribute("size", "35");
	inputApe.setAttribute("onKeyPress", "return pulsar(event)");
	tdInputApe.appendChild(inputApe);
	
	var tdInputNom = document.createElement("td");
	tdInputNom.setAttribute("colspan", "3");
	var inputNom = document.createElement("input");
	inputNom.setAttribute("name", "t1_nombre" + String(id));
	inputNom.setAttribute("id", "t1_nombre" + String(id));
	inputNom.setAttribute("type", "text");
	inputNom.setAttribute("size", "45");
	inputNom.setAttribute("onKeyPress", "return pulsar(event)");
	tdInputNom.appendChild(inputNom);

	trInputNomApe.appendChild(tdInputApe);
	trInputNomApe.appendChild(tdInputNom);

	return trInputNomApe;
	
}

function saltoDeLinea(){
	var trSaltoDeLinea = document.createElement("tr");
	var tdSaltoDeLinea = document.createElement("td");
	tdSaltoDeLinea.setAttribute("colspan", "5");
	var inputHiden = document.createElement("input");
	inputHiden.setAttribute("style", "border-width:0");
	inputHiden.setAttribute("readonly");
	tdSaltoDeLinea.appendChild(inputHiden);
	trSaltoDeLinea.appendChild(tdSaltoDeLinea);
	return tdSaltoDeLinea;
}


function armarEncabezadoDatos(){
	var trEncabezadoDatos = document.createElement("tr");

	var tdTipo = document.createElement("td");
	tdTipo.setAttribute("height", "20");
	tdTipo.setAttribute("valign", "bottom");
	tdTipo.setAttribute("class", "nombrecampo");
	var textoTipo = document.createTextNode("Tipo Documento");
	tdTipo.appendChild(textoTipo);

	var tdNro = document.createElement("td");
	tdNro.setAttribute("height", "20");
	tdNro.setAttribute("valign", "bottom");
	tdNro.setAttribute("class", "nombrecampo");
	var textoNro = document.createTextNode("Nº de documento");
	tdNro.appendChild(textoNro);

	var tdCuil = document.createElement("td");
	tdCuil.setAttribute("width", "113");
	tdCuil.setAttribute("valign", "bottom");
	tdCuil.setAttribute("class", "nombrecampo");
	var textoCuil = document.createTextNode("CUIL/CUIT");
	tdCuil.appendChild(textoCuil);

	var tdIngresos = document.createElement("td");
	tdIngresos.setAttribute("valign", "bottom");
	tdIngresos.setAttribute("class", "nombrecampo");
	var textoIngresos = document.createTextNode("Ingresos");
	tdIngresos.appendChild(textoIngresos);

	var tdTelefono = document.createElement("td");
	tdTelefono.setAttribute("valign", "bottom");
	tdTelefono.setAttribute("class", "nombrecampo");
	var textoTelefono = document.createTextNode("Telefono");
	tdTelefono.appendChild(textoTelefono);
	
	trEncabezadoDatos.appendChild(tdTipo);
	trEncabezadoDatos.appendChild(tdNro);
	trEncabezadoDatos.appendChild(tdCuil);
	trEncabezadoDatos.appendChild(tdIngresos);
	trEncabezadoDatos.appendChild(tdTelefono);

	return trEncabezadoDatos;
}

function crearImputDatos(){
	var trInputDatos = document.createElement("tr");

	var tdSelect = document.createElement("td");
	tdSelect.setAttribute("width", "133");
	var select = document.createElement("select");
	select.setAttribute("name", "selectTipoDoc" + String(id));
	select.setAttribute("id", "selectTipoDoc" + String(id));
	select.setAttribute("size", "1");
	
	var option0 = document.createElement("option");
	option0.setAttribute("value", "0");
	var textoSeleccione = document.createTextNode("Seleccione...");
	option0.appendChild(textoSeleccione);
	select.appendChild(option0);
	
	var option1 = document.createElement("option");
	option1.setAttribute("value", "1");
	var textoDNI = document.createTextNode("DNI");
	option1.appendChild(textoDNI);
	select.appendChild(option1);
	
	var option2 = document.createElement("option");
	option2.setAttribute("value", "2");
	var textoLE = document.createTextNode("LE");
	option2.appendChild(textoLE);
	select.appendChild(option2);
	
	var option3 = document.createElement("option");
	option3.setAttribute("value", "3");
	var textoLC = document.createTextNode("LC");
	option3.appendChild(textoLC);
	select.appendChild(option3);
	
	var option4 = document.createElement("option");
	option4.setAttribute("value", "4");
	var textoCI = document.createTextNode("CI");
	option4.appendChild(textoCI);
	select.appendChild(option4);
	
	var option5 = document.createElement("option");
	option5.setAttribute("value", "5");
	var textoCF = document.createTextNode("CF");
	option5.appendChild(textoCF);
	select.appendChild(option5);
	
	var option6 = document.createElement("option");
	option6.setAttribute("value", "6");
	var textoExt = document.createTextNode("Ext.");
	option6.appendChild(textoExt);
	select.appendChild(option6);
	
	tdSelect.appendChild(select);	
	
	var tdInputDoc = document.createElement("td");
	tdInputDoc.setAttribute("width", "135");
	var inputDoc = document.createElement("input");
	inputDoc.setAttribute("name", "t1_doc_nro" + String(id));
	inputDoc.setAttribute("id", "t1_doc_nro" + String(id));
	inputDoc.setAttribute("type", "text");
	inputDoc.setAttribute("size", "13");
	inputDoc.setAttribute("maxlength", "8");
	inputDoc.setAttribute("onkeyup", "xajax_controlar_dni_1(document.f.selectTipoDoc"+id+".options[document.f.selectTipoDoc"+id+".selectedIndex].value, document.f.t1_doc_nro"+id+".value,  "+id+"  )");
//	inputDoc.setAttribute("onkeyup", "xajax_controlar_dni_1()");
	inputDoc.setAttribute("onKeyPress", "return pulsar(event)");
	tdInputDoc.appendChild(inputDoc);
	
	var tdInputCuil = document.createElement("td");
	var inputCuil = document.createElement("input");
	inputCuil.setAttribute("name", "t1_cuil" + String(id));
	inputCuil.setAttribute("id", "t1_cuil" + String(id));
	inputCuil.setAttribute("type", "text");
	inputCuil.setAttribute("size", "15");
	inputCuil.setAttribute("onKeyPress", "return pulsar(event)");
	tdInputCuil.appendChild(inputCuil);

	var tdInputIngreso = document.createElement("td");
	tdInputIngreso.setAttribute("width", "104");
	var inputIngreso = document.createElement("input");
	inputIngreso.setAttribute("name", "t1_ingresos" + String(id));
	inputIngreso.setAttribute("id", "t1_ingresos" + String(id));
	inputIngreso.setAttribute("type", "text");
	inputIngreso.setAttribute("size", "5");
	inputIngreso.setAttribute("onKeyPress", "return pulsar(event)");
	var textoPeso = document.createTextNode("$");
	tdInputIngreso.appendChild(textoPeso);
	tdInputIngreso.appendChild(inputIngreso);
	
	var tdInputTelefono = document.createElement("td");
	tdInputTelefono.setAttribute("width", "115");
	var inputTelefono = document.createElement("input");
	inputTelefono.setAttribute("name", "Familia_telefono" + String(id));
	inputTelefono.setAttribute("id", "Familia_telefono" + String(id));
	inputTelefono.setAttribute("type", "text");
	inputTelefono.setAttribute("size", "12");
	inputTelefono.setAttribute("onKeyPress", "return pulsar(event)");
	tdInputTelefono.appendChild(inputTelefono);

	trInputDatos.appendChild(tdSelect);
	trInputDatos.appendChild(tdInputDoc);
	trInputDatos.appendChild(tdInputCuil);	
	trInputDatos.appendChild(tdInputIngreso);
	trInputDatos.appendChild(tdInputTelefono);
	
	return trInputDatos;	
}


function crearDivDestinoDni(){
	var trDivDestinoDni = document.createElement("tr");
	var tdDivDestinoDni = document.createElement("td");
	tdDivDestinoDni.setAttribute("colspan", "5");
	tdDivDestinoDni.setAttribute("valign", "bottom");

	var divDestinoDni = document.createElement("div");
	divDestinoDni.setAttribute("id", "DivDestinoDNI" + String(id));

	tdDivDestinoDni.appendChild(divDestinoDni);
	trDivDestinoDni.appendChild(tdDivDestinoDni);
	
	return trDivDestinoDni;	
}



 </script>
 </head>
 <body onload="agregarTitular()">
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
<form action="censo_alta_dinamico.php" method="post" enctype="multipart/form-data" name="f" id="f">
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

<!----------------------- TITULARES --------------------->
<table id="titulares">

</table>

<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="99"></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="100" align="left">&nbsp;</td>
    <td align="center"><button type="button" onclick="agregarTitular()">AGREGAR TITULAR</button></td>
    <td><input type="hidden" id="cantTitulares" name="cantTitulares" value="0" /></td>
    <td width="100" align="right"> &nbsp;</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<!----------------------- FIN TITULARES --------------------->

 <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="25" valign="bottom" class="nombrecampo">Observaciones</td>
          </tr>
          <tr>
            <td><textarea name="familia_observaciones" cols="105" rows="6" id="familia_observaciones"></textarea></td>
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
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar censo" onclick="return validaciones()" /></td>
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
