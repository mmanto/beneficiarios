<? session_start();

include ("conec.php");

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
}else{
	
include ("funciones.php");
include("cabecera.php");
?>
<h2>Cargar nueva rendici&oacute;n de pagos</h2>
<p><a href="sbt-menu.php">Volver al menu</a>
<form action="rendicion-alta.php" method="post">
<table width="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="264" height="36" style="font-size:15px"><strong>Nombre del archivo a procesar:</strong></td>
    <td width="773" style="font-size:15px"><label for="archivo"></label>
      <input name="archivo" type="text" id="archivo" size="16" maxlength="16" style="font-size:15px"/>
      .txt</td>
  </tr>
  <tr>
    <td height="36" colspan="2">Copie y pegue en el siguiente campo el contenido del archivo de texto enviado por el Banco</td>
  </tr>
  <tr>
    <td colspan="2"><textarea name="textArea" cols="170" rows="28" id="textfield"></textarea></td>
    </tr>
  <tr>
    <td height="45" colspan="2" align="right"><input type="submit" name="button" id="button" value="Procesar rendicion" /></td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>
</form>
<? include("pie.php"); 
}

?>