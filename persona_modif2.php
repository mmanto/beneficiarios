<? session_start();

if (!isset($_SESSION["user_id"])) {

   header("Location: expired.php");
    
} else{

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$idFicha = $_POST["idFicha"];
$idPersona = $_POST["idPersona"];

/*
$ficha_num = $_POST["ficha_num"];
$ficha_zona = $_POST["ficha_zona"];
$ficha_manzana = $_POST["ficha_manzana"];
$ficha_parcela = $_POST["ficha_parcela"];
$ficha_calle = $_POST["ficha_calle"];
$ficha_vivnum = $_POST["ficha_vivnum"];
$ficha_telefono = $_POST["ficha_telefono"];
$ficha_refcarto = $_POST["ficha_refcarto"];
$ficha_censista = $_POST["ficha_censista"];
$ficha_fecha = $_POST["ficha_fecha"];
$entefectiva = $_POST["entefectiva"];
$noentefectiva_motivo = $_POST["noentefectiva_motivo"];
$ficha_cantviviendas = $_POST["ficha_cantviviendas"];
$ficha_letra = $_POST["ficha_letra"];
$ficha_canthogares = $_POST["ficha_canthogares"];
$ficha_hogar_num = $_POST["ficha_hogar_num"];
$ficha_p4 = $_POST["ficha_p4"];
$ficha_p5 = $_POST["ficha_p5"];
$ficha_p6 = $_POST["ficha_p6"];
$ficha_p7 = $_POST["ficha_p7"];
$ficha_p8 = $_POST["ficha_p8"];
$ficha_p9 = $_POST["ficha_p9"];
$ficha_p10 = $_POST["ficha_p10"];
$ficha_p11 = $_POST["ficha_p11"];
$ficha_p12 = $_POST["ficha_p12"];
$ficha_p13 = $_POST["ficha_p13"];
$ficha_p14 = $_POST["ficha_p14"];
$ficha_p15 = $_POST["ficha_p15"];
$ficha_p16 = $_POST["ficha_p16"];
$ficha_p17_1 = $_POST["ficha_p17_1"];
$ficha_p17_1_detalle = $_POST["ficha_p17_1_detalle"];
$ficha_p17_2 = $_POST["ficha_p17_2"];
$ficha_p17_2_detalle = $_POST["ficha_p17_2_detalle"];
$ficha_p18 = $_POST["ficha_p18"];
$ficha_p19 = $_POST["ficha_p19"];
$ficha_p20 = $_POST["ficha_p20"];
$ficha_p21 = $_POST["ficha_p21"];
$ficha_p22 = $_POST["ficha_p22"];
if ($_POST["ficha_p23_1"] != '1') {$ficha_p23_1 = '2';}else{ $ficha_p23_1 = $_POST["ficha_p23_1"];}
if ($_POST["ficha_p23_2"] != '1') {$ficha_p23_2 = '2';}else{ $ficha_p23_2 = $_POST["ficha_p23_2"];}
if ($_POST["ficha_p23_2"] != '1') {$ficha_p23_3 = '2';}else{ $ficha_p23_3 = $_POST["ficha_p23_3"];}
if ($_POST["ficha_p23_2"] != '1') {$ficha_p23_4 = '2';}else{ $ficha_p23_4 = $_POST["ficha_p23_4"];}
$ficha_p23_4_detalle = $_POST["ficha_p23_4_detalle"];
$ficha_p24 = $_POST["ficha_p24"];

if ($_POST["ficha_p25_1"] != '1') {$ficha_p25_1 = '2';}else{ $ficha_p25_1 = $_POST["ficha_p25_1"];}
if ($_POST["ficha_p25_2"] != '1') {$ficha_p25_2 = '2';}else{ $ficha_p25_2 = $_POST["ficha_p25_2"];}
if ($_POST["ficha_p25_3"] != '1') {$ficha_p25_3 = '2';}else{ $ficha_p25_3 = $_POST["ficha_p25_3"];}
if ($_POST["ficha_p25_4"] != '1') {$ficha_p25_4 = '2';}else{ $ficha_p25_4 = $_POST["ficha_p25_4"];}

$ficha_p25_4_detalle = $_POST["ficha_p25_4_detalle"];
$ficha_p26 = $_POST["ficha_p26"];
$ficha_p27 = $_POST["ficha_p27"];
$ficha_p28 = $_POST["ficha_p28"];
$ficha_p29 = $_POST["ficha_p29"];
$ficha_p30_1 = $_POST["ficha_p30_1"];
$ficha_p30_2 = $_POST["ficha_p30_2"];
$ficha_p30_3 = $_POST["ficha_p30_3"];
$ficha_p31 = $_POST["ficha_p31"];
$ficha_p32 = $_POST["ficha_p32"];
$ficha_p33 = $_POST["ficha_p33"];
$ficha_p34 = $_POST["ficha_p34"];
$ficha_p35 = $_POST["ficha_p35"];
$ficha_observaciones = $_POST["ficha_observaciones"];
*/

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


$upd = "UPDATE dbo_persona SET
		Persona_apellido = '$t1_apellido',
		Persona_nombre = '$t1_nombre',
		Persona_dni_nro = '$t1_doc_nro',
		Persona_dni_obs = '$t1_doc_obs',
		Persona_parentesco = '$t1_parentesco',
		Persona_edad = '$t1_edad',
		Persona_sexo_int = '$t1_sexo',
		Persona_nacionalidad_int = '$t1_nacion',
		Persona_asisteEE = '$t1_asisteEE',
		Persona_educ_nivel = '$t1_nivel',
		Persona_educ_grado = '$t1_grado',
		Persona_sit_ocup = '$t1_sit_ocup',
		Persona_oficio = '$t1_oficio',
		Persona_modif_fecha = CURRENT_DATE,
		Persona_modif_usuario = '$idUsuario'
		WHERE Persona_nro = $idPersona";
	
	if (mysql_query($upd,$link))
	{ ?>
		<h2>Ficha actualizada correctamente</h2>
		<p><a href="ficha_informe.php?idFicha=<?=$idFicha; ?>">Volver a la ficha</a></p>

<? } else { ?>

		<h2>No se pudo actualizar la ficha. Contacte al administrador</h2>
		<p><a href="ficha_informe.php?idFicha=<?=$idFicha; ?>">Volver a la ficha</a></p>
<p>&nbsp;</p>
<? }} ?>
