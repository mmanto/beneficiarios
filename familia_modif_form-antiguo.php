<?
include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

//$log_usuario = $_POST["idUsuario"];
//$log_direccion = $_POST["idDireccion"];
//$log_nivel = $_POST["user_nivel"];
//$direccion_nro = $log_direccion;


$familia_nro = $_GET["Familia_nro"];




////////////////////////////////////////

// Definición nombres de tablas

     $dbo_tabla_lote = "dbo_lote";
	 $dbo_tabla_familia = "dbo_familia";
	 $dbo_tabla_persona = "dbo_persona";

////////////////////////////////////////

$sql = "SELECT * FROM dbo_familia WHERE Familia_nro = $familia_nro";
$res = mysql_query($sql);

$familia = mysql_fetch_array($res);

$forma_ocupacion = $familia["Forma_ocupacion"];
$forma_ingreso = $familia["Forma_ingreso"];
$familia_observaciones = $familia["Familia_observaciones"];
$familia_doc_obs = $familia["Familia_doc_obs"];
$familia_cant_menores = $familia["Familia_cant_menores"];
$familia_cant_mayores = $familia["Familia_cant_mayores"];
$familia_cant_acargo = $familia["Familia_acargo"];
$reciben_ingresos = $familia["Familia_reciben_ingresos"];
$familia_ingreso_total = $familia["Familia_ingreso_total"];
$fecha_ingreso_lote = $familia["Fecha_ingreso_lote"];
$familias_conviven = $familia["Familia_conviven"];
$otraprop_lugar = $familia["Otraprop_lugar"];
$chequera_paga = $familia["Chequera_paga"];
$chequera_numero = $familia["Chequera_nro"];
$chequera_monto = $familia["Chequera_monto"];
$chequera_cuotas = $familia["Chequera_cuotas"];
$chequera_ultimo_pago = $familia["Chequera_ultimo_pago"];
$chequera_titular = $familia["Chequera_titular"];
$chequera_emisor = $familia["Chequera_emisor"];
$chequera_emisor_otro = $familia["Chequera_emisor_otro"];
$familia_tipo_ocupacion = $familia["Tipo_ocupacion"];


?>


<form action="familia_modificar.php" method="post" enctype="multipart/form-data" name="f" id="f">
<input type="hidden" name="idDireccion" value="<? echo $log_direccion; ?>" />
<input type="hidden" name="idUsuario" value="<? echo $log_usuario; ?>" />
<input type="hidden" name="user_nivel" value="<? echo $log_nivel; ?>" />

<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="216" height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL GRUPO FAMILIAR CONVIVIENTE </strong></td>
	  </tr>
      <tr>
        <td><table width="600" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="5" colspan="10">&nbsp;</td>
            </tr>
          <tr>
            <td height="25">Menores</td>
            <td><input name="familia_cant_menores" type="text" id="familia_cant_menores" size="2" onkeypress="return pulsar(event)"value="<?=$familia_cant_menores?>"/></td>
            <td>Mayores</td>
            <td><input name="familia_cant_mayores" type="text" id="familia_cant_mayores" size="2" onkeypress="return pulsar(event)"value="<?=$familia_cant_mayores?>"/></td>
            <td> A cargo </td>
            <td><input name="familia_acargo" type="text" id="familia_acargo" size="2" onkeypress="return pulsar(event)" value="<?=$familia_cant_acargo?>"/></td>
            <td>Miembros que reciben ingresos</td>
            <td><input name="familia_reciben_ingresos" type="text" id="familia_reciben_ingresos" size="2" onkeypress="return pulsar(event)" value="<?=$reciben_ingresos ?>"/></td>
            <td>Monto </td>
            <td><input name="familia_monto" type="text" id="familia_monto" size="2" onkeypress="return pulsar(event)"/></td>
          </tr>
        </table>
          <table width="600" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="213" height="35" align="center">Familias que conviven en la vivienda </td>
              <td width="51"><input name="familia_conviven" type="text" id="familia_conviven" size="2" onkeypress="return pulsar(event)" value="<?=$familias_conviven ?>"/></td>
              <td width="243" align="center">Total general de ingresos familiares </td>
              <td width="93">$
                <input name="familia_ingreso_total" type="text" id="familia_ingreso_total" size="8" onkeypress="return pulsar(event)" value="<?=$familia_ingreso_total?>"/></td>
            </tr>
          </table>
          <table width="600" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><strong>Observaciones</strong></td>
            </tr>
            <tr>
              <td><textarea name="familia_observacion" cols="109" rows="5" id="familia_observacion"><?=$familia_observaciones?></textarea></td>
            </tr>
          </table></td>
      </tr>
	 </table>
    </td>
  </tr>
</table>



<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10" ></td>
  </tr>
  <tr>
    <td width="216" height="25" align="center" bgcolor="#E4E4E4"><strong>SITUACION DOMINIAL </strong></td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="10" colspan="4"></td>
        </tr>
      <tr>
        <td width="209">Fecha de ingreso al lote/vivienda </td>
        <td width="186">Forma de ingreso </td>
        <td colspan="2">Tipo de ocupaci&oacute;n </td>
      </tr>
      <tr>
        <td><input name="fecha_ingreso_lote" type="text" id="fecha_ingreso_lote" size="15" onkeypress="return pulsar(event)" value="<?=$fecha_ingreso_lote ?>"/></td>
        <td><input name="forma_ingreso" type="text" id="forma_ingreso" size="25" onkeypress="return pulsar(event)" value="<?=$forma_ingreso?>"/></td>
        <td width="90">Regular          
          <input name="tipo_ocupacion" type="radio" value="1"  onkeypress="return pulsar(event)" <? if($familia_tipo_ocupacion == 1) {echo "checked=\"checked\"";}?>/></td>
        <td width="115">Irregular 
          <input name="tipo_ocupacion" type="radio" value="0" onkeypress="return pulsar(event)" <? if($familia_tipo_ocupacion == 0) {echo "checked=\"checked\"";}?>/></td>
      </tr>
    </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="4" height="10"></td>
        </tr>
        <tr>
          <td>Forma ocupaci&oacute;n          </td>
          <td>Expte. n&uacute;mero          </td>
          <td>Fecha          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><select name="forma_ocupacion" id="forma_ocupacion">
            <option value="0">Seleccione uno...</option>
            <option value="1" <? if($forma_ocupacion==1){echo "selected=\"selected\"";} ?>>Preadjudicaci&oacute;n</option>
            <option value="2" <? if($forma_ocupacion==2){echo "selected=\"selected\"";} ?>>Adjudicaci&oacute;n</option>
            <option value="3" <? if($forma_ocupacion==3){echo "selected=\"selected\"";} ?>>Certif. transferencia</option>
            <option value="4" <? if($forma_ocupacion==4){echo "selected=\"selected\"";} ?>>Boleto C.V.</option>
            <option value="5" <? if($forma_ocupacion==5){echo "selected=\"selected\"";} ?>>Acta Ley 24374</option>
            <option value="6" <? if($forma_ocupacion==6){echo "selected=\"selected\"";} ?>>Escritura</option>
            <option value="7" <? if($forma_ocupacion==7){echo "selected=\"selected\"";} ?>>Hipoteca</option>
            <option value="8" <? if($forma_ocupacion==8){echo "selected=\"selected\"";} ?>>Transf. sucesivas</option>
            <option value="9" <? if($forma_ocupacion==9){echo "selected=\"selected\"";} ?>>Expte. regulariz.</option>
          </select></td>
          <td><input name="expediente_nro" type="text" id="expediente_nro" size="15" onkeypress="return pulsar(event)"/></td>
          <td><input name="expediente_fecha" type="text" id="expediente_fecha" value="dd/mm/aaaa" size="15" onkeypress="return pulsar(event)"/></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="10"></td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="154" height="35">Posee otra propiedad? </td>
          <td width="110">Si 
          <input name="posee_otraprop" type="radio" value="1" onkeypress="return pulsar(event)" <? if ($familia["Posee_otraprop"]=='1')  {echo "checked=\"checked\"";} ?>/> 
          No 
          <input name="posee_otraprop" type="radio" value="0" <? if ($familia["Posee_otraprop"]=='0') {echo "checked=\"checked\"";} ?> onkeypress="return pulsar(event)"/></td>
          <td width="58">D&oacute;nde? </td>
          <td width="278"><input name="otraprop_lugar" type="text" id="otraprop_lugar" onkeypress="return pulsar(event)" value="<?=$otraprop_lugar ?>"/></td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="179">&nbsp;</td>
          <td width="81">&nbsp;</td>
          <td width="120">Nro. Cheq./Libreta </td>
          <td width="220">Nombre y apellido titular Cheq./Libreta </td>
        </tr>
        <tr>
          <td>Paga chequeras actualmente? </td>
          <td>Si 
          <input name="chequera_paga" type="radio" value="1" onkeypress="return pulsar(event)" <? if($chequera_paga == 1) {echo "checked=\"checked\"";} ?>/> 
          No 
          <input name="chequera_paga" type="radio" value="0" onkeypress="return pulsar(event)" <? if($chequera_paga == 0) {echo "checked=\"checked\"";} ?>/></td>
          <td><input name="chequera_nro" type="text" id="chequera_nro" size="15" onkeypress="return pulsar(event)" value="<?=$chequera_numero ?>"/></td>
          <td><input name="chequera_titular" type="text" id="chequera_titular" size="37" onkeypress="return pulsar(event)" value="<?=$chequera_titular ?>"/></td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="82" height="25">Monto</td>
          <td width="95">Cuotas pagas </td>
          <td width="143">Ultima fecha de pago </td>
          <td width="140">Emisor</td>
          <td width="140">Otro:</td>
        </tr>
        <tr>
          <td>$ 
          <input name="chequera_monto" type="text" id="chequera_monto" size="5" onkeypress="return pulsar(event)" value="<?=$chequera_monto ?>"/></td>
          <td><input name="chequera_cuotas" type="text" id="chequera_cuotas" size="5" onkeypress="return pulsar(event)" value="<?=$chequera_cuotas ?>"/></td>
          <td><input name="chequera_ultimo_pago" type="text" id="chequera_ultimo_pago" size="15" onkeypress="return pulsar(event)" value="<?=$chequera_ultimo_pago ?>"/></td>
          <td><select name="chequera_emisor" id="chequera_emisor">
            <option value="0" <? if($chequera_emisor == 0) {echo "selected=\"selected\"";} ?>>Seleccione...</option>
            <option value="1" <? if($chequera_emisor == 1) {echo "selected=\"selected\"";} ?>>I.V.B.A.</option>
            <option value="2" <? if($chequera_emisor == 1) {echo "selected=\"selected\"";} ?>>B.H.N.</option>
            <option value="3" <? if($chequera_emisor == 3) {echo "selected=\"selected\"";} ?>>I.P.B.</option>
            <option value="4" <? if($chequera_emisor == 4) {echo "selected=\"selected\"";} ?>>Municip.</option>
          </select>
          </td>
          <td><input name="chequera_emisor_otro" type="text" id="chequera_emisor_otro" size="12" onkeypress="return pulsar(event)" value="<?=$chequera_emisor_otro ?>"/></td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="445" height="35">&iquest;Conoce y acepta las 
		  condiciones de la ley 13342 y su decreto reglamentario? </td>
          <td width="155">Si 
            <input name="familia_acepta_ley" type="radio" value="1" checked="checked" onkeypress="return pulsar(event)"/>
          No 
          <input name="familia_acepta_ley" type="radio" value="0" onkeypress="return pulsar(event)"/></td>
        </tr>
      </table>
      <table width="600" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><strong>Documentaci&oacute;n acompa&ntilde;ada/Observaciones</strong></td>
        </tr>
        <tr>
          <td><textarea name="familia_doc_obs" cols="109" rows="7" id="familia_doc_obs"><?=$familia_doc_obs?></textarea></td>
        </tr>
      </table>
      <table width="600" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2"></td>
          <td width="66"></td>
        </tr>
        <tr>
          <td align="left"><input type="hidden" name="Familia_nro" value= "<?=$familia_nro; ?>" onkeypress="return pulsar(event)"/></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="522" align="right">  
		  
		  <input name="cmdReset" type="reset" id="cmdReset" value="Borrar formulario" onkeypress="return pulsar(event)"/></td>
          <td width="12">&nbsp;</td>
          <td>
		  <input name="cmdAccion" type="submit" id="cmdAccion" value="Cargar" onkeypress="return pulsar(event)"/>
		  
		  </td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</form>