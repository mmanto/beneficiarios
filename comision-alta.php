<? session_start();

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");


$comision_anio = $_POST["comision_fecha_anio"];
$comision_mes = $_POST["comision_fecha_mes"];
$comision_fecha = $_POST["comision_fecha_anio"]."-".$_POST["comision_fecha_mes"]."-".$_POST["comision_fecha_dia"];
$partido_nro = $_POST["partido_nro"];
$comision_area = $_POST["comision_area"];
$comision_barrio = $_POST["comision_barrio"];
$comision_domicilio = $_POST["comision_domicilio"];
$comision_dias_cant = $_POST["comision_dias_cant"];
$comision_agentes_cant = $_POST["comision_agentes_cant"];
$comision_tarea_cant = $_POST["comision_tarea_cant"];
$comision_tarea_concepto = $_POST["comision_tarea_concepto"];
$comision_proxima_tarea = $_POST["comision_proxima_tarea"];
$comision_observaciones = $_POST["comision_observaciones"];
$comision_resultado = $_POST["comision_resultado"];
$comision_estado = $_POST["comision_estado"];
$comision_motivo = $_POST["comision_motivo"];
$comision_hora_salida = $_POST["comision_hora_salida"];



$sql = "INSERT INTO dbo_comisiones (
		Comision_fecha,
		Comision_anio,
		Comision_mes,
		Comision_hora_salida,
		Comision_area,
		Partido_nro,
		Comision_barrio,
		Comision_domicilio,
		Comision_motivo,
		Comision_dias_cant,
		Comision_agentes_cant,
		Comision_tarea_cant,
		Comision_tarea_concepto,
		Comision_resultado_cant,
		Comision_proxima_tarea,
		Comision_observaciones,
		Comision_estado,
		Comision_alta_fecha,
		Comision_alta_usuario
		)VALUES(
		'$comision_fecha',
		'$comision_anio',
		'$comision_mes',
		'$comision_hora_salida',		
		'$comision_area',
		'$partido_nro',
		'$comision_barrio',
		'$comision_domicilio',
		'$comision_motivo',
		'$comision_dias_cant',
		'$comision_agentes_cant',
		'$comision_tarea_cant',
		'$comision_tarea_concepto',
		'$comision_resultado',
		'$comision_proxima_tarea',
		'$comision_observaciones',
		'$comision_estado',
		CURRENT_DATE,
		'$idUsuario')";

if(mysql_query($sql)) { 

$idComision = mysql_insert_id();

$agentes=$_POST["seleccion"]; 

   	for ($i=0;$i<count($agentes);$i++) 
      	{ 
      		
		$agente_nro = $agentes[$i];
		
		$sql = "INSERT INTO dbo_comision_agentes (
			Agente_nro,
			Comision_nro
			)VALUES(
			'$agente_nro',
			'$idComision'
			)";
	
	mysql_query($sql); 
		
      	} 
?>
	
<h2>La comisi&oacute;n fue dada de alta correctamente</h2>

<p><a href="comisiones-listar-area.php">Volver al men&uacute;</a></p>

<? }else{ ?>

<h2>No se pudo realizar el alta de la comision. Contacte al administrador</h2>
<p><a href="sbt-menu.php">Volver al men&uacute;</a></p>

<? } ?>

		

