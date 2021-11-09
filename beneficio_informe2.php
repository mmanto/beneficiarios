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

if(!$_POST["dni_busqueda"]) {

$persona_familia = $_GET["idFamilia"];

}else{

$persona_doc_nro = $_POST["dni_busqueda"];

$sqlPer = mysql_query("SELECT Familia_nro FROM dbo_persona WHERE Persona_dni_nro = $persona_doc_nro",$link);
$prb = mysql_fetch_array($sqlPer);
$persona_familia = $prb["Familia_nro"];
$count = mysql_num_rows($sqlPer);

}

$sql = "SELECT * FROM (
dbo_familia
INNER JOIN
dbo_usuarios
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario
) WHERE Familia_nro = $persona_familia";
$resFlia = mysql_query($sql);
$familia = mysql_fetch_array($resFlia);
$familia_matricula = $familia["Familia_matricula"];
$lote_circ = $familia["Lote_circunscripcion"];
$lote_secc = $familia["Lote_seccion"];
$lote_ch = $familia["Lote_chacra"];
$lote_qta = $familia["Lote_quinta"];
$lote_fr = $familia["Lote_fraccion"];
$lote_mz = $familia["Lote_manzana"];
$lote_pc = $familia["Lote_parcela"];
$lote_subpc = $familia["Lote_subparcela"];
$altabenef = cambiaf_a_normal($familia["insert_fecha"]);
$modifbenef = cambiaf_a_normal($familia["modif_fecha"]);
$familia_montoadj = $familia["Familia_montoadj"];
$familia_montoact = $familia["Familia_monto_actualizacion"];
$familia_montoadj_pago = $familia["Familia_montoadj_pago"];

if ($familia_montoact != '0') {$saldo = $familia_montoact-$familia_montoadj_pago; }else{$saldo = $familia_montoadj-$familia_montoadj_pago;}

$familia_tarjeta_nro = $familia["Familia_tarjeta_nro"];
$familia_cancelacion_monto = $familia["Familia_cancelacion_monto"];
$familia_cancelacion_fecha = $familia["Familia_cancelacion_fecha"];
$adjudicacion_pendiente = $familia["Adjudicacion_pendiente"];
$familia_ocupacion_verificar = $familia["Familia_ocupacion_verificar"];
$modif_usuario = $familia["modif_usuario"];
$boleto_fecha = $familia["Boleto_fecha"];


//Partido
$partido_nro = $familia["Partido_nro"];

$sqlPdo = "SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $partido_nro";
$resPdo = mysql_query($sqlPdo);
$partido = mysql_fetch_array($resPdo);
$partido_nombre = $partido["Partido_nombre"];


//Barrio
$idBarrio = $familia["Barrio_nro"];
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
//$partido_nombre = $barrio["Partido_nombre"];

//Expte escrituración

$idExpte = $familia["Expte_esc_nro"];

$SQLexp = "SELECT * FROM dbo_expte_esc WHERE Expte_nro = $idExpte";
$resExpte = mysql_query($SQLexp);
$expte = mysql_fetch_array($resExpte);

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
//$expte_barrio = $expte["Barrio_nombre"];
$expte_alcance = $expte["Expte_alcance"];
$expte_cuerpo = $expte["Expte_cuerpo"];
$expte_envio_egg = cambiaf_a_normal($expte["Expte_envio_egg"]);
$expte_destino = $expte["Expte_salida_destino"];
$expte_mov = $expte["Expte_mov"];



//Select beneficiarios 

$sql2 = mysql_query("SELECT * FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
INNER JOIN
dbo_estado_civil
ON dbo_persona.Estado_civil_nro = dbo_estado_civil.Estado_civil_nro)
WHERE Familia_nro = $persona_familia AND blnActivo != '0' ORDER BY Persona_baja ASC,Persona_nro ASC",$link);


//Busqueda expediente regularizacion

$idExpteReg = $familia["Expte_reg_nro"]; 

$sql3 = mysql_query("SELECT * FROM dbo_expte_reg WHERE Expte_nro = $idExpteReg");
$exptereg = mysql_fetch_array($sql3);


$exptereg_nro = $exptereg["Expte_nro"];
$exptereg_caract = $exptereg["Expte_caract"];
$exptereg_num = $exptereg["Expte_num"];
$exptereg_anio = $exptereg["Expte_anio"];
$exptereg_anio_res = substr($exptereg_anio, 2, 2);
//$expte_barrio = $expte["Barrio_nombre"];
$exptereg_alcance = $exptereg["Expte_alcance"];
$exptereg_cuerpo = $exptereg["Expte_cuerpo"];


//Ultima modificacion
$rsUsrModif = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = $modif_usuario");
$usrModif = mysql_fetch_array($rsUsrModif);

?>

<style type="text/css">
<!--
.Estilo2 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 14px}
-->
</style>
<? if ($count == '0') { echo "No"; }else{ ?>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Informaci&oacute;n del  beneficio</h2></td>
  </tr>
	  <? if ($familia_matricula != '0'){ ?><tr>
	    <td bgcolor="#FFFF99" height="36" align="center"><span style="font-size:18px; font-weight:bold"> INMUEBLE ESCRITURADO | Matr&iacute;cula N&ordm; 
        <?=$familia_matricula; ?></span></td><? } ?>
	<? if ($adjudicacion_pendiente != '0'){ ?><tr>
	    <td bgcolor="#DCD1FA" height="36" align="center"><span style="font-size:18px; font-weight:bold"> ADJUDICACION PENDIENTE</span></td>
	  </tr><? } ?> 
	  <? if ($familia_ocupacion_verificar != '0'){ ?><tr>
	    <td bgcolor="#D14421" height="36" align="center"><span style="color: #FFFFFF; font-size:18px; font-weight:bold"> VERIFICAR OCUPACION</span></td>
	  </tr><? } ?> 
	  <tr>
	  <td height="18" valign="top">&nbsp;</td>
	</tr>
</table>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="48%"><span class="Estilo2"><strong>Partido: <? echo $partido_nombre; ?></strong></span></td>
        <td width="52%"><span class="Estilo2"><strong>Barrio: <? echo $barrio_nombre; ?></strong></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="36" colspan="4" align="center" bgcolor="#EFECDC" style="font-size:16px;" >Circ. <strong><? echo $lote_circ; ?></strong> - Secc. <strong><? echo $lote_secc; ?></strong> - Ch. <strong><? echo $lote_ch; ?></strong> - Qta. <strong><? echo $lote_qta; ?></strong> - Fracc. <strong><? echo $lote_fr; ?></strong> - Mz. <strong><? echo $lote_mz; ?></strong> - Pc. <strong><? echo $lote_pc; ?></strong> - Subpc. <strong><? echo $lote_subpc; ?></strong></td>
        </tr>
      <tr>
        <td width="146" height="40" valign="middle">Resoluci&oacute;n de adjudic.: </td>
        <td width="103" height="22" valign="middle"><strong><?=$familia["Familia_res_adj"]; ?></strong></td>
        <td width="351" height="22" align="right" valign="middle"><table width="350" border="0" cellpadding="7" cellspacing="0">
          <tr>
            <td width="152"><strong>Expte. de regularizaci&oacute;n: </strong></td>
            <td width="170"><?=$exptereg_caract; ?>-<?=$exptereg_num; ?>/<?=$exptereg_anio_res ?> <? if($exptereg_alcance != '0') {echo "Alc. ".$exptereg_alcance;}else{ echo " ";} ?> <? if ($exptereg_cuerpo != '0') {echo "Cpo ".$exptereg_cuerpo; }else{ echo " "; } ?>&nbsp;</td>
          </tr>
          
        </table></td>
      </tr>
      <tr>
        <td height="7" colspan="4" valign="middle"></td>
        </tr>
    </table>
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="51%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <? if ($idExpte!='0') { ?>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td colspan="3" bgcolor="#DCE7C7" height="1px"></td>
            </tr>
              <tr>
                <td bgcolor="#FFFFBB">&nbsp;</td>
            <td colspan="2" bgcolor="#FFFFBB">Estado:<strong> En tr&aacute;mite de escrituraci&oacute;n</strong> </td>
            </tr>
              <tr>
                <td width="4%" bgcolor="#FFFFBB">&nbsp;</td>
            <td width="31%" bgcolor="#FFFFBB">Expte. Nro.:</td>
            <td width="65%" bgcolor="#FFFFBB"><strong><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> <? if ($expte_cuerpo != '0') {echo "Cpo ".$expte_cuerpo; }else{ echo " "; } ?></strong></td>
          </tr>
              <tr>
                <td bgcolor="#FFFFBB">&nbsp;</td>
            <td bgcolor="#FFFFBB">Destino:</td>
            <td bgcolor="#FFFFBB"><?
		if ($expte_destino == 1) {
		echo "EGG";
		}elseif ($expte_destino == 2) {
		echo "Municipalidad";
		}elseif ($expte_destino == 3) {
		echo "Ministerio de Infraestructura";
		}elseif ($expte_destino == 4) {
		echo "Instituto de la Vivienda";
		}elseif ($expte_destino == 5) {
		echo "Susbs. Social de Tierras"; }else{
		echo "Sin indicar";}?>&nbsp;</td>
          </tr>
              <tr>
                <td bgcolor="#FFFFBB">&nbsp;</td>
            <td bgcolor="#FFFFBB">Fecha salida:</td>
            <td bgcolor="#FFFFBB"><?=$expte_envio_egg; ?></td>
          </tr>
              <tr>
                <td bgcolor="#FFFFBB"></td>
            <td bgcolor="#FFFFBB">Ultimo mov. </td>
            <td bgcolor="#FFFFBB"><?=$expte_mov; ?></td>
          </tr>
              <tr>
                <td bgcolor="#FFFFBB" height="8px"></td>
            <td bgcolor="#FFFFBB"></td>
            <td bgcolor="#FFFFBB"></td>
          </tr>
            </table></td>
            </tr><? } ?>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><strong>Observaciones:</strong></td>
                </tr>
                <tr>
                  <td><?=$familia["Familia_observaciones"]; ?>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td width="5%">&nbsp;</td>
          <td width="44%">
		  <? if ($familia["Familia_beneficio_origen"]=='2') { ?>
		  <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td width="65%" height="28" align="center" bgcolor="#C6D6F4">Fecha boleto compraventa: </td>
                <td width="35%" bgcolor="#C6D6F4"><? if($boleto_fecha == '0'){ echo "S/D"; }else{ echo $boleto_fecha; } ?>&nbsp;</td>
              </tr>
            </table><? } ?>
	<? if ($familia["Familia_beneficio_origen"]=='1') { ?>		
			
			<table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td height="22" colspan="2"><table width="100%" cellpadding="7" cellspacing="0">
          <tr>
            <td width="97" bgcolor="#C9E3B0"><strong>Tarjeta BAPRO: </strong></td>
            <td width="133" bgcolor="#C9E3B0"><?=$familia["Familia_tarjeta_nro"]; ?></td>
          </tr>
		  <? if ($familia["Familia_tarjeta_nro"] != '0' && $idNivel < '4' ){ ?>
          <tr>
            <td colspan="2" align="center" valign="top" bgcolor="#C9E3B0">&nbsp;
			<a href="tarjeta_pedido_reiteracion.php?idFamilia=<? echo $persona_familia; ?>">[Reiterar solicitud de tarjeta]</a></td>        
			</tr><? } ?>	
        </table></td>
        </tr>
        <tr>
          <td width="22%" height="20">Monto adjudicaci&oacute;n: </td>
          <td width="22%">$ <?=$familia_montoadj; ?>&nbsp;</td>
        </tr>
        <tr>
          <td height="20">Monto actualizaci&oacute;n: </td>
          <td>$ <?=$familia_montoact; ?>&nbsp;</td>
        </tr>
        <tr>
          <td height="20">Pagado a la fecha:</td>
          <td>$ <?=$familia_montoadj_pago; ?></td>
        </tr>
        <tr>
          <td height="20" bgcolor="#DFDFDF">Saldo a la fecha:</td>
          <td bgcolor="#DFDFDF">$ <? echo $saldo; ?></td>
        </tr>
        <tr>
          <td height="20">Monto cancelaci&oacute;n: </td>
          <td>$ <?=$familia_cancelacion_monto; ?>&nbsp; </td>
        </tr>
        <tr>
          <td height="20">Fecha cancelaci&oacute;n: </td>
          <td><?=$familia_cancelacion_fecha; ?></td>
        </tr>
      </table><? } ?>
		  </td>
        </tr>
      </table>
	  <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="22%"><strong>Alta del beneficio:</strong></td>
          <td width="32%"><strong><?=$familia["Nombre"] ?> (<?=$altabenef; ?>)</strong>&nbsp;</td>
          <td width="16%">Ultima modif.: </td>
          <td width="30%"><? echo $usrModif["Nombre"]; ?> (<?=$modifbenef; ?>)&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" align="right" bgcolor="#FFFFFF">
		  <? if (($idNivel < '4') or ($idNivel < '7' and $familia_matricula == '0' and $idDireccion == $familia["Familia_beneficio_origen"])) { ?>		  		  
		  <a href="familia_modif_form.php?idFamilia=<?=$_GET["idFamilia"]; ?>&origen=<?=basename($_SERVER['PHP_SELF']); ?>"><img src="imagen/ico_edit.gif" alt="Editar" border="0" title="Editar"/></a><? } ?></td>
        </tr>
    </table>
    </td>
  </tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
<? while ($b1 = mysql_fetch_array($sql2)) { 
$b1_numero = $b1["Persona_nro"];
$b1_familia = $b1["Familia_nro"];
$b1_apellido = $b1["Persona_apellido"];
$b1_nombre = $b1["Persona_nombre"];
$b1_nombre_completo = $b1["Persona_nombre_completo"];
$b1_doc_tipo = $b1["Documento_tipo_nombre"];
$b1_doc_nro = $b1["Persona_dni_nro"];
//$b1_doc_c1 = substr("$b1_doc_nro",-8,-6);
//$b1_doc_c2 = substr("$b1_doc_nro",-6,-3);
//$b1_doc_c3 = substr("$b1_doc_nro",-3);
//$b1_doc_nro_dot = "$b1_doc_c1.$b1_doc_c2.$b1_doc_c3";
//$b1_doc_nro_dot = $b1_doc_nro;
//
$b1_ecivil = $b1["Estado_civil_nombre"];
$b1_nacionalidad = $b1["Persona_nacionalidad"];
$b1_domicilio = $b1["Persona_domicilio"];

$b1_conyuge_apellido = $b1["Persona_conyuge_apellido"];
$b1_conyuge_nombre = $b1["Persona_conyuge_nombre"];

$b1_padre_apellido = $b1["Persona_padre_apellido"];
$b1_padre_nombre = $b1["Persona_padre_nombre"];
$bi_padre_docnum = $b1["Persona_padre_doc"];
$b1_madre_apellido = $b1["Persona_madre_apellido"];
$b1_madre_nombre = $b1["Persona_madre_nombre"];

$b1_lugar_nac = $b1["Persona_lugar_nac"];
$b1_fecha_nac = $b1["Persona_fecha_nac"];

$b1_baja = $b1["Persona_baja"];
$b1_baja_resolucion = $b1["Persona_baja_resolucion"];
$b1_adj_pendiente = $b1["Adjudicacion_pendiente"];


?>
  <tr>
    <td height="28" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR</strong> </td>
  </tr>
  <tr>
    <td height="13" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" <? if($b1_baja =='1' ) { echo "bgcolor=\"#EAE1E4\""; } if($b1_adj_pendiente =='1' ) { echo "bgcolor=\"#D0DCFB\""; }?> ><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="4" align="center"><? if($b1_baja =='1' ) { echo "<h1>Titular dado de baja (Res. ".$b1_baja_resolucion.")</H1>"; } ?>&nbsp;</td>
        </tr>
          <tr>
            <td width="15%">Tipo y N&ordm; Doc.: </td>
            <td width="28%"><strong><?=$b1_doc_tipo." ".$b1_doc_nro; ?></strong></td>
            <td width="20%">Apellido y nombres: </td>
            <td width="37%"><strong><?=$b1_apellido.", ".$b1_nombre; ?></strong></td>
          </tr>

        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td colspan="6">&nbsp;</td>
          </tr>
          <tr>
            <td width="13%">Fecha nac.: </td>
            <td width="19%"><strong><?=$b1_fecha_nac; ?>&nbsp;</strong></td>
            <td width="15%">Nacionalidad:</td>
            <td width="20%"><strong><?=$b1_nacionalidad; ?>&nbsp;</strong></td>
            <td width="14%">Estado Civil: </td>
            <td width="19%"><strong><?=$b1_ecivil; ?>&nbsp;</strong></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="30%">Nombre y apellido del c&oacute;nyuge: </td>
            <td width="70%"><strong><?=$b1_conyuge_nombre." ".$b1_conyuge_apellido; ?>&nbsp;</strong></td>
          </tr>
        </table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="29%">Nombre y apellido del padre: </td>
            <td width="71%"><strong><?=$b1_padre_nombre." ".$b1_padre_apellido; ?>&nbsp;</strong></td>
          </tr>
      </table>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td colspan="2" align="right"></td>
          </tr>
          <tr>
            <td width="31%">Nombre y apellido de la madre: </td>
            <td width="69%"><strong><?=$b1_madre_nombre." ".$b1_madre_apellido; ?></strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="right">
			<? if (($idNivel < '4') or ($idNivel < '7' and $familia_matricula == '0' and $idDireccion == $familia["Familia_beneficio_origen"])) { ?>
			<table><tr><td>
			<a href="persona_modif_form.php?idPersona=<?=$b1_numero; ?>&origen=<?=basename($_SERVER['PHP_SELF']); ?>"><img src="imagen/ico_edit.gif" alt="Editar" border="0" title="Editar"/></a></td></tr></table><? } ?></td>
          </tr>
          <tr>
            <td height="8" colspan="2" bgcolor="#FFFFFF"></td>
          </tr>
    </table>    </td>
  </tr>
<? } ?>
<tr>
	<td height="26" align="center" bgcolor="#EDE6CD"><a href="titular_alta_individual_form.php?idFamilia=<?=$persona_familia; ?>">[Agregar otro titular para a este beneficio]</a></td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td align="center"><table width="260" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="16"><a href="beneficio_borrar_conf_02.php?idFamilia=<?=$persona_familia; ?>"><img src="imagen/delete.gif" width="16" height="16" border="0" /></a></td>
      <td width="224">Eliminar este beneficio completo </td>
    </tr>
  </table></td>
</tr>
<tr>
  <td align="center">&nbsp;</td>
</tr>
<tr>
  <td align="center">Direccion usuario: <?=$idDireccion; ?> | Direccion beneficio: <?=$familia["Direccion_nro"]; ?>&nbsp;</td>
</tr>
</table>
<? } ?>
</body>
</html>
<? } ?>