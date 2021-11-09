<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$idDireccion = $user["Direccion_nro"];
$idNivel = $user["Usuario_nivel"];



$SQL2 = mysql_query("SELECT * FROM dbo_persona WHERE Persona_apellido LIKE '%$apellido%' AND Tramite_nro != 0 AND blnActivo != '1' order by Persona_nro DESC",$link);

//$SQL1 = mysql_query("SELECT * FROM dbo_persona WHERE Persona_apellido LIKE '%$apellido%' AND blnActivo = 1 AND Tramite_nro != 0 order by Persona_nro DESC",$link);//


//$cant = mysql_num_rows($SQL1);
?>
<style type="text/css">
<!--
.Estilo9 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<table width="750" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="5"><h2>Papelera de registros eliminados</h2></td>
  </tr>
  <tr>
    <td height="6" colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="5" valign="bottom"><a href="sbt-menu.php">Volver al men&uacute;</a></td>
  </tr>
  <tr>
    <td height="8" colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td width="17" height="30" bgcolor="#E1E1E1">&nbsp;</td>
    <td bgcolor="#E1E1E1"><strong>Registros eliminados</strong></td>
    <td width="45" bgcolor="#E6E6E6">&nbsp;</td>
    <td width="44" bgcolor="#E6E6E6">&nbsp;</td>
    <td width="6" bgcolor="#E6E6E6">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="4"><table width="100%" border="0" cellspacing="3" cellpadding="3">
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
<? while ($b2 = mysql_fetch_array($SQL2)) { ?>	  
	  <tr bgcolor="#FCE7C9">
        <td width="64%" height="23" bgcolor="#E7E1DE">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="3%">&nbsp;</td>
              <td width="97%" class="Estilo9"><?=$b2["Persona_apellido"].", ".$b2["Persona_nombre"] ?> | Doc: 
                <? echo number_format($b2['Persona_dni_nro'], 0, '', '.'); ?></td>
              </tr>
          </table></td>
        <td width="12%" align="center" bgcolor="#E7E1DE"><a href=javascript:ventana_modif('tramite-informe.php?idTramite=<?=$b2["Tramite_nro"]; ?>') >Ver informe</a></td>
        <td width="16%" align="center" bgcolor="#E7E1DE">-</td>
	    <td width="8%" align="center" bgcolor="#E7E1DE">
		<? if ($user["p804"]=='1' AND $b2["blnActivo"] != '0') { ?><a href="tramiteley_borrar_confirm.php?idTramite=<?=$b2["Tramite_nro"]; ?>&apellido=<? echo $apellido; ?>"><img src="imagen/delete.gif" width="16" height="16" border="0" alt="Borrar" Title="Borrar"/></a><?  }else{ ?>-<? } ?></td>
	  </tr>
<? } ?>
    </table></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
<? }      
include "pie.php";
?>