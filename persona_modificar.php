<?php

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$Persona_nro = $_POST["Persona_nro"];

$log_direccion = $_POST["idDireccion"];
$log_usuario = $_POST["idUsuario"];
$log_nivel = $_POST["user_nivel"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";

// Desarrollo del proceso para modificar los datos de la persona 

//Definicion de variables de persona

$t1_apellido = $_POST["t1_apellido"];
$t1_nombre = $_POST["t1_nombre"];
$t1_fecha_nac = $_POST["t1_fecha_nac"];
$t1_edad = $_POST["t1_edad"];
$t1_lugar_nac = $_POST["t1_lugar_nac"];
$t1_sexo = $_POST["t1_sexo"];
$t1_nacionalidad = $_POST["t1_nacionalidad"];
$t1_doc_tipo = $_POST["t1_doc_tipo"];
$t1_doc_nro = $_POST["t1_doc_nro"];
$t1_cuil = $_POST["t1_cuil"];
$t1_domicilio = $_POST["t1_domicilio"];
$t1_ecivil = $_POST["t1_ecivil"];
$t1_nupcias = $_POST["t1_nupcias"];
$t1_fechasep = $_POST["t1_fechasep"];
$t1_conyuge_apellido = $_POST["t1_conyuge_apellido"];
$t1_conyuge_nombre = $_POST["t1_conyuge_nombre"];
$t1_padre_apellido = $_POST["t1_padre_apellido"];
$t1_padre_nombre = $_POST["t1_padre_nombre"];
$t1_padre_vive = $_POST["t1_padre_vive"];
$t1_padre_doctipo = $_POST["t1_padre_doctipo"];
$t1_padre_doc = $_POST["t1_padre_doc"];
$t1_madre_apellido = $_POST["t1_madre_apellido"];
$t1_madre_nombre = $_POST["t1_madre_nombre"];
$t1_madre_vive = $_POST["t1_madre_vive"];
$t1_madre_doctipo = $_POST["t1_madre_doctipo"];
$t1_madre_doc = $_POST["t1_madre_doc"];
$t1_renuncia = $_POST["t1_renuncia"];
$t1_sitlaboral = $_POST["t1_sitlaboral"];
$t1_lugar_trabajo = $_POST["t1_lugar_trabajo"];
$t1_oficio = $_POST["t1_oficio"];
$t1_ingresos = $_POST["t1_ingresos"];
$t1_vinculo_t2 = $_POST["t1_vinculo_t2"];
$t1_resid = $_POST["t1_resid"];
$t1_resid_anterior = $_POST["t1_resid_anterior"];


$upd = "UPDATE dbo_persona SET		
		Persona_apellido = '$t1_apellido',
		Persona_nombre = '$t1_nombre',
		Persona_fecha_nac = '$t1_fecha_nac',
		Persona_edad = '$t1_edad',
		Persona_lugar_nac = '$t1_lugar_nac',
		Persona_sexo = '$t1_sexo',
		Persona_nacionalidad = '$t1_nacionalidad',
		Documento_tipo_nro = '$t1_doc_tipo',
		Persona_cuil = '$t1_cuil',
		Persona_domicilio = '$t1_domicilio',
		Estado_civil_nro = '$t1_ecivil',
		Persona_nupcias = '$t1_nupcias',
		Persona_fecha_divorcio = '$t1_fechasep',
		Persona_conyuge_apellido = '$t1_conyuge_apellido',
		Persona_conyuge_nombre = '$t1_conyuge_nombre',
		Persona_padre_apellido = '$t1_padre_apellido',
		Persona_padre_nombre = '$t1_padre_nombre',
		Persona_padre_vive = '$t1_padre_vive',
		Persona_padre_doctipo = '$t1_padre_doctipo',
		Persona_padre_doc = '$t1_padre_doc',
		Persona_madre_apellido = '$t1_madre_apellido',
		Persona_madre_nombre = '$t1_madre_nombre',
		Persona_madre_vive = '$t1_madre_vive',
		Persona_madre_doctipo = '$t1_madre_doctipo',
		Persona_madre_doc = '$t1_madre_doc',
		Persona_renuncia = '$t1_renuncia',
		Persona_sitlaboral = '$t1_sitlaboral',
		Persona_lugar_trab = '$t1_lugar_trabajo',
		Persona_oficio = '$t1_oficio',
		Persona_ingresos = '$t1_ingresos',
		Persona_tpo_resid = '$t1_resid',
		Persona_resid_anterior = '$t1_resid_anterior'
		where Persona_nro = '$Persona_nro'";
?>		

<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>
<?
if (@mysql_query($upd,$link)) {echo "<h2>Los datos han sido actualizado con &eacute;xito</h2>";} else {echo "<b>Error en actualizacion de persona</b>";}
?>
</h2></td>
  </tr>
  <tr>
	  <td height="18" valign="top"><a href="javascript:history.go(-2)">Volver al informe</a></td>
	</tr>
	<tr>
</table>
</html>
</body>