<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$idDireccion = $user["Direccion_nro"];
$idNivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

$sqlDir = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dir = mysql_fetch_array($sqlDir);
$dirNombre = $dir["Direccion_nombre"];

$sqlDirProv = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dirprov = mysql_fetch_array($sqlDirProv);
$dirProvNombre = $dir["Direccion_dirprov"];

//////////////////**************////////////////////

include ("funciones.php");

$exptenum = $_GET["id"];

$sql = "SELECT * FROM dbo_expte_esc WHERE Expte_nro = $exptenum";

$sql3 = mysql_query($sql);

$expte = mysql_fetch_array($sql3);	

$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_barrio = $expte["Expte_barrio"];
$expte_cuerpo = $expte["Expte_cuerpo"];
$expte_mov = $expte["Expte_mov"];
$expte_alcance = $expte["Expte_alcance"];
$expte_beneficios = $expte["Expte_beneficios"];
$expte_fechamov = cambiaf_a_normal($expte["Expte_fechamov"]);
$expte_envio_egg = cambiaf_a_normal($expte["Expte_envio_egg"]);
$expte_partido = $expte["idPartido"];
$expte_origen = $expte["Expte_origen"];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Alta expediente escrituración</title>
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
<?php

//include ("cabecera.php");
include ("conec.php");

$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);



?>

<!--Script para corroborar si el titular ya existe en la base de datos-->

 <table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Informaci&oacute;n de expediente </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="exptes_listar.php?<? echo $linkvar; ?>">Volver al listado </a></td>
	</tr>
	<tr>
	  <td height="15"></td>
  </tr>
</table>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="67" height="24" valign="bottom"  >Caract.</td>
        <td width="70" valign="bottom"  >N&uacute;m.</td>
        <td width="82" valign="bottom"  >A&ntilde;o</td>
        <td height="16" valign="bottom"  >Alcance</td>
        <td width="68" height="16" valign="bottom"  >Cuerpo</td>
        <td width="245" valign="bottom">Direcci&oacute;n de origen</td>
      </tr>
      <tr>
        <td><?=$expte_caract; ?></td>
        <td><?=$expte_num; ?></td>
        <td><?=$expte_anio; ?></td>
        <td><?=$expte_alcance; ?></td>
        <td><?=$expte_cuerpo; ?></td>
        <td>
		<? if ($expte_origen == '1') { ?>Dirección de Reg. Urbana y Dominial<? } ?>
		<? if ($expte_origen == '2') { ?>Dirección del Plan Familia Propietaria<? } ?>
		</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td width="68">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="189" height="24" valign="bottom"  >Nro. Partido</td>
        <td width="178" valign="bottom"  >Barrio</td>
        <td width="123" height="16" valign="bottom"  >Fecha Env&iacute;o a EGG </td>
        <td width="110" valign="bottom">Cant. beneficios </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><?=$expte_envio_egg; ?></td>
        <td><?=$expte_beneficios; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table> 
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="252" height="24" valign="bottom"  >Ultimo movimiento en EGG </td>
        <td width="150" valign="bottom"  >Fecha (&uacute;ltimo mov). </td>
        <td colspan="2" rowspan="2" valign="bottom"  ><table width="100%" border="0" cellpadding="8" cellspacing="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      <tr>
        <td><?=$expte_mov; ?></td>
        <td><?=$expte_fechamov; ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="7"></td>
  </tr>
</table>
  <table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="99"></td>
  </tr>
  <tr>
    <td width="481" align="right">&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<? } ?>
