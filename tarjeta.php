<?
$cadena = "62000014900030002";

$v0 = $cadena[0]*3;
$v1 = $cadena[1]*1;
$v2 = $cadena[2]*3;
$v3 = $cadena[3]*1;
$v4 = $cadena[4]*3;
$v5 = $cadena[5]*1;
$v6 = $cadena[6]*3;
$v7 = $cadena[7]*1;
$v8 = $cadena[8]*3;
$v9 = $cadena[9]*1;
$v10 = $cadena[10]*3;
$v11 = $cadena[11]*1;
$v12 = $cadena[12]*3;
$v13 = $cadena[13]*1;
$v14 = $cadena[14]*3;
$v15 = $cadena[15]*1;
$v16 = $cadena[16]*3;

$suma = $v0+$v1+$v2+$v3+$v4+$v5+$v6+$v7+$v8+$v9+$v10+$v11+$v12+$v13+$v14+$v15+$v16;

$resto = $suma % 10;

if($resto == 0) {$dv = $resto; }else{ $dv = 10-$resto; }

echo "<p>Tarjeta: ".$cadena." | ".$dv."</p>";

?>