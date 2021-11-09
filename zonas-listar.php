<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("conec.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

include ("funciones.php");

include("cabecera.php");

//$idProyecto = $_GET["idProyecto"];
/*

$sqlb = "SELECT * FROM (
dbo_proyecto
INNER JOIN
dbo_partido
ON dbo_proyecto.Partido_nro = dbo_partido.Partido_nro
) WHERE Proyecto_nro = $idProyecto";
$bar = mysql_query($sqlb);
$proyecto = mysql_fetch_array($bar);
$proyecto_nombre = $proyecto["Proyecto_nombre"];
$partido_nombre = $proyecto["Partido_nombre"];
*/

?>

<table width="960" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="4"><h2>Nómina de proyectos de la Dirección</h2></td>
  </tr>
  <tr>
    <td height="6" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="24" colspan="4" valign="bottom"><a href="menu.php">Volver al menu</a></td>
  </tr>
  <tr>
    <td height="16" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td width="235">&nbsp;</td>
    <td width="625" align="right"><table width="150" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="46"><a href="persona_buscar3_form.php"><img src="imagen/remito-buscar.png" width="40" height="40" border="0" /></a></td>
        <td width="104">Buscar personas</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="77">&nbsp;</td>
  </tr>
  <tr>
    <td width="23" height="25">&nbsp;</td>
    <td colspan="3"><table width="860" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="256" height="25" align="center" class="titulo_dato">Partido</td>
        <td width="269" align="center" class="titulo_dato">Proyecto</td>
        <td width="169" align="center" class="titulo_dato">Zona</td>
        <td colspan="2" align="center" class="titulo_dato">Acciones</td>
        </tr>
      <tr>
        <td height="30" align="center">La Plata&nbsp;</td>
        <td align="center">Los Hornos</td>
        <td align="center">Zona 1 (Telefónico)</td>
        <td width="42" align="center" ><a href="fichas-listar.php?idProyecto=1&Zona=1"><img src="imagen/benef.jpg" border="0" title="Listar registros de la zona" Alt="Listar registros de la zona"/></a></td>
        <td width="43" align="center" ><a href="ficha_alta_form.php?idProyecto=1&zona=1"><img src="imagen/benef-add.jpg" title="Agregar nueva ficha" width="16" height="19" /></a></td>
        </tr>
      <tr>
        <td height="30" align="center">La Plata&nbsp;</td>
        <td align="center">Los Hornos</td>
        <td align="center">Zona 2 (Telefónico)</td>
        <td align="center" ><a href="fichas-listar.php?idProyecto=1&Zona=2"><img src="imagen/benef.jpg" border="0" title="Listar registros de la zona" Alt="Listar registros de la zona"/></a></td>
        <td align="center" ><a href="ficha_alta_form.php?idProyecto=1&zona=2"><img src="imagen/benef-add.jpg" title="Agregar nueva ficha" width="16" height="19" /></a></td>
        </tr>
      <tr>
        <td height="30" align="center">La Plata&nbsp;</td>
        <td align="center">Los Hornos</td>
        <td align="center">Zona 3 (Telefónico)</td>
        <td align="center" ><a href="fichas-listar.php?idProyecto=1&Zona=3"><img src="imagen/benef.jpg" border="0" title="Listar registros de la zona" Alt="Listar registros de la zona"/></a></td>
        <td align="center" ><a href="ficha_alta_form.php?idProyecto=1&zona=3"><img src="imagen/benef-add.jpg" title="Agregar nueva ficha" width="16" height="19" /></a></td>
        </tr>
      <tr>
        <td height="30" align="center">La Plata&nbsp;</td>
        <td align="center">Los Hornos</td>
        <td align="center">Zona 4 (Telefónico)</td>
        <td align="center" ><a href="fichas-listar.php?idProyecto=1&Zona=4"><img src="imagen/benef.jpg" border="0" title="Listar registros de la zona" Alt="Listar registros de la zona"/></a></td>
        <td align="center" ><a href="ficha_alta_form.php?idProyecto=1&zona=4"><img src="imagen/benef-add.jpg" title="Agregar nueva ficha" width="16" height="19" /></a></td>
        </tr>
        <tr>
        <td height="30" align="center">La Plata&nbsp;</td>
        <td align="center">Los Hornos</td>
        <td align="center">Zona 1</td>
        <td align="center" ><a href="fichas-listar.php?idProyecto=1&Zona=5"><img src="imagen/benef.jpg" border="0" title="Listar registros de la zona" Alt="Listar registros de la zona"/></a></td>
        <td align="center" ><a href="ficha_alta_form.php?idProyecto=1&zona=5"><img src="imagen/benef-add.jpg" title="Agregar nueva ficha" width="16" height="19" /></a></td>
        </tr>
        <tr>
        <td height="30" align="center">La Plata&nbsp;</td>
        <td align="center">Los Hornos</td>
        <td align="center">Zona 2</td>
        <td align="center" ><a href="fichas-listar.php?idProyecto=1&Zona=6"><img src="imagen/benef.jpg" border="0" title="Listar registros de la zona" Alt="Listar registros de la zona"/></a></td>
        <td align="center" ><a href="ficha_alta_form.php?idProyecto=1&zona=6"><img src="imagen/benef-add.jpg" title="Agregar nueva ficha" width="16" height="19" /></a></td>
        </tr>
        <tr>
        <td height="30" align="center">La Plata&nbsp;</td>
        <td align="center">Los Hornos</td>
        <td align="center">Zona 3</td>
        <td align="center" ><a href="fichas-listar.php?idProyecto=1&Zona=7"><img src="imagen/benef.jpg" border="0" title="Listar registros de la zona" Alt="Listar registros de la zona"/></a></td>
        <td align="center" ><a href="ficha_alta_form.php?idProyecto=1&zona=7"><img src="imagen/benef-add.jpg" title="Agregar nueva ficha" width="16" height="19" /></a></td>
        </tr>
        <tr>
        <td height="30" align="center">La Plata&nbsp;</td>
        <td align="center">Los Hornos</td>
        <td align="center">Zona 4</td>
        <td align="center" ><a href="fichas-listar.php?idProyecto=1&Zona=8"><img src="imagen/benef.jpg" border="0" title="Listar registros de la zona" Alt="Listar registros de la zona"/></a></td>
        <td align="center" ><a href="ficha_alta_form.php?idProyecto=1&zona=8"><img src="imagen/benef-add.jpg" title="Agregar nueva ficha" width="16" height="19" /></a></td>
        </tr>
        <tr>
        <td height="30" align="center">La Plata&nbsp;</td>
        <td align="center">Los Hornos</td>
        <td align="center">Zona Parque</td>
        <td align="center" ><a href="fichas-listar.php?idProyecto=1&Zona=9"><img src="imagen/benef.jpg" border="0" title="Listar registros de la zona" Alt="Listar registros de la zona"/></a></td>
        <td align="center" ><a href="ficha_alta_form.php?idProyecto=1&zona=9"><img src="imagen/benef-add.jpg" title="Agregar nueva ficha" width="16" height="19" /></a></td>
        </tr>
      <tr>
        <td height="30" align="center">La Plata&nbsp;</td>
        <td align="center">Los Hornos</td>
        <td align="center">Todas las zonas</td>
        <td align="center" ><a href="fichas-listar.php?idProyecto=1&Zona=0"><img src="imagen/benef.jpg" border="0" title="Listar registros de la zona" Alt="Listar registros de la zona"/></a></td>
        <td align="center" >-</td>
        </tr>

    </table></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
<?  
include "pie.php";
?>
<? } ?>