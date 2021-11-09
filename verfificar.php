<? session_start();
if($_SESSION[access]==true) { echo "OK, tienes el acceso permitido/r/n"; 

echo "sesion: ".$_SESSION[access];

} else { echo "Error, no tienes permiso."; } ?>
