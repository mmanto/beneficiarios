<?
include("cabecera.php");
include ("conec.php");

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


//Definicion de variables

              $consulta_fecha = $_POST["consulta_fecha"];
			  $persona_apellido = $_POST["persona_apellido"];
			  $persona_nombre = $_POST["persona_nombre"];
			  $persona_nombre_completo = $_POST["persona_nombre_completo"];
			  $persona_doc_tipo = $_POST["persona_doc_tipo"];
			  $persona_doc_nro_dot = $_POST["persona_doc_nro_dot"];
			  $persona_lote_partido = $_POST["lote_partido"];
			  $lote_circ = $_POST["lote_circ"];
			  $lote_secc = $_POST["lote_secc"];
			  $lote_ch = $_POST["lote_ch"];
			  $lote_qta = $_POST["lote_qta"];
			  $lote_fr = $_POST["lote_fr"];
			  $lote_mz = $_POST["lote_mz"];
			  $lote_pc = $_POST["lote_pc"];
			  $lote_barrio = $_POST["lote_barrio"];
			  $forma_ocupacion = $_POST["forma_ocupacion"];
			  $direccion = $_POST["direccion"];
			  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 14px;
	line-height: 26px;
}
.Estilo2 {
	font-size: 16px;
	font-weight: bold;
}

-->
</style>
</head>

<body onLoad="window.print()">
<table width="580" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="15" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right" class="Estilo1">La Plata, <?
  $fecha = time();
  echo FechaFormateada($fecha);
?> </td>
  </tr>
  <tr>
    <td colspan="2"><p class="Estilo1">Sr. Director Provincial: </p>
    <p class="Estilo1"><img src="imagen/blanco.gif" width="150" height="4" />En respuesta a su solicitud de informe de fecha <?=$consulta_fecha ?> remitida a esta Direcci&oacute;n Provincial de Escrituraci&oacute;n Social, coordinador del Sistema de Beneficiarios de Programas Sociales de Tierras, certifico que la persona que se detalla a continuaci&oacute;n SI registra beneficio anterior en la base de datos del sistema. </p>
    <p class="Estilo1"><img src="imagen/blanco.gif" width="150" height="4" />Una vez establecido dicho beneficio, el mismo deber&aacute; ser incorporado al sistema conforme a la resoluci&oacute;n N&ordm; 46/07. </p></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">INFORMACION DEL BENEFICIARIO </span></td>
  </tr>	
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="Estilo1">Apellido y nombres: <?=$persona_apellido ?> <?=$persona_nombre ?> <?=$persona_nombre_completo ?></td>
  </tr>
  <tr>
    <td colspan="2" class="Estilo1">Tipo y N&ordm; de documento: <?=$persona_doc_tipo ?> <?=$persona_doc_nro_dot ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">INFORMACION DEL INMUEBLE </span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo1">Partido: <?=$persona_lote_partido ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo1">Circunscripci&oacute;n: <?=$lote_circ ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo1">Secci&oacute;n: <?=$lote_secc ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo1">Chacra: <?=$lote_ch ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo1">Quinta: <?=$lote_qta ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo1">Fracci&oacute;n: <?=$lote_fr ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo1">Manzana: <?=$lote_mz ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo1">Parcela: <?=$lote_pc ?></span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="Estilo2">INFORMACION DEL BENEFICIO </span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="Estilo1">Tipo de Beneficio: <?=$forma_ocupacion ?></td>
  </tr
  ><tr>
    <td colspan="2" class="Estilo1">Otorgado por: <?=$direccion ?></td>
  </tr>
  <tr>
    <td height="45" colspan="2" class="Estilo1">&nbsp;</td>
  </tr>
  <tr>
    <td width="477" align="right">Firma y sello </td>
    <td width="93" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="110" align="left" valign="bottom">Departamento Seguimiento y Control Escriturario<br />
    Direcci&oacute;n Provincial de Escrituraci&oacute;n Social </td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
</body>
</html>
