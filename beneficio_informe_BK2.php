<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$cant_tit = 0;

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
//$idDireccion = $user["Direccion_nro"];
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
ON dbo_familia.insert_usuario = dbo_usuarios.idUsuario)
WHERE Familia_nro = $persona_familia";
$resFlia = mysql_query($sql);
$familia = mysql_fetch_array($resFlia);
$familia_nro = $familia["Familia_nro"];
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
$familia_montoadj_cuotas = $familia["Familia_montoadj_cuotas"];
$familia_montoadj_cuota_valor = $familia["Familia_montoadj_cuota_valor"];
$familia_monto_actualizacion = $familia["Familia_monto_actualizacion"];
$familia_monto_actualizacion_fecha = $familia["Familia_monto_actualizacion_fecha"];

if ($familia_montoact != '0') {$saldo = $familia_montoact-$familia_montoadj_pago; }else{$saldo = $familia_montoadj-$familia_montoadj_pago;}

$familia_tarjeta_nro = $familia["Familia_tarjeta_nro"];
$familia_cancelacion_monto = $familia["Familia_cancelacion_monto"];
$familia_cancelacion_fecha = $familia["Familia_cancelacion_fecha"];
$adjudicacion_pendiente = $familia["Adjudicacion_pendiente"];
$familia_ocupacion_verificar = $familia["Familia_ocupacion_verificar"];
$familia_conflicto = $familia["Familia_conflicto"];
$familia_ausente = $familia["Familia_censo_ausente"];
$familia_solic_tarjeta = $familia["Familia_tarjeta_solic"];
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
Barrio_conurbano,
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





$SQLexp = "SELECT * FROM dbo_exptes WHERE Expte_nro = $idExpte AND blnActivo = '1'";
$resExpte = mysql_query($SQLexp);
$expte = mysql_fetch_array($resExpte);

$expte_nro = $expte["Expte_nro"];
$expte_caract = $expte["Expte_caract"];
$expte_num = $expte["Expte_num"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);
$expte_alcance = $expte["Expte_alcance"];
$expte_ubicacion = $expte["Expte_ubicacion_area"];
$expte_mov = $expte["Expte_ubicacion_detalle"];
$expte_salida = $expte["Expte_salida"];
$expte_gescrit_estado = $expte["Expte_gescrit_estado"];


$resArea = mysql_query("SELECT Area_nombre FROM dbo_area WHERE Area_nro = $expte_ubicacion");
$area = mysql_fetch_array($resArea);
$area_nombre = $area["Area_nombre"];


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
<table width="650" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Informaci&oacute;n del  beneficio</h2></td>
  </tr>
	  <? if ($familia_matricula != '0'){ ?><tr>
	    <td bgcolor="#FFFF99" height="36" align="center" style="font-size:18px; font-weight:bold">INMUEBLE ESCRITURADO | Matr&iacute;cula N&ordm; 
        <?=$familia_matricula; ?></td><? } ?>
        <? if ($familia["Expte_esc_condicion"] == '3') {?>
    <tr>
	    <td bgcolor="#FFFF99" height="36" align="center" style="font-size:18px; font-weight:bold; color:#C00;">ESCRITURA ANULADA</td><? } ?>
        
        
	<? if ($adjudicacion_pendiente != '0'){ ?>
    <tr>
	    <td bgcolor="#DCD1FA" height="36" align="center"><span style="font-size:18px; font-weight:bold"> ADJUDICACION PENDIENTE</span></td>
	  </tr><? } ?> 
	  <? if ($familia_ocupacion_verificar != '0'){ ?><tr>
	    <td bgcolor="#F1B4A5" height="36" align="center"><span style="font-size:18px; font-weight:bold"> VERIFICAR OCUPACION</span></td>
	  </tr><? } ?>
      
            
      <? if ($familia_ausente == '1'){ ?><tr>
	    <td bgcolor="#FFC6FF" height="36" align="center"><span style="font-size:18px; font-weight:bold"> AUSENTE EN CENSO</span></td>
	  </tr><? } ?>
      <? if($familia["Familia_tarjeta_solicitar"]=='1'){ ?><tr>
	    <td bgcolor="#008040" height="36" align="center"><span style="font-size:18px; font-weight:bold; color:#FFF"> SOLICITAR TARJETA</span></td>
	  </tr><? } ?>
      
  <? if ($familia_conflicto != '0'){ ?><tr>
	    <td bgcolor="#D14421" height="36" align="center"><span style="color: #FFFFFF; font-size:18px; font-weight:bold"> CONFLICTO</span></td>
	  </tr><? } ?>
	  <? if ($familia["Direccion_nro"] == '3' && $familia["Familia_idmigra"] != '0'){ ?><tr>
	    <td bgcolor="#FFD6C1" height="36" align="center" style="font-size:18px; font-weight:bold">Direcci&oacute;n de Titularizaci&oacute;n de inmuebles | Ley 24.374 </td>
	  </tr><? } ?>
</table>
  <table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
        <td height="36" colspan="2"><span class="Estilo2"><strong>Partido: <? echo $partido_nombre; ?></strong></span></td>
        <td colspan="2"><span class="Estilo2"><strong>Barrio: <? echo $barrio_nombre; ?></strong></span></td>
        </tr>
      <tr>
        <td height="36" colspan="4" align="center" bgcolor="#EFECDC" style="font-size:16px;" >Circ. <strong><? echo $lote_circ; ?></strong> - Secc. <strong><? echo $lote_secc; ?></strong> - Ch. <strong><? echo $lote_ch; ?></strong> - Qta. <strong><? echo $lote_qta; ?></strong> - Fracc. <strong><? echo $lote_fr; ?></strong> - Mz. <strong><? echo $lote_mz; ?></strong> - Pc. <strong><? echo $lote_pc; ?></strong> - Subpc. <strong><? echo $lote_subpc; ?></strong></td>
        </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
      <tr>
        <td width="20%" height="26">Resoluci&oacute;n  adjud.:</td>
        <td width="31%"><strong><?=$familia["Familia_res_adj"]; ?></strong></td>
        <td width="4%">&nbsp;</td>
        <td width="45%" rowspan="10" valign="bottom">
        <? if ($idExpte!='0') { ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="4">
            <tr>
              <td height="4" colspan="3"></td>
              </tr>
            <tr>
              <td colspan="3" bgcolor="#FFFFBB" height="8"></td>
              </tr>
            <tr>
              <td bgcolor="#FFFFBB">&nbsp;</td>
              <td colspan="2" bgcolor="#FFFFBB"><strong>Expediente de escrituraci&oacute;n</strong></td>
            </tr>
            <tr>
              <td width="4%" bgcolor="#FFFFBB">&nbsp;</td>
              <td width="38%" bgcolor="#FFFFBB">Expte. Nro.:</td>
              <td width="58%" bgcolor="#FFFFBB"><strong>
                <?=$expte_caract; ?>
                -
                <?=$expte_num; ?>
                /
                <?=$expte_anio_res ?>
                <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?>
              </strong></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFBB">&nbsp;</td>
              <td valign="top" bgcolor="#FFFFBB">Ubicaci&oacute;n:</td>
              <td bgcolor="#FFFFBB"><? echo $area_nombre; ?>&nbsp;</td>
        	</tr>
                
			
			<? if($expte_ubicacion == '83') { ?>	
			<tr>
              <td bgcolor="#FFFFBB">&nbsp;</td>
              <td bgcolor="#FFFFBB">Estado:</td>
              <td bgcolor="#FFFFBB"><? if ($expte_gescrit_estado == '1') {
				echo "Esperando revisi&oacute;n"; }
				elseif
				($expte_gescrit_estado == '2') {
				echo "Esperando documentaci&oacute;n"; }
				elseif
				($expte_gescrit_estado == '3') {
				echo "Esperando firma"; }
				elseif
				($expte_gescrit_estado == '4') {
				echo "Archivado en el &aacute;rea"; }
				else{
				echo "Sin indicar"; }
					?>
                   </td>
            </tr>
            <? } else{
							
			 if($expte_salida != "0000-00-00") { ?>
            <tr>
              <td bgcolor="#FFFFBB">&nbsp;</td>
              <td bgcolor="#FFFFBB">Salida a EGG:</td>
              <td bgcolor="#FFFFBB"><? echo cambiaf_a_normal($expte_salida); ?>&nbsp;</td>
            </tr>
            <tr>
              <td bgcolor="#FFFFBB">&nbsp;</td>
              <td bgcolor="#FFFFBB">Detalle:</td>
              <td bgcolor="#FFFFBB"><?=$expte_mov; ?></td>
            </tr>
            <tr>
            <? }} ?>
            
              <td bgcolor="#FFFFBB" height="30"></td>
              <td colspan="2" align="center" valign="top" bgcolor="#FFFFBB"><a href="expte-informe.php?idExpte=<? echo $expte_nro; ?>&amp;noback=0">[Ver detalles en sistema de expedientes]</a></td>
            </tr>
          </table>
          <? } ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2" align="center" height="10"></td>
          </tr>
          <tr>
            <td height="32" colspan="2" align="center" bgcolor="#EAF1F7">Valor lote (adjudicaci&oacute;n/actualizaci&oacute;n)</td>
            </tr>
          <tr>
            <td width="50%" height="26">Monto adjudicaci&oacute;n:</td>
            <td width="50%"><strong>$
              <?=$familia_montoadj; ?>
              &nbsp;</strong></td>
            </tr>
          <tr>
            <td height="26">Cantidad de cuotas:</td>
            <td><strong>
              <?=$familia_montoadj_cuotas; ?>
              &nbsp;</strong></td>
            </tr>
          <tr>
            <td height="26">Valor cuota individual:</td>
            <td><strong>$
              <?=$familia_montoadj_cuota_valor; ?>
              </strong></td>
            </tr>
          <tr>
            <td height="26">Monto actualizaci&oacute;n:</td>
            <td>$
              <?=$familia_monto_actualizacion; ?> <? if($familia_monto_actualizacion_fecha != '0000-00-00') { echo "(".cambiaf_a_normal($familia_monto_actualizacion_fecha).")"; } ?>
              &nbsp;</td>
            </tr>
          <tr>
          <tr>
            <td height="32" colspan="2" align="center" ><?
$sql4 = "SELECT * FROM dbo_tarjeta WHERE Familia_nro = $familia_nro AND blnActivo = '1'";
$res4 = mysql_query($sql4);

if (mysql_num_rows($res4) != '0') {

		  $tarjeta = mysql_fetch_array($res4); ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td width="100%" height="22">          
                  <table width="100%" cellpadding="3" cellspacing="0">
                    <tr>
                      <td colspan="2" align="right" valign="bottom">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="8" colspan="2" align="right" valign="bottom" bgcolor="#C9E3B0"></td>
                    </tr>
                    <tr>
                      <td width="63" height="22" align="right" valign="top" bgcolor="#C9E3B0"><strong>Tarjeta: </strong></td>
                      <td width="149" valign="top" bgcolor="#C9E3B0"><?=$tarjeta["Tarjeta_numero"]; ?></td>
                    </tr>
                    <? if($user["p732"]=='1') { ?>
                    <tr>
                      <td height="18" colspan="2" align="center" valign="top" bgcolor="#C9E3B0"><a href="tarjeta_pedido_reiteracion.php?idTarjeta=<?=$tarjeta["Tarjeta_nro"]; ?>&idFamilia=<? echo $familia_nro; ?>">[Reiterar solicitud de tarjeta]</a></td>
                    </tr><? } ?>                
                   <? if($user["p734"]=='1') { ?>                    
                    <tr>
                      <td height="18" colspan="2" align="center" valign="top" bgcolor="#C9E3B0"><a href="tarjeta-desasociar-confirm.php?idTarjeta=<?=$tarjeta["Tarjeta_nro"]; ?>&amp;idFamilia=<? echo $familia_nro; ?>">[Desasociar tarjeta]</a></td>
                    </tr>
                    <? } ?>
                    <tr>
                      <td height="18" colspan="2" align="center" valign="top" bgcolor="#C9E3B0">
                <a href="tarjeta-pagos-historial.php?idTarjeta=<? echo $tarjeta["Tarjeta_nro"]; ?>&idFamilia=<?=$familia_nro; ?>">[Ver historial de pagos]</a></td>        
                    </tr>
                    <tr>
                      <td height="18" colspan="2" align="center" valign="top" bgcolor="#C9E3B0"><a href="detalle-contable-individual.php?idTarjeta=<? echo $tarjeta["Tarjeta_nro"]; ?>&idFamilia=<?=$familia_nro; ?>">[Imprimir detalle contable]</a></td>
                    </tr>
                    <tr>
                      <td height="6" colspan="2" align="center" valign="top" bgcolor="#C9E3B0"></td>
                    </tr>	
                    
                </table></td>
              </tr>
              <tr>
                <td height="36" align="right">&nbsp;</td>
              </tr>
            </table>

<? }else{
	
//Si no hay tarjeta compruebo si es conurbano. Si es conurbano, muestro alerta de no tarjeta

	if($barrio["Barrio_conurbano"] == '1' && $cant_tit < '1') { ?>
	
	<table width="100%" cellpadding="4" cellspacing="0">
		    <tr>
		      <td colspan="3">&nbsp;</td>
		      </tr>
		    <tr>
		    <td height="30" colspan="3" align="center" valign="bottom" bgcolor="#C9E3B0"><strong>El titular no tiene  tarjeta asociada</strong></td></tr>
		     <? if($user["p735"]=='1') { ?>
            <tr>
		      <td height="20" colspan="3" align="center" valign="top" bgcolor="#C9E3B0"><a href="tarjeta-asignar-form.php?idFamilia=<? echo $familia_nro; ?>">[Asociar una tarjeta existente]</a></td>
		      </tr>
            <tr>
              <td width="8%" align="center" bgcolor="#C9E3B0">&nbsp;</td>
              <td width="85%" align="center" bgcolor="#C9E3B0">Atenci&oacute;n: Utilice esta opci&oacute;n &uacute;nicamente cuando el titular ya cuenta con una tarjeta y &eacute;sta no ha sido consignada en el sistema. Si el cliente nunca ha recibido una tarjeta utilice el procedimiento habitual.</td>
              <td width="7%" align="center" bgcolor="#C9E3B0">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" align="center" bgcolor="#C9E3B0" height="5"></td>
            </tr>
            <tr>
              <td colspan="3" align="center" bgcolor="#C9E3B0" height="5"></td>
            </tr>
              <? } ?>
		  </table>
<?	}} ?></td>
            </tr>
            <td height="10" colspan="2" align="right"><? if ($user["p703"] == '1') { ?>
			<table border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td style="color:#5C768B">&nbsp;</td>
			    <td>&nbsp;</td>
			    </tr>
			  <tr>
			    <td style="color:#5C768B">Modificar datos del beneficio</td><td>
			    <a href="familia_modif_form.php?idFamilia=<?=$_GET["idFamilia"]; ?>&origen=<?=basename($_SERVER['PHP_SELF']); ?>"><img src="imagen/ico_edit.gif" alt="Editar" border="0" title="Editar"/></a></td>
                </tr></table><? } ?>&nbsp;</td>
            </tr>
        </table></td>
        </tr>
      <tr>
        <td height="26">Expte. Regulariz.:</td>
        <td height="26"><?=$exptereg_caract; ?>-<?=$exptereg_num; ?>/<?=$exptereg_anio_res ?> <? if($exptereg_alcance != '0') {echo "Alc. ".$exptereg_alcance;}else{ echo " ";} ?> <? if ($exptereg_cuerpo != '0') {echo "Cpo ".$exptereg_cuerpo; }else{ echo " "; } ?>&nbsp;&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="26">Plano n&uacute;mero:</td>
        <td height="26"><strong><?=$familia["Plano_num"]; ?></strong>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="26">Plano  aprobado:</td>
        <td height="26">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="26">Fecha boleto CV:</td>
        <td><? if($boleto_fecha == '0'){ echo "S/D"; }else{ echo $boleto_fecha; } ?>
          &nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="26">Alta del beneficio :</td>
        <td><strong><?=$familia["Nombre"] ?> </strong>(<?=$altabenef; ?>)&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="26">Ultima modificaci&oacute;n:</td>
        <td><strong><? echo $usrModif["Nombre"]; ?></strong> (<?=$modifbenef; ?>)&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td colspan="2" rowspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td>&nbsp;</td>
            <td valign="bottom">&nbsp;</td>
          </tr>
          <tr>
            <td width="4%" height="30" bgcolor="#E1E1E1">&nbsp;</td>
            <td width="96%" valign="bottom" bgcolor="#E1E1E1"><strong>Observaciones (gesti&oacute;n de adjudicaci&oacute;n):</strong></td>
            </tr>
          <tr>
            <td valign="top" bgcolor="#E1E1E1">&nbsp;</td>
            <td height="70" valign="top" bgcolor="#E1E1E1"><?=$familia["Familia_observaciones"]; ?>
              &nbsp;<br /></td>
            </tr>
          <tr>
            <td colspan="2" valign="top" bgcolor="#E1E1E1">&nbsp;</td>
            </tr>
           <tr>
            	<td colspan="2">&nbsp;</td>
            </tr>
           <tr>
            <td width="4%" height="30" bgcolor="#E1E1E1">&nbsp;</td>
            <td width="96%" valign="bottom" bgcolor="#E1E1E1"><strong>Observaciones (gesti&oacute;n de escrituraci&oacute;n):</strong></td>
            </tr>
          <tr>
            <td valign="top" bgcolor="#E1E1E1">&nbsp;</td>
            <td height="70" valign="top" bgcolor="#E1E1E1"><?=$familia["Familia_observaciones_esc"]; ?>
              &nbsp;<br /></td>
            </tr>
          <tr>
            <td colspan="2" valign="top" bgcolor="#E1E1E1">&nbsp;</td>
            </tr>
        </table></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td valign="bottom">&nbsp;</td>
        </tr>
    </table>
    </td>
  </tr>
</table>
<table width="650" border="0" cellspacing="0" cellpadding="0">
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
$b1_telefono = $b1["Persona_telefono"];
$b1_email = $b1["Persona_email"];

$b1_conyuge_apellido = $b1["Persona_conyuge_apellido"];
$b1_conyuge_nombre = $b1["Persona_conyuge_nombre"];

//$b1_padre_apellido = $b1["Persona_padre_apellido"];
//$b1_padre_nombre = $b1["Persona_padre_nombre"];
$b1_padre_nombrecompleto = $b1["Persona_padre_nombrecompleto"];


//$b1_madre_apellido = $b1["Persona_madre_apellido"];
//$b1_madre_nombre = $b1["Persona_madre_nombre"];

$b1_madre_nombrecompleto = $b1["Persona_madre_nombrecompleto"];

$b1_lugar_nac = $b1["Persona_lugar_nac"];
$b1_fecha_nac = $b1["Persona_fecha_nac"];

$b1_baja = $b1["Persona_baja"];
$b1_baja_resolucion = $b1["Persona_baja_resolucion"];
$b1_adj_pendiente = $b1["Adjudicacion_pendiente"];


?>
  <tr>
    <td height="28" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="310" height="28" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR</strong> </td>
  </tr>
  <tr>
    <td valign="top" <? if($b1_baja =='1' ) { echo "bgcolor=\"#EAE1E4\""; } if($b1_adj_pendiente =='1' ) { echo "bgcolor=\"#D0DCFB\""; }?> ><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="3">&nbsp;</td>
          <td width="39%" rowspan="12" valign="bottom">
            
            <? if ($user["p713"] == '1') { ?>
            <table width="250"><tr><td>
              <a href="persona_modif_form.php?idPersona=<?=$b1_numero; ?>&origen=<?=basename($_SERVER['PHP_SELF']); ?>"><img src="imagen/ico_edit.gif" alt="Editar" border="0" title="Editar"/></a></td>
              <td style="color:#5C768B">Modificar datos de esta persona</td></tr></table><? } ?>
            <? if ($user["p714"] == '1') { ?>
            <table width="250"><tr>
              <td><a href="persona_borrar_confirm.php?idPersona=<?=$b1_numero; ?>&idFamilia=<?=$persona_familia; ?>"><img src="imagen/delete.gif" width="16" height="16" border="0" /></a></td>
            <td style="color:#5C768B">Eliminar este beneficiario</td></tr></table><? } ?>    
          &nbsp;</td>
        </tr>
        <tr>
          <td width="19%" height="28">Tipo y Nro. Doc:</td>
          <td width="39%"><strong><?=$b1_doc_tipo; ?> <?=$b1_doc_nro; ?></strong>&nbsp;</td>
          <td width="3%" rowspan="11">&nbsp;</td>
        </tr>
        <tr>
          <td height="28">Nombre completo:</td>
          <td><strong><?=$b1_apellido.", ".$b1_nombre; ?></strong>&nbsp;</td>
        </tr>
        <tr>
          <td height="28">Fecha de Nacim.:</td>
          <td><strong><?=$b1_fecha_nac; ?></strong>&nbsp;</td>
        </tr>
        <tr>
          <td height="28">Nacionalidad:</td>
          <td><strong><?=$b1_nacionalidad; ?></strong>&nbsp;</td>
        </tr>
        <tr>
          <td height="28">Estado Civil:</td>
          <td><strong><?=$b1_ecivil; ?> <? if ($b1["Ecivil_sep_hecho"] == '1') { echo "(Sep. Hecho)"; }?></strong>&nbsp;</td>
        </tr>
        <tr>
          <td height="26">Nro. Tel&eacute;fono:</td>
          <td><strong><?=$b1_telefono; ?></strong>&nbsp;</td>
        </tr>
        <tr>
          <td height="26">E-mail:</td>
          <td><?=$b1_email; ?></td>
        </tr>
        <tr>
          <td height="26">Datos c&oacute;nyuge:</td>
          <td><strong><?=$b1_conyuge_nombre." ".$b1_conyuge_apellido; ?></strong>&nbsp;</td>
        </tr>
        <tr>
          <td height="28">Datos del padre:</td>
          <td><strong><?=$b1_padre_nombrecompleto; ?></strong>&nbsp;</td>
        </tr>
        <tr>
          <td height="28">Datos de la madre:</td>
          <td><strong><?=$b1_madre_nombrecompleto ; ?></strong></td>
        </tr>
        <tr>
          <td colspan="2" valign="bottom">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
<? $cant_tit++; } ?>
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