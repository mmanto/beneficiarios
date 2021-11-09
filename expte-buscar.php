<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

?>
<style type="text/css">
<!--
.Estilo2 {font-size: 24px}
.Estilo3 {font-size: 10px}
-->
</style>
<script language="JavaScript"> 

function habilita1(){ 
    document.buscar.exptenum.disabled = false; 
   } 

function deshabilita1(){ 
    document.buscar.exptenum.disabled = true; 
    document.buscar.exptenum.value = ""; 
	}
function habilita2(){ 
    document.buscar.extracto.disabled = false; 
   } 

function deshabilita2(){ 
    document.buscar.extracto.disabled = true; 
    document.buscar.extracto.value = ""; 
	}
  </script> 
<form method="post" action="expte-busqueda.php" name="buscar">
<table width="852" border="0" cellspacing="6" cellpadding="0">
  <tr>
    <td height="60" colspan="10"><h1>Buscar expediente en el sistema </h1></td>
  </tr>
  <tr>
    <td height="26" colspan="8"><a href="exptes-listar-area.php">[Volver al listado inicio]</a></td>
    <td>&nbsp;</td>
    <td><? echo $usuario_area; ?>&nbsp;-- <?=$_SESSION["user_id"]; ?></td>
  </tr>
  <tr>
    <td height="26">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30" height="22">&nbsp;</td>
    <td width="27" align="center" valign="top"><input name="criterio" type="radio" value="1" checked></td>
    <td colspan="6" valign="top">Buscar por identificaci&oacute;n completa </td>
    <td width="29">&nbsp;</td>
    <td width="238" rowspan="15" valign="top"><table width="100%" border="0" cellpadding="10" cellspacing="0" bordercolor="#FFCC99">
      <tr>
        <td bgcolor="#FFFF99" style="border: 2px solid #FFCC33"><strong>Atenci&oacute;n:</strong> Aseg&uacute;rse seleccionar la opci&oacute;n correcta de b&uacute;squeda. Si el expediente no lleva n&uacute;mero de Partido y RNRD deje dichos campos con el valor por defecto (cero). </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="exptecaract" type="text" id="exptecaract" style="font-size:16px;" size="2"> 
      <span class="Estilo2">- </span></td>
    <td bgcolor="#E1E1E1" class="Estilo2"><input name="exptepart" type="text" id="exptepart" style="font-size:16px;" value="0" size="1"> 
    - </td>
    <td bgcolor="#E1E1E1" class="Estilo2"><input name="expternrd" type="text" id="expternrd" style="font-size:16px;" value="0" size="1"> 
    - </td>
    <td><input name="exptenum1" type="text" id="exptenum1" style="font-size:16px;" size="2">
      <span class="Estilo2">/</span></td>
    <td><input name="expteanio" type="text" id="expteanio" style="font-size:16px;" size="2"> 
      <span class="Estilo2">-</span></td>
    <td><input name="exptealc" type="text" id="exptealc" style="font-size:16px;" value="0" size="1"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2" align="center">&nbsp;</td>
    <td height="3" align="center" bgcolor="#CCCCCC"></td>
    <td height="3" align="center" bgcolor="#CCCCCC"></td>
    <td height="3" align="center" bgcolor="#CCCCCC"></td>
    <td align="center" bgcolor="#CCCCCC" class="Estilo3"></td>
    <td align="center" bgcolor="#CCCCCC" class="Estilo3"></td>
    <td align="center" bgcolor="#CCCCCC" class="Estilo3"></td>
    <td rowspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td align="center" valign="top"><span class="Estilo3">CARACTERISTICA</span></td>
    <td align="center" valign="top" class="Estilo3">PARTIDO</td>
    <td align="center" valign="top" class="Estilo3">RNRD</td>
    <td align="center" valign="top" class="Estilo3">N&Uacute;MERO</td>
    <td align="center" valign="top" class="Estilo3">A&Ntilde;O</td>
    <td align="center" valign="top" class="Estilo3">ALC.</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td colspan="8" >&nbsp;</td>
  </tr>
  <tr>
    <td height="1"></td>
    <td height="1" colspan="7" bgcolor="#999999"></td>
    <td height="1"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="criterio" type="radio" value="2" onclick="habilita1()"></td>
    <td colspan="6">Buscar s&oacute;lo por n&uacute;mero </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="88"><span class="Estilo2">XXXX -</span></td>
    <td width="73" class="Estilo2">XXX -</td>
    <td width="71" class="Estilo2">XX -</td>
    <td width="78"><input name="exptenum" type="text" style="font-size:16px;" size="3" disabled></td>
    <td width="83"><span class="Estilo2">/ XXXX </span></td>
    <td width="58"><span class="Estilo2">- X </span></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2" align="center">&nbsp;</td>
    <td height="3" align="center" bgcolor="#CCCCCC"></td>
    <td height="3" align="center" bgcolor="#CCCCCC"></td>
    <td height="3" align="center" bgcolor="#CCCCCC"></td>
    <td align="center" bgcolor="#CCCCCC" class="Estilo3"></td>
    <td align="center" bgcolor="#CCCCCC" class="Estilo3"></td>
    <td align="center" bgcolor="#CCCCCC" class="Estilo3"></td>
    <td rowspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td align="center" valign="top"><span class="Estilo3">CARACTERISTICA</span></td>
    <td align="center" valign="top" class="Estilo3">PARTIDO</td>
    <td align="center" valign="top" class="Estilo3">RNRD</td>
    <td align="center" valign="top" class="Estilo3">N&Uacute;MERO</td>
    <td align="center" valign="top" class="Estilo3">A&Ntilde;O</td>
    <td align="center" valign="top" class="Estilo3">ALC.</td>
  </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="1"></td>
    <td height="1" colspan="7" bgcolor="#999999"></td>
    <td height="1"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><input name="criterio" type="radio" value="3" onclick="habilita2()"></td>
    <td colspan="6">Buscar por extracto </td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="50">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="6"><label>
      <input name="extracto" type="text" id="extracto" style="font-size:16px;" value="" size="40" disabled>
    </label></td>
    <td>&nbsp;</td>
	<td><input type="submit" name="Submit" value="Buscar expediente">&nbsp;</td>
    </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<form method="post" action="remito-busqueda.php" name="buscar-remito">
<table width="852" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="40">&nbsp;</td>
    <td width="23" bgcolor="#E6E6E6">&nbsp;</td>
    <td height="56" colspan="3" bgcolor="#E6E6E6"><h1>B&uacute;squeda de remitos </h1></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#E6E6E6">&nbsp;</td>
    <td width="225" bgcolor="#E6E6E6">Ingrese el n&uacute;mero de remito a buscar:</td>
    <td width="174" bgcolor="#E6E6E6"><input name="remito_nro" type="text" id="remito_nro" style="font-size:16px;" size="8">&nbsp;</td>
    <td width="390" bgcolor="#E6E6E6"><input type="submit" name="Submit" value="Buscar remito">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#E6E6E6">&nbsp;</td>
    <td colspan="3" bgcolor="#E6E6E6">&nbsp;</td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</form>

<? include("pie.php"); ?>