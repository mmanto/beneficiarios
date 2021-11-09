<?

include ("conec.php");

$log_direccion = $_GET["nbsp567"];
$log_usuario = $_GET["qprst645"];
$log_nivel = $_GET["ghlst251"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";

include("cabecera.php");

?>
<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>

<form action="nota-respuesta.php" method="POST" target="_blank">
<input type="hidden" name="log_usuario" value="<?=$log_usuario ?>" />
<input type="hidden" name="log_direccion" value="<?=$log_direccion ?>" />
<input type="hidden" name="log_nivel" value="<?=$log_nivel ?>" />
<table width="726" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="6"><h2>Generaci&oacute;n de nota de respuesta   </h2></td>
    <td width="126" rowspan="2">&nbsp;</td>
    <td width="126" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="16" colspan="6"><a href="javascript:history.go(-1)">Volver al panel de administraci&oacute;n </a></td>
  </tr>
  <tr>
    <td width="39" rowspan="10">&nbsp;</td>
    <td width="118" height="35">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Destintario</td>
    <td height="30" colspan="4" valign="top"><label>
      <select name="destinatario">
	  <option value="0" selected="selected">Seleccione uno...</option>
	  <option value="1">Dir. Gral. Inmobiliaria y Social (IVBA)</option>
	  <option value="2">Dir. de Regularizacion (SSTUV)</option>
	  <option value="3">Dir. Urb. Sociales Planificadas (SSTUV)</option>
	  <option value="4">Dirección Social (IVBA)</option>
	  <option value="5">Dirección Titularización de Inmuebles (SSTUV)</option>
	  <option value="6">Dir. Prov. de Coord. de Prog. Habit. (De Carli)</option>
	  <option value="7">Unidad Administrador Instituto de la Vivienda</option>
      </select>
    </label></td>
    <td colspan="2" rowspan="6" align="right" valign="top"><table width="95%" border="0" cellpadding="12" cellspacing="0" bgcolor="#FFFF99">
      <tr>
        <td>Atenci&oacute;n: Una vez que se genere la nota, el sistema registrar&aacute; la numeraci&oacute;n correspondiente. Verifique los datos antes de pulsar el bot&oacute;n &quot;Generar nota&quot; ya que esta operaci&oacute;n es irreversible. </td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td valign="top">Ingrese referencia: </td>
    <td height="30" colspan="4" valign="top"><input name="referencia" type="text" id="referencia" size="36" /> 
      * </td>
    </tr>
  <tr>
    <td height="26">Tipo Respuesta:</td>
    <td width="27"><label>
      <input name="tipo_informe" type="radio" value="1" checked="checked" />
    </label></td>
    <td width="83">Negativa</td>
    <td width="27"><input name="tipo_informe" type="radio" value="2" /></td>
    <td width="180">Positiva</td>
    </tr>
  <tr>
    <td height="26">Cant. informes </td>
    <td colspan="4"><input name="cant_informes" type="text" size="5" /> 
      * * </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="4"><p>(*) Ingrese la referencia de la nota, por ejemplo &quot;Expediente 2416-796/08&quot; o &quot;Nota 2453/12&quot; o &quot;Barrio Los Alamos&quot; (sin comillas) </p>
      <p>(**) Si la nota es de respuesta positiva, indique la cantidad de informes individuales que acompa&ntilde;ar&aacute;n a la misma </p></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="4"><input name="cmdLogin" type="submit" id="cmdLogin" value="Generar nota"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<?       
include "pie.php";
?>
