<?

$idExpte = $_GET["idExpte"];
$idPadre = $_GET["idPadre"];

include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$sql = "UPDATE dbo_exptes SET
		Expte_padre = '0'
		WHERE Expte_nro = $idExpte";
if($res = mysql_query($sql)) {
	
?>
<h2>El expediente ha sido desglosado</h2>
<p><a href="exptes-agregar-form.php?idExpte=<?=$idPadre; ?>">Volver</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?
}else{ ?>
	
<h2>El expediente no pudo ser desglosado. Por favor contacte al administrador</h2>
<p><a href="exptes-agregar-form.php?idExpte=<?=$idPadre; ?>">Volver</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
	
<? }

include("pie.php");

?>