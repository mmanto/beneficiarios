<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include ("cabecera.php");
include ("conec.php");
require ("funciones.php");

$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$idUsuario = $_SESSION["user_id"];
$idDireccion = $user["Direccion_nro"];
$idNivel = $user["Usuario_nivel"];
$usuario_nombre = $user["Nombre"];

$sqlDir = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dir = mysql_fetch_array($sqlDir);
$dirNombre = $dir["Direccion_nombre"];

$sqlDirProv = mysql_query("SELECT * FROM dbo_direccion WHERE Direccion_nro = ".$idDireccion."",$link);
$dirprov = mysql_fetch_array($sqlDirProv);
$dirProvNombre = $dir["Direccion_dirprov"];

//////////////////////////////////////////////////////////////////

$idBarrio = $_GET["idBarrio"];

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
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="5"><h2>Dar de alta nueva ficha </h2></td>
        </tr>
      <tr>
        <td height="30" colspan="5"><a href="proyectos_listar_partido.php?idPartido=<? echo $proyecto["Partido_nro"]; ?>">Volver al listado </a></td>
        </tr>
      <tr>
        <td width="22%">&nbsp;</td>
        <td width="8%">Zona:</td>
        <td width="39%"><input name="ficha_zona" type="text" id="ficha_zona" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="15"/></td>
        <td width="14%" align="center">Ficha Nro.: </td>
        <td width="17%"><input name="ficha_num" type="text" id="ficha_num" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="10" maxlength="8"/></td>
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
        <td width="14%">Lote</td>
        <td colspan="2">Calle/Pasillo</td>
        <td width="23%">Nro.</td>
      </tr>
      <tr>
        <td><input name="ficha_manzana" type="text" id="ficha_manzana" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="0" size="10" maxlength="8"/></td>
        <td><input name="ficha_parcela" type="text" id="ficha_parcela" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="0" size="10" maxlength="8"/></td>
        <td colspan="2"><input name="ficha_calle" type="text" id="ficha_calle" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="0" size="10"/></td>
        <td><input name="ficha_vivnum" type="text" id="ficha_vivnum" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="0" size="10"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Teléfono ref:</td>
        <td><input name="ficha_telefono" type="text" id="ficha_telefono" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="10"/></td>
        <td width="20%" align="center">Num Ref. cartográfica:</td>
        <td width="28%"><input name="ficha_refcarto" type="text" id="ficha_refcarto" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="0" size="10"/></td>
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
          <td height="26" colspan="8" bgcolor="#E4E4E4">DATOS DEL RELEVAMIENTO </td>
        </tr>
        <tr>
          <td colspan="7">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="7">Nombre y apellido del entrevistador </td>
          <td width="21%">Fecha (dd/mm/aaaa) </td>
        </tr>
        <tr>
          <td colspan="7"><input name="ficha_entrevistador" type="text" id="ficha_entrevistador" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="10" maxlength="8"/></td>
          <td><input name="ficha_fecha" type="text" id="ficha_fecha" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="10" maxlength="10"/></td>
        </tr>
        <tr>
          <td height="24" colspan="4"><strong>Entrevista efectiva </strong></td>
          <td colspan="3">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="6%">SI</td>
          <td width="5%"><input name="entefectiva" type="radio" value="1" checked></td>
          <td width="8%">NO</td>
          <td width="12%"><input name="entefectiva" type="radio" value="0"></td>
          <td width="10%">Motivo: </td>
          <td colspan="2"><select name="noentefectiva_motivo">
          	<option value="1" selected="selected">Ausente</option>
			<option value="2">Rechazo</option>
			<option value="3">Viv. vac&iacute;a</option>
			<option value="4">Local comercial</option>
			<option value="5">Lote bald&iacute;o</option>
			<option value="6">Viv. en construcci&oacute;n</option>
			<option value="7">Equipamiento</option>
			<option value="8">Otros</option>
			
			
			</select>          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="3">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td width="18%">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="26" colspan="8" bgcolor="#E4E4E4">DETECCION VIVIENDAS EN LOTE/PARCELA </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="21%">Cant.  viv. en el lote: </td>
          <td width="10%"><input name="ficha_cantviviendas" type="text" id="ficha_cantviviendas" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="4" maxlength="8"/></td>
          <td width="7%">Letra:</td>
          <td width="11%"><input name="ficha_letra" type="text" id="ficha_letra" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="4" maxlength="8"/></td>
          <td width="20%">Cant.  hogares en la viv:</td>
          <td width="4%"><input name="ficha_canthogares" type="text" id="ficha_canthogares" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="4" maxlength="8"/></td>
          <td width="14%">Hogar Nro. </td>
          <td width="13%"><input name="ficha_hogar_num" type="text" id="ficha_hogar_num" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="4" maxlength="8"/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="7">&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="26" bgcolor="#E4E4E4">MIEMBROS DEL HOGAR </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="1" cellspacing="0" cellpadding="4">

            <tr>
              <td width="6%" rowspan="4" style="font-size:56px; font-weight:bold; color:#999999">1</td>
              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Nombre(s)</td>
                </tr>
                <tr>
                  <td><input name="t1_nombre" type="text" id="t1_nombre" size="15" onkeypress="return pulsar(event)"/></td>
                </tr>
              </table></td>
              <td colspan="5" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Apellido(s)</td>
                </tr>
                <tr>
                  <td><input name="t1_apellido" type="text" id="t1_apellido" size="25" onkeypress="return pulsar(event)"/></td>
                </tr>
              </table></td>
              <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Documento</td>
                </tr>
                <tr>
                  <td><input name="t1_doc_nro" type="text" id="t1_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="0" size="10" maxlength="8"/></td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td width="12%" rowspan="2" align="center">Parentesco</td>
              <td width="10%" rowspan="2" align="center">Edad</td>
              <td colspan="2" align="center">Sexo</td>
              <td width="10%" rowspan="2" align="center">Nacion.</td>
              <td colspan="2" align="center">Asiste a E.E. </td>
              <td colspan="2" align="center">Ultimo grado </td>
              <td width="11%" rowspan="2" align="center">Situaci&oacute;n Ocup.</td>
              <td width="11%" rowspan="2" align="center">Oficio</td>
            </tr>
            <tr>
              <td width="5%" align="center">V</td>
              <td width="6%" align="center">M</td>
              <td width="6%" align="center">Si</td>
              <td width="5%" align="center">No</td>
              <td width="10%" align="center">Nivel</td>
              <td width="8%" align="center">Grado</td>
              </tr>
            <tr>
              <td><select name="t1_parentesco" id="t1_parentesco">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select></td>
              <td align="center"><input name="t1_edad" type="text" id="t1_edad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="4" maxlength="8"/></td>
              <td align="center"><input name="t1_sexo" type="radio" value="1" checked="checked" /></td>
              <td align="center"><input name="t1_sexo" type="radio" value="2" /></td>
              <td align="center"><select name="t1_nacion" id="t1_nacion">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select></td>
              <td align="center"><input name="t1_asisteEE" type="radio" value="1" checked="checked" /></td>
              <td align="center"><input name="t1_asisteEE" type="radio" value="2" /></td>
              <td align="center"><select name="t1_nivel" id="t1_nivel">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select></td>
              <td align="center"><input name="t1_grado" type="text" id="t1_grado" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="3" maxlength="8"/></td>
              <td align="center"><select name="t1_sit_ocup" id="t1_sit_ocup">
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select></td>
              <td><select name="t1_oficio" id="t1_oficio">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="99">99</option>
                <option value="00">00</option>
              </select></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="1" cellspacing="0" cellpadding="4">
            <tr>
              <td width="6%" rowspan="4" style="font-size:56px; font-weight:bold; color:#999999">2</td>
              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Nombre(s)</td>
                  </tr>
                  <tr>
                    <td><input name="t2_nombre" type="text" id="t2_nombre" size="15" onkeypress="return pulsar(event)"/></td>
                  </tr>
              </table></td>
              <td colspan="5" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Apellido(s)</td>
                  </tr>
                  <tr>
                    <td><input name="t2_apellido" type="text" id="t2_apellido" size="25" onkeypress="return pulsar(event)"/></td>
                  </tr>
              </table></td>
              <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Documento</td>
                  </tr>
                  <tr>
                    <td><input name="t2_doc_nro" type="text" id="t2_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="0" size="10" maxlength="8"/></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td width="12%" rowspan="2" align="center">Parentesco</td>
              <td width="10%" rowspan="2" align="center">Edad</td>
              <td colspan="2" align="center">Sexo</td>
              <td width="10%" rowspan="2" align="center">Nacion.</td>
              <td colspan="2" align="center">Asiste a E.E. </td>
              <td colspan="2" align="center">Ultimo grado </td>
              <td width="11%" rowspan="2" align="center">Situaci&oacute;n Ocup.</td>
              <td width="11%" rowspan="2" align="center">Oficio</td>
            </tr>
            <tr>
              <td width="5%" align="center">V</td>
              <td width="6%" align="center">M</td>
              <td width="6%" align="center">Si</td>
              <td width="5%" align="center">No</td>
              <td width="10%" align="center">Nivel</td>
              <td width="8%" align="center">Grado</td>
            </tr>
            <tr>
              <td><select name="t2_parentesco" id="t2_parentesco">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
              </select></td>
              <td align="center"><input name="t2_edad" type="text" id="t2_edad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="4" maxlength="8"/></td>
              <td align="center"><input name="t2_sexo" type="radio" value="1" checked="checked" /></td>
              <td align="center"><input name="t2_sexo" type="radio" value="2" /></td>
              <td align="center"><select name="t2_nacion" id="select2">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
              </select></td>
              <td align="center"><input name="t2_asisteEE" type="radio" value="1" checked="checked" /></td>
              <td align="center"><input name="t2_asisteEE" type="radio" value="2" /></td>
              <td align="center"><select name="t2_nivel" id="select3">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
              </select></td>
              <td align="center"><input name="t2_grado" type="text" id="t2_grado" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="3" maxlength="8"/></td>
              <td align="center"><select name="t2_sit_ocup" id="select4">
                  <option value="1" selected="selected">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
              </select></td>
              <td><select name="t2_oficio" id="select5">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="99">99</option>
                  <option value="00">00</option>
              </select></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="1" cellspacing="0" cellpadding="4">

            <tr>
              <td width="6%" rowspan="4" style="font-size:56px; font-weight:bold; color:#999999">3</td>
              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Nombre(s)</td>
                </tr>
                <tr>
                  <td><input name="t3_nombre" type="text" id="t3_nombre" size="15" onkeypress="return pulsar(event)"/></td>
                </tr>
              </table></td>
              <td colspan="5" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Apellido(s)</td>
                </tr>
                <tr>
                  <td><input name="t3_apellido" type="text" id="t3_apellido" size="25" onkeypress="return pulsar(event)"/></td>
                </tr>
              </table></td>
              <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Documento</td>
                </tr>
                <tr>
                  <td><input name="t3_doc_nro" type="text" id="t3_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="0" size="10" maxlength="8"/></td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td width="12%" rowspan="2" align="center">Parentesco</td>
              <td width="10%" rowspan="2" align="center">Edad</td>
              <td colspan="2" align="center">Sexo</td>
              <td width="10%" rowspan="2" align="center">Nacion.</td>
              <td colspan="2" align="center">Asiste a E.E. </td>
              <td colspan="2" align="center">Ultimo grado </td>
              <td width="11%" rowspan="2" align="center">Situaci&oacute;n Ocup.</td>
              <td width="11%" rowspan="2" align="center">Oficio</td>
            </tr>
            <tr>
              <td width="5%" align="center">V</td>
              <td width="6%" align="center">M</td>
              <td width="6%" align="center">Si</td>
              <td width="5%" align="center">No</td>
              <td width="10%" align="center">Nivel</td>
              <td width="8%" align="center">Grado</td>
              </tr>
            <tr>
              <td><select name="t3_parentesco" id="t3_parentesco">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select></td>
              <td align="center"><input name="t3_edad" type="text" id="t3_edad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="4" maxlength="8"/></td>
              <td align="center"><input name="t3_sexo" type="radio" value="1" checked="checked" /></td>
              <td align="center"><input name="t3_sexo" type="radio" value="2" /></td>
              <td align="center"><select name="t3_nacion" id="t3_nacion">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select></td>
              <td align="center"><input name="t3_asisteEE" type="radio" value="1" checked="checked" /></td>
              <td align="center"><input name="t3_asisteEE" type="radio" value="2" /></td>
              <td align="center"><select name="t3_nivel" id="t3_nivel">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select></td>
              <td align="center"><input name="t3_grado" type="text" id="t3_grado" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="3" maxlength="8"/></td>
              <td align="center"><select name="t3_sit_ocup" id="t3_sit_ocup">
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select></td>
              <td><select name="t3_oficio" id="t3_oficio">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="99">99</option>
                <option value="00">00</option>
              </select></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="1" cellspacing="0" cellpadding="4">

            <tr>
              <td width="6%" rowspan="4" style="font-size:56px; font-weight:bold; color:#999999">4</td>
              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Nombre(s)</td>
                </tr>
                <tr>
                  <td><input name="t4_nombre" type="text" id="t4_nombre" size="15" onkeypress="return pulsar(event)"/></td>
                </tr>
              </table></td>
              <td colspan="5" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Apellido(s)</td>
                </tr>
                <tr>
                  <td><input name="t4_apellido" type="text" id="t4_apellido" size="25" onkeypress="return pulsar(event)"/></td>
                </tr>
              </table></td>
              <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Documento</td>
                </tr>
                <tr>
                  <td><input name="t4_doc_nro" type="text" id="t4_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="0" size="10" maxlength="8"/></td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td width="12%" rowspan="2" align="center">Parentesco</td>
              <td width="10%" rowspan="2" align="center">Edad</td>
              <td colspan="2" align="center">Sexo</td>
              <td width="10%" rowspan="2" align="center">Nacion.</td>
              <td colspan="2" align="center">Asiste a E.E. </td>
              <td colspan="2" align="center">Ultimo grado </td>
              <td width="11%" rowspan="2" align="center">Situaci&oacute;n Ocup.</td>
              <td width="11%" rowspan="2" align="center">Oficio</td>
            </tr>
            <tr>
              <td width="5%" align="center">V</td>
              <td width="6%" align="center">M</td>
              <td width="6%" align="center">Si</td>
              <td width="5%" align="center">No</td>
              <td width="10%" align="center">Nivel</td>
              <td width="8%" align="center">Grado</td>
              </tr>
            <tr>
              <td><select name="t4_parentesco" id="t4_parentesco">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select></td>
              <td align="center"><input name="t4_edad" type="text" id="t4_edad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="4" maxlength="8"/></td>
              <td align="center"><input name="t4_sexo" type="radio" value="1" checked="checked" /></td>
              <td align="center"><input name="t4_sexo" type="radio" value="2" /></td>
              <td align="center"><select name="t4_nacion" id="t4_nacion">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select></td>
              <td align="center"><input name="t4_asisteEE" type="radio" value="1" checked="checked" /></td>
              <td align="center"><input name="t4_asisteEE" type="radio" value="2" /></td>
              <td align="center"><select name="t4_nivel" id="t4_nivel">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select></td>
              <td align="center"><input name="t4_grado" type="text" id="t4_grado" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="3" maxlength="8"/></td>
              <td align="center"><select name="t4_sit_ocup" id="t4_sit_ocup">
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select></td>
              <td><select name="t4_oficio" id="t4_oficio">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="99">99</option>
                <option value="00">00</option>
              </select></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="1" cellspacing="0" cellpadding="4">

            <tr>
              <td width="6%" rowspan="4" style="font-size:56px; font-weight:bold; color:#999999">5</td>
              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Nombre(s)</td>
                </tr>
                <tr>
                  <td><input name="t5_nombre" type="text" id="t5_nombre" size="15" onkeypress="return pulsar(event)"/></td>
                </tr>
              </table></td>
              <td colspan="5" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Apellido(s)</td>
                </tr>
                <tr>
                  <td><input name="t5_apellido" type="text" id="t5_apellido" size="25" onkeypress="return pulsar(event)"/></td>
                </tr>
              </table></td>
              <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Documento</td>
                </tr>
                <tr>
                  <td><input name="t5_doc_nro" type="text" id="t5_doc_nro" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" value="0" size="10" maxlength="8"/></td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td width="12%" rowspan="2" align="center">Parentesco</td>
              <td width="10%" rowspan="2" align="center">Edad</td>
              <td colspan="2" align="center">Sexo</td>
              <td width="10%" rowspan="2" align="center">Nacion.</td>
              <td colspan="2" align="center">Asiste a E.E. </td>
              <td colspan="2" align="center">Ultimo grado </td>
              <td width="11%" rowspan="2" align="center">Situaci&oacute;n Ocup.</td>
              <td width="11%" rowspan="2" align="center">Oficio</td>
            </tr>
            <tr>
              <td width="5%" align="center">V</td>
              <td width="6%" align="center">M</td>
              <td width="6%" align="center">Si</td>
              <td width="5%" align="center">No</td>
              <td width="10%" align="center">Nivel</td>
              <td width="8%" align="center">Grado</td>
              </tr>
            <tr>
              <td><select name="t5_parentesco" id="t5_parentesco">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select></td>
              <td align="center"><input name="t5_edad" type="text" id="t5_edad" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="4" maxlength="8"/></td>
              <td align="center"><input name="t5_sexo" type="radio" value="1" checked="checked" /></td>
              <td align="center"><input name="t5_sexo" type="radio" value="2" /></td>
              <td align="center"><select name="t5_nacion" id="t5_nacion">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select></td>
              <td align="center"><input name="t5_asisteEE" type="radio" value="1" checked="checked" /></td>
              <td align="center"><input name="t5_asisteEE" type="radio" value="2" /></td>
              <td align="center"><select name="t5_nivel" id="t5_nivel">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select></td>
              <td align="center"><input name="t5_grado" type="text" id="t5_grado" onkeypress="return pulsar(event)" onkeyup = "compUsuario(event)" size="3" maxlength="8"/></td>
              <td align="center"><select name="t5_sit_ocup" id="t5_sit_ocup">
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select></td>
              <td><select name="t5_oficio" id="t5_oficio">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="99">99</option>
                <option value="00">00</option>
              </select></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
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
                    <td><input name="ficha_p4" type="radio" value="1" checked="checked" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Cemento o ladrillo fijo </td>
                    <td><input name="ficha_p4" type="radio" value="2" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Tierra o ladrillo suelto </td>
                    <td><input name="ficha_p4" type="radio" value="3" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otro</td>
                    <td><input name="ficha_p4" type="radio" value="9" /></td>
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
                      <td><input name="ficha_p5" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Adobe</td>
                      <td><input name="ficha_p5" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Madera</td>
                      <td><input name="ficha_p5" type="radio" value="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Chapa, metal, fibrocemento </td>
                      <td><input name="ficha_p5" type="radio" value="4" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cart&oacute;n, palma, paja, pl&aacute;stico, mat. de desecho </td>
                      <td><input name="ficha_p5" type="radio" value="5" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otro</td>
                      <td><input name="ficha_p5" type="radio" value="9" /></td>
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
                      <td><input name="ficha_p6" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><input name="ficha_p6" type="radio" value="2" /></td>
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
                      <td><input name="ficha_p7" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Baldosa o losa (sin cubierta) </td>
                      <td><input name="ficha_p7" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Teja</td>
                      <td><input name="ficha_p7" type="radio" value="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Chapa de metal (sin cubierta) </td>
                      <td><input name="ficha_p7" type="radio" value="4" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Chapa de fibrocemento o pl&aacute;stico </td>
                      <td><input name="ficha_p7" type="radio" value="5" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Chapa de cart&oacute;n</td>
                      <td><input name="ficha_p7" type="radio" value="6" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Ca&ntilde;a, palma, tabla o paja con o sin barro</td>
                      <td><input name="ficha_p7" type="radio" value="7" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otro</td>
                      <td><input name="ficha_p7" type="radio" value="9" /></td>
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
                      <td><input name="ficha_p8" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><input name="ficha_p8" type="radio" value="2" /></td>
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
                      <td><input name="ficha_p9" type="radio" value="1" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><input name="ficha_p9" type="radio" value="2" /></td>
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
                      <td><input name="ficha_p10" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>fuera de la vivienda pero dentro del terreno</td>
                      <td><input name="ficha_p10" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>fuera del terreno?</td>
                      <td><input name="ficha_p10" type="radio" value="3" /></td>
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
                      <td><input name="ficha_p11" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Pozo</td>
                      <td><input name="ficha_p11" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Transp. por cisterna </td>
                      <td><input name="ficha_p11" type="radio" value="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otro</td>
                      <td><input name="ficha_p11" type="radio" value="9" /></td>
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
                      <td><input name="ficha_p12" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Tiene letrina </td>
                      <td><input name="ficha_p12" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>no tiene ba&ntilde;o/letrina </td>
                      <td><input name="ficha_p12" type="radio" value="9" /></td>
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
                      <td><input name="ficha_p13" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><input name="ficha_p13" type="radio" value="2" /></td>
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
                      <td><input name="ficha_p14" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>a c&aacute;mara s&eacute;ptica y pozo ciego </td>
                      <td><input name="ficha_p14" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>s&oacute;lo a pozo ciego </td>
                      <td><input name="ficha_p14" type="radio" value="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>a hoyo, excavaci&oacute;n en la tierra, etc. </td>
                      <td><input name="ficha_p14" type="radio" value="4" /></td>
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
                      <td><input name="ficha_p15" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>gas envasado </td>
                      <td><input name="ficha_p15" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>electricidad</td>
                      <td><input name="ficha_p15" type="radio" value="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>le&ntilde;a o carb&oacute;n </td>
                      <td><input name="ficha_p15" type="radio" value="4" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>otro</td>
                      <td><input name="ficha_p15" type="radio" value="9" /></td>
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
                      <td><select name="ficha_p16" id="ficha_p16">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select></td>
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
                    <td align="center"><input name="ficha_p17_1" type="radio" value="1" /></td>
                    <td align="center"><input name="ficha_p17_1" type="radio" value="2" checked="checked" /></td>
                    <td><input name="ficha_p17_1_detalle" type="text" id="ficha_p17_1_detalle" size="18" onkeypress="return pulsar(event)"/></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Uso comunitario </td>
                    <td align="center"><input name="ficha_p17_2" type="radio" value="1" /></td>
                    <td align="center"><input name="ficha_p17_2" type="radio" value="2" checked="checked" /></td>
                    <td><input name="ficha_p17_2_detalle" type="text" id="ficha_p17_2_detalle" size="18" onkeypress="return pulsar(event)"/></td>
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
                      <td><input name="ficha_p18" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Alquilada</td>
                      <td><input name="ficha_p18" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Prestada</td>
                      <td><input name="ficha_p18" type="radio" value="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Ocupada de hecho </td>
                      <td><input name="ficha_p18" type="radio" value="4" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otra (especifique aqu&iacute; debajo) </td>
                      <td><input name="ficha_p18" type="radio" value="9" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="ficha_p18_detalle" type="text" id="ficha_p18_detalle" size="18" onkeypress="return pulsar(event)"/></td>
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
                      <td><input name="ficha_p19" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>al Municipio </td>
                      <td><input name="ficha_p19" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>a la Provincia </td>
                      <td><input name="ficha_p19" type="radio" value="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>a la Naci&oacute;n </td>
                      <td><input name="ficha_p19" type="radio" value="4" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otros (especifique aqu&iacute; debajo) </td>
                      <td><input name="ficha_p19" type="radio" value="5" /></td>
                    </tr>

                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="ficha_p19_detalle" type="text" id="ficha_p19_detalle" size="18" onkeypress="return pulsar(event)"/></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No sabe </td>
                      <td><input name="ficha_p19" type="radio" value="6" /></td>
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
                      <td><input name="ficha_p20" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><input name="ficha_p20" type="radio" value="2" /></td>
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
                      <td><input name="ficha_p21" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Escritura</td>
                      <td><input name="ficha_p21" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Boleto de compra-venta </td>
                      <td><input name="ficha_p21" type="radio" value="3" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Adjudicaci&oacute;n</td>
                      <td><input name="ficha_p21" type="radio" value="4" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Tenencia precaria/permiso </td>
                      <td><input name="ficha_p21" type="radio" value="5" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otra documentaci&oacute;n </td>
                      <td><input name="ficha_p21" type="radio" value="6" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No sabe </td>
                      <td><input name="ficha_p21" type="radio" value="7" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Detalle abajo docum. presentada </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="ficha_p21_detalle" type="text" id="ficha_p21_detalle" size="18" onkeypress="return pulsar(event)"/></td>
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
                      <td><input name="ficha_p22" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>A veces </td>
                      <td><input name="ficha_p22" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Nunca</td>
                      <td><input name="ficha_p22" type="radio" value="3" /></td>
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
                      <td align="center"><label>
                        <input name="ficha_p23_1" type="checkbox" id="ficha_p23_1" value="1" />
                      </label></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cuando se desborda una zanja </td>
                      <td align="center"><input name="ficha_p23_2" type="checkbox" id="ficha_p23_2" value="1" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cuando se cumulan aguas negras </td>
                      <td align="center"><input name="ficha_p23_3" type="checkbox" id="ficha_p23_3" value="1" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otras causas (detalle abajo) </td>
                      <td align="center"><input name="ficha_p23_4" type="checkbox" id="ficha_p23_4" value="1" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="ficha_p23_4_detalle" type="text" id="ficha_p23_4_detalle" size="18" onkeypress="return pulsar(event)"/></td>
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
                      <td><input name="ficha_p24" type="radio" value="1" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>A veces </td>
                      <td><input name="ficha_p24" type="radio" value="2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Nunca</td>
                      <td><input name="ficha_p24" type="radio" value="3" checked="checked" /></td>
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
                      <td align="center"><label>
                        <input name="ficha_p25_1" type="checkbox" id="ficha_p25_1" value="1" />
                      </label></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cuando se desborda una zanja </td>
                      <td align="center"><input name="ficha_p25_2" type="checkbox" id="ficha_p25_2" value="1" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Cuando se cumulan aguas negras </td>
                      <td align="center"><input name="ficha_p25_3" type="checkbox" id="ficha_p25_3" value="1" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Otras causas (detalle abajo) </td>
                      <td align="center"><input name="ficha_p25_4" type="checkbox" id="ficha_p25_4" value="1" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="ficha_p25_4_detalle" type="text" id="ficha_p25_4_detalle" size="18" onkeypress="return pulsar(event)"/></td>
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
                      <td><input name="ficha_p26" type="radio" value="1" checked="checked" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><input name="ficha_p26" type="radio" value="2" /></td>
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
                      <td><input name="ficha_p27" type="radio" value="1" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>No</td>
                      <td><input name="ficha_p27" type="radio" value="2" /></td>
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
                  <td><input name="ficha_p28" type="radio" value="1" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>No</td>
                  <td><input name="ficha_p28" type="radio" value="2" checked="checked" /></td>
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
                    <td>Sin discapacidad </td>
                    <td><input name="ficha_p29" type="radio" value="0" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Motriz</td>
                    <td><input name="ficha_p29" type="radio" value="1" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Visual</td>
                    <td><input name="ficha_p29" type="radio" value="2" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Auditiva</td>
                    <td><input name="ficha_p29" type="radio" value="3" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Mental</td>
                    <td><input name="ficha_p29" type="radio" value="4" /></td>
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
                    <td colspan="2"><textarea name="ficha_p30_1" cols="35" id="ficha_p30_1"></textarea></td>
                    </tr>

                  <tr>
                    <td>2</td>
                    <td><textarea name="ficha_p30_2" cols="35" id="ficha_p30_2"></textarea></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><textarea name="ficha_p30_3" cols="35" id="ficha_p30_3"></textarea></td>
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
                    <td colspan="2"><textarea name="ficha_p31" cols="35" id="ficha_p31"></textarea></td>
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
                  <td width="6%"><input name="ficha_p32" type="radio" value="1" checked="checked" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>No</td>
                  <td><input name="ficha_p32" type="radio" value="2" /></td>
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
                    <td><input name="ficha_p33" type="radio" value="1" checked="checked" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Rancho</td>
                    <td><input name="ficha_p33" type="radio" value="2" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Casilla</td>
                    <td><input name="ficha_p33" type="radio" value="3" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Departamento</td>
                    <td><input name="ficha_p33" type="radio" value="4" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Pieza/s en inquilinato/hotel/pensi&oacute;n</td>
                    <td><input name="ficha_p33" type="radio" value="5" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Local no construido para habitaci&oacute;n </td>
                    <td><input name="ficha_p33" type="radio" value="6" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>Otros</td>
                    <td><input name="ficha_p33" type="radio" value="9" /></td>
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
                    <td width="6%"><input name="ficha_p34" type="radio" value="1" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>No hay </td>
                    <td><input name="ficha_p34" type="radio" value="02" /></td>
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
                    <td><textarea name="ficha_p35" cols="35" id="ficha_p35"></textarea></td>
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
          <td>Observaciones</td>
        </tr>
        <tr>
          <td><textarea name="ficha_observaciones" cols="35" rows="5" id="ficha_observaciones"></textarea></td>
        </tr>
        <tr>
          <td height="100" align="right"><input type="submit" name="Submit" value="Cargar encuesta" /></td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
<? }?>