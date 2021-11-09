<? session_start();

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$direccion = $user["Direccion_nro"];


include ("conec.php");
include ("funciones.php");
include("cabecera.php");

if ((!$_POST["fechainicio"] || !$_POST["nomenclatura"] || !$_POST["TitularDNI"] || !$_POST["apellido"] || !$_POST["nombre"] || !$_POST["telefono"]) || ($_POST["idPartido"] == '0')) 

{
 
echo "<h2>Debe completar todos los campos</h2><p><a href=\"javascript:history.back()\">Volver</a></p>";

}else{


$fecha_inicio = $_POST["fechainicio"];
$tramite_tipo= $_POST["tramitetipo"];
$idPartido = $_POST["idPartido"];
$nomenclatura = $_POST["nomenclatura"];
$TitularDNI = $_POST["TitularDNI"];
$apellido = $_POST["apellido"];
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];

$completo = $_POST["completo"];
$terminado = $_POST["terminado"];
$cedula = $_POST["cedula"];
$plancheta = $_POST["plancheta"];
$infdominio = $_POST["infdominio"];
$edicto = $_POST["edicto"];
$camara = $_POST["camara"];
$cartadoc = $_POST["cartadoc"];
$archivado = $_POST["archivado"];
$escribano = $_POST["escribano"];
$numref = $_POST["numref"];
$observaciones = $_POST["observaciones"];


$sql = "INSERT INTO dbo_tramite_ley (
		 Tramite_inicio_fecha,
		 Tramite_tipo,
		 Tramite_partido,
		 Tramite_nomenc,
		 Tramite_completo,
		 Tramite_terminado,
		 Tramite_cedula,
		 Tramite_plancheta,
		 Tramite_inf_dom,
		 Tramite_edicto,
		 Tramite_inf_camara,
		 Tramite_cartadoc,
		 Tramite_archivado,
		 Tramite_escribano,
		 Tramite_observaciones,
		 Tramite_numref,
		 Tramite_alta_fecha,
		 Tramite_alta_usuario
		 )VALUES(
		 '$fecha_inicio',
		 '$tramite_tipo',		
		 '$idPartido',
		 '$nomenclatura',
		 '$completo',
		 '$terminado',
		 '$cedula',
		 '$plancheta',		 
		 '$infdominio',
		 '$edicto',
		 '$camara',
		 '$cartadoc',
		 '$archivado',
		 '$escribano',
		 '$observaciones',
		 '$numref',
		 CURRENT_DATE,
		 '$log_usuario'
		 )";
	
if(mysql_query($sql)) {
$tramite_nro = mysql_insert_id();


$sql2 = "INSERT INTO dbo_persona (
		Documento_tipo_nro,
		Persona_dni_nro,
		Persona_apellido,
		Persona_nombre,
		Persona_telefono,
		Persona_direccion,
		Tramite_nro
		)VALUES(
		'1',
		'$TitularDNI',
		'$apellido',
		'$nombre',
		'$telefono',
		'$direccion',
		'$tramite_nro'
		)";
if(mysql_query($sql2)) {

?> <h2>Alta realizada correctamente</h2>
	<p><a href="javascript:ventana_modif('tramiteley_constancia.php?idTramite=<? echo $tramite_nro; ?>')">Imp. constancia</a></p>
	<p><a href='sbt-menu.php'>Volver al menu</a></p>
	
	<? }else{ echo "<h2>No se pudo realizar la insercion de la persona</h2><p><a href='sbt-menu.php'>Volver al menu</a></p>"; }

}else{ echo "<h2>No se pudo realizar la insercion del registro</h2><p><a href='sbt-menu.php'>Volver al menu</a></p>"; }

}

echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
include("pie.php");

?>