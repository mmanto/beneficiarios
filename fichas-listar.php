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

$idProyecto = $_GET["idProyecto"];
$idZona = $_GET["Zona"];

$resZona = mysql_query("SELECT * FROM dbo_proyecto_zonas WHERE Zona_nro = $idZona ",$link);
$zona = mysql_fetch_array($resZona);
$zona_nombre = $zona["Zona_nombre"];


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

$sql = "SELECT ficha_lote_manzana, ficha_lote_parcela, ficha_zona, ficha_nro, ficha_num, ficha_fecha, ficha_miembros_cant, ficha_censo_instancia, ficha_ubicacion_estado, ficha_refcarto, Nombre FROM (
dbo_ficha
INNER JOIN
dbo_usuarios
ON dbo_ficha.insert_usuario = dbo_usuarios.idUsuario
) WHERE Proyecto_nro = $idProyecto AND ficha_zona = $idZona AND blnActivo = '1'";

$res = mysql_query($sql);
$cant = mysql_num_rows($res);



?>

<table width="960" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="4"><h2>Registro de censos</h2></td>
  </tr>
  <tr>
    <td height="6" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="24" colspan="4" valign="bottom"><a href="zonas-listar.php?idProyecto=<?=$idProyecto; ?>">Volver al listado de proyectos</a></td>
  </tr>
  <tr>
    <td height="16" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td width="582" style="font-size:14px">Proyecto  
      <strong><?=$proyecto_nombre; ?></strong>
    - <?=$partido_nombre; ?>
      |
    <strong><?=$zona_nombre; ?></strong> (<?=$cant; ?> registros)</td>
    <td width="277" height="50" align="right">&nbsp;</td>
    <td width="78">&nbsp;</td>
  </tr>
  <tr>
    <td width="23" height="25">&nbsp;</td>
    <td colspan="3"><table width="840" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="38" height="55" align="center" class="titulo_dato">Mz </td>
        <td width="33" align="center" class="titulo_dato">Pc</td>
        <td width="87" align="center" class="titulo_dato">Ref.<br />
          Carto.</td>
        <td width="112" align="center" class="titulo_dato">Instancia censo</td>
        <td width="112" align="center" class="titulo_dato">Estado ubicación</td>
        <td width="238" align="center" class="titulo_dato">Titular</td>
        <td width="132" align="center" class="titulo_dato">Alta por</td>
        <td colspan="2" align="center" class="titulo_dato">Acciones</td>
        </tr>
        <? while ($ficha = mysql_fetch_array($res)) {	
		$ficha_nro = $ficha["ficha_nro"];
		$ficha_num = $ficha["ficha_num"];
		$ficha_fecha = $ficha["ficha_fecha"];
		$ficha_miembros = $ficha["ficha_miembros_cant"];
		if ($ficha["ficha_censo_instancia"] == '2') { $censo_instancia = "Censado original"; }
		elseif ($ficha["ficha_censo_instancia"] == '3') { $censo_instancia = "Censado telefonico"; }
		elseif ($ficha["ficha_censo_instancia"] == '4') { $censo_instancia = "Relev. en campo"; }
		else { $censo_instancia = "Sin definir"; } 	
		
		if ($ficha["ficha_ubicacion_estado"] == '2') { $ubicacion_estado = "Ubicado"; }
		elseif ($ficha["ficha_ubicacion_estado"] == '3') { $ubicacion_estado = "A reubicar"; }
		elseif ($ficha["ficha_ubicacion_estado"] == '4') { $ubicacion_estado = "Relocalizado"; }
		elseif ($ficha["ficha_ubicacion_estado"] == '5') { $ubicacion_estado = "Levantamiento"; }
		else { $ubicacion_estado = "Sin definir"; } 	
				
		 ?>       
      <tr>
        <td height="30" align="center"><? echo $ficha["ficha_lote_manzana"]; ?></td>
        <td align="center"><? echo $ficha["ficha_lote_parcela"]; ?></td>
        <td align="center"><? echo $ficha["ficha_refcarto"]; ?></td>
        <td align="center"><?=$censo_instancia; ?>&nbsp;</td>
        <td align="center"><?=$ubicacion_estado; ?>&nbsp;</td>
        <td align="center">
          <?
		$res2 = mysql_query("SELECT Persona_apellido, Persona_nombre FROM dbo_persona WHERE Ficha_nro = $ficha_nro AND blnActivo = '1' ORDER BY Persona_nro LIMIT 0,1");
        while ($persona = mysql_fetch_array($res2)) {
 		echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"];       
		} ?>
        </td>
        <td align="center"><? echo $ficha["Nombre"]; ?>&nbsp;</td>
        <td width="32" align="center" >
		<a href=javascript:ventana_modif('ficha_informe.php?idFicha=<?=$ficha_nro; ?>')><img src="imagen/doc.png" width="11" height="16" border="0" title="Ver informe"/></a></td>
        <td width="36" align="center" >-</td>
        </tr>
        <? } ?>
        

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