<?

$idBarrio = '23'; 

include ("conec.php");


$sql = "SELECT * FROM dbo_familia where Barrio_nro = '$idBarrio' ORDER BY Familia_nro ASC";

$res = mysql_query($sql);

$cant = mysql_num_rows($res);

echo "<p>Cantidad: ".$cant."</p>";

///// Comienzo del bucle /////


while ($familia = mysql_fetch_array($res)) {

$numFlia = $familia["Familia_nro"];

/*$sql2 = "UPDATE dbo_persona SET Barrio_nro_prov = '$idBarrio' WHERE Familia_nro = $numFlia";

if(mysql_query($sql2)) { echo "Actualizado</br>"; }else{ echo "Error</br>"; }
*/
echo $numFlia."</br>";


}

?>