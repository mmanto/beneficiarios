<?
include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$lista = implode(',',$_POST['seleccion']); 

$cant = count($_POST['seleccion']);

echo "<p>".$cant."</p>";




include("pie.php"); ?>