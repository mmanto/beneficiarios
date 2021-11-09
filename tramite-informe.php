<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{


include ("conec.php");
include ("funciones.php");
include("cabecera.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
$log_nivel = $user["Usuario_nivel"];
$usuario_area = $user["Area_nro"];
$usuario_direccion = $user["Direccion_nro"];

$idTramite = $_GET["idTramite"];

$SQLtramite = "SELECT * FROM (
dbo_tramite_ley
INNER JOIN
dbo_usuarios
ON dbo_tramite_ley.Tramite_alta_usuario = dbo_usuarios.idUsuario)
WHERE Tramite_nro = '$idTramite'";
$resTramite = mysql_query($SQLtramite);
$tramite = mysql_fetch_array($resTramite);
$pdo = $tramite["Tramite_partido"];

$SQLpersona = "SELECT * FROM dbo_persona WHERE Tramite_nro = '$idTramite'";
$resPersona = mysql_query($SQLpersona);
$persona = mysql_fetch_array($resPersona);


//Listado partidos
$strSQL = "SELECT Partido_nombre FROM dbo_partido WHERE Partido_nro = $pdo";
$respartido = mysql_query($strSQL);
$partido = mysql_fetch_array($respartido);
?>

<style type="text/css">
<!--
.Estilo8 {font-size: 15px; font-weight: bold; }
.Estilo11 {font-size: 13px; font-weight: bold; }
-->
</style>

<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>
<form action="tramite-modif.php" method="post">
  <table width="900" border="0" cellspacing="7" cellpadding="0">
 <tr>
    <td colspan="6"><h1>Informe de tr&aacute;mite ley 24374 </h1></td><td width="166">&nbsp;</tr>
  <tr>
    <td height="22">&nbsp;</td>
	<? if($tramite["Tramite_terminado"] == '1') { ?>
	<td height="22" colspan="4" bgcolor="#FFFF99" align="center"><h1>Tr&aacute;mite Terminado</h1></td>
	<? }else{ ?>
	<td height="22" colspan="4">&nbsp;</td>
	<? } ?>
	
    <td width="138" colspan="2" rowspan="12" align="center" valign="top"><table width="96%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <td width="52%" bgcolor="#E7EBD8"><span class="Estilo11">Completo:</span></td>
            <td width="48%" bgcolor="#E7EBD8"><? if($tramite["Tramite_completo"] == '1') { echo "SI"; } ?>&nbsp;</td>
          </tr>
          <tr>
            <td><span class="Estilo11">C&eacute;dula:</span></td>
            <td><? if($tramite["Tramite_cedula"] == '1') { echo "EN ESPERA"; } ?><? if($tramite["Tramite_cedula"] == '2') { echo "ADJUNTADO"; } ?>&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#E7EBD8"><span class="Estilo11">Plancheta:</span></td>
            <td bgcolor="#E7EBD8"><? if($tramite["Tramite_plancheta"] == '1') { echo "EN ESPERA"; } ?><? if($tramite["Tramite_plancheta"] == '2') { echo "ADJUNTADO"; } ?>&nbsp;</td>
          </tr>
          <tr>
            <td><span class="Estilo11">Informe Dominio: </span></td>
            <td><? if($tramite["Tramite_inf_dom"] == '1') { echo "EN ESPERA"; } ?><? if($tramite["Tramite_inf_dom"] == '2') { echo "ADJUNTADO"; } ?>&nbsp;</td>
          </tr>
          <tr>
		    <td  colspan="2" align="center" bgcolor="#DDE4F7"><table width="94%" border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td height="20" class="Estilo11">Titular dominial:</td>
		        </tr>
		      <tr>
		        <td height="35" valign="top"><?=$tramite["Tramite_titdom"]; ?>&nbsp;</td>
		        </tr>
	        </table></td>
	      </tr>
          <tr>
            <td bgcolor="#E7EBD8"><span class="Estilo11">Pub. Edicto: </span></td>
            <td bgcolor="#E7EBD8"><? if($tramite["Tramite_edicto"] == '1') { echo "EN ESPERA"; } ?><? if($tramite["Tramite_edicto"] == '2') { echo "ADJUNTADO"; } ?>&nbsp;</td>
          </tr>
          <tr>
            <td><span class="Estilo11">C&aacute;mara Electoral: </span></td>
            <td><? if($tramite["Tramite_inf_camara"] == '1') { echo "EN ESPERA"; } ?><? if($tramite["Tramite_inf_camara"] == '2') { echo "ADJUNTADO"; } ?>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>Oficio cámara:</strong></td>
            <td><?=$tramite["Tramite_oficamara"]; ?>&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#E7EBD8"><span class="Estilo11">Carta Documento: </span></td>
            <td bgcolor="#E7EBD8"><? if($tramite["Tramite_cartadoc"] == '1') { echo "EN ESPERA"; } ?><? if($tramite["Tramite_cartadoc"] == '2') { echo "ADJUNTADO"; } ?>&nbsp;</td>
          </tr>
          <tr>
            <td><span class="Estilo11">Terminado:</span></td>
            <td><? if($tramite["Tramite_terminado"] == '1') { echo "-Terminado-"; }else{ echo "NO"; } ?>&nbsp;</td>
          </tr>
          <tr><td colspan="2">Fecha terminado: <? echo cambiaf_a_normal($tramite["Tramite_terminado_fecha"]); ?></td>
          </tr>
          <tr>
            <td colspan="2" align="center" valign="top" bgcolor="#E7EBD8"><table width="94%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="20" class="Estilo11">Observaciones:</td>
                </tr>
                <tr>
                  <td height="52" valign="top"><? echo $tramite["Tramite_observaciones"]; ?>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="40" colspan="2" align="center" valign="bottom" class="Estilo8">Alta: <?=$tramite["Nombre"]; ?></td>
          </tr>
          <tr>
            <td height="40" colspan="2" align="center" valign="bottom" class="Estilo8">
			<? if($user["p803"] == '1') { ?><a href="tramite-modif-form.php?idTramite=<?=$idTramite; ?>">[Modificar informaci&oacute;n]</a><? } ?>&nbsp;</td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td width="8" height="28">&nbsp;</td>
    <td width="211" valign="bottom"><strong>Fecha de inicio </strong></td>
    <td width="154" valign="bottom"><strong>Tipo de tr&aacute;mite </strong></td>
    <td width="89">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="1">&nbsp;</td>
    </tr>
  <tr>
    <td height="36">&nbsp;</td>
    <td width="211" align="center" valign="middle" bgcolor="#E4E4E4" class="Estilo8"><? echo $tramite["Tramite_inicio_fecha"]; ?></td>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="70%" height="34" align="center" bgcolor="#DAE1E9" class="Estilo8"><? if($tramite["Tramite_tipo"] == '1') { echo "Regularizacion"; }else{ echo "Consolidacion"; } ?>&nbsp;</td>
        <td width="30%">&nbsp;</td>
      </tr>
    </table></td>
    <td></td>
    </tr>
  <tr>
    <td height="22">&nbsp;</td>
    <td valign="bottom"><strong>Partido</strong></td>
    <td valign="bottom"><strong>Nomenclatura</strong></td>
    <td colspan="2" valign="bottom">&nbsp;</td>
    </tr>
  
  <tr>
    <td height="36">&nbsp;</td>
    <td align="center" bgcolor="#E4E4E4" class="Estilo8"><?=$partido["Partido_nombre"]; ?>&nbsp;</td>
    <td align="center" bgcolor="#E4E4E4" class="Estilo8"><? echo $tramite["Tramite_nomenc"]; ?>&nbsp;</td>
    <td colspan="2" align="center" class="Estilo8">&nbsp;</td>
    </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td valign="bottom"><strong>Titular </strong></td>
    <td>&nbsp;</td>
    <td valign="bottom"><strong>DNI Titular </strong></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="36">&nbsp;</td>
    <td colspan="2" align="center" bgcolor="#E4E4E4" class="Estilo8"><? echo $persona["Persona_apellido"]; ?>, <? echo $persona["Persona_nombre"]; ?></td>
    <td colspan="2" align="center" bgcolor="#E4E4E4" class="Estilo8"><? echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?></td>
    </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td valign="bottom"><strong>Direccion</strong></td>
    <td valign="bottom"><strong>Tel&eacute;fono</strong></td>
    <td colspan="2"><strong>Expte. Ref. </strong></td>
  </tr>
  <tr>
    <td height="36">&nbsp;</td>
    <td align="center" valign="middle" bgcolor="#E4E4E4" class="Estilo8"><? echo $persona["Persona_direccion"]; ?>&nbsp;</td>
    <td align="center" valign="middle" bgcolor="#E4E4E4" class="Estilo8"><? echo $persona["Persona_telefono"]; ?>&nbsp;</td>
    <td colspan="2" align="center" valign="middle" bgcolor="#E4E4E4" class="Estilo8"><? echo $tramite["Tramite_numref"]; ?>&nbsp;</td>
  </tr>
  <tr>
    <td height="22">&nbsp;</td>
    <td colspan="2" valign="bottom"><strong>Escribano</strong></td>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td height="36">&nbsp;</td>
    <td colspan="2" align="center" bgcolor="#E4E4E4" class="Estilo8"><? echo $tramite["Tramite_escribano"]; ?>&nbsp;</td>
    <td colspan="2" align="center" <? if($tramite["Tramite_archivado"] == '1') {echo "bgcolor=\"#FFCCCC\"";} ?> class="Estilo8"><? if($tramite["Tramite_archivado"] == '1') {echo "ARCHIVADO";} ?>&nbsp;</td>
    </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="center" valign="middle">&nbsp;</td>
    </tr>
</table>
</form>
</body>
</html>
<? include("pie.php"); ?>

<? } ?>