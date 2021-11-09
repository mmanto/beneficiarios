<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
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
/*
$sqlDir = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dir = mysql_fetch_array($sqlDir);
$dirNombre = $dir["Direccion_nombre"];

$sqlDirProv = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dirprov = mysql_fetch_array($sqlDirProv);
$dirProvNombre = $dir["Direccion_dirprov"];
*/


$idFicha = $_GET["idFicha"];


$sql = "SELECT * FROM dbo_ficha WHERE Ficha_nro = $idFicha";
$res = mysql_query($sql);
$ficha = mysql_fetch_array($res);


$sqlCens = "SELECT * FROM dbo_censistas ORDER BY Censista_num ASC";
$cen = mysql_query($sqlCens);


$idProyecto = $ficha["Proyecto_nro"];

$sqlb = "SELECT * FROM (
dbo_proyecto
INNER JOIN
dbo_partido
ON dbo_proyecto.Partido_nro = dbo_partido.Partido_nro
) WHERE Proyecto_nro = $idProyecto";
$bar = mysql_query($sqlb);
$proyecto = mysql_fetch_array($bar);
$proyecto_nombre = $proyecto["Proyecto_nombre"];
$partido_nombre = $proyecto["Partido_nombre"];




?>
<form action="ficha_modif.php" method="post"><input type="hidden" name="idFicha" value="<?=$idFicha; ?>"/>
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="5"><h2>Modificar datos de la ficha</h2></td>
        </tr>
      <tr>
        <td height="30" colspan="5" valign="top"><a href="ficha_informe.php?idFicha=<?=$idFicha; ?>">[Cancelar]</a></td>
        </tr>
      <tr>
        <td width="35%" style="font-size:16px"><strong>Proyecto: <?=$proyecto_nombre; ?> | Zona:</strong>
          </td>
        <td width="25%"><select name="ficha_zona" id="ficha_zona">
            <option value="1" <? if ($ficha["ficha_zona"] == '1') { echo "selected=\"selected\""; } ?> >1 (telefónico)</option>
            <option value="2" <? if ($ficha["ficha_zona"] == '2') { echo "selected=\"selected\""; } ?>>2 (telefónico)</option>
            <option value="3" <? if ($ficha["ficha_zona"] == '3') { echo "selected=\"selected\""; } ?>>3 (telefónico)</option>
            <option value="4" <? if ($ficha["ficha_zona"] == '4') { echo "selected=\"selected\""; } ?>>4 (telefónico)</option>
            <option value="5" <? if ($ficha["ficha_zona"] == '5') { echo "selected=\"selected\""; } ?> >Zona 1</option>
            <option value="6" <? if ($ficha["ficha_zona"] == '6') { echo "selected=\"selected\""; } ?>>Zona 2</option>
            <option value="7" <? if ($ficha["ficha_zona"] == '7') { echo "selected=\"selected\""; } ?>>Zona 3</option>
            <option value="8" <? if ($ficha["ficha_zona"] == '8') { echo "selected=\"selected\""; } ?>>Zona 4</option>
            <option value="9" <? if ($ficha["ficha_zona"] == '9') { echo "selected=\"selected\""; } ?>>Zona parque</option>
          </select></td>
        <td width="16%"></td>
        <td width="12%" align="center">Ficha Nro.: </td>
        <td width="12%"><input name="ficha_num" type="text" id="ficha_num" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="10" maxlength="8" value="<?=$ficha["ficha_num"]; ?>"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="26" colspan="5" bgcolor="#E4E4E4">UBICACI&Oacute;N LOTE/PARCELA </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="15%">Manzana</td>
        <td width="16%">Lote</td>
        <td colspan="2">Calle/Pasillo</td>
        <td width="23%">Nro.</td>
      </tr>
      <tr>
        <td><input name="ficha_manzana" type="text" id="ficha_manzana" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="<?=$ficha["ficha_lote_manzana"]; ?>" size="10" maxlength="8" /></td>
        <td><input name="ficha_parcela" type="text" id="ficha_parcela" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="<?=$ficha["ficha_lote_parcela"]; ?>" size="10" maxlength="8"/></td>
        <td colspan="2"><input name="ficha_calle" type="text" id="ficha_calle" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="<?=$ficha["ficha_lote_calle"]; ?>" size="30"/></td>
        <td><input name="ficha_vivnum" type="text" id="ficha_vivnum" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="<?=$ficha["ficha_lote_num"]; ?>" size="10"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Teléfono ref:</td>
        <td><input name="ficha_telefono" type="text" id="ficha_telefono" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="15" value="<?=$ficha["ficha_telefono"]; ?>"/></td>
        <td width="20%" align="center">Num Ref. cartográfica:</td>
        <td width="26%"><input name="ficha_refcarto" type="text" id="ficha_refcarto" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="<?=$ficha["ficha_refcarto"]; ?>" size="10"/></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="26" colspan="6" bgcolor="#E4E4E4">DATOS DEL RELEVAMIENTO </td>
        </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
          <td colspan="-1">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="5">Entrevistador </td>
          <td width="24%" colspan="-1">Fecha (dd/mm/aaaa) </td>
        </tr>
        <tr>
          <td colspan="5">
		  <select name="ficha_censista" id="ficha_censista">
          <? while($censista = mysql_fetch_array($cen)) { ?>
          <option value="<?=$censista["Censista_nro"]; ?>" <? if ($censista["Censista_nro"] == $ficha["ficha_censista"]) {echo "selected=\"selected\"";} ?>><?=$censista["Censista_num"]; ?> - <?=$censista["Censista_nombre"]; ?></option><? } ?>
          </select></td>
          <td colspan="-1"><input name="ficha_fecha" type="text" id="ficha_fecha" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="10" maxlength="10" value="<?=$ficha["ficha_fecha"]; ?>"/></td>
        </tr>
        <tr>
          <td height="24" colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="-1">&nbsp;</td>
        </tr>
        <tr>
          <td height="24" colspan="2">Instancia censo</td>
          <td>Estado proceso ubicación</td>
          <td colspan="-1">&nbsp;</td>
        </tr>
        <tr>
          <td height="24" colspan="2"><select name="censo_instancia" id="censo_instancia">
            <option value="1" <? if ($ficha["ficha_censo_instancia"] == '1') { echo "selected=\"selected\""; } ?>>Sin definir</option>
            <option value="2" <? if ($ficha["ficha_censo_instancia"] == '2') { echo "selected=\"selected\""; } ?>>Censado original</option>
            <option value="3" <? if ($ficha["ficha_censo_instancia"] == '3') { echo "selected=\"selected\""; } ?>>Censado telefónico</option>
            <option value="4" <? if ($ficha["ficha_censo_instancia"] == '4') { echo "selected=\"selected\""; } ?>>Relevamiento en campo</option>
            </select></td>
          <td><select name="ubicacion_estado" id="ubicacion_estado">
            <option value="1" <? if ($ficha["ficha_ubicacion_estado"] == '1') { echo "selected=\"selected\""; } ?>>Sin definir</option>
            <option value="2" <? if ($ficha["ficha_ubicacion_estado"] == '2') { echo "selected=\"selected\""; } ?>>Ubicado</option>
            <option value="3" <? if ($ficha["ficha_ubicacion_estado"] == '3') { echo "selected=\"selected\""; } ?>>A reubicar</option>
            <option value="4" <? if ($ficha["ficha_ubicacion_estado"] == '4') { echo "selected=\"selected\""; } ?>>Relocalizado</option>
            <option value="5" <? if ($ficha["ficha_ubicacion_estado"] == '5') { echo "selected=\"selected\""; } ?>>Levantamiento</option>
          </select></td>
          <td colspan="-1">&nbsp;</td>
        </tr>
        <tr>
          <td width="18%">&nbsp;</td>
          <td width="17%">&nbsp;</td>
          <td width="25%" colspan="-1">&nbsp;</td>
          <td width="16%">&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="51%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="5%">&nbsp;</td>
                  <td width="89%">&nbsp;</td>
                  <td width="6%">&nbsp;</td>
                  </tr>
                <tr>
                  <td height="28" colspan="3" bgcolor="#e4e4e4">CARACTERISTICAS DE LA VIVIENDA </td>
                  </tr>
                <tr>
                  <td colspan="3" style="border-bottom:1px solid #CCCCCC">4. Material predominante de los pisos </td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>Sin indicar</td>
                  <td><input name="ficha_p4" type="radio" value="0" <? if ($ficha["ficha_p4"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                  </tr> 
                <tr>
                  <td>&nbsp;</td>
                  <td>Cer&aacute;mica, baldosas, mosaico, m&aacute;rmol, etc. </td>
                  <td><input name="ficha_p4" type="radio" value="1" <? if ($ficha["ficha_p4"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>Cemento o ladrillo fijo </td>
                  <td><input name="ficha_p4" type="radio" value="2" <? if ($ficha["ficha_p4"] == '2') { echo "checked=\"checked\"";}?>/></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>Tierra o ladrillo suelto </td>
                  <td><input name="ficha_p4" type="radio" value="3" <? if ($ficha["ficha_p4"] == '3') { echo "checked=\"checked\""; } ?>/></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>Otro</td>
                  <td><input name="ficha_p4" type="radio" value="9" <? if ($ficha["ficha_p4"] == '4') { echo "checked=\"checked\""; } ?>/></td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="89%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">5. Material predominante de las paredes exteriores </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p5" type="radio" value="0" <? if ($ficha["ficha_p5"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Ladrillo, piedra, bloque u hormig&oacute;n </td>
                    <td><input name="ficha_p5" type="radio" value="1" <? if ($ficha["ficha_p5"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Adobe</td>
                    <td><input name="ficha_p5" type="radio" value="2" <? if ($ficha["ficha_p5"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Madera</td>
                    <td><input name="ficha_p5" type="radio" value="3" <? if ($ficha["ficha_p5"] == '3') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Chapa, metal, fibrocemento </td>
                    <td><input name="ficha_p5" type="radio" value="4" <? if ($ficha["ficha_p5"] == '4') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cart&oacute;n, palma, paja, pl&aacute;stico, mat. de desecho </td>
                    <td><input name="ficha_p5" type="radio" value="5" <? if ($ficha["ficha_p5"] == '5') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otro</td>
                    <td><input name="ficha_p5" type="radio" value="9" <? if ($ficha["ficha_p5"] == '9') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="89%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">6. Paredes exteriores tienen revoque o revestimiento ext.? </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p6" type="radio" value="0" <? if ($ficha["ficha_p6"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Si</td>
                    <td><input name="ficha_p6" type="radio" value="1" <? if ($ficha["ficha_p6"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No</td>
                    <td><input name="ficha_p6" type="radio" value="2" <? if ($ficha["ficha_p6"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="89%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">7. Material predominante cubierta ext. texho </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p7" type="radio" value="0" <? if ($ficha["ficha_p7"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cubierta asf&aacute;ltica o membrana </td>
                    <td><input name="ficha_p7" type="radio" value="1" <? if ($ficha["ficha_p7"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Baldosa o losa (sin cubierta) </td>
                    <td><input name="ficha_p7" type="radio" value="2" <? if ($ficha["ficha_p7"] == '2') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Teja</td>
                    <td><input name="ficha_p7" type="radio" value="3" <? if ($ficha["ficha_p7"] == '3') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Chapa de metal (sin cubierta) </td>
                    <td><input name="ficha_p7" type="radio" value="4" <? if ($ficha["ficha_p7"] == '4') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Chapa de fibrocemento o pl&aacute;stico </td>
                    <td><input name="ficha_p7" type="radio" value="5" <? if ($ficha["ficha_p7"] == '5') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Chapa de cart&oacute;n</td>
                    <td><input name="ficha_p7" type="radio" value="6" <? if ($ficha["ficha_p7"] == '6') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Ca&ntilde;a, palma, tabla o paja con o sin barro</td>
                    <td><input name="ficha_p7" type="radio" value="7" <? if ($ficha["ficha_p7"] == '7') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otro</td>
                    <td><input name="ficha_p7" type="radio" value="9" <? if ($ficha["ficha_p7"] == '9') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="89%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">8. El techo tiene revestim. interior/cielorraso? </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p8" type="radio" value="0" <? if ($ficha["ficha_p8"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Si</td>
                    <td><input name="ficha_p8" type="radio" value="1" <? if ($ficha["ficha_p8"] == '1') { echo "checked=\"checked\""; } ?>  /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No</td>
                    <td><input name="ficha_p8" type="radio" value="2" <? if ($ficha["ficha_p8"] == '2') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="89%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">9. La vivienda tiene electricidad con medido </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p9" type="radio" value="0" <? if ($ficha["ficha_p9"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Si</td>
                    <td><input name="ficha_p9" type="radio" value="1" <? if ($ficha["ficha_p9"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No</td>
                    <td><input name="ficha_p9" type="radio" value="2" <? if ($ficha["ficha_p9"] == '2') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="6%">&nbsp;</td>
                    <td width="88%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">10. Tiene agua </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p10" type="radio" value="0" <? if ($ficha["ficha_p10"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Por ca&ntilde;er&iacute;a dentro de la vivienda</td>
                    <td><input name="ficha_p10" type="radio" value="1" <? if ($ficha["ficha_p10"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>fuera de la vivienda pero dentro del terreno</td>
                    <td><input name="ficha_p10" type="radio" value="2" <? if ($ficha["ficha_p10"] == '2') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>fuera del terreno?</td>
                    <td><input name="ficha_p10" type="radio" value="3" <? if ($ficha["ficha_p10"] == '3') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">11. El agua que usa proviene de </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p11" type="radio" value="0" <? if ($ficha["ficha_p11"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Red p&uacute;blica </td>
                    <td><input name="ficha_p11" type="radio" value="1" <? if ($ficha["ficha_p11"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Pozo</td>
                    <td><input name="ficha_p11" type="radio" value="2" <? if ($ficha["ficha_p11"] == '2') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Transp. por cisterna </td>
                    <td><input name="ficha_p11" type="radio" value="3" <? if ($ficha["ficha_p11"] == '3') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otro</td>
                    <td><input name="ficha_p11" type="radio" value="9" <? if ($ficha["ficha_p11"] == '9') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">12. Esta vivienda </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p12" type="radio" value="0" <? if ($ficha["ficha_p12"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Tiene ba&ntilde;o  </td>
                    <td><input name="ficha_p12" type="radio" value="1" <? if ($ficha["ficha_p12"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Tiene letrina </td>
                    <td><input name="ficha_p12" type="radio" value="2" <? if ($ficha["ficha_p12"] == '2') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>no tiene ba&ntilde;o/letrina </td>
                    <td><input name="ficha_p12" type="radio" value="9" <? if ($ficha["ficha_p12"] == '9') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">13. En el ba&ntilde;o tiene bot&oacute;n, cadena, mochila </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p13" type="radio" value="0" <? if ($ficha["ficha_p13"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Si</td>
                    <td><input name="ficha_p13" type="radio" value="1" <? if ($ficha["ficha_p13"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No</td>
                    <td><input name="ficha_p13" type="radio" value="2" <? if ($ficha["ficha_p13"] == '2') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">14. El desag&uuml;e del inodoro es: </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p14" type="radio" value="0" <? if ($ficha["ficha_p14"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>a red p&uacute;blica (cloaca)  </td>
                    <td><input name="ficha_p14" type="radio" value="1" <? if ($ficha["ficha_p14"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>a c&aacute;mara s&eacute;ptica y pozo ciego </td>
                    <td><input name="ficha_p14" type="radio" value="2" <? if ($ficha["ficha_p14"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>s&oacute;lo a pozo ciego </td>
                    <td><input name="ficha_p14" type="radio" value="3" <? if ($ficha["ficha_p14"] == '3') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>a hoyo, excavaci&oacute;n en la tierra, etc. </td>
                    <td><input name="ficha_p14" type="radio" value="4" <? if ($ficha["ficha_p14"] == '4') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">15. Para cocinar utiliza principalmente:</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p15" type="radio" value="0" <? if ($ficha["ficha_p15"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>gas de red </td>
                    <td><input name="ficha_p15" type="radio" value="1" checked="checked" /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>gas envasado </td>
                    <td><input name="ficha_p15" type="radio" value="2" /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>electricidad</td>
                    <td><input name="ficha_p15" type="radio" value="3" /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>le&ntilde;a o carb&oacute;n </td>
                    <td><input name="ficha_p15" type="radio" value="4" /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>otro</td>
                    <td><input name="ficha_p15" type="radio" value="9" /></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="79%">&nbsp;</td>
                    <td width="14%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">16. &iquest;cu&aacute;ntas habitaciones p/dormir tiene el hogar?:</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cantidad de habitaciones o piezas: </td>
                    <td><select name="ficha_p16" id="ficha_p16">
                      <option value="1" <? if ($ficha["ficha_p16"] == '1') { echo "selected=\"selected\""; } ?> >1</option>
                      <option value="2" <? if ($ficha["ficha_p16"] == '2') { echo "selected=\"selected\""; } ?>>2</option>
                      <option value="3" <? if ($ficha["ficha_p16"] == '3') { echo "selected=\"selected\""; } ?>>3</option>
                      <option value="4" <? if ($ficha["ficha_p16"] == '4') { echo "selected=\"selected\""; } ?>>4</option>
                      <option value="5" <? if ($ficha["ficha_p16"] == '5') { echo "selected=\"selected\""; } ?>>5</option>
                      <option value="6" <? if ($ficha["ficha_p16"] == '6') { echo "selected=\"selected\""; } ?>>6</option>
                      <option value="7" <? if ($ficha["ficha_p16"] == '7') { echo "selected=\"selected\""; } ?>>7</option>
                      <option value="8" <? if ($ficha["ficha_p16"] == '8') { echo "selected=\"selected\""; } ?>>8</option>
                      <option value="9" <? if ($ficha["ficha_p16"] == '9') { echo "selected=\"selected\""; } ?>>9</option>
                      </select></td>
                    </tr>
                  
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                  </table></td>
              <td width="4%">&nbsp;</td>
              <td width="45%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                <tr>
                  <td width="8%">&nbsp;</td>
                  <td width="32%">&nbsp;</td>
                  <td width="9%">&nbsp;</td>
                  <td width="10%">&nbsp;</td>
                  <td width="41%">&nbsp;</td>
                  </tr>
                <tr>
                  <td colspan="5">&nbsp;</td>
                  </tr>
                <tr>
                  <td colspan="5" style="border-bottom:1px solid #CCCCCC">17. Su vivienda tiene </td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td>&nbsp;</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="center">SI</td>
                  <td align="center">No </td>
                  <td>Especificar</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>Uso comercial </td>
                  <td align="center"><input name="ficha_p17_1" type="radio" value="1" <? if ($ficha["ficha_p17_1"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                  <td align="center"><input name="ficha_p17_1" type="radio" value="2" <? if ($ficha["ficha_p17_1"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                  <td><input name="ficha_p17_1_detalle" type="text" id="ficha_p17_1_detalle" size="18" onkeypress="return pulsar(event)" value="<?=$ficha["ficha_p17_1_detalle"]; ?>"/></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>Uso comunitario </td>
                  <td align="center"><input name="ficha_p17_2" type="radio" value="1" <? if ($ficha["ficha_p17_2"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                  <td align="center"><input name="ficha_p17_2" type="radio" value="2" <? if ($ficha["ficha_p17_2"] == '2') { echo "checked=\"checked\""; } ?> /></td>
                  <td><input name="ficha_p17_2_detalle" type="text" id="ficha_p17_2_detalle" size="18"  value="<?=$ficha["ficha_p17_2_detalle"]; ?>" onkeypress="return pulsar(event)"/></td>
                  </tr>
                
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">18. La vivienda que ocupa el hogar es </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p18" type="radio" value="0" <? if ($ficha["ficha_p18"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Propia</td>
                    <td><input name="ficha_p18" type="radio" value="1" <? if ($ficha["ficha_p18"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Alquilada</td>
                    <td><input name="ficha_p18" type="radio" value="2" <? if ($ficha["ficha_p18"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Prestada</td>
                    <td><input name="ficha_p18" type="radio" value="3" <? if ($ficha["ficha_p18"] == '3') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Ocupada de hecho </td>
                    <td><input name="ficha_p18" type="radio" value="4" <? if ($ficha["ficha_p18"] == '4') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otra (especifique aqu&iacute; debajo) </td>
                    <td><input name="ficha_p18" type="radio" value="9" <? if ($ficha["ficha_p18"] == '9') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="ficha_p18_detalle" type="text" id="ficha_p18_detalle" size="18" value="<?=$ficha["ficha_p18_detalle"]; ?>" onkeypress="return pulsar(event)"/></td>
                    <td>&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td height="28" colspan="3" bgcolor="#E4E4E4">CARACTERISTICAS DEL LOTE/PARCELA </td>
                    </tr>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">19. El lote que ocupa esta vivienda pertenece: </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p19" type="radio" value="0" <? if ($ficha["ficha_p19"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>a los ocupantes </td>
                    <td><input name="ficha_p19" type="radio" value="1" <? if ($ficha["ficha_p19"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>al Municipio </td>
                    <td><input name="ficha_p19" type="radio" value="2" <? if ($ficha["ficha_p19"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>a la Provincia </td>
                    <td><input name="ficha_p19" type="radio" value="3" <? if ($ficha["ficha_p19"] == '3') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>a la Naci&oacute;n </td>
                    <td><input name="ficha_p19" type="radio" value="4" <? if ($ficha["ficha_p19"] == '4') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otros (especifique aqu&iacute; debajo) </td>
                    <td><input name="ficha_p19" type="radio" value="5" <? if ($ficha["ficha_p19"] == '5') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="ficha_p19_detalle" type="text" id="ficha_p19_detalle" size="18" value="<?=$ficha["ficha_p19_detalle"]; ?>" onkeypress="return pulsar(event)"/></td>
                    <td>&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No sabe </td>
                    <td><input name="ficha_p19" type="radio" value="6" <? if ($ficha["ficha_p19"] == '6') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="8%">&nbsp;</td>
                    <td width="86%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">20. &iquest;Tiene documentaci&oacute;n? </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p20" type="radio" value="0" <? if ($ficha["ficha_p20"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Si</td>
                    <td><input name="ficha_p20" type="radio" value="1" <? if ($ficha["ficha_p20"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No</td>
                    <td><input name="ficha_p20" type="radio" value="2" <? if ($ficha["ficha_p20"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="8%">&nbsp;</td>
                    <td width="86%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">21. &iquest;que documentaci&oacute;n tiene del lote? </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p21" type="radio" value="0" <? if ($ficha["ficha_p21"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Ninguna</td>
                    <td><input name="ficha_p21" type="radio" value="1" <? if ($ficha["ficha_p21"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Escritura</td>
                    <td><input name="ficha_p21" type="radio" value="2"  <? if ($ficha["ficha_p21"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Boleto de compra-venta </td>
                    <td><input name="ficha_p21" type="radio" value="3" <? if ($ficha["ficha_p21"] == '3') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Adjudicaci&oacute;n</td>
                    <td><input name="ficha_p21" type="radio" value="4" <? if ($ficha["ficha_p21"] == '4') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Tenencia precaria/permiso </td>
                    <td><input name="ficha_p21" type="radio" value="5" <? if ($ficha["ficha_p21"] == '5') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otra documentaci&oacute;n </td>
                    <td><input name="ficha_p21" type="radio" value="6" <? if ($ficha["ficha_p21"] == '6') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No sabe </td>
                    <td><input name="ficha_p21" type="radio" value="7" <? if ($ficha["ficha_p21"] == '7') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Detalle abajo docum. presentada </td>
                    <td>&nbsp;</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="ficha_p21_detalle" type="text" id="ficha_p21_detalle" size="18" value="<?=$ficha["ficha_p21_detalle"]; ?>" onkeypress="return pulsar(event)"/></td>
                    <td>&nbsp;</td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="8%">&nbsp;</td>
                    <td width="86%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">22. Su lote se inunda </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p22" type="radio" value="0" <? if ($ficha["ficha_p22"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Casi siempre </td>
                    <td><input name="ficha_p22" type="radio" value="1" <? if ($ficha["ficha_p22"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>A veces </td>
                    <td><input name="ficha_p22" type="radio" value="2" <? if ($ficha["ficha_p22"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Nunca</td>
                    <td><input name="ficha_p22" type="radio" value="3" <? if ($ficha["ficha_p22"] == '3') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="8%">&nbsp;</td>
                    <td width="84%">&nbsp;</td>
                    <td width="8%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">23. Su lote se inunda </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cuando llueve </td>
                    <td align="center"><label>
                      <input name="ficha_p23_1" type="checkbox" id="ficha_p23_1" value="1" <? if ($ficha["ficha_p23_1"] == '1') { echo "checked=\"checked\""; } ?> />
                      </label></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cuando se desborda una zanja </td>
                    <td align="center"><input name="ficha_p23_2" type="checkbox" id="ficha_p23_2" value="1" <? if ($ficha["ficha_p23_1"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cuando se cumulan aguas negras </td>
                    <td align="center"><input name="ficha_p23_3" type="checkbox" id="ficha_p23_3" value="1" <? if ($ficha["ficha_p23_1"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otras causas (detalle abajo) </td>
                    <td align="center"><input name="ficha_p23_4" type="checkbox" id="ficha_p23_4" value="1" <? if ($ficha["ficha_p23_1"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="ficha_p23_4_detalle" type="text" id="ficha_p23_4_detalle" size="18" onkeypress="return pulsar(event)" value="<?=$ficha["ficha_p23_4_detalle"]; ?>"/></td>
                    <td>&nbsp;</td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="8%">&nbsp;</td>
                    <td width="86%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">24. La calle de acceso a su vivienda se inunda </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p24" type="radio" value="0" <? if ($ficha["ficha_p24"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Casi siempre </td>
                    <td><input name="ficha_p24" type="radio" value="1" <? if ($ficha["ficha_p24"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>A veces </td>
                    <td><input name="ficha_p24" type="radio" value="2" <? if ($ficha["ficha_p24"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Nunca</td>
                    <td><input name="ficha_p24" type="radio" value="3" <? if ($ficha["ficha_p24"] == '3') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="8%">&nbsp;</td>
                    <td width="84%">&nbsp;</td>
                    <td width="8%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">25. La calle de acceso a su vivienda se inunda</td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cuando llueve </td>
                    <td align="center"><label>
                      <input name="ficha_p25_1" type="checkbox" id="ficha_p25_1" value="1" <? if ($ficha["ficha_p25_1"] == '1') { echo "checked=\"checked\""; } ?>/>
                      </label></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cuando se desborda una zanja </td>
                    <td align="center"><input name="ficha_p25_2" type="checkbox" id="ficha_p25_2" value="1" <? if ($ficha["ficha_p25_2"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cuando se cumulan aguas negras </td>
                    <td align="center"><input name="ficha_p25_3" type="checkbox" id="ficha_p25_3" value="1" <? if ($ficha["ficha_p25_3"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otras causas (detalle abajo) </td>
                    <td align="center"><input name="ficha_p25_4" type="checkbox" id="ficha_p25_4" value="1" <? if ($ficha["ficha_p24_4"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="ficha_p25_4_detalle" type="text" id="ficha_p25_4_detalle" size="18" onkeypress="return pulsar(event)" value="<?=$ficha["ficha_p25_4_detalle"]; ?>"/></td>
                    <td>&nbsp;</td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">26. &iquest;Pasa un servicio de recolecci&oacute;n...? </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p26" type="radio" value="0" <? if ($ficha["ficha_p26"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Si</td>
                    <td><input name="ficha_p26" type="radio" value="1" <? if ($ficha["ficha_p26"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No</td>
                    <td><input name="ficha_p26" type="radio" value="2" <? if ($ficha["ficha_p26"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">27. &iquest;Pasa un colectivo a menos de 300m? </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p27" type="radio" value="0" <? if ($ficha["ficha_p27"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Si</td>
                    <td><input name="ficha_p27" type="radio" value="1" <? if ($ficha["ficha_p27"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No</td>
                    <td><input name="ficha_p27" type="radio" value="2" <? if ($ficha["ficha_p27"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" bgcolor="#CCCCCC" height="1"></td>
              </tr>
            <tr>
              <td width="51%">&nbsp;</td>
              <td width="4%">&nbsp;</td>
              <td width="45%">&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="28" colspan="3" bgcolor="#E4E4E4">SALUD</td>
                  </tr>
                <tr>
                  <td width="7%">&nbsp;</td>
                  <td width="87%">&nbsp;</td>
                  <td width="6%">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" style="border-bottom:1px solid #CCCCCC">28. &iquest;Hay miembro con discapacidad permanente? </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p28" type="radio" value="0" <? if ($ficha["ficha_p28"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>Si</td>
                  <td><input name="ficha_p28" type="radio" value="1" <? if ($ficha["ficha_p28"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>No</td>
                  <td><input name="ficha_p28" type="radio" value="2" <? if ($ficha["ficha_p28"] == '2') { echo "checked=\"checked\""; } ?> /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">29. Especifique tipo de discapacidad </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p29" type="radio" value="0" <? if ($ficha["ficha_p29"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                  </tr>
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">Motriz</td>
                    <td width="6%"><input name="ficha_p29" type="radio" value="1" <? if ($ficha["ficha_p29"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Visual</td>
                    <td><input name="ficha_p29" type="radio" value="2" <? if ($ficha["ficha_p29"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Auditiva</td>
                    <td><input name="ficha_p29" type="radio" value="3" <? if ($ficha["ficha_p29"] == '3') { echo "checked=\"checked\""; } ?>/></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Mental</td>
                    <td><input name="ficha_p29" type="radio" value="4" <? if ($ficha["ficha_p29"] == '4') { echo "checked=\"checked\""; } ?>/></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="28" colspan="3" bgcolor="#E4E4E4">OPINIONES/VALORACIONES </td>
                  </tr>
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">30. Principales problemas del barrio: </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><label>1</label></td>
                    <td colspan="2"><textarea name="ficha_p30_1" cols="35" id="ficha_p30_1"><?=$ficha["ficha_p30_1"]; ?></textarea></td>
                    </tr>

                  <tr>
                    <td>2</td>
                    <td><textarea name="ficha_p30_2" cols="35" id="ficha_p30_2"><?=$ficha["ficha_p30_2"]; ?></textarea></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><textarea name="ficha_p30_3" cols="35" id="ficha_p30_3"><?=$ficha["ficha_p30_3"]; ?></textarea></td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">31. &iquest;Que organizaciones o grupos conoce en el barrio? </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><label></label></td>
                    <td colspan="2"><textarea name="ficha_p31" cols="35" id="ficha_p31"><?=$ficha["ficha_p31"]; ?></textarea></td>
                  </tr>

                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td>&nbsp;</td>
              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="3" style="border-bottom:1px solid #CCCCCC">32. &iquest;En el &uacute;ltimo a&ntilde;o alg&uacute;n miembro de su familia particip&oacute; en alguna actividad comunitaria?</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p32" type="radio" value="0" <? if ($ficha["ficha_p32"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                  </tr>
                <tr>
                  <td width="7%">&nbsp;</td>
                  <td width="87%">Si</td>
                  <td width="6%"><input name="ficha_p32" type="radio" value="1" <? if ($ficha["ficha_p32"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>No</td>
                  <td><input name="ficha_p32" type="radio" value="2" <? if ($ficha["ficha_p32"] == '2') { echo "checked=\"checked\""; } ?> /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="28" colspan="3" bgcolor="#E4E4E4">RELEVAMIENTO POR OBSERVACI&Oacute;N </td>
                  </tr>
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">33. Este hogar vive en </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p33" type="radio" value="0" <? if ($ficha["ficha_p33"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Casa</td>
                    <td><input name="ficha_p33" type="radio" value="1" <? if ($ficha["ficha_p33"] == '1') { echo "checked=\"checked\""; } ?> /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Rancho</td>
                    <td><input name="ficha_p33" type="radio" value="2" <? if ($ficha["ficha_p33"] == '2') { echo "checked=\"checked\""; } ?> /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Casilla</td>
                    <td><input name="ficha_p33" type="radio" value="3" <? if ($ficha["ficha_p33"] == '3') { echo "checked=\"checked\""; } ?> /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Departamento</td>
                    <td><input name="ficha_p33" type="radio" value="4" <? if ($ficha["ficha_p33"] == '4') { echo "checked=\"checked\""; } ?>/></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Pieza/s en inquilinato/hotel/pensi&oacute;n</td>
                    <td><input name="ficha_p33" type="radio" value="5" <? if ($ficha["ficha_p33"] == '5') { echo "checked=\"checked\""; } ?>/></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Local no construido para habitaci&oacute;n </td>
                    <td><input name="ficha_p33" type="radio" value="6" <? if ($ficha["ficha_p33"] == '6') { echo "checked=\"checked\""; } ?> /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otros</td>
                    <td><input name="ficha_p33" type="radio" value="9" <? if ($ficha["ficha_p33"] == '9') { echo "checked=\"checked\""; } ?>/></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">34. Focos de basura </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Sin indicar</td>
                    <td><input name="ficha_p34" type="radio" value="0" <? if ($ficha["ficha_p34"] == '0') { echo "checked=\"checked\""; } ?> /></td>
                  </tr>
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">Hay</td>
                    <td width="6%"><input name="ficha_p34" type="radio" value="1" <? if ($ficha["ficha_p34"] == '1') { echo "checked=\"checked\""; } ?>/></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No hay </td>
                    <td><input name="ficha_p34" type="radio" value="2" <? if ($ficha["ficha_p32"] == '2') { echo "checked=\"checked\""; } ?>/></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">35. Nombrar calles y describir si hay arroyos, cables de tensi&oacute;n u otros</td>
                  </tr>
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><textarea name="ficha_p35" cols="35" id="ficha_p35"><?=$ficha["ficha_p35"]; ?></textarea></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>Observaciones</td>
        </tr>
        <tr>
          <td><textarea name="ficha_observaciones" cols="80" rows="5" id="ficha_observaciones"><?=$ficha["ficha_observaciones"]; ?></textarea></td>
        </tr>
        <tr>
          <td height="100" align="right"><input type="submit" name="Submit" value="Modificar datos" /></td>
        </tr>
    </table></td>
  </tr>
</table>
</form>
<? }?>