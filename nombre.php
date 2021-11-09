<?

$ruta = "./pedidos-tarjetas/";

$nmbArchivo = "aaa.txt";

//$nmbArchivo = "ALT".date("Y").date("m").date("d").".txt";

if ($file = fopen($ruta.$nmbArchivo, "a+")) { echo "Ok"; }else{echo "error"; }

fclose($file);

?>