<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include("cabecera.php");
include ("conec.php");
include ("funciones.php");
correcto
$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";
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
    <td height="22">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="389">&nbsp;</td>
    <td width="97" align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="26" rowspan="2">&nbsp;</td>
    <td colspan="2" rowspan="2">&nbsp;</td>
    <td height="12" colspan="2" align="right"><span class="Estilo1">Usuario: <? echo $usuario_nombre; ?> </span></td>
  </tr>
  <tr>
    <td height="28" colspan="2" align="right"><a href="logout.php">[Salir del sistema]</a></td>
  </tr>
  
  
  <tr>
    <td height="28">&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
    <td align="center" valign="bottom">&nbsp;</td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" align="center">
	<? if($user["HabExp"] != '0') { ?><a href="exptes-listar-area.php"><img src="imagen/exp-logo.png" border="0" /></a>
	<? }else{ ?><img src="imagen/exp-no-logo.png" /><? } ?>	</td>
    <td align="center" valign="bottom">
	<? if($user["HabSbt"] != '0') { ?><a href="menu.php"><img src="imagen/sbt-logo.png" border="0" /></a>
	<? }else{ ?><img src="imagen/sbt-no-logo.png" /><? } ?>	</td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="100">&nbsp;</td>
    <td width="352">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<? include("pie.php"); ?>
<? } ?>
