
<?php

phpinfo();
$enlace = mysql_connect("127.0.0.1", "root", "manto21", "mytierras");
mysql_select_db("mytierras",$enlace);

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuraci�n: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuraci�n: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {
	echo "�xito: Se realiz� una conexi�n apropiada a MySQL. " . PHP_EOL;
	echo "Informaci�n del host: " . mysql_get_host_info($enlace) . PHP_EOL;
	$query = mysql_query("SELECT * FROM dbo_usuarios WHERE usuario = 'andres'" )  or die(mysql_error());
	$data = mysql_fetch_array($query);
	
	print $data['Usuario'];
	mysql_close($enlace);
	}

?>
