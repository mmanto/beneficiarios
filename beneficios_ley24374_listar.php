<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

/*
$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE idUsuario = ".$_SESSION["user_id"]."",$link);
$user = mysql_fetch_array($SQLuser);
$log_usuario = $_SESSION["user_id"];
$log_direccion = $user["Direccion_nro"];
*/

include ("conec.php");
include ("funciones.php");
include("cabecera.php");


$sql = "SELECT * FROM dbo_familia WHERE Familia_beneficio_origen = '3' AND blnActivo = '1' ORDER BY Partido_nro, Expte_ley_registro";

$res = mysql_query($sql);

$cant = mysql_num_rows($res);


?>

<table width="960" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="9" colspan="4"><h2>Registro beneficios Ley 24374</h2></td>
  </tr>
  <tr>
    <td height="6" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="24" colspan="4" valign="bottom"><a href="sbt-menu.php">Volver</a></td>
  </tr>
  <tr>
    <td height="16" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td width="582" style="font-size:14px"><strong>Total:  <?=$cant; ?> 
    registros</strong></td>
    <td width="311" height="50" align="right">&nbsp;</td>
    <td width="44">&nbsp;</td>
  </tr>
  <tr>
    <td width="23" height="25">&nbsp;</td>
    <td colspan="3"><table width="860" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="49" height="55" align="center" class="titulo_dato">Partido</td>
        <td width="56" align="center" class="titulo_dato">Registro</td>
        <td width="194" align="center" class="titulo_dato">Escribano</td>
        <td width="93" align="center" class="titulo_dato">Expte. Reg.</td>
        <td width="91" align="center" class="titulo_dato">Expte. Cons.</td>
        <td width="340" align="center" class="titulo_dato">Titulares</td>
        <td colspan="2" align="center" class="titulo_dato">Acciones</td>
        </tr>
        <? while ($familia = mysql_fetch_array($res)) {
		$idFamilia = $familia["Familia_nro"]; 	
			
			 ?>       
      <tr>
        <td height="30" align="center"><? echo $familia["Partido_nro"]; ?></td>
        <td height="30" align="center"><? echo $familia["Expte_ley_registro"]; ?>&nbsp;</td>
        <td align="center"><? echo $familia["Expte_ley_escribano_nombre"]; ?></td>
        <td align="center"><? echo $familia["Expte_ley_reg_num"]; ?>&nbsp;</td>
        <td align="center"><? echo $familia["Expte_ley_cons_num"]; ?>&nbsp;</td>
        <td align="center">
          <table width="98%" border="0" cellspacing="0" cellpadding="1"><?
		$res2 = mysql_query("SELECT Persona_apellido, Persona_nombre, Persona_dni_nro FROM dbo_persona WHERE Familia_nro = $idFamilia AND blnActivo = '1' ORDER BY Persona_nro");
			 while ($persona = mysql_fetch_array($res2)){ ?>
        <tr>
          <td width="69%" <? if($persona["Persona_baja"]=='1'){ ?>bgcolor="#FFCCCC"<? } ?>><? echo $persona["Persona_apellido"].", ".$persona["Persona_nombre"]; ?></td>
          <td width="31%" <? if($persona["Persona_baja"]=='1'){  
		  ?>bgcolor="#FFCCCC"<? } ?>>Doc. <? echo number_format($persona['Persona_dni_nro'], 0, '', '.'); ?></td>
        </tr>
        <? } ?>
        </table>
        </td>
        <td width="34" align="center" >
          <a href=javascript:ventana_modif('beneficio_informe.php?idFamilia=<?=$familia["Familia_nro"]; ?>')><img src="imagen/doc.png" width="11" height="16" border="0" title="Ver informe"/></a></td>
        <td width="25" align="center" >-</td>
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