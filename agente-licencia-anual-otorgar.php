<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");
$idAgente = $_POST["agente"];

if(!$_POST["licencia_tipo"] || !$_POST["desde"] || !$_POST["hasta"])

{ ?>

<h1>Debe completar todos los campos</h1> 
<p><a href="agente-licencia-otorgar-form.php?idAgente=<? echo $idAgente; ?>">Volver</a></p>
<p>&nbsp;</p>
<? }else{
$idAgente = $_POST["agente"];
$idLicencia = $_POST["idLicencia"];
$tipo = $_POST["licencia_tipo"];
$desde = cambiaf_a_mysql($_POST["desde"]);
$hasta = cambiaf_a_mysql($_POST["hasta"]);
$observaciones = $_POST["observaciones"];
$dias_disp = $_POST["dias_disp"];

$dias = dias_transcurridos($desde,$hasta);
$dias_total = $dias+1;

$disponible_nuevo = $dias_disp - $dias_total;


$sql = "INSERT INTO dbo_agente_licencia (
		licencia_tipo,
		licencia_anual_nro,
		licencia_inicio,
		licencia_fin,
		licencia_dias_total,
		licencia_observaciones,
		agente_nro
		)VALUES(
		'$tipo',
		'$idLicencia',
		'$desde',
		'$hasta',
		'$dias_total',
		'$observaciones',
		'$idAgente')";

if(mysql_query($sql)) { 



mysql_query("UPDATE dbo_agente_licencia_anual SET
		licencia_anual_restante = '$disponible_nuevo'
		WHERE licencia_anual_nro = $idLicencia");
		
?>
<h2>La licencia fue autorizada correctamente | <?=$disponible_nuevo; ?> | <?=$idLicencia; ?></h2>
<p><a href="agente-licencias.php?idAgente=<? echo $idAgente; ?>">Volver</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? }else{ ?>

<h2>La licencia no pudo ser procesada. Contacte al admiistrador</h2>
<p><a href="agente-licencias.php?idAgente=<? echo $idAgente; ?>">Volver</a></p>
<p></p>
<p></p>

<? } } include("pie.php"); ?>