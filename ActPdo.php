<?

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

$fp = fopen ("Partidos2017.txt","r"); 

while ($data = fgetcsv ($fp, 100000, ";")) 

	{ 
		$num = count ($data); 

		 
		$partido_nro = $data[0];
		$int_titulo = $data[2];
		$int_nombre = $data[1];
		$domicilio = $data[3];		
		
		

$sql = "UPDATE dbo_partido SET
	    Partido_intendente_titulo = '$int_titulo',
	    Partido_intendente_nombre = '$int_nombre',
	    Partido_municip_domicilio = '$domicilio'
	    WHERE Partido_nro = '$partido_nro'";

if(!mysql_query($sql)) { echo $partido_nro." - ".$int_nombre." - NO se pudo actualizar</br>"; }else{ echo  $partido_nro." - ".$int_nombre." Actualizado.- </br>";}

	}
?>