<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];


//////////////////////////////////////////////

// Definición nombres de tablas

     $dbo_tabla_lote = "dbo_lote";
	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";
	 //$dbo_tabla_escritura = "dbo_escritura";

//////////////////////////////////////////////

$Familia_nro = $_POST["idFamilia"];



//Definicion de variables de persona 1
$t1_apellido = $_POST["t1_apellido"];
$t1_nombre = $_POST["t1_nombre"];
$t1_doc_tipo = $_POST["t1_doc_tipo"];
$t1_doc_nro = $_POST["t1_doc_nro"];
$t1_ecivil = $_POST["t1_ecivil"];
if($_POST["t1_sep_hecho"] == '1') { $t1_sep_hecho = '1'; }else{ $t1_sep_hecho = '0'; }
$t1_nacionalidad = $_POST["t1_nacionalidad"];

if ($_POST["t1_fecha_nac"] == 'dd/mm/aaaa') { $t1_fecha_nac = "00-00-0000"; }else{$t1_fecha_nac = $_POST["t1_fecha_nac"];}

$t1_lugar_nac = $_POST["t1_lugar_nac"];
$t1_conyuge_apellido = $_POST["t1_conyuge_apellido"];
$t1_conyuge_nombre = $_POST["t1_conyuge_nombre"];

$t1_padre_nmbcompleto = $_POST["t1_padre_nmbcompleto"];

$t1_madre_nmbcompleto = $_POST["t1_madre_nmbcompleto"];

$t1_telefono = $_POST["t1_telefono"];


// Insert de titular 

	$inst1 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Estado_civil_nro,
	Ecivil_sep_hecho,
	Persona_lugar_nac,
	Persona_fecha_nac,
	Persona_nacionalidad,
	Persona_telefono,
	Persona_conyuge_apellido,
	Persona_conyuge_nombre,
	Persona_padre_nombrecompleto,
	Persona_madre_nombrecompleto,
	Familia_nro,
	Persona_alta_fecha,
	Persona_alta_usuario
	)VALUES(
	'$t1_apellido',
	'$t1_nombre',
	'$t1_doc_tipo',
	'$t1_doc_nro',
	'$t1_ecivil',
	'$t1_sep_hecho',
	'$t1_lugar_nac',
	'$t1_fecha_nac',
	'$t1_nacionalidad',
	'$t1_telefono',
	'$t1_conyuge_apellido',
	'$t1_conyuge_nombre',
	'$t1_padre_nmbcompleto',
	'$t1_madre_nmbcompleto',
	'$Familia_nro',
	CURRENT_DATE,
	'$log_usuario')";
	
	mysql_query($inst1,$link);


?>
		
<h2>Titular cargado correctamente</h2> 
<p><a href="beneficio_informe.php?idFamilia=<?=$Familia_nro; ?>">Volver al informe</a></p>
<p>&nbsp;</p>
<p><?=$t1_telefono; ?></p>

<?
include("pie.php");
 } ?>



