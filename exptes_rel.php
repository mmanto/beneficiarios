<?

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$sql = "SELECT Familia_nro, Expte_esc_nro FROM dbo_familia WHERE Expte_esc_nro != '0' AND blnConv3 = '0' LIMIT 0,200";
$res = mysql_query($sql);
$num = '1';

while ($familia = mysql_fetch_array($res)) {

$familia_nro = $familia["Familia_nro"];

$expte_nro = $familia["Expte_esc_nro"];

$sql2 = "INSERT INTO dbo_exptes_rel (
		Familia_nro,
		Expte_esc_nro,
		Expte_rel_condicion
		)VALUES(
		'$familia_nro',
		'$expte_nro',
		'1'
		)";

if(mysql_query($sql2)) {


	$sql3 = "UPDATE dbo_familia SET blnConv3 = '1' WHERE Familia_nro = $familia_nro";
	if(mysql_query($sql3)) {
	
	echo $num." - Alta de relacion correcta (Familia ".$familia_nro.")</br>"; 

$num++;

}else{ echo "Error</br>"; }

}

} //fin del while