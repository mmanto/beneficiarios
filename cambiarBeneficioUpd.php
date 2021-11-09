<?php

session_start();


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");
require ("funciones.php");

include ("cabecera.php");

}

$hoy = date("Y-m-d");
$nuevo_lote = $_SESSION['nuevo_lote'];

unset($_SESSION['nuevo_lote']);
//la relacion flia lote insert en historico
//a la flia update nro de lote, etc
$rs_familia  = $_SESSION['flia'];
unset($_SESSION['flia']);

$familiaNro = $rs_familia[0]['Familia_nro'];
//$familia_id_resolucion = $rs_familia[0]['Familia_id_resolucion'];
//$Familia_req_estado = $rs_familia[0]['Familia_req_estado'];
//$Familia_beneficio_marco = $rs_familia[0]['Familia_beneficio_marco'];
//$Familia_domic = $rs_familia[0]['Familia_domic'];
$idUser = $_SESSION["user_id"];
$error = false;

$qry = "SELECT 	Lote_nro, 
				Familia_id_resolucion, 
				Familia_req_estado, 
				Familia_beneficio_marco, 
				Familia_domic
		FROM dbo_familia 
		WHERE Familia_nro = $familiaNro";
$rs = armar_matriz($qry);
$lote_nro = $rs[0]['Lote_nro'];

$familia_id_resolucion = $rs[0]['Familia_id_resolucion']; 
$Familia_req_estado = $rs[0]['Familia_req_estado'];
$Familia_beneficio_marco = $rs[0]['Familia_beneficio_marco']; 
$Familia_domic = $rs[0]['Familia_domic'];

//se pasa la relacion lote flia al histórico
$qry = "INSERT INTO dbo_familia_historico";
$qry .= "(Familia_nro, Lote_nro, Familia_id_resolucion, Familia_req_estado, Familia_beneficio_marco, Familia_domic, insert_fecha, insert_usuario)  ";
$qry .= " values ( $familiaNro, $lote_nro, $familia_id_resolucion, $Familia_req_estado, $Familia_beneficio_marco, '$Familia_domic', '$hoy', $idUser )";
echo "<br>$qry<br>";
$rs = mysql_query($qry);

//se asigna el nuevo lote a la flia
if($rs) {
$qry = "UPDATE dbo_familia 
		set Lote_nro = $nuevo_lote,
		Familia_id_resolucion= 'NULL',
		Familia_req_estado = 0,
		Familia_beneficio_marco = 0,
		Familia_domic = ''";
echo "<br>$qry<br>";
$qry .= " WHERE Familia_nro = $familiaNro";
if(!mysql_query($qry)) {
	$error = true;
	}
} else {
	$error = true;
}


if(!$error){
	echo '<h4><a href="menu.php">Volver al menú</a></h4>';
} else {
	echo "No se puedieron realizar los cambios. Vuelva a intentarlo.";
	echo '<h4><a href="menu.php">Volver al menú</a></h4>';
	exit();
}


//Si el ingreso está ok mostrar mensaje y opción de volver al menu principal






?>