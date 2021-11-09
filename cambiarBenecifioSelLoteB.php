<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");
}

$tabla_Familia = " dbo_familia ";
$tabla_Lote = " dbo_lote ";
$tabla_Persona = " dbo_persona ";

$lote_barrio = $_POST['lote_barrio'];

$partido = $_POST['idPartido']; 
$circ = $_POST['circ'];
$secc = $_POST['secc'];
$ch = $_POST['ch'];
$qta = $_POST['qta'];
$fracc = $_POST['fracc'];
$mz = $_POST['manzana'];
$pc = $_POST['parcela'];
$subpc = $_POST['subpc'];

mysql_select_db("MyTierras",$link);
$error = FALSE;

//Recupero el nombre del partido
$qry = "SELECT Partido_nombre FROM dbo_partido WHERE  Partido_nro = $partido";
$rs_partido = armar_matriz($qry);
if(!$rs_partido){
	$error = TRUE;
}


//Armo condición del where 
$where = " l.Partido_nro = $partido ";
if($lote_barrio != 0){
	$where .= " AND l.Barrio_nro = $lote_barrio ";
} else {

	if($circ != '' && $circ != '-' ){
		$where .= " AND l.Lote_circunscripcion = '$circ' ";
	}
	if($secc != '' && $secc != '-' ){
		$where .= " AND l.Lote_seccion = '$secc' ";
	}
	if($ch != '' && $ch != '-' ){
		$where .= " AND l.Lote_chacra = '$ch' ";
	}
	if($qta != '' && $qta != '-' ){
		$where .= " AND l.Lote_quinta = '$qta' ";
	}
	if($fracc != '' && $fracc != '-' ){
		$where .= " AND l.Lote_fraccion = '$fracc' ";
	}
	if($mz != '' && $mz != '-' ){
		$where .= " AND l.Lote_manzana = '$mz' ";
	}
	if($pc != '' && $pc != '-' ){
		$where .= " AND l.Lote_parcela = '$pc' ";
	}
	if($subpc != '' && $subpc != '-' ){
		$where .= " AND l.Lote_subparcela = '$subpc' ";
	}
}

$sql2 = "SELECT l. * FROM $tabla_Lote AS l
		WHERE  $where ";


$resultado = armar_matriz($sql2);
$cant2 = count($resultado);
if(!$resultado){
	$error = TRUE;
}

if ($error){
	echo "Ocurrió un error al ejecutar la consulta.";
	echo '<h4><a href="javascript:history.go(-1)">Volver al formulario</a></h4>';
	exit();	
} else {
	if( ! is_array($resultado)) {
		echo "Sin Resultados.";
		echo '<h4><a href="javascript:history.go(-1)">Volver al formulario</a></h4>';
		exit();	
	}	
}

?>
<html>
<head>
<script type="text/javascript">

var haySeleccion = false;

function alternar(check){
		haySeleccion = true;
	    // Creamos un array con todas las etiquetas del HTML
	    var allHTMLTags=document.getElementsByTagName("*");
	    // Las recorremos
	    for (i=0; i<allHTMLTags.length; i++) {
	        // Y comprobamos que la clase sea la adecuada
	        if (allHTMLTags[i].className == 'checkbox') {
	            // Aqui ejecutamos lo que queramos a los elementos
	            // que coincidan con la clase.
	            allHTMLTags[i].checked = false;
	        }
	    }
	 check.checked = true;
	 
}

function validarLote() {
	if (!haySeleccion){
		alert("Debe seleccionar un lote");
		return false;
	}
	return true;
}


</script>

</head>
<body>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h1>Cambiar lote a una familia</h1></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
  <tr>
	  <td height="30"><h2>3.b - Seleccionar el lote destino.</h2></td>
  </tr>
</table>


<form action="cambiarBeneficioPreUpd.php" method="post" id="form">
<table width="400" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
<tr>
	<td></td>
	<td height="28" colspan="8" class="titulo_dato">Nomenclatura del inmueble </td>
</tr>
<tr>
		<td></td>
		<td width="95" height="25" class="titulo_dato">Partido</td>
		<td width="32" class="titulo_dato">Circ.</td>
        <td width="38" class="titulo_dato">Secc.</td>
        <td width="30" class="titulo_dato">Ch.</td>
        <td width="33" class="titulo_dato">Qta.</td>
        <td width="43" class="titulo_dato">Fracc.</td>
        <td width="30" class="titulo_dato">Mz.</td>
        <td width="31" class="titulo_dato">Pc.</td>
</tr>
<?php 
for ($i = 0; $i < count($resultado); $i++) {
	?>
	<tr>
<!--	Cada check box representa una flia, no un lote (en un lote puede haber más de un beneficio)-->
		<td class="datos-center"><input type="checkbox" class="checkbox" name="seleccion[]" value="<?php echo $resultado[$i]['Lote_nro'] ?>" onclick="alternar(this)"></td>		
		<td class="datos-center"><?php echo $rs_partido[0]['Partido_nombre'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_circunscripcion'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_seccion'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_chacra'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_quinta'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_fraccion'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_manzana'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_parcela'];?></td>
		
	</tr>
	<?php 
}
?>

</table>
<input type="submit" name="Submit" value="Aceptar" onclick="return validarLote()"></form>
<?
include "pie.php";
?>

</body>
</html>

