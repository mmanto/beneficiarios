<?php
session_start();


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{


include ("conec.php");
require ("funciones.php");

include ("cabecera.php");

}
$error = false;

//Sacar total de seleccionados
$totalPersonas = $_POST['totalPersonas'];
$familiaNro = $_POST['familiaNro'];
$nros_personas = $_POST['seleccion'];
$totalSeleccionados = count($nros_personas); 
$hoy = date("Y-m-d");
$idUser = $_SESSION["user_id"];





//si no quedan integrantes en la familia
if ($totalPersonas == $totalSeleccionados){
	//obtengo el lote asociado a la flia
	$qry = "SELECT Lote_nro FROM dbo_familia WHERE Familia_nro = $familiaNro";
	$rs = armar_matriz($qry);
	$lote_nro = $rs[0]['Lote_nro'];
	
	//se pasa la relacion lote flia al histórico
	
	$qry = "INSERT INTO dbo_familia_historico (Familia_nro, Lote_nro, insert_fecha, insert_usuario) values ";
	$qry .= "( $familiaNro, $lote_nro, '$hoy', $idUser )";
	$rs = mysql_query($qry);
	
	if($rs) {
		//saca la referencia a la flia en la tabla persona
		$qry = "UPDATE dbo_familia SET Lote_nro = NULL ";
		$qry .= "WHERE Familia_nro = $familiaNro";
		mysql_query($qry);
	} else {
		$error = true;
	} 
	
	
}


//baja a las personas
if (!$error) {
	foreach ($nros_personas as $id){
		//guarda la relacion persona - flia en el historico	 
		$qry = "INSERT INTO dbo_persona_historico (Persona_nro, Familia_nro, insert_fecha, insert_usuario) values ";
		$qry .= "( $id, $familiaNro, '$hoy', $idUser )";
		mysql_query($qry);
			
		//saca la referencia a la flia en la tabla persona	
		$qry = "UPDATE dbo_persona SET Familia_nro = NULL ";
		$qry .= "WHERE Persona_nro = $id";
		mysql_query($qry);	
	} 
}

if(!$error){
	echo '<h4><a href="menu.php">Volver al menú</a></h4>';
} else {
	echo "No se puedieron realizar los cambios. Vuelva a intentarlo.";
	echo '<h4><a href="menu.php">Volver al menú</a></h4>';
	exit();
}




?>