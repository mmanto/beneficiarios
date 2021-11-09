<?

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$lote_nro = $_POST["lote_nro"];
$origen = $_POST["origen"];

$sqlFam = mysql_query("SELECT Familia_nro FROM dbo_familia WHERE Lote_nro = $lote_nro",$link);
$familia = mysql_fetch_array($sqlFam);
$familia_nro = $familia["Familia_nro"];

$Partido_nro = $_POST["idPartido"];

if (!$_POST["lote_circ"] || $_POST["lote_circ"]=='-' || $_POST["lote_circ"]=='0') {$lote_circ = '0';} else {$lote_circ = $_POST["lote_circ"];};
if (!$_POST["lote_secc"] || $_POST["lote_secc"]=='-' || $_POST["lote_secc"]=='0') {$lote_secc = '0';} else {$lote_secc = $_POST["lote_secc"];};
if (!$_POST["lote_ch"] || $_POST["lote_ch"]=='-' || $_POST["lote_ch"]=='0') {$lote_ch = '0';} else {$lote_ch = $_POST["lote_ch"];};
if (!$_POST["lote_qta"] || $_POST["lote_qta"]=='-' || $_POST["lote_qta"]=='0') {$lote_qta = '0';} else {$lote_qta = $_POST["lote_qta"];};
if (!$_POST["lote_fracc"] || $_POST["lote_fracc"]=='-' || $_POST["lote_fracc"]=='0') {$lote_fracc = '0';} else {$lote_fracc = $_POST["lote_fracc"];};
if (!$_POST["lote_manzana"] || $_POST["lote_manzana"]=='-' || $_POST["lote_manzana"]=='0') {$lote_manzana = '0';} else {$lote_manzana = $_POST["lote_manzana"];};
if (!$_POST["lote_parcela"] || $_POST["lote_parcela"]=='-' || $_POST["lote_parcela"]=='0') {$lote_parcela = '0';} else {$lote_parcela = $_POST["lote_parcela"];};
if (!$_POST["lote_subpc"] || $_POST["lote_subpc"]=='-' || $_POST["lote_subpc"]=='0') {$lote_subpc = '0';} else {$lote_subpc = $_POST["lote_subpc"];};


$upd = "UPDATE dbo_lote	SET
		Partido_nro = '$Partido_nro',
		Lote_circunscripcion = '$lote_circ',
		Lote_seccion = '$lote_secc',
		Lote_chacra = '$lote_ch',
		Lote_quinta = '$lote_qta',
		Lote_fraccion = '$lote_fracc',
		Lote_manzana = '$lote_manzana',
		Lote_parcela = '$lote_parcela',
		Lote_subparcela = '$lote_subpc'
		where Lote_nro = '$lote_nro'";
		
		if(mysql_query($upd,$link)) {
		
		$upd2 = "UPDATE dbo_familia SET
		blnEscritura = '1'
		where Familia_nro = '$familia_nro'";
		mysql_query($upd2,$link);
		
		
		?>
		<h2>Información actualizada correctamente</h2> 
		<p><a href="<?=$origen; ?>?idFamilia=<?=$familia_nro; ?>">Volver al informe</a></p>
		<p>
		  <?
				
		}else{
		
		?>
		</p>
		<h2>La información no pudo ser actualizada. Por favor contacte al administrador</h2> 
		<p><a href="<?=$origen; ?>?idFamilia=<?=$familia_nro; ?>">Volver al informe</a></p>

<? 
	}
		?>