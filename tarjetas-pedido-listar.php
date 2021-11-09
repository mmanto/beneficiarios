<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include("cabecera.php");
include ("conec.php");
include ("funciones.php");


$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$idDireccion = $user["Direccion_nro"];
$idNivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

$sql = "SELECT *  FROM (
dbo_familia
INNER JOIN
dbo_barrio
ON dbo_familia.Barrio_nro = dbo_barrio.Barrio_nro
) where Familia_tarjeta_solicitar = '1' AND Familia_matricula = '0' AND blnActivo = '1' ORDER BY Barrio_nombre, Lote_manzana, Lote_parcela ASC";

}

$res = mysql_query($sql);

$cant = mysql_num_rows($res);


?>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="901"><h1>Informe de beneficiarios de tierras </h1></td>
  </tr>
  <tr>
    <td>La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras | <?=$_SESSION["user_id"]; ?></td>
  </tr>
  <tr>
    <td height="24" valign="bottom"><a href="sbt-menu.php">Volver al menu</a></td>
  </tr>
  <tr>
    <td height="8">&nbsp;</td>
  </tr>
  <tr>
    <td height="28">&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td height="25">
	<? if ($cant > 0) { ?>
	<table width="900" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td width="25"><img src="imagen/escrit-ico.jpg" alt="" width="16" height="16" /></td>
	    <td width="87">Escriturado</td>
	    <td colspan="2"><img src="imagen/escrit-anul-ico.jpg" /></td>
	    <td width="110">Escrit. anulada</td>
	    <td width="25"><img src="imagen/tramitesc-ico.jpg" width="16" height="16" /></td>
	    <td width="109">En tr&aacute;mite escrit.</td>
	    <td width="26"><img src="imagen/gescrit-ico.jpg" alt="" /></td>
	    <td width="106">En gesti&oacute;n escrit.</td>
	    <td width="30"><img src="imagen/faltadoc-ico.jpg" /></td>
	    <td width="91">Falta docum.</td>
	    <td width="23"><img src="imagen/pagoscancelados.jpg" width="16" height="16" /></td>
	    <td width="125">Pagos. cancelados</td>
	    <td width="24"><img src="imagen/adj-pendiente-ico.jpg" width="16" height="16" /></td>
	    <td width="91">Adj. pendiente</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td colspan="2">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td bgcolor="#FFCCCC">&nbsp;</td>
	    <td bgcolor="#FFCCCC">&nbsp;</td>
	    <td width="14" align="center" bgcolor="#FFCCCC">&nbsp;</td>
	    <td width="14" align="center">:</td>
	    <td>Dado de baja</td>
	    <td><img src="imagen/boleto-ico.jpg" width="16" height="16" /></td>
	    <td>Con Boleto C/V</td>
	    <td><img src="imagen/tarjeta-solic-ico.jpg" /></td>
	    <td>Solicitar tarjeta</td>
	    <td><img src="imagen/ausente-ico.jpg" /></td>
	    <td>Ausente</td>
	    <td><img src="imagen/verif.png" width="16" height="16" /></td>
	    <td>Verificar</td>
	    <td><img src="imagen/conflicto-ico.jpg" /></td>
	    <td>Conflitco</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td align="center">&nbsp;</td>
	    <td align="center">&nbsp;</td>
	    <td colspan="3">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  </table>
	 <form method="post" action="tarjetas-pedido.php">	  
	<table width="900" border="1" cellspacing="0" cellpadding="3">
      <tr>
      <td width="141" align="center" class="titulo_dato">Barrio </td>
      <td width="24" height="30" align="center" class="titulo_dato">Mz.</td>
      <td width="23" align="center" class="titulo_dato">Pc.</td>
      <td width="334" class="titulo_dato">Apellido, nombre y documento </td>
      <td width="143" align="center" class="titulo_dato">Estado</td>
      <td width="77" align="center" class="titulo_dato">Resoluci&oacute;n</td>
      <td width="70" align="center" class="titulo_dato">Acciones</td>
      <td width="22" align="center" class="titulo_dato"><input type="checkbox" onclick="marcar(this);" /></td>
      </tr>
      
      
      
  <?


while ($familia = mysql_fetch_array($res)) {

$lote_circ = $familia["Lote_circunscripcion"];
if($familia["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $familia["Lote_seccion"];}
if($familia["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $familia["Lote_chacra"];}
if($familia["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $familia["Lote_quinta"];}
if($familia["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $familia["Lote_fraccion"];}
$manzana = $familia["Lote_manzana"];
$parcela = $familia["Lote_parcela"];


$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND Persona_baja != '1' AND blnActivo = '1' ORDER BY Persona_nro",$link);
?>
      <tr>
      <td align="center"><?=$familia["Barrio_nombre"] ?></td>
      <td align="center"><? echo $manzana; ?></td>
      <td align="center"><? echo $parcela; ?></td>
      <td align="center"><table width="98%" border="0" cellspacing="0" cellpadding="1">
        <? while ($persona = mysql_fetch_array($sql2)){ ?>
        <tr>
          <td width="82%"><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
          <td width="18%"><? echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?></td>
        </tr>
        <? } ?>
        </table>	</td>
      <td align="center" valign="middle"><? include "referencias-benef.php"; ?></td>
      <td align="center"><?=$familia["Familia_res_adj"] ?></td>
      <td align="center"><a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$familia["Familia_nro"]; ?>')>Ver informe</a></td>
      <td align="center"><input type="checkbox" name="seleccion[]" value="<?=$familia["Familia_nro"]; ?>" /></td>
      </tr>
  <?
}
?><tr>
    <td colspan="7" align="right">Marcar/desmarcar todos </td><td align="center"><input type="checkbox" onclick="marcar(this);" /></td></tr>
    </table>
	<table width="740" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="21">&nbsp;</td>
    <td width="691" align="left">
	<? if ($user["p732"] == '1' && $user["HabSbt"] != '0') { ?>
	<table width="585" border="0" cellpadding="4" cellspacing="0" bgcolor="#B3DF9D">
      <tr>
        <td width="1" height="28" valign="top" style="font-size:14px; font-weight:bold">&nbsp;</td>
        <td height="34" colspan="5" valign="middle" style="font-size:14px; font-weight:bold">Solicitar tarjetas para  los beneficios seleccionados </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="4">ATENCI&Oacute;N: Tenga presente que la acci&oacute;n afectar&aacute; a todos los beneficios seleccionados, y que la misma NO puede ser revertida autom&aacute;ticamente. <strong>Sea prudente en el uso de esta herramienta. </strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="23">&nbsp;</td>
        <td width="116" align="right">&nbsp;</td>
        <td width="209" align="right">&nbsp;</td>
        <td width="181" align="right"><input name="enviar" type="submit" id="enviar" value="Solicitar tarjetas" /></td>
        <td width="7" align="right">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
    </table>
	<? } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
	 </form>
</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
  </tr>
</table>
<? include "pie.php"; ?>
<? } ?>