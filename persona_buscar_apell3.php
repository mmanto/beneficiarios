<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");	
	
if (!$_POST["apellido"]) {echo "<h2>Por favor, ingrese un apellido</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";


}else{

include ("conec.php");
require ("funciones.php");


$apellido = $_POST["apellido"];


$sql = "SELECT * FROM dbo_persona WHERE Persona_apellido LIKE '%$apellido%' AND Ficha_nro != '0' AND blnActivo = '1'";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);



$sql2 = "SELECT * FROM dbo_persona WHERE Persona_apellido LIKE '%$apellido%' AND Ficha_nro = '0' AND blnActivo = '1'";
$res2 = mysql_query($sql2);
$cant2 = mysql_num_rows($res2);

?>
<table width="750" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Informe de beneficiario de tierras </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="25" colspan="2" valign="bottom"><a href="persona_buscar3_form.php">Realizar nueva b&uacute;squeda</a> | <a href="zonas-listar.php">Volver al men&uacute;</a></td>
  </tr>
  <tr>
    <td height="8" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" colspan="2" bgcolor="#E6E6E6"><h3><strong class="titulodato">Se han encontrado <?=$cant; ?> coincidencias dentro de la dirección:  </strong></h3></td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="left">
	
<? if ($cant != '0') { ?>	
	  <table width="100%" border="0" cellspacing="3" cellpadding="3">
      <tr>
        <td>&nbsp;</td>
        <td width="22%">&nbsp;</td>
      </tr>
<? while ($persona = mysql_fetch_array($res)) {
	 ?>	  
	  <tr bgcolor="#FCE7C9">
        <td width="78%" height="23" bgcolor="#BCD8E0">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="4%">&nbsp;</td>
              <td width="96%"><strong><?=$persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></strong> (DNI <?=$persona["Persona_dni_nro"]; ?>)</td>
            </tr>
          </table></td>
        <td align="center" bgcolor="#BCD8E0">
          <a href="javascript:ventana_modif('ficha_informe.php?idFicha=<?=$persona["Ficha_nro"]; ?>')">
          Ver informe</a></td>
        </tr>
<? } ?>
    </table>	
 <? }else{ echo "<h2>No se han encontrado coincidencias en esta direcci&oacute;n</h2>"; } ?>
 
    
    </td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="30" colspan="2" bgcolor="#E6E6E6"><h3><strong class="titulodato">Se han encontrado <?=$cant2; ?> coincidencias en otras direcciones:  </strong></h3></td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="left">
<? if ($cant2 != '0') { ?>	
	
	  <table width="100%" border="0" cellspacing="3" cellpadding="3">
      <tr>
        <td>&nbsp;</td>
        <td width="22%">&nbsp;</td>
      </tr>
<? while ($persona = mysql_fetch_array($res2)) {
	 ?>	  
	  <tr bgcolor="#FCE7C9">
        <td width="78%" height="23" bgcolor="#FFE9B9">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="4%">&nbsp;</td>
              <td width="96%"><strong><?=$persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></strong> (DNI <?=$persona["Persona_dni_nro"]; ?>)</td>
            </tr>
          </table></td>
        <td align="center" bgcolor="#FFE9B9">
          <a href="javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$persona["Familia_nro"]; ?>')">
          Ver informe</a></td>
        </tr>
<? } ?>
    </table>	
 <? }else{ echo "<h2>No se han encontrado coincidencias en esta direcci&oacute;n</h2>"; } ?>
    	</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?   
include "pie.php";
?>
<? } } ?>