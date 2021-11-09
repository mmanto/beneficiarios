<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");


//////////////////////////////////////////////

// Definición nombres de tablas

     $dbo_tabla_lote = "dbo_lote";
	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";
	 $dbo_tabla_escritura = "dbo_escritura";

//////////////////////////////////////////////

if (!$_POST["t1_doc_nro"]) {
?>
<h2>No ha ingresado un numero de documento. Por favor, indique uno</h2>
<h4><a href="javascript:history.go(-1)">Volver al formulario</a></h4>
<?
}else{

if ($_POST["t1_doc_nro"]== $_POST["t2_doc_nro"]) {
?>
<h2>No ha ingresado un numero de documento. Por favor, indique uno</h2>
<h4><a href="javascript:history.go(-1)">Volver al formulario</a></h4>
<?
}else{

//////////// --> Definicion de variables

// Defino las variables de lote y encuesta

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];

//$log_usuario = $_POST["idUsuario"];
//$log_direccion = $_POST["idDireccion"];
//$log_nivel = $_POST["user_nivel"];

$direccion_nro = $user["Direccion_nro"];

//$encuesta_fecha = $_POST["encuesta_fecha"];

//$fechamysql = cambiaf_a_mysql($encuesta_fecha);

//$familia_programa = $_POST["Familia_programa"]; //Programa

//$familia_res_ivba = $_POST["res_ivba"]; //Resolucion IVBA

// if ($familia_resolucion == 0) { //Si la resolucion está vacia, carga los valores que devuelve el formulario.

$partido = $_POST["idPartido"];
//if (!$_POST["lote_barrio"]) {$lote_barrio = '0';} else {$lote_barrio = $_POST["lote_barrio"];};
if (!$_POST["lote_circ"] || $_POST["lote_circ"]=='-') {$lote_circ = '0';} else {$lote_circ = $_POST["lote_circ"];};
if (!$_POST["lote_secc"] || $_POST["lote_secc"]=='-') {$lote_secc = '0';} else {$lote_secc = $_POST["lote_secc"];};
//$lote_resolucion = '0';

/*
} else { //Si está seleccionada alguna resolucion, carga los valores que devuelve la consulta SQL

	$strSQL4 = "SELECT * FROM dbo_resolucion WHERE idResolucion = $familia_resolucion";
	$resol = mysql_query ($strSQL4);
	$resolucion = mysql_fetch_array($resol);
	
	$partido = $resolucion["Resolucion_partido"];
	$lote_barrio = $resolucion["Resolucion_barrio"];
	$lote_circ = $resolucion["Resolucion_circ"];
	$lote_secc = $resolucion["Resolucion_secc"];
	$lote_resolucion = $resolucion["Resolucion_nombre"];
	
	} */

if (!$partido) {
?>
<h2>No ha seleccionado un partido. Por favor, seleccione uno</h2>
<h4><a href="javascript:history.go(-1)">Volver al formulario</a></h4>
<?
}else{


if (!$_POST["lote_localidad"]) {$lote_localidad ='0';} else {$lote_localidad = $_POST["lote_localidad"];};
if (!$_POST["lote_ch"] || $_POST["lote_ch"]=='-') {$lote_ch = '0';} else {$lote_ch = $_POST["lote_ch"];};
if (!$_POST["lote_qta"] || $_POST["lote_qta"]=='-') {$lote_qta = '0';} else {$lote_qta = $_POST["lote_qta"];};
if (!$_POST["lote_fracc"] || $_POST["lote_fracc"]=='-') {$lote_fracc = '0';} else {$lote_fracc = $_POST["lote_fracc"];};
if (!$_POST["lote_manzana"] || $_POST["lote_manzana"]=='-') {$lote_manzana = '0';} else {$lote_manzana = $_POST["lote_manzana"];};
if (!$_POST["lote_parcela"] || $_POST["lote_parcela"]=='-') {$lote_parcela = '0';} else {$lote_parcela = $_POST["lote_parcela"];};
if (!$_POST["lote_subpc"] || $_POST["lote_subpc"]=='-') {$lote_subpc = '0';} else {$lote_subpc = $_POST["lote_subpc"];};
if (!$_POST["lote_partida"] || $_POST["lote_partida"]=='-') {$lote_partida = '0';} else {$lote_partida = $_POST["lote_partida"];};


////////////////////////////////////////////
/////// Inherentes a valor del lote ////////
////////////////////////////////////////////
/*
$lote_superficie = $_POST["lote_superficie"];
$lote_valor_m2 = $_POST["lote_valor_m2"];
$lote_valor_mensura = $_POST["lote_valor_mensura"];
$lote_valor_sup = $lote_superficie*$lote_valor_m2;
$lote_valor_total = $lote_valor_sup + $lote_valor_mensura;
$lote_valor_total = redondear_dos_decimal($lote_valor_total);
if ($_POST["lote_cant_cuotas"] < 1) {$lote_cant_cuotas = 1;}else{$lote_cant_cuotas = $_POST["lote_cant_cuotas"];};
$cant_cuotas_enteras = $lote_cant_cuotas - 1;
$cuota_original = $lote_valor_total/$lote_cant_cuotas;
$lote_valor_cuota_entera = redondear_dos_decimal($cuota_original);
$suma_cuota_enteras = $lote_valor_cuota_entera*$cant_cuotas_enteras;
$lote_valor_ultima_cuota = $lote_valor_total - $suma_cuota_enteras;
*/
////////////////////////////////////////////////
///////////////////////////////////////////////

//$familia_observaciones = $_POST["familia_observaciones"];
//$familia_domic = $_POST["Familia_domic"];
//$familia_domic_edificio = $_POST["Familia_domic_edificio"];
//$familia_domic_sector = $_POST["Familia_domic_sector"];
//$familia_domic_piso = $_POST["Familia_domic_piso"];
//$familia_domic_depto = $_POST["Familia_domic_depto"];
//$familia_casa_num = $_POST["Familia_casa_num"];
//$familia_telefono = $_POST["Familia_telefono"];
//$familia_domic_monoblock = $_POST["Familia_domic_monoblock"];
//$familia_domic_escalera = $_POST["Familia_domic_escalera"];


//Definicion de variables de persona 1
$t1_apellido = $_POST["t1_apellido"];
$t1_nombre = $_POST["t1_nombre"];
//$t1_fecha_nac_dia = $_POST["t1_fecha_nac_dia"];
//$t1_fecha_nac_mes = $_POST["t1_fecha_nac_mes"];
//$t1_fecha_nac_anio = $_POST["t1_fecha_nac_anio"];
//$t1_fecha_nac = "$t1_fecha_nac_dia-$t1_fecha_nac_mes-$t1_fecha_nac_anio";
//$t1_edad = $_POST["t1_edad"];
//$t1_lugar_nac = $_POST["t1_lugar_nac"];
//$t1_sexo = $_POST["t1_sexo"];
//$t1_nacionalidad = $_POST["t1_nacionalidad"];
$t1_doc_tipo = $_POST["t1_doc_tipo"];
$t1_doc_nro = $_POST["t1_doc_nro"];
//$t1_cuil = $_POST["t1_cuil"];
//$t1_ingresos = $_POST["t1_ingresos"];
//$t1_domicilio = $_POST["t1_domicilio"];
//$t1_ecivil = $_POST["t1_ecivil"];
//$t1_nupcias = $_POST["t1_nupcias"];
//$t1_fechasep = $_POST["t1_fechasep"];
//$t1_conyuge_apellido = $_POST["t1_conyuge_apellido"];
//$t1_conyuge_nombre = $_POST["t1_conyuge_nombre"];
//$t1_padre_apellido = $_POST["t1_padre_apellido"];
//$t1_padre_nombre = $_POST["t1_padre_nombre"];
//$t1_padre_vive = $_POST["t1_padre_vive"];
//$t1_padre_doctipo = $_POST["t1_padre_doctipo"];
//$t1_padre_doc = $_POST["t1_padre_doc"];
//$t1_madre_apellido = $_POST["t1_madre_apellido"];
//$t1_madre_nombre = $_POST["t1_madre_nombre"];
//$t1_madre_vive = $_POST["t1_madre_vive"];
//$t1_madre_doctipo = $_POST["t1_madre_doctipo"];
//$t1_madre_doc = $_POST["t1_madre_doc"];
//$t1_renuncia = $_POST["t1_renuncia"];
//$t1_sitlaboral = $_POST["t1_sitlaboral"];
//$t1_lugar_trabajo = $_POST["t1_lugar_trabajo"];
//$t1_oficio = $_POST["t1_oficio"];
//$t1_vinculo_t2 = $_POST["t1_vinculo_t2"];
//$t1_resid = $_POST["t1_resid"];
//$t1_resid_anterior = $_POST["t1_resid_anterior"];

//Definicion de variables de persona 2

$t2_apellido = $_POST["t2_apellido"];
$t2_nombre = $_POST["t2_nombre"];
//$t2_fecha_nac_dia = $_POST["t2_fecha_nac_dia"];
//$t2_fecha_nac_mes = $_POST["t2_fecha_nac_mes"];
//$t2_fecha_nac_anio = $_POST["t2_fecha_nac_anio"];
//$t2_fecha_nac = "$t2_fecha_nac_dia-$t2_fecha_nac_mes-$t2_fecha_nac_anio";



//$t2_edad = $_POST["t2_edad"];
//$t2_lugar_nac = $_POST["t2_lugar_nac"];
//$t2_sexo = $_POST["t2_sexo"];
//$t2_nacionalidad = $_POST["t2_nacionalidad"];
$t2_doc_tipo = $_POST["t2_doc_tipo"];

if (!$_POST["t2_doc_nro"]) {$t2_doc_nro = '0'; }else{ $t2_doc_nro = $_POST["t2_doc_nro"];};

//$t2_cuil = $_POST["t2_cuil"];

//$t2_ingresos = $_POST["t2_ingresos"];

//$t2_domicilio = $_POST["t2_domicilio"];
//$t2_ecivil = $_POST["t2_ecivil"];
//$t2_nupcias = $_POST["t2_nupcias"];
//$t2_fechasep = $_POST["t2_fechasep"];
//$t2_conyuge_apellido = $_POST["t2_conyuge_apellido"];
//$t2_conyuge_nombre = $_POST["t2_conyuge_nombre"];
//$t2_padre_apellido = $_POST["t2_padre_apellido"];
//$t2_padre_nombre = $_POST["t2_padre_nombre"];
//$t2_padre_vive = $_POST["t2_padre_vive"];
//$t2_padre_doctipo = $_POST["t2_padre_doctipo"];
//$t2_padre_doc = $_POST["t2_padre_doc"];
//$t2_madre_apellido = $_POST["t2_madre_apellido"];
//$t2_madre_nombre = $_POST["t2_madre_nombre"];
//$t2_madre_vive = $_POST["t2_madre_vive"];
//$t2_madre_doctipo = $_POST["t2_madre_doctipo"];
//$t2_madre_doc = $_POST["t2_madre_doc"];
//$t2_renuncia = $_POST["t2_renuncia"];
//$t2_sitlaboral = $_POST["t2_sitlaboral"];
//$t2_lugar_trabajo = $_POST["t2_lugar_trabajo"];
//$t2_oficio = $_POST["t2_oficio"];

//$t2_parentesco = $_POST["t2_parentesco"];
//$t2_resid = $_POST["t2_resid"];
//$t2_resid_anterior = $_POST["t2_resid_anterior"];


            //////////////////////////////////////////////////////////
            //  Antes de procesar la informacion, corroboro que el  //
            // titular no exista ya incorporado en la base de datos //
            //////////////////////////////////////////////////////////


$sqlp = "SELECT Persona_dni_nro FROM dbo_Persona WHERE Persona_dni_nro='$t1_doc_nro'";
@$respersona = mysql_query ($sqlp,$link);
@$rsPersona = mysql_fetch_array ($respersona);

@$cant_per = mysql_num_rows($respersona);

if ($cant_per > 0) { echo "<h2>La persona ya existe en la Base de datos</h2>";?><h4><a href="javascript:history.go(-1)">Volver al formulario</a></h4><?


} else {

                /////////////////////////////////////////////////
                //  Fin comprobación de existencia de titular  //
				//   A partir de aquí, procesamiento de datos  //
                /////////////////////////////////////////////////

// > ----------------------------------- o O o ----------------------------------- < \\


//--> Busco si existe el lote en la base de datos

	$sql = "SELECT 
	Lote_nro,
	Partido_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_chacra,
	Lote_quinta,
	Lote_fraccion,
	Lote_manzana,
	Lote_parcela,
	Lote_subparcela
	
	FROM $dbo_tabla_lote WHERE
	
	Partido_nro='$partido' AND
	Lote_circunscripcion='$lote_circ' AND
	Lote_seccion='$lote_secc' AND
	Lote_chacra='$lote_ch' AND
	Lote_quinta='$lote_qta' AND
	Lote_fraccion='$lote_fracc' AND
	Lote_manzana='$lote_manzana' AND
	Lote_parcela='$lote_parcela' AND
	Lote_subparcela='$lote_subpc'";
	
	@$res = mysql_query ($sql,$link);
	@$rsLote = mysql_fetch_array ($res);

	$Lote_nro=$rsLote["Lote_nro"];

	@$cant = mysql_num_rows($res);

	//Verifico si existe un lote con la nomenclatura ingresada

	if ($cant > 0) {
	
	//Si existe actualizo los campos y traigo el numero de lote

	$upd = "UPDATE $dbo_tabla_lote SET
	Partido_nro='$partido',
	Lote_circunscripcion='$lote_circ',
	Lote_seccion='$lote_secc',
	Lote_chacra='$lote_ch',
	Lote_quinta='$lote_qta',
	Lote_fraccion='$lote_fracc',
	Lote_manzana='$lote_manzana',
	Lote_parcela='$lote_parcela',
	Lote_subparcela='$lote_subpc',
	Lote_partida='$lote_partida',
	Lote_barrio='$lote_barrio',
	Lote_superficie = '$lote_superficie',
	Lote_valor_m2 = '$lote_valor_m2',
	Lote_valor_mensura = '$lote_valor_mensura',
	Lote_valor = '$lote_valor_total',
	Lote_cant_cuotas = '$lote_cant_cuotas',
	Lote_valor_cuota = '$lote_valor_cuota_entera',
	Lote_valor_ultima_cuota = '$lote_valor_ultima_cuota',
	Lote_resolucion='$lote_resolucion', 
	Familia_nro='$Familia_nro'
	WHERE Lote_nro = '$Lote_nro'";

	if (@mysql_query($upd,$link)) {echo "Lote actualizado<br>";} else {echo "<b>Error en actualizacion de lote</b>";}
	echo "Lote Numero: ".$Lote_nro;

	} else {

	// Si no existe, inserto el lote en la tabla

	$ins = "INSERT INTO $dbo_tabla_lote (
	Partido_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_chacra,
	Lote_quinta,
	Lote_fraccion,
	Lote_manzana,
	Lote_parcela,
	Lote_subparcela,
	Lote_partida
	) VALUES (
	'$partido',
	'$lote_circ',
	'$lote_secc',
	'$lote_ch',
	'$lote_qta',
	'$lote_fracc',
	'$lote_manzana',
	'$lote_parcela',
	'$lote_subpc',
	'$lote_partida')";

	if (mysql_query($ins)) {
			$Lote_nro = mysql_insert_id();			
		}else{
			echo "<b>Error en insercion de lote</b><br>";
		}

	}

// Insert de familia con los datos ingresados:

	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Familia_apellido,
	Partido_nro,
	Lote_nro,
	Direccion_nro,
	insert_fecha,
	insert_usuario
	)VALUES(
	'$t1_apellido',
	'$partido',
	'$Lote_nro',
	'3',
	CURRENT_DATE,
	'$log_usuario')";

	if (@mysql_query($insFlia,$link)) {
	$Familia_nro = mysql_insert_id();
	}else{
	echo "No se puedo realizar la insercion de familia";}



// Insert de titular 1

	$inst1 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Categoria_nro,
	Familia_nro
	)VALUES(
	'$t1_apellido',
	'$t1_nombre',
	'$t1_doc_tipo',
	'$t1_doc_nro',
	'1',
	'$Familia_nro')";
	
	mysql_query($inst1,$link);


// Insert de titular 2, solo si existe un titular 2
// Para ello, compruebo que el campo $t2_doc_nro sea distinto de 0:

if ($t2_doc_nro!='0') {

	$inst2 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Documento_tipo_nro,
	Persona_dni_nro,
	Categoria_nro,
	Familia_nro
	)VALUES(
	'$t2_apellido',
	'$t2_nombre',
	'$t2_doc_tipo',
	'$t2_doc_nro',
	'2',
	'$Familia_nro')";
	
		mysql_query($inst2,$link);
			
				} else {}
				
//////////////////////////////////////////

/// AGREGAR EL INSERT DE LA ESCRITURA ////

//////////////////////////////////////////	

$escritura_rnrd = $_POST["escritura_rnrd"];
$escritura_escribano_carnet = $_POST["escritura_escribano_carnet"];
$escritura_decreto = $_POST["escritura_decreto"];
$escritura_anio = $_POST["escritura_anio"];
$escritura_numero = $_POST["escritura_numero"];
$escritura_expte = $_POST["escritura_expte"];
$escritura_expte_anio = $_POST["escritura_expte_anio"];
$escritura_fecha = cambiaf_a_mysql($_POST["escritura_fecha"]);
$escritura_acta = $_POST["escritura_acta"];
if ($escritura_acta != '1') {$escritura_acta = '0';}else{$escritura_acta = '1';};

			
	$inst5 = "INSERT INTO $dbo_tabla_escritura (
	Escritura_rnrd,
	Escritura_escribano_carnet,
	Escritura_decreto,
	Escritura_actareg_anio,
	Escritura_actareg_numero,
	Escritura_expte,
	Escritura_expte_anio,
	Escritura_actareg_fecha,
	Escritura_acta,
	Escritura_tramite_consolidacion,
	Familia_nro
	)VALUES(
	'$escritura_rnrd',
	'$escritura_escribano_carnet',
	'$escritura_decreto',
	'$escritura_anio',
	'$escritura_numero',
	'$escritura_expte',
	'$escritura_expte_anio',
	'$escritura_fecha',
	'$escritura_acta',
	'1',
	'$Familia_nro')";
	
		mysql_query($inst5,$link);			
				
?>
<h2>Registro dado de alta correctamente</h2>
<p><a  href="censo_ley_alta_form.php">Dar de alta otro registro</a></p>
<p><a href="menu.php">Volver al menu</a></p>

<?
}
}
}
}
}
?>