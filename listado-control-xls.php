<?
header("Content-type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Listado_control_municipio.xls");
header("Pragma: no-cache");
header("Expires: 0");

include("cabecera.php");

$lista = implode(',',$_POST['seleccion']); 
$seleccion = $_POST['seleccion'];
$cant = count($_POST['seleccion']);

$idBarrio = $_POST["idBarrio"];

include ("conec.php");

$res5 = mysql_query("SELECT * FROM dbo_barrio WHERE Barrio_nro = $idBarrio",$link);
$barrio = mysql_fetch_array($res5);
$barrio_nombre = $barrio["Barrio_nombre"];
$barrio_partido = $barrio["Partido_nro"];


$res4 = mysql_query("SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $barrio_partido",$link);
$partido = mysql_fetch_array($res4);
$partido_nombre = $partido["Partido_nombre"];



$res = "SELECT * FROM dbo_familia WHERE Familia_nro IN(".$lista.") ORDER BY Lote_circunscripcion, Lote_seccion, Lote_manzana, Lote_parcela ASC";
$sql = mysql_query($res); 
$cant = mysql_num_rows($sql);




?>
<table width="100%" border="1" cellspacing="0" cellpadding="3">
	  <tr>
	    <th>        
        <th>Partido        
        <th>        
        <th><strong>T1 Apellido</strong>
      <th>T1 Nombre      
      <th>T1 Documento      
      <th>T1 Nacionalidad      
      <th>T1 Fecha Nac.      
      <th>T1 E. Civil      
      <th>T1 Sep. de hecho      
      <th>T1 Padre      
      <th>T1 Madre      
      <th>T1 Telefono      
      <th>T2 Apellido      
      <th>T2 Nombre
      <th>T2 Documento      
      <th>T2 Nacionalidad      
      <th>T2 Fecha Nac.      
      <th>T2 E. Civil     
      <th>T2 Sep de hecho      
      <th>T2 Padre      
      <th>T2 Madre      
      <th>T2 Telefono      
      <th>Domicilio      
      <th>Manzana      
      <th>Lote      
      <th>Circ.      
      <th>Secci&oacute;n      
      <th>Plano      
      <th>Monto      
      <th>Cant. cuotas            
      <th>Valor Cuota      
	  <th>Plan viviendas      
	  <th>Observaciones      
	  </tr>
     
        <?
$fila = '1';

while ($familia = mysql_fetch_array($sql)) {


$manzana_prov = $familia["Lote_manzana_prov"];
if ($manzana_prov == '0') { $manzana_prov = '-'; }
$manzana = $familia["Lote_manzana"];
$parcela = $familia["Lote_parcela"];
$circ = $familia["Lote_circunscripcion"];
$secc = $familia["Lote_seccion"];

//Valor cuota
$valor_cuota = $familia["Familia_montoadj"]/$familia["Familia_montoadj_cuotas"];
$valor_cuota_red = round($valor_cuota * 100) / 100;

$planviviendanro = $familia["Planvivienda_nro"];

$sql6 = "SELECT * FROM dbo_planvivienda WHERE Planvivienda_nro = $planviviendanro";
$res6 = mysql_query($sql6);
$planvivienda = mysql_fetch_array($res6);
$cant2 = mysql_num_rows($res6);

if($cant2 == '0') { $planvivienda_nombre = "--"; }else{ $planvivienda_nombre = $planvivienda["Planvivienda_nombre"]; }


$sql2 = mysql_query("SELECT * FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
INNER JOIN
dbo_estado_civil
ON dbo_persona.Estado_civil_nro = dbo_estado_civil.Estado_civil_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND Persona_baja = '0' AND blnActivo = '1' LIMIT 0,1",$link);

$persona = mysql_fetch_array($sql2);


$sql3 = mysql_query("SELECT * FROM (
dbo_persona
INNER JOIN
dbo_documento_tipo
ON dbo_persona.Documento_tipo_nro = dbo_documento_tipo.Documento_tipo_nro
INNER JOIN
dbo_estado_civil
ON dbo_persona.Estado_civil_nro = dbo_estado_civil.Estado_civil_nro
) WHERE Familia_nro = {$familia["Familia_nro"]} AND Persona_baja = '0' AND blnActivo = '1' LIMIT 1,1",$link);

$persona2 = mysql_fetch_array($sql3);

?>
      <tr>
        <td align="center"><? echo $fila; ?>&nbsp;</td>
        <td align="center"><? echo $partido_nombre; ?>&nbsp;</td>
        <td align="center"><? echo $barrio_nombre; ?>&nbsp;</td>
        <td align="center"><? echo $persona["Persona_apellido"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona["Persona_nombre"]; ?></td>
      <td align="center"><? echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?></td>
      <td align="center"><? echo $persona["Persona_nacionalidad"]; ?>&nbsp;</td> 	
      <td align="center"><? echo $persona["Persona_fecha_nac"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona["Estado_civil_nombre"]; ?>&nbsp;</td>
      <td align="center"><? if ($persona["Ecivil_sep_hecho"] == '1') { echo "(SI"; }else{ echo "NO";} ?>&nbsp;</td>
      <td align="center"><? echo $persona["Persona_padre_nombrecompleto"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona["Persona_madre_nombrecompleto"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona["Persona_telefono"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_apellido"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_nombre"]; ?>&nbsp;</td>
      <td align="center"><? echo number_format($persona2['Persona_dni_nro'], 0, '', '.'); ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_nacionalidad"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_fecha_nac"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Estado_civil_nombre"]; ?>&nbsp;</td>
      <td align="center"><? if ($persona2["Ecivil_sep_hecho"] == '1') { echo "(SI"; }else{ echo "NO";} ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_padre_nombrecompleto"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_madre_nombrecompleto"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_telefono"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_domic"]; ?>&nbsp;</td>
      <td align="center"><? echo $manzana; ?>&nbsp;</td>
      <td align="center"><? echo $parcela; ?>&nbsp;</td>
      <td align="center"><? echo $circ; ?>&nbsp;</td>
      <td align="center"><? echo $secc; ?>&nbsp;</td>
      <td align="center"><?=$familia["Plano_num"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_montoadj"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_montoadj_cuotas"]; ?>&nbsp;</td>
      <td align="center"><?=$valor_cuota_red; ?>&nbsp;</td>
      <td align="center"><?=$planvivienda_nombre; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_observaciones"]; ?>&nbsp;</td>
      </tr>
  <?
 $fila++; 
}
?>
    </table>
