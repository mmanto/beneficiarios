<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

?>
<body onLoad="javascript:print();">
<h2>Solicitud de tarjetas - <? echo date("d")."/".date("m")."/".date("Y")  ?></h2>

<?



$lista = implode(',',$_POST['seleccion']); 

implode(',',$seleccion);

$SQL35 = mysql_query("SELECT * FROM dbo_settings WHERE Clave = 'tarjeta'");

$abc = mysql_fetch_array($SQL35);

$nueva_tarjeta = $abc["Valor"];


$sql2 = "SELECT * from dbo_familia WHERE Familia_nro IN(".$lista.")";

$res2 = mysql_query($sql2);

//Archivo de texto


$nmbArchivo = "ALT".date("Y").date("m").date("d").".txt";


$file = fopen($nmbArchivo, "a+");

while ($familia = mysql_fetch_array($res2)) {

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


$familianum = $familia["Familia_nro"];

$familia_tarjeta = $familia["Familia_tarjeta_nro"];

if ($familia_tarjeta != '0') {echo $familianum." - El beneficio ya tiene una tarjeta entregada (".$familia_tarjeta.") </br>";}else{



// Seleccion de titular de tarjeta

$sql3 = "SELECT * FROM dbo_persona WHERE Familia_nro = $familianum AND blnActivo = '1' AND Persona_baja != '1' ORDER BY Persona_nro ASC LIMIT 0,1";

$res3 = mysql_query($sql3);

$persona = mysql_fetch_array($res3);

$titular_apellido = $persona["Persona_apellido"];
$titular_nombre = $persona["Persona_nombre"];
$titular_dni = $persona["Persona_dni_nro"];
$titular_dni_punto = number_format($titular_dni, 0, '', '.');

//

$upd = "UPDATE dbo_familia SET
		Familia_tarjeta_nro = '$numtarjeta',
		Familia_tarjeta_fecha = CURRENT_DATE
		WHERE Familia_nro = $familianum";

if(mysql_query($upd)) {

	fwrite($file, $numtarjeta.$titular_apellido."                               ".$titular_nombre."\r\n");

	echo $familianum." - Tarjeta ".$numtarjeta." | Titular: ".$titular_apellido.", ".$titular_nombre." (DNI ".$titular_dni_punto.")</br>";

	$nueva_tarjeta = $nueva_tarjeta+1;

 }else{ echo "</p>Error al intentar actualizar el n&uacute;mero de tarjeta </p>"; }

}
} //Fin del while

$upd2 = "UPDATE dbo_settings SET
		valor = '$nueva_tarjeta'
		WHERE idSetting = 2";
if(mysql_query($upd2)) {
	
	echo "<p>&nbsp;</p><p>Proceso terminado. <a href=\"descargar.php?f=".$nmbArchivo."\">Descargar archivo para el banco</a></p><p><a href=\"menu.php\">Terminar</a></p>";
	
	
}else{ echo "error"; }

fclose($file);


?>