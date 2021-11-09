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

$sql = "SELECT * FROM dbo_familia WHERE Familia_nro = $persona_familia";
$resFlia = mysql_query($sql);
$familia = mysql_fetch_array($resFlia);


$idExpte = $familia["Expte_esc_nro"];

//Expte escrituración

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
$partido_nombre = $barrio["Partido_nombre"];


//Select lote

$lote_nro = $familia["Lote_nro"];

$SQL3 = mysql_query("SELECT * FROM (
dbo_lote
INNER JOIN
dbo_partido
ON dbo_lote.Partido_nro = dbo_partido.Partido_nro) WHERE Lote_nro = $lote_nro",$link);

$cant_lote = mysql_num_rows($SQL3);

$lote = @mysql_fetch_array($SQL3);
$lote_partido = $lote["Partido_nombre"];
$lote_circ = $lote["Lote_circunscripcion"];
$lote_secc = $lote["Lote_seccion"];
$lote_ch = $lote["Lote_chacra"];
$lote_qta = $lote["Lote_quinta"];
$lote_fr = $lote["Lote_fraccion"];
$lote_mz = $lote["Lote_manzana"];
$lote_pc = $lote["Lote_parcela"];
$lote_subpc = $lote["Lote_subparcela"];
$lote_matricula = $lote["Lote_matricula"];
$lote_nro = $lote["Lote_nro"];

//Select beneficiarios 

$sql2 = mysql_query("SELECT * FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
INNER JOIN
dbo_estado_civil
ON dbo_persona.Estado_civil_nro = dbo_estado_civil.Estado_civil_nro)
WHERE Familia_nro = $persona_familia ORDER BY Persona_nro ASC",$link);




?>

<style type="text/css">
<!--
.Estilo2 {font-size: 18px}
-->
</style>
<? if ($count == '0') { echo "No"; }else{ ?>
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Informaci&oacute;n del  beneficio</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top">&nbsp;</td>
	</tr>
	<tr>
	  <td height="15">&nbsp;</td>
  </tr>
</table>
  <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="48%"><span class="Estilo2"><strong>Partido:</strong> <? echo $lote_partido; ?></span></td>
        <td width="52%"><span class="Estilo2"><strong>Barrio:</strong> <? echo $barrio_nombre; ?></span></td>
      </tr>
      <tr>
        <td><?=$count; ?>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="76" height="22" valign="bottom">Circ. <strong><? echo $lote_circ; ?></strong></td>
        <td width="79" valign="bottom">Secc. <strong><? echo $lote_secc; ?></strong></td>
        <td width="66" valign="bottom">Ch. <strong><? echo $lote_ch; ?></strong></td>
        <td width="70" valign="bottom">Qta. <strong><? echo $lote_qta; ?></strong></td>
        <td width="80" valign="bottom">Fracc. <strong><? echo $lote_fr; ?></strong></td>
        <td width="62" valign="bottom">Mz. <strong><? echo $lote_mz; ?></strong></td>
        <td width="58" valign="bottom">Pc. <strong><? echo $lote_pc; ?></strong></td>
        <td width="109" valign="bottom">Subpc. <strong><? echo $lote_subpc; ?></strong></td>
        </tr>
      <tr>
        <td height="28" valign="bottom">Matr&iacute;cula:</td>
        <td height="28" valign="bottom"><strong><?=$lote_matricula; ?></strong></td>
        <td height="28" valign="bottom"></td>
        <td height="28" valign="bottom"></td>
        <td height="28" valign="bottom"></td>
        <td height="28" colspan="3" align="right" valign="bottom"><a href="lote_modif_form.php?idLote=<?=$lote["Lote_nro"]; ?>&origen=<?=basename($_SERVER['PHP_SELF']); ?>"><img src="imagen/ico_edit.gif" alt="Editar" border="0" title="Editar"/></a></td>
        </tr>
      <tr>
        <td height="26" colspan="8" valign="bottom">ID lote: <?=$lote_nro; ?> (cant: <?=$cant_lote; ?>)</td>
      </tr>
      <tr>
        <td height="11" colspan="8" valign="top"></td>
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

?>
  <tr>
    <td height="25" align="center" bgcolor="#E4E4E4"><strong>DATOS DEL TITULAR</strong> </td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
          <tr>
            <td width="15%">Tipo y N&ordm; Doc.: </td>
            <td width="28%"><strong><?=$b1_doc_tipo." ".$b1_doc_nro; ?></strong></td>
            <td width="20%">Apellido y nombres: </td>
            <td width="37%"><strong><?=$b1_apellido.", ".$b1_nombre." (".$b1_nombre_completo.")"; ?></strong></td>
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
            <td align="right"><a href="persona_modif_form.php?idPersona=<?=$b1_numero; ?>&origen=<?=basename($_SERVER['PHP_SELF']); ?>"><img src="imagen/ico_edit.gif" alt="Editar" border="0" title="Editar"/></a>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center">&nbsp;</td>
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
  	<td height="25" align="center" bgcolor="#E4E4E4"><strong>INFORMACION GENERAL DEL BENEFICIO </strong> </td>
</tr>
  <tr>
  	<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" class="nombrecampo">&nbsp;</td>
          </tr>
      </table>
	  <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td width="3%" height="26" bgcolor="#FFFF66">&nbsp;</td>
          <td width="13%" bgcolor="#FFFF66">Escriturado:</td>
          <td width="6%" bgcolor="#FFFF66"><strong><?
		  if ($familia["blnEscritura"] == '1') {echo "<strong>SI</strong>"; }else{ echo "NO"; } ?></strong></td>
          <td width="6%">&nbsp;</td>
          <td width="17%">N&ordm; Expte. escrit.: </td>
          <td width="37%"><strong><?=$expte_caract; ?>-<?=$expte_num; ?>/<?=$expte_anio_res ?> <? if($expte_alcance != '0') {echo "Alc. ".$expte_alcance;}else{ echo " ";} ?> <? if ($expte_cuerpo != '0') {echo "Cpo ".$expte_cuerpo; }else{ echo " "; } ?></strong></td>
          <td width="7%">&nbsp;</td>
          <td width="11%" align="right"><a href="familia_modif_form.php?idFamilia=<?=$_GET["idFamilia"]; ?>&origen=<?=basename($_SERVER['PHP_SELF']); ?>"><img src="imagen/ico_edit.gif" alt="Editar" border="0" title="Editar"/></a>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
	  <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td width="27%">Documentaci&oacute;n completa: </td>
          <td width="25%"><? if($familia["Familia_doc_completa"]=='1') { echo "SI"; }else{ echo "Sin indicar";} ?>&nbsp; </td>
          <td width="22%">Pagos cancelados: </td>
          <td colspan="2"><? if($familia["Familia_pagocancelado"]=='1') { echo "SI"; }else{ echo "Sin indicar";} ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="7%">&nbsp;</td>
          <td width="19%">&nbsp;</td>
        </tr>
        <tr>
          <td><strong>Observaciones:</strong></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="5"><?=$familia["Familia_observaciones"]; ?></td>
        </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>
    </table></td>
</tr>
</table>
<? } ?>
</body>
</html>
<? } ?>