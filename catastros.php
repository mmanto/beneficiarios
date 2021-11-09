<?
include ("conec.php");

$usuario = $_POST["usuario"];
$password = $_POST["password"];

/*$SQLuser = mysql_query("SELECT * FROM dbo_usuarios WHERE usuario = $usuario AND password = $password",$link);
$user = mysql_fetch_array($SQLuser);
$usuario_cant = mysql_num_rows($SQLuser);

if($usuario_cant > 1) {echo "Usuario o password incorrecto"}else{
*/
$dir = $usuario;

?>
<html>
<head>
<title>Ley 24.374 informes catastrales</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="787" border="0" cellspacing="0" cellpadding="0" bgcolor="#FF9900">
  <tr bgcolor="#000000" valign="middle"> 
    <td height="112"> 
      <p align="center"><font face="Times New Roman, Times, serif" size="6" color="#FFFFFF"> 
        <img src="TITULO.jpg" width="478" height="100"></font></p>
    </td>
  </tr>
  <tr bgcolor="#FF9900" valign="top"> 
    <td height="3"><font color="#FF9900" size="1">1</font></td>
  </tr>
  <tr bgcolor="#FFFFFF" valign="top"> 
    <td height="301"> 
      <p align="center"><font face="Arial, Helvetica, sans-serif" color="#FFFFFF" size="3"><b> 
        <font color="#000000"><br>
        Usuario: <? /*=$user[usuario]; */?></font><br>
        </b></font></p>

<?php
$directorio=opendir($dir); 
while ($archivo = readdir($directorio))
  echo "<a href='".$archivo."'>".$archivo."</a><br>"; 
closedir($directorio); 
?>

      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <div align="center"><br>
        <font size="2" face="Arial, Helvetica, sans-serif" color="#FFFFFF">Contacto: 
        catastrosley24374@hotmail.com</font></div>
    </td>
  </tr>
  <tr bgcolor="#000000" valign="top"> 
    <td height="10"> 
      <p align="center"><font face="Arial, Helvetica, sans-serif" size="2" color="#FFFFFF">Para 
        descomprimir los archivos de catastro debera descargar el programa winzip<br>
        <a href="http://download.winzip.com/winzip100es.exe"><img src="wz_ico1.gif" width="43" height="42" border="0"></a> 
        </font></p>
      <p align="center"><font face="Arial, Helvetica, sans-serif" size="2" color="#CCCCCC"><i>&copy;2008</i></font></p>
      <p>&nbsp;</p>
    </td>
  </tr>
</table>
</body>
</html>
<? //} ?>
