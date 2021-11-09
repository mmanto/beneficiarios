<?php
session_start();


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");
require ("funciones.php");
include ("cabecera.php");

}

$tabla_Familia = " dbo_familia ";
$tabla_Lote = " dbo_lote ";
$tabla_Persona = " dbo_persona ";

$partido = $_POST['idPartido'];
$barrio = $_POST['idBarrio'];
$id_Resolucion = $_POST['id_resolucion'];


//Recupero el nombre del partido
$qry2 = "SELECT Partido_nombre FROM dbo_partido WHERE  Partido_nro = $partido";
$rs_partido = armar_matriz($qry2);
if(!$rs_partido){
	$error = TRUE;
}
$partido_nombre = $rs_partido[0]['Partido_nombre'];
unset($_SESSION['partido_nombre']);
$_SESSION['partido_nombre'] = $partido_nombre;
unset($_SESSION['barrio_id']);
$_SESSION['barrio_id'] = $barrio;


$sql2 = "SELECT s.Lote_circunscripcion, 
		s.Lote_nro,
		s.Lote_seccion, 
		s.Lote_chacra, 
		s.Lote_quinta, 
		s.Lote_fraccion, 
		s.Lote_manzana, 
		s.Lote_parcela, 
		s.Lote_valor_mensura,
		s.Lote_cant_cuotas,
		s.Lote_valor_cuota, 
		p.Persona_dni_nro, 
		p.Persona_nombre, 
		p.Persona_apellido, 
		p.Familia_nro
		FROM $tabla_Persona AS p
		JOIN (
				SELECT l. * , 
						f.Familia_nro AS flia_nro
						FROM $tabla_Lote AS l
						JOIN $tabla_Familia AS f 
						ON l.Lote_nro = f.Lote_nro
						WHERE  f.Familia_id_resolucion = $id_Resolucion
				) AS s 
		ON p.Familia_nro = s.flia_nro
		WHERE s.Lote_nro NOT IN
		(SELECT DISTINCT Lote_nro
		FROM $tabla_Familia 
		WHERE Familia_req_estado = 0
		AND Partido_nro = $partido
		AND Lote_nro IS NOT NULL) 
		ORDER BY s.Lote_nro, s.flia_nro";



$resultado = armar_matriz($sql2);
unset($_SESSION['result_dar_nro_res']);
$_SESSION['result_dar_nro_res'] = $resultado;

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
function validarCampos(){
	var nroRes = document.getElementById("nro_Resolucion").value;
	if (nroRes == ""){
		alert("Debe ingreser el número de resolución.");
		return false;
	}
	return true;
}
	
</script>

</head>
<body>
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

<form action="dar_nro_resolucion_update.php" method="post">
<table width="715" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
<tr>
	<td></td>
	<td height="28" colspan="7" class="titulo_dato">Nomenclatura del inmueble </td>
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
	?>
	<tr>
		<td class="datos-center"><?php echo $partido_nombre;?></td>
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
<br>
Número de Resolución: 
<input align="right" size="6" width="50 px" type="text" name="nro_Resolucion" id="nro_Resolucion">
/
<select id="nro_Resolucion_anio" name="nro_Resolucion_anio">
	<?php for($i=2012;$i<2025;$i++) { ?>
	<option value="<?php echo $i?>"><?php echo $i?></option>
	<?php }?>	
</select>


<input type="hidden"" name="id_Resolucion" id="id_Resolucion" value="<?php echo $id_Resolucion?>">
<input type="submit" name="Submit" value="Aceptar" onclick="return validarCampos();">
</form>
<br>
<br>
<?
    
include "pie.php";
?>

</body>
</html>

