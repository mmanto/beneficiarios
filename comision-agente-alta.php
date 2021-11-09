<?

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$idComision = $_POST["idComision"];



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

<h2>Los agentes fueron agregados correctamente a la comision</h2>
<p><a href="comision-informe.php?idComision=<?=$idComision; ?>">Volver</a>