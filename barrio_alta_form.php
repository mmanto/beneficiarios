<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$pdo = $_GET["idPartido"];

$strSQL = "SELECT * FROM dbo_partido WHERE Partido_nro = $pdo";
$res = mysql_query ($strSQL);
$partido = mysql_fetch_array($res);
$partido_nombre = $partido["Partido_nombre"];
$conurbano = $partido["Partido_conurbano"];

$resPlanViv = mysql_query("SELECT * FROM dbo_planvivienda ORDER BY Planvivienda_nro",$link);

?>
<form action="barrio_alta.php" method="POST">
<input type="hidden" name="origen" value="<?=$origen; ?>" />
<table width="750" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><h2>Dar de alta  nuevo barrio </h2></td>
    <td colspan="3" rowspan="5" align="right" valign="middle"><table width="95%" border="0" cellspacing="0" cellpadding="13">
      <tr>
        <td bgcolor="#FFFF99" style="border: 2px solid #FFCC99;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="3"><strong>Atenci&oacute;n:</strong> En todos los casos usar el punto como separador de decimales y <strong>NO </strong>como separador de  miles. Ejemplo: </td>
              </tr>
          <tr>
            <td width="48%" height="28" align="right" valign="bottom" style="font-size:16px">13.248,36</td>
                <td width="3%" align="center" valign="bottom" style="font-size:16px">&nbsp;</td>
                <td width="49%" valign="bottom" style="font-size:16px; color:#FF0000;" ><strong>&raquo; Incorrecto</strong></td>
              </tr>
          <tr>
            <td height="20" align="right" valign="bottom" style="font-size:16px"><strong>13248.36</strong></td>
                <td height="20" align="center" valign="bottom" style="font-size:16px">&nbsp;</td>
                <td height="26" valign="bottom" style="font-size:16px"><strong>&raquo; Correcto</strong></td>
              </tr>
          <tr>
            <td height="40" colspan="3" align="center" valign="bottom" style="border-top:#666666 1px solid; font-size:14px"><strong>Atenci&oacute;n:</strong> Consignar las fechas en formato <strong>dd/mm/aaaa</strong><br />
              (utilizando barra &quot;<strong>/</strong>&quot; y NO gui&oacute;n &quot;-&quot; como separador) </td>
            </tr>
          </table></td>
        </tr>
    </table></td>
    </tr>
  <tr>
    <td height="16" colspan="4"><a href="javascript:history.back(1)">Volver al listado de barrios </a></td>
    </tr>
  <tr>
    <td width="5" rowspan="2">&nbsp;</td>
    <td width="118" height="46" valign="bottom"><strong>Partido:</strong></td>
    <td colspan="2" valign="bottom"><span style="font-size:14px; font-weight:bold"><? echo $partido_nombre; ?></span></td>
    </tr>
  <tr>
    <td height="46" style="font-size:16px;"><strong>Nombre: </strong></td>
    <td colspan="2"><input name="barrio_nombre" type="text" id="barrio_nombre" size="20" style="font-size:16px;"/></td>
  </tr>
  <tr>
    <td width="5">&nbsp;</td>
    <td valign="middle">&nbsp;</td>
    <td colspan="2" valign="middle" style="font-size:14px; font-weight:bold">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6" valign="middle">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="30" bgcolor="#EDF0F3">&nbsp;Circunscripci&oacute;n</td>
    <td width="122" height="30" bgcolor="#EDF0F3"><input name="barrio_circ" type="text" id="barrio_circ" value="-" size="12" /></td>
    <td width="80">&nbsp;</td>
    <td width="79">&nbsp;</td>
    <td width="133"><strong>Plano n&uacute;mero: </strong></td>
    <td width="213"><input name="barrio_plano" type="text" id="barrio_plano" value="-" size="12" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="30" bgcolor="#EDF0F3">&nbsp;Secci&oacute;n:</td>
    <td height="30" bgcolor="#EDF0F3"><input name="barrio_secc" type="text" id="barrio_secc" value="-" size="12" /></td>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Fecha aprob. plano:</strong></td>
    <td><input name="barrio_plano_aprob_fecha" type="text" id="barrio_plano_aprob_fecha" value="-" size="12" />
(dd/mm/aaaa)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="30" bgcolor="#EDF0F3">&nbsp;Chacra:</td>
    <td height="30" bgcolor="#EDF0F3"><input name="barrio_ch" type="text" id="barrio_ch" value="-" size="12" /></td>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Cant. Parcelas:</strong></td>
    <td><input name="barrio_parcelas_cant" type="text" id="barrio_parcelas_cant" value="-" size="12" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="30" bgcolor="#EDF0F3">&nbsp;Quinta:</td>
    <td height="30" bgcolor="#EDF0F3"><input name="barrio_qta" type="text" id="barrio_qta" value="-" size="12" /></td>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Valor expopiaci&oacute;n: </strong></td>
    <td><input name="barrio_valor_exprop" type="text" id="barrio_valor_exprop" value="-" size="12" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="30" bgcolor="#EDF0F3">&nbsp;Fracci&oacute;n:</td>
    <td height="30" bgcolor="#EDF0F3"><input name="barrio_fracc" type="text" id="barrio_fracc" value="-" size="12" /></td>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Superficie total:</strong></td>
    <td><input name="barrio_sup_total" type="text" id="barrio_sup_total" value="-" size="12" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="30"><strong>Valor mensura:</strong></td>
    <td colspan="2"><input name="barrio_mensura_valor" type="text" id="barrio_mensura_valor" value="-" size="12" /></td>
    <td>&nbsp;</td>
    <td><strong>Fecha exprop.: </strong></td>
    <td><input name="barrio_valor_exprop_fecha" type="text" id="barrio_valor_exprop_fecha" value="-" size="12" />
(dd/mm/aaaa)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="30"><strong>Sup. com&uacute;n: </strong></td>
    <td colspan="2"><input name="barrio_superficie_comun" type="text" id="barrio_superficie_comun" value="-" size="12" /></td>
    <td>&nbsp;</td>
    <td><strong>Valor m2: </strong></td>
    <td><input name="barrio_m2_valor" type="text" id="barrio_m2_valor" value="-" size="12" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="30"><strong>Cant. cuotas: </strong></td>
    <td colspan="2"><input name="barrio_cuotas_cant" type="text" id="barrio_cuotas_cant" value="-" size="12" /></td>
    <td>&nbsp;</td>
    <td><strong>Fecha valor m2:</strong></td>
    <td><input name="barrio_m2_valor_fecha" type="text" id="barrio_m2_valor_fecha" value="-" size="12" />
&nbsp;(dd/mm/aaaa)</td>
  </tr>
  <tr>
    <td height="10"></td>
    <td height="30"></td>
    <td height="10"></td>
    <td height="10"></td>
    <td height="10"></td>
    <td height="10"><strong>Plan vivienda:</strong></td>
    <td height="10"> <select name="planvivienda" id="planvivienda">
  <option value="0">Sin plan de vivienda</option>
  <?	  while ($planvivienda = mysql_fetch_array($resPlanViv)) {	

$planvivienda_nro = $planvivienda["Planvivienda_nro"];
$planvivienda_nombre = $planvivienda["Planvivienda_nombre"];
?>
  <option value="<? echo $planvivienda_nro; ?>"><?=$planvivienda_nombre; ?> </option>
  <? } ?>
</select></td>
  </tr>
  <tr>
    <td height="10" colspan="7"></td>
    </tr>
  <tr>
    <td width="5">&nbsp;</td>
    <td height="30" valign="top"><strong>Observaciones:</strong></td>
    <td colspan="4"><textarea name="observaciones" cols="60" rows="4"></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="5">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="hidden" name="idPartido" value="<? echo $pdo ?>" />
      <input type="hidden" name="conurbano" value="<? echo $conurbano; ?>"/>&nbsp;</td>
    <td><input name="cmdLogin" type="submit" id="cmdLogin" value="Dar de alta el barrio">&nbsp;</td>
  </tr>
  <tr>
    <td width="5">&nbsp;</td>
    <td height="65">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</form>
<?       
include "pie.php";
?>
<? } ?>
