<?php

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

$sql = "SELECT * FROM dbo_tramite_ley WHERE Tramite_id_migra != '0' ORDER BY Tramite_nro";
$res = mysql_query($sql);

while ($tramite = mysql_fetch_array($res)) {

$tramite_nro = $tramite["Tramite_nro"];

$cedula = $tramite["Tramite_cedula"];
$plancheta = $tramite["Tramite_plancheta"];
$infdom = $tramite["Tramite_inf_dom"];
$edicto = $tramite["Tramite_edicto"];
$camara = $tramite["Tramite_inf_camara"];

$sumac1 = $cedula+$plancheta+$infdom;

//$sumac1 = $cedula+$plancheta+$infdom+$edicto+$camara;


$sql2 = "SELECT * FROM dbo_persona WHERE Tramite_nro = $tramite_nro";
$res2 = mysql_query($sql2);

$persona = mysql_fetch_array($res2);
$personac1doc = $persona["Persona_dni_nro"];

$sql3 = "SELECT * FROM dbo_persona_control WHERE Persona_dni_nro = $personac1doc";
$res3 = mysql_query($sql3);
$persona_ctrol = mysql_fetch_array($res3);
$personac2doc = $persona_ctrol["Persona_dni_nro"];
$tramitectrol_nro = $persona_ctrol["Tramite_nro"];

$sql4 = "SELECT * FROM dbo_tramite_ley_control WHERE Tramite_nro = $tramitectrol_nro";
$res4 = mysql_query($sql4);
$tramite2 = mysql_fetch_array($res4);

$cedula2 = $tramite2["Tramite_cedula"];
$plancheta2 = $tramite2["Tramite_plancheta"];
$infdom2 = $tramite2["Tramite_inf_dom"];
$edicto2 = $tramite2["Tramite_edicto"];
$camara2 = $tramite2["Tramite_inf_camara"];

$sumac2 = $cedula2+$plancheta2+$infdom2;



if($sumac1 == $sumac2) { $result ="&nbsp;"; }else{ $result = " || ERROR"; } 

echo $personac1doc.$result."</br>";

} //cierre while

?>
