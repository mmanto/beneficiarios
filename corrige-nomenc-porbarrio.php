<?

include ("funciones.php");
include ("conec.php");

$idBarrio = '53';

$sql = "SELECT * FROM dbo_familia where Barrio_nro = '$idBarrio' ORDER BY Familia_nro ASC";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);

while ($familia = mysql_fetch_array($res)) {

$lote_nro = $familia["Lote_nro"];

//Lote
$sql3 = "UPDATE dbo_lote SET  
Lote_seccion = 'B',
Lote_chacra = '0',
Lote_quinta = '26',
Lote_fraccion = '0'
WHERE Lote_nro = $lote_nro";

if (mysql_query($sql3)) {

echo $familia["Lote_nro"]."<br>";

}else{ echo "Error<br>";}
//cierre del while
}