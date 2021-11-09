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
//////////////////////////////////////////////////////////////////


$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

$strSQL2 = "SELECT * FROM dbo_direccion ORDER BY Direccion_nro ASC";
$direc = mysql_query ($strSQL2);

/*$strSQL3 = mysql_query ("SELECT * FROM dbo_direccion where Direccion_nro=".$log_direccion."", $link);
$res_dirprov = mysql_fetch_array($strSQL3);*/

$resol = mysql_query ("SELECT idResolucion, Resolucion_nombre FROM dbo_resolucion ORDER BY idResolucion ASC", $link);

?>

<!--Script para corroborar si el titular ya existe en la base de datos-->

<script language = "javascript">
function createRequestObject(){
       var peticion;
       var browser = navigator.appName;
             if(browser == "Microsoft Internet Explorer"){
                   peticion = new ActiveXObject("Microsoft.XMLHTTP");
             }else{
                   peticion = new XMLHttpRequest();
 }
 return peticion;
 }  
  
var http = new Array();
 function ObtDatos(url){
       var act = new Date();
       http[act] = createRequestObject();
       http[act].open('get', url);
       http[act].onreadystatechange = function() {
       if (http[act].readyState == 4) {
             if (http[act].status == 200 || http[act].status == 304) {
   var texto
 texto = http[act].responseText
                     var DivDestino = document.getElementById("DivDestino");
                     DivDestino.innerHTML = "<div id='error'>"+texto+"</div>";
                   
 }
 }
 }
 http[act].send(null);
 }
  
 function compUsuario(Tecla) {
      Tecla = (Tecla) ? Tecla: window.event;
      input = (Tecla.target) ? Tecla.target :
      Tecla.srcElement;
      if (Tecla.type == "keyup") {
           var DivDestino = document.getElementById("DivDestino");
           DivDestino.innerHTML = "<div></div>";
           if (input.value) {
                ObtDatos("logdni.php?q=" + input.value);
           }
      }
 }
 </script>
 <!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
 <title>
 <MMString:LoadString id="insertbar/formsCheckbox" />
 </title>
 <table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo censo </h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="menu.php">Volver al panel de administración</a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>
<form action="censo_ley_alta.php" method="post" enctype="multipart/form-data" name="f" id="f">
<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="18" class="nombrecampo">Partido</td>
        <td class="nombrecampo">Registro</td>
        <td class="nombrecampo">Carnet</td>
        <td bgcolor="#E6E6E6" class="nombrecampo">&nbsp;</td>
        <td height="26" colspan="6" valign="middle" bgcolor="#E6E6E6"><strong>Acta Ley 24.374 </strong></td>
        </tr>
      <tr>
        <td width="53" height="18" class="nombrecampo"><input name="idPartido" type="text" id="idPartido" size="2" onkeypress="return pulsar(event)"/></td>
        <td width="63" class="nombrecampo"><input name="escritura_rnrd" type="text" id="escritura_rnrd" size="4" onkeypress="return pulsar(event)"/></td>
        <td width="62" class="nombrecampo"><input name="escritura_escribano_carnet" type="text" id="escritura_escribano_carnet" size="4" onkeypress="return pulsar(event)"/></td>
        <td width="7" rowspan="2" bgcolor="#E6E6E6" class="nombrecampo">&nbsp;</td>
        <td width="64" bgcolor="#E6E6E6" class="nombrecampo">A&ntilde;o Acta </td>
        <td width="95" bgcolor="#E6E6E6" class="nombrecampo">Acta N&ordm; </td>
        <td width="83" bgcolor="#E6E6E6" class="nombrecampo">Expte.</td>
        <td width="65" bgcolor="#E6E6E6" class="nombrecampo">A&ntilde;o</td>
        <td width="75" bgcolor="#E6E6E6" class="nombrecampo">Fecha Acta </td>
        <td width="33" bgcolor="#E6E6E6" class="nombrecampo">Acta</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td bgcolor="#E6E6E6"><input name="actareg_anio" type="text" id="escritura_anio" size="5" /></td>
        <td bgcolor="#E6E6E6"><label>
          <input name="actareg_numero" type="text" id="escritura_numero" size="10" />
        </label></td>
        <td bgcolor="#E6E6E6"><input name="actareg_expte" type="text" id="escritura_expte" size="8" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#E6E6E6"><input name="actareg_expte_anio" type="text" id="escritura_expte_anio" size="4" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#E6E6E6"><input name="actareg_fecha" type="text" id="escritura_fecha" size="7" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#E6E6E6"><input name="escritura_acta" type="checkbox" id="escritura_acta" value="1" checked="checked" /></td>
      </tr>
      <tr>
        <td colspan="3" height="6"></td>
        <td colspan="7" bgcolor="#E6E6E6"></td>
        </tr>
    </table>
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="8" colspan="10" ></td>
        </tr>
      <tr>
        <td colspan="3" rowspan="3"><table width="95%" border="0" cellpadding="12" cellspacing="0" bgcolor="#FFFF99">
      <tr>
        <td><strong>Atenci&oacute;n:</strong> Las fechas deben ser consignadas en formato dd/mm/aaaa. </td>
      </tr>
    </table></td>
        <td bgcolor="#E6E6E6" class="nombrecampo">&nbsp;</td>
        <td height="26" colspan="6" valign="middle" bgcolor="#E6E6E6"><strong>Escritura traslativa de dominio (definitiva) </strong></td>
        </tr>
      <tr>
        <td width="7" rowspan="2" bgcolor="#E6E6E6" class="nombrecampo">&nbsp;</td>
        <td width="64" height="18" bgcolor="#E6E6E6" class="nombrecampo">A&ntilde;o Esc. </td>
        <td width="95" bgcolor="#E6E6E6" class="nombrecampo">Esc. N&ordm; </td>
        <td width="83" bgcolor="#E6E6E6" class="nombrecampo">Expte.</td>
        <td width="65" bgcolor="#E6E6E6" class="nombrecampo">A&ntilde;o</td>
        <td width="75" bgcolor="#E6E6E6" class="nombrecampo">Fecha Esc. </td>
        <td width="33" bgcolor="#E6E6E6" class="nombrecampo">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#E6E6E6"><input name="escritura_anio" type="text" id="escritura_anio" size="5" /></td>
        <td bgcolor="#E6E6E6"><label>
          <input name="escritura_numero" type="text" id="escritura_numero" size="10" />
        </label></td>
        <td bgcolor="#E6E6E6"><input name="escritura_expte" type="text" id="escritura_expte" size="8" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#E6E6E6"><input name="escritura_expte_anio" type="text" id="escritura_expte_anio" size="4" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#E6E6E6"><input name="escritura_fecha" type="text" id="escritura_fecha" size="7" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#E6E6E6">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" height="6"></td>
        <td colspan="7" bgcolor="#E6E6E6"></td>
        </tr>
    </table>
      </td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="160" height="22" valign="bottom">&nbsp;</td>
        <td width="48" valign="bottom">Circ.</td>
        <td width="48" valign="bottom">Secc.</td>
        <td width="48" valign="bottom">Ch.</td>
        <td width="48" valign="bottom">Qta.</td>
        <td width="48" valign="bottom">Fracc.</td>
        <td width="48" valign="bottom">Mz.</td>
        <td width="48" valign="bottom">Pc.</td>
        <td width="61" valign="bottom">Subpc.</td>
        <td width="43" valign="bottom">Cons.</td>
      </tr>
      <tr>
        <td height="25" valign="top"><strong>Nomenclatura catastral:</strong> </td>
        <td><input name="lote_circ" type="text" id="lote_circ" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_secc" type="text" id="lote_secc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_ch" type="text" id="lote_ch" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_qta" type="text" id="lote_qta" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_fracc" type="text" id="lote_fracc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_manzana" type="text" id="lote_manzana" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_parcela" type="text" id="lote_parcela" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_subpc" type="text" id="lote_subpc" value="-" size="1" onkeypress="return pulsar(event)"/></td>
        <td><input name="escritura_tramite_consolidacion" type="checkbox" id="escritura_tramite_consolidacion" value="1" /></td>
      </tr>
      <tr>
        <td height="10" colspan="10" valign="top">&nbsp;</td>
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
        <td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
        <td width="127" valign="bottom" class="nombrecampo">Tipo Doc. </td>
        <td width="113" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
      </tr>
      <tr>
        <td><input name="t1_apellido" type="text" id="t1_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t1_nombre" type="text" id="t1_nombre" size="25" onkeypress="return pulsar(event)"/></td>
        <td><select name="t1_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t1_doc_nro" type="text" id="t1_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>&nbsp;</td>
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
        <td width="165" height="18" valign="bottom" class="nombrecampo">Apellidos</td>
        <td width="195" valign="bottom" class="nombrecampo">Nombre/s completo/s </td>
        <td width="127" valign="bottom" class="nombrecampo">Tipo Doc. </td>
        <td width="113" valign="bottom" class="nombrecampo">N&ordm; Documento </td>
      </tr>
      <tr>
        <td><input name="t2_apellido" type="text" id="t2_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t2_nombre" type="text" id="t2_nombre" size="25" onkeypress="return pulsar(event)"/></td>
        <td><select name="t2_doc_tipo" size="1" id="select">
              <option value="0">Seleccione...</option>
              <option value="1">DNI</option>
              <option value="2">LE</option>
              <option value="3">LC</option>
              <option value="4">CI</option>
              <option value="5">CF</option>
              <option value="6">Ext.</option>
            </select></td>
        <td><input name="t2_doc_nro" type="text" id="t2_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>&nbsp;</td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
  </tr>
</table>
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="99"></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="481" align="right">&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar censo" /></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? } ?>