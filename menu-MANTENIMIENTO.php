<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    
} else{

include("cabecera.php");

?>

<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="480" align="center"><h1><img src="imagen/settings.png" width="110" height="110"></h1>
      <h1>Estamos realizando tareas de mantenimiento.</h1>  
      <h2>En breve el sistema estar&aacute; nuevamente<br>
        disponible,
        disculpe las molestias.</h2>
    <p><a href="logout.php">[Salir del sistema]</a></p></td>
  </tr>
</table>

<? include("pie.php"); ?>

<? } ?>
