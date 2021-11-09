<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$cant = $_POST["cant"];

for ($i=1;$i<=$cant;$i++){


$Tramite_nro = $_POST["id".$i];


$cedula = $_POST["cedula".$i];
$plancheta = $_POST["plancheta".$i];
$infdom = $_POST["infdom".$i];
$edicto = $_POST["edicto".$i];
$camara = $_POST["camara".$i];


//echo $Tramite_nro." - ".$cedula." - ".$plancheta." - ".$infdom." - ".$edicto." - ".$camara."</br>";


$sql = "UPDATE dbo_tramite_ley SET
		Tramite_cedula = '$cedula',
		Tramite_plancheta = '$plancheta',
		Tramite_inf_dom = '$infdom',
		Tramite_edicto = '$edicto',
		Tramite_inf_camara = '$camara',
		Corregido = '1'
		WHERE Tramite_nro = $Tramite_nro";

if(mysql_query($sql)) { echo "Actualizado</br>"; }else{ "ERROR</br>"; }



}

?>
<p>&nbsp;</p>
<p><a href="24374-correc-form.php">Volver</a></p>