<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include("cabecera.php");
include ("conec.php");
include ("funciones.php");



$ordenar = $_GET["ordenar"];


if ($ordenar == '2'){

$orden = "agente_legajo";

}elseif ($ordenar == '3'){

$orden = "agente_dni_nro";

}elseif ($ordenar == '4'){

$orden = "agente_categoria";

}else{

$orden = "agente_apellido";

}




$sql = "SELECT * FROM dbo_agentes WHERE blnActivo = '1' ORDER BY $orden ASC";

$res = mysql_query($sql);

$cant = mysql_num_rows($res);

?>
<h1>N&oacute;mina de Agentes (<?=$cant; ?> resultados)</h1>
<p><a href="menu.php">Volver</a></p>
<table width="850" border="0" cellspacing="3" cellpadding="7">
  <tr>
    <td height="60" align="left">Ordenar por:</td>
    <td align="left"><form>
		<select name="ListeUrl" onChange="ChangeUrl(this.form)">
		<option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=1" <? if ($ordenar == '1') { ?> selected="selected" <? } ?>>Apellido</option>
		<option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=2" <? if ($ordenar == '2') { ?> selected="selected" <? } ?>>Legajo</option>
		<option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=3" <? if ($ordenar == '3') { ?> selected="selected" <? } ?>>Documento</option>
	  	<option value="<?=basename($_SERVER['PHP_SELF']); ?>?ordenar=4" <? if ($ordenar == '4') { ?> selected="selected" <? } ?>>Categoria</option>
    </select>
    </form></td>
    <td align="center">&nbsp;</td>
    <td width="140" align="right"><a href="agente-alta-form.php"><img src="imagen/add-user.png" width="45" height="45" border="0" /></a></td>
    <td colspan="5" align="left">Dar de alta<br />
    nuevo agente </td>
  </tr>
  <tr>
    <td width="79" height="28" align="center" bgcolor="#C0D1D0"><strong>Legajo</strong></td>
    <td width="274" align="center" bgcolor="#C0D1D0"><strong>Apellido y Nombre</strong></td>
    <td width="100" align="center" bgcolor="#C0D1D0"><strong>DNI</strong></td>
    <td align="center" bgcolor="#C0D1D0"><strong>Categor&iacute;a</strong></td>
    <td colspan="5" align="center" bgcolor="#C0D1D0"><strong>Acciones</strong></td>
  </tr>
<?
$num_fila = '0';
while ($agente = mysql_fetch_array($res)) {
?>
  <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#DEE7E6\""; }else{ echo "bgcolor=\"#D2DFDE\"";} ?>>
    <td align="center"><?=$agente["agente_legajo"]; ?>&nbsp;</td>
    <td><?=$agente["agente_apellido"]; ?>, <?=$agente["agente_nombre"]; ?>&nbsp;</td>
    <td align="center"><? echo number_format($agente['agente_dni_nro'], 0, '', '.'); ?>&nbsp;</td>
    <td align="center"><? 
	if($agente["agente_categoria"] == '1') { echo "Administrativo"; }
	elseif ($agente["agente_categoria"] == '2') { echo "T&eacute;cnico"; }
	elseif ($agente["agente_categoria"] == '3') { echo "Profesional"; }
	elseif ($agente["agente_categoria"] == '4') { echo "Jefe Depto. A/C"; }
	elseif ($agente["agente_categoria"] == '5') { echo "Jefe Departamento"; }
	elseif ($agente["agente_categoria"] == '6') { echo "Funcionario"; }
	elseif ($agente["agente_categoria"] == '7') { echo "Chofer"; }
	else { echo "Sin indicar"; }
	?>&nbsp;</td>
    <td width="24" align="center"><a href="javascript:ventana_modif('agente-informe.php?idAgente=<?=$agente["agente_nro"]; ?>')"><img src="imagen/doc.png" width="11" height="16" title="Ver informe" alt="Ver informe"/></a></td>
    <td width="18" align="center"><a href="javascript:ventana_modif('agente-familia-listar.php?idAgente=<?=$agente["agente_nro"]; ?>')"><img src="imagen/familia.png" width="16" height="16" title="Grupo familiar"/></a></td>
    <td width="25" align="center"><a href="javascript:ventana_modif('agente-licencias.php?idAgente=<?=$agente["agente_nro"]; ?>')"><img src="imagen/list.png" width="16" height="12" title="Gestionar licencias" /></a></td>
    <td width="16" align="center"><a href="javascript:ventana_modif('agente-modif-form.php?idAgente=<?=$agente["agente_nro"]; ?>')"><img src="imagen/edit.png" width="16" height="16" title="Modificar" alt="Modificar"/></a></td>
    <td width="18" align="center"><a href="agente-borrar-confirm.php?idAgente=<?=$agente["agente_nro"]; ?>"><img src="imagen/drop.png" width="16" height="16" title="Borrar"/></a></td>
  </tr>

<?
$num_fila++;
 } ?>
</table>
<p>&nbsp;</p>
<p>
  <? include("pie.php"); ?>
</p>
<? } ?>