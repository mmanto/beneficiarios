<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

mysql_select_db("MyTierras",$link);



//$log_direccion = $_POST["log_direccion"];
//$log_usuario = $_POST["log_usuario"];
//$log_nivel = $_POST["log_nivel"];
//$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";

////////////////////////////////////

//$resolucion_busqueda = $_GET["idResolucion"];

////////////////////////////////////
  



$sql = "SELECT Familia_nro, Lote_nro FROM dbo_familia where Familia_resolucion = '153/97'";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);


?>


<?
	while($fam = mysql_fetch_array($res)){

$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$fam["Familia_nro"]}",$link);

$sql3 = mysql_query("SELECT
Lote_circunscripcion,
Lote_seccion,
Lote_chacra,
Lote_quinta,
Lote_fraccion,
Lote_manzana,
Lote_parcela,
Partido_nombre
FROM (
dbo_lote
INNER JOIN
dbo_partido
ON dbo_lote.Partido_nro = dbo_Partido.Partido_nro
)WHERE Lote_nro = {$fam["Lote_nro"]}",$link);
$lote = mysql_fetch_array($sql3);	

$lote_partido = $lote["Partido_nombre"];
$lote_circ = $lote["Lote_circunscripcion"];
if($lote["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $lote["Lote_seccion"];}
if($lote["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $lote["Lote_chacra"];}
if($lote["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $lote["Lote_quinta"];}
if($lote["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $lote["Lote_fraccion"];}
$manzana = $lote["Lote_manzana"];
$parcela = $lote["Lote_parcela"];

?>

<?
echo $lote_circ.";".$lote_secc.";".$manzana.";".$parcela.";"; ?>
<? while ($persona = mysql_fetch_array($sql2)){ echo $persona["Persona_apellido"].";".$persona["Persona_nombre"].";".$persona["Documento_tipo_nombre"].";".$persona["Persona_dni_nro"].";"; } echo "<br>";
?>
<?
	}  
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?
include "pie.php";
?>