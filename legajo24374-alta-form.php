<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{


include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_area = $user["Area_nro"];
$usuario_direccion = $user["Direccion_nro"];


//Listado partidos
$strSQL = "SELECT * FROM dbo_partido ORDER BY Partido_nombre ASC";
$partido = mysql_query ($strSQL);

?>
<style type="text/css">
<!--
.Estilo8 {font-size: 13px; font-weight: bold; }
-->
</style>

<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>
<form action="tramite-alta.php" method="post">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="7"><h1>Dar de alta nuevo legajo ley 24374</h1></td>
    </tr>
  <tr>
    <td height="40" colspan="2" valign="top"><a href="sbt-menu.php">[Volver al inicio] </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="23" rowspan="28" align="left" valign="middle">&nbsp;</td>
    <td width="307" rowspan="28" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
      <tr >
        <td height="28" colspan="8" align="center" >&nbsp;</td>
      </tr>
      <tr >
        <td height="28" colspan="8" align="center" bgcolor="#B4D2EB" ><strong>PRUEBA DOCUMENTAL COMPLETA</strong></td>
      </tr>
      <tr >
        <td height="28" bgcolor="#E4EFF8" >&nbsp;</td>
        <td height="28" bgcolor="#E4EFF8" ><strong class="Estilo8">Anterior</strong></td>
        <td height="28" bgcolor="#E4EFF8" ><input name="pruebadocant" type="radio" value="0" /></td>
        <td height="28" bgcolor="#E4EFF8" ><strong>No</strong></td>
        <td height="28" bgcolor="#E4EFF8" ><input name="pruebadocant" type="radio" value="1" checked="checked" /></td>
        <td height="28" bgcolor="#E4EFF8" ><strong>Si</strong></td>
        <td height="28" colspan="2" bgcolor="#E4EFF8" >&nbsp;</td>
        </tr>
      <tr >
        <td height="28" >&nbsp;</td>
        <td height="28" class="Estilo8" >Continua</td>
        <td height="28" ><input name="pruebadoccont" type="radio" value="0" /></td>
        <td height="28" ><strong>No</strong></td>
        <td height="28" ><input name="pruebadoccont" type="radio" value="1" checked="checked" /></td>
        <td height="28" ><strong>Si</strong></td>
        <td height="28" colspan="2" >&nbsp;</td>
        </tr>
      <tr >
        <td width="5%" height="28" bgcolor="#E4EFF8" >&nbsp;</td>
        <td width="30%" bgcolor="#E4EFF8"><strong class="Estilo8">Actual</strong></td>
        <td width="8%" align="center" bgcolor="#E4EFF8"><input name="pruebadocactual" type="radio" value="0" /></td>
        <td width="14%" bgcolor="#E4EFF8"><strong>No</strong></td>
        <td width="8%" align="center" bgcolor="#E4EFF8"><input name="pruebadocactual" type="radio" value="1" checked="checked" /></td>
        <td width="15%" bgcolor="#E4EFF8"><strong>Si</strong></td>
        <td colspan="2" align="center" bgcolor="#E4EFF8">&nbsp;</td>
        </tr>
      <tr >
        <td height="10" colspan="8" style="border-bottom: 1px solid #000;">&nbsp;</td>
      </tr>
      <tr >
        <td height="10" colspan="8">&nbsp;</td>
        </tr>
      <tr >
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
        <td bgcolor="#E7EBD8" class="Estilo8">Completo</td>
        <td align="center" bgcolor="#E7EBD8"><input name="completo" type="radio" value="0" checked="checked" /></td>
        <td bgcolor="#E7EBD8">&nbsp;</td>
        <td align="center" bgcolor="#E7EBD8"><input name="completo" type="radio" value="1" /></td>
        <td bgcolor="#E7EBD8">&nbsp;</td>
        <td align="center" bgcolor="#E7EBD8"><input name="completo" type="radio" value="2" /></td>
        <td bgcolor="#E7EBD8">&nbsp;</td>
      </tr>
      <tr >
        <td height="28">&nbsp;</td>
        <td><span class="Estilo8">C&eacute;dula</span></td>
        <td align="center"><input name="cedula" type="radio" value="0" checked="checked" /></td>
        <td><strong>S/C</strong></td>
        <td align="center"><input name="cedula" type="radio" value="1" /></td>
        <td><strong>Pend.</strong></td>
        <td align="center"><input name="cedula" type="radio" value="2" /></td>
        <td><strong>Adj.</strong></td>
      </tr>
      <tr >
        <td width="5%" height="28" bgcolor="#E7EBD8" >&nbsp;</td>
        <td width="30%" bgcolor="#E7EBD8"><span class="Estilo8">Plancheta</span></td>
        <td width="8%" align="center" bgcolor="#E7EBD8"><input name="plancheta" type="radio" value="0" checked="checked" /></td>
        <td width="14%" bgcolor="#E7EBD8"><strong>S/C</strong></td>
        <td width="8%" align="center" bgcolor="#E7EBD8"><input name="plancheta" type="radio" value="1" /></td>
        <td width="15%" bgcolor="#E7EBD8"><strong>Pend.</strong></td>
        <td width="8%" align="center" bgcolor="#E7EBD8"><input name="plancheta" type="radio" value="2" /></td>
        <td width="12%" bgcolor="#E7EBD8"><strong>Adj.</strong></td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
        <td><span class="Estilo8">Inf. dominio </span></td>
        <td align="center"><input name="infdominio" type="radio" value="0" checked="checked" /></td>
        <td><strong>S/C</strong></td>
        <td align="center"><input name="infdominio" type="radio" value="1" /></td>
        <td><strong>Pend.</strong></td>
        <td align="center"><input name="infdominio" type="radio" value="2" /></td>
        <td><strong>Adj.</strong></td>
      </tr>
      <tr>
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
        <td bgcolor="#E7EBD8"><span class="Estilo8">Pub. Edicto</span></td>
        <td align="center" bgcolor="#E7EBD8"><input name="edicto" type="radio" value="0" checked="checked" /></td>
        <td bgcolor="#E7EBD8"><strong>S/C</strong></td>
        <td align="center" bgcolor="#E7EBD8"><input name="edicto" type="radio" value="1" /></td>
        <td bgcolor="#E7EBD8"><strong>Pend.</strong></td>
        <td align="center" bgcolor="#E7EBD8"><input name="edicto" type="radio" value="2" /></td>
        <td bgcolor="#E7EBD8"><strong>Adj.</strong></td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
        <td><span class="Estilo8">C&aacute;mara Elec. </span></td>
        <td align="center"><input name="camara" type="radio" value="0" checked="checked" /></td>
        <td><strong>S/C</strong></td>
        <td align="center"><input name="camara" type="radio" value="1" /></td>
        <td><strong>Pend.</strong></td>
        <td align="center"><input name="camara" type="radio" value="2" /></td>
        <td><strong>Adj.</strong></td>
      </tr>
      <tr>
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
        <td bgcolor="#E7EBD8"><span class="Estilo8">Relev. Téc. </span></td>
        <td align="center" bgcolor="#E7EBD8"><input name="relevtec" type="radio" value="0" checked="checked" /></td>
        <td bgcolor="#E7EBD8"><strong>S/C</strong></td>
        <td align="center" bgcolor="#E7EBD8"><input name="relevtec" type="radio" value="1" /></td>
        <td bgcolor="#E7EBD8"><strong>Pend.</strong></td>
        <td align="center" bgcolor="#E7EBD8"><input name="relevtec" type="radio" value="2" /></td>
        <td bgcolor="#E7EBD8"><strong>Adj.</strong></td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
        <td class="Estilo8">Plano</td>
        <td align="center"><input name="plano" type="radio" value="0" checked="checked" /></td>
        <td><strong>S/C</strong></td>
        <td align="center"><input name="plano" type="radio" value="1" /></td>
        <td><strong>Pend.</strong></td>
        <td align="center"><input name="plano" type="radio" value="2" /></td>
        <td><strong>Adj.</strong></td>
      </tr>
      <tr>
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
        <td bgcolor="#E7EBD8"><span class="Estilo8">Carta Doc. </span></td>
        <td align="center" bgcolor="#E7EBD8"><input name="cartadoc" type="radio" value="0" checked="checked" /></td>
        <td bgcolor="#E7EBD8"><strong>S/C</strong></td>
        <td align="center" bgcolor="#E7EBD8"><input name="cartadoc" type="radio" value="1" /></td>
        <td bgcolor="#E7EBD8"><strong>Pend.</strong></td>
        <td align="center" bgcolor="#E7EBD8"><input name="cartadoc" type="radio" value="2" /></td>
        <td bgcolor="#E7EBD8"><strong>Adj.</strong></td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
        <td><span class="Estilo8">Terminado</span></td>
        <td align="center"><input name="terminado" type="radio" value="1" /></td>
        <td><strong>Si</strong></td>
        <td align="center"><input name="terminado" type="radio" value="0" checked="checked" /></td>
        <td><strong>No</strong></td>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="30" bgcolor="#E7EBD8">&nbsp;</td>
        <td colspan="7" valign="bottom" bgcolor="#E7EBD8" class="Estilo8">Observaciones</td>
      </tr>
      <tr>
        <td height="28" bgcolor="#E7EBD8">&nbsp;</td>
        <td colspan="7" bgcolor="#E7EBD8"><textarea name="observaciones" cols="38" rows="12" id="observaciones"></textarea></td>
      </tr>
      <tr>
        <td height="13" colspan="8" bgcolor="#E7EBD8"></td>
      </tr>
    </table></td>
    </tr>
  
  <tr>
    <td width="17" height="24">&nbsp;</td>
    <td width="205"><strong>Fecha de inicio </strong></td>
    <td width="179"><strong>Tipo de tr&aacute;mite </strong></td>
    <td width="117">&nbsp;</td>
    <td width="48">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="205" valign="top"><input name="fechainicio" type="text" id="fechainicio" style="font-size:16px;" value="<?=date("d/m/Y"); ?>" size="7"/>
      (dd/mm/aaaa)    </td>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12%" align="center" bgcolor="#FFFF99"><input name="tramitetipo" type="radio" value="1" checked="checked" /></td>
        <td width="32%" height="34" bgcolor="#FFFF99">Regularizaci&oacute;n</td>
        <td width="9%" align="center" bgcolor="#FFFF99"><input name="tramitetipo" type="radio" value="2" /></td>
        <td width="36%" bgcolor="#FFFF99">Consolidaci&oacute;n</td>
        <td width="11%">&nbsp;</td>
      </tr>
    </table></td>
    <td></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><strong>Partido</strong></td>
    <td><strong>Barrio</strong></td>
    <td colspan="2"><strong>Expte</strong></td>
    </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><select name="idPartido" id="idPartido" style="font-size:13px;">
		<option value="0">Seleccione un Partido...</option>
	<? while($rsPart = mysql_fetch_array($partido)) echo "<option value =\"{$rsPart["Partido_nro"]}\">{$rsPart["Partido_nombre"]}\r\n"; ?>
      </select>&nbsp;</td>
    <td><input name="barrio" type="text" id="barrio" style="font-size:16px;" size="12" />
    &nbsp;</td>
    <td colspan="2"><input name="expte" type="text" id="expte" style="font-size:16px;" size="12" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td height="26" colspan="9" align="center" valign="bottom" bgcolor="#FFE1C4"><strong><u>NOMENCLATURA CATASTRAL</u></strong></td>
        </tr>
      <tr>
        <td colspan="9" align="center" valign="middle" bgcolor="#FFE1C4"><strong>Atenci&oacute;n:</strong>  Reemplazar en cada campo el valor 0 (cero) por el correspondiente. En caso de no contener la nomenclatura algunos de los datos indicados, conservar el valor por defecto 0 (cero). </td>
        </tr>
      <tr>
        <td width="25" valign="bottom" bgcolor="#FFE1C4">&nbsp;</td>
        <td width="65" valign="bottom" bgcolor="#FFE1C4"><strong>Circ.</strong></td>
        <td width="68" valign="bottom" bgcolor="#FFE1C4"><strong>Secc.</strong></td>
        <td width="65" valign="bottom" bgcolor="#FFE1C4"><strong>Ch.</strong></td>
        <td width="59" valign="bottom" bgcolor="#FFE1C4"><strong>Qta.</strong></td>
        <td width="65" valign="bottom" bgcolor="#FFE1C4"><strong>Fracc.</strong></td>
        <td width="73" valign="bottom" bgcolor="#FFE1C4"><strong>Mz.</strong></td>
        <td width="62" valign="bottom" bgcolor="#FFE1C4"><strong>Pc.</strong></td>
        <td width="64" valign="bottom" bgcolor="#FFE1C4"><strong>Subpc.</strong></td>
        </tr>
      <tr>
        <td height="25" valign="top" bgcolor="#FFE1C4">&nbsp;</td>
        <td bgcolor="#FFE1C4"><input name="lote_circ" type="text" id="lote_circ"  size="3" onkeypress="return pulsar(event)" value="0"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_secc" type="text" id="lote_secc"  size="3" onkeypress="return pulsar(event)" value="0"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_ch" type="text" id="lote_ch"  size="3" onkeypress="return pulsar(event)" value="0"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_qta" type="text" id="lote_qta"  size="3" onkeypress="return pulsar(event)" value="0"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_fracc" type="text" id="lote_fracc" size="3" onkeypress="return pulsar(event)" value="0"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_manzana" type="text" id="lote_manzana" value="0" size="3" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_parcela" type="text" id="lote_parcela" value="0" size="3" onkeypress="return pulsar(event)"/></td>
        <td bgcolor="#FFE1C4"><input name="lote_subpc" type="text" id="lote_subpc" value="0" size="3" onkeypress="return pulsar(event)"/></td>
        </tr>
      <tr>
        <td height="6" colspan="9" valign="top"></td>
        </tr>
    </table>&nbsp;</td>
    </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><strong>Direcci&oacute;n</strong></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td colspan="2"><input name="direccion" type="text" id="direccion" style="font-size:16px;" size="50"/></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>Apellido titular 1</strong></td>
    <td><strong>Nombre titular 1</strong></td>
    <td colspan="2"><strong>DNI Titular 1</strong> (Sin puntos)</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="Tit1Apellido" type="text" id="Tit1Apellido" style="font-size:16px;" size="18"/>
    &nbsp;</td>
    <td><input name="Tit1Nombre" type="text" id="Tit1Nombre" style="font-size:16px;" size="14"/></td>
    <td colspan="2"><input name="Tit1DNI" type="text" id="Tit1DNI" style="font-size:16px;" size="10" />&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><strong>Tel&eacute;fono</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="telefono" type="text" id="telefono" style="font-size:16px;" size="20"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24" colspan="5" style="border-bottom: 1px solid #999;">&nbsp;</td>
    </tr>
  <tr>
    <td height="32">&nbsp;</td>
    <td><strong>Apellido titular 2</strong></td>
    <td><strong>Nombre titular 2</strong></td>
    <td colspan="2"><strong>DNI Titular</strong> 2 (Sin puntos)</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="Tit2Apellido" type="text" id="Tit2Apellido" style="font-size:16px;" size="18"/>
    &nbsp;</td>
    <td><input name="Tit2Nombre" type="text" id="Tit2Nombre" style="font-size:16px;" size="14"/></td>
    <td colspan="2"><input name="Tit2DNI" type="text" id="Tit2DNI" style="font-size:16px;" size="10" />&nbsp;</td>
    </tr>
  <tr>
    <td colspan="5" style="border-bottom: 1px solid #999;">&nbsp;</td>
    </tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td><strong>Titular de dominio</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4"><textarea name="titularDom" cols="70" rows="2" id="titularDom" style="font-size:16px;"></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="68%"><strong>Escribano</strong></td>
          <td colspan="2"><strong>Ref. </strong></td>
          <td width="9%">&nbsp;</td>
        </tr>
        <tr>
          <td><input name="escribano" type="text" id="escribano" style="font-size:16px;" size="40"/></td>
          <td colspan="2" align="left"><input name="numref" type="text" id="numref" style="font-size:16px;" size="10"/></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="7%" align="center">&nbsp;</td>
          <td width="16%">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="26"><strong>Caja</strong></td>
          <td align="center" bgcolor="#DBDBDB"><input name="archivado" type="checkbox" id="archivado" value="1" /></td>
          <td bgcolor="#DBDBDB">Archivado</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input name="caja" type="text" id="caja" style="font-size:16px;" size="40"/></td>
          <td colspan="3" align="center">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td colspan="2" rowspan="2" align="center" valign="middle"><input type="submit" name="Submit" value="Dar de alta legajo" /></td>
    <td width="4" height="60" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="40" valign="top">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? include("pie.php"); ?>

<? } ?>