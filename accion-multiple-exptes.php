<?
include ("conec.php");
include ("funciones.php");

$noback = "1"; 

include("cabecera.php");

$ubicacion = $_POST["ubicacion"];

	$sql2 = "SELECT Direccion_nro FROM dbo_area WHERE Area_nro = $ubicacion";
	$res2 = mysql_query($sql2);
	$destino = mysql_fetch_array($res2);
	$direccion_destino = $destino["Direccion_nro"];

$lista = implode(',',$_POST['seleccion']); 

$upd = "UPDATE dbo_expte_esc SET Expte_ubicacion_area = '$ubicacion', Expte_ubicacion_direccion = '$direccion_destino' WHERE Expte_nro IN(".$lista.")"; 

if(!mysql_query($upd)) { echo "<h2>La operacion no se pudo realizar</h2>
								<p>&nbsp</p>
								<p><a href='exptes_listar.php'>Volver</a></p>
								<p>&nbsp</p>
								<p>&nbsp</p>";

}else{

echo "<h2>Registros actualizados</h2>
		<p>&nbsp</p>
		<p><a href='exptes_listar.php'>Volver</a></p>
		<p>&nbsp</p>
		<p>&nbsp</p>";

}


include ("pie.php");

?>