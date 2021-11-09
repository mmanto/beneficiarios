<?php
session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");
}

$tabla_Famila = " dbo_familia ";
$tabla_Resolucion = "dbo_resolucion";

mysql_select_db("MyTierras",$link);

$nros_familia = $_POST['seleccion'];
$primer_familia = $nros_familia[0];
$error = FALSE;

$programa =  $_POST['programa'];

$nro_barrio = $_SESSION['nro_barrio'];
$nro_partido = $_SESSION['nro_partido'];

unset($_SESSION['nro_barrio']);
unset($_SESSION['nro_partido']);

$nombre_partido = $_SESSION['nombre_partido'];
$resultado = $_SESSION['resultado'];


unset($_SESSION['nombre_partido']);
unset($_SESSION['resultado']);

//primero hago el insert en resolucion
//si falla no hago más nada
//en caso contrario hago el update en familia (estado, id_resolucion)
$hoy = date("Y-m-d");
$primer_circ = $resultado[0]['Lote_circunscripcion'];
$primer_secc = $resultado[0]['Lote_seccion'];
$ins = "INSERT INTO $tabla_Resolucion 
		(Fecha_a_Resolucion, Resolucion_partido, Resolucion_barrio_nro, Resolucion_programa, Resolucion_circ, Resolucion_secc) 
		VALUES ('$hoy', $nro_partido, $nro_barrio, '$programa' , '$primer_circ', '$primer_secc' )";
if (mysql_query($ins)) {
	$resolucion_id = mysql_insert_id();			
}else{
	$error = TRUE;
}

$rs = 0;
if(!$error) {
$qry = "UPDATE $tabla_Famila 
	    SET Familia_req_estado = 2, 
            Familia_id_resolucion = $resolucion_id 
        WHERE ";
$i=0;
foreach ($nros_familia as $id){ 
   if ($id == $primer_familia){
   	$qry .= " Familia_nro = $id "; 
   } else {
   	$qry .= " OR Familia_nro = $id ";
   }
   $flias[$i] = (string) $id; 
   $i++;
} 
$rs = mysql_query($qry);
}

if($rs != 0){
	echo '<h4><a href="menu.php">Volver al menú</a></h4>';
} else {
	echo "No se puedieron realizar los cambios. Vuelva a intentarlo.";
	echo '<h4><a href="menu.php">Volver al menú</a></h4>';
	exit();
}




$cant2 = count($resultado);
//if(!$resultado){
//	$error = TRUE;
//}
//
//if ($error){
//	echo "Ocurrió un error al ejecutar la consulta.";
//	echo '<h4><a href="javascript:history.go(-1)">Volver al formulario</a></h4>';
//	exit();	
//}



?>
<html>
<head>
</head>
<body>

<table width="715" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
<tr>
	<td height="28" colspan="8" class="titulo_dato">Nomenclatura del inmueble </td>
	<td width="363" class="titulo_dato">Beneficiarios</td>
<tr>
<tr>	
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
	//muestro solo las familias que se seleccionaron
	$flia_nro = $resultado[$i]['Familia_nro'];
	$flia_nro = (string) $flia_nro;
	if (in_array($flia_nro, $flias)){ 
	?>
	<tr>
<!--	Cada check box representa una flia, no un lote (en un lote puede haber más de un beneficio)-->
		<td class="datos-center"><?php echo $nombre_partido; ?></td>
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
	} else {
		$i++;
	}//end if
}//end while
?>

</table>

<?
    
include "pie.php";
?>

</body>
</html>







