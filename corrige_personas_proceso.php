<?
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?php
$cant = $_POST["cant"];

for ($i=1;$i<=$cant;$i++){ 
      //para cada uno de los elementos que puede haber en el formulario
         //es que este registro estaba en el formulario
         $id = $_POST["id".$i];
         
		 $documento = $_POST["documento".$i];
		 
		 
		 $ssql = "update dbo_persona set Persona_dni_nro = $documento where Persona_nro = $id";
         if (mysql_query($ssql))

		 	echo "Dato actualizado<br>";
         else
            echo "<br>Datos NO actualizados<br>";
      }
?>
</body>
</html>
