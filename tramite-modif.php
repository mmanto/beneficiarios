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

$idTramite = $_POST["idTramite"];
$fecha_inicio = $_POST["fechainicio"];
$tramite_tipo= $_POST["tramitetipo"];
$idPartido = $_POST["idPartido"];
$nomenclatura = $_POST["nomenclatura"];
$TitularDNI = $_POST["TitularDNI"];
$apellido = $_POST["apellido"];
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];
$titdom = $_POST["Tramite_titdom"];
$tramite_oficamara = $_POST["Tramite_oficamara"];
$completo = $_POST["completo"];
$terminado = $_POST["terminado"];
$terminado_fecha_orig = $_POST["terminado_fecha"];
$terminado_fecha = cambiaf_a_mysql($terminado_fecha_orig);
$cedula = $_POST["cedula"];
$plancheta = $_POST["plancheta"];
$infdominio = $_POST["infdominio"];
$edicto = $_POST["edicto"];
$camara = $_POST["camara"];
$cartadoc = $_POST["cartadoc"];
	if($_POST["archivado"] != '1') { $archivado = '0'; }else{$archivado = '1';}
$escribano = $_POST["escribano"];
$numref = $_POST["numref"];
$observaciones = $_POST["observaciones"];


$sql = "UPDATE dbo_tramite_ley SET
		 Tramite_inicio_fecha = '$fecha_inicio',
		 Tramite_tipo = '$tramite_tipo',
		 Tramite_partido = '$idPartido',
		 Tramite_nomenc = '$nomenclatura',
		 Tramite_titdom = '$titdom',
		 Tramite_completo = '$completo',
		 Tramite_terminado = '$terminado',
		 Tramite_terminado_fecha = '$terminado_fecha',
		 Tramite_oficamara = '$tramite_oficamara',
		 Tramite_cedula = '$cedula',
		 Tramite_plancheta = '$plancheta',
		 Tramite_inf_dom = '$infdominio',
		 Tramite_edicto = '$edicto',
		 Tramite_inf_camara = '$camara',
		 Tramite_cartadoc = '$cartadoc',
		 Tramite_archivado = '$archivado',
		 Tramite_escribano = '$escribano',
		 Tramite_numref = '$numref',
		 Tramite_observaciones = '$observaciones',
		 Tramite_modif_usuario = '$log_usuario',
		 Tramite_modif_fecha = CURRENT_DATE
		 WHERE Tramite_nro = '$idTramite'";
	
if(mysql_query($sql)) {


$sql2 = "UPDATE dbo_persona SET		
		Persona_dni_nro = '$TitularDNI',
		Persona_apellido = '$apellido',
		Persona_nombre = '$nombre',
		Persona_telefono = '$telefono',
		Persona_direccion = '$direccion'
		WHERE Tramite_nro = '$idTramite' AND Tramite_nro != '0'";
		
		
if(mysql_query($sql2)) { ?>

<h2>Datos actualizados correctamente.</h2>
<p><a href="tramite-informe.php?idTramite=<?=$idTramite; ?>">Volver al informe</a></p>


<? }else{ echo "<h2>No se pudo realizar la insercion de la persona</h2><p><a href='tramite_modif_form.php?idTramite=$idTramite'>Volver al informeu</a></p>"; }

}else{ echo "<h2>No se pudo realizar la actualizacion del registro</h2><p><a href='sbt-menu.php'>Volver al informe</a></p>"; }

}

echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
include("pie.php");

?>