<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

mysql_select_db("MyTierras",$link);


/*
$log_direccion = $_POST["log_direccion"];
$log_usuario = $_POST["log_usuario"];
$log_nivel = $_POST["log_nivel"];
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel"; */

/////////////////////////////////////////////////////

$expte_nro = $_GET["expte"];

//$expte_nro = '63';

/////////////////////////////////////////////////////
  
//if (!$resolucion_busqueda) {echo "<h2>Por favor, ingrese un n&uacute;mero de resoluci&oacute;n</h2><p><a href=\"javascript:history.go(-1)\">Realizar una nueva b&uacute;squeda</a></p><p>&nbsp;</p>";}else{


$sql = "SELECT Familia_nro, Familia_res_adj, Lote_nro FROM dbo_familia where Expte_esc_nro = '$expte_nro'";
$res = mysql_query($sql);
$cant = mysql_num_rows($res);
$familia = mysql_fetch_array($res);

$sql3 = mysql_query("SELECT * FROM dbo_expte_esc WHERE Expte_nro = $expte_nro",$link);

$expte = mysql_fetch_array($sql3);

$exptenum = $expte["Expte_num"];
$expte_caract = $expte["Expte_caract"];
$expte_anio = $expte["Expte_anio"];
$expte_anio_res = substr($expte_anio, 2, 2);


if ($cant < 1) {echo "<h2>No hay registros para este expediente</h2><p><a href=\"javascript:history.go(-1)\">Volver</a></p><p>&nbsp;</p>";}else{
?>

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="2"><h2>Informe de beneficiarios de tierras </h2></td>
  </tr>
  <tr>
    <td height="6" colspan="2">La presente informaci&oacute;n se limita a los beneficios e inmuebles contenidos en la base de datos del Sistema de Beneficiarios de Tierras </td>
  </tr>
  <tr>
    <td height="24" colspan="2" valign="bottom"><a href="javascript:history.go(-1)">Volver</a></td>
  </tr>
  <tr>
    <td height="16" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2" bgcolor="#F0F0F0"><h3><strong class="titulodato">Expediente N&ordm; <? echo $expte_caract; ?>-<? echo $exptenum; ?>/<? echo $expte_anio_res; ?></strong></h3></td>
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
        <td height="28" colspan="7" align="center" class="titulo_dato">Nomenclatura del inmueble </td>
        <td colspan="2" class="titulo_dato">Beneficiarios</td>
        </tr>
      <tr>
        <td width="35" height="25" align="center" class="titulo_dato">Circ.</td>
        <td width="34" align="center" class="titulo_dato">Secc.</td>
        <td width="37" align="center" class="titulo_dato">Ch.</td>
        <td width="33" align="center" class="titulo_dato">Qta.</td>
        <td width="43" align="center" class="titulo_dato">Fracc.</td>
        <td width="38" align="center" class="titulo_dato">Mz.</td>
        <td width="40" align="center" class="titulo_dato">Pc.</td>
        <td width="362" class="titulo_dato">Apellido, Nombres y Documento </td>
        <td width="73" align="center" class="titulo_dato">Resolucion</td>
      </tr>
<?
	while($fam = mysql_fetch_array($res)){

$sql2 = mysql_query("SELECT Persona_nro, Persona_apellido, Persona_nombre, Persona_dni_nro, Documento_tipo_nombre FROM dbo_persona WHERE Familia_nro = {$fam["Familia_nro"]}",$link);

$sql3 = mysql_query("SELECT * FROM dbo_lote WHERE Lote_nro = {$fam["Lote_nro"]}",$link);
$lote = mysql_fetch_array($sql3);	


$lote_circ = $lote["Lote_circunscripcion"];
if($lote["Lote_seccion"]=='0'){$lote_secc = " - ";}else{$lote_secc = $lote["Lote_seccion"];}
if($lote["Lote_chacra"]=='0'){$lote_ch = " - ";}else{$lote_ch = $lote["Lote_chacra"];}
if($lote["Lote_quinta"]=='0'){$lote_qta = " - ";}else{$lote_qta = $lote["Lote_quinta"];}
if($lote["Lote_fraccion"]=='0'){$lote_fr = " - ";}else{$lote_fr = $lote["Lote_fraccion"];}
$manzana = $lote["Lote_manzana"];
$parcela = $lote["Lote_parcela"];

?>
      <tr>
        <td align="center" class="datos-center"><?=$lote_circ; ?></td>
        <td align="center" class="datos-center"><?=$lote_secc; ?></td>
        <td align="center" class="datos-center"><?=$lote_ch; ?></td>
        <td align="center" class="datos-center"><?=$lote_qta; ?></td>
        <td align="center" class="datos-center"><?=$lote_fr; ?></td>
        <td align="center" class="datos-center"><?=$manzana; ?></td>
        <td align="center" class="datos-center"><?=$parcela; ?></td>
        <td ><? while ($persona = mysql_fetch_array($sql2)){ ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="73%" class="datos-left"><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]."<br>";?></td>
              <td width="27%" style="border-left: 1px solid #333;" class="datos-left"><? echo $persona["Persona_dni_nro"]."<br>";?></td>
            </tr>
          </table><? } ?></td>
        <td align="center" ><?=$familia["Familia_res_adj"]; ?>&nbsp;</td>
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
 //}     
include "pie.php";
?>