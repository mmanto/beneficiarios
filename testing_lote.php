<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");


//////////////////////////////////////////////

// Definición nombres de tablas

     $dbo_tabla_lote = "dbo_lote";

//////////////////////////////////////////////



$partido = $_POST["idPartido"];
if (!$_POST["lote_barrio"]) {$lote_barrio = '0';} else {$lote_barrio = $_POST["lote_barrio"];};
if (!$_POST["lote_circ"] || $_POST["lote_circ"]=='-') {$lote_circ = '0';} else {$lote_circ = $_POST["lote_circ"];};
if (!$_POST["lote_secc"] || $_POST["lote_secc"]=='-') {$lote_secc = '0';} else {$lote_secc = $_POST["lote_secc"];};


if (!$_POST["lote_localidad"]) {$lote_localidad ='0';} else {$lote_localidad = $_POST["lote_localidad"];};
if (!$_POST["lote_ch"] || $_POST["lote_ch"]=='-') {$lote_ch = '0';} else {$lote_ch = $_POST["lote_ch"];};
if (!$_POST["lote_qta"] || $_POST["lote_qta"]=='-') {$lote_qta = '0';} else {$lote_qta = $_POST["lote_qta"];};
if (!$_POST["lote_fracc"] || $_POST["lote_fracc"]=='-') {$lote_fracc = '0';} else {$lote_fracc = $_POST["lote_fracc"];};
if (!$_POST["lote_manzana"] || $_POST["lote_manzana"]=='-') {$lote_manzana = '0';} else {$lote_manzana = $_POST["lote_manzana"];};
if (!$_POST["lote_parcela"] || $_POST["lote_parcela"]=='-') {$lote_parcela = '0';} else {$lote_parcela = $_POST["lote_parcela"];};
if (!$_POST["lote_subpc"] || $_POST["lote_subpc"]=='-') {$lote_subpc = '0';} else {$lote_subpc = $_POST["lote_subpc"];};
if (!$_POST["lote_partida"] || $_POST["lote_partida"]=='-') {$lote_partida = '0';} else {$lote_partida = $_POST["lote_partida"];};


////////////////////////////////////////////
/////// Inherentes a valor del lote ////////
////////////////////////////////////////////

$lote_superficie = $_POST["lote_superficie"];
$lote_valor_m2 = $_POST["lote_valor_m2"];
$lote_valor_mensura = $_POST["lote_valor_mensura"];
$lote_valor_sup = $lote_superficie*$lote_valor_m2;
$lote_valor_total = $lote_valor_sup + $lote_valor_mensura;
$lote_valor_total = redondear_dos_decimal($lote_valor_total);
if ($_POST["lote_cant_cuotas"] < 1) {$lote_cant_cuotas = 1;}else{$lote_cant_cuotas = $_POST["lote_cant_cuotas"];};
$cant_cuotas_enteras = $lote_cant_cuotas - 1;
$cuota_original = $lote_valor_total/$lote_cant_cuotas;
$lote_valor_cuota_entera = redondear_dos_decimal($cuota_original);
$suma_cuota_enteras = $lote_valor_cuota_entera*$cant_cuotas_enteras;
$lote_valor_ultima_cuota = $lote_valor_total - $suma_cuota_enteras;



	$ins = "INSERT INTO $dbo_tabla_lote (
	Partido_nro,
	Lote_circunscripcion,
	Lote_seccion,
	Lote_chacra,
	Lote_quinta,
	Lote_fraccion,
	Lote_manzana,
	Lote_parcela,
	Lote_subparcela,
	Lote_partida,
	Lote_barrio,
	Lote_valor_m2,
	Lote_valor_mensura,
	Lote_valor,
	Lote_cant_cuotas,
	Lote_valor_cuota,
	Lote_valor_ultima_cuota
	) VALUES (
	'$partido',
	'$lote_circ',
	'$lote_secc',
	'$lote_ch',
	'$lote_qta',
	'$lote_fracc',
	'$lote_manzana',
	'$lote_parcela',
	'$lote_subpc',
	'$lote_partida',
	'$lote_barrio',
	'$lote_valor_m2',
	'$lote_valor_mensura',
	'$lote_valor_total',
	'$lote_cant_cuotas',
	'$lote_valor_cuota_entera',
	'$lote_valor_ultima_cuota')";

	if (mysql_query($ins)) {
			$Lote_nro = mysql_insert_id();			
		}else{
			echo "<b>Error en insercion de lote</b><br>";
		}


?>
<h2>Lote dado de alta correctamente</h2>
<p><a  href="censo_alta_form.php">Dar de alta otro censo</a></p>
<p><a href="menu.php">Volver al menu</a></p>
<? 
echo "Superficie = ".$lote_superficie."<br>";
echo "Valor m2 = ".$lote_valor_m2."<br>";
echo "Valor del lote por superficie = ".$lote_valor_sup."<br>";
echo "Valor mensura = ".$lote_valor_mensura."<br>";
echo "Valor total = ".$lote_valor_total."<br>";
echo "Cantidad cuotas = ".$lote_cant_cuotas."<br>";
echo "Cuotas enteras = ".$cant_cuotas_enteras."<br>";
echo "Cuota original (con decimales) = ".$cuota_original."<br>";
echo "Valor anterior redondeado = ".$lote_valor_cuota_entera."<br>";
echo "Valor de la última cuota = ".$lote_valor_ultima_cuota."<br>";

}
?>