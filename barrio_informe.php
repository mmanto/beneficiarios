<?
include("cabecera.php");
include ("conec.php");

$log_direccion = $_POST["log_direccion"];
$log_usuario = $_POST["log_usuario"];
$log_nivel = $_POST["log_nivel"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";
$dni_busqueda = $_POST["dni_busqueda"];

if (!$dni_busqueda) {echo "<h2>Por favor, ingrese un numero de documento</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{

//Datos del titular 1
$SQL1 = mysql_query("SELECT * FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
INNER JOIN
dbo_estado_civil
ON dbo_persona.Estado_civil_nro = dbo_estado_civil.Estado_civil_nro)
WHERE Persona_dni_nro = $dni_busqueda",$link);
$b1 = mysql_fetch_array($SQL1);

$cant = mysql_num_rows($SQL1);

if ($cant == 0) { echo "<h2>No hay registros que concuerden con su b&uacute;squeda (".$dni_busqueda.")</h2>
<p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";} else {

$b1_numero = $b1["Persona_nro"];
$b1_familia = $b1["Familia_nro"];
$b1_apellido = $b1["Persona_apellido"];
$b1_nombre = $b1["Persona_nombre"];
$b1_doc_tipo = $b1["Documento_tipo_nombre"];
$b1_doc_nro = $b1["Persona_dni_nro"];
$b1_doc_c1 = substr("$b1_doc_nro",-8,-6);
$b1_doc_c2 = substr("$b1_doc_nro",-6,-3);
$b1_doc_c3 = substr("$b1_doc_nro",-3);
$b1_doc_nro_dot = "$b1_doc_c1.$b1_doc_c2.$b1_doc_c3";
$b1_ecivil = $b1["Estado_civil_nombre"];

$b1_nacionalidad = $b1["Persona_nacionalidad"];
$b1_domicilio = $b1["Persona_domicilio"];
$b1_padre_apellido = $b1["Persona_padre_apellido"];
$b1_padre_nombre = $b1["Persona_padre_nombre"];
$bi_padre_docnum = $b1["Persona_padre_doc"];
$b1_madre_apellido = $b1["Persona_madre_apellido"];
$b1_madre_nombre = $b1["Persona_madre_nombre"];

//Datos de la familia

$SQL2 = mysql_query("SELECT * FROM (
dbo_familia
INNER JOIN
dbo_direccion
ON dbo_familia.Direccion_nro = dbo_direccion.Direccion_nro)
WHERE Familia_nro = $b1_familia",$link);
$familia = mysql_fetch_array($SQL2);

$direccion = $familia["Direccion_nombre"];
$lote_nro = $familia["Lote_nro"];


//Datos del lote

$SQL3 = mysql_query("SELECT * FROM (
dbo_lote
INNER JOIN
dbo_partido
ON dbo_lote.Partido_nro = dbo_partido.Partido_nro)
WHERE Lote_nro = $lote_nro",$link);

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
$lote_partida = $lote["Lote_partida"];



?>

<table width="576" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Informe de beneficiario de tierras </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="25" colspan="2" valign="bottom"><a href="javascript:history.go(-1)">Volver al panel de administración</a></td>
  </tr>
  <tr>
    <td height="16" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2" bgcolor="#F0F0F0"><h3><strong class="titulodato">INFORMACION DEL BENEFICIARIO </strong></h3></td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="right">
	
	
	<table width="98%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="68%" height="23">Apellido y nombres: <strong><?=$b1_apellido.", ".$b1_nombre; ?></strong></td>
        <td width="32%">&nbsp;</td>
      </tr>
      <tr>
        <td height="23">Tipo y N&ordm; documento: <strong><?=$b1_doc_tipo." ".$b1_doc_nro_dot; ?></strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="23">Fecha de nacimiento: </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="23">Nacionalidad: <strong><?=$b1_nacionalidad; ?></strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="23">Domicilio: <strong><?=$b1_domicilio; ?></strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="23">Estado civil: <strong><?=$b1_ecivil; ?></strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="23">Apellido y nombres del c&oacute;nyuge: </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="23">Apellido y nombres del padre: <strong><?=$b1_padre_apellido.", ".$b1_padre_nombre; ?></strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="23">Documento del padre: <strong><?=$bi_padre_docnum; ?></strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="23">Apellido y nombres de la madre: <strong><?=$b1_madre_apellido.", ".$b1_madre_nombre; ?></strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="23">Documento de la madre: </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="23"><a href="persona_modif_form.php?Persona_nro=<?=$b1_numero."&".$linkvar; ?>">Modificar informaci&oacute;n del beneficiario </a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="23">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	<? //////////////////////// ?>	</td>
  </tr>
  <tr>
    <td height="25" colspan="2" bgcolor="#F0F0F0"><h3><strong>INFORMACION DEL INMUEBLE ASOCIADO </strong></h3></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td align="right"><table width="98%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="54%">&nbsp;</td>
        <td width="46%">&nbsp;</td>
      </tr>

      <tr>
        <td height="23">Partido: <strong><?=$lote_partido; ?></strong></td>
        <td>Localidad:</td>
      </tr>
      <tr>
        <td height="23">Circunscripci&oacute;n: <strong><?=$lote_circ; ?></strong></td>
        <td>Barrio:</td>
      </tr>
      <tr>
        <td height="23">Seccion: <strong><?=$lote_secc; ?></strong></td>
        <td>Domicilio:</td>
      </tr>
      <tr>
        <td height="23">Chacra: <strong><?=$lote_ch; ?></strong></td>
        <td>Edificio:</td>
      </tr>
      <tr>
        <td height="23">Quinta: <strong><?=$lote_qta; ?></strong></td>
        <td>Sector:</td>
      </tr>
      <tr>
        <td height="23">Fracci&oacute;n: <strong><?=$lote_fr; ?></strong></td>
        <td>Piso:</td>
      </tr>
      <tr>
        <td height="23">Manzana: <strong><?=$lote_mz; ?></strong></td>
        <td>Depto:</td>
      </tr>
      <tr>
        <td height="23">Parcela: <strong><?=$lote_pc; ?></strong></td>
        <td>Casa N&ordm;: </td>
      </tr>
      <tr>
        <td height="23">Subparcela: <strong><?=$lote_subpc; ?></strong></td>
        <td>Tel&eacute;fono:</td>
      </tr>
      <tr>
        <td height="23">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="25" colspan="2" bgcolor="#F0F0F0"><h3>INFORMACION DEL BENEFICIO </h3></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td align="right"><table width="98%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong><?=$direccion ?></strong></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?
}  
}     
include "pie.php";
?>