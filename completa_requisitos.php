<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");
}

//TODO: para producción sacar _test a los nombres de tablas
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
$where = " f.Familia_req_estado = 0";
$where .= " AND l.Partido_nro = $partido ";
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

$sql2 = "SELECT s.Lote_circunscripcion, 
		s.Lote_nro,
		s.Lote_seccion, 
		s.Lote_chacra, 
		s.Lote_quinta, 
		s.Lote_fraccion, 
		s.Lote_manzana, 
		s.Lote_parcela, 
		p.Persona_dni_nro, 
		p.Persona_nombre, 
		p.Persona_apellido, 
		p.Familia_nro
		FROM $tabla_Persona AS p
		JOIN (
				SELECT l. * , 
						f.Familia_nro AS flia_nro
						FROM $tabla_Lote AS l
						JOIN $tabla_Familia AS f ON l.Lote_nro = f.Lote_nro
						WHERE  $where 
				) AS s 
		ON p.Familia_nro = s.flia_nro
		ORDER BY s.Lote_nro, s.flia_nro";


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
</head>
<body>



<form action="completa_requisitos_update.php" method="post">
<table width="715" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
<tr>
	<td></td>
	<td height="28" colspan="8" class="titulo_dato">Nomenclatura del inmueble </td>
	<td width="363" class="titulo_dato">Beneficiarios</td>
<tr>
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
        <td class="titulo_dato">Apellido, Nombres y Documento </td>
</tr>
<?php 
$i = 0;
while ($i < $cant2) {
	?>
	<tr>
<!--	Cada check box representa una flia, no un lote (en un lote puede haber más de un beneficio)-->
		<td class="datos-center"><input type="checkbox" name="seleccion[]" value="<?php echo $resultado[$i]['Familia_nro'] ?>"></td>		
		<td class="datos-center"><?php echo $rs_partido[0]['Partido_nombre'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_circunscripcion'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_seccion'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_chacra'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_quinta'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_fraccion'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_manzana'];?></td>
		<td class="datos-center"><?php echo $resultado[$i]['Lote_parcela'];?></td>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<?php
			do { 
			?>
			<tr>
				<td width="73%" class="datos-left"><?php echo trim($resultado[$i]['Persona_apellido']).", ".trim($resultado[$i]['Persona_nombre']);?></td>
				<td width="27%" style="border-left: 1px solid #333;" class="datos-left"><?php echo $resultado[$i]['Persona_dni_nro'];?></td>					
			</tr>			
			<?php
			$i++; 
			//La condición es que la familia sguiente sea la misma que la actual, de esta forma se agrupa por familia y no por lote
			} while ($i < $cant2 && $resultado[$i-1]['Familia_nro'] == $resultado[$i]['Familia_nro']) ?>	
		</table>	
		</td>
	</tr>
	<?php 
}
?>

</table>
<input type="submit" name="Submit" value="Enviar"></form>
<?
    
include "pie.php";
?>

</body>
</html>

