<?
include("cabecera-exptes.php");
include ("conec.php");
include ("funciones.php");


$nuevo_remito = "47";

$hora = date('h:i:s');


$anio_actual = date('Y');

//----------- o O o -----------//

$sql4 = "INSERT INTO dbo_exptesmov_remitos (
		Remito_anio,
		Remito_num,
		Remito_fecha,
		Remito_hora
		)VALUES(
		'$anio_actual',
		'$nuevo_remito',
		CURRENT_DATE,
		'$hora')";
		
if (mysql_query($sql4)) {echo "OK"; }else{ echo "Nooooooooo!"; }	

	

echo $anio_actual."</br>";
echo $nuevo_remito."</br>";
echo $hora."</br>";


?>