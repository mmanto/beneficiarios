<?php
session_start();


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");
require ("funciones.php");
include ("cabecera.php");

}

?>

<html>
<head>
</head>
<body>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Generar listado txt para tarjetas de pagos</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php">Volver al panel de administraci�n</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="generarNrosTarjetasPagos.php" method="post" enctype="multipart/form-data" name="f" id="f">
<table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="200" border="0" cellspacing="0" cellpadding="0">
    </table></td>
  </tr>
  
  <tr>
    <td>
    	<table width="200" border="0" cellspacing="0" cellpadding="0">
      		<tr>
        		<td width="200" height="18" class="nombrecampo">Nro de Resoluci�n</td>
      		</tr>  
      		<tr>
        		<td><input type="text" name="nroResolucion" id="nroResolucion"></td>
    		</tr>
    	</table>
    </td>
  </tr>
  <tr>
  	<td align="center">
    	<br>
    	<input type="submit" name="Submit" value="Aceptar">
    </td>
   </tr>
</table>

</form>

</body>
</html>
