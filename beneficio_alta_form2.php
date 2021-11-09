<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");
require ('xajax/xajax_core/xajax.inc.php');
$xajax = new xajax(); 
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true);

function select_combinado($nro_partido){ 
   	$qryBarrios = "SELECT Barrio_nro, Barrio_nombre
  		FROM dbo_barrio
  		WHERE Partido_nro = $nro_partido";
	$resBarrios = armar_matriz($qryBarrios);
	$totalBarrios = count($resBarrios);
	
	$nuevo_select = '<select name="lote_barrio" id="lote_barrio">';
	$nuevo_select .= '<option value=0>Seleccione Barrio</option>';
	for ($i=0; $i<$totalBarrios; $i++){
	$codigoBarrio = $resBarrios[$i]['Barrio_nro'];
	$barrio = $resBarrios[$i]['Barrio_nombre'];
	$nuevo_select .= '<option value= "'. $codigoBarrio.'">'. $barrio .'</option>';
	}
	$nuevo_select .= '</select>';
	return $nuevo_select;
}

function generar_select($nro_partido){
	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding('ISO-8859-1'); 
	 
	$nuevo_select = select_combinado($nro_partido);
	$respuesta->Assign("seleccombinado","innerHTML",$nuevo_select);
   
	return $respuesta;
}


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

$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

?>
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>


<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo beneficio</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="javascript:history.go(-1)">Volver al listado </a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>
<form action="beneficio_alta.php" method="post" enctype="multipart/form-data" name="f" id="f">

<input type="hidden" name="expte_nro" value="<? echo $expte_nro; ?>" onkeypress="return pulsar(event)"/>
<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="48%">Partido</td>
        <td width="52%">Barrio</td>
      </tr>
      <tr>
        <td><select name="idPartido" id="idPartido" onChange="xajax_generar_select(document.f.idPartido.options[document.f.idPartido.selectedIndex].value)">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select></td>
        <td><div id="seleccombinado">
			<select name="barrio" id="barrio">
			<option value=0>Seleccione Barrio...</option>
			</select>
		</div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="117" height="22" valign="bottom">&nbsp;</td>
        <td width="54" valign="bottom">Circ.</td>
        <td width="63" valign="bottom">Secc.</td>
        <td width="65" valign="bottom">Ch.</td>
        <td width="61" valign="bottom">Qta.</td>
        <td width="62" valign="bottom">Fracc.</td>
        <td width="53" valign="bottom">Mz.</td>
        <td width="52" valign="bottom">Pc.</td>
        <td width="73" valign="bottom">Subpc..</td>
        </tr>
      <tr>
        <td height="25" valign="top">Nomenclatura:</td>
        <td><input name="lote_circ" type="text" id="lote_circ" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_secc" type="text" id="lote_secc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_ch" type="text" id="lote_ch" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_qta" type="text" id="lote_qta" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_fracc" type="text" id="lote_fracc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_manzana" type="text" id="lote_manzana" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_parcela" type="text" id="lote_parcela" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_subpc" type="text" id="lote_subpc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        </tr>
      <tr>
        <td height="10" colspan="9" valign="top">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 1</strong> </td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="123" valign="bottom" class="nombrecampo">Tipo Doc. </td>
		<td width="117" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
		<td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
      </tr>
      <tr>
	  <td><select name="t1_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1" selected="selected">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t1_doc_nro" type="text" id="t1_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>&nbsp;</td>
        <td><input name="t1_apellido" type="text" id="t1_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t1_nombre" type="text" id="t1_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="87" height="16" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="164" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="78" valign="bottom">&nbsp;</td>
            <td width="16" valign="bottom">&nbsp;</td>
            <td width="165" valign="bottom" class="nombrecampo">&nbsp;</td>
            <td width="90" valign="bottom">&nbsp;</td>
          </tr>
        </table>
      </td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 2 </strong> </td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="123" valign="bottom" class="nombrecampo">Tipo Doc. </td>
        <td width="117" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
		<td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
      </tr>
      <tr>
	  <td><select name="t2_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1" selected="selected">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t2_doc_nro" type="text" id="t2_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>&nbsp;</td>
        <td><input name="t2_apellido" type="text" id="t2_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t2_nombre" type="text" id="t2_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR 3 </strong> </td>
          </tr>
          <tr>
            <td>
			<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="123" valign="bottom" class="nombrecampo">Tipo Doc. </td>
        <td width="117" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
		<td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
      </tr>
      <tr>
        <td><select name="t3_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1" selected="selected">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t3_doc_nro" type="text" id="t3_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>
        &nbsp;</td>
		<td><input name="t3_apellido" type="text" id="t3_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t3_nombre" type="text" id="t3_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table>
			</td>
          </tr>
        </table></td>
  </tr>
</table>
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"></td>
    <td width="141"></td>
  </tr>
  <tr>
    <td colspan="3" align="right">&nbsp;</td>
    <td width="11">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="103" height="26" align="left">N&ordm; Resoluci&oacute;n</td>
    <td width="421" align="left"><input name="resolucion" type="text" id="resolucion" size="20" onkeypress="return pulsar(event)"/>&nbsp;</td>
    <td colspan="3" align="right">&nbsp;</td>
    </tr>
  <tr>
    <td height="45" colspan="3" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="5%"><input name="reqcompleto" type="checkbox" id="reqcompleto" value="1" /></td>
        <td width="95%">Est&aacute; en condiciones de escriturar (documentaci&oacute;n y pagos completos) </td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="left" class="nombrecampo"><strong>Observaciones</strong></td>
  </tr>
  <tr>
    <td colspan="5" align="left"><textarea name="textarea" cols="110" rows="4">Sin observaciones</textarea></td>
    </tr>
  <tr>
    <td colspan="3" align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar beneficio" />&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>