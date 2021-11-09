<? session_start();

/////////////////////////////////
$tabla_tarjeta = "dbo_tarjeta";
/////////////////////////////////

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$idUsuario = $_SESSION["user_id"];
$familia_nro = $_POST["idFamilia"];
$tarjeta = $_POST["tarjeta"];
$titular_apellido = $_POST["titular_apellido"];
$titular_nombre = $_POST["titular_nombre"];

/*
$sql = "SELECT Persona_nro, Persona_apellido, Persona_nombre, Familia_nro FROM dbo_persona WHERE Persona_nro = $idPersona";
$res = mysql_query($sql);
$persona = mysql_fetch_array($res);
$persona_nro = $persona["Persona_nro"];
$persona_nombre = $persona["Persona_nombre"];
$persona_apellido = $persona["Persona_apellido"];
$idFamilia = $persona["Familia_nro"];
*/

$tarjetanum = "620000149000".$tarjeta;

$sql2 = "SELECT * FROM $tabla_tarjeta WHERE Tarjeta_numero = $tarjetanum";
$res2 = mysql_query($sql2);

if(mysql_num_rows($res2) > '0') {

$tarjeta = mysql_fetch_array($res2);

if($tarjeta["Familia_nro"] != '0') { ?>
	
<h2>Esta tarjeta ya est&aacute; asignada a otro titular</h2>
<p>Por favor corrobore los datos o contacte al administrador</p>
<p><a href="beneficio_informe.php?idFamilia=<? echo $familia_nro; ?>">Volver</a></p>

<? }else{

$tarjeta_nro = $tarjeta["Tarjeta_nro"];

$upd = "UPDATE dbo_tarjeta SET
		Familia_nro = '$familia_nro',
		Tarjeta_titular_apellido = '$titular_apellido',
		Tarjeta_titular_nombre = '$titular_nombre',
		Tarjeta_asignacion_fecha = CURRENT_DATE,
		Tarjeta_asignacion_usuario = '$idUsuario'		
		WHERE Tarjeta_nro = $tarjeta_nro";
		
if(mysql_query($upd)) { ?>

<h2>La tarjeta fue asignada correctamente</h2>
<p><a href="beneficio_informe.php?idFamilia=<? echo $familia_nro; ?>">Volver</a></p>

<? }else{ ?>

<h2>ERROR - No se pudo asignar la tarjeta</h2>
<p>Por favor contacte al administrador</p>
<p><a href="beneficio_informe.php?idFamilia=<? echo $familia_nro; ?>">Volver</a></p> 
 
 
<?  }}	
	
//Si no existe la tarjeta, se da de alta
}else{ 

$ins = "INSERT INTO $tabla_tarjeta (
		Tarjeta_numero,
		Tarjeta_titular_apellido,
		Tarjeta_titular_nombre,
		Tarjeta_alta_fecha,
		Tarjeta_alta_usuario,
		Tarjeta_asignacion_fecha,
		Tarjeta_asignacion_usuario,
		Familia_nro
		)VALUES(
		'$tarjetanum',
		'titular_apellido',
		'$titular_nombre',
		CURRENT_DATE,
		'$idUsuario',
		CURRENT_DATE,
		$idUsuario,
		'$familia_nro'
		)";	
	
if(mysql_query($ins)) { ?>

<h2>La tarjeta fue asignada correctamente</h2>
<p><a href="beneficio_informe.php?idFamilia=<? echo $familia_nro; ?>">Volver</a></p>

<? }else{ ?>

<h2>ERROR - No se pudo asignar la tarjeta</h2>
<p>Por favor contacte al administrador</p>
<p><a href="beneficio_informe.php?idFamilia=<? echo $familia_nro; ?>">Volver</a></p> 


<? }} ?>