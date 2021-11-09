<?
include ("conec.php");

$referencia = $_POST["referencia"];

$destinatario = $_POST["destinatario"];

if ($destinatario == '1') { $destinatario = "Arq. Ruben Opel"; $direccion = "Direcci&oacute;n General Inmobiliaria y Social"; }

if ($destinatario == '2') { $destinatario = "&nbsp;"; $direccion = "Direcci&oacute;n de Regularización"; }

if ($destinatario == '3') { $destinatario = "Agrim. Juan Casazza"; $direccion = "Direcci&oacute;n de Urbanizaciones Sociales Planificadas"; }

if ($destinatario == '4') { $destinatario = "Prof. Graciela Parma"; $direccion = "Direcci&oacute;n Social IVBA"; }

if ($destinatario == '5') { $destinatario = "Dr. Juan Ignacio Bitar"; $direccion = "Direcci&oacute;n de Titularización de Inmuebles"; }

if ($destinatario == '6') { $destinatario = "Abog. Ignacio G. De Carli"; $direccion = "Direcci&oacute;n Prov. de Coord. de Programas Habitacionales"; }

if ($destinatario == '7') { $destinatario = "&nbsp;"; $direccion = "Unidad Administrador Instituto de la Vivienda"; }


$adjuntos = $_POST["cant_informes"];

$tipo_informe = $_POST["tipo_informe"];


if ($tipo_informe == '1') {
$texto = "ninguna de las personas consignadas en el listado adjunto registra beneficio anterior en la base de datos del sistema.";
}else{
$texto = "de las personas consignadas registran beneficio aquellas cuyos informes individuales acompañan a la presente (se adjuntan $adjuntos informes)."; }


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
return "$dia de $mesletra de $ano";
}

/*
$archivo = "contador-notas.txt"; 
$contador = 0; 

$fp = fopen($archivo,"r"); 
$contador = fgets($fp, 26); 
fclose($fp); 

++$contador; 

$fp = fopen($archivo,"w+"); 
fwrite($fp, $contador, 26); 
fclose($fp); 
*/

$SQL35 = mysql_query("SELECT * FROM dbo_settings WHERE Clave = 'Nota_nro'");

$abc = mysql_fetch_array($SQL35);

$contador = $abc["Valor"];

$abc1 = $contador+1;

$SQL36 = mysql_query("UPDATE dbo_settings SET Valor = '$abc1' WHERE idSetting = 1");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema Beneficiarios de Tierras</title>
<style type="text/css">
<!--
body {
	margin-left: 20px;
	margin-top: 20px;
}
</style>

<link href="estilos-tms.css" rel="stylesheet" type="text/css" />

<script>
function pulsar(e) {
  tecla = (document.all) ? e.keyCode :e.which;
  return (tecla!=13);
}
</script> 

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
.Estilo1 {font-size: 20px}
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
    <td>&nbsp;</td>
    <td align="right" class="Estilo1">La Plata, <?
  $fecha = time();
  echo FechaFormateada($fecha);
?></td>
  </tr>
  <tr>
    <td height="20" class="Estilo1">Direcci&oacute;n de Regularizaci&oacute;n </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="20" class="Estilo1">S/D</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="26">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="Estilo1">Ref. <?=$referencia; ?></td>
  </tr>
  <tr>
    <td height="26">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<p>&nbsp;</p>
	<p class="Estilo1">En respuesta a la solicitud de informe  de referencia remitido a esta Subsecretaría Social de Tierras, Urbanismo y Vivienda, la Dirección Provincial de Regularizaci&oacute;n y Escrituración Social, coordinador del Sistema de Beneficiarios del Programa Social de Tierras, certifica que <?=$texto; ?></p>
      <p class="Estilo1">Se hace constar que el presente informe deberá ser agregado a las actuaciones administrativas correspondientes a cada consultado por las que se tramita un beneficio de carácter social en tierra.</p>
      <p><span class="Estilo1">
        <? if ($tipo_informe == '1') { ?>
        Una vez establecido dicho beneficio, el mismo deberá ser incorporado al sistema conforme a la resolución N º 46/07.</span>
      <? } ?>&nbsp;</p></td>
  </tr>
  <tr>
    <td height="380" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" colspan="2" class="Estilo1">Departamento Pre escriturario </td>
  </tr>
  <tr>
    <td height="22" colspan="2" class="Estilo1">DIRECCION PROVINCIAL DE REGULARIZACION Y ESCRITURACION SOCIAL </td>
  </tr>
  <tr>
    <td height="22" colspan="2" class="Estilo1">SUBSECRETARIA SOCIAL DE TIERRAS, URBANISMO Y VIVIENDA </td>
  </tr>
</table>

</body>
</html>
