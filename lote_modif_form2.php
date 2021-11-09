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
$usuario_nombre = $user["Nombre"];

$sqlDir = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dir = mysql_fetch_array($sqlDir);
$dirNombre = $dir["Direccion_nombre"];

$sqlDirProv = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dirprov = mysql_fetch_array($sqlDirProv);
$dirProvNombre = $dir["Direccion_dirprov"];

//////////////////////////////////////////////////////////////////

$lote_nro = $_GET["idLote"];

$origen = $_GET["origen"];

$SQL3 = mysql_query("SELECT * FROM dbo_lote WHERE Lote_nro = $lote_nro",$link);
$lote = @mysql_fetch_array($SQL3);
$lote_partido = $lote["Partido_nro"];
$lote_circ = $lote["Lote_circunscripcion"];
$lote_secc = $lote["Lote_seccion"];
$lote_ch = $lote["Lote_chacra"];
$lote_qta = $lote["Lote_quinta"];
$lote_fr = $lote["Lote_fraccion"];
$lote_mz = $lote["Lote_manzana"];
$lote_pc = $lote["Lote_parcela"];
$lote_subpc = $lote["Lote_subparcela"];
$lote_matricula = $lote["Lote_matricula"];


$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

?>

<style type="text/css">
<!--
.Estilo2 {font-size: 18px}
-->
</style>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Modificar informaci&oacute;n del lote </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="javascript:history.back()">Volver</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="lote_modif.php" method="post" enctype="multipart/form-data" name="f" id="f">
<input name="lote_nro" type="hidden" id="lote_nro" value="<?=$lote_nro; ?>" size="1" onkeypress="return pulsar(event)"/>
<input name="origen" type="hidden" id="origen" value="<?=$origen; ?>" size="1" onkeypress="return pulsar(event)"/>
<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="11%"><strong>Partido:</strong></td>
        <td width="37%"><select name="idPartido" id="idPartido">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) { ?><option value ="<?=$rsPart["Partido_nro"]; ?>"
	<? if($rsPart["Partido_nro"] == $lote_partido) { ?>selected="selected"<? } ?>><?=$rsPart["Partido_nombre"]; ?></option><? } ?>
      </select></td>
        <td width="52%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="107" height="22" valign="bottom">&nbsp;</td>
        <td width="64" valign="bottom">Circ.</td>
        <td width="63" valign="bottom">Secc.</td>
        <td width="65" valign="bottom">Ch.</td>
        <td width="61" valign="bottom">Qta.</td>
        <td width="62" valign="bottom">Fracc.</td>
        <td width="53" valign="bottom">Mz.</td>
        <td width="52" valign="bottom">Pc.</td>
        <td width="73" valign="bottom">Subpc.</td>
        </tr>
      <tr>
        <td height="25" valign="top">Nomenclatura:</td>
        <td><input name="lote_circ" type="text" id="lote_circ" size="1" onkeypress="return pulsar(event)" value="<?=$lote_circ; ?>"/></td>
        <td><input name="lote_secc" type="text" id="lote_secc" size="1" onkeypress="return pulsar(event)" value="<?=$lote_secc; ?>"/></td>
        <td><input name="lote_ch" type="text" id="lote_ch" size="1" onkeypress="return pulsar(event)" value="<?=$lote_ch; ?>"/></td>
        <td><input name="lote_qta" type="text" id="lote_qta" size="1" onkeypress="return pulsar(event)" value="<?=$lote_qta; ?>"/></td>
        <td><input name="lote_fracc" type="text" id="lote_fracc" size="1" onkeypress="return pulsar(event)" value="<?=$lote_fr; ?>"/></td>
        <td><input name="lote_manzana" type="text" id="lote_manzana" size="1" onkeypress="return pulsar(event)" value="<?=$lote_mz; ?>"/></td>
        <td><input name="lote_parcela" type="text" id="lote_parcela" size="1" onkeypress="return pulsar(event)" value="<?=$lote_pc; ?>"/></td>
        <td><input name="lote_subpc" type="text" id="lote_subpc" size="1" onkeypress="return pulsar(event)" value="<?=$lote_subpc; ?>"/></td>
        </tr>
      <tr>
        <td height="14" colspan="9" valign="top"></td>
        </tr>
      <tr>
        <td height="18" valign="top">Matr&iacute;cula N&ordm; </td>
        <td height="18" colspan="3" valign="top"><input name="lote_matricula" type="text" id="lote_matricula" value="<?=$lote_matricula; ?>" size="14" onkeypress="return pulsar(event)"/></td>
        <td height="18" valign="top"></td>
        <td height="18" valign="top"></td>
        <td height="18" valign="top"></td>
        <td height="18" valign="top"></td>
        <td height="18" valign="top"></td>
      </tr>
    </table>
	</td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="187"></td>
  </tr>
  <tr>
    <td width="220" align="right">&nbsp;</td>
    <td width="270" colspan="-1">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Actualizar" />&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>