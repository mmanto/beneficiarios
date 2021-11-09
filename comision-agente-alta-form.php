<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

$idComision = $_GET["idComision"];

include ("conec.php");
include ("funciones.php");
include ("cabecera.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];


$sql = "SELECT agente_nro, agente_apellido, agente_nombre FROM dbo_agentes WHERE agente_comisiona = '1' AND blnActivo = '1' ORDER BY agente_apellido";
$res = mysql_query($sql);

$i = '1';

?>

<h2>Seleccione el/los agentes que desea incorporar a la comision</h2>
<p><a href="comision-informe.php?idComision=<?=$idComision; ?>">Volver</a></p>
<form action="comision-agente-alta.php" method="post">
<table width="688" border="0" cellspacing="2" cellpadding="3">
  <? while($agente = mysql_fetch_array($res)) { ?>
  <tr>
    <td width="64">&nbsp;</td>
    <td width="20"><input type="checkbox" name="seleccion[]" value="<?=$agente["agente_nro"]; ?>"></td>
    <td width="271"><strong><?=$agente["agente_apellido"]; ?></strong>, <?=$agente["agente_nombre"]; ?></td>
    <td width="299">&nbsp;</td>
  </tr>
  <? $i++;
   } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    <input type="hidden" name="idComision" value="<? echo $idComision;  ?>">
 	<input type="submit" name="button" id="button" value="Incorporar"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>



<? } ?>