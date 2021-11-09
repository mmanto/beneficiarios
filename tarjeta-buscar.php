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


$tarj_busqueda_1 = "620000149000";

$tarj_busqueda_2 = $_GET["tarjfind"];



$tarj_busqueda = $tarj_busqueda_1.$tarj_busqueda_2;


if (!$tarj_busqueda) {echo "<h2>Por favor, ingrese un numero de tarjeta</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{


$SQL = mysql_query("SELECT Tarjeta_nro, Persona_nro FROM dbo_tarjeta WHERE Tarjeta_numero = $tarj_busqueda AND blnActivo = '1'");

$cant = mysql_num_rows($SQL);

if ($cant == 0) { ?>
<h2>No hay registros que concuerden con la b&uacute;squeda </h2>
<p><a href="tarjeta-buscar-form.php">Realizar una nueva b&uacute;squeda</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? } else {
	
$tarjeta = mysql_fetch_array($SQL);

?>

<table width="750" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Informe de beneficiario de tierras </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="25" colspan="2" valign="bottom"><a href="tarjeta-buscar-form.php">Realizar nueva b&uacute;squeda</a> | <a href="menu.php">Volver al men&uacute;</a></td>
  </tr>
  <tr>
    <td height="8" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" colspan="2"><table width="100%" border="0" cellpadding="12" cellspacing="0" bgcolor="#FFFF99">
    </table></td>
  </tr>
  <tr>
    <td height="4" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" colspan="2" bgcolor="#E6E6E6"><h3><strong class="titulodato">Se han encontrado las siguientes coincidencias:  </strong></h3></td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="left">
	
	
	  <table width="100%" border="0" cellspacing="3" cellpadding="3">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  <tr bgcolor="#FCE7C9">
        <td width="43%" align="center" bgcolor="#D2E7C0"><strong>Tarjeta: </strong><?=$tarj_busqueda; ?></td>
        <td width="29%" height="23" align="center" bgcolor="#D2E7C0">
        <a href="tarjeta-pagos-historial.php?idTarjeta=<? echo $tarjeta["Tarjeta_nro"]; ?>">Ver historial de pagos</a></td>
        <td width="28%" align="center" bgcolor="#D2E7C0">
<?

$persona_nro = $tarjeta["Persona_nro"];

if($persona_nro != '0') {

$res2 = mysql_query("SELECT Persona_nro, Familia_nro FROM dbo_persona WHERE Persona_nro = $persona_nro AND blnActivo = '1'");
$persona = mysql_fetch_array($res2);
		
        ?>
        <a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$persona["Familia_nro"]; ?>')>Ver beneficio asociado</a>
<? }else{ ?>
No hay beneficio asociado
<? } ?>        
        </td>
        </tr>
    </table>	</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<? }    }   
include "pie.php";
?>
<? } ?>