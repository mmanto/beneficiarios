<?php
session_start();


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{


include ("conec.php");
require ("funciones.php");

include ("cabecera.php");

}


$rs_familia  = $_SESSION['flia'];

$nro_lotes = $_POST['seleccion'];
$nro_lote = $nro_lotes[0];
$qry = "SELECT * FROM dbo_lote WHERE  Lote_nro = $nro_lote";
$rs_lote = armar_matriz($qry);

$partido_nro = $rs_lote[0]['Partido_nro'];
$qry = "SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $partido_nro";
$rs_nombre_partido = armar_matriz($qry);
$nombre_partido = $rs_nombre_partido[0]['Partido_nombre'];

unset($_SESSION['nuevo_lote']);
$_SESSION['nuevo_lote'] = $nro_lote;

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
	  <td height="30"><h2>4 - Confirmar el cambio de lote.</h2></td>
  </tr>
</table>

<form action="cambiarBeneficioUpd.php" method="post">
<br>
<h3>A la siguiente familia:</h3>
<br>
<table width="715" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
<tr>
		<td width="95" height="25" class="titulo_dato">Nombre</td>
		<td width="32" class="titulo_dato">Apellido</td>
        <td width="38" class="titulo_dato">DNI</td>
</tr>
<?php 
foreach ($rs_familia as $integrante) {
	?>
	<tr>		
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

<h3>se le va a asignar el siguiente lote:</h3>
<br>
<table width="400" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
<tr>
		<td width="95" height="25" class="titulo_dato">Partido</td>
		<td width="32" class="titulo_dato">Circ.</td>
        <td width="38" class="titulo_dato">Secc.</td>
        <td width="30" class="titulo_dato">Ch.</td>
        <td width="33" class="titulo_dato">Qta.</td>
        <td width="43" class="titulo_dato">Fracc.</td>
        <td width="30" class="titulo_dato">Mz.</td>
        <td width="31" class="titulo_dato">Pc.</td>
</tr>
<tr>
		<td class="datos-center"><?php echo $nombre_partido;?></td>		
		<td class="datos-center"><?php echo $rs_lote[0]['Lote_circunscripcion'];?></td>
		<td class="datos-center"><?php echo $rs_lote[0]['Lote_seccion'];?></td>
		<td class="datos-center"><?php echo $rs_lote[0]['Lote_chacra'];?></td>
		<td class="datos-center"><?php echo $rs_lote[0]['Lote_quinta'];?></td>
		<td class="datos-center"><?php echo $rs_lote[0]['Lote_fraccion'];?></td>
		<td class="datos-center"><?php echo $rs_lote[0]['Lote_manzana'];?></td>
		<td class="datos-center"><?php echo $rs_lote[0]['Lote_parcela'];?></td>
		
<tr>

</table>


<input type="hidden" name="familiaNro" id="familiaNro" value="<?php echo $rs_familia[0]['Familia_nro'] ?>" >

<br>
<br>
<input type="submit" name="Submit" value="Aceptar">

</form>
<br>
<?
    
include "pie.php";
?>

</body>

</html>