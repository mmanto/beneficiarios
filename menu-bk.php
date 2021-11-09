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
$linkvar = "nbsp567=$log_direccion&qprst645=$log_usuario&ghlst251=$log_nivel";



$hoy = DATE("Y-m-d");
$SQLins_total = mysql_query("SELECT insert_usuario FROM dbo_familia WHERE insert_usuario = $log_usuario",$link);
$cant_insert_total = mysql_num_rows($SQLins_total);

$SQLins_hoy = mysql_query("SELECT insert_usuario FROM dbo_familia WHERE insert_usuario = $log_usuario AND insert_fecha = '".$hoy."'",$link);
$cant_insert_hoy = mysql_num_rows($SQLins_hoy);

include ("cabecera.php");
?>
<table width="576" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="9"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="47%"><h2>Panel de administraci&oacute;n </h2></td>
          <td width="53%" align="right"><span class="user">Usuario: <? echo $usuario_nombre; ?></span><br />            <a href="logout.php">Salir del sistema</a> </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="9" colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td width="12" height="23" bgcolor="#E6E6E6">&nbsp;</td>
    <td width="10" bgcolor="#E6E6E6">&nbsp;</td>
    <td width="170" bgcolor="#E6E6E6"><strong>Alta de beneficios </strong></td>
    <td width="12">&nbsp;</td>
    <td width="10" bgcolor="#E6E6E6">&nbsp;</td>
    <td width="170" bgcolor="#E6E6E6"><strong>B&uacute;squeda</strong></td>
    <td width="12">&nbsp;</td>
    <td width="10" bgcolor="#E6E6E6">&nbsp;</td>
    <td width="170" bgcolor="#E6E6E6"><strong>Exptes. escrituraci&oacute;n </strong></td>
  </tr>
  <tr valign="top">
    <td height="75" valign="top"><p>&nbsp;</p></td>
    <td colspan="2" valign="top"><p><? if ($log_nivel < 6) { ?><a href="censo_alta_form.php"><? } ?>Dar de alta nuevo censo </a></p>
    <p><a href="#">Buscar beneficio por barrio </a> </p>    </td>
    <td valign="top">&nbsp;</td>
    <td colspan="2" valign="top"><p><? if ($log_nivel < 6) { ?><a href="#"><? } ?>Dar de alta persona </a></p>
    <p><a href="persona_buscar_doc.php?<? echo $linkvar; ?>">Buscar beneficio por DNI</a></p>    </td>
    <td valign="top">&nbsp;</td>
    <td colspan="2" valign="middle"><p><a href="expte_esc_alta_form.php">Dar de alta nuevo expte. </a></p>
      <p><a href="exptes_listar.php">Listar expedientes </a>
        </p>
      </p>
	  </td>
  </tr>
  <tr>
    <td height="23" bgcolor="#E6E6E6">&nbsp;</td>
    <td bgcolor="#E6E6E6">&nbsp;</td>
    <td bgcolor="#E6E6E6"><strong>Resoluci&oacute;n</strong></td>
    <td>&nbsp;</td>
    <td bgcolor="#E6E6E6">&nbsp;</td>
    <td bgcolor="#E6E6E6"><strong>DSCE</strong></td>
    <td>&nbsp;</td>
    <td bgcolor="#E6E6E6">&nbsp;</td>
    <td bgcolor="#E6E6E6"><strong>Planos</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><p><? if ($log_nivel < 6) { ?><a href="resolucion_alta.php?<? echo $linkvar; ?>"><? } ?>Dar de alta resoluci&oacute;n</a></p>
    <p><a href="resolucion_buscar.php?<? echo $linkvar; ?>">Buscar beneficio por Resoluci&oacute;n </a></p></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><p><a href="persona_buscar_textarea.php?<? echo $linkvar; ?>">Buscar personas por listado</a></p>
      <p><a href="nota-respuesta-form.php?<?=$linkvar ?>">Confeccionar nota</a> </p></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><p><a href="plano_alta_form.php">Dar de alta nuevo plano </a></p>
      <p><a href="planos_listar.php">Listar planos </a></p></td>
  </tr>
  <tr>
    <td height="23" bgcolor="#E6E6E6">&nbsp;</td>
    <td bgcolor="#E6E6E6">&nbsp;</td>
    <td bgcolor="#E6E6E6"><strong>Estados Familias/Beneficios</strong></td>
    <td>&nbsp;</td>
    <td bgcolor="#E6E6E6">&nbsp;</td>
    <td bgcolor="#E6E6E6"><strong>Gestion Familia - Persona</strong></td>
    <td>&nbsp;</td>
    <td bgcolor="#E6E6E6">&nbsp;</td>
    <td bgcolor="#E6E6E6"><strong>Ley 24374 </strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><p><? if ($log_nivel < 6) { ?><a href="completa_requisitos_filtro.php?<? echo $linkvar; ?>"><? } ?>Completar requisitos</a></p>
    <p><a href="completos_a_resolucion_filtro.php?<? echo $linkvar; ?>">Enviar a Resolución</a></p>
    <p><a href="dar_nro_resolucion_filtro.php?<? echo $linkvar; ?>">Dar número de resolución</a></p>
    <p><a href="reimprimirPdfFiltro.php?<? echo $linkvar; ?>">Reimprimir pdf por resolución</a></p>
    </td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><p><a href="quitarBeneficioFiltro.php?<? echo $linkvar; ?>">Quitar beneficio a una persona</a></p>
      <p><a href="cambiarBeneficioFliaFiltro.php?<?=$linkvar ?>">Cambiar beneficio a una familia</a> </p></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><p><a href="censo_ley_alta_form.php">Dar de alta beneficio</a></p>
    </td>
  </tr> 
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><? echo $cant_insert_hoy."/".$cant_insert_total;  ?></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<?       
include "pie.php";

?>
<? } ?>