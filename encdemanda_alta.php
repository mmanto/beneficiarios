<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");


//Definicion tablas
$tabla_persona = "dbo_persona";
//

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$direccion = $user["Direccion_nro"];



//$idProyecto = '1';
$idProyecto = $_POST["idProyecto"];


$sqlPr = mysql_query("SELECT Partido_nro FROM dbo_proyecto WHERE Proyecto_nro = $idProyecto");
$proyecto = mysql_fetch_array($sqlPr);
$partido_nro = $proyecto["Partido_nro"];



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




$insFicha = "INSERT INTO dbo_ficha (
		Partido_nro,
		Proyecto_nro,
		ficha_num,
		ficha_zona,
		ficha_lote_manzana,
		ficha_lote_parcela,
		ficha_lote_calle,
		ficha_lote_num,
		ficha_telefono,
		ficha_refcarto,
		ficha_censista,
		ficha_fecha,
		ficha_ent_efect,
		ficha_ent_efect_neg_motivo,
		ficha_viviendas_cant,
		ficha_letra,
		ficha_hogares_cant,
		ficha_hogar_num,
		ficha_p4,
		ficha_p5,
		ficha_p6,
		ficha_p7,
		ficha_p8,
		ficha_p9,
		ficha_p10,
		ficha_p11,
		ficha_p12,
		ficha_p13,
		ficha_p14,
		ficha_p15,
		ficha_p16,
		ficha_p17_1,
		ficha_p17_1_detalle,
		ficha_p17_2,
		ficha_p17_2_detalle,
		ficha_p18,
		ficha_p19,
		ficha_p20,
		ficha_p21,
		ficha_p22,
		ficha_p23_1,
		ficha_p23_2,
		ficha_p23_3,
		ficha_p23_4,
		ficha_p23_4_detalle, 
		ficha_p24,
		ficha_p25_1,
		ficha_p25_2,
		ficha_p25_3,
		ficha_p25_4,
		ficha_p25_4_detalle,
		ficha_p26,
		ficha_p27,
		ficha_p28,
		ficha_p29,
		ficha_p30_1,
		ficha_p30_2,
		ficha_p30_3,
		ficha_p31,
		ficha_p32,
		ficha_p33, 
		ficha_p34,
		ficha_p35,
		ficha_observaciones,
		insert_fecha,
		insert_usuario
		)VALUES(
		'$partido_nro',
		'$idProyecto',
		'$ficha_num',
		'$ficha_zona',
		'$ficha_manzana',
		'$ficha_parcela',
		'$ficha_calle',
		'$ficha_vivnum', 
		'$ficha_telefono',
		'$ficha_refcarto',
		'$ficha_censista',
		'$ficha_fecha',
		'$entefectiva',
		'$noentefectiva_motivo',
		'$ficha_cantviviendas',
		'$ficha_letra',
		'$ficha_canthogares',
		'$ficha_hogar_num',
		'$ficha_p4',
		'$ficha_p5',
		'$ficha_p6',
		'$ficha_p7',
		'$ficha_p8',
		'$ficha_p9',
		'$ficha_p10',
		'$ficha_p11',
		'$ficha_p12',
		'$ficha_p13',
		'$ficha_p14',
		'$ficha_p15',
		'$ficha_p16',
		'$ficha_p17_1',
		'$ficha_p17_1_detalle',
		'$ficha_p17_2',
		'$ficha_p17_2_detalle',
		'$ficha_p18',
		'$ficha_p19',
		'$ficha_p20',
		'$ficha_p21',
		'$ficha_p22',
		'$ficha_p23_1',
		'$ficha_p23_2',
		'$ficha_p23_3',
		'$ficha_p23_4',
		'$ficha_p23_4_detalle', 
		'$ficha_p24',
		'$ficha_p25_1',
		'$ficha_p25_2',
		'$ficha_p25_3',
		'$ficha_p25_4',
		'$ficha_p25_4_detalle',
		'$ficha_p26',
		'$ficha_p27',
		'$ficha_p28',
		'$ficha_p29',
		'$ficha_p30_1',
		'$ficha_p30_2',
		'$ficha_p30_3', 
		'$ficha_p31',
		'$ficha_p32', 
		'$ficha_p33',
		'$ficha_p34',
		'$ficha_p35',
		'$ficha_observaciones',
		CURRENT_DATE,
		'$log_usuario')";
		if (mysql_query($insFicha,$link)) {
		$ficha_nro = mysql_insert_id();
		
		
		$inst1 = "INSERT INTO $tabla_persona (
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
				'$ficha_nro')";
				mysql_query($inst1,$link);

$cant = '1';


//Persona 2

if ($_POST["t2_doc_nro"]!='0') {
$t2_apellido = $_POST["t2_apellido"];
$t2_nombre = $_POST["t2_nombre"];
$t2_doc_nro = $_POST["t2_doc_nro"];
$t2_doc_obs = $_POST["t2_doc_obs"];
$t2_parentesco = $_POST["t2_parentesco"];
$t2_edad = $_POST["t2_edad"];
$t2_sexo = $_POST["t2_sexo"];
$t2_nacion = $_POST["t2_nacion"];
$t2_asisteEE = $_POST["t2_asisteEE"];
$t2_nivel = $_POST["t2_nivel"];
$t2_grado = $_POST["t2_grado"];
$t2_sit_ocup = $_POST["t2_sit_ocup"];
$t2_oficio = $_POST["t2_oficio"];

$inst2 = "INSERT INTO $tabla_persona (
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
				'$t2_apellido',
				'$t2_nombre',
				'1',
				'$t2_doc_nro',
				'$t2_doc_obs',
				'$t2_parentesco',
				'$t2_edad',
				'$t2_sexo',
				'$t2_nacion',
				'$t2_asisteEE',
				'$t2_nivel',
				'$t2_grado',
				'$t2_sit_ocup',
				'$t2_oficio',
				CURRENT_DATE,
				'$log_usuario',
				'$ficha_nro')";
				mysql_query($inst2,$link);
				$cant++;				
				}		

//Persona 3		
		
if ($_POST["t3_doc_nro"]!='0') {
$t3_apellido = $_POST["t3_apellido"];
$t3_nombre = $_POST["t3_nombre"];
$t3_doc_nro = $_POST["t3_doc_nro"];
$t3_doc_obs = $_POST["t3_doc_obs"];
$t3_parentesco = $_POST["t3_parentesco"];
$t3_edad = $_POST["t3_edad"];
$t3_sexo = $_POST["t3_sexo"];
$t3_nacion = $_POST["t3_nacion"];
$t3_asisteEE = $_POST["t3_asisteEE"];
$t3_nivel = $_POST["t3_nivel"];
$t3_grado = $_POST["t3_grado"];
$t3_sit_ocup = $_POST["t3_sit_ocup"];
$t3_oficio = $_POST["t3_oficio"];

$inst3 = "INSERT INTO $tabla_persona (
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
				'$t3_apellido',
				'$t3_nombre',
				'1',
				'$t3_doc_nro',
				'$t3_doc_obs',
				'$t3_parentesco',
				'$t3_edad',
				'$t3_sexo',
				'$t3_nacion',
				'$t3_asisteEE',
				'$t3_nivel',
				'$t3_grado',
				'$t3_sit_ocup',
				'$t3_oficio',
				CURRENT_DATE,
				'$log_usuario',
				'$ficha_nro')";
				mysql_query($inst3,$link);
				$cant++;
				}

//Persona 4		
		
if ($_POST["t4_doc_nro"]!='0') {
$t4_apellido = $_POST["t4_apellido"];
$t4_nombre = $_POST["t4_nombre"];
$t4_doc_nro = $_POST["t4_doc_nro"];
$t4_doc_obs = $_POST["t4_doc_obs"];
$t4_parentesco = $_POST["t4_parentesco"];
$t4_edad = $_POST["t4_edad"];
$t4_sexo = $_POST["t4_sexo"];
$t4_nacion = $_POST["t4_nacion"];
$t4_asisteEE = $_POST["t4_asisteEE"];
$t4_nivel = $_POST["t4_nivel"];
$t4_grado = $_POST["t4_grado"];
$t4_sit_ocup = $_POST["t4_sit_ocup"];
$t4_oficio = $_POST["t4_oficio"];

$inst4 = "INSERT INTO $tabla_persona (
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
				'$t4_apellido',
				'$t4_nombre',
				'1',
				'$t4_doc_nro',
				'$t4_doc_obs',
				'$t4_parentesco',
				'$t4_edad',
				'$t4_sexo',
				'$t4_nacion',
				'$t4_asisteEE',
				'$t4_nivel',
				'$t4_grado',
				'$t4_sit_ocup',
				'$t4_oficio',
				CURRENT_DATE,
				'$log_usuario',
				'$ficha_nro')";
				mysql_query($inst4,$link);
				$cant++;
				}

//Persona 5		
		
if ($_POST["t5_doc_nro"]!='0') {
$t5_apellido = $_POST["t5_apellido"];
$t5_nombre = $_POST["t5_nombre"];
$t5_doc_nro = $_POST["t5_doc_nro"];
$t5_doc_obs = $_POST["t5_doc_obs"];
$t5_parentesco = $_POST["t5_parentesco"];
$t5_edad = $_POST["t5_edad"];
$t5_sexo = $_POST["t5_sexo"];
$t5_nacion = $_POST["t5_nacion"];
$t5_asisteEE = $_POST["t5_asisteEE"];
$t5_nivel = $_POST["t5_nivel"];
$t5_grado = $_POST["t5_grado"];
$t5_sit_ocup = $_POST["t5_sit_ocup"];
$t5_oficio = $_POST["t5_oficio"];

$inst5 = "INSERT INTO $tabla_persona (
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
				ficha_nro
				)VALUES(
				'$t5_apellido',
				'$t5_nombre',
				'1',
				'$t5_doc_nro',
				'$t5_doc_obs',
				'$t5_parentesco',
				'$t5_edad',
				'$t5_sexo',
				'$t5_nacion',
				'$t5_asisteEE',
				'$t5_nivel',
				'$t5_grado',
				'$t5_sit_ocup',
				'$t5_oficio',
				CURRENT_DATE,
				'$log_usuario',
				'$ficha_nro')";
				mysql_query($inst5,$link);
				$cant++;
				}		

/////////////////

//Persona 6		
		
if ($_POST["t6_doc_nro"]!='0') {
$t6_apellido = $_POST["t6_apellido"];
$t6_nombre = $_POST["t6_nombre"];
$t6_doc_nro = $_POST["t6_doc_nro"];
$t6_doc_obs = $_POST["t6_doc_obs"];
$t6_parentesco = $_POST["t6_parentesco"];
$t6_edad = $_POST["t6_edad"];
$t6_sexo = $_POST["t6_sexo"];
$t6_nacion = $_POST["t6_nacion"];
$t6_asisteEE = $_POST["t6_asisteEE"];
$t6_nivel = $_POST["t6_nivel"];
$t6_grado = $_POST["t6_grado"];
$t6_sit_ocup = $_POST["t6_sit_ocup"];
$t6_oficio = $_POST["t6_oficio"];

$inst6 = "INSERT INTO $tabla_persona (
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
				ficha_nro
				)VALUES(
				'$t6_apellido',
				'$t6_nombre',
				'1',
				'$t6_doc_nro',
				'$t6_doc_obs',
				'$t6_parentesco',
				'$t6_edad',
				'$t6_sexo',
				'$t6_nacion',
				'$t6_asisteEE',
				'$t6_nivel',
				'$t6_grado',
				'$t6_sit_ocup',
				'$t6_oficio',
				CURRENT_DATE,
				'$log_usuario',
				'$ficha_nro')";
				mysql_query($inst6,$link);
				$cant++;
				}

//Persona 7		
		
if ($_POST["t7_doc_nro"]!='0') {
$t7_apellido = $_POST["t7_apellido"];
$t7_nombre = $_POST["t7_nombre"];
$t7_doc_nro = $_POST["t7_doc_nro"];
$t7_doc_obs = $_POST["t7_doc_obs"];
$t7_parentesco = $_POST["t7_parentesco"];
$t7_edad = $_POST["t7_edad"];
$t7_sexo = $_POST["t7_sexo"];
$t7_nacion = $_POST["t7_nacion"];
$t7_asisteEE = $_POST["t7_asisteEE"];
$t7_nivel = $_POST["t7_nivel"];
$t7_grado = $_POST["t7_grado"];
$t7_sit_ocup = $_POST["t7_sit_ocup"];
$t7_oficio = $_POST["t7_oficio"];

$inst7 = "INSERT INTO $tabla_persona (
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
				ficha_nro
				)VALUES(
				'$t7_apellido',
				'$t7_nombre',
				'1',
				'$t7_doc_nro',
				'$t7_doc_obs',
				'$t7_parentesco',
				'$t7_edad',
				'$t7_sexo',
				'$t7_nacion',
				'$t7_asisteEE',
				'$t7_nivel',
				'$t7_grado',
				'$t7_sit_ocup',
				'$t7_oficio',
				CURRENT_DATE,
				'$log_usuario',
				'$ficha_nro')";
				mysql_query($inst7,$link);
				$cant++;
				}
//Persona 8		
		
if ($_POST["t8_doc_nro"]!='0') {
$t8_apellido = $_POST["t8_apellido"];
$t8_nombre = $_POST["t8_nombre"];
$t8_doc_nro = $_POST["t8_doc_nro"];
$t8_doc_obs = $_POST["t8_doc_obs"];
$t8_parentesco = $_POST["t8_parentesco"];
$t8_edad = $_POST["t8_edad"];
$t8_sexo = $_POST["t8_sexo"];
$t8_nacion = $_POST["t8_nacion"];
$t8_asisteEE = $_POST["t8_asisteEE"];
$t8_nivel = $_POST["t8_nivel"];
$t8_grado = $_POST["t8_grado"];
$t8_sit_ocup = $_POST["t8_sit_ocup"];
$t8_oficio = $_POST["t8_oficio"];

$inst8 = "INSERT INTO $tabla_persona (
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
				ficha_nro
				)VALUES(
				'$t8_apellido',
				'$t8_nombre',
				'1',
				'$t8_doc_nro',
				'$t8_doc_obs',
				'$t8_parentesco',
				'$t8_edad',
				'$t8_sexo',
				'$t8_nacion',
				'$t8_asisteEE',
				'$t8_nivel',
				'$t8_grado',
				'$t8_sit_ocup',
				'$t8_oficio',
				CURRENT_DATE,
				'$log_usuario',
				'$ficha_nro')";
				mysql_query($inst8,$link);
				$cant++;
				}
//Persona 9			
		
if ($_POST["t9_doc_nro"]!='0') {
$t9_apellido = $_POST["t9_apellido"];
$t9_nombre = $_POST["t9_nombre"];
$t9_doc_nro = $_POST["t9_doc_nro"];
$t9_doc_obs = $_POST["t9_doc_obs"];
$t9_parentesco = $_POST["t9_parentesco"];
$t9_edad = $_POST["t9_edad"];
$t9_sexo = $_POST["t9_sexo"];
$t9_nacion = $_POST["t9_nacion"];
$t9_asisteEE = $_POST["t9_asisteEE"];
$t9_nivel = $_POST["t9_nivel"];
$t9_grado = $_POST["t9_grado"];
$t9_sit_ocup = $_POST["t9_sit_ocup"];
$t9_oficio = $_POST["t9_oficio"];

$inst9 = "INSERT INTO $tabla_persona (
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
				ficha_nro
				)VALUES(
				'$t9_apellido',
				'$t9_nombre',
				'1',
				'$t9_doc_nro',
				'$t9_doc_obs',
				'$t9_parentesco',
				'$t9_edad',
				'$t9_sexo',
				'$t9_nacion',
				'$t9_asisteEE',
				'$t9_nivel',
				'$t9_grado',
				'$t9_sit_ocup',
				'$t9_oficio',
				CURRENT_DATE,
				'$log_usuario',
				'$ficha_nro')";
				mysql_query($inst9,$link);
				$cant++;
				}
//Persona 10		
		
if ($_POST["t10_doc_nro"]!='0') {
$t10_apellido = $_POST["t10_apellido"];
$t10_nombre = $_POST["t10_nombre"];
$t10_doc_nro = $_POST["t10_doc_nro"];
$t10_doc_obs = $_POST["t10_doc_obs"];
$t10_parentesco = $_POST["t10_parentesco"];
$t10_edad = $_POST["t10_edad"];
$t10_sexo = $_POST["t10_sexo"];
$t10_nacion = $_POST["t10_nacion"];
$t10_asisteEE = $_POST["t10_asisteEE"];
$t10_nivel = $_POST["t10_nivel"];
$t10_grado = $_POST["t10_grado"];
$t10_sit_ocup = $_POST["t10_sit_ocup"];
$t10_oficio = $_POST["t10_oficio"];

$inst10 = "INSERT INTO $tabla_persona (
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
				ficha_nro
				)VALUES(
				'$t10_apellido',
				'$t10_nombre',
				'1',
				'$t10_doc_nro',
				'$t10_doc_obs',
				'$t10_parentesco',
				'$t10_edad',
				'$t10_sexo',
				'$t10_nacion',
				'$t10_asisteEE',
				'$t10_nivel',
				'$t10_grado',
				'$t10_sit_ocup',
				'$t10_oficio',
				CURRENT_DATE,
				'$log_usuario',
				'$ficha_nro')";
				mysql_query($inst10,$link);
				$cant++;
				}

$upd =	"UPDATE dbo_ficha SET
		ficha_miembros_cant = '$cant'
		WHERE ficha_nro = $ficha_nro";

mysql_query($upd);

			
?>				
<h2>Ficha cargada correctamente</h2> 
<? 		


}else{"<h2>No se pudo realizar el alta de ficha</h2><p>Por favor contacte al administrador</p>"; }

?>
<p><a href="encdemanda_alta_form.php?idProyecto=<? echo $idProyecto; ?>&zona=<? echo $ficha_zona; ?>">Cargar otra ficha para este mismo proyecto y zona</a></p>
<p><a href="zonas-listar.php?idProyecto=<? echo $idProyecto; ?>">Volver al menu</a></p>
<? 

		
} ?>