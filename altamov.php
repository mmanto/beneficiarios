<?

include ("conec.php");

$ins = "INSERT INTO dbo_exptes_mov (
	Expte_mov_fecha,
	Expte_mov_hora )VALUES(
	CURRENT_DATE,
	CURRENT_TIME)";
	
if (mysql_query($ins,$link)) { echo "OK"; }

?>