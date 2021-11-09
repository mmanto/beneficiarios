<?

$idAgente = $_GET["idAgente"];

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

//Select agente
$res = mysql_query("SELECT * FROM dbo_agentes WHERE agente_nro = $idAgente");
$agente = mysql_fetch_array($res); 

?>
<style type="text/css">
<!--
.Estilo8 {font-size: 13px; font-weight: bold; }
-->
</style>

<!-- Copyright 2000,2001 Macromedia, Inc. All rights reserved. -->
<title>
<MMString:LoadString id="insertbar/formsCheckbox" />
</title>
<form action="agente-modif.php" method="post">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="8"><h1>Informaci&oacute;n del  agente </h1></td>
    </tr>
  <tr>
    <td height="40" colspan="3" valign="top">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="228" rowspan="27" align="left" valign="middle">&nbsp;</td>
    </tr>
  
  <tr>
    <td width="9" height="24">&nbsp;</td>
    <td colspan="2"><strong>Fecha de ingreso</strong></td>
    <td colspan="2"><strong>Situci&oacute;n de revista</strong></td>
    <td width="22">&nbsp;</td>
    <td width="174"><strong>Legajo</strong></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="170" height="32" align="center" valign="middle" bgcolor="#EBEBEB" style="font-size:16px; font-weight:bold"><? echo cambiaf_a_normal($agente["agente_ingreso_fecha"]); ?></td>
    <td width="20" valign="middle" style="font-size:16px">&nbsp;</td>
    <td colspan="2" align="center" bgcolor="#EBEBEB" style="font-size:16px; font-weight:bold">
    <? if ($agente["agente_revista_tipo"] == '1') { echo "Planta perm. c/estabilidad";
		}elseif ($agente["agente_revista_tipo"] == '2') { echo "Planta perm. s/estabilidad";
		}elseif ($agente["agente_revista_tipo"] == '3') { echo "Planta temporaria";
		}elseif ($agente["agente_revista_tipo"] == '4') {
		echo "Contrato Colegio de Esc.";
    	}elseif ($agente["agente_revista_tipo"] == '5') {
		echo "Contrato loc. de obra";
		}else {	echo "S/I"; } ?>
    </td>
    <td>&nbsp;</td>
    <td align="center" bgcolor="#EBEBEB" style="font-size:16px; font-weight:bold" ><? echo $agente["agente_legajo"]; ?>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td colspan="2"><strong>Apellido agente</strong></td>
    <td colspan="2"><strong>Nombre agente </strong></td>
    <td>&nbsp;</td>
    <td><strong>Documento </strong></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="32" align="center" valign="middle" bgcolor="#EBEBEB" style="font-size:16px; font-weight:bold"><? echo $agente["agente_apellido"]; ?>&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td colspan="2" align="center" valign="middle" bgcolor="#EBEBEB" style="font-size:16px; font-weight:bold"><? echo $agente["agente_nombre"]; ?>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" valign="middle" bgcolor="#EBEBEB" style="font-size:16px; font-weight:bold"><? echo number_format($agente['agente_dni_nro'], 0, '', '.'); ?>&nbsp;</td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td colspan="2"><strong>Estado civil</strong></td>
    <td colspan="2"><strong>Tel&eacute;fono</strong></td>
    <td>&nbsp;</td>
    <td><strong>Fecha de Nacimiento</strong></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="32" align="center" valign="middle" bgcolor="#EBEBEB" style="font-size:16px; font-weight:bold">
    <? if($agente["agente_ecivil"] == '1') { echo "Soltero/a"; }
	elseif ($agente["agente_ecivil"] == '3') { echo "Casado/a"; }
	elseif ($agente["agente_ecivil"] == '4') { echo "Divorciado/a"; }
	elseif ($agente["agente_ecivil"] == '5') { echo "Separado/a"; }
	elseif ($agente["agente_ecivil"] == '6') { echo "Viudo/a"; }
	elseif ($agente["agente_ecivil"] == '9') { echo "Otro"; }
	else { echo "Sin indicar"; }
	?>
    &nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td colspan="2" align="center" valign="middle" bgcolor="#EBEBEB" style="font-size:16px; font-weight:bold"><? echo $agente["agente_telefono"]; ?>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" valign="middle" bgcolor="#EBEBEB" style="font-size:16px; font-weight:bold">
    <? echo cambiaf_a_normal($agente["agente_fechanac"]); ?> </td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
      <td height="24">&nbsp;</td>
      <td><strong>Edad</strong></td>
      <td>&nbsp;</td>
      <td colspan="2"><strong>Cuil</strong></td>
      <td colspan="2"><strong>Categoria</strong></td>
    </tr>
    <tr>
    <td height="32">&nbsp;</td>
    <td align="center" bgcolor="#EBEBEB"  style="font-size:16px; font-weight:bold">
	
	<?
	
	if($agente["agente_fechanac"] != '0000-00-00') {
	
	$str = $agente['agente_fechanac']; 

 	$da= explode('-', $str);   

	$dia = $da[2];  
    $mes = $da[1]; 
     $anio = $da[0];  

      $diac =date("d"); 
       $mesc =date("m"); 
       $anioc =date("Y"); 

      $edadac =  $anioc-$anio; 

   if($mesc < $mes && $diac < $dia || $mesc < $mes || $diac < $dia){ 

    $edad_aux = $edadac - 1; 

     $edadac = $edad_aux; 
     }
	 echo $edadac; ?> a&ntilde;os
    
    <? }else{ echo "S/I"; } ?>
    &nbsp;</td>
    <td>&nbsp;</td>
    <td width="223" align="center" bgcolor="#EBEBEB"  style="font-size:16px; font-weight:bold"><? if($agente["agente_cuil"]=='0') { echo "S/I"; }else{ echo $agente["agente_cuil"]; }?>&nbsp;</td>
    <td width="34">&nbsp;</td>
    <td colspan="2" align="center" bgcolor="#EBEBEB"  style="font-size:16px; font-weight:bold"><? 
	if($agente["agente_categoria"] == '1') { echo "Administrativo"; }
	elseif ($agente["agente_categoria"] == '2') { echo "T&eacute;cnico"; }
	elseif ($agente["agente_categoria"] == '3') { echo "Profesional"; }
	elseif ($agente["agente_categoria"] == '4') { echo "Jefe Depto. A/C"; }
	elseif ($agente["agente_categoria"] == '5') { echo "Jefe Departamento"; }
	elseif ($agente["agente_categoria"] == '6') { echo "Funcionario"; }
	elseif ($agente["agente_categoria"] == '7') { echo "Chofer"; }
	else { echo "Sin indicar"; }
	?>&nbsp;</td>
    </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="3">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="24" colspan="3"><strong>Domicilio</strong></td>
        <td colspan="2"><strong>Ciudad</strong></td>
      </tr>
      <tr>
        <td height="32" colspan="2" align="center" bgcolor="#EBEBEB" style="font-size:16px; font-weight:bold"><? echo $agente["agente_domicilio"]; ?></td>
        <td width="7%" height="32" align="center">&nbsp;</td>
        <td width="32%" align="center" bgcolor="#EBEBEB" style="font-size:16px; font-weight:bold"><? echo $agente["agente_domicilio_ciudad"]; ?></td>
        <td width="7%" align="center">&nbsp;</td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="3"><strong>Observaciones</strong></td>
          </tr>
        <tr>
          <td bgcolor="#EBEBEB">&nbsp;</td>
          <td bgcolor="#EBEBEB">&nbsp;</td>
          <td width="4%" bgcolor="#EBEBEB">&nbsp;</td>
          </tr>
        <tr>
          <td width="3%" height="90" bgcolor="#EBEBEB">&nbsp;</td>
          <td width="93%" valign="top" bgcolor="#EBEBEB" style="font-size:14px; font-weight:bold"><? echo $agente["agente_observaciones"]; ?></td>
          <td bgcolor="#EBEBEB">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="4" align="right">&nbsp;</td>
    <td width="20" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="40">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<? include("pie.php"); ?>
