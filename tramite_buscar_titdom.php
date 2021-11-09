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


$titdom = $_GET["titdom"];

if (!$titdom) {echo "<h2>Por favor, ingrese una referencia de titular dominial</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{

//Datos del titular 1
$SQL1 = mysql_query("SELECT * FROM dbo_tramite_ley WHERE Tramite_titdom LIKE '%$titdom%' AND blnActivo = 1",$link);


$cant = mysql_num_rows($SQL1);
?>
<style type="text/css">
<!--
.Estilo9 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<?


if ($cant == 0) { ?>

<h2>No hay registros que concuerden con la b&uacute;squeda (<?=$titdom; ?>)</h2>
<p><a href="tramite_buscar_titdom_form.php">Realizar una nueva b&uacute;squeda</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? } else {

?>

<table width="750" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="6"><h2>Informe de beneficiario de tierras </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="6">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="25" colspan="6" valign="bottom"><a href="tramite_buscar_nmb_form.php">Realizar nueva b&uacute;squeda</a> | <a href="sbt-menu.php">Volver al men&uacute;</a></td>
  </tr>
  <tr>
    <td height="8" colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" colspan="6" bgcolor="#E6E6E6"><h3><strong class="titulodato">Se han encontrado las siguientes coincidencias:  </strong></h3></td>
  </tr>
  <tr>
    <td width="17">&nbsp;</td>
    <td colspan="5" align="left">
	
	
	  <table width="100%" border="0" cellspacing="3" cellpadding="3">
      <tr>
        <td>&nbsp;</td>
        <td width="15%">&nbsp;</td>
      </tr>
<? while ($tramite = mysql_fetch_array($SQL1)) { ?>	  
	  <tr bgcolor="#FCE7C9">
        <td width="85%" height="23" bgcolor="#EDE8D1">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="3%">&nbsp;</td>
              <td width="97%"><strong>Titular dominial: </strong><?=$tramite["Tramite_titdom"]; ?> <strong>| Oficio cámara:</strong> <?=$tramite["Tramite_oficamara"]; ?></td>
              </tr>
          </table></td>
        <td align="center" bgcolor="#EDE8D1"><a href=javascript:ventana_modif('tramite-informe.php?idTramite=<?=$tramite["Tramite_nro"]; ?>') >Ver informe</a>        </td>
        </tr>
<? } ?>
    </table>	</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td width="36">&nbsp;</td>
    <td width="602">&nbsp;</td>
    <td width="45">&nbsp;</td>
    <td width="44">&nbsp;</td>
    <td width="6">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
</table>
<? }    }   
include "pie.php";
?>
<? } ?>