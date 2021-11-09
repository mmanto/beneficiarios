<?
include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idBarrio = $_POST["idBarrio"];

if ($_POST["censo_fecha"] == 'dd/mm/aaaa') { $censo_fecha = "0000-00-00"; }else{$censo_fecha = cambiaf_a_mysql($_POST["censo_fecha"]);}

$beneficio_origen = $_POST["beneficio_origen"];


if (!$_POST["lote_circ"] || $_POST["lote_circ"]=='-') {$lote_circ = '0';} else {$lote_circ = $_POST["lote_circ"];};
if (!$_POST["lote_ch"] || $_POST["lote_ch"]=='-') {$lote_ch = '0';} else {$lote_ch = $_POST["lote_ch"];};
if (!$_POST["lote_qta"] || $_POST["lote_qta"]=='-') {$lote_qta = '0';} else {$lote_qta = $_POST["lote_qta"];};
if (!$_POST["lote_fracc"] || $_POST["lote_fracc"]=='-') {$lote_fracc = '0';} else {$lote_fracc = $_POST["lote_fracc"];};
if (!$_POST["lote_manzana"] || $_POST["lote_manzana"]=='-') {$lote_manzana = '0';} else {$lote_manzana = $_POST["lote_manzana"];};
if (!$_POST["lote_parcela"] || $_POST["lote_parcela"]=='-') {$lote_parcela = '0';} else {$lote_parcela = $_POST["lote_parcela"];};
if (!$_POST["lote_subpc"] || $_POST["lote_subpc"]=='-') {$lote_subpc = '0';} else {$lote_subpc = $_POST["lote_subpc"];};

if (!$_POST["resolucion"] || $_POST["resolucion"]=='-') {$familia_resolucion = '0';} else {$familia_resolucion = $_POST["resolucion"];};

$lote_domic = $_POST["domicilio"];

$familia_telefono = $_POST["familia_telefono"];

if ($_POST["doc_completa"]!='1') {$familia_doc_completa = '0';} else {$familia_doc_completa = '1';};

if ($_POST["pagocancelado"]!='1') {$familia_pagocancelado = '0';} else {$familia_pagocancelado = '1';};

$familia_observaciones = $_POST["observaciones"];

$sqlBo = mysql_query("SELECT Partido_nro FROM dbo_barrio WHERE Barrio_nro = $idBarrio");
$barrio = mysql_fetch_array($sqlBo);
$partido = $barrio["Partido_nro"];


//Definicion de variables de persona 1
$t1_apellido = $_POST["t1_apellido"];
$t1_nombre = $_POST["t1_nombre"];
$t1_doc_tipo = $_POST["t1_doc_tipo"];
$t1_doc_nro = $_POST["t1_doc_nro"];
$t1_ecivil = $_POST["t1_ecivil"];
$t1_nacionalidad = $_POST["t1_nacionalidad"];

if ($_POST["t1_fecha_nac"] == 'dd/mm/aaaa') { $t1_fecha_nac = "0000-00-00"; }else{$t1_fecha_nac = cambiaf_a_mysql($_POST["t1_fecha_nac"]);}

$t1_lugar_nac = $_POST["t1_lugar_nac"];
$t1_conyuge_apellido = $_POST["t1_conyuge_apellido"];
$t1_conyuge_nombre = $_POST["t1_conyuge_nombre"];
$t1_padre_apellido = $_POST["t1_padre_apellido"];
$t1_padre_nombre = $_POST["t1_padre_nombre"];
$t1_madre_apellido = $_POST["t1_madre_apellido"];
$t1_madre_nombre = $_POST["t1_madre_nombre"];

//Definicion de variables de persona 2
$t2_apellido = $_POST["t2_apellido"];
$t2_nombre = $_POST["t2_nombre"];
$t2_doc_tipo = $_POST["t2_doc_tipo"];
if (!$_POST["t2_doc_nro"] || $_POST["t2_doc_nro"]=='-') {$t2_doc_nro = '0';}else{$t2_doc_nro = $_POST["t2_doc_nro"];}
$t2_ecivil = $_POST["t2_ecivil"];
$t2_nacionalidad = $_POST["t2_nacionalidad"];
if ($_POST["t2_fecha_nac"] == 'dd/mm/aaaa') { $t2_fecha_nac = "0000-00-00"; }else{$t2_fecha_nac = cambiaf_a_mysql($_POST["t2_fecha_nac"]);}
$t2_lugar_nac = $_POST["t2_lugar_nac"];
$t2_conyuge_apellido = $_POST["t2_conyuge_apellido"];
$t2_conyuge_nombre = $_POST["t2_conyuge_nombre"];
$t2_padre_apellido = $_POST["t2_padre_apellido"];
$t2_padre_nombre = $_POST["t2_padre_nombre"];
$t2_madre_apellido = $_POST["t2_madre_apellido"];
$t2_madre_nombre = $_POST["t2_madre_nombre"];



echo "Fecha censo: ".$censo_fecha."<br>";
echo "Origen: ".$beneficio_origen."<br><br>";
echo "Partido: ".$partido."<br>";
echo "Barrio: ".$idBarrio."<br>";
echo "Circ: ".$lote_circ."<br>";
echo "Ch: ".$lote_ch."<br>";
echo "Qta: ".$lote_qta."<br>";
echo "Fracc: ".$lote_fracc."<br>";
echo "Manzana: ".$lote_manzana."<br>";
echo "Parcela: ".$lote_parcela."<br>";
echo "Subpc: ".$lote_subpc."<br><br>";
echo "Resolucion: ".$familia_resolucion."<br>";
echo "Domicilio: ".$lote_domic."<br>";
echo "Telefono: ".$familia_telefono."<br><br>";
echo "Doc completo: ".$familia_doc_completa."<br>";
echo "Pagos canc: ".$familia_pagocancelado."<br><br>";
echo "Apellido: ".$t1_apellido."<br>";
echo "Nombre: ".$t1_nombre."<br>";
echo "Tipo Doc: ".$t1_doc_tipo."<br>";
echo "Num. Doc: ".$t1_doc_nro."<br>";
echo "Lugar nac.: ".$t1_lugar_nac."<br>";
echo "Fecha nac.: ".$t1_fecha_nac."<br>";
echo "Nacionalidad: ".$t1_nacionalidad."<br>";
echo "Estado civil: ".$t1_ecivil."<br>";
echo "Conyuge apellido: ".$t1_conyuge_apellido."<br>";
echo "Conyuge nombre: ".$t1_conyuge_nombre."<br>";
echo "Padre apellido: ".$t1_padre_apellido."<br>";
echo "Padre nombre: ".$t1_padre_nombre."<br>";
echo "Madre apellido: ".$t1_madre_apellido."<br>";
echo "Madre nombre: ".$t1_madre_nombre."<br><br>";

if ($t2_doc_nro!='0') {
echo "<b>Titular 2</b>";
echo "Apellido: ".$t2_apellido."<br>";
echo "Nombre: ".$t2_nombre."<br>";
echo "Tipo Doc: ".$t2_doc_tipo."<br>";
echo "Num. Doc: ".$t2_doc_nro."<br>";
echo "Lugar nac.: ".$t2_lugar_nac."<br>";
echo "Fecha nac.: ".$t2_fecha_nac."<br>";
echo "Nacionalidad: ".$t2_nacionalidad."<br>";
echo "Estado civil: ".$t2_ecivil."<br>";
echo "Conyuge apellido: ".$t2_conyuge_apellido."<br>";
echo "Conyuge nombre: ".$t2_conyuge_nombre."<br>";
echo "Padre apellido: ".$t2_padre_apellido."<br>";
echo "Padre nombre: ".$t2_padre_nombre."<br>";
echo "Madre apellido: ".$t2_madre_apellido."<br>";
echo "Madre nombre: ".$t2_madre_nombre."<br>";
}else{ echo "No hay titular 2<br>"; }
echo "Observ. :".$familia_observaciones;
?>
<h2>Beneficiario cargado correctamente</h2> 
<p><a href="beneficio_alta_porbarrio_form.php?idBarrio=<? echo $idBarrio; ?>">Cargar otro beneficiario para este mismo barrio</a></p>
<p><a href="barrios_listar.php">Volver al listado de barrios</p>