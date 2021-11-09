<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");


$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];


/*
$sqlDir = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dir = mysql_fetch_array($sqlDir);
$dirNombre = $dir["Direccion_nombre"];

$sqlDirProv = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dirprov = mysql_fetch_array($sqlDirProv);
$dirProvNombre = $dir["Direccion_dirprov"];
*/

/*
$sqlCens = "SELECT * FROM dbo_censistas ORDER BY Censista_num ASC";
$cen = mysql_query($sqlCens);

*/
$idFicha = $_GET["idFicha"];


$sql = "SELECT * FROM (
dbo_ficha
INNER JOIN
dbo_censistas
ON dbo_ficha.ficha_censista = dbo_censistas.Censista_nro
) WHERE Ficha_nro = $idFicha";
$res = mysql_query($sql);
$ficha = mysql_fetch_array($res);

$idProyecto = $ficha["Proyecto_nro"];

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
?>
<form action="encdemanda_alta.php" method="post">
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4"><h2>Ficha relevamiento demanda habitacional  </h2></td>
        </tr>
      <tr>
        <td height="30" colspan="4">&nbsp;</td>
        </tr>
      <tr>
        <td width="51%" style="font-size:16px"><strong>Proyecto: <?=$proyecto_nombre; ?> | Zona: <?=$ficha["ficha_zona"]; ?></strong></td>
        <td width="9%">:</td>
        <td width="15%"></td>
        <td align="center" style="font-size:16px"><strong>Ficha Nro.: <?=$ficha["ficha_num"]; ?></strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="26" colspan="5" bgcolor="#E4E4E4">UBICACI&Oacute;N LOTE/PARCELA </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="15%">Manzana</td>
        <td width="16%">Lote</td>
        <td colspan="2">Calle/Pasillo</td>
        <td width="23%">Nro.</td>
      </tr>
      <tr>
        <td><strong><?=$ficha["ficha_lote_manzana"]; ?></strong></td>
        <td><strong><?=$ficha["ficha_lote_parcela"]; ?></strong></td>
        <td colspan="2"><strong><?=$ficha["ficha_lote_calle"]; ?></strong></td>
        <td><strong><?=$ficha["ficha_lote_num"]; ?></strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Teléfono ref:</td>
        <td><strong><?=$ficha["ficha_telefono"]; ?></strong></td>
        <td width="20%" align="center">Num Ref. cartográfica:</td>
        <td width="26%"><strong><?=$ficha["ficha_refcarto"]; ?></strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="26" colspan="6" bgcolor="#E4E4E4">DATOS DEL RELEVAMIENTO </td>
        </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
          <td colspan="-1">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="5">Entrevistador: <strong><?=$ficha["Censista_nombre"]; ?></strong>&nbsp; </td>
          <td width="24%" colspan="-1">Fecha: <strong><?=$ficha["ficha_fecha"]; ?></strong></td>
        </tr>
        <tr>
          <td height="24" colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="-1">&nbsp;</td>
        </tr>
        <tr>
          <td height="24" colspan="2">Entrevista efectiva:<strong>
<? if ($ficha["ficha_ent_efect"] == '1') {echo "SI"; }else{ echo "NO"; } ?>
          </strong></td>
          <td>Motivo: <strong><? if($ficha["ficha_ent_efect_neg_motivo"] == '0') { echo "&nbsp;"; }
		  if($ficha["ficha_ent_efect_neg_motivo"] == '1') { echo "Ausente"; }
		  if($ficha["ficha_ent_efect_neg_motivo"] == '2') { echo "Rechazo"; }
		  if($ficha["ficha_ent_efect_neg_motivo"] == '3') { echo "Vivienda vac&iacute;a"; }
		  if($ficha["ficha_ent_efect_neg_motivo"] == '4') { echo "Local comercial"; }
		  if($ficha["ficha_ent_efect_neg_motivo"] == '5') { echo "Lote bald&iacute;o"; }
		  if($ficha["ficha_ent_efect_neg_motivo"] == '6') { echo "Vivienda en construcci&oacute;n"; }
		  if($ficha["ficha_ent_efect_neg_motivo"] == '7') { echo "Equipamiento"; }
		  if($ficha["ficha_ent_efect_neg_motivo"] == '8') { echo "Otros"; } 	
          ?></strong></td>
          <td colspan="-1">&nbsp;</td>
        </tr>
        <tr>
          <td width="18%">&nbsp;</td>
          <td width="17%">&nbsp;</td>
          <td width="25%" colspan="-1">&nbsp;</td>
          <td width="16%">&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="26" colspan="7" bgcolor="#E4E4E4">DETECCION VIVIENDAS EN LOTE/PARCELA </td>
        </tr>
        <tr>
          <td width="21%">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td width="28%">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td width="13%">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">Cant.  viv. en el lote: <strong><?=$ficha["ficha_viviendas_cant"]; ?></strong></td>
          <td width="12%">Letra: <strong><?=$ficha["ficha_letra"]; ?></strong></td>
          <td colspan="2">Cant.  hogares en la viv: <strong><?=$ficha["ficha_hogares_cant"]; ?></strong></td>
          <td colspan="2">Hogar Nro. <strong><?=$ficha["ficha_hogar_num"]; ?></strong></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="6">&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="26" bgcolor="#E4E4E4">MIEMBROS DEL HOGAR </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <?
$resPer = mysql_query("SELECT * FROM dbo_persona WHERE Ficha_nro = $idFicha AND blnActivo = '1' ORDER BY Persona_nro");
$num = "1";
		while ($persona = mysql_fetch_array($resPer)) { ?>
<tr>
  <td>
<table width="100%" border="1" cellspacing="0" cellpadding="4">
              <tr>
                <td width="6%" rowspan="4" align="center" style="font-size:56px; font-weight:bold; color:#999999"><?=$num; ?></td>
                <td colspan="2" style="font-size:16px; font-weight:bold;"><?=$persona["Persona_apellido"]; ?>, <?=$persona["Persona_nombre"]; ?>&nbsp;</td>
                <td style="font-size:16px;"><strong>DNI: <?=$persona["Persona_dni_nro"]; ?></strong></td>
                <td>(<?=$persona["Persona_dni_obs"]; ?>)</td>
                </tr>
              <tr>
                <td width="28%" ><strong>Parentesco:</strong> 
                <? if($persona["Persona_parentesco"] == '1') {echo "Jefe/a"; }
				elseif ($persona["Persona_parentesco"] == '2') {echo "C&oacute;nuyge/pareja"; }
				elseif ($persona["Persona_parentesco"] == '3') {echo "Hijo/a"; }
				elseif ($persona["Persona_parentesco"] == '4') {echo "Yerno/Nuera"; }
				elseif ($persona["Persona_parentesco"] == '5') {echo "Nieto/a"; }
				elseif ($persona["Persona_parentesco"] == '6') {echo "Padre/Madre"; }
				elseif ($persona["Persona_parentesco"] == '7') {echo "Suegro/a"; }
				elseif ($persona["Persona_parentesco"] == '8') {echo "Otros familiares"; }
				else { echo "Otros no familiares"; }
				 ?>
                
                </td>
                <td width="18%" ><strong>Edad: </strong><?=$persona["Persona_edad"]; ?></td>
                <td width="17%"><strong>Sexo:</strong> <? if ($persona["Persona_sexo_int"] == '1') {echo "V"; }else{ echo "M"; } ?></td>
                <td width="31%"><strong>Nacionalidad:</strong> 
				<? if($persona["Persona_nacionalidad_int"] == '1') {echo "Argentina"; }
				elseif ($persona["Persona_nacionalidad_int"] == '2') {echo "Brasil"; }
				elseif ($persona["Persona_nacionalidad_int"] == '3') {echo "Bolivia"; }
				elseif ($persona["Persona_nacionalidad_int"] == '4') {echo "Chile"; }
				elseif ($persona["Persona_nacionalidad_int"] == '5') {echo "Paraguay"; }
				elseif ($persona["Persona_nacionalidad_int"] == '6') {echo "Peru"; }
				elseif ($persona["Persona_nacionalidad_int"] == '7') {echo "Uruguay"; }
				elseif ($persona["Persona_nacionalidad_int"] == '8') {echo "Otro"; }
				else {echo "Sin declarar";}
				 ?></td>
                </tr>
              <tr>
                <td><strong>Asiste establ. educ.:</strong> <? if($persona["Persona_asisteEE"] == '1') {echo "SI"; }else { echo "NO"; } ?> </td>
                <td colspan="2"><strong>Nivel educativo: </strong>
				<? if($persona["Persona_educ_nivel"] == '1') {echo "Inicial"; }
				elseif ($persona["Persona_educ_nivel"] == '2') {echo "Primario"; }
				elseif ($persona["Persona_educ_nivel"] == '3') {echo "EGB"; }
				elseif ($persona["Persona_educ_nivel"] == '4') {echo "Secundario"; }
				elseif ($persona["Persona_educ_nivel"] == '5') {echo "Polimodal"; }
				elseif ($persona["Persona_educ_nivel"] == '6') {echo "Superior no univ."; }
				elseif ($persona["Persona_educ_nivel"] == '7') {echo "Universitario o más"; }
				elseif ($persona["Persona_educ_nivel"] == '8') {echo "Educ. especial"; }
				elseif ($persona["Persona_educ_nivel"] == '9') {echo "No alfab./Sin escol."; }
				else {echo "Ignorado";}
				 ?>        
                </td>
                <td><strong>Grado:</strong> <?=$persona["Persona_educ_grado"]; ?></td>
                </tr>
              <tr>
                <td colspan="2"><strong>Sit. ocup.: </strong>
                <? if($persona["Persona_sit_ocup"] == '1') {echo "Trab. por cuenta propia"; }
				elseif ($persona["Persona_sit_ocup"] == '2') {echo "Changas"; }
				elseif ($persona["Persona_sit_ocup"] == '3') {echo "Obrero/empleado rel. dep."; }
				elseif ($persona["Persona_sit_ocup"] == '4') {echo "Serv. dom&eacute;stico"; }
				elseif ($persona["Persona_sit_ocup"] == '5') {echo "Trabajo fliar. no remun."; }
				elseif ($persona["Persona_sit_ocup"] == '6') {echo "Patr&oacute;n"; }
				elseif ($persona["Persona_sit_ocup"] == '7') {echo "Empleo rural transitorio"; }
				elseif ($persona["Persona_sit_ocup"] == '8') {echo "Cartonero"; }
				elseif ($persona["Persona_sit_ocup"] == '9') {echo "Cooperativista"; }
				elseif ($persona["Persona_sit_ocup"] == '10') {echo "Desocupado"; }
				elseif ($persona["Persona_sit_ocup"] == '11') {echo "Jubilado/pensionado"; }
				elseif ($persona["Persona_sit_ocup"] == '12') {echo "Ama de casa"; }
				else {echo "Sin declarar";}
				 ?>
                
                </td>
                <td colspan="2"><strong>Oficio: </strong>
                <? if($persona["Persona_oficio"] == '1') {echo "Computacion"; }
				elseif ($persona["Persona_oficio"] == '2') {echo "Alba&ntilde;il"; }
				elseif ($persona["Persona_oficio"] == '3') {echo "Electricista"; }
				elseif ($persona["Persona_oficio"] == '4') {echo "Pintor"; }
				elseif ($persona["Persona_oficio"] == '5') {echo "Plomero"; }
				elseif ($persona["Persona_oficio"] == '6') {echo "Soldador"; }
				elseif ($persona["Persona_oficio"] == '7') {echo "Docente"; }
				elseif ($persona["Persona_oficio"] == '8') {echo "Jardiner&iacute;a"; }
				elseif ($persona["Persona_oficio"] == '9') {echo "Gastronom&iacute;a"; }
				elseif ($persona["Persona_oficio"] == '10') {echo "Artesano"; }
				elseif ($persona["Persona_oficio"] == '11') {echo "Jardiner&iacute;a"; }
				elseif ($persona["Persona_oficio"] == '12') {echo "Peluquer&iacute;a"; }
				elseif ($persona["Persona_oficio"] == '13') {echo "Corte y confecci&oacute;n"; }
				elseif ($persona["Persona_oficio"] == '14') {echo "Mecan./Metalurg."; }
				elseif ($persona["Persona_oficio"] == '15') {echo "Trabajdador rural"; }
				elseif ($persona["Persona_oficio"] == '16') {echo "Enfermero/a"; }
				elseif ($persona["Persona_oficio"] == '99') {echo "Otros"; }
				elseif ($persona["Persona_oficio"] == '00') {echo "Sin oficio"; }
				else {echo "Sin declarar";}
				 ?></td>
                </tr>
            </table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<?
$num++;
 } ?>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="89%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="28" colspan="3" bgcolor="#e4e4e4">CARACTERISTICAS DE LA VIVIENDA </td>
                    </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">4. Material predominante de los pisos </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cer&aacute;mica, baldosas, mosaico, m&aacute;rmol, etc. </td>
                    <td><? if ($ficha["ficha_p4"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cemento o ladrillo fijo </td>
                    <td><? if ($ficha["ficha_p4"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Tierra o ladrillo suelto </td>
                    <td><? if ($ficha["ficha_p4"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otro</td>
                    <td><? if ($ficha["ficha_p4"] == '9') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%">&nbsp;</td>
                      <td width="89%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>

                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">5. Material predominante de las paredes exteriores </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Ladrillo, piedra, bloque u hormig&oacute;n </td>
                      <td><? if ($ficha["ficha_p5"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Adobe</td>
                      <td><? if ($ficha["ficha_p5"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Madera</td>
                      <td><? if ($ficha["ficha_p5"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Chapa, metal, fibrocemento </td>
                      <td><? if ($ficha["ficha_p5"] == '4') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cart&oacute;n, palma, paja, pl&aacute;stico, mat. de desecho </td>
                      <td><? if ($ficha["ficha_p5"] == '5') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otro</td>
                      <td><? if ($ficha["ficha_p5"] == '9') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%">&nbsp;</td>
                      <td width="89%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">6. Paredes exteriores tienen revoque o revestimiento ext.? </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Si</td>
                      <td><? if ($ficha["ficha_p6"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><? if ($ficha["ficha_p6"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%">&nbsp;</td>
                      <td width="89%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">7. Material predominante cubierta ext. texho </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cubierta asf&aacute;ltica o membrana </td>
                      <td><? if ($ficha["ficha_p7"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Baldosa o losa (sin cubierta) </td>
                      <td><? if ($ficha["ficha_p7"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Teja</td>
                      <td><? if ($ficha["ficha_p7"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Chapa de metal (sin cubierta) </td>
                      <td><? if ($ficha["ficha_p7"] == '4') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Chapa de fibrocemento o pl&aacute;stico </td>
                      <td><? if ($ficha["ficha_p7"] == '5') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Chapa de cart&oacute;n</td>
                      <td><? if ($ficha["ficha_p7"] == '6') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Ca&ntilde;a, palma, tabla o paja con o sin barro</td>
                      <td><? if ($ficha["ficha_p7"] == '7') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otro</td>
                      <td><? if ($ficha["ficha_p7"] == '9') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%">&nbsp;</td>
                      <td width="89%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">8. El techo tiene revestim. interior/cielorraso? </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Si</td>
                      <td><? if ($ficha["ficha_p8"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><? if ($ficha["ficha_p8"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%">&nbsp;</td>
                      <td width="89%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">9. La vivienda tiene electricidad con medido </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Si</td>
                      <td><? if ($ficha["ficha_p9"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><? if ($ficha["ficha_p9"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="6%">&nbsp;</td>
                      <td width="88%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">10. Tiene agua </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Por ca&ntilde;er&iacute;a dentro de la vivienda</td>
                      <td><? if ($ficha["ficha_p10"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>fuera de la vivienda pero dentro del terreno</td>
                      <td><? if ($ficha["ficha_p10"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>fuera del terreno?</td>
                      <td><? if ($ficha["ficha_p10"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="7%">&nbsp;</td>
                      <td width="87%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">11. El agua que usa proviene de </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Red p&uacute;blica </td>
                      <td><? if ($ficha["ficha_p11"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Pozo</td>
                      <td><? if ($ficha["ficha_p11"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Transp. por cisterna </td>
                      <td><? if ($ficha["ficha_p11"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otro</td>
                      <td><? if ($ficha["ficha_p11"] == '9') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="7%">&nbsp;</td>
                      <td width="87%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">12. Esta vivienda </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Tiene ba&ntilde;o  </td>
                      <td><? if ($ficha["ficha_p12"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Tiene letrina </td>
                      <td><? if ($ficha["ficha_p12"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>no tiene ba&ntilde;o/letrina </td>
                      <td><? if ($ficha["ficha_p12"] == '9') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="7%">&nbsp;</td>
                      <td width="87%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">13. En el ba&ntilde;o tiene bot&oacute;n, cadena, mochila </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Si</td>
                      <td><? if ($ficha["ficha_p13"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><? if ($ficha["ficha_p13"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="7%">&nbsp;</td>
                      <td width="87%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">14. El desag&uuml;e del inodoro es: </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>a red p&uacute;blica (cloaca)  </td>
                      <td><? if ($ficha["ficha_p14"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>a c&aacute;mara s&eacute;ptica y pozo ciego </td>
                      <td><? if ($ficha["ficha_p14"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>s&oacute;lo a pozo ciego </td>
                      <td><? if ($ficha["ficha_p14"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>a hoyo, excavaci&oacute;n en la tierra, etc. </td>
                      <td><? if ($ficha["ficha_p14"] == '4') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="7%">&nbsp;</td>
                      <td width="87%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">15. Para cocinar utiliza principalmente:</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>gas de red </td>
                      <td><? if ($ficha["ficha_p15"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>gas envasado </td>
                      <td><? if ($ficha["ficha_p15"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>electricidad</td>
                      <td><? if ($ficha["ficha_p15"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>le&ntilde;a o carb&oacute;n </td>
                      <td><? if ($ficha["ficha_p15"] == '4') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>otro</td>
                      <td><? if ($ficha["ficha_p15"] == '9') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="7%">&nbsp;</td>
                      <td width="79%">&nbsp;</td>
                      <td width="14%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">16. &iquest;cu&aacute;ntas habitaciones p/dormir tiene el hogar?:</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cantidad de habitaciones o piezas: </td>
                      <td><?=$ficha["ficha_p16"]; ?></td>
                    </tr>

                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
                <td width="4%">&nbsp;</td>
                <td width="45%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                    <td width="8%">&nbsp;</td>
                    <td width="32%">&nbsp;</td>
                    <td width="9%">&nbsp;</td>
                    <td width="10%">&nbsp;</td>
                    <td width="41%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="5">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="5" style="border-bottom:1px solid #CCCCCC">17. Su vivienda tiene </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">SI</td>
                    <td align="center">No </td>
                    <td>Especificar</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Uso comercial </td>
                    <td align="center"><? if ($ficha["ficha_p17_1"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    <td align="center"><? if ($ficha["ficha_p17_1"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    <td><?=$ficha["ficha_p17_1_detalle"]; ?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Uso comunitario </td>
                    <td align="center"><? if ($ficha["ficha_p17_2"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    <td align="center"><? if ($ficha["ficha_p17_2"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    <td><?=$ficha["ficha_p17_2_detalle"]; ?></td>
                  </tr>

                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="7%">&nbsp;</td>
                      <td width="87%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">18. La vivienda que ocupa el hogar es </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Propia</td>
                      <td><? if ($ficha["ficha_p18"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Alquilada</td>
                      <td><? if ($ficha["ficha_p18"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Prestada</td>
                      <td><? if ($ficha["ficha_p18"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Ocupada de hecho </td>
                      <td><? if ($ficha["ficha_p18"] == '4') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otra (especifique aqu&iacute; debajo) </td>
                      <td><? if ($ficha["ficha_p18"] == '9') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><?=$ficha["ficha_p18_detalle"]; ?></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="7%">&nbsp;</td>
                      <td width="87%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="28" colspan="3" bgcolor="#E4E4E4">CARACTERISTICAS DEL LOTE/PARCELA </td>
                    </tr>
                    <tr>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">19. El lote que ocupa esta vivienda pertenece: </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>a los ocupantes </td>
                      <td><? if ($ficha["ficha_p19"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>al Municipio </td>
                      <td><? if ($ficha["ficha_p19"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>a la Provincia </td>
                      <td><? if ($ficha["ficha_p19"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>a la Naci&oacute;n </td>
                      <td><? if ($ficha["ficha_p19"] == '4') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otros (especifique aqu&iacute; debajo) </td>
                      <td><? if ($ficha["ficha_p19"] == '5') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>

                    <tr>
                      <td>&nbsp;</td>
                      <td><?=$ficha["ficha_p19_detalle"]; ?></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No sabe </td>
                      <td><? if ($ficha["ficha_p19"] == '6') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="8%">&nbsp;</td>
                      <td width="86%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">20. &iquest;Tiene documentaci&oacute;n? </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Si</td>
                      <td><? if ($ficha["ficha_p20"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><? if ($ficha["ficha_p20"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="8%">&nbsp;</td>
                      <td width="86%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">21. &iquest;que documentaci&oacute;n tiene del lote? </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Ninguna</td>
                      <td><? if ($ficha["ficha_p21"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Escritura</td>
                      <td><? if ($ficha["ficha_p21"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Boleto de compra-venta </td>
                      <td><? if ($ficha["ficha_p21"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Adjudicaci&oacute;n</td>
                      <td><? if ($ficha["ficha_p21"] == '4') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Tenencia precaria/permiso </td>
                      <td><? if ($ficha["ficha_p21"] == '5') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otra documentaci&oacute;n </td>
                      <td><? if ($ficha["ficha_p21"] == '6') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No sabe </td>
                      <td><? if ($ficha["ficha_p21"] == '7') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Docum. presentada: </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><?=$ficha["ficha_p21_detalle"]; ?></td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="8%">&nbsp;</td>
                      <td width="86%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">22. Su lote se inunda </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Casi siempre </td>
                      <td><? if ($ficha["ficha_p22"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>A veces </td>
                      <td><? if ($ficha["ficha_p22"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Nunca</td>
                      <td><? if ($ficha["ficha_p22"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="8%">&nbsp;</td>
                      <td width="84%">&nbsp;</td>
                      <td width="8%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">23. Su lote se inunda </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cuando llueve </td>
                      <td align="center"><? if ($ficha["ficha_p23_1"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cuando se desborda una zanja </td>
                      <td align="center"><? if ($ficha["ficha_p23_2"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cuando se cumulan aguas negras </td>
                      <td align="center"><? if ($ficha["ficha_p23_3"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otras causas (detalle abajo) </td>
                      <td align="center"><? if ($ficha["ficha_p23_4"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><?=$ficha["ficha_p23_4_detalle"]; ?>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="8%">&nbsp;</td>
                      <td width="86%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">24. La calle de acceso a su vivienda se inunda </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Casi siempre </td>
                      <td><? if ($ficha["ficha_p24"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>A veces </td>
                      <td><? if ($ficha["ficha_p24"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Nunca</td>
                      <td><? if ($ficha["ficha_p24"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="8%">&nbsp;</td>
                      <td width="84%">&nbsp;</td>
                      <td width="8%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">25. La calle de acceso a su vivienda se inunda</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cuando llueve </td>
                      <td align="center"><? if ($ficha["ficha_p25_1"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cuando se desborda una zanja </td>
                      <td align="center"><? if ($ficha["ficha_p25_2"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cuando se cumulan aguas negras </td>
                      <td align="center"><? if ($ficha["ficha_p25_3"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otras causas (detalle abajo) </td>
                      <td align="center"><? if ($ficha["ficha_p25_4"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><?=$ficha["ficha_p25_4_detalle"]; ?>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="7%">&nbsp;</td>
                      <td width="87%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">26. &iquest;Pasa un servicio de recolecci&oacute;n...? </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Si</td>
                      <td><? if ($ficha["ficha_p26"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><? if ($ficha["ficha_p26"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="7%">&nbsp;</td>
                      <td width="87%">&nbsp;</td>
                      <td width="6%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #CCCCCC">27. &iquest;Pasa un colectivo a menos de 300m? </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Si</td>
                      <td><? if ($ficha["ficha_p27"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><? if ($ficha["ficha_p27"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" bgcolor="#CCCCCC" height="1"></td>
              </tr>
            <tr>
              <td width="51%">&nbsp;</td>
              <td width="4%">&nbsp;</td>
              <td width="45%">&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="28" colspan="3" bgcolor="#E4E4E4">SALUD</td>
                  </tr>
                <tr>
                  <td width="7%">&nbsp;</td>
                  <td width="87%">&nbsp;</td>
                  <td width="6%">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" style="border-bottom:1px solid #CCCCCC">28. &iquest;Hay miembro con discapacidad permanente? </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>Si</td>
                  <td><? if ($ficha["ficha_p28"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>No</td>
                  <td><? if ($ficha["ficha_p28"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">29. Especifique tipo de discapacidad </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Motriz</td>
                    <td><? if ($ficha["ficha_p29"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Visual</td>
                    <td><? if ($ficha["ficha_p29"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Auditiva</td>
                    <td><? if ($ficha["ficha_p29"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Mental</td>
                    <td><? if ($ficha["ficha_p29"] == '4') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="28" colspan="3" bgcolor="#E4E4E4">OPINIONES/VALORACIONES </td>
                  </tr>
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">30. Principales problemas del barrio: </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><label>1</label></td>
                    <td colspan="2"><?=$ficha["ficha_p30_1"]; ?>&nbsp;</td>
                    </tr>

                  <tr>
                    <td>2</td>
                    <td><?=$ficha["ficha_p30_2"]; ?>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><?=$ficha["ficha_p30_3"]; ?>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">31. &iquest;Que organizaciones o grupos conoce en el barrio? </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><label></label></td>
                    <td colspan="2"><?=$ficha["ficha_p31"]; ?>&nbsp;</td>
                  </tr>

                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              <td>&nbsp;</td>
              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="3" style="border-bottom:1px solid #CCCCCC">32. &iquest;En el &uacute;ltimo a&ntilde;o alg&uacute;n miembro de su familia particip&oacute; en alguna actividad comunitaria?</td>
                </tr>
                <tr>
                  <td width="7%">&nbsp;</td>
                  <td width="87%">Si</td>
                  <td width="6%"><? if ($ficha["ficha_p32"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>No</td>
                  <td><? if ($ficha["ficha_p32"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="28" colspan="3" bgcolor="#E4E4E4">RELEVAMIENTO POR OBSERVACI&Oacute;N </td>
                  </tr>
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">33. Este hogar vive en </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Casa</td>
                    <td><? if ($ficha["ficha_p33"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Rancho</td>
                    <td><? if ($ficha["ficha_p33"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Casilla</td>
                    <td><? if ($ficha["ficha_p33"] == '3') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Departamento</td>
                    <td><? if ($ficha["ficha_p33"] == '4') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Pieza/s en inquilinato/hotel/pensi&oacute;n</td>
                    <td><? if ($ficha["ficha_p33"] == '5') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Local no construido para habitaci&oacute;n </td>
                    <td><? if ($ficha["ficha_p33"] == '6') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otros</td>
                    <td><? if ($ficha["ficha_p33"] == '9') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">34. Focos de basura </td>
                  </tr>
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">Hay</td>
                    <td width="6%"><? if ($ficha["ficha_p34"] == '1') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No hay </td>
                    <td><? if ($ficha["ficha_p34"] == '2') { echo "<strong>X</strong>"; } ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="3" style="border-bottom:1px solid #CCCCCC">35. Nombrar calles y describir si hay arroyos, cables de tensi&oacute;n u otros</td>
                  </tr>
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="87%">&nbsp;</td>
                    <td width="6%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><?=$ficha["ficha_p35"]; ?>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td style="border-bottom:#CCC 1px solid;">Observaciones</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="36"><strong><?=$ficha["ficha_observaciones"]; ?></strong>&nbsp;</td>
        </tr>
        <? if($user["p903"] == '1') {?>
        <tr>
          <td align="right"><table border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td style="color:#5C768B">Modificar datos de la ficha</td>
			    <td>
			      <a href="ficha_modif_form.php?idFicha=<?=$idFicha; ?>&origen=<?=basename($_SERVER['PHP_SELF']); ?>"><img src="imagen/ico_edit.gif" alt="Editar" border="0" title="Editar"/></a></td>
			    </tr></table></td>
        </tr>
        <? } ?>     
        <tr>
          <td align="right">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
<? }?>