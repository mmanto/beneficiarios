<? session_start();

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$direccion = $user["Direccion_nro"];


include ("conec.php");
include ("funciones.php");
include("cabecera.php");

if ((!$_POST["fechainicio"] || !$_POST["Tit1DNI"] || !$_POST["Tit1Apellido"] || !$_POST["Tit1Nombre"] || ($_POST["idPartido"] == '0')) 

{
 
echo "<h2>Debe completar todos los campos</h2><p><a href=\"javascript:history.back()\">Volver</a></p>";

}else{


$legajo_inicio_fecha = cambiaf_a_mysql($_POST["fechainicio"]);
$legajo_tipo = $_POST["tramitetipo"];
$legajo_barrio = $_POST["barrio"];
$legajo_expte = $_POST["expte"];
$partido_nro = $_POST["idPartido"];
$lote_circ = $_POST["lote_circ"];
$lote_seccion = $_POST["lote_secc"];
$lote_chacra = $_POST["lote_ch"];
$lote_quinta = $_POST["lote_qta"];
$lote_fraccion = $_POST["lote_fracc"];
$lote_manzana = $_POST["lote_manzana"];
$lote_parcela = $_POST["lote_parcela"];
$lote_subparcela = $_POST["lote_subpc"];
$legajo_titdom = $_POST["titularDom"];
$legajo_pruebadocant = $_POST["pruebadocant"];
$legajo_pruebadocont = $_POST["pruebadoccont"];
$legajo_pruebadocact = $_POST["pruebadocactual"];
$legajo_completo = $_POST["completo"];
$legajo_terminado = $_POST["terminado"];
$legajo_cedula = $_POST["cedula"];
$legajo_plancheta = $_POST["plancheta"];
$legajo_inf_dom = $_POST["infdominio"];
$legajo_edicto = $_POST["edicto"];
$legajo_relev_tec = $_POST["relevtec"];
$legajo_plano = $_POST["plano"];
$legajo_inf_camara = $_POST["camara"];
$legajo_cartadoc = $_POST["cartadoc"];
$legajo_archivado = $_POST["archivado"];
$legajo_observaciones = $_POST["observaciones"];
$legajo_escribano = $_POST["escribano"];
$legajo_numref = $_POST["numref"];
$legajo_caja = $_POST["caja"];
		 



$Tit1DNI = $_POST["Tit1DNI"];
$Tit1Apellido = $_POST["Tit1Apellido"];
$Tit1Nombre = $_POST["Tit1Nombre"];
$telefono = $_POST["telefono"];

$Tit2DNI = $_POST["Tit2DNI"];
$Tit2Apellido = $_POST["Tit2Apellido"];
$Tit2Nombre = $_POST["Tit2Nombre"];





$sql = "INSERT INTO dbo_legajo24374 (
		 Legajo_inicio_fecha,
		 Legajo_tipo,
		 Legajo_barrio,
		 Legajo_expte,
		 Partido_nro,
		 Lote_circunscripcion,
		 Lote_seccion,
		 Lote_chacra,
		 Lote_quinta,
		 Lote_fraccion,
		 Lote_manzana,
		 Lote_parcela,
		 Lote_subparcela,
		 Lote_titdom,
		 Legajo_pruebadocant,
		 Legajo_pruebadocont,
		 Legajo_pruebadocact,
		 Legajo_completo,
		 Legajo_terminado,
		 Legajo_cedula,
		 Legajo_plancheta,
		 Legajo_inf_dom,
		 Legajo_edicto,
		 Legajo_relev_tec,
		 Legajo_plano,
		 Legajo_inf_camara,
		 Legajo_cartadoc,
		 Legajo_archivado,
		 Legajo_observaciones,
		 Legajo_escribano,
		 Legajo_numref,
		 Legajo_caja,
		 Legajo_alta_usuario,
		 Legajo_alta_fecha,
		 blnActivo
		 )VALUES(
		 $legajo_inicio_fecha,
		 $legajo_tipo,
		 $legajo_barrio,
		 $legajo_expte,
		 $partido_nro,
		 $lote_circ,
		 $lote_seccion,
		 $lote_chacra,
		 $lote_quinta,
		 $lote_fraccion,
		 $lote_manzana,
		 $lote_parcela,
		 $lote_subparcela,
		 $legajo_titdom,
		 $legajo_pruebadocant,
		 $legajo_pruebadocont,
		 $legajo_pruebadocact,
		 $legajo_completo,
		 $legajo_terminado,
		 $legajo_cedula,
		 $legajo_plancheta,
		 $legajo_inf_dom,
		 $legajo_edicto,
		 $legajo_relev_tec,
		 $legajo_plano,
		 $legajo_inf_camara,
		 $legajo_cartadoc,
		 $legajo_archivado,
		 $legajo_observaciones,
		 $legajo_escribano,
		 $legajo_numref,
		 $legajo_caja,
		 '$log_usuario',		 
		 CURRENT_DATE,
		 '1'
		 )";
	
if(mysql_query($sql)) {
$legajo_nro = mysql_insert_id();


$sql2 = "INSERT INTO dbo_persona_test (
		Documento_tipo_nro,
		Persona_dni_nro,
		Persona_apellido,
		Persona_nombre,
		Persona_telefono,
		Persona_direccion,
		Legajo_nro
		)VALUES(
		'1',
		'$TitularDNI',
		'$apellido',
		'$nombre',
		'$telefono',
		'$direccion',
		'$legajo_nro'
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