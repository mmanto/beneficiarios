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

$idBarrio = $_GET["idBarrio"];

$sqlb = "SELECT
Barrio_nro,
Barrio_nombre,
Partido_nombre
FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_partido.Partido_nro
) WHERE Barrio_nro = $idBarrio";
$bar = mysql_query($sqlb);
$barrio = mysql_fetch_array($bar);
$barrio_nombre = $barrio["Barrio_nombre"];
$partido_nombre = $barrio["Partido_nombre"];

$sql567 = mysql_query("SELECT * FROM dbo_expte_esc ORDER BY Expte_nro DESC",$link);

?>

<style type="text/css">
<!--
.Estilo2 {font-size: 18px}
-->
</style>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo beneficio</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="barrios_listar_benef.php">Volver al listado </a></td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>

<form action="beneficio_alta_porbarrio.php" method="post" enctype="multipart/form-data" name="f" id="f">
<input type="hidden" name="idBarrio" value="<? echo $idBarrio; ?>" onkeypress="return pulsar(event)"/>
<?
/*<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" onkeypress="return pulsar(event)"/>
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" onkeypress="return pulsar(event)"/>
*/?>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="48%"><table width="250" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="29%" height="28" class="Estilo2">Partido:</td>
            <td width="4%" bgcolor="#FFFF66" class="Estilo2">&nbsp;</td>
            <td class="Estilo2" width="67%" bgcolor="#FFFF66"><? echo $partido_nombre; ?></td>
          </tr>
        </table></td>
        <td width="52%"><table width="250" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="27%" height="28" class="Estilo2">Barrio:</td>
            <td width="4%" bgcolor="#FFFF66" class="Estilo2">&nbsp;</td>
            <td class="Estilo2" width="69%" bgcolor="#FFFF66"><? echo $barrio_nombre; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="24">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="16%">Fecha carga </td>
          <td width="3%">&nbsp;</td>
          <td width="81%" colspan="3" rowspan="2" bgcolor="#E4E4E4"><table width="100%" border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td colspan="3" valign="bottom"><strong>Direcci&oacute;n de origen del beneficio </strong></td>
        </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><input name="beneficio_origen" type="radio" value="1" checked="checked" /></td>
              <td width="87%" valign="bottom">Dir. Reg.Urb. y Dominial </td>
            </tr>
          </table></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><input name="beneficio_origen" type="radio" value="2" /></td>
              <td width="87%" valign="middle">Plan Familia Propietaria  </td>
            </tr>
          </table></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><input name="beneficio_origen" type="radio" value="3" /></td>
              <td width="87%" valign="middle">Ley 24374  </td>
            </tr>
          </table></td>
      </tr>
    </table></td>
          </tr>
        <tr>
          <td><input name="censo_fecha" type="text" id="censo_fecha" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="<?=date("d/m/Y"); ?>" size="10"/></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td colspan="5" height="8px"></td>
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
        <td width="73" valign="bottom">Subpc.</td>
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
        <td height="6" colspan="9" valign="top"></td>
        </tr>
    </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="nombrecampo">Domicilio</td>
            <td width="24%" class="nombrecampo">Tel&eacute;fono</td>
            <td width="23%" class="nombrecampo">Matr&iacute;cula   N&ordm; </td>
          </tr>
          <tr>
            <td><input name="domicilio" type="text" id="domicilio" onkeypress="return pulsar(event)" size="50"/></td>
            <td><input name="familia_telefono" type="text" id="familia_telefono" onkeypress="return pulsar(event)" size="18"/></td>
            <td><input name="matricula" type="text" id="matricula" onkeypress="return pulsar(event)" value="0" size="15"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" style="nombrecampo""><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="21%">Res./Decreto Adj.N&ordm;: </td>
                              <td width="13%"><input name="resolucion" type="text" id="resolucion" onkeypress="return pulsar(event)" size="9"/></td>
                              <td width="4%">&nbsp;</td>
                              <td width="25%">Monto adjudicaci&oacute;n: $ </td>
                              <td width="17%"><input name="familia_montoadj" type="text" value="0" size="8" /></td>
                              <td width="20%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="33%" height="28">&nbsp;</td>
                                  <td width="5%" align="center" bgcolor="#D0DCFB"><input name="adjudicacion_pendiente" type="checkbox" id="adjudicacion_pendiente" value="1"/></td>
                                  <td width="26%" align="center" bgcolor="#D0DCFB">Adjudicaci&oacute;n pendiente </td>
                                  <td width="7%">&nbsp;</td>
                                  <td width="5%" align="center" bgcolor="#D14421"><input name="familia_ocupacion_verificar" type="checkbox" id="familia_ocupacion_verificar" value="1"/></td>
                                  <td width="24%" align="center" bgcolor="#D14421"><font color="#FFFFFF">Verificar ocupaci&oacute;n</font></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          </table></td>
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
	  <tr>
        <td height="12" colspan="4" valign="bottom" class="nombrecampo"></td>
        </tr>
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
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="205" height="16" valign="bottom" class="nombrecampo">Lugar de nacimiento </td>
            <td width="106" valign="bottom" class="nombrecampo">Fecha nacim. </td>
            <td width="161" valign="bottom">Nacionalidad</td>
            <td width="128" valign="bottom">Estado Civil </td>
          </tr>
          <tr>
            <td height="16" valign="bottom" class="nombrecampo"><input name="t1_lugar_nac" type="text" id="t1_lugar_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="30"/></td>
            <td valign="bottom" class="nombrecampo"><input name="t1_fecha_nac" type="text" id="t1_fecha_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="dd/mm/aaaa" size="10"/></td>
            <td valign="bottom"><input name="t1_nacionalidad" type="text" id="t1_nacionalidad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="18"/></td>
            <td valign="bottom"><select name="t1_ecivil" size="1" id="t1_ecivil">
                <option value="10" selected="selected">Sin Indicar</option>
				<option value="1">Soltero/a</option>
                <option value="2">Concubino/a</option>
                <option value="3">Casado/a</option>
                <option value="4">Divorciado/a</option>
				<option value="5">Sep. de hecho</option>
				<option value="6">Unión de hecho</option>
				<option value="7">Emancipado</option>
				<option value="8">Viudo/a</option>
				<option value="9">Otro</option>
              </select></td>
          </tr>
          <tr>
            <td height="10" colspan="4"></td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="22" valign="bottom" class="nombrecampo">Apellidos del c&oacute;nyuge </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s del c&oacute;nyuge </td>
            <td width="122" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t1_conyuge_apellido" type="text" id="t1_conyuge_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_conyuge_nombre" type="text" id="t1_conyuge_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" height="8px"></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="18" valign="bottom" class="nombrecampo">Apellidos del padre </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s del padre </td>
            <td width="122" valign="bottom" class="nombrecampo">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t1_padre_apellido" type="text" id="t1_padre_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_padre_nombre" type="text" id="t1_padre_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" height="8px"></td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="18" valign="bottom" class="nombrecampo">Apellidos de la madre </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s de la madre </td>
            <td width="122" valign="bottom" class="nombrecampo">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t1_madre_apellido" type="text" id="t1_madre_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t1_madre_nombre" type="text" id="t1_madre_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" height="8px"></td>
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
        <td height="12" colspan="4" valign="bottom" class="nombrecampo"></td>
        </tr>
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
        <td><input name="t2_doc_nro" type="text" id="t2_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="13" maxlength="8"/>
        &nbsp;</td>
        <td><input name="t2_apellido" type="text" id="t2_apellido" size="20" onkeypress="return pulsar(event)"/></td>
        <td><input name="t2_nombre" type="text" id="t2_nombre" size="30" onkeypress="return pulsar(event)"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="205" height="16" valign="bottom" class="nombrecampo">Lugar de nacimiento </td>
            <td width="106" valign="bottom" class="nombrecampo">Fecha nacim. </td>
            <td width="161" valign="bottom">Nacionalidad</td>
            <td width="128" valign="bottom">Estado Civil </td>
          </tr>
          <tr>
            <td height="16" valign="bottom" class="nombrecampo"><input name="t2_lugar_nac" type="text" id="t2_lugar_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="30"/></td>
            <td valign="bottom" class="nombrecampo"><input name="t2_fecha_nac" type="text" id="t2_fecha_nac" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="dd/mm/aaaa" size="10"/></td>
            <td valign="bottom"><input name="t2_nacionalidad" type="text" id="t2_nacionalidad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="18"/></td>
            <td valign="bottom"><select name="t2_ecivil" size="1" id="t2_ecivil">
				<option value="10" selected="selected">Sin Indicar</option>
                <option value="1">Soltero/a</option>
                <option value="2">Concubino/a</option>
                <option value="3">Casado/a</option>
                <option value="4">Divorciado/a</option>
				<option value="5">Sep. de hecho</option>
				<option value="6">Unión de hecho</option>
				<option value="7">Emancipado</option>
				<option value="8">Viudo/a</option>
				<option value="9">Otro</option>
              </select></td>
          </tr>
          <tr>
            <td height="10" colspan="4"></td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="22" valign="bottom" class="nombrecampo">Apellidos del c&oacute;nyuge </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s del c&oacute;nyuge </td>
            <td width="122" valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t2_conyuge_apellido" type="text" id="t2_conyuge_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_conyuge_nombre" type="text" id="t2_conyuge_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" height="8px"></td>
          </tr>
        </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="18" valign="bottom" class="nombrecampo">Apellidos del padre </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s del padre </td>
            <td width="122" valign="bottom" class="nombrecampo">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t2_padre_apellido" type="text" id="t2_padre_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_padre_nombre" type="text" id="t2_padre_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" height="8px"></td>
          </tr>
        </table>
		<table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="214" height="18" valign="bottom" class="nombrecampo">Apellidos de la madre </td>
            <td width="264" valign="bottom" class="nombrecampo">Nombre/s completo/s de la madre </td>
            <td width="122" valign="bottom" class="nombrecampo">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="t2_madre_apellido" type="text" id="t2_madre_apellido" size="35" onkeypress="return pulsar(event)"/></td>
            <td><input name="t2_madre_nombre" type="text" id="t2_madre_nombre" size="45" onkeypress="return pulsar(event)"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" height="8px"></td>
          </tr>
        </table>
      </td>
  </tr>
</table>
<table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"></td>
    <td width="269"></td>
  </tr>
  <tr>
    <td width="222" align="left">&nbsp;</td>
    <td width="186" colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="28" align="left"><table width="190" border="0" cellpadding="3" cellspacing="0" bgcolor="#DBDBDB">
      <tr>
        <td width="11%" align="center"><input name="doc_completa" type="checkbox" id="doc_completa" value="1" /></td>
        <td width="89%">Documentaci&oacute;n completa </td>
      </tr>
    </table></td>
    <td colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#BFD5FF">
      <tr>
        <td width="7%" align="center"><input name="blnBoleto" type="checkbox" id="blnBoleto" value="1" /></td>
        <td width="38%">Boleto Compra Venta </td>
        <td width="21%">Fecha  Boleto: </td>
        <td width="34%"><input name="boleto_fecha" type="text" id="boleto_fecha" size="12" /></td>
      </tr>
      
    </table></td>
    </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="nombrecampo"><table width="190" border="0" cellpadding="3" cellspacing="0" bgcolor="#CBCFFE">
      <tr>
        <td width="11%" align="center"><input name="procrear" type="checkbox" id="procrear" value="1" /></td>
        <td width="89%">Plan PROCREAR </td>
      </tr>
    </table></td>
    <td align="left" class="nombrecampo"><table width="155" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFF66">
      <tr>
        <td width="11%" align="center"><input name="pagocancelado" type="checkbox" id="pagocancelado" value="1" /></td>
        <td width="89%">Pagos cancelados</td>
      </tr>
    </table></td>
    <td align="left" class="nombrecampo"><table width="210" border="0" cellpadding="3" cellspacing="0" bgcolor="#D9E294">
      <tr>
        <td width="11%" align="center"><input name="condescrit" type="checkbox" id="condescrit" value="1" /></td>
        <td width="89%">En condiciones de escriturar </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" class="nombrecampo">Expediente escrituraci&oacute;n n&uacute;mero: </td>
<td align="left" class="nombrecampo">
<select name="expte_esc_nro" id="expte_esc_nro">
<option value="0">Sin expediente asignado</option>
<?	  while ($expte = mysql_fetch_array($sql567)) {	

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_barrio = $expte["Barrio_nombre"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];

?>
<option value="<? echo $expte_nro; ?>" ><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> <? if ($expte_cuerpo != '0') {echo "Cpo ".$expte_cuerpo; }else{ echo " "; } ?></option>
<? } ?>
</select></td>
    <td align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="nombrecampo"><strong>Observaciones</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="left"><textarea name="observaciones" cols="110" rows="4" id="observaciones">Sin observaciones</textarea></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td><input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar beneficio" />&nbsp;</td>
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