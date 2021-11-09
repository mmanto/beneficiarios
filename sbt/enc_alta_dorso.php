<?
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");


//////////////////////////////////////////////

// Definición nombres de tablas

     $dbo_tabla_lote = "dbo_lote";
	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";

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

$log_usuario = $_POST["idUsuario"];
$log_direccion = $_POST["idDireccion"];
$log_nivel = $_POST["user_nivel"];

$direccion_nro = $log_direccion;
$encuesta_proyecto = $_POST["encuesta_proyecto"];
$encuesta_fecha = $_POST["encuesta_fecha"];

$fechamysql = cambiaf_a_mysql($encuesta_fecha);

$familia_resolucion = $_POST["Familia_resolucion"]; //Numero de resolucion

$familia_res_ivba = $_POST["res_ivba"]; //Resolucion IVBA

if ($familia_resolucion == 0) { //Si la resolucion está vacia, carga los valores que devuelve el formulario.

$partido = $_POST["idPartido"];
if (!$_POST["lote_barrio"]) {$lote_barrio = '0';} else {$lote_barrio = $_POST["lote_barrio"];};
if (!$_POST["lote_circ"] || $_POST["lote_circ"]=='-') {$lote_circ = '0';} else {$lote_circ = $_POST["lote_circ"];};
if (!$_POST["lote_secc"] || $_POST["lote_secc"]=='-') {$lote_secc = '0';} else {$lote_secc = $_POST["lote_secc"];};
$lote_resolucion = '0';


} else { //Si está seleccionada alguna resolucion, carga los valores que devuelve la consulta SQL

	$strSQL4 = "SELECT * FROM dbo_resolucion WHERE idResolucion = $familia_resolucion";
	$resol = mysql_query ($strSQL4);
	$resolucion = mysql_fetch_array($resol);
	
	$partido = $resolucion["Resolucion_partido"];
	$lote_barrio = $resolucion["Resolucion_barrio"];
	$lote_circ = $resolucion["Resolucion_circ"];
	$lote_secc = $resolucion["Resolucion_secc"];
	$lote_resolucion = $resolucion["Resolucion_nombre"];
	
	}

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


$familia_domic = $_POST["Familia_domic"];
$familia_domic_edificio = $_POST["Familia_domic_edificio"];
$familia_domic_sector = $_POST["Familia_domic_sector"];
$familia_domic_piso = $_POST["Familia_domic_piso"];
$familia_domic_depto = $_POST["Familia_domic_depto"];
$familia_casa_num = $_POST["Familia_casa_num"];
$familia_telefono = $_POST["Familia_telefono"];
$familia_domic_monoblock = $_POST["Familia_domic_monoblock"];
$familia_domic_escalera = $_POST["Familia_domic_escalera"];


//Definicion de variables de persona 1
$t1_apellido = $_POST["t1_apellido"];
$t1_nombre = $_POST["t1_nombre"];
$t1_fecha_nac_dia = $_POST["t1_fecha_nac_dia"];
$t1_fecha_nac_mes = $_POST["t1_fecha_nac_mes"];
$t1_fecha_nac_anio = $_POST["t1_fecha_nac_anio"];
$t1_fecha_nac = "$t1_fecha_nac_dia-$t1_fecha_nac_mes-$t1_fecha_nac_anio";
$t1_edad = $_POST["t1_edad"];
$t1_lugar_nac = $_POST["t1_lugar_nac"];
$t1_sexo = $_POST["t1_sexo"];
$t1_nacionalidad = $_POST["t1_nacionalidad"];
$t1_doc_tipo = $_POST["t1_doc_tipo"];
$t1_doc_nro = $_POST["t1_doc_nro"];
$t1_cuil = $_POST["t1_cuil"];
$t1_domicilio = $_POST["t1_domicilio"];
$t1_ecivil = $_POST["t1_ecivil"];
$t1_nupcias = $_POST["t1_nupcias"];
$t1_fechasep = $_POST["t1_fechasep"];
$t1_conyuge_apellido = $_POST["t1_conyuge_apellido"];
$t1_conyuge_nombre = $_POST["t1_conyuge_nombre"];
$t1_padre_apellido = $_POST["t1_padre_apellido"];
$t1_padre_nombre = $_POST["t1_padre_nombre"];
$t1_padre_vive = $_POST["t1_padre_vive"];
$t1_padre_doctipo = $_POST["t1_padre_doctipo"];
$t1_padre_doc = $_POST["t1_padre_doc"];
$t1_madre_apellido = $_POST["t1_madre_apellido"];
$t1_madre_nombre = $_POST["t1_madre_nombre"];
$t1_madre_vive = $_POST["t1_madre_vive"];
$t1_madre_doctipo = $_POST["t1_madre_doctipo"];
$t1_madre_doc = $_POST["t1_madre_doc"];
$t1_renuncia = $_POST["t1_renuncia"];
$t1_sitlaboral = $_POST["t1_sitlaboral"];
$t1_lugar_trabajo = $_POST["t1_lugar_trabajo"];
$t1_oficio = $_POST["t1_oficio"];
$t1_ingresos = $_POST["t1_ingresos"];
$t1_vinculo_t2 = $_POST["t1_vinculo_t2"];
$t1_resid = $_POST["t1_resid"];
$t1_resid_anterior = $_POST["t1_resid_anterior"];

//Definicion de variables de persona 2

$t2_apellido = $_POST["t2_apellido"];
$t2_nombre = $_POST["t2_nombre"];
$t2_fecha_nac_dia = $_POST["t2_fecha_nac_dia"];
$t2_fecha_nac_mes = $_POST["t2_fecha_nac_mes"];
$t2_fecha_nac_anio = $_POST["t2_fecha_nac_anio"];
$t2_fecha_nac = "$t2_fecha_nac_dia-$t2_fecha_nac_mes-$t2_fecha_nac_anio";



$t2_edad = $_POST["t2_edad"];
$t2_lugar_nac = $_POST["t2_lugar_nac"];
$t2_sexo = $_POST["t2_sexo"];
$t2_nacionalidad = $_POST["t2_nacionalidad"];
$t2_doc_tipo = $_POST["t2_doc_tipo"];

if (!$_POST["t2_doc_nro"]) {$t2_doc_nro = '0'; }else{ $t2_doc_nro = $_POST["t2_doc_nro"];};

$t2_cuil = $_POST["t2_cuil"];
$t2_domicilio = $_POST["t2_domicilio"];
$t2_ecivil = $_POST["t2_ecivil"];
$t2_nupcias = $_POST["t2_nupcias"];
$t2_fechasep = $_POST["t2_fechasep"];
$t2_conyuge_apellido = $_POST["t2_conyuge_apellido"];
$t2_conyuge_nombre = $_POST["t2_conyuge_nombre"];
$t2_padre_apellido = $_POST["t2_padre_apellido"];
$t2_padre_nombre = $_POST["t2_padre_nombre"];
$t2_padre_vive = $_POST["t2_padre_vive"];
$t2_padre_doctipo = $_POST["t2_padre_doctipo"];
$t2_padre_doc = $_POST["t2_padre_doc"];
$t2_madre_apellido = $_POST["t2_madre_apellido"];
$t2_madre_nombre = $_POST["t2_madre_nombre"];
$t2_madre_vive = $_POST["t2_madre_vive"];
$t2_madre_doctipo = $_POST["t2_madre_doctipo"];
$t2_madre_doc = $_POST["t2_madre_doc"];
$t2_renuncia = $_POST["t2_renuncia"];
$t2_sitlaboral = $_POST["t2_sitlaboral"];
$t2_lugar_trabajo = $_POST["t2_lugar_trabajo"];
$t2_oficio = $_POST["t2_oficio"];
$t2_ingresos = $_POST["t2_ingresos"];
$t2_parentesco = $_POST["t2_parentesco"];
$t2_resid = $_POST["t2_resid"];
$t2_resid_anterior = $_POST["t2_resid_anterior"];


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
	Lote_partida,
	Lote_barrio,
	Lote_resolucion
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
	'$lote_partida',
	'$lote_barrio',
	'$lote_resolucion')";

	if (mysql_query($ins)) {
			$Lote_nro = mysql_insert_id();			
		}else{
			echo "<b>Error en insercion de lote</b><br>";
		}

	}




// Insert de familia con los datos ingresados:

	$insFlia = "INSERT INTO $dbo_tabla_familia (
	Direccion_nro,
	Encuesta_proyecto,
	Encuesta_fecha,
	Familia_apellido,
	Familia_domic,
	Familia_domic_edificio,
	Familia_domic_monoblock,
	Familia_domic_sector, 
	Familia_domic_escalera,
	Familia_domic_piso, 
	Familia_domic_depto,
	Familia_casa_num,
	Familia_telefono,
	Familia_resolucion,
	Familia_res_ivba,
	Partido_nro,
	Lote_nro,
	insert_fecha,
	insert_usuario
	)VALUES(
	'$direccion_nro',
	'$encuesta_proyecto',
	'$fechamysql',
	'$t1_apellido',
	'$familia_domic',
	'$familia_domic_edificio',
	'$familia_domic_monoblock',
	'$familia_domic_sector',
	'$familia_domic_escalera',
	'$familia_domic_piso',
	'$familia_domic_depto',
	'$familia_casa_num',
	'$familia_telefono',
	'$lote_resolucion',
	'$familia_res_ivba',
	'$partido',
	'$Lote_nro',
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
	Persona_fecha_nac,
	Persona_edad,
	Persona_lugar_nac,
	Persona_sexo,
	Persona_nacionalidad,
	Documento_tipo_nro,
	Persona_dni_nro,
	Persona_cuil,
	Persona_domicilio,
	Estado_civil_nro,
	Persona_nupcias,
	Persona_fecha_divorcio,
	Persona_conyuge_apellido,
	Persona_conyuge_nombre,
	Persona_padre_apellido,
	Persona_padre_nombre,
	Persona_padre_vive,
	Persona_padre_doctipo,
	Persona_padre_doc,
	Persona_madre_apellido,
	Persona_madre_nombre,
	Persona_madre_vive,
	Persona_madre_doctipo,
	Persona_madre_doc,
	Persona_renuncia,
	Persona_sitlaboral,
	Persona_lugar_trab,
	Persona_oficio,
	Persona_ingresos,
	Persona_tpo_resid,
	Persona_resid_anterior,
	Categoria_nro,
	Familia_nro
	)VALUES(
	'$t1_apellido',
	'$t1_nombre',
	'$t1_fecha_nac',
	'$t1_edad',
	'$t1_lugar_nac',
	'$t1_sexo',
	'$t1_nacionalidad',
	'$t1_doc_tipo',
	'$t1_doc_nro',
	'$t1_cuil',
	'$t1_domicilio',
	'$t1_ecivil',
	'$t1_nupcias',
	'$t1_fechasep',
	'$t1_conyuge_apellido',
	'$t1_conyuge_nombre',
	'$t1_padre_apellido',
	'$t1_padre_nombre',
	'$t1_padre_vive',
	'$t1_padre_doctipo',
	'$t1_padre_doc',
	'$t1_madre_apellido',
	'$t1_madre_nombre',
	'$t1_madre_vive',
	'$t1_madre_doctipo',
	'$t1_madre_doc',
	'$t1_renuncia',
	'$t1_sitlaboral',
	'$t1_lugar_trabajo',
	'$t1_oficio',
	'$t1_ingresos',
	'$t1_resid',
	'$t1_resid_anterior',
	'1',
	'$Familia_nro')";
	
	mysql_query($inst1,$link);


// Insert de titular 2, solo si existe un titular 2
// Para ello, compruebo que el campo $t2_doc_nro sea distinto de 0:

if ($t2_doc_nro!='0') {

	$inst2 = "INSERT INTO $dbo_tabla_persona (
	Persona_apellido,
	Persona_nombre,
	Persona_fecha_nac,
	Persona_edad,
	Persona_lugar_nac,
	Persona_sexo,
	Persona_nacionalidad,
	Documento_tipo_nro,
	Persona_dni_nro,
	Persona_cuil,
	Persona_domicilio,
	Estado_civil_nro,
	Persona_nupcias,
	Persona_fecha_divorcio,
	Persona_conyuge_apellido,
	Persona_conyuge_nombre,
	Persona_padre_apellido,
	Persona_padre_nombre,
	Persona_padre_vive,
	Persona_padre_doctipo,
	Persona_padre_doc,
	Persona_madre_apellido,
	Persona_madre_nombre,
	Persona_madre_vive,
	Persona_madre_doctipo,
	Persona_madre_doc,
	Persona_renuncia,
	Persona_sitlaboral,
	Persona_lugar_trab,
	Persona_oficio,
	Persona_ingresos,
	Persona_tpo_resid,
	Persona_resid_anterior,
	Persona_parentesco,
	Categoria_nro,
	Familia_nro
	)VALUES(
	'$t2_apellido',
	'$t2_nombre',
	'$t2_fecha_nac',
	'$t2_edad',
	'$t2_lugar_nac',
	'$t2_sexo',
	'$t2_nacionalidad',
	'$t2_doc_tipo',
	'$t2_doc_nro',
	'$t2_cuil',
	'$t2_domicilio',
	'$t2_ecivil',
	'$t2_nupcias',
	'$t2_fechasep',
	'$t2_conyuge_apellido',
	'$t2_conyuge_nombre',
	'$t2_padre_apellido',
	'$t2_padre_nombre',
	'$t2_padre_vive',
	'$t2_padre_doctipo',
	'$t2_padre_doc',
	'$t2_madre_apellido',
	'$t2_madre_nombre',
	'$t2_madre_vive',
	'$t2_madre_doctipo',
	'$t2_madre_doc',
	'$t2_renuncia',
	'$t2_sitlaboral',
	'$t2_lugar_trabajo',
	'$t2_oficio',
	'$t2_ingresos',
	'$t2_resid',
	'$t2_resid_anterior',
	'$t2_parentesco',
	'2',
	'$Familia_nro')";
	
		mysql_query($inst2,$link);
			
				} else {}

//------------- o > A partir de acá back-front del dorso encuesta < o ------------//

?>

<form action="enc_alta_fin.php" method="post" enctype="multipart/form-data" name="f" id="f">
<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" />
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" />
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" />

<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="216" height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL GRUPO FAMILIAR CONVIVIENTE </strong></td>
	  </tr>
      <tr>
        <td><table width="600" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="5" colspan="10">&nbsp;</td>
            </tr>
          <tr>
            <td height="25">Menores</td>
            <td><input name="familia_cant_menores" type="text" id="familia_cant_menores" size="2" onkeypress="return pulsar(event)"/></td>
            <td>Mayores</td>
            <td><input name="familia_cant_mayores" type="text" id="familia_cant_mayores" size="2" onkeypress="return pulsar(event)"/></td>
            <td> A cargo </td>
            <td><input name="familia_acargo" type="text" id="familia_acargo" size="2" onkeypress="return pulsar(event)"/></td>
            <td>Miembros que reciben ingresos</td>
            <td><input name="familia_reciben_ingresos" type="text" id="familia_reciben_ingresos" size="2" onkeypress="return pulsar(event)"/></td>
            <td>Monto </td>
            <td><input name="familia_monto" type="text" id="familia_monto" size="2" onkeypress="return pulsar(event)"/></td>
          </tr>
        </table>
          <table width="600" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="213" height="35" align="center">Familias que conviven en la vivienda </td>
              <td width="51"><input name="familia_conviven" type="text" id="familia_conviven" size="2" onkeypress="return pulsar(event)"/></td>
              <td width="243" align="center">Total general de ingresos familiares </td>
              <td width="93">$
                <input name="familia_ingreso_total" type="text" id="familia_ingreso_total" size="8" onkeypress="return pulsar(event)"/></td>
            </tr>
          </table>
          <table width="600" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><strong>Observaciones</strong></td>
            </tr>
            <tr>
              <td><textarea name="familia_observacion" cols="109" rows="5" id="familia_observacion"></textarea></td>
            </tr>
          </table></td>
      </tr>
	 </table>
    </td>
  </tr>
</table>



<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10" ></td>
  </tr>
  <tr>
    <td width="216" height="25" align="center" bgcolor="#E4E4E4"><strong>SITUACION DOMINIAL </strong></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="10" colspan="4"></td>
        </tr>
      <tr>
        <td width="209">Fecha de ingreso al lote/vivienda </td>
        <td width="186">Forma de ingreso </td>
        <td colspan="2">Tipo de ocupaci&oacute;n </td>
      </tr>
      <tr>
        <td><input name="fecha_ingreso_lote" type="text" id="fecha_ingreso_lote" value="dd/mm/aaaa" size="15" onkeypress="return pulsar(event)"/></td>
        <td><input name="forma_ingreso" type="text" id="forma_ingreso" size="25" onkeypress="return pulsar(event)"/></td>
        <td width="90">Regular          
          <input name="tipo_ocupacion" type="radio" value="1" checked="checked" onkeypress="return pulsar(event)"/></td>
        <td width="115">Irregular 
          <input name="tipo_ocupacion" type="radio" value="0" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="4" height="10"></td>
        </tr>
        <tr>
          <td>Forma ocupaci&oacute;n          </td>
          <td>Expte. n&uacute;mero          </td>
          <td>Fecha expte          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><select name="forma_ocupacion" id="forma_ocupacion">
            <option value="0">Seleccione uno...</option>
            <option value="1">Preadjudicaci&oacute;n</option>
            <option value="2">Adjudicaci&oacute;n</option>
            <option value="3">Certif. transferencia</option>
            <option value="4">Boleto C.V.</option>
            <option value="5">Acta Ley 24374</option>
            <option value="6">Escritura</option>
            <option value="7">Hipoteca</option>
            <option value="8">Transf. sucesivas</option>
            <option value="9">Expte. regulariz.</option>
          </select></td>
          <td><input name="expediente_nro" type="text" id="expediente_nro" size="15" onkeypress="return pulsar(event)"/></td>
          <td><input name="expediente_fecha" type="text" id="expediente_fecha" value="dd/mm/aaaa" size="15" onkeypress="return pulsar(event)"/></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="600" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="152" height="25">Escritura Nro. </td>
          <td width="173">Fecha escritura </td>
          <td width="146">Decreto </td>
          <td width="107">&nbsp;</td>
          <td width="22">&nbsp;</td>
        </tr>
        <tr>
          <td><input name="Escritura_nro" type="text" id="Escritura_nro" size="15" onkeypress="return pulsar(event)"/></td>
          <td><input name="Escritura_fecha" type="text" id="Escritura_fecha" value="dd/mm/aaaa" size="15" onkeypress="return pulsar(event)"/></td>
          <td><input name="Escritura_decreto" type="text" id="Escritura_decreto" size="15" onkeypress="return pulsar(event)"/></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="4" height="10"></td>
        </tr>
        <tr>
          <td>Car&aacute;cter          </td>
          <td>Apellido y nombres </td>
          <td>Documento tipo </td>
          <td>N&ordm; Documento </td>
        </tr>
        <tr>
          <td><select name="p1_caracter" id="p1_caracter">
            <option value="0">Seleccione...</option>
            <option value="1">Titular</option>
            <option value="2">Beneficiario</option>
            <option value="3">Adquirente</option>
            <option value="4">Trasmitente</option>
          </select></td>
          <td><input name="p1_nombre" type="text" id="p1_nombre" size="40" /></td>
          <td><select name="p1_doctipo" id="select">
            <option value="0" selected="selected">Seleccione uno</option>
            <option value="1">DNI</option>
            <option value="2">LE/CI</option>
            <option value="3">CF</option>
            <option value="4">Ext.</option>
                                                  </select></td>
          <td><input name="p1_documento" type="text" id="p1_documento" size="15" onkeypress="return pulsar(event)"/></td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="4" height="10"></td>
        </tr>
        <tr>
          <td>Car&aacute;cter </td>
          <td>Apellido y nombres </td>
          <td>Documento tipo </td>
          <td>N&ordm; Documento </td>
        </tr>
        <tr>
          <td><select name="p2_caracter" id="p2_caracter">
              <option value="0">Seleccione...</option>
              <option value="1">Titular</option>
              <option value="2">Beneficiario</option>
              <option value="3">Adquirente</option>
              <option value="4">Trasmitente</option>
          </select></td>
          <td><input name="p2_nombre" type="text" id="p2_nombre" size="40" /></td>
          <td><select name="p2_doctipo" id="select2">
              <option value="0" selected="selected">Seleccione uno</option>
              <option value="1">DNI</option>
              <option value="2">LE/CI</option>
              <option value="3">CF</option>
              <option value="4">Ext.</option>
          </select></td>
          <td><input name="p2_documento" type="text" id="p2_documento" size="15" /></td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="154" height="35">Posee otra propiedad? </td>
          <td width="110">Si 
          <input name="posee_otraprop" type="radio" value="1" onkeypress="return pulsar(event)"/> 
          No 
          <input name="posee_otraprop" type="radio" value="0" checked="checked" onkeypress="return pulsar(event)"/></td>
          <td width="58">D&oacute;nde? </td>
          <td width="278"><input name="otraprop_lugar" type="text" id="otraprop_lugar" onkeypress="return pulsar(event)"/></td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="179">&nbsp;</td>
          <td width="81">&nbsp;</td>
          <td width="120">Nro. Cheq./Libreta </td>
          <td width="220">Nombre y apellido titular Cheq./Libreta </td>
        </tr>
        <tr>
          <td>Paga chequeras actualmente? </td>
          <td>Si 
          <input name="chequera_paga" type="radio" value="1" onkeypress="return pulsar(event)"/> 
          No 
          <input name="chequera_paga" type="radio" value="0" checked="checked" onkeypress="return pulsar(event)"/></td>
          <td><input name="chequera_nro" type="text" id="chequera_nro" size="15" onkeypress="return pulsar(event)"/></td>
          <td><input name="chequera_titular" type="text" id="chequera_titular" size="37" onkeypress="return pulsar(event)"/></td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="82" height="25">Monto</td>
          <td width="95">Cuotas pagas </td>
          <td width="143">Ultima fecha de pago </td>
          <td width="140">Emisor</td>
          <td width="140">Otro:</td>
        </tr>
        <tr>
          <td>$ 
          <input name="chequera_monto" type="text" id="chequera_monto" size="5" onkeypress="return pulsar(event)"/></td>
          <td><input name="chequera_cuotas" type="text" id="chequera_cuotas" size="5" onkeypress="return pulsar(event)"/></td>
          <td><input name="chequera_ultimo_pago" type="text" id="chequera_ultimo_pago" size="15" onkeypress="return pulsar(event)"/></td>
          <td><select name="chequera_emisor" id="chequera_emisor">
            <option value="0">Seleccione...</option>
            <option value="1">I.V.B.A.</option>
            <option value="2">B.H.N.</option>
            <option value="3">I.P.B.</option>
            <option value="4">Municip.</option>
          </select>
          </td>
          <td><input name="chequera_emisor_otro" type="text" id="chequera_emisor_otro" size="12" onkeypress="return pulsar(event)"/></td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="35" colspan="6">&iquest;Conoce y acepta las 
		  condiciones de la ley 13342 y su decreto reglamentario? </td>
          <td width="155">Si 
            <input name="familia_acepta_ley" type="radio" value="1" checked="checked" onkeypress="return pulsar(event)"/>
          No 
          <input name="familia_acepta_ley" type="radio" value="0" onkeypress="return pulsar(event)"/></td>
        </tr>
        <tr>
          <td width="109" height="35" bgcolor="#F4F4F4">N&ordm; expte. IVBA </td>
          <td width="72" bgcolor="#F4F4F4"><input name="expte_ivba" type="text" id="expte_ivba" size="8" onkeypress="return pulsar(event)"/></td>
          <td width="30" bgcolor="#F4F4F4">Alc.</td>
          <td width="101" bgcolor="#F4F4F4"><input name="expte_ivba_alc" type="text" id="expte_ivba_alc" size="8" onkeypress="return pulsar(event)"/></td>
          <td width="132" bgcolor="#F4F4F4">Fecha de env&iacute;o EGG </td>
          <td colspan="2" bgcolor="#F4F4F4"><input name="fecha_envio_egg" type="text" id="fecha_envio_egg" size="8" onkeypress="return pulsar(event)"/></td>
          </tr>
      </table>
      <table width="600" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><strong>Documentaci&oacute;n acompa&ntilde;ada/Observaciones</strong></td>
        </tr>
        <tr>
          <td><textarea name="familia_doc_obs" cols="109" rows="7" id="familia_doc_obs"></textarea></td>
        </tr>
      </table>
      <table width="600" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2"></td>
          <td width="66"></td>
        </tr>
        <tr>
          <td align="left"><input type="hidden" name="Familia_nro" value= "<?=$Familia_nro; ?>" onkeypress="return pulsar(event)"/></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="522" align="right">  
		  
		  <input name="cmdReset" type="reset" id="cmdReset" value="Borrar formulario" onkeypress="return pulsar(event)"/></td>
          <td width="12">&nbsp;</td>
          <td>
		  <input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar" onkeypress="return pulsar(event)"/>
		  
		  </td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
</body>
</html>
<?
}
}
}
}
?>