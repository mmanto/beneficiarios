<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

$idusuario = $_GET["idusuario"];

$tipo = '2';

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$sql = "SELECT * FROM dbo_usuarios WHERE idUsuario = $idusuario";

$res = mysql_query($sql);

$usuario = mysql_fetch_array($res);


?>

<h2>Modificar datos de usuario</h2>
<p>&nbsp;</p>
<form method="post" action="usuario-modif.php">
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="22" height="35">&nbsp;</td>
    <td width="151"><strong>Nombre completo: </strong></td>
    <td colspan="2"><input name="nombre" type="text" id="nombre" value="<?=$usuario["Nombre"]; ?>"></td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td><strong>Nombre usuario: </strong></td>
    <td colspan="2"><input name="usuario" type="text" id="usuario" value="<?=$usuario["Usuario"]; ?>" maxlength="20"> 
      (M&aacute;x: 20 caracteres) </td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><a href="password-modif-form.php?idUsuario=<?=$idusuario; ?>">Resetear contrase&ntilde;a</a> (si olvid&oacute; o desea modificar la contrase&ntilde;a) </td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td><strong>&Aacute;rea de pertenencia: </strong></td>
    <td colspan="2"><select name ="area" size="1">
			<option value="0" selected="selected">Seleccione un area...</option>
		<?
			$sql5 = "SELECT * FROM dbo_area WHERE Direccion_nro != '99' ORDER BY Area_codigo";
		 	$res5 = mysql_query($sql5);		 
		 while ($area = mysql_fetch_array($res5)) { ?>
              <option value="<?=$area["Area_nro"]; ?>" <? 
			  if($usuario["Area_nro"] == $area["Area_nro"]) { ?> selected <? }?>><?=$area["Area_codigo"]; ?> - <?=$area["Area_nombre"]; ?></option>
		<? } ?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td colspan="2"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="166" height="36" style="font-size: 14px"><strong>M&oacute;dulo Expedientes: </strong></td>
        <td colspan="4" ><select name="HabExp-bk" id="HabExp-bk" style="font-size: 13px">
          <option value="0" <? if($usuario["HabExp"] == '0') { ?>selected <? } ?>>Sin acceso al sistema</option>
          <option value="8" <? if($usuario["HabExp"] == '8') { ?>selected <? } ?>>Sólo consulta</option>
          <option value="7" <? if($usuario["HabExp"] == '7') { ?>selected <? } ?>>Pase de expedientes</option>
          <option value="6" <? if($usuario["HabExp"] == '6') { ?>selected <? } ?>>Pase y alta de exptes.</option>
          <option value="5" <? if($usuario["HabExp"] == '5') { ?>selected <? } ?>>Pase, alta y reingreso</option>
          <option value="4" <? if($usuario["HabExp"] == '4') { ?>selected <? } ?>>Pase, alta, reingreso y modif.</option>
        </select></td>
      </tr>
      <tr>
        <td height="36" valign="middle" style="font-size: 14px"><strong>M&oacute;dulo Beneficiarios: </strong></td>
        <td colspan="4" valign="middle"><select name="HabSbt-BK" id="HabSbt-BK" style="font-size: 13px">
          <option value="0" <? if($usuario["HabSbt"] == '0') { ?>selected <? } ?>>Sin acceso al sistema</option>
          <option value="8" <? if($usuario["HabSbt"] == '8') { ?>selected <? } ?>>Sólo consulta de beneficios</option>
          <option value="7" <? if($usuario["HabSbt"] == '7') { ?>selected <? } ?>>Alta de beneficios</option>
          <option value="6" <? if($usuario["HabSbt"] == '6') { ?>selected <? } ?>>Alta y modificación de beneficios</option>
          <option value="5" <? if($usuario["HabSbt"] == '5') { ?>selected <? } ?>>Modificación de barrios</option>
          <option value="4" <? if($usuario["HabSbt"] == '4') { ?>selected <? } ?>>Anteriores + pedidos tarjetas</option>
        </select></td>
      </tr>
      <tr>
        <td height="36" valign="middle" style="font-size: 14px"><strong>M&oacute;dulo RRHH:</strong></td>
        <td colspan="4" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td valign="bottom" style="font-size: 14px">&nbsp;</td>
        <td colspan="4" valign="bottom">&nbsp;</td>
      </tr>
      <tr>
        <td height="36" valign="middle" style="font-size: 14px"><strong>M&oacute;dulo Expedientes: </strong></td>
        <td width="25" valign="middle"><input name="HabExp" type="radio"  value="0" <? if($usuario["HabExp"] == '0') { ?>checked="checked" <? } ?>/></td>
        <td width="56" valign="middle">No</td>
        <td width="27" valign="middle"><input name="HabExp" type="radio" value="1" <? if($usuario["HabExp"] != '0') { ?>checked="checked" <? } ?>/></td>
        <td width="226" valign="middle">Si</td>
      </tr>
      <tr>
        <td height="36" valign="middle" style="font-size: 14px"><strong>M&oacute;dulo Beneficiarios: </strong></td>
        <td valign="middle"><input name="HabSbt" type="radio"  value="0" <? if($usuario["HabSbt"] == '0') { ?>checked="checked" <? } ?>/></td>
        <td valign="middle">No</td>
        <td valign="middle"><input name="HabSbt" type="radio"  value="1" <? if($usuario["HabSbt"] != '0') { ?>checked="checked" <? } ?> /></td>
        <td valign="middle">Si</td>
      </tr>
      <tr>
        <td height="36" valign="middle" style="font-size: 14px"><strong>M&oacute;dulo Comisiones:</strong></td>
        <td valign="middle"><input name="HabCom" type="radio" id="radio3" value="0" <? if($usuario["HabCom"] == '0') { ?>checked="checked" <? } ?>/></td>
        <td valign="middle">No</td>
        <td valign="middle"><input name="HabCom" type="radio" id="radio7" value="1" <? if($usuario["HabCom"] != '0') { ?>checked="checked" <? } ?>/></td>
        <td valign="middle">Si</td>
      </tr>
      <tr>
        <td height="36" valign="middle" style="font-size: 14px"><strong>M&oacute;dulo RRHH:</strong></td>
        <td valign="middle"><input name="HabRH" type="radio" id="radio4" value="0" <? if($usuario["HabRH"] == '0') { ?>checked="checked" <? } ?>/></td>
        <td valign="middle">No</td>
        <td valign="middle"><input name="HabRH" type="radio" id="radio8" value="1" <? if($usuario["HabRH"] != '0') { ?>checked="checked" <? } ?>/></td>
        <td valign="middle">Si</td>
      </tr>
      <tr>
        <td height="36" valign="middle" style="font-size: 14px"><strong>Módulo Int. Complem.</strong></td>
        <td valign="middle"><input name="HabIntCom" type="radio" id="radio" value="0" <? if($usuario["HabIntCom"] == '0') { ?>checked="checked" <? } ?>/></td>
        <td valign="middle">No</td>
        <td valign="middle"><input name="HabIntCom" type="radio" id="radio2" value="1" <? if($usuario["HabIntCom"] != '0') { ?>checked="checked" <? } ?>/></td>
        <td valign="middle">Si</td>
      </tr>
    </table></td>
    <td width="196">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td colspan="3">
	  <table width="85%" border="0" cellspacing="5" cellpadding="0">
      <tr>
        <td height="36" colspan="6" align="center"><h2>Permisos de usuario </h2></td>
        </tr>
      <tr>
        <td width="33%" height="35" align="center" bgcolor="#FFF7BB">Sistema expedientes</td>
        <td width="12%" bgcolor="#BFBFBF" align="center">Consulta</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Alta</td>
        <td width="13%" bgcolor="#BFBFBF" align="center">Modif.</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Baja</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Pase</td>
      </tr>
      <tr>
        <td height="26"> Expedientes</td>
        <td align="center"><input name="601" type="checkbox" id="601" value="1" <? if($usuario["p601"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="602" type="checkbox" id="602" value="1" <? if($usuario["p602"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="603" type="checkbox" id="603" value="1" <? if($usuario["p603"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="604" type="checkbox" id="604" value="1" <? if($usuario["p604"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="605" type="checkbox" id="605" value="1" <? if($usuario["p605"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
      </tr>
      <tr>
        <td height="5" colspan="6" style="border-bottom:1px solid #666"></td>
        </tr>
      <tr>
        <td height="7" colspan="6"></td>
      </tr>
      <tr>
        <td width="33%" height="35" align="center" bgcolor="#DAF1E7">Módulo comisiones</td>
        <td width="12%" bgcolor="#BFBFBF" align="center">Consulta</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Alta</td>
        <td width="13%" bgcolor="#BFBFBF" align="center">Modif.</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Baja</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Reportes</td>
      </tr>
      <tr>
        <td height="26">Comisiones </td>
        <td align="center"><input name="781" type="checkbox" id="781" value="1" <? if($usuario["p781"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="782" type="checkbox" id="782" value="1" <? if($usuario["p782"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="783" type="checkbox" id="783" value="1" <? if($usuario["p783"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="784" type="checkbox" id="784" value="1" <? if($usuario["p784"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="785" type="checkbox" id="785" value="1" <? if($usuario["p785"] == '1') { echo "checked=\"checked\""; } ?> />          &nbsp;</td>
      </tr>
      <tr>
        <td height="5" colspan="6" style="border-bottom:1px solid #666"></td>
        </tr>
      <tr>
        <td height="7" colspan="6"></td>
      </tr>
      <tr>
        <td width="33%" height="35" align="center" bgcolor="#DAE7F1">Sist. de Beneficiarios</td>
        <td width="12%" bgcolor="#BFBFBF" align="center">Consulta</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Alta</td>
        <td width="13%" bgcolor="#BFBFBF" align="center">Modif.</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Baja</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Asignación</td>
      </tr>
      <tr>
        <td height="26">Beneficios (lotes/familias)</td>
        <td align="center"><input name="701" type="checkbox" id="701" value="1" <? if($usuario["p701"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="702" type="checkbox" id="702" value="1" <? if($usuario["p702"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="703" type="checkbox" id="703" value="1" <? if($usuario["p703"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="704" type="checkbox" id="704" value="1" <? if($usuario["p704"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="705" type="checkbox" id="705" value="1" <? if($usuario["p705"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
      </tr>
      <tr>
        <td height="26" bgcolor="#E1E1E1">Personas</td>
        <td align="center" bgcolor="#E1E1E1"><input name="711" type="checkbox" id="711" value="1" <? if($usuario["p711"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center" bgcolor="#E1E1E1"><input name="712" type="checkbox" id="712" value="1" <? if($usuario["p712"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center" bgcolor="#E1E1E1"><input name="713" type="checkbox" id="713" value="1" <? if($usuario["p713"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center" bgcolor="#E1E1E1"><input name="714" type="checkbox" id="714" value="1" <? if($usuario["p714"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center" bgcolor="#E1E1E1"><input name="715" type="checkbox" id="715" value="1" <? if($usuario["p715"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
      </tr>
      <tr>
        <td height="26">Barrios</td>
        <td align="center"><input name="721" type="checkbox" id="721" value="1" <? if($usuario["p721"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="722" type="checkbox" id="722" value="1" <? if($usuario["p722"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="723" type="checkbox" id="723" value="1" <? if($usuario["p723"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="724" type="checkbox" id="724" value="1" <? if($usuario["p724"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="725" type="checkbox" id="725" value="1" <? if($usuario["p725"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
      </tr>
      <tr>
        <td height="26" bgcolor="#E1E1E1">Exptes. Regularización</td>
        <td bgcolor="#E1E1E1" align="center"><input name="741" type="checkbox" id="741" value="1" <? if($usuario["p741"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td bgcolor="#E1E1E1" align="center"><input name="742" type="checkbox" id="742" value="1" <? if($usuario["p742"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td bgcolor="#E1E1E1" align="center"><input name="743" type="checkbox" id="743" value="1" <? if($usuario["p743"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td bgcolor="#E1E1E1" align="center"><input name="744" type="checkbox" id="744" value="1" <? if($usuario["p744"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td bgcolor="#E1E1E1" align="center"><input name="745" type="checkbox" id="745" value="1" <? if($usuario["p745"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
      </tr>
      <tr>
        <td height="26">Exptes. Escrituración</td>
        <td align="center"><input name="751" type="checkbox" id="751" value="1" <? if($usuario["p751"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="752" type="checkbox" id="752" value="1" <? if($usuario["p752"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="753" type="checkbox" id="753" value="1" <? if($usuario["p753"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="754" type="checkbox" id="754" value="1" <? if($usuario["p754"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="755" type="checkbox" id="755" value="1" <? if($usuario["p755"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
      </tr>
      <tr>
        <td height="26" bgcolor="#E1E1E1">Tarjetas recaudación</td>
        <td align="center" bgcolor="#E1E1E1"><input name="731" type="checkbox" id="731" value="1" <? if($usuario["p731"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center" bgcolor="#E1E1E1"><input name="732" type="checkbox" id="732" value="1" <? if($usuario["p732"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center" bgcolor="#E1E1E1"><input name="733" type="checkbox" id="733" value="1" /<? if($usuario["p733"] == '1') { echo "checked=\"checked\""; } ?> >&nbsp;</td>
        <td align="center" bgcolor="#E1E1E1"><input name="734" type="checkbox" id="734" value="1" <? if($usuario["p734"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center" bgcolor="#E1E1E1"><input name="735" type="checkbox" id="735" value="1" <? if($usuario["p735"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
      </tr>
      <tr>
        <td height="26">Pagos</td>
        <td align="center"><input name="771" type="checkbox" id="771" value="1" <? if($usuario["p771"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="772" type="checkbox" id="772" value="1" <? if($usuario["p772"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="773" type="checkbox" id="773" value="1" <? if($usuario["p773"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="774" type="checkbox" id="774" value="1" <? if($usuario["p774"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center">-&nbsp;</td>
      </tr>
      <tr>
        <td height="26" bgcolor="#E1E1E1">Valores lotes</td>
        <td bgcolor="#E1E1E1" align="center"><input name="761" type="checkbox" id="761" value="1" <? if($usuario["p761"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td bgcolor="#E1E1E1" align="center"><input name="762" type="checkbox" id="762" value="1" <? if($usuario["p762"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td bgcolor="#E1E1E1" align="center"><input name="763" type="checkbox" id="763" value="1" <? if($usuario["p763"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td bgcolor="#E1E1E1" align="center"><input name="764" type="checkbox" id="764" value="1" <? if($usuario["p764"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td bgcolor="#E1E1E1" align="center">-&nbsp;</td>
      </tr>
      
      <tr>
        <td height="26">Tr&aacute;mites 24374 </td>
        <td align="center"><input name="801" type="checkbox" id="801" value="1" <? if($usuario["p801"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="802" type="checkbox" id="802" value="1" <? if($usuario["p802"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="803" type="checkbox" id="803" value="1" <? if($usuario["p803"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="804" type="checkbox" id="804" value="1" <? if($usuario["p804"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center">-&nbsp;</td>
      </tr>
      <tr>
        <td height="26">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td width="33%" height="35" align="center" bgcolor="#FFF7BB">Interv. Complementarias</td>
        <td width="12%" bgcolor="#BFBFBF" align="center">Consulta</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Alta</td>
        <td width="13%" bgcolor="#BFBFBF" align="center">Modif.</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Baja</td>
        <td width="14%" bgcolor="#BFBFBF" align="center">Asig.</td>
      </tr>
      <tr>
        <td height="26"> Fichas/Encuestas</td>
        <td align="center"><input name="901" type="checkbox" id="901" value="1" <? if($usuario["p901"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="902" type="checkbox" id="902" value="1" <? if($usuario["p902"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="903" type="checkbox" id="903" value="1" <? if($usuario["p903"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center"><input name="904" type="checkbox" id="904" value="1" <? if($usuario["p904"] == '1') { echo "checked=\"checked\""; } ?> />&nbsp;</td>
        <td align="center">-&nbsp;</td>
      </tr>
      </table></td>
    </tr>
  <tr>
    <td height="50">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="331" align="right"><input type="hidden" name="idusuario" value="<?=$idusuario; ?>" />&nbsp;	</td>
    <td><input type="submit" name="Submit" value="Actualizar datos" />&nbsp;	</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>

<? include ("pie.php"); ?>
<? } ?>