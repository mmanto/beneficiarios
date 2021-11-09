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
<form action="testing_lote.php" method="post" enctype="multipart/form-data" name="f" id="f">
<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="7"></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL INMUEBLE </strong></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="206" height="18" class="nombrecampo">Partido</td>
        <td width="210" class="nombrecampo">Localidad</td>
        <td width="184" class="nombrecampo">Barrio</td>
      </tr>
      <tr>
        <td><select name="idPartido" id="idPartido">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select></td>
        <td><input name="lote_localidad" type="text" id="lote_localidad" size="30" onkeypress="return pulsar(event)"/></td>
        <td><input name="lote_barrio" type="text" id="lote_barrio" size="29" onkeypress="return pulsar(event)"/></td>
      </tr>
    </table></td>
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
        <td width="48" valign="bottom">Subpc.</td>
        <td width="56" valign="bottom">Partida</td>
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
        <td><input name="lote_partida" type="text" id="lote_partida" value="-" size="6" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td height="10" colspan="10" valign="top">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="10"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <? /*<tr>
        <td width="185" height="16" valign="bottom" class="nombrecampo">Domicilio</td>
        <td width="63" valign="bottom" class="nombrecampo">Edificio</td>
        <td width="62" valign="bottom" class="nombrecampo">Monob.</td>
        <td width="52" valign="bottom" class="nombrecampo">Sector</td>
        <td width="60" valign="bottom" class="nombrecampo">Escalera</td>
        <td width="48" valign="bottom" class="nombrecampo">Piso</td>
        <td width="47" valign="bottom" class="nombrecampo">Depto.</td>
        <td width="83" valign="bottom" class="nombrecampo">Casa N&ordm;</td>
      </tr>
      <tr>
        <td><input name="Familia_domic" type="text" id="Familia_domic" size="30" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_edificio" type="text" id="Familia_domic_edificio" size="5" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_monoblock" type="text" id="Familia_domic_monoblock" size="5" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_sector" type="text" id="Familia_domic_sector" size="3" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_escalera" type="text" id="Familia_domic_escalera" size="4" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_piso" type="text" id="Familia_domic_piso" size="2" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_domic_depto" type="text" id="Familia_domic_depto" size="2" onkeypress="return pulsar(event)"/></td>
        <td><input name="Familia_casa_num" type="text" id="Familia_casa_num" size="3" onkeypress="return pulsar(event)"/></td>
      </tr> */?>
    </table>
	  <table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td bgcolor="#FFFF66">Atenci&oacute;n: Para los valores de superficie y monto <strong>no utilice</strong> separador de miles. Utilice el signo punto (.) en lugar de coma (,) como separador decimal (ejemplo: 1234.56 en lugar de 1234,56). </td>
        </tr>
      </table>
	  <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" valign="bottom" class="nombrecampo">Superficie lote </td>
            <td height="20" valign="bottom" class="nombrecampo">Valor m&sup2; </td>
            <td width="119" valign="bottom" class="nombrecampo">Valor mensura </td>
            <td width="108" valign="bottom" class="nombrecampo">Cant. cuotas </td>
            <td width="81" valign="bottom" class="nombrecampo">&nbsp;</td>
          </tr>
          <tr>
            <td width="161"><input name="lote_superficie" type="text" id="lote_superficie" size="12" onkeypress="return pulsar(event)"/>
            &nbsp;m&sup2;</td>
            <td width="131">$ 
              <input name="lote_valor_m2" type="text" id="lote_valor_m2" size="12" onkeypress="return pulsar(event)"/>
            &nbsp;</td>
            <td>$ 
              <input name="lote_valor_mensura" type="text" id="lote_valor_mensura" size="12" onkeypress="return pulsar(event)"/>
            &nbsp;</td>
            <td><input name="lote_cant_cuotas" type="text" id="lote_cant_cuotas" size="5" onkeypress="return pulsar(event)"/>
            &nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>	</td>
  </tr>
  <tr>
    <td></td>
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