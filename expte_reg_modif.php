<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$Expte_nro = $_POST["Expte_nro"];
$Expte_caract = $_POST["expte_caract"];
$Expte_num = $_POST["expte_num"];
$Expte_anio = $_POST["expte_anio"];

if (!$_POST["expte_alcance"] || $_POST["expte_alcance"]=='-') {$Expte_alcance = '0';} else {$Expte_alcance = $_POST["expte_alcance"];};

if (!$_POST["expte_cuerpo"] || $_POST["expte_cuerpo"]=='-') {$Expte_cuerpo = '0';} else {$Expte_cuerpo = $_POST["expte_cuerpo"];};

$Expte_barrio = $_POST["barrio_nro"];
$Expte_origen = $_POST["expte_origen"];
$Expte_observaciones = $_POST["expte_obs"];

$upd = "UPDATE dbo_expte_reg SET
		Expte_caract = '$Expte_caract',
		Expte_num = '$Expte_num',
		Expte_anio = '$Expte_anio',
		Expte_alcance = '$Expte_alcance',
		Expte_cuerpo = '$Expte_cuerpo',
		Expte_origen = '$Expte_origen',
		Barrio_nro = '$Expte_barrio',
		Expte_observaciones = '$Expte_observaciones'
		where Expte_nro = '$Expte_nro'";
		
		if(mysql_query($upd,$link)) {
		
		?>
		
		<h2>Información actualizada correctamente</h2> 
		<h3>Ya puede cerrar la ventana</h3>
		
		<?
				
		}else{
		
		?>
		<h2>La información no pudo ser actualizada. Por favor contacte al administrador</h2> 
		<p><a href="exptes_listar.php">Volver al listado</a></p>
		<?
		
		}
		
		?>