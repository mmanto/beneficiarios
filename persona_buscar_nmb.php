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

if (!$_GET["apellfind"]) {echo "<h2>Debe ingresar al menos el apellido para efectuar la busqueda</h2>
<p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{


$apellido = $_GET["apellfind"];
$nombre = $_GET["nmbfind"];


//Datos del beneficiario

if(empty($_GET["nmbfind"])) {
	
$sql = "SELECT Persona_nro, Persona_apellido, Persona_nombre, Familia_nro FROM dbo_persona WHERE Persona_apellido LIKE '%$apellido%' AND blnActivo = 1";

}else{

$sql = "SELECT Persona_nro, Persona_apellido, Persona_nombre, Familia_nro FROM dbo_persona WHERE Persona_apellido LIKE '%$apellido%' AND Persona_nombre LIKE '%$nombre%' AND blnActivo = 1";
	
}


$res = mysql_query($sql);

$cant = mysql_num_rows($res);

if ($cant == 0) {	

	 ?>
<h2>No hay registros que concuerden con la b&uacute;squeda </h2>
<p><a href="persona_buscar_nmb_form.php">Realizar una nueva b&uacute;squeda</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? } else { ?>

<table width="800" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Informe de beneficiario de tierras </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="25" colspan="2" valign="bottom"><a href="persona_buscar_nmb_form.php">Realizar nueva b&uacute;squeda</a> | <a href="sbt-menu.php">Volver al men&uacute;</a></td>
  </tr>
  <tr>
    <td height="8" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" colspan="2" bgcolor="#E6E6E6"><h3><strong class="titulodato">Se han encontrado <?=$cant; ?> coincidencias:  </strong></h3></td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="left">
	
	
	  <table width="100%" border="0" cellspacing="3" cellpadding="5">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="26" align="center" bgcolor="#EFDFAD"><strong>Beneficiario</strong></td>
        <td align="center" bgcolor="#EFDFAD"><strong>Barrio</strong></td>
        <td align="center" bgcolor="#EFDFAD"><strong>Tarjeta Nro.</strong></td>
        <td bgcolor="#EFDFAD">&nbsp;</td>
      </tr>
<? 
$num_fila = "0";

while ($persona = mysql_fetch_array($res)) {
	
$persona_nro = $persona["Persona_nro"];

$familia_nro = $persona["Familia_nro"];

$sql2 = "SELECT Barrio_nro FROM dbo_familia WHERE Familia_nro = $familia_nro";
$res2 = mysql_query($sql2);
$familia = mysql_fetch_array($res2);


$idBarrio = $familia["Barrio_nro"];
$sqlb = "SELECT
Barrio_nro,
Barrio_nombre,
Barrio_conurbano
FROM dbo_barrio
WHERE Barrio_nro = $idBarrio";
$bar = mysql_query($sqlb);
$barrio = mysql_fetch_array($bar);
$barrio_nombre = $barrio["Barrio_nombre"];

//$res = mysql_query("SELECT Persona_apellido, Persona_nombre FROM dbo_persona WHERE Familia_nro = $familia_nro AND Persona_apellido LIKE '%$apellido%' AND blnActivo = 1 LIMIT 0,1");
//$persona = mysql_fetch_array($res);	

$sql3 = "SELECT * FROM dbo_tarjeta WHERE Persona_nro = $persona_nro LIMIT 0,1";
$res3 = mysql_query($sql3);
$tarjeta = mysql_fetch_array($res3);

	 ?>	  
	  <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#F4ECDF\""; }else{ echo "bgcolor=\"#F1E4D3\"";} ?>>
        <td width="37%" height="20">
          <strong><?=$persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></strong></td>
        <td width="28%" align="center"><?=$barrio_nombre; ?></td>
        <td width="23%" align="center">
		<?
        if(mysql_num_rows($res3) > '0') {echo $tarjeta["Tarjeta_numero"];
		}else{
		echo "Sin Tarjeta Asignada";		
		}
		?></td>
        <td width="12%" align="center">
          <a href="javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$persona["Familia_nro"]; ?>')">
          Ver informe</a></td>
        </tr>
<?

$num_fila++;

 } ?>
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