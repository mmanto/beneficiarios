<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{
	
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");	

$idFicha = $_POST["idFicha"];

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];

//Variables persona 1
$t1_apellido = $_POST["t1_apellido"];
$t1_nombre = $_POST["t1_nombre"];
$t1_doc_nro = $_POST["t1_doc_nro"];
$t1_doc_obs = $_POST["t1_doc_obs"];
$t1_parentesco = $_POST["t1_parentesco"];
$t1_edad = $_POST["t1_edad"];
$t1_sexo = $_POST["t1_sexo"];
$t1_nacion = $_POST["t1_nacion"];
$t1_asisteEE = $_POST["t1_asisteEE"];
$t1_nivel = $_POST["t1_nivel"];
$t1_grado = $_POST["t1_grado"];
$t1_sit_ocup = $_POST["t1_sit_ocup"];
$t1_oficio = $_POST["t1_oficio"];

$inst1 = "INSERT INTO dbo_persona (
				Persona_apellido,
				Persona_nombre,
				Documento_tipo_nro,
				Persona_dni_nro,
				Persona_dni_obs,
				Persona_parentesco,
				Persona_edad,
				Persona_sexo_int,
				Persona_nacionalidad_int,
				Persona_asisteEE,
				Persona_educ_nivel,
				Persona_educ_grado,
				Persona_sit_ocup,
				Persona_oficio,
				Persona_alta_fecha,
				Persona_alta_usuario,
				Ficha_nro
				)VALUES(
				'$t1_apellido',
				'$t1_nombre',
				'1',
				'$t1_doc_nro',
				'$t1_doc_obs',
				'$t1_parentesco',
				'$t1_edad',
				'$t1_sexo',
				'$t1_nacion',
				'$t1_asisteEE',
				'$t1_nivel',
				'$t1_grado',
				'$t1_sit_ocup',
				'$t1_oficio',
				CURRENT_DATE,
				'$log_usuario',
				'$idFicha')";
				
				
if(mysql_query($inst1,$link)) { ?>

<h2>La persona ha sido agregada a la ficha</h2>
<p><a href="ficha_informe.php?idFicha=<?=$idFicha; ?>">Volver a la ficha</a></p>



<? }else{ ?>

<h2>No se pudo dar de alta a la persona. Por favor contacte al administrador</h2>
<p><a href="ficha_informe.php?idFicha=<?=$idFicha; ?>">Volver a la ficha</a></p>

<? } 

include("pie.php");
} ?>
