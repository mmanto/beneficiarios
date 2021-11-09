<?

if(!$_POST["nombre"]) {

echo "<h1>Debe indicar su nombre</h1><p><a href=\"javascript:window.history.back();\">Volver al formulario</a></p>";

}else{

if(!$_POST["correo"]) {

echo "<h1>Debe indicar una direccion de correo valida</h1><p><a href=\"javascript:window.history.back();\">Volver al formulario</a></p>";

}else{

include ("conec.php");
require ("funciones.php");

$nombre = $_POST["nombre"];

$correo = $_POST["correo"];


//Busco si ya existe

$sql2 = mysql_query("SELECT * FROM pdt_registro WHERE Correo = '$correo'");

$count = mysql_num_rows($sql2);

//Si ya existe doy mensaje

if ($count > '0') {

echo "<h2>La direcci&oacute;n ingresada ya se encuentra registrada. </h2><p><a href=\"javascript:window.history.back();\">Volver al formulario</a></p>";

}else{

$sql = mysql_query("INSERT INTO pdt_registro (
Nombre,
Correo
)VALUES(
'$nombre',
'$correo')");

//$idRegistro = mysql_insert_id();

$sql6 = mysql_query("SELECT * FROM pdt_registro WHERE Correo = '$correo'");
$registro = mysql_fetch_array($sql6);
$idRegistro = $registro["idRegistro"];


echo "<h1>Su inscripción ha sido exitosa</h1><h2>Su numero de registro es $idRegistro</h2><p>Si su n&uacute;mero coincide con las ultimas tres cifras del sorteo de la Loteria Nacional Argentina denominada 'Gordo de Navidad' del dia 23 de diciembre de 2013 nos pondremos en contacto con usted para enviarle el premio</p>";

echo "count: $count<br>";
echo "Correo: $correo";


}}}

