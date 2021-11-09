<html>
<head>
<title>Problema</title>
</head>
<body>
<?php
  $ar=fopen("tarjetasDePago/resol.txt","w") or
    die("Problemas en la creacion");
  fputs($ar,"hola");
  fputs($ar,"\r\n");
  fputs($ar,"mundo\n");
  fputs($ar,"\n");
  fputs($ar,"--------------------------------------------------------");
  fputs($ar,"\n");
  fclose($ar);
  echo "Los datos se cargaron correctamente.";
  ?>
</body>
</html>