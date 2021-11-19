<?php 

session_start();


if (!isset($_SESSION["user_id"])) {
    
    header("Location: login.php");
    
} else{

#include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$_SESSION['PROJECT_ROOT'] = __DIR__;

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

$res = mysql_query("SELECT * FROM dbo_settings WHERE idSetting = '5'");
$ExpActivo = mysql_fetch_array($res);

$res2 = mysql_query("SELECT * FROM dbo_settings WHERE idSetting = '6'");
$SbtActivo = mysql_fetch_array($res2);

$res3 = mysql_query("SELECT * FROM dbo_settings WHERE idSetting = '7'");
$RHActivo = mysql_fetch_array($res3);


?>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 18px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #999900;
}
-->
</style>


<table width="880" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="22" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="12" colspan="4" align="right"><span class="Estilo1">Usuario: <? echo $usuario_nombre; ?> </span></td>
  </tr>
  <tr>
    <td height="39" colspan="4" align="right"><a href="logout.php">[Salir del sistema]</a></td>
  </tr>
  <tr>
    <td height="42" colspan="4" align="right">&nbsp;</td>
  </tr>
  
<? /*
  <tr>
    <td height="160" colspan="5" align="center"><table width="90%" border="0" cellspacing="0" cellpadding="18">
      <tr>
        <td bgcolor="#FFFF99" style="border: 2px solid #FC6"><p><strong>ATENCI&Oacute;N:</strong> Se informa que el jueves <strong>05/07/2018</strong> entre las <strong>8.00 y 9.30 hs</strong> el sistema NO ESTAR&Aacute; OPERATIVO por tareas de mantenimiento. Se recomienda reprogramar  con la debida anticipaci&oacute;n las tareas que dependan del mismo. Por cualquier  inquietud sobre el particular comunicarse con la Direcci&oacute;n de Gesti&oacute;n  Escrituraria al <strong>interno 147</strong>.</p></td>
      </tr>
    </table></td>
  </tr>
*/ ?>
  
  <tr>
    <td width="230" valign="top">
      <? if($user["HabExp"] != '0' && $ExpActivo["Valor"] != '0') { ?><a href="exptes-listar-area.php?ordenar=1"><img src="imagen/modulo-expedientes-logo.jpg" width="200" height="240" /></a>
    <? }else{ ?>
    <img src="imagen/modulo-expedientes-no-logo.jpg" width="200" height="240" />    <? } ?>	</td>
    <td width="219" align="center" valign="top">
      <? if($user["HabSbt"] != '0' && $SbtActivo["Valor"] != '0') { ?>
      <a href="sbt-menu.php"><img src="imagen/sbt-logo.jpg" width="200" height="240" /></a>
    <? }else{ ?>
    <img src="imagen/sbt-no-logo.jpg" width="200" height="240" />    <? } ?>	</td>
    <td width="222" align="center" valign="top"><? if($user["HabCom"] != '0') { ?>
      <a href="comisiones-listar-area.php"><img src="imagen/modulo-comisiones-logo.jpg" width="200" height="240" /></a>
      <? }else{ ?>
      <img src="imagen/modulo-comisiones-no-logo.jpg" width="200" height="240" />
    <? } ?>      &nbsp;</td>
    <td width="209" align="center" valign="top"><? if($user["HabRH"] != '0' && $RHActivo["Valor"] != '0') { ?>
      <a href="agentes-listar.php"><img src="imagen/modulo-rrhh-logo.jpg" width="200" height="240" /></a>
    <? }else{ ?>
    <img src="imagen/modulo-rrhh-no-logo.jpg" width="200" height="240" />
    <? } ?>&nbsp;</td>
  </tr>
  <tr>
    <td width="230" valign="top">
      <? if($user["HabIntCom"] != '0') { ?><a href="zonas-listar.php"><img src="imagen/modulo-intcom-logo.jpg" width="200" height="240" /></a>
    <? }else{ ?>
    <img src="imagen/modulo-intcom-no-logo.jpg" width="200" height="240" />    <? } ?>	</td>
    <td width="219" align="center" valign="top">&nbsp;</td>
    <td width="222" align="center" valign="top">&nbsp;</td>
    <td width="209" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" colspan="4">&nbsp;</td>
  </tr>
</table>
<? include("pie.php"); ?>
 
<? } ?>
 