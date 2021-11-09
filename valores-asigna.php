<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idBarrio = $_POST["idBarrio"];

$idPartido = $_POST["idPartido"];

$cant = $_POST["cant"];

for ($i=1;$i<=$cant;$i++){ 

$familia_nro = $_POST["id".$i];

$lotevalor = $_POST["lotevalor".$i];
$lotecuotas = $_POST["lotecuotas".$i];


$sql2 = "UPDATE dbo_familia SET
		Familia_montoadj = '$lotevalor',
		Familia_montoadj_cuotas = '$lotecuotas'
		WHERE Familia_nro = '$familia_nro'";
		
mysql_query($sql2); 

}
?>
<h1>Datos actualizados correctamente</h1>
<p>&nbsp;</p>
<p><a href="barrios_listar_partido.php?idPartido=<?=$idPartido; ?>">Volver al listado de beneficiarios</a>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? include("pie.php"); ?>