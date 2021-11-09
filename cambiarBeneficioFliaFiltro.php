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
<script type="text/javascript">
function validarDNI(){
	if (document.getElementById('dni').value == 0) {
		alert ('debe ingresar dni.');
		return false;
	}
	return true;
}


</script>

</head>
<body>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h1>Cambiar lote a una familia</h1></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
  <tr>
	  <td height="30"><h2>1 - Ingresar DNI de un integrante de la familia.</h2></td>
  </tr>
</table>

<form action="cambiarBeneficioFlia.php" method="post" enctype="multipart/form-data" name="f" id="f">
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
        		<td width="200" height="18" class="nombrecampo">DNI:</td>
      		</tr>  
      		<tr>
        		<td><input type="text" name="dni" id="dni"></td>
    		</tr>
    	</table>
    </td>
  </tr>
  <tr>
  	<td align="center">
    	<br>
    	<input type="submit" name="Submit" value="Aceptar" onclick="return validarDNI()">
    </td>
   </tr>
</table>

</form>



</body>
</html>