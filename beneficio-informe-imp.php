<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema de Expedientes</title>
<style type="text/css">
<!--
body {
	margin-left: 70px;
	margin-top: 20px;
}
</style>

<link href="estilos-impresion.css" rel="stylesheet" type="text/css" />
</head>

<body onLoad="window.print()">
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="75" align="right" valign="top"><img src="imagen/logo-ba3.jpg" alt="Buenos Aires" width="800" height="70" /></td>
  </tr>
</table>
<?
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
$familia_montoadj_cuotas = $familia["Familia_montoadj_cuotas"];

if ($familia_montoact != '0') {$saldo = $familia_montoact-$familia_montoadj_pago; }else{$saldo = $familia_montoadj-$familia_montoadj_pago;}

$familia_tarjeta_nro = $familia["Familia_tarjeta_nro"];
$familia_cancelacion_monto = $familia["Familia_cancelacion_monto"];
$familia_cancelacion_fecha = $familia["Familia_cancelacion_fecha"];
$adjudicacion_pendiente = $familia["Adjudicacion_pendiente"];
$familia_ocupacion_verificar = $familia["Familia_ocupacion_verificar"];

$familia_telefono = $familia["Familia_telefono"];
$familia_domicilio = $familia["Familia_domic"];


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
<table width="800" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30" align="center"><h2>Informaci&oacute;n del  beneficio</h2></td>
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
</table>
  <table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="55%" height="40"><strong>Partido: <? echo $partido_nombre; ?></strong></td>
		<td>&nbsp;</td>
        </tr>

      <tr>
        <td height="36" colspan="2" align="center">Circ. <strong><? echo $lote_circ; ?></strong> - Secc. <strong><? echo $lote_secc; ?></strong> - Ch. <strong><? echo $lote_ch; ?></strong> - Qta. <strong><? echo $lote_qta; ?></strong> - Fracc. <strong><? echo $lote_fr; ?></strong> - Mz. <strong><? echo $lote_mz; ?></strong> - Pc. <strong><? echo $lote_pc; ?></strong> - Subpc. <strong><? echo $lote_subpc; ?></strong></td>
      </tr>
      <tr>
        <td height="42" align="left">Direcci&oacute;n: <?=$familia_domicilio; ?></td>
        <td width="45%" height="36" align="left">Telefono: <?=$familia_telefono; ?>&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="800" border="0" cellspacing="0" cellpadding="0">
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
    <td height="28" align="center" bgcolor="#E4E4E4"><strong><u>DATOS DEL TITULAR</u></strong> </td>
  </tr>
  <tr>
    <td height="13" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" <? if($b1_baja =='1' ) { echo "bgcolor=\"#EAE1E4\""; } if($b1_adj_pendiente =='1' ) { echo "bgcolor=\"#D0DCFB\""; }?> ><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2" align="center"><? if($b1_baja =='1' ) { echo "<h1>Titular dado de baja (Res. ".$b1_baja_resolucion.")</H1>"; } ?>&nbsp;</td>
        </tr>
          <tr>
            <td width="23%" height="30">Apellido y nombres: </td>
            <td width="77%"><strong><?=$b1_apellido.", ".$b1_nombre; ?></strong></td>
          </tr>
          <tr>
            <td height="30">Tipo y N&ordm; Doc.:</td>
            <td><strong><?=$b1_doc_tipo." ".$b1_doc_nro; ?></strong>&nbsp;</td>
          </tr>

        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="14%">Fecha nac.: </td>
            <td width="18%"><strong><?=$b1_fecha_nac; ?>&nbsp;</strong></td>
            <td width="15%">Nacionalidad:</td>
            <td width="20%"><strong><?=$b1_nacionalidad; ?>&nbsp;</strong></td>
            <td width="14%">Estado Civil: </td>
            <td width="19%"><strong><?=$b1_ecivil; ?>&nbsp;</strong></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="35%" height="32">Nombre y apellido del c&oacute;nyuge: </td>
            <td width="65%"><strong><?=$b1_conyuge_nombre." ".$b1_conyuge_apellido; ?>&nbsp;</strong></td>
          </tr>
        </table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="35%" height="32">Nombre y apellido del padre: </td>
            <td width="65%"><strong><?=$b1_padre_nombre." ".$b1_padre_apellido; ?>&nbsp;</strong></td>
          </tr>
      </table>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td colspan="2" align="right"></td>
          </tr>
          <tr>
            <td width="35%" height="32">Nombre y apellido de la madre: </td>
            <td width="65%"><strong><?=$b1_madre_nombre." ".$b1_madre_apellido; ?></strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="right">&nbsp;</td>
          </tr>
    </table>    </td>
  </tr>
<? } ?>
<tr><td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="190">&nbsp;</td>
                </tr>
              </table>
</td></tr>
</table>
<? } 

include("pie.php");

?>
