<?

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$res = mysql_query("SELECT Familia_nro, Lote_manzana, Lote_parcela FROM dbo_familia WHERE blnConv = '0' ORDER BY Familia_nro ASC LIMIT 20000");

$cant = mysql_num_rows($res);


echo "Actualizando registros: ";



while ($familia = mysql_fetch_array($res)) {

$idFamilia = $familia["Familia_nro"];


//Manzana
$Lote_manzana = $familia["Lote_manzana"];
$Lote_mz_limp_01 = ereg_replace("[^0-9]", "", $Lote_manzana);
$Lote_mz_limp_02 = ereg_replace("[^A-Za-z]", "", $Lote_manzana);
$Lote_mz_limp_02 = strtolower($Lote_mz_limp_02 );
$Lote_mz_limp = $Lote_mz_limp_01.$Lote_mz_limp_02;


//Parcela
$Lote_parcela = $familia["Lote_parcela"];
$Lote_pc_limp_01 = ereg_replace("[^0-9]", "", $Lote_parcela);
$Lote_pc_limp_02 = ereg_replace("[^A-Za-z]", "", $Lote_parcela);
$Lote_pc_limp_02 = strtolower($Lote_pc_limp_02 );
$Lote_pc_limp = $Lote_pc_limp_01.$Lote_pc_limp_02;


$upd = "UPDATE dbo_familia SET 
Lote_manzana = '$Lote_mz_limp',
Lote_parcela = '$Lote_pc_limp',
blnConv = '1'
where Familia_nro = '$idFamilia'";

if (mysql_query($upd,$link))  { 

echo $idFamilia." - ";


 }else{ echo "error"; }


}

echo "</br></br>Registros actualizados correctamente.<br><a href=\"purge-04.php\">Actualizar siguientes</a>";