<?

include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$res = mysql_query("SELECT ficha_nro, ficha_miembros_cant FROM dbo_ficha ORDER BY ficha_nro");

while ($ficha = mysql_fetch_array($res)) {

$idFicha = $ficha["ficha_nro"];	
$miembros = $ficha["ficha_miembros_cant"];
	
$res2 = mysql_query("Select Persona_nro FROM dbo_persona WHERE Ficha_nro = $idFicha");
$cant = mysql_num_rows($res2);

/*
$upd = "UPDATE dbo_ficha SET
		ficha_miembros_cant = '$cant'
		WHERE ficha_nro = $idFicha";
		
mysql_query($upd);
*/


echo $idFicha." - ".$cant." - ".$miembros."</br>";
	

}