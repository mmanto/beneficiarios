<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");	
	
if (!$_POST["ficha"]) {echo "<h2>Por favor, ingrese un numero de ficha</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";


}else{

include ("conec.php");
require ("funciones.php");


$ficha_num = $_POST["ficha"];


$sql = "SELECT ficha_nro FROM dbo_ficha WHERE ficha_num = '$ficha_num' AND blnActivo = '1'";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);


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
    <td height="30" colspan="2" bgcolor="#E6E6E6"><h3><strong class="titulodato">Se han encontrado <?=$cant; ?>
     coincidencias:</strong></h3></td>
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
<? while ($ficha = mysql_fetch_array($res)) {
	$ficha_nro = $ficha["ficha_nro"]; 
	 ?>	  
	  <tr bgcolor="#FCE7C9">
        <td width="78%" height="23" bgcolor="#BCD8E0">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="4%">&nbsp;</td>
              <td><strong>Ficha Nro.:</strong> <?=$ficha_num; ?> | <strong>Titular:</strong> 
              <? $res2 = mysql_query("SELECT Persona_apellido, Persona_nombre FROM dbo_persona WHERE Ficha_nro = $ficha_nro AND blnActivo = '1' ORDER BY Persona_nro LIMIT 0,1");
        while ($persona = mysql_fetch_array($res2)) {
 		echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"];       
		} ?>&nbsp;</td>
            </tr>
          </table></td>
        <td align="center" bgcolor="#BCD8E0">
          <a href="javascript:ventana_modif('ficha_informe.php?idFicha=<?=$ficha_nro; ?>')">
          Ver ficha</a></td>
        </tr>
<? } ?>
    </table>	
 <? }else{ echo "<h2>No se han encontrado coincidencias</h2>"; } ?>
 
    
    </td>
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
<?   
include "pie.php";
?>
<? } } ?>