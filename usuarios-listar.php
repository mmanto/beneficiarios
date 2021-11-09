<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$sql = "SELECT * FROM (
dbo_usuarios 
INNER JOIN
dbo_area
ON dbo_usuarios.Area_nro = dbo_area.Area_nro
) WHERE idUsuario >= 5 ORDER BY Nombre ASC";

$res = mysql_query($sql);

$cant = mysql_num_rows($res);

?>
<h1>Usuarios del sistema</h1>
<p><a href="sbt-menu.php">Volver</a></p>
<table width="800" border="0" cellspacing="3" cellpadding="7">
  <tr>
    <td height="60" align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right"><a href="usuario-alta-form.php"><img src="imagen/add-user.png" width="45" height="45" border="0" /></a></td>
    <td align="left">Dar de alta<br />
    nuevo usuario </td>
  </tr>
  <tr>
    <td width="194" height="28" align="center" bgcolor="#CDCDCD"><strong>Usuario</strong></td>
    <td width="253" align="center" bgcolor="#CDCDCD"><strong>Area</strong></td>
    <td width="87" align="center" bgcolor="#CDCDCD"><strong>Nivel Sist. Exptes.</strong></td>
    <td width="88" align="center" bgcolor="#CDCDCD"><strong>Nivel Sist. Beneficiarios</strong></td>
    <td width="90" align="center" bgcolor="#CDCDCD"><strong>Acciones</strong></td>
  </tr>
<?
$num_fila = '0';
while ($usuario = mysql_fetch_array($res)) {
?>
  <tr <? if ($num_fila%2==0) { echo "bgcolor=\"#E5E5E5\""; }else{ echo "bgcolor=\"#DADADA\"";} ?>>
    <td><?=$usuario["Nombre"]; ?>&nbsp;</td>
    <td><?=$usuario["Area_nombre"]; ?>&nbsp;</td>
    <td align="center"><?=$usuario["HabExp"]; ?>&nbsp;</td>
    <td align="center"><?=$usuario["HabSbt"]; ?>&nbsp;</td>
    <td align="center"><a href=javascript:ventana_modif('usuario-modif-form.php?idusuario=<?=$usuario["idUsuario"]; ?>')>Modificar</a></td>
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