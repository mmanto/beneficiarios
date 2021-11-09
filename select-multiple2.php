<?
include("cabecera.php");
include ("conec.php");
include ("funciones.php");

//echo $_POST["seleccion"];

$lista = implode(',',$_POST['seleccion']); 

$accion = $_POST["accion"];

$expte = $_POST["expte_esc_nro"];

$barrio_nro = $_POST["barrio_nro"];

$barrio_origen = $_POST["barrio_origen"];

$pag_origen = $_POST["pag_origen"];

if (!$_POST["seleccion"]) {echo "Vacio!"; }else{ echo $lista; }

echo "<br/><br/>";

if (!$_POST["accion"]) {echo "Sin accion!"; }else{ echo "Hay accion"; }

echo "<br/><br/>";

echo "Accion: ".$accion;

echo "<br/><br/>";

echo "Expediente: ".$expte;

echo "<br/><br/>";

echo "Barrio seleccionado: ".$barrio_nro;

?>

<a href="<? echo $pag_origen."?idBarrio=".$barrio_origen;?>">Volver</a>
<table width="740" border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td width="322">&nbsp;</td>
    <td width="390">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>

<? 



?>