<?

include ("conec.php");

$log_direccion = $_GET["nbsp567"];
$log_usuario = $_GET["qprst645"];
$log_nivel = $_GET["ghlst251"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema Beneficiarios de Tierras</title>
<style type="text/css">
<!--
body {
	margin-left: 70px;
	margin-top: 20px;
}
</style>

<link href="estilos.css" rel="stylesheet" type="text/css" />

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
</head>

<body>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="75" valign="top"><img src="imagen/logo.jpg" width="600" height="63" /></td>
  </tr>
</table>

<form action="consulta_textarea.php" method="POST">
<input type="hidden" name="log_usuario" value="<?=$log_usuario ?>" />
<input type="hidden" name="log_direccion" value="<?=$log_direccion ?>" />
<input type="hidden" name="log_nivel" value="<?=$log_nivel ?>" />
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><h2>B&uacute;squeda de Beneficio por N&ordm; de documento  </h2></td>
    <td width="34" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="16" colspan="4"><a href="javascript:history.go(-1)">Volver al panel de administraci&oacute;n </a></td>
  </tr>
  <tr>
    <td width="35" rowspan="5">&nbsp;</td>
    <td width="213" height="35">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="15" align="right">1.</td>
      </tr>
      <tr>
        <td height="15" align="right">2.</td>
      </tr>
      <tr>
        <td height="15" align="right">3.</td>
      </tr>
      <tr>
        <td height="15" align="right">4.</td>
      </tr>
      <tr>
        <td height="15" align="right">5.</td>
      </tr>
      <tr>
        <td height="15" align="right">6.</td>
      </tr>
      <tr>
        <td height="15" align="right">7.</td>
      </tr>
      <tr>
        <td height="15" align="right">8.</td>
      </tr>
      <tr>
        <td height="15" align="right">9.</td>
      </tr>
      <tr>
        <td height="15" align="right">10.</td>
      </tr>
      <tr>
        <td height="15" align="right">11.</td>
      </tr>
      <tr>
        <td height="15" align="right">12.</td>
      </tr>
      <tr>
        <td height="15" align="right">13.</td>
      </tr>
      <tr>
        <td height="15" align="right">14.</td>
      </tr>
      <tr>
        <td height="15" align="right">15.</td>
      </tr>
      <tr>
        <td height="15" align="right">16.</td>
      </tr>
      <tr>
        <td height="15" align="right">17.</td>
      </tr>
      <tr>
        <td height="15" align="right">18.</td>
      </tr>
      <tr>
        <td height="15" align="right">19.</td>
      </tr>
      <tr>
        <td height="15" align="right">20.</td>
      </tr>
      <tr>
        <td height="15" align="right">21.</td>
      </tr>
      <tr>
        <td height="15" align="right">22.</td>
      </tr>
      <tr>
        <td height="15" align="right">23.</td>
      </tr>
      <tr>
        <td height="15" align="right">24.</td>
      </tr>
      <tr>
        <td height="15" align="right">25.</td>
      </tr>
      <tr>
        <td height="15" align="right">26.</td>
      </tr>
      <tr>
        <td height="15" align="right">27.</td>
      </tr>
      <tr>
        <td height="15" align="right">29.</td>
      </tr>
      <tr>
        <td height="15" align="right">30.</td>
      </tr>
      <tr>
        <td height="15" align="right">31</td>
      </tr>
      <tr>
        <td height="15" align="right">32</td>
      </tr>
      <tr>
        <td height="15" align="right">33.</td>
      </tr>
      <tr>
        <td height="15" align="right">34.</td>
      </tr>
      <tr>
        <td height="15" align="right">35.</td>
      </tr>
    </table></td>
    <td width="142" height="30" valign="top"><label>
      <textarea name="textArea" cols="15" rows="33" id="textArea"></textarea>
    </label></td>
    <td width="176" valign="top"><p><strong>ATENCI&Oacute;N:</strong></p>
      <p>- Ingrese los n&uacute;meros de documentos de a uno por linea, sin punto separador de miles.</p>
      <p>- No ingrese m&aacute;s de 32 n&uacute;meros de DNI por consulta (para ayudarse cuenta con el indicador junto al campo de carga). </p>
      <p>- Cuide que no queden espacios en blanco al final del listado. </p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input name="cmdLogin" type="submit" id="cmdLogin" value="Buscar"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<?       
include "pie.php";
?>
