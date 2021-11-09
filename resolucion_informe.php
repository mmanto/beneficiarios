<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

mysql_select_db("MyTierras",$link);



$log_direccion = $_POST["log_direccion"];
$log_usuario = $_POST["log_usuario"];
$log_nivel = $_POST["log_nivel"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";

/////////////////////////////////////////////////////

$resolucion_busqueda = $_POST["resolucion_busqueda"];

/////////////////////////////////////////////////////
  
if (!$resolucion_busqueda) {echo "<h2>Por favor, ingrese un n&uacute;mero de resoluci&oacute;n</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{

$sql = "SELECT Familia_nro, Lote_nro FROM dbo_familia where Familia_resolucion = '$resolucion_busqueda'";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);

if ($cant < 1) {echo "<h2>No hay resultados que coincidan con su b&uacute;squeda</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{
?>

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Informe de beneficiario de tierras </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="menu.php?<?=$linkvar ?>">Volver al panel de administración</a></td>
  </tr>
  <tr>
    <td height="25" colspan="2" valign="bottom"><a href="javascript:history.go(-1)">Realizar otra b&uacute;squeda </a></td>
  </tr>
  <tr>
    <td height="16" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2" bgcolor="#F0F0F0"><h3><strong class="titulodato">RESOLUCION N&ordm; <?=$resolucion_busqueda ?></strong></h3></td>
  </tr>
  <tr>
    <td width="13">&nbsp;</td>
    <td width="563" align="right">&nbsp;</td>
  </tr>
  <tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td><table width="715" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td height="28" colspan="8" class="titulo_dato">Nomenclatura del inmueble </td>
        <td width="363" class="titulo_dato">Beneficiarios</td>
        </tr>
      <tr>
        <td width="95" height="25" class="titulo_dato">Partido</td>
        <td width="32" class="titulo_dato">Circ.</td>
        <td width="38" class="titulo_dato">Secc.</td>
        <td width="30" class="titulo_dato">Ch.</td>
        <td width="33" class="titulo_dato">Qta.</td>
        <td width="43" class="titulo_dato">Fracc.</td>
        <td width="30" class="titulo_dato">Mz.</td>
        <td width="31" class="titulo_dato">Pc.</td>
        <td class="titulo_dato">Apellido, Nombres y Documento </td>
        </tr>
<?
	while($fam = mysql_fetch_array($res)){

$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_dni_nro, Documento_tipo_nombre FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
) WHERE Familia_nro = {$fam["Familia_nro"]}",$link);

$sql3 = mysql_query("SELECT
Lote_circunscripcion,
Lote_seccion,
Lote_chacra,
Lote_quinta,
Lote_fraccion,
Lote_manzana,
Lote_parcela,
Partido_nombre
FROM (
dbo_lote
INNER JOIN
dbo_partido
ON dbo_lote.Partido_nro = dbo_Partido.Partido_nro
)WHERE Lote_nro = {$fam["Lote_nro"]}",$link);
$lote = mysql_fetch_array($sql3);	

$lote_partido = $lote["Partido_nombre"];
$lote_circ = $lote["Lote_circunscripcion"];
if($lote["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $lote["Lote_seccion"];}
if($lote["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $lote["Lote_chacra"];}
if($lote["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $lote["Lote_quinta"];}
if($lote["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $lote["Lote_fraccion"];}
$manzana = $lote["Lote_manzana"];
$parcela = $lote["Lote_parcela"];

?>
      <tr>
        <td class="datos-center"><?=$lote_partido; ?></td>
        <td class="datos-center"><?=$lote_circ; ?></td>
        <td class="datos-center"><?=$lote_secc; ?></td>
        <td class="datos-center"><?=$lote_ch; ?></td>
        <td class="datos-center"><?=$lote_qta; ?></td>
        <td class="datos-center"><?=$lote_fr; ?></td>
        <td class="datos-center"><?=$manzana; ?></td>
        <td class="datos-center"><?=$parcela; ?></td>
        <td ><? while ($persona = mysql_fetch_array($sql2)){ ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="73%" class="datos-left"><a href="persona_modif_form.php?Persona_nro=<? echo $persona["Persona_nro"]."&".$linkvar; ?>"><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]."<br>";?></a></td>
              <td width="27%" style="border-left: 1px solid #333;" class="datos-left"><? echo $persona["Documento_tipo_nombre"]." ";separa_dni($persona["Persona_dni_nro"]); echo"<br>";?></td>
            </tr>
          </table><? } ?></td>
        </tr>
	  <? } ?>
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