<?php
session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");


$cantTitulares =  $_POST['cantTitulares'];

for($i = 0; $i < $cantTitulares; $i++ ){
	if ($_POST['t1_apellido'.$i]){
		$t1_apellido = $_POST["t1_apellido".$i];
		$t1_nombre = $_POST["t1_nombre".$i];
		$t1_doc_tipo = $_POST["selectTipoDoc".$i];
		
		if (!$_POST["t1_doc_nro".$i]) {$t1_doc_nro = '0'; }else{ $t1_doc_nro = $_POST["t1_doc_nro".$i];};
		$t1_cuil = $_POST["t1_cuil".$i];
		$t1_ingresos = $_POST["t1_ingresos".$i];
		$telefono = $_POST["Familia_telefono".$i];

		//Definicion de variables del titular
		echo "<br>$t1_apellido";
		echo "<br>$t1_nombre";
		echo "<br>$t1_doc_tipo";
		echo "<br>$t1_cuil";
		echo "<br>$t1_doc_nro";
		echo "<br>$t1_ingresos";
		echo "<br>$telefono<br>";
		
		            //////////////////////////////////////////////////////////
		            //  Antes de procesar la informacion, corroboro que el  //
		            // titular no exista ya incorporado en la base de datos //
		            //////////////////////////////////////////////////////////
		
		$sqlp = "SELECT Persona_dni_nro FROM dbo_Persona WHERE Persona_dni_nro='$t1_doc_nro'
				AND Documento_tipo_nro =  '$t1_doc_tipo'
				AND Familia_nro IS NOT NULL";
		@$respersona = mysql_query ($sqlp,$link);
		@$rsPersona = mysql_fetch_array ($respersona);
		
		@$cant_per = mysql_num_rows($respersona);
		
		if ($cant_per > 0) {
			echo "<h2>El titular".$t1_apellido." ".$t1_nombre." ya posee asignado un beneficio</h2>";?><h4><a href="javascript:history.go(-1)">Volver al formulario</a></h4><?
			exit();
		}

                /////////////////////////////////////////////////
                //  Fin comprobación de existencia de titular  //
				//   A partir de aquí, procesamiento de datos  //
                /////////////////////////////////////////////////
                
	}
}
}
?>