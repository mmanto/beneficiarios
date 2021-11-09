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
$xajax->register(XAJAX_FUNCTION, 'generar_select2'); 
$xajax->processRequest();

include ("cabecera.php");

}


$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);



function select_combinado($nro_partido){ 
   	$qryBarrios = "SELECT Barrio_nro, Barrio_nombre
  		FROM dbo_barrio
  		WHERE Partido_nro = $nro_partido";
	$resBarrios = armar_matriz($qryBarrios);
	$totalBarrios = count($resBarrios);
	
	$nuevo_select = '<select name="idBarrio" id="idBarrio" onchange="xajax_generar_select2(document.f.idBarrio.options[document.f.idBarrio.selectedIndex].value)">';
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

function select_combinado2($id_barrio){ 
//	selecciona las fechas por barrios que no tengan nro de resolución
   	$qryFechas_Barrio = "SELECT idResolucion, Fecha_a_Resolucion
  						FROM dbo_resolucion
  						WHERE Resolucion_barrio_nro = $id_barrio
  						AND Resolucion_nombre IS NULL";
	$resFechas = armar_matriz($qryFechas_Barrio);
	$totalFechas = count($resFechas);
	
	$nuevo_select = '<select name="id_resolucion" id="id_resolucion">';
	$nuevo_select .= '<option value=0>Seleccione Fecha</option>';
	for ($i=0; $i<$totalFechas; $i++){
	$fecha = $resFechas[$i]['Fecha_a_Resolucion'];
	$id_resolucion = $resFechas[$i]['idResolucion'];
	$nuevo_select .= '<option value= "'. $id_resolucion .'">'. $fecha .'</option>';
	}
	$nuevo_select .= '</select>';
//	$nuevo_select .= '<p>Texto de testeo</p>';
	return $nuevo_select;
}

function generar_select2($id_barrio){
	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding('ISO-8859-1');
	$nuevo_select2 = select_combinado2($id_barrio);			
	$respuesta->Assign("seleccombinado2","innerHTML",$nuevo_select2);
	return $respuesta;
}




?>

<html>
<head>
<title>Filtro Resolución</title>
<?php $xajax->printJavascript("xajax/"); ?>
</head>
<body>
<!--selecciona partido barrio fecha-->
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar número de Resolución</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="dar_nro_resolucion.php" method="post" enctype="multipart/form-data" name="f" id="f">
<table width="500" border="0" cellspacing="0" cellpadding="0">
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
        <td width="206" height="18" class="nombrecampo">Fecha a Resolución</td>
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
      	<td>
      	 	<div id="seleccombinado2">
			<select name="fecha_a_res" id="fecha_a_res">
			<option value=0>Seleccione Fecha</option>
			</select>
			</div>
      	</td>
    	</tr>
    	<tr>
  		<td>
  		</td>
  		<td>
  		</td>
    	<td align="center">
    	<br>
    	<input type="submit" name="Submit" value="Aceptar">
    	<td>
    	</tr>
    	
</table>
</td>
</tr>
</table>
</form>

</body>
</html>