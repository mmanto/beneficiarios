<?
include ("conec.php");

$idTramite = $_GET["idTramite"];

$SQLtramite = "SELECT * FROM dbo_tramite_ley WHERE Tramite_nro = '$idTramite'";
$resTramite = mysql_query($SQLtramite);
$tramite = mysql_fetch_array($resTramite);
$pdo = $tramite["Tramite_partido"];

$SQLpersona = "SELECT * FROM dbo_persona WHERE Tramite_nro = '$idTramite'";
$resPersona = mysql_query($SQLpersona);
$persona = mysql_fetch_array($resPersona);


//Listado partidos
$strSQL = "SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $pdo";
$respartido = mysql_query($strSQL);
$partido = mysql_fetch_array($respartido);

//Funcion para fecha actual
function FechaFormateada($FechaStamp){
$ano = date('Y',$FechaStamp); //<-- Año
$mes = date('m',$FechaStamp); //<-- número de mes (01-31)
$dia = date('d',$FechaStamp); //<-- Día del mes (1-31)
switch($mes) {
case '01': $mesletra="Enero"; break;
case '02': $mesletra="Febrero"; break;
case '03': $mesletra="Marzo"; break;
case '04': $mesletra="Abril"; break;
case '05': $mesletra="Mayo"; break;
case '06': $mesletra="Junio"; break;
case '07': $mesletra="Julio"; break;
case '08': $mesletra="Agosto"; break;
case '09': $mesletra="Septiembre"; break;
case '10': $mesletra="Octubre"; break;
case '11': $mesletra="Noviembre"; break;
case '12': $mesletra="Diciembre"; break;
}    
return "$dia dias del mes de $mesletra de $ano";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Beneficiarios de Tierras</title>
<style type="text/css">
<!--
body {
	margin-left: 20px;
	margin-top: 20px;
}
</style>

<link href="estilos-tms.css" rel="stylesheet" type="text/css" />

<script language=JavaScript>
<!--

function inhabilitar(){
    alert ("No puede utilizar el boton derecho del mouse.\nPor favor, utilice sólo los comandos en pantalla.\nMuchas Gracias.")
    return false
}

document.oncontextmenu=inhabilitar

// -->
</script>
	
<style type="text/css">
<!--
.Estilo1 {font-size: 20px; margin: 0 0 10px 0;}
.Estilo2 {font-size: 20px; font-weight: bold; margin: 0 0 20px 0;}
.Estilo3 {font-size: 20px; font-weight: bold; }
-->
</style>
</head>

<body onLoad="window.print()">
<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="75" align="right" valign="top"><img src="imagen/logo-ba3.jpg" width="800" height="70" /></td>
  </tr>
</table>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="464" height="30">&nbsp;</td>
    <td width="336">&nbsp;</td>
  </tr>
  <tr>
    <td height="36" colspan="2" align="center"></td>
  </tr>
  <tr>
    <td colspan="2">
	<div align="center"><p class="Estilo2">CONSTANCIA</p></div>
	<p>&nbsp;</p>
	<p class="Estilo1">Por la presente se deja constancia que el/la Sr./Sra. <? echo $persona["Persona_apellido"]; ?>, <? echo $persona["Persona_nombre"]; ?> con Documento Nacional de Identidad N&ordm; <? echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?> ha iniciado el tr&aacute;mite tendiente a la regularizaci&oacute;n dominial en el marco de la Ley 24.374 respecto del inmueble identificado catastralmente como <? echo $tramite["Tramite_nomenc"]; ?> sito en <? echo $persona["Persona_direccion"]; ?> del Partido de <?=$partido["Partido_nombre"]; ?>.</p>
	<p class="Estilo1">Se extiende la presente constancia a pedido del interesado a los <?  $fecha = time();
  echo FechaFormateada($fecha);
?> en un &uacute;nico ejemplar, siendo intransferible y de car&aacute;cter personal, para ser presentado ante quien corresponda.</p>
<p>&nbsp;</p>
	<span class="Estilo3">RESPUESTA ACTIVA<br />
	DIRECCI&Oacute;N DE ACCIONES ESCRITURARIAS<br />
	DIRECCIÓN PROVINCIAL DE REGULARIZACIÓN DEL HÁBITAT<br />
	SUBSECRETARÍA DE HÁBITAT DE LA COMUNIDAD<br />
    </span> 
	MFP
	</td>
  </tr>
  <tr>
    <td height="380" colspan="2">&nbsp;</td>
  </tr>
</table>

</body>
</html>
