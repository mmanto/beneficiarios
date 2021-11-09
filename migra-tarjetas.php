<?

$idBarrio = "41"; //Define el número del barrio

$idMigra = "20160503"; //Define un identificador para la migración 

$archivo = "prueba1.csv"; //Define nombre de archivo a migrar


///////////////////////
include ("cabecera.php");
include ("conec.php");

$fp = fopen($archivo, "r");
while(!feof($fp)) {
$linea = fgetcsv( $fp , 2048, ";","\" ");


$tarjeta01 = $linea[0];
$tarjeta02 = $linea[1];

$tarjeta = $tarjeta01.$tarjeta02;

$apellido = $linea[2];
$nombre = $linea[3];

$sql = "SELECT * FROM dbo_persona WHERE Barrio_nro_prov = ".$idBarrio." AND Persona_apellido LIKE '%".$apellido."%' AND Persona_nombre LIKE '%".$nombre."%'";

if($res = mysql_query($sql)) {

$cant = mysql_num_rows($res);

	if($cant == '1' ) {

		$persona = mysql_fetch_array($res);
		
		$fliaNum = $persona["Familia_nro"];

		// Proceso - Actualización número de tarjeta
		
		$upd = "UPDATE dbo_familia SET Familia_tarjeta_nro = '$tarjeta', Familia_tarjeta_idmigra = '$idMigra' WHERE Familia_nro = $fliaNum";
		
		if(mysql_query($upd)){
		
		echo "</p>Coincidencia: ".$apellido.", ".$nombre." | ".$persona["Persona_apellido"].",".$persona["Persona_nombre"]."(".$cant.")</p>"; }else{ echo "No se pudo actualizar tarjeta</br>"; }
		

	}else{ echo "<p style=\"color: #FF0000\">No hay coincidencias (".$apellido.", ".$nombre.")</p>"; } 

}else{ echo "No se pudo leer de la base de datos"; }

} //fin del while
fclose($fp);



?>