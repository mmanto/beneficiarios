<?php
session_start();


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{


include ("conec.php");
require ("funciones.php");

include ("cabecera.php");

}


$dni = $_POST['dni'];


//$qry2 = "SELECT * FROM dbo_persona 
//		WHERE Persona_dni_nro = $dni";
//$rs_persona = armar_matriz($qry2);

$qry = "SELECT Familia_nro FROM dbo_persona WHERE Persona_dni_nro = $dni";
$rs = armar_matriz($qry);
$familia_nro = $rs[0]['Familia_nro'];

$qry = "SELECT Familia_nro, Persona_nro, Persona_dni_nro, 
		Persona_apellido, Persona_nombre	 
        FROM dbo_persona 
		WHERE Familia_nro = $familia_nro";
$rs_familia = armar_matriz($qry);


?>
<html>
<head>
<script type="text/javascript">
function alternar(check){
    baja.checked = false;            
    cambio.checked = false;
    
    check.checked = true;    
}
</script>


</head>
<body>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h1>Seleccione los integrantes de la familia a los que desea quitar el beneficio.</h1></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>
<form action="quitarBeneficioDB.php" method="post">
<table width="715" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
<tr>
		<td width="20"></td>
		<td width="95" height="25" class="titulo_dato">Nombre</td>
		<td width="32" class="titulo_dato">Apellido</td>
        <td width="38" class="titulo_dato">DNI</td>
</tr>
<?php 
foreach ($rs_familia as $integrante) {
	?>
	<tr>
		<td class="datos-center"><input type="checkbox" name="seleccion[]" value="<?php echo $integrante['Persona_nro'] ?>"></td>		
		<td class="datos-center"><?php echo $integrante['Persona_nombre'];?></td>
		<td class="datos-center"><?php echo $integrante['Persona_apellido'];?></td>
		<td class="datos-center"><?php echo $integrante['Persona_dni_nro'];?></td>
	</tr>
	<?php 
}
?>

</table>
<br>
<br>
<!--<input type="checkbox" id="baja" value="baja" onclick="alternar(this)">QUITAR BENEFICIO-->
<!--<br>-->
<!--<input type="checkbox" id="cambio" value="cambio" onclick="alternar(this)">CAMBIAR DE LOTE-->

<input type="hidden" name="totalPersonas" id="totalPersonas" value="<?php echo count($rs_familia)?>" >
<input type="hidden" name="familiaNro" id="familiaNro" value="<?php echo $familia_nro?>" >

<br>

<input type="submit" name="Submit" value="Enviar">

</form>
<br>
<?
    
include "pie.php";
?>

</body>

</html>