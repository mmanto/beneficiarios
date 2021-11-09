<? session_start();

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$comision_nro = $_POST["comision_nro"];
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
$comision_estado = $_POST["comision_estado"];
$comision_resultado_cant = $_POST["comision_resultado_cant"];
$comision_motivo = $_POST["comision_motivo"];
$comision_hora_salida = $_POST["comision_hora_salida"];



$sql = "UPDATE dbo_comisiones SET
		Comision_fecha = '$comision_fecha',
		Comision_anio = '$comision_anio',
		Comision_mes = '$comision_mes',
		Comision_hora_salida = '$comision_hora_salida',
		Comision_area = '$comision_area',
		Comision_motivo = '$comision_motivo',
		Partido_nro = '$partido_nro',
		Comision_barrio = '$comision_barrio',		
		Comision_domicilio = '$comision_domicilio',		
		Comision_dias_cant = '$comision_dias_cant',
		Comision_agentes_cant = '$comision_agentes_cant',
		Comision_tarea_cant = '$comision_tarea_cant',
		Comision_resultado_cant = '$comision_resultado_cant',
		Comision_tarea_concepto = '$comision_tarea_concepto',
		Comision_proxima_tarea = '$comision_proxima_tarea',
		Comision_observaciones = '$comision_observaciones',
		Comision_estado = $comision_estado,
		Comision_modif_fecha = CURRENT_DATE,
		Comision_modif_usuario = '$idUsuario'
		WHERE Comision_nro = '$comision_nro'";
		

if(!mysql_query($sql)) { echo "<h2>No se pudo actualizar la comision. Contacte al administrador</h2>";

}else{ ?>
	
	<h2>La comisi&oacute;n fue actualizada correctametne</h2>
<? } ?>

<p>Ya puede cerrar esta ventana</p>

		

