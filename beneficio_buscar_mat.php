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


$matricula = $_GET["matricula"];

if (!$matricula) {echo "<h2>Por favor, ingrese un numero de matricula</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{

$sql2 = "SELECT * FROM dbo_familia WHERE Familia_matricula = $matricula AND blnActivo = 1";
$res2 = mysql_query($sql2);
$familia = mysql_fetch_array($res2);
$familia_nro = $familia["Familia_nro"];
//$matricula = $familia["Familia_matricula"];



//Datos del titular 1
$SQL1 = mysql_query("SELECT * FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro)
WHERE Familia_nro =  $familia_nro AND blnActivo = 1 order by Persona_nro ASC LIMIT 0,1",$link);


$cant = mysql_num_rows($SQL1);

if ($cant == 0) { ?>
<h2>No hay registros que concuerden con la b&uacute;squeda </h2>
<p>&nbsp;</p>
<p><a href="beneficio_buscar_mat_form.php">Realizar una nueva b&uacute;squeda</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<? } else {

?>

<table width="750" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Informe de beneficiario de tierras </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="25" colspan="2" valign="bottom"><a href="persona_buscar_doc_form.php">Realizar nueva b&uacute;squeda</a> | <a href="sbt-menu.php">Volver al men&uacute;</a></td>
  </tr>
  <tr>
    <td height="8" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" colspan="2"><table width="100%" border="0" cellpadding="12" cellspacing="0" bgcolor="#FFFF99">
      <tr>
        <td>Atenci&oacute;n: En caso de existir m&aacute;s de un resultado para su b&uacute;squeda, &eacute;stas aparecen ordenadas desde la m&aacute;s actualizada a la m&aacute;s antigua. Para cada resultado encontrar&aacute;, adem&aacute;s,  acceso al informe individual de la persona y al informe completo del bien relacionado. </td>
      </tr>
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
        <td colspan="4">&nbsp;</td>
      </tr>
<? while ($b1 = mysql_fetch_array($SQL1)) {
$b1_numero = $b1["Persona_nro"];
$b1_familia = $b1["Familia_nro"];
$b1_apellido = $b1["Persona_apellido"];
$b1_nombre = $b1["Persona_nombre"];
$b1_nombre_completo = $b1["Persona_nombre_completo"];
$b1_doc_tipo = $b1["Documento_tipo_nombre"];
$b1_doc_nro = $b1["Persona_dni_nro"];
$b1_doc_nro_dot = $b1_doc_nro;	  




?>	  
	  <tr bgcolor="#FCE7C9">
        <td width="49%" height="23" bgcolor="#EDE8D1">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="4%">&nbsp;</td>
              <td width="96%"><strong><?=$b1_apellido.", ".$b1_nombre; ?></strong></td>
            </tr>
          </table></td>
        <td width="19%" align="center" bgcolor="#EDE8D1"><? if ($idNivel < '4') { ?>		
		<a href="persona_informe.php?idPersona=<?=$b1_numero; ?>">Informe individual</a><? } ?>&nbsp;</td>
        <td width="17%" align="center" bgcolor="#EDE8D1"><a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$b1_familia; ?>')>Informe completo</a></td>
        <td width="7%" align="center" bgcolor="#EDE8D1"><a href=javascript:ventana_modif('beneficio_informe_imp.php?idFamilia=<?=$familia["Familia_nro"]; ?>')><img src="imagen/imp.png" alt="Imprimir planilla de datos" title="Imprimir planilla de datos" width="18" height="18" border="0" /></a></td>
        <td width="8%" align="center" bgcolor="#EDE8D1"><? if ($idNivel < '4' && $matricula == '0' ) { ?><a href="beneficio_borrar_confirm.php?idFamilia=<?=$b1_familia; ?>&doc=<? echo $dni_busqueda; ?>"><img src="imagen/delete.gif" width="16" height="16" border="0" /></a><?  }else{ ?>-<? } ?></td>
	  </tr>
<? } ?>
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