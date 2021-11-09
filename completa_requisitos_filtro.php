<?php

session_start();


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{


include ("conec.php");
require ("funciones.php");
require ('xajax/xajax_core/xajax.inc.php');
$xajax = new xajax(); 
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true);

$xajax->register(XAJAX_FUNCTION, 'generar_select'); 
$xajax->processRequest();

include ("cabecera.php");


}

//instancio y configuro xajax



$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);



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
   

?>

<html>
<head>
<title>Filtro zona</title>
<?php
//En el <head> indicamos al objeto xajax se encargue de generar el javascript necesario
$xajax->printJavascript("xajax/");
?>
<script type="text/javascript">
function validarPartido(){
	var partido = document.getElementById('idPartido').value;
	if(partido == 0){
		alert("Debe ingresar Partido");
		return false;
	} 
	return true;
}

</script>
</head>
<body>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Completar requisitos</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="completa_requisitos.php" method="post" enctype="multipart/form-data" name="f" id="f">
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="600" border="0" cellspacing="0" cellpadding="0">
    </table></td>
  </tr>
  
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="206" height="18" class="nombrecampo">Partido</td>
        <td width="206" height="18" class="nombrecampo">Barrio</td>
      </tr>  
      <tr>
        <td><select name="idPartido" id="idPartido" onchange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select></td>
      	<td>
      	 	<div id="seleccombinado">
			<select name="lote_barrio" id="lote_barrio">
			<option value=0>Seleccione Barrio</option>
			</select>
			</div>
      		</td>
    </tr>
    

	  <tr>
    <td colspan="2"><table width="600" border="0" cellspacing="0" cellpadding="0">
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
      </tr>
      <tr>
        <td height="25" valign="top"><strong>Nomenclatura catastral:</strong> </td>
        <td><input name="circ" type="text" id="circ" value="-" size="1" /></td>
        <td><input name="secc" type="text" id="secc" value="-" size="1" /></td>
        <td><input name="ch" type="text" id="ch" value="-" size="1" /></td>
        <td><input name="qta" type="text" id="qta" value="-" size="1" /></td>
        <td><input name="fracc" type="text" id="fracc" value="-" size="1" /></td>
        <td><input name="manzana" type="text" id="manzana" value="-" size="1" /></td>
        <td><input name="parcela" type="text" id="parcela" value="-" size="1" /></td>
        <td><input name="subpc" type="text" id="subpc" value="-" size="1" /></td>
      </tr>
      <tr>
        <td height="10" colspan="10" valign="top">&nbsp;</td>
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
    <td width="481" align="right">&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Aceptar" onclick="return validarPartido();"/></td>
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
