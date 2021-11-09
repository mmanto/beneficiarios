<?

$lista = implode(',',$_POST['seleccion']); 
$seleccion = $_POST['seleccion'];
$cant = count($_POST['seleccion']);

$idBarrio = $_POST["idBarrio"];

include ("conec.php");
include ("cabecera.php");

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
<h2>Listado control de beneficiarios</h2>
<p> <a href="javascript:history.back(1)">Volver</a></p>
<p>&nbsp;</p>
<table width="3500" border="1" cellspacing="0" cellpadding="3">
	  <tr>
	    <th>        
        <th>Partido        
        <th>Barrio        
        <th>Apellido
      <th>Nombre      
      <th>Documento      
      <th>Nacionalidad      
      <th>Fecha Nac.      
      <th>E. Civil      
      <th>Sep. de hecho      
      <th>Padre      
      <th>Madre      
      <th>Apellido      
      <th>Nombre
      <th>Documento      
      <th>Nacionalidad      
      <th>Fecha Nac.      
      <th>E. Civil     
      <th>Sep de hecho      
      <th>Padre      
      <th>Madre      
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
	  <th width="400">Observaciones      
	  <th>      
	  <th>      
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

//Plan de vivienda
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
      <td align="center"><? echo $persona2["Persona_apellido"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_nombre"]; ?>&nbsp;</td>
      <td align="center"><? echo number_format($persona2['Persona_dni_nro'], 0, '', '.'); ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_nacionalidad"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_fecha_nac"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Estado_civil_nombre"]; ?>&nbsp;</td>
      <td align="center"><? if ($persona2["Ecivil_sep_hecho"] == '1') { echo "(SI"; }else{ echo "NO";} ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_padre_nombrecompleto"]; ?>&nbsp;</td>
      <td align="center"><? echo $persona2["Persona_madre_nombrecompleto"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_domic"]; ?>&nbsp;</td>
      <td align="center"><? echo $manzana; ?>&nbsp;</td>
      <td align="center"><? echo $parcela; ?>&nbsp;</td>
      <td align="center"><? echo $circ; ?>&nbsp;</td>
      <td align="center"><? echo $secc; ?>&nbsp;</td>
      <td align="center"><?=$familia["Plano_num"]; ?>&nbsp;</td>
      <td align="center">$ <?=$familia["Familia_montoadj"]; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_montoadj_cuotas"]; ?>&nbsp;</td>
      <td align="center">$ <? echo $valor_cuota_red; ?>&nbsp;</td>
      <td align="center"><?=$planvivienda_nombre; ?>&nbsp;</td>
      <td align="center"><?=$familia["Familia_observaciones"]; ?>&nbsp;</td>
      <td align="center"><a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$familia["Familia_nro"]; ?>')><img src="imagen/doc.png" width="11" height="16" border="0" title="Ver informe"/></a>&nbsp;</td>
      <td align="center"><a href=javascript:ventana_modif('beneficio_informe_imp.php?idFamilia=<?=$familia["Familia_nro"]; ?>')><img src="imagen/imp.png" alt="Imprimir planilla de datos" title="Imprimir planilla de datos" width="18" height="18" border="0" /></a></td>
      </tr>
  <?
 $fila++; 
}
?>
    </table>
 
<? include ("pie.php"); ?>
