<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

if(!$_POST["caracteristica"] || !$_POST["exptenum"] || !$_POST["anio"]) { ?>

<h1>Los datos carcter&iacute;stica, n&uacute;mero y a&ntilde;o deben estar completos.</h1>
<p><a href="javascript:window.history.back();">Volver</a>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? }else{

$expte_nro = $_POST["expte_nro"];
$expte_caract = $_POST["caracteristica"];
$expte_partido = $_POST["partido"];
$expte_rnrd = $_POST["rnrd"];
	if($expte_rnrd != '0') {$ley24374 = '1'; }else{ $ley24374 = '0';}

$expte_num = $_POST["exptenum"];
$expte_anio = $_POST["anio"];
$expte_alcance = $_POST["alcance"];
$expte_cuerpos = $_POST["cuerpos"];
$expte_extracto = $_POST["extracto"];
$expte_obs = $_POST["observaciones"];
$expte_origen = $_POST["origen"];
$usuario = $_POST["usuario"];

$fojas = $_POST["fojas"];
$fojas_actual = $_POST["fojas_actual"];
$expte_consolidacion = $_POST["consolidacion"];
$expte_esc = $_POST["expte_esc"];
$partido_nro = $_POST["idPartido"];
$expte_escribano = $_POST["escribano"];

$sql = "UPDATE dbo_exptes SET
		Expte_caract = '$expte_caract',
		Expte_partido = '$expte_partido',
		Expte_rnrd = '$expte_rnrd',
		Expte_num = '$expte_num',
		Expte_anio = '$expte_anio',
		Expte_alcance = '$expte_alcance',
		Expte_cuerpos_cant = '$expte_cuerpos',
		Expte_extracto = '$expte_extracto',
		Expte_escribano = '$expte_escribano',
		Expte_observaciones = '$expte_obs',
		Expte_esc = '$expte_esc',
		Partido_nro = '$partido_nro',
		Expte_24374 = '$ley24374',
		Expte_ley_cons = '$expte_consolidacion',
		Expte_origen = '$expte_origen',
		Expte_modif_fecha = CURRENT_DATE,
		Expte_modif_hora = CURRENT_TIME,
		Expte_fojas_origen = '$fojas',
		Expte_fojas_actual = '$fojas_actual',
		Expte_modif_usuario = '$usuario'
		WHERE Expte_nro = '$expte_nro'";

if(mysql_query($sql)) {echo "<h1>El expediente fue modificado correctamente</h1>"; }else{ echo "<h1>Error al modificar el expediente. Contacte al administrador</h1>";}

?>		
		
		
<p>Ya puede cerrar esta ventana</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?

}
include("pie.php");		
?>