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

$persona_nro = $_POST["Persona_nro"];
$origen = $_POST["origen"];

//Definicion de variables de persona 1
$t1_apellido = $_POST["t1_apellido"];
$t1_nombre = $_POST["t1_nombre"];
$t1_doc_tipo = $_POST["t1_doc_tipo"];
$t1_doc_nro = $_POST["t1_doc_nro"];
$t1_ecivil = $_POST["t1_ecivil"];
if($_POST["sep_hecho"] == '1') { $t1_sep_hecho = '1'; }else{ $t1_sep_hecho = '0'; }
$t1_nacionalidad = $_POST["t1_nacionalidad"];

if ($_POST["t1_fecha_nac"] == 'dd/mm/aaaa') { $t1_fecha_nac = "00-00-0000"; }else{$t1_fecha_nac = $_POST["t1_fecha_nac"];}

$t1_lugar_nac = $_POST["t1_lugar_nac"];
$t1_conyuge_apellido = $_POST["t1_conyuge_apellido"];
$t1_conyuge_nombre = $_POST["t1_conyuge_nombre"];
$t1_padre_nmbcompleto = $_POST["t1_padre_nmbcompleto"];
$t1_madre_nmbcompleto = $_POST["t1_madre_nmbcompleto"];
$t1_telefono = $_POST["t1_telefono"];


if( $_POST["baja_persona"] == '1') {$t1_baja = "1"; }else{ $t1_baja = "0"; }
$persona_baja_resolucion = $_POST["baja_resolucion"];

$persona_baja_res_alta = $_POST["baja_res_alta"];

$persona_baja_obs = $_POST["persona_baja_obs"];

$familia_nro = $_POST["Familia_nro"];


// Insert de titular 1

$upd = "UPDATE dbo_persona SET
	Persona_apellido = '$t1_apellido',
	Persona_nombre = '$t1_nombre',
	Documento_tipo_nro = '$t1_doc_tipo',
	Persona_dni_nro = '$t1_doc_nro',
	Estado_civil_nro = '$t1_ecivil',
	Ecivil_sep_hecho = '$t1_sep_hecho',
	Persona_lugar_nac = '$t1_lugar_nac',
	Persona_fecha_nac = '$t1_fecha_nac',
	Persona_nacionalidad = '$t1_nacionalidad',
	Persona_conyuge_apellido = '$t1_conyuge_apellido',
	Persona_conyuge_nombre = '$t1_conyuge_nombre',
	Persona_padre_nombrecompleto = '$t1_padre_nmbcompleto',
	Persona_madre_nombrecompleto = '$t1_madre_nmbcompleto',
	Persona_telefono = '$t1_telefono',
	Persona_baja = '$t1_baja',
	Persona_baja_resolucion = '$persona_baja_resolucion',
	Persona_baja_res_alta = '$persona_baja_res_alta',
	Persona_baja_obs = '$persona_baja_obs',
	Persona_baja_usuario = '$log_usuario'
	where Persona_nro = '$persona_nro'";
	
	if (mysql_query($upd,$link))
	{ 

if($_POST["baja_persona_nuevoalta"] == '1') {

$ins = "INSERT INTO dbo_persona (
		Persona_apellido,
		Persona_nombre,
		Documento_tipo_nro,
		Persona_dni_nro,
		Estado_civil_nro,
		Ecivil_sep_hecho,
		Persona_lugar_nac,
		Persona_fecha_nac,
		Persona_nacionalidad,
		Persona_conyuge_apellido,
		Persona_conyuge_nombre,
		Persona_padre_nombrecompleto,
		Persona_madre_nombrecompleto,
		Persona_telefono,
		Persona_alta_fecha,
		Persona_alta_usuario,
		Familia_nro
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
		'$t1_conyuge_apellido',
		'$t1_conyuge_nombre',
		'$t1_padre_nmbcompleto',
		'$t1_madre_nmbcompleto',
		'$t1_telefono',
		CURRENT_DATE,
		'$log_usuario',
		'$familia_nro')";

$res = mysql_query($ins);


}


	?>
		<h2>Beneficiario actualizado correctamente (<?=$_POST["baja_persona_nuevoalta"]; ?> - <?=$familia_nro; ?>)</h2>
		<p><a href="<?=$origen; ?>?idFamilia=<?=$familia_nro; ?>">Volver al informe</a>

<? } else { ?>

<h2>No se pudo actualizar la informaci&oacute;n</h2>
		<p><a href="<?=$origen; ?>?idFamilia=<?=$familia_nro; ?>">Volver al informe</a></p>
<p>&nbsp;</p>
<? } ?>
<? } ?>



