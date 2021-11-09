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
$qry = "SELECT Familia_nro FROM dbo_persona WHERE Persona_dni_nro = $dni";
$rs = armar_matriz($qry);
$familia_nro = $rs[0]['Familia_nro'];


if ($rs[0]['Familia_nro'] == '') {
	echo "No se encontró el dni.";
	echo '<h4><a href="menu.php">Volver al menú</a></h4>';
	exit();
}


$qry = "SELECT Familia_nro, Persona_nro, Persona_dni_nro, 
		Persona_apellido, Persona_nombre	 
        FROM dbo_persona 
		WHERE Familia_nro = $familia_nro";
$rs_familia = armar_matriz($qry);

unset($_SESSION['flia']);
$_SESSION['flia'] = $rs_familia;



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
	  <td height="30"><h1>Cambiar lote a una familia</h1></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
  <tr>
	  <td height="30"><h2>2 - Integrantes de la familia.</h2></td>
  </tr>
</table>

<form action="cambiarBeneficioSelLote.php" method="post">
<table width="715" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
<tr>
		<td width="95" height="25" class="titulo_dato">Nombre</td>
		<td width="32" class="titulo_dato">Apellido</td>
        <td width="38" class="titulo_dato">DNI</td>
</tr>
<?php 
for ($i = 0; $i<count($rs_familia); $i++) {
	?>
	<tr>		
		<td class="datos-center"><?php echo $rs_familia[$i]['Persona_nombre'];?></td>
		<td class="datos-center"><?php echo $rs_familia[$i]['Persona_apellido'];?></td>
		<td class="datos-center"><?php echo $rs_familia[$i]['Persona_dni_nro'];?></td>
	</tr>
	<?php 
}
?>

</table>
<br>

<input type="hidden" name="totalPersonas" id="totalPersonas" value="<?php echo count($rs_familia)?>" >
<input type="hidden" name="familiaNro" id="familiaNro" value="<?php echo $familia_nro?>" >

<br>
<input type="submit" name="Submit" value="Seleccionar Lote">

</form>
<br>
<?
    
include "pie.php";
?>

</body>

</html>