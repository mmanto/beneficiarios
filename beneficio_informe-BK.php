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




$idBarrio = $familia["Barrio_nro"];

$sqlb = "SELECT
Barrio_nro,
Barrio_nombre,
Partido_nombre
FROM (
dbo_barrio
INNER JOIN
dbo_partido
ON dbo_barrio.Partido_nro = dbo_Partido.Partido_nro
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
<table width="600" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="30"><h2>Dar de alta nuevo beneficio</h2></td>
  </tr>
	<tr>
	  <td height="18" valign="top"><a href="persona_buscar_doc2.php">Buscar otro beneficio</a> | <a href="menu.php">Volver al menu </a></td>
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
        <td height="28" colspan="3" align="right" valign="bottom"><a href="lote_modif_form.php?idLote=<?=$lote["Lote_nro"]; ?>&origen=<?=basename($_SERVER['PHP_SELF']); ?>">Editar </a></td>
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
$b1_doc_nro_dot = $b1_doc_nro;
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
            <td width="28%"><strong><?=$b1_doc_tipo." ".$b1_doc_nro_dot; ?></strong></td>
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
            <td width="19%">&nbsp;</td>
            <td width="15%">Nacionalidad:</td>
            <td width="20%">&nbsp;</td>
            <td width="14%">Estado Civil: </td>
            <td width="19%">&nbsp;</td>
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
            <td align="right"><a href="#">Editar </a>&nbsp;</td>
          </tr>
          <tr>
            <td height="10" colspan="2"></td>
          </tr>
        </table>
    </td>
  </tr>
<? } ?>
<tr>
  	<td height="25" align="center" bgcolor="#E4E4E4"><strong>INFORMACION GENERAL DEL BENEFICIO </strong> </td>
</tr>
  <tr>
  	<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="3" class="nombrecampo">&nbsp;</td>
          </tr>
          <tr>
            <td width="53%" class="nombrecampo">Domicilio</td>
            <td width="24%" class="nombrecampo">Tel&eacute;fono</td>
            <td width="23%" class="nombrecampo">Resoluci&oacute;n   N&ordm; </td>
          </tr>
          <tr>
            <td><strong><? echo $familia["Familia_domic"]; ?></strong></td>
            <td><strong><? echo $familia["Familia_telefono"]; ?></strong></td>
            <td><strong><? echo $familia["Familia_resolucion"]; ?></strong></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
      </table>
	  <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td width="16%">Boleto/Certif.:</td>
          <td width="8%">&nbsp;</td>
          <td width="20%">Acta Ley 24.374:</td>
          <td width="8%">&nbsp;</td>
          <td width="28%">En tr&aacute;mite escrituraci&oacute;n.:</td>
          <td width="8%">&nbsp;</td>
          <td width="12%">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Escriturado:</td>
          <td>&nbsp;</td>
          <td>N&ordm; Expte. escrit.: </td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
	  <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td width="27%">Documentaci&oacute;n completa </td>
          <td width="12%">&nbsp;</td>
          <td width="20%">Pagos cancelados </td>
          <td width="9%">&nbsp;</td>
          <td width="32%">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Observaciones:</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>
    </table></td>
</tr>
</table>
</body>
</html>
<? } ?>