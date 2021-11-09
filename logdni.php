<?php

include ("conec.php");

$dni = $_GET["q"];

$sqlp = "SELECT Persona_nro, Persona_dni_nro FROM dbo_Persona WHERE Persona_dni_nro='$dni' AND Familia_nro IS NOT NULL";
@$respersona = mysql_query ($sqlp,$link);
@$rsPersona = mysql_fetch_array ($respersona);

@$cant_per = mysql_num_rows($respersona);

if ($cant_per > 0) {

echo "<font-color:\"#FF0000\"><b>ATENCION: Esta persona ya se encuentra registrada en la base de datos";
 }
 else {
 echo "";
 }
 ?>
