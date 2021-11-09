<?

if (!$_POST["lote_manzana"] || $_POST["lote_manzana"]=='-') {$lote_manzana = '0';} else {
$Lote_manzana = $_POST["lote_manzana"];
$Lote_mz_limp_01 = ereg_replace("[^0-9]", "", $Lote_manzana);
$Lote_mz_limp_02 = ereg_replace("[^A-Za-z]", "", $Lote_manzana);
$Lote_mz_limp_02 = strtolower($Lote_mz_limp_02 );
$lote_manzana_limp = $Lote_mz_limp_01.$Lote_mz_limp_02;
};

if (!$_POST["lote_parcela"] || $_POST["lote_parcela"]=='-') {$lote_parcela = '0';} else {
$Lote_parcela = $_POST["lote_parcela"];
$Lote_pc_limp_01 = ereg_replace("[^0-9]", "", $Lote_parcela);
$Lote_pc_limp_02 = ereg_replace("[^A-Za-z]", "", $Lote_parcela);
$Lote_pc_limp_02 = strtolower($Lote_pc_limp_02 );
$lote_parcela_limp = $Lote_pc_limp_01.$Lote_pc_limp_02;
};

echo $_POST["lote_manzana"]." | ".$_POST["lote_parcela"]."</br></br>";
echo $lote_manzana_limp." | ".$lote_parcela_limp."</br>";
echo "<a href=\"abc1.php\">Volver</a>";

?>
