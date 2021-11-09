<?php 
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php"); 
} else{
include ("conec.php");
require ("funciones.php");
define( 'FPDF_FONTPATH', 'font/' );
require_once( 'flowing_block.php' );
require_once 'numeros.php';
require_once 'numerosALetras.php';
}

$resultado = $_SESSION['result_dar_nro_res'];
$cant2 = count($resultado);
unset($_SESSION['result_dar_nro_res']);
$nro_Resolucion = $_GET['nro_Resolucion'];

$partido = $_GET['partidoNombre'];
$barrio =  $_GET['barrioNombre'];
$IVCargo = $_GET['IVCargo'];
$IVNombre = $_GET['IVNombre'];
$MICargo = $_GET['MICargo'];
$MINombre = $_GET['MINombre'];

$pdf = new PDF();
$ancho_hoja = 110;
$alto_linea_Titulo = 5;
$alto_linea_Texto = 5;
$tamanio_letra_titulo =  13;
$tamanio_letra_texto = 11;
$tipoDeLetra = 'arial';
$justificado = 'J';

$pdf->SetTopMargin(30);
$pdf->SetLeftMargin(20);

$i = 0;


while ($i < $cant2) {

		
$circ = $resultado[$i]['Lote_circunscripcion'];;
$secc = $resultado[$i]['Lote_seccion'];
$ch = $resultado[$i]['Lote_chacra'];
$qta = $resultado[$i]['Lote_quinta'];
$fr = $resultado[$i]['Lote_fraccion'];
$mz =  $resultado[$i]['Lote_manzana'];
$pc = $resultado[$i]['Lote_parcela'];

$pdf->AddPage();

//TODO: Para la funci�n que uso tengo que redondear en 2 decimales
$precioNumeros =  $resultado[$i]['Lote_valor_mensura'];
$precioLetras = numtoletras($precioNumeros);
$cantCuotasNumeros = $resultado[$i]['Lote_cant_cuotas'];
$cantCuotasLetras = NumerosALetras($cantCuotasNumeros);
$cantCuotasLetras = strtoupper($cantCuotasLetras);
$valorCuotasNumeros = $resultado[$i]['Lote_valor_cuota'];
$valorCuotaLetras = numtoletras($valorCuotasNumeros);



$pdf->SetFont($tipoDeLetra,'B',$tamanio_letra_titulo);
$pdf->MultiCell(0,4,'BOLETO DE COMPRAVENTA',0,'C',false);
$partidoMayuscula = strtoupper($partido);
$barrioMayuscula = strtoupper($barrio);
$pdf->MultiCell(0,8,"$barrioMayuscula � $partidoMayuscula",0,'C',FALSE);

$pdf->ln(4);

$pdf->SetFont($tipoDeLetra,'',$tamanio_letra_texto);

//////////////////////////////////////////////////////////////////////////////

$texto = "Entre el Instituto de la Vivienda de la Provincia de Buenos Aires,";
$texto .= " representado en este acto por su";
$texto .= " $IVCargo, $IVNombre,";
$texto .= " con domicilio legal en su sede, Avda. 7 N� 1267 de la ciudad de La Plata,";
$texto .= " en adelante �EL INSTITUTO� por una parte,";
$texto .= " y la Subsecretar�a Social de Tierras, Urbanismo y Vivienda del Ministerio de Infraestructura,";
$texto .= " representada en este acto por el";
$texto .= " $MICargo $MINombre,";
$texto .= " con domicilio legal en Diag. 73 N� 1568 de La Plata,";
$texto .= " en adelante �LA SUBSECRETARIA� y ";

//Loop para los titulares
do { 
$titular = trim($resultado[$i]['Persona_apellido']).", ".trim($resultado[$i]['Persona_nombre']);
$dni = $resultado[$i]['Persona_dni_nro'];
$apellidoNombre= trim($resultado[$i]['Persona_apellido']).", ".trim($resultado[$i]['Persona_nombre']);
$texto .= " $titular con DNI $dni";
$i++;	
//TODO reveer no va punto final en el �ltimo
if ($i < $cant2 && $resultado[$i]['Lote_nro'] == $resultado[$i+1]['Lote_nro']) {
	$texto .= ", ";
} else {
	$texto .= " y";
}

} while ($i < $cant2 && $resultado[$i-1]['Lote_nro'] == $resultado[$i]['Lote_nro']);

$texto .= " con domicilio real y constituido en el inmueble identificado catastralmente como";
$texto .= " CIRC. $circ, SECC. $secc, MANZ. $mz, PARC. $pc,";
$texto .= " del Partido de $partidoMayuscula de la Provincia de Buenos Aires,";
$texto .= " parte a quien en adelante se lo identifica como �EL COMPRADOR� por la otra,";
$texto .= " se conviene en celebrar el presente  BOLETO DE COMPRA � VENTA";
$texto .= " que se ajustar� a las normas para la venta de inmuebles  incluidos en las urbanizaciones";
$texto .= " que ejecuta �EL INSTITUTO� para el desarrollo de  �EL PROGRAMA PRO TIERRA�";
$texto .= " en todo el �mbito de la Provincia, de acuerdo al Decreto N� 815/88";
$texto .= " y contenidas en el r�gimen instituido por Decreto N� 4930/88; Decreto 3066/05,";
$texto .= " Decreto 2935/08, el Convenio de Cooperaci�n y Asistencia T�cnica celebrado entre";
$texto .= " �LA SUBSECRETAR�A� y �EL INSTITUTO� con fecha 10 de julio del 2008";
$texto .= " y registrado bajo el N� 009-059-08, as� como las disposiciones establecidas en la";
$texto .= " Resoluci�n del INSTITUTO DE LA VIVIENDA DE LA PROVINCIA DE BUENOS AIRES,";
$texto .= " N� 4391 de fecha 3 de agosto de 2011, que �EL COMPRADOR�, declara conocer y aceptar";
$texto .= " y con sujeci�n a las cl�usulas que a continuaci�n se consignan.-";

$pdf->MultiCell(180, $alto_linea_Texto, $texto,0, $justificado);


$primera = "PRIMERA: �EL INSTITUTO� vende al �EL COMPRADOR� y este compra con ajuste a las disposiciones precedentemente mencionadas y en las condiciones que se pactan en el presente, el inmueble identificado en el encabezamiento de este Boleto. ----------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $primera,0, $justificado);
$primera2 = "La venta del inmueble se formaliza en el estado y en las condiciones en que se encuentra a la fecha del presente que �EL COMPRADOR� declara conocer y aceptar sin reserva alguna conforme a Notificaci�n Expresa adjunta y con renuncia expresa a interponer cualquier acci�n presente o futura contra �EL INSTITUTO�, por cualquier  causa  quedando a su exclusivo  cargo  lo  gastos que  por  cualquier  concepto pudieran originarse en lo sucesivo, tomando posesi�n del inmueble de plena conformidad en este acto, sirviendo el presente de suficiente constancia de la misma. -----------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $primera2,0, $justificado);

$segunda = "Las partes formalizan la presente operaci�n  sobre";
$segunda .= " la base del PRECIO DEFINITIVO DE PESOS"; 
$segunda .= " $precioLetras ($ $precioNumeros) que �EL COMPRADOR� abonar� en";
$segunda .= " $cantCuotasLetras ($cantCuotasNumeros) cuotas mensuales y consecutivas de PESOS";
$segunda .= " $valorCuotaLetras ($ $valorCuotasNumeros ) cada una. -";
$pdf->MultiCell(180, $alto_linea_Texto, $segunda,0, $justificado);

$tercera = "TERCERA: Las partes convienen que tanto el importe de las cuotas como las actualizaciones por pago fuera de t�rmino fijados en el presente Boleto, ser�n calculados y liquidados conforme las normas legales vigentes en la materia. ------------------------------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $tercera,0, $justificado);

$cuarta = "CUARTA: � LA SUBSECRETARIA� gestionar� el cobro de las sumas debidas con motivo del presente boleto, las eventuales readjudicaciones que deban realizarse del inmueble, como as� tambi�n las tareas conducentes al otorgamiento la escritura traslativa de dominio y/o en su caso, la constituci�n de derecho real de hipoteca a favor de �EL INSTITUTO�. -----------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $cuarta,0, $justificado);

$quinta = "QUINTA: A los efectos de cumplimentar los pagos mensuales �LA SUBSECRETARIA� emitir� las boletas de dep�sito o tarjetas en su caso. En estas boletas figurar�n los pagos y ajustes que correspondan, debiendo el comprador, retirar estas boletas en �LA SUBSECRETARIA�. --------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $quinta,0, $justificado);

$sexta = "SEXTA: El primer servicio de amortizaci�n deber� ser abonado de acuerdo a lo establecido en la notificaci�n de adjudicaci�n oportunamente cursada por �LA SUBSECRETARIA� y recibida de conformidad por �EL COMPRADOR�. ---------------------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $sexta,0, $justificado);

$sexta2 = "Los servicios mensuales restantes con m�s los cargos, que en su caso correspondan de conformidad con lo establecido en este BOLETO, ser�n satisfechos por �EL COMPRADOR� en forma ininterrumpida, entre los d�as PRIMERO (1) y DIEZ (10) de cada uno de los meses inmediatos siguientes al fijado para el pago del primero de los servicios de amortizaci�n. ----------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $sexta2,0, $justificado);

$sexta3 = "Los pagos se acreditar�n mediante dep�sito a efectuar por �EL COMPRADOR� para la cuenta fiscal N� 1397 denominada � Recaudaci�n por cuenta de Terceros� abierta en el Banco de la Provincia de Buenos Aires, Casa Matriz �La Plata. ---------------------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $sexta3,0, $justificado);

$sexta4 = "�LA SUBSECRETARIA� emitir� las boletas o gestionar�  la emisi�n de tarjetas para efectivizar el pago de los servicios de amortizaci�n. La falta de recepci�n de las mismas por parte de �EL COMPRADOR�, cualquiera fuera su causa, no relevar� a �ste de su obligaci�n de abonar los servicios dentro de los t�rminos pactados. ---------------------------------------------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $sexta4,0, $justificado);

$septima = "SEPTIMA: La mora en el pago de los servicios de amortizaci�n  dentro del plazo y en la forma prevista en el plan de financiaci�n acordado para la cancelaci�n del precio de venta del inmueble, determinar� para el deudor moroso la obligaci�n de cancelar igualmente los mismos al valor que figura en la boleta de dep�sito aunque haya tenido vencimiento la cuota correspondiente. En caso de producirse mora en los pagos, �LA SUBSECRETARIA� dispondr� las liquidaciones complementarias que correspondan. Estos ajustes ser�n liquidados autom�ticamente en la cuota siguiente que corresponda, seg�n lo establece la cl�usula tercera.�-----------------------------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $septima, 0, $justificado);

$octava = "OCTAVA: La deuda que resulta de la financiaci�n que se conviene en la cl�usula SEGUNDA o el saldo de la misma a la fecha de la extensi�n de la escritura traslativa de dominio sobre el inmueble objeto de la operaci�n ser� garantizada mediante la constituci�n de derecho real de hipoteca a favor de �EL INSTITUTO� a constituirse en ese acto. ------------------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $octava, 0, $justificado);

$octava2 = "La falta de pago de tres servicios de amortizaci�n consecutivos o como m�ximo cinco alternados por a�o calendario har� exigible el saldo total adeudado, sin necesidad de interpelaci�n judicial o extrajudicial alguna. En el supuesto en que la mora del deudor se produjera antes de otorgarse la escritura traslativa de dominio, �EL INSTITUTO� podr� optar entre exigir el pago del saldo total adeudado dentro de un plazo perentorio e impostergable que no exceder� de TREINTA (30) d�as corridos o bien declarar la rescisi�n del boleto, con perdida para el comprador de todas las sumas abonadas, que quedar�n a favor de  � EL INSTITUTO� en concepto de indemnizaci�n por el uso del bien sin perjuicio de exigir desde entonces el reintegro de la posesi�n del inmueble. Se considerar�n los importes actualizados que hubieran abonado como el pago por el uso del inmueble el que se determinar� conforme al valor locativo del mismo al momento de su rescisi�n. En el supuesto de resultar saldo a favor del comprador una vez deducidos los rubros indicados, deber�  �EL INSTITUTO�, devolverlo actualizado al comprador; caso contrario, de existir deuda a favor de �EL INSTITUTO �, �ste podr� exigir su cobro judicialmente. �------------------------------------------------------------------------------------- ";
$pdf->MultiCell(180, $alto_linea_Texto, $octava2, 0, $justificado);

$octava3 = "El pacto comisorio por falta de pago no podr� hacerse valer despu�s que el adquirente haya abonado el 25%  del precio actualizado, o haya realizado construcciones equivalentes al 50% del precio de compra, ambas actualizadas. �----------------------------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $octava3, 0, $justificado);

$octava4 = "Si la mora se produjera despu�s de constituida la hipoteca, EL acreedor proceder� a la ejecuci�n del cr�dito con ajuste a las cl�usulas de la hipoteca. ------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $octava4, 0, $justificado);

$novena = "NOVENA: En la cancelaci�n anticipada de la deuda, el saldo se determinar� multiplicando el n�mero de cuotas faltantes por el valor de �sta seg�n el �ltimo vencimiento. De igual modo, cuando los adjudicatarios desearen anticipar pagos de cuotas, los importes respectivos se aplicar�n de acuerdo al p�rrafo anterior. �----------------------------------------------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $novena, 0, $justificado);

$novena2 = "El importe respectivo se pondr� a disposici�n de los interesados a requerimiento de estos. A su vez, el pago parcial anticipado implicar� la autom�tica suspensi�n de pagos posteriores, hasta la recepci�n de los nuevos elementos de pago que proveer� �LA SUBSECRETARIA�. --------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $novena2, 0, $justificado);

$decima = "DECIMA: Toda transgresi�n a las normas establecidas por �El INSTITUTO�, �LA SUBSECRETARIA� y/o �EL PROGRAMA�, para la adjudicaci�n  de inmuebles facultar� al �INSTITUTO� a dar por rescindido el presente boleto de pleno derecho y sin necesidad de interpelaci�n judicial o extrajudicial alguna, debiendo procederse a su inmediato desalojo sean quienes fueren sus ocupantes salvo si est�n cumplidos los porcentajes de la cl�usula octava. ----------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $decima, 0, $justificado);

$decima2 = "La perdida de los importes que hubiere abonado, ser� total para el comprador, los que quedar�n a favor de � EL INSTITUTO �, en concepto de indemnizaci�n por el uso del inmueble, a cuyo fin se aplicar� el procedimiento previsto en el art�culo 8� segundo p�rrafo, sin perjuicio de perseguir el cobro de las sumas que adeudare el comprador al momento de disponerse la rescisi�n. ----------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $decima2, 0, $justificado);

$decimoPrimera = "DECIMO PRIMERA: En caso de contienda el comprador se somete con exclusividad a la jurisdicci�n administrativa en un todo de acuerdo a lo dispuesto por el Dec. Ley 7647/70 (T.O. Ley 13.262) atinente sobre la materia. ------------------------------------------------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $decimoPrimera, 0, $justificado);

$decimoSegunda = "DECIMO SEGUNDA: Para todos los efectos legales, judiciales y/o extrajudiciales que pudieran suscitarse con motivo de este boleto, las partes fijan sus domicilios en los lugares indicados en el encabezamiento del presente boleto, someti�ndose a la jurisdicci�n de los tribunales, contencioso administrativo del Departamento Judicial de La Plata. -----------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $decimoSegunda, 0, $justificado);

$decimoTercera = "DECIMO TERCERA: El comprador no podr� transmitir sus derechos hasta tanto d� cumplimiento a la obligaci�n establecida en el art�culo 17� de la ley N� 5.396, para lo cual deber� presentar plano municipal aprobado y final de obra municipal, salvo autorizaci�n de  �LA SUBSECRETARIA� previa fundamentaci�n por el requirente. --------------------------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $decimoTercera, 0, $justificado);

$decimoCuarta = "DECIMO CUARTA: El beneficiario no podr� transmitir el bien gravado, enajenar, dar en uso, usufructo, comodato, locaci�n, la unidad objeto de este contrato sin haber saldado su obligaci�n hipotecaria. ------";
$pdf->MultiCell(180, $alto_linea_Texto, $decimoCuarta, 0, $justificado);

$decimoCuarta2 = "En uno u otro caso �EL COMPRADOR� no podr� oponerse a las inspecciones que �LA SUBSECRETARIA� o �EL INSTITUTO� estimen necesario realizar con el objeto de dar cumplimiento a las disposiciones que regulan la materia. ----------------------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $decimoCuarta2, 0, $justificado);

$decimoQuinta = "DECIMO QUINTA: En caso de que se acreditare que �EL COMPRADOR� y/o cualquier miembro de su grupo familiar a cargo tuviere alg�n otro bien inmueble inscripto a su nombre y/o fuere beneficiario de alg�n programa nacional o provincial que le permita el acceso a una vivienda, hasta la cancelaci�n definitiva de la deuda, se rescindir� la presente operaci�n de pleno derecho sin necesidad de interpelaci�n judicial, para lo cual se le notificar� al interesado en forma fehaciente. --------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $decimoQuinta, 0, $justificado);

$decimoSexta = "DECIMO SEXTA: �EL COMPRADOR� y su grupo familiar har�n efectiva ocupaci�n del inmueble a la fecha del presente, salvo autorizaci�n expresa de �EL INSTITUTO�, previa fundamentaci�n del requirente. El incumplimiento de esta obligaci�n ser� causal de rescisi�n la que se producir� de pleno derecho, y sin necesidad de interpelaci�n judicial. ----------------------------------------------------------------------";
$pdf->MultiCell(180, $alto_linea_Texto, $decimoSexta, 0, $justificado);

$decimoSeptima = "DECIMO SEPTIMA: La escritura traslativa de dominio y la hipoteca, en caso de corresponder, una vez cumplidos todos los requisitos exigidos, ser� otorgada por la Escriban�a General de Gobierno. �----------";
$pdf->MultiCell(180, $alto_linea_Texto, $decimoSeptima, 0, $justificado);

$pdf->Ln(4);

$fin = "En prueba de conformidad se firman dos ejemplares del mismo tenor y a un solo efecto, en la ciudad de La Plata, con fecha  ";
$pdf->MultiCell(180, $alto_linea_Texto, $fin, 0, $justificado);

$i++;
}

$pdf->Output();					

?>