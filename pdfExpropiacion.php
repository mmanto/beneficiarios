<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); 
} else{
include ("conec.php");
require ("funciones.php");
define( 'FPDF_FONTPATH', 'font/' );
require_once( 'flowing_block.php' );
}

$resultado = $_SESSION['result_dar_nro_res'];
$cant2 = count($resultado);
unset($_SESSION['result_dar_nro_res']);
$nro_Resolucion = $_GET['nro_Resolucion'];


$partido = $_GET['partidoNombre'];
$localidad = $_GET['localidadNombre'];
$barrio = $_GET['barrioNombre'];
$anioActual = date('Y');

$fechaCertificadoDia = $_GET['fechaCertificadoDia'];
$fechaCertificadoMes = $_GET['fechaCertificadoMes'];
$fechaCertificadoAnio = $_GET['fechaCertificadoAnio'];

$firmante = $_GET['firmante'];

$nroLeyExpropiacion = $_GET['nroLeyExpropiacion'];


$pdf = new PDF();
$ancho_hoja = 175;
$ancho_pie = 160;
$alto_linea_Titulo = 8;
$alto_linea_Texto = 8;
$alto_linea_Texto_Notificacion = 7;
$alto_linea_Pie = 3;
$tamanio_letra_titulo =  13;
$tamanio_letra_texto = 11;
$tamanio_letra_pie = 8;
$tipoDeLetra = 'arial';
$centrado = 'C';
$cursiva = 'I';
$justificado = 'J';



//izquierda, arriba, derecha

$i = 0;


while ($i < $cant2) {

$pdf->SetMargins(15, 30, 10);
	
$circ = $resultado[$i]['Lote_circunscripcion'];
$secc = $resultado[$i]['Lote_seccion'];
$ch = $resultado[$i]['Lote_chacra'];
$qta = $resultado[$i]['Lote_quinta'];
$fr = $resultado[$i]['Lote_fraccion'];
$mz =  $resultado[$i]['Lote_manzana'];
$pc = $resultado[$i]['Lote_parcela'];
$suma_total = $resultado[$i]['Lote_valor_mensura'];
$nro_cuotas = $resultado[$i]['Lote_cant_cuotas']; 
$valor_cuota = $resultado[$i]['Lote_valor_cuota']; 

$pdf->AddPage();

$pdf->SetFont($tipoDeLetra,'BU',$tamanio_letra_titulo);
$pdf->MultiCell(0,8,'CERTIFICADO DE ADJUDICACIÓN',0,'C',false);
$partidoMayuscula = strtoupper($partido);
$barrioMayuscula = strtoupper($barrio);
$pdf->MultiCell(0,10,"BARRIO $barrioMayuscula – PARTIDO $partidoMayuscula",0,'C',FALSE);

$pdf->ln(4);

$pdf->newFlowingBlock( $ancho_hoja, $alto_linea_Texto, '', $justificado );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "\t\t\t\t\t\t\t\t\t\t\t\t" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "La" );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( ' Subsecretaría Social de Tierras, Urbanismo y Vivienda' );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( ' del Ministerio de Infraestructura de la Provincia de Buenos Aires,' );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( ' CERTIFICA' );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( ' que mediante Resolución Nº' );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $nro_Resolucion" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " del entonces Ministerio de Infraestructura de la Provincia de Buenos Aires, el inmueble identificado catastralmente como Circ." );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $circ" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( ", Secc." );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $secc" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( ", Mz" );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $mz" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( ", Pc." );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $pc" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " sito en el barrio" );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " \"$barrio\"" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " de la localidad de" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $localidad" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( ", Partido de" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $partido" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " ha sido adjudicado al Sr/ra." );

$j = $i;

do { 
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$titular = trim($resultado[$i]['Persona_apellido']).", ".trim($resultado[$i]['Persona_nombre']);
$dni = $resultado[$i]['Persona_dni_nro'];
$apellidoNombre= trim($resultado[$i]['Persona_apellido']).", ".trim($resultado[$i]['Persona_nombre']);
$pdf->WriteFlowingBlock( " $titular" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " con" );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " DNI $dni" );	
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );


$i++;	




if($i < $cant2 && $resultado[$i-1]['Lote_nro'] == $resultado[$i]['Lote_nro']){
	if ($i < $cant2 && $resultado[$i]['Lote_nro'] == $resultado[$i+1]['Lote_nro']) {
		$pdf->WriteFlowingBlock( ", " );
	} else {
		$pdf->WriteFlowingBlock( " y " );
	}
} else {
	$pdf->WriteFlowingBlock( ". " );
}


} while ($i < $cant2 && $resultado[$i-1]['Lote_nro'] == $resultado[$i]['Lote_nro']);
$pdf->finishFlowingBlock();

$pdf->ln(1);

$pdf->newFlowingBlock( $ancho_hoja, $alto_linea_Texto, '', $justificado );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "\t\t\t\t\t\t\t\t\t\t\t\t" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "La adjudicación se ha producido en el marco de la Ley de Expropiación Nº $nroLeyExpropiacion por lo cual los adjudicatarios deben cumplir con las obligaciones allí dispuestas bajo apercibimiento, en caso de incumplimiento, de dar de baja la adjudicación y readjudicar el inmueble a otros beneficiarios." );
$pdf->finishFlowingBlock();

$pdf->ln(1);

$pdf->newFlowingBlock( $ancho_hoja, $alto_linea_Texto, '', $justificado );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "\t\t\t\t\t\t\t\t\t\t\t\t" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "En virtud de lo dispuesto en el citado Decreto el/los adjudicatario/s deberán continuar ocupando el inmueble adjudicado, en forma ininterrumpida, con destino a vivienda propia y de su grupo familiar, hasta un plazo mínimo de cinco años desde el otorgamiento de la escritura traslativa de dominio a su nombre." );
$pdf->finishFlowingBlock();

$pdf->ln(1);

$pdf->newFlowingBlock( $ancho_hoja, $alto_linea_Texto, '', $justificado );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "\t\t\t\t\t\t\t\t\t\t\t\t" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "El/los adjudicatario/s deberá/an abonar como precio total por la adquisición del inmueble adjudicado la suma de $" );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $suma_total" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " en" );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $nro_cuotas" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " cuotas mensuales y consecutivas de $" );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $valor_cuota" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " cada una." );
$pdf->finishFlowingBlock();

$pdf->ln(1);

$pdf->newFlowingBlock( $ancho_hoja, $alto_linea_Texto, '', $justificado );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "\t\t\t\t\t\t\t\t\t\t\t\t" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "La escritura traslativa de dominio a favor del/los adjudicatario/s se otorgará ante Escribanía General de Gobierno una vez abonada la totalidad del precio del inmueble." );
$pdf->finishFlowingBlock();

$pdf->ln(1);

$pdf->newFlowingBlock( $ancho_hoja, $alto_linea_Texto, '', $justificado );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "\t\t\t\t\t\t\t\t\t\t\t\t" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "Se extiende el presente en la ciudad de La Plata, a los $fechaCertificadoDia días del mes de $fechaCertificadoMes del $fechaCertificadoAnio." );
$pdf->finishFlowingBlock();



$pdf->AddPage();


$pdf->SetFont($tipoDeLetra,'B',$tamanio_letra_titulo);
$pdf->MultiCell(0,7,'NOTIFICACION DE ADJUDICACION',0,'C',false);
$partidoMayuscula = strtoupper($partido);
$barrioMayuscula = strtoupper($barrio);
$pdf->MultiCell(0,10,"BARRIO $barrioMayuscula – PARTIDO $partidoMayuscula",0,'C',FALSE);

$pdf->ln(4);

$pdf->newFlowingBlock( $ancho_hoja, $alto_linea_Texto_Notificacion, '', $justificado );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "En la localidad de $localidad a los ...... días del mes de ............... del año ....... me notifico de la Resolucion Nº" );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $nro_Resolucion" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " dictada por $firmante de Infraestructura de la Provincia de Buenos Aires por la cual se adjudica el inmueble identificado catastralmente como Circ." );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $circ," );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " Secc." );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $secc," );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " Manz." );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $mz," );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " Parcela" );
$pdf->SetFont( $tipoDeLetra, 'B', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " $pc," );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( " del barrio $barrio - Partido de $partido recibiendo copia de la misma." );
$pdf->finishFlowingBlock();

$pdf->newFlowingBlock( $ancho_hoja, $alto_linea_Texto_Notificacion, '', $justificado );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t" );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_texto );
$pdf->WriteFlowingBlock( "Asimismo declaro conocer la situación del inmueble que se me adjudica. Para el supuesto de resultar sucesor a título individual o universal de un anterior adjudicatario," );
$pdf->WriteFlowingBlock( " manifiesto exonerar a la Provincia de cualquier responsabilidad por evicción en los términos de los artículos 2098, 2100, 2101, 2106 y concordantes del Código Civil" );
$pdf->WriteFlowingBlock( " manteniendo a la Provincia indemne frente a cualquier acción de terceros que se funden en los boletos de compraventa anteriormente otorgados y/o rescindidos.¹ " );
$pdf->finishFlowingBlock();

$pdf->ln(3);

do { 

$pdf->ln(4);
	
$titular = trim($resultado[$j]['Persona_apellido']).", ".trim($resultado[$j]['Persona_nombre']);
$apellidoNombre= trim($resultado[$j]['Persona_apellido']).", ".trim($resultado[$j]['Persona_nombre']);
$dni = $resultado[$j]['Persona_dni_nro'];	

$pdf->SetFont($tipoDeLetra,'', $tamanio_letra_texto);
$pdf->Cell(115,10,"$titular - DNI $dni - ",0,0,'L');
$pdf->Cell(65,10,"______________________________",0,1,'R');


$j++;

} while ($j < $cant2 && $resultado[$j-1]['Lote_nro'] == $resultado[$j]['Lote_nro']);
	


$pdf->SetY(220);


$pdf->newFlowingBlock( $ancho_hoja, $alto_linea_Pie, '', $justificado );
$pdf->SetFont( $tipoDeLetra, '', $tamanio_letra_pie );
$pdf->WriteFlowingBlock( "______________________________________________________" );
$pdf->finishFlowingBlock();

$pdf->Ln(2);

$pdf->SetLeftMargin(25);

$pdf->newFlowingBlock( $ancho_pie, $alto_linea_Pie, '', $justificado );
$pdf->SetFont( $tipoDeLetra, $cursiva, $tamanio_letra_pie );
$pdf->WriteFlowingBlock( "¹ El art. 2098 del Código Civil textualmente expresa.\" Las partes sin embargo pueden aumentar, disminuir, o suprimir la obligación que nace de la evicción.\"" );
$pdf->finishFlowingBlock();

$pdf->newFlowingBlock( $ancho_pie, $alto_linea_Pie, '', $justificado );
$pdf->SetFont( $tipoDeLetra, $cursiva, $tamanio_letra_pie );
$pdf->WriteFlowingBlock( "El art. 2100 del Código Civil textualmente expresa:\" La exclusión o renuncia de cualquier responsabilidad , no exime de la responsabilidad por la evicción, y el vencido tendrá derecho a repetir el precio que pagó al enajenante, aunque no los daños e intereses.\"" );
$pdf->finishFlowingBlock();

$pdf->newFlowingBlock( $ancho_pie, $alto_linea_Pie, '', $justificado );
$pdf->SetFont( $tipoDeLetra, $cursiva, $tamanio_letra_pie );
$pdf->WriteFlowingBlock( "El art. 2101 del Código Civil textualmente establece: \"Exceptúense de la disposición del artículo anterior, los casos siguientes:" );
$pdf->finishFlowingBlock();

$pdf->newFlowingBlock( $ancho_pie, $alto_linea_Pie, '', $justificado );
$pdf->SetFont( $tipoDeLetra, $cursiva, $tamanio_letra_pie );
$pdf->WriteFlowingBlock( " 1° Si el enajenante expresamente excluyó su responsabilidad de restituir el precio; o si el adquirente renunció expresamente el derecho de repetirlo;" );
$pdf->finishFlowingBlock();

$pdf->newFlowingBlock( $ancho_pie, $alto_linea_Pie, '', $justificado );
$pdf->SetFont( $tipoDeLetra, $cursiva, $tamanio_letra_pie );
$pdf->WriteFlowingBlock( " 2° Si la enajenación fue a riesgo del adquirente;" );
$pdf->finishFlowingBlock();

$pdf->newFlowingBlock( $ancho_pie, $alto_linea_Pie, '', $justificado );
$pdf->SetFont( $tipoDeLetra, $cursiva, $tamanio_letra_pie );
$pdf->WriteFlowingBlock( " 3° Si cuando hizo la adquisición , sabía el adquirente, o debía saber, el peligro de que sucediese la evicción, y sin embargo renunció a la responsabilidad del enajenante, o consintió en que ella se excluyese. " );
$pdf->finishFlowingBlock();

$pdf->newFlowingBlock( $ancho_pie, $alto_linea_Pie, '', $justificado );
$pdf->SetFont( $tipoDeLetra, $cursiva, $tamanio_letra_pie );
$pdf->WriteFlowingBlock( "El art. 2106 del Código Civil textualmente expresa.” Cuando el adquirente de cualquier modo conocía el peligro de la evicción antes de la adquisición, nada puede reclamar del enajenante por los efectos de la evicción que suceda, a no ser que ésta hubiere sido expresamente convenida." );
$pdf->finishFlowingBlock();

}


$pdf->Output();			
		

?>
  