<?php
session_start();


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");
require ("funciones.php");
include ("cabecera.php");

}

$id_Resolucion = $_POST['id_Resolucion'];
$anio_Resolucion = $_POST['nro_Resolucion_anio'];
$nro_Resolucion = $_POST['nro_Resolucion'];
$nro_Resolucion = "$nro_Resolucion/$anio_Resolucion";

$qry2 = "SELECT  Resolucion_programa FROM dbo_resolucion 
        WHERE idResolucion = $id_Resolucion";
$resPrograma = armar_matriz($qry2);
if(!$resPrograma){
	echo "No se puedieron realizar los cambios. Vuelva a intentarlo.";
	echo '<h4><a href="menu.php">Volver al menú</a></h4>';
	exit();
}


$programa = $resPrograma[0]['Resolucion_programa'];



$qry = "UPDATE dbo_resolucion
	    SET Resolucion_nombre = '$nro_Resolucion' 
        WHERE idResolucion = $id_Resolucion";

$rs = mysql_query($qry);


if($rs != 0){	
} else {
	echo "No se puedieron realizar los cambios. Vuelva a intentarlo.";
	echo '<h4><a href="menu.php">Volver al menú</a></h4>';
	exit();
}
$barrio_id = $_SESSION['barrio_id'];
$qry2 = "SELECT Barrio_nombre FROM dbo_barrio WHERE  Barrio_nro = $barrio_id";
$rs_barrio_nombre = armar_matriz($qry2);

$barrioNombre = $rs_barrio_nombre[0]['Barrio_nombre'];
$partidoNombre = $_SESSION['partido_nombre'];
$localidadNombre = "";


unset($_SESSION['partido_nombre']);
unset($_SESSION['barrio_id']);

if($programa == "DECRETO 2225/95"){
	$action = "pdfCertificado.php";
}
if ($programa == "PRO TIERRA"){
	$action = "pdfProTierrasMultiCell.php";
}
if ($programa == "EXPROPIACION"){
	$action = "pdfExpropiacion.php";
}


?>

<html>
<head>
</head>
<body>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Imprimir pdf</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="<?php echo $action?>" method="get" target="_blank">
<table width="700">
<tr>
	<td width="35%">Programa: </td>
	<td width="65%"><?php echo $programa?></td>
</tr>
<tr>
	<td>Partido:</td>
	<td><input type="text" id="partidoNombre" name="partidoNombre" value="<?php echo $partidoNombre?>" size="50">
	<input type="hidden" id="nro_Resolucion" name="nro_Resolucion" value="<?php echo $nro_Resolucion?>">
	</td>
</tr>
<?php if($programa == "DECRETO 2225/95" || $programa == "EXPROPIACION") { ?>
<tr>
	<td>Localidad:</td>
	<td><input type="text" id="localidadNombre" name="localidadNombre" value="<?php echo $localidadNombre?>" size="50"></td>
</tr>
<?php } ?>
<tr>
	<td>Barrio:</td>
	<td><input type="text" id="barrioNombre" name="barrioNombre" value="<?php echo $barrioNombre?>" size="50"></td>
</tr>
<tr>
	<td>Nro Ley de Expropiación:</td>
	<td><input type="text" id="nroLeyExpropiacion" name="nroLeyExpropiacion" size="50"></td>
</tr>
<?php if($programa == "DECRETO 2225/95" || $programa == "EXPROPIACION") { ?>
<tr>
	<td>Fecha del certificado:</td>
	<td>
	<b>"Se extiende el presente en la ciudad de La Plata, a los</b>   
	<select id="fechaCertificadoDia" name="fechaCertificadoDia">
	<option value="....."><?php echo "..."?></option>
	<?php for($i=1;$i<32;$i++) { ?>
	<option value="<?php echo $i?>"><?php echo $i?></option>
	<?php }?>	
	</select> <b> días del mes de </b>
	<select id="fechaCertificadoMes" name="fechaCertificadoMes">
	<?php 
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	?>
	<option value="...................."><?php echo "..............." ?></option>
	<?php 
	for ($i=0; $i<12; $i++) {		
	?>
	<option value="<?php echo $meses[$i]?>"><?php echo $meses[$i]?></option>
	<?php }?>
	</select> <b> del </b>
	<select id="fechaCertificadoAnio" name="fechaCertificadoAnio">
	<option value="........"><?php echo "......." ?></option>
	<?php for($i=2013;$i<2050;$i++) { ?>
	<option value="<?php echo $i?>"><?php echo $i?></option>
	<?php }?>	
	</select>
	<b> ." </b>
	</td>
</tr>
<tr>
	<td>Firma la Resolución:</td>
	<td>
	<b>"... Resolución <?php echo $nro_Resolucion?> dictada por </b>   
	<input type="text" id="firmante" name="firmante" value="la entonces Ministra">
	<b> de Infraestructura de la Provincia de Buenos Aires...</b>  
	</td>
</tr>

<tr>
	<td colspan="2"><input type="submit" value="Imprimir certificados"></td>
</tr>
<?php } ?>
<?php if ($programa == "PRO TIERRA") { ?>
<tr>
<td>Cargo del Representante del IV:</td>
<td><input type="text" id="IVCargo" name="IVCargo" value="Subadministrador General"  size="50"></td>
</tr>
<tr>
<td>Nombre del Representante del IV:</td>
<td><input type="text" id="IVNombre" name="IVNombre" value="Dr. José GONZALEZ HUESO" size="50"></td>
</tr>
<tr>
<td>Cargo del Representante del Tierras:</td>
<td><input type="text" id="MICargo" name="MICargo" value="Subsecretario" size="50"></td>
</tr>
<tr>
<td>Nombre del Representante del Tierras:</td>
<td><input type="text" id="MINombre" name="MINombre"  value="Dr. Fabián César STACHIOTTI" size="50"></td>
</tr>



<tr>
	<td colspan="2"><input type="submit" value="Imprimir boletos"></td>
</tr>
<?php } ?>

</table>
</form>
</body>
</html>

