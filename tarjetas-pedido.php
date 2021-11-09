<? session_start();

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

////////////////////////////////////
/// DEFINIR NOMBRE TABLA TARJETA ///
  $tabla_tarjeta =  "dbo_tarjeta";
////////////////////////////////////

?>
<body onLoad="javascript:print();">
<h2>Solicitud de tarjetas - <? echo date("d")."/".date("m")."/".date("Y")  ?></h2>

<?

$idUsuario = $_SESSION["user_id"];

$lista = implode(',',$_POST['seleccion']); 

implode(',',$seleccion);

$SQL35 = mysql_query("SELECT * FROM dbo_settings WHERE Clave = 'tarjeta'");

$abc = mysql_fetch_array($SQL35);

$nueva_tarjeta = $abc["Valor"];


$sql2 = "SELECT * from dbo_familia WHERE Familia_nro IN(".$lista.")";

$res2 = mysql_query($sql2);

$sumacontarjeta = '0';

//Archivo de texto

$nmbArchivo = "ALT".date("Y").date("m").date("d").".txt";


$file = fopen($nmbArchivo, "a+");

while ($familia = mysql_fetch_array($res2)) {

$familia_nro = $familia["Familia_nro"];
$monto_origen = $familia["Familia_montoadj"];
$monto_actual = $familia["Familia_monto_actualizacion"];
$cuotascant = $familia["Familia_montoadj_cuotas"];

//Busco el primer titular de la familia
	
$sql3 = "SELECT * FROM dbo_persona WHERE Familia_nro = $familia_nro AND blnActivo = '1' AND Persona_baja != '1' ORDER BY Persona_nro ASC LIMIT 0,1";

$res3 = mysql_query($sql3);

$persona = mysql_fetch_array($res3);
$persona_nro = $persona["Persona_nro"];
$titular_apellido = $persona["Persona_apellido"];
$titular_nombre = $persona["Persona_nombre"];
$titular_dni = $persona["Persona_dni_nro"];
$titular_dni_punto = number_format($titular_dni, 0, '', '.');


/*****************************************/
/*****************************************/

/*********** ATENCION: CORRER ESTA SENTENCIA *************/

//Compruebo si ya tiene tarjeta

$sql4 = "SELECT Tarjeta_numero FROM $tabla_tarjeta WHERE Familia_nro = $familia_nro AND blnActivo = '1' LIMIT 0,1";
$res4 = mysql_query($sql4);
$tarjeta = mysql_fetch_array($res4);
$tarjetaex = $tarjeta["Tarjeta_numero"];
$cant = mysql_num_rows($res4);

if ($cant != '0') {echo "El beneficio ya tiene una tarjeta entregada (".$tarjetaex.") </br>";

$sumacontarjeta = $sumacontarjeta+1;

}else{	
	
/*****************************************/
/*****************************************/


$numbanco = "620000149000";
$cadena = $numbanco.$nueva_tarjeta;

$v0 = $cadena[0]*3;
$v1 = $cadena[1]*1;
$v2 = $cadena[2]*3;
$v3 = $cadena[3]*1;
$v4 = $cadena[4]*3;
$v5 = $cadena[5]*1;
$v6 = $cadena[6]*3;
$v7 = $cadena[7]*1;
$v8 = $cadena[8]*3;
$v9 = $cadena[9]*1;
$v10 = $cadena[10]*3;
$v11 = $cadena[11]*1;
$v12 = $cadena[12]*3;
$v13 = $cadena[13]*1;
$v14 = $cadena[14]*3;
$v15 = $cadena[15]*1;
$v16 = $cadena[16]*3;

$suma = $v0+$v1+$v2+$v3+$v4+$v5+$v6+$v7+$v8+$v9+$v10+$v11+$v12+$v13+$v14+$v15+$v16;

$resto = $suma % 10;

if($resto == 0) {$dv = $resto; }else{ $dv = 10-$resto; }

$numtarjeta = $cadena.$dv;

$upd = "INSERT INTO $tabla_tarjeta (
		Tarjeta_numero,
		Tarjeta_titular_apellido,
		Tarjeta_titular_nombre,
		Tarjeta_alta_fecha,
		Tarjeta_alta_usuario,
		Tarjeta_asignacion_fecha,
		Tarjeta_asignacion_usuario,
		Tarjeta_monto_origen,
		Tarjeta_monto_cuotas,		
		Tarjeta_monto_actual,
		Familia_nro
		)VALUES(
		'$numtarjeta',
		'$titular_apellido',
		'$titular_nombre',
		CURRENT_DATE,
		'$idUsuario',
		CURRENT_DATE,
		$idUsuario,		
		'$monto_origen',
		'$cuotascant',
		'$monto_actual',
		'$familia_nro'		
		)";

if(mysql_query($upd)) {
	
	//$tarjeta_nro = mysql_insert_id();

	fwrite($file, $numtarjeta.$titular_apellido."                               ".$titular_nombre."\r\n");

	echo "Tarjeta ".$numtarjeta." | Titular: ".$titular_apellido.", ".$titular_nombre." (DNI ".$titular_dni_punto.")</br>";
	
$sql42 = "UPDATE dbo_familia SET Familia_tarjeta_solicitar = '0' WHERE Familia_nro = $familia_nro";

mysql_query($sql42);	

$nueva_tarjeta = $nueva_tarjeta+1;

 }else{ echo "</p>".$numtarjeta." - Error al crear tarjeta </p>"; }

}
} //Fin del while

$upd3 = "UPDATE dbo_settings SET
		valor = '$nueva_tarjeta'
		WHERE idSetting = 2";
if(mysql_query($upd3)) {

?>	
	<p>&nbsp;</p>
    <h2>Proceso terminado.</h2>
	<? echo "<a href=\"descargar.php?f=".$nmbArchivo."\">Descargar archivo para el banco</a></p>";
?>	
<p>Atenci&oacute;n: No se agregaron <? echo $sumacontarjeta; ?> pedidos por existir tarjetas existentes para esos beneficios.</p>
<p><a href="sbt-menu.php">Terminar</a></p>
	
<? }else{ echo "error"; }

fclose($file);


?>