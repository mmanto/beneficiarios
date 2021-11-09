<?php
//============================================================+
//
// Description : Boleto de compraventa en formato pdf que
//               brinda la librería TCPDF.
//
// Nota: Lo dejo preparado para poder generar con esta clase 
//       una plantilla con diferentes reportes. Le falta refactor.
//
//============================================================+

/**
 * Genera un pdf con una lista de boletos de compraventa 
 * con los datos obtenidos de la base directamente con sql.
 *
 * @author mmanto
 */

require_once('tcpdf_include.php');
require_once('conec.php');
require_once('lib/fecha_util.php');
require_once('lib/monto_util.php');


define ('PDF_MARGEN_IZQUIERDO', 35);
define ('PDF_MARGEN_SUPERIOR', 10);


class BoletoCompraventa extends TCPDF{
    
    private $contenido = array();
    
    private $consultas = array();
    
    private $tiene_vivienda;
    
    private $localidad_boleto;
    
    private $fecha_letras;
    
    private $tribunales;
    
    private $consulta = "select Persona_nro, Partido_nombre, Partido_intendente_nombre, Partido_municip_domicilio,
                            	Persona_apellido, Persona_nombre, Persona_dni_nro,
                                Persona_nacionalidad, Persona_fecha_nac, Persona_madre_nombrecompleto,
                                Persona_padre_nombrecompleto, Estado_civil_nombre, Persona_domicilio, Lote_circunscripcion,
                                Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion,
                                Lote_manzana, Lote_parcela, Lote_subparcela, Partido_nombre, partido.Partido_nro,
                                Plano_num, Plano_aprobado_fecha, Familia_montoadj, Familia_montoadj_cuotas, Familia_monto
                            	from mytierras.dbo_familia familia
                            	inner join mytierras.dbo_partido partido
                                inner join mytierras.dbo_persona persona
                                inner join mytierras.dbo_estado_civil estado_civil
                            on familia.Partido_nro = partido.Partido_nro
                            and familia.Familia_nro = persona.Familia_nro
                            and persona.Estado_civil_nro = estado_civil.Estado_civil_nro
                            where familia.Familia_nro = ";
    
    
    public function Header() {
        // Logo
        $image_file = "imagen/Logo_BA.png";
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, 'R', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        //$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
    
    public function config(){
        // set document informationhtml tab
        $this->SetCreator(PDF_CREATOR);
        $this->SetTitle('Boleto compraventa');
        $this->SetKeywords('boleto, compraventa, subscretaria');
        
        // remove default header/footer
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
        
        // set default monospaced font
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        $this->SetMargins(PDF_MARGEN_IZQUIERDO, PDF_MARGEN_SUPERIOR, PDF_MARGIN_RIGHT);
        
        // set auto page breaks
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        // set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/es.php')) {
            require_once(dirname(__FILE__).'/lang/es.php');
            $this->setLanguageArray($l);
        }
        
        // set font
        $this->SetFont('FreeSans', '', 11);
        
        
    }
    
    /**
     * 
     * Establece un listado de contenidos con formato html.
     * 
     */
    public function carga_datos($tiene_vivienda, // Datos ingresados en preboleto.
                                $localidad,      
                                $fecha,          // -------
        
                                $ente_municipal, // Datos del itendente.
                                $intendente_nombre,
                                $intendente_domicilio,
                                $localidad_residencia_intendente, // ------
        
                                $contraparte, // Datos del comprador 
                                $nacionalidad,
                                $fecha_nacimiento,
                                $nombre_madre,
                                $nombre_padre,
                                $estado_civil, 
                                $domicilio_contraparte,
                                $localidad_contraparte,
                                $dni_contraparte, //------------------
        
                                $nomencla, // Datos físicos de la parcela.
                                $partido_nombre,
                                $partido_nro,
                                $caracteristica, 
                                $fecha_plano_aprobado, //----------------
        
                                $monto_terreno, // Montos y cuotas.
                                $vencimiento_primera_cuota, 
                                $cant_cuotas,
                                $monto_cuota){ // -----------------
        
        
        if ($nombre_padre != ""){
            
            $nombre_padre = " y de " . $nombre_padre;
            
        }
        
        //$logo = '<div style="text-align:right;"><img src="imagen/Logo_BA.png"  width="60" height="30"></div>';
        
        $titulo = '<div style="margin-top:0px;">' . '<img src="imagen/Logo_BA.png"  width="70" height="38" style="text-align:rigth;">' .
        '<h1 style="text-align:center">BOLETO DE COMPRAVENTA</h1></div>';
        
        $contenido = '<p style="text-align:justify">En la localidad de ' . $localidad . ", a los " . trim($fecha) . ", por una parte la Municipalidad de " . $ente_municipal   .
        " representada en este acto por el Sr/a. intendente municipal, " . $intendente_nombre . ", con domicilio " . $intendente_domicilio .
        " de la localidad de " . $localidad_residencia_intendente . ", en adelante la MUNICIPALIDAD, y por la otra " . $contraparte .
        " DNI " . number_format( $dni_contraparte, 0,"","." ) . " de nacionalidad " . $nacionalidad . " con fecha de nacimiento el " . $fecha_nacimiento . " hija de " . trim($nombre_madre) .
        $nombre_padre . ", de estado civil " . $estado_civil .  " con domicilio en " . $domicilio_contraparte . " de la localidad de " . $localidad_contraparte .
        ", en adelante el COMPRADOR, se procede a formalizar el presente Boleto de Compraventa, en un todo de acuerdo a las siguientes cláusulas:</p>";
        
        $clausula_1A = '<p style="text-align:justify"><b>CLÁUSULA 1.-</b> La MUNICIPALIDAD vende al COMPRADOR una parcela identificada catastralmente como ' . $nomencla .
        ", partido de " . $partido_nombre . "(" . $partido_nro . ")" . 
        "; originada en el plano de mensura y división aprobado por la Dirección de Geodesia bajo la característica " . $caracteristica .
        " con fecha " . $fecha_plano_aprobado .
        ", registrado por la Agencia de Recaudación de la provincia de Buenos Aires (ARBA) y entrega en este acto la posesión de la misma.</p>";
        $clausula_1B = '<p style="text-align:justify" >' . 'La presente compraventa se realiza en el marco del "Programa Familia Propietaria", representado en este acto por el' .
            " Subsecretario Social de Tierras, Urbanismo y Vivienda, conforme a lo estipulado por decreto 306-95, " .
            "firmado entonces por la Unidad Ejecutora y Coordinadora del Programa Familia Propietaria de la Provincia de Buenos Aires y la MUNICIPALIDAD.</p>";
        
        $clausula_1C = "";
        
        if ($tiene_vivienda){
               $clausula_1C = '<p style="text-align:justify">En la parcela entregada se encuentra edificada una vivienda construida con el Plan Federal de Construcción de Viviendas, siendo el monto final' .
                " de la misma el que determine el Instituto de la Vivienda de la Provincia de Buenos Aires (IVBA), en base a la asistencia financiera otorgada " .
                "y que oportunamente notificará, firmándose la escritura traslativa de dominio con cláusua hipotecaria a favor de quien se determine para esta operatoria.-</p>";
        }
        
        $cifra = new Cifra();
        
        $monto = $cifra->traducir( $monto_terreno );
        
        $clausula_2 = '<p style="text-align:justify"><b>CLÁUSULA 2.-</b> El monto del terreno se fija en la suma de ' . $monto . "($" . $monto_terreno . ".-)" . " correspondiente al monto total de la operación incluída la escritura.</p>";
        
        $cuotas_letras = str_replace( " pesos ", "", $cifra->traducir( $cant_cuotas ) );
        
        $monto_cuota_letras = $cifra->traducir( $monto_cuota );
        
        $clausula_3 = "<p><b>CLÁUSULA 3.-</b> El COMPRADOR se compromente a pagar la parcela en ". $cuotas_letras . "(" . $cant_cuotas .") cuotas mensuales, iguales y consecutivas de ". $monto_cuota_letras .
        "(" . $monto_cuota. ") pagaderas de 1 al 10 de cada mes, venciendo la primera el mes de ". $vencimiento_primera_cuota . ".-</p>";
        
        $clausula_4 = '<p style="text-align:justify"><b>CLÁUSULA 4.-</b> Los importes correspondientes a los pagos mensuales que el COMPRADOR abone ingresarán al Fondo Municipal de la Vivienda ' .
            "para ser reinvertidos en la compra de tierras o mejoramiento de la infraestructura básica de los lotes del Programa Familia Propietaria.-</p>";
        $clausula_5 = '<p style="text-align:justify"><b>CLÁUSULA 5.-</b> La escritura traslativa del dominio con cláusula hipotecaria se tramitará por ante la Escribanía General de Gobierno de la Provincia de Buenos Aires.-</p>';

        $clausula_6 = '<p style="text-align:justify"><b>CLÁUSULA 6.-</b> El COMPRADOR se compromete a destinar el inmueble a vivienda única y de ocupación permante del grupo familiar, ' .
            " declarando expresamente no poseer propiedad alguna bajo pena de Resolución por falsedad de datos.-</p>";
        
        $clausula_7 = '<p style="text-align:justify"><b>CLÁUSULA 7.-</b> El presente boleto de compraventa es de carácter INTRANSFERIBLE por el termino de cinco (5) años, contados a partir de su firma. ' .
            "La MUNICIPALIDAD no aceptará como válida ningún tipo de cesión o venta entre particulares.-</p>";
        $clausula_8 =  '<p style="text-align:justify"><b>CLÁUSULA 8.-</b> La MUNICIPALIDAD reconocerá como legítimo comprador al que figura en el presente boleto de compraventa, siendo el unico ' .
            "con derecho a obtener la escritura traslativa de dominio, a partir de la Escribanía General de Gobierno en el marco de lo estipulado en el Programa Familia propietaria.-</p>";
        $clausula_9 = '<p style="text-align:justify"><b>CLÁUSULA 9.-</b> La RENUNCIA al Programa Familia Propietaria , será el único medio a través del cual podrá llevarse a cabo la devolución del inmueble. ' .
            "En este caso la MUNICIPALIDAD procedera a devolverle al COMPRADOR los importes en la misma forma y tiempo en que fueron abonados y " .
            "readjudicará el terreno a quien siga en orden de mérito en el listado de suplentes.-</p>";
        
        $clausula_10 = '<p style="text-align:justify"><b>CLÁUSULA 10.-</b> Ante el incumplimiento de lo estipulado en el presente la MUNICIPALIDAD ser reserva el derecho a exigir la devolución '.
            "de la peracela sin necesidad de interpelación judicial alguna, sometiendo las partes a la jurisdicción de los Tribunales Ordinarios de " . $this->tribunales ."</p>";
        
            $clausula_10A = '<p>Refrenda el presente, la Subsecretaria Social de Tierras, Urbanismo y Vivienda, habiéndose retificado lo actuado a través de la Dirección de Urbanizaciones Sociales '.
                "(Programa Familia Propietaria) dependiente de la Dirección Provincial de Tierras, por haberse cumplido con el Convenio oportunamente suscripto." ."</p>";
            
            $clausula_10B = '<p>En prueba de conformidad y aprobación, se firmará el presente en tres (3) ejemplares de un mismo tenor y a un solo efecto en la localidad y fecha "ut-supra" mencionadas.-</p>';
                    
            $this->contenido[] =  $titulo . $contenido . $clausula_1A . $clausula_1B . $clausula_1C . $clausula_2 . $clausula_3 . $clausula_4 . $clausula_5 . $clausula_6 . $clausula_7 . $clausula_8 . $clausula_9 . $clausula_10 . $clausula_10A . $clausula_10B;
        
        
    }
    
    
    public function mostrar(){
        $this->config();
        foreach ($this->contenido as $html){
            $this->AddPage();
            $this->writeHTML($html, true, false, true, false, ' ');
            
        }
        //Close and output PDF document
        $this->Output('boleto_compra_venta.pdf', 'I');
       
    }
    
    /*
     * Arma la cadena sql estableciendo una condición en familia_nro.
     */
    function armar_consultas( $familia_nro ){
        foreach( $familia_nro as $valor ){
            $consulta = $this->consulta . $valor ." and familia.blnActivo = true
                                                    and persona.Persona_baja = 0
                                                    and persona.blnActivo = true;";
            $this->consultas[] = $consulta;
        }
    }

    /*
     * Retorna la cadena en utf8. De esta forma se elimina el problema
     * de codificación de datos obtenidos de la base.
     */
    function tiene_valor( $item, $campo  ){
            $s = isset($item[$campo]) ? $item[$campo] : '';

            return  utf8_encode( $s );
    }
    
    /*
     * Obtiene los datos de la base y los envía a preparar. 
     */
    function ejecutar_consultas(){
        foreach ( $this->consultas as $q ){
            $query  = mysql_query($q);
            $item = mysql_fetch_array($query);

            if ($this->tiene_valor($item,"Lote_circunscripcion") !== "") {
                $circunscripcion = "Circunscripción " . $this->tiene_valor($item,"Lote_circunscripcion");
            }
            
            if ($this->tiene_valor($item,'Lote_seccion') !== ""){
                $seccion = ", Sección " . $this->tiene_valor($item,'Lote_seccion');
            }

            if($this->tiene_valor($item,'Lote_quinta') !=="0"){
                $quinta = ", Quinta ". $this->tiene_valor($item,'Lote_quinta');
            }
            
            if ($this->tiene_valor($item,'Lote_chacra') !=="0"){
                $chacra = ", Chacra ". $this->tiene_valor($item,'Lote_chacra');
            }
            
            if ($this->tiene_valor($item,'Lote_fraccion') !=="0"){
                $fraccion = ", Fracción ". $this->tiene_valor($item,'Lote_fraccion');
            }
            
            if ($this->tiene_valor($item,'Lote_manzana') !==""){
                $manzana = ", Manzana " . $this->tiene_valor($item,'Lote_manzana');
            }
            
            if($this->tiene_valor($item,'Lote_parcela') !== ""){
                $parcela = ", Parcela " . $this->tiene_valor($item,'Lote_parcela');
            }
             
            if($this->tiene_valor($item,'Lote_subparcela') !== "0"){
                $subparcela = ", Subparcela " . $this->tiene_valor($item,'Lote_subparcela');
            }
            
            
            $nomencla = $circunscripcion . $seccion . $quinta . $chacra . $fraccion . $manzana . $parcela . $subparcela;    

            $contraparte = $this->tiene_valor($item, "Persona_apellido") . ", " .
                           $this->tiene_valor($item,"Persona_nombre");
            
            $madre_nombre = $this->tiene_valor($item,"Persona_madre_nombrecompleto");
            
            $padre_nombre = $this->tiene_valor($item,"Persona_padre_nombrecompleto");
                           
            $this->carga_datos($this->tiene_vivienda, // Datos ingresados en preboleto. 
                               utf8_encode($this->localidad_boleto), 
                               $this->fecha_letras, // -------------------------------
                
                               $this->tiene_valor($item,"Partido_nombre"), // Datos del intendente. 
                               $this->tiene_valor($item,"Partido_intendente_nombre"),
                               $this->tiene_valor($item,"Partido_municip_domicilio"),
                               $this->tiene_valor($item,"Partido_nombre"), // ---------------------
                               
                               $contraparte, // Datos de la parte compradora. 
                               $this->tiene_valor($item,"Persona_nacionalidad"), 
                               $this->tiene_valor($item,"Persona_fecha_nac"),
                               $madre_nombre,
                               $padre_nombre, 
                               $this->tiene_valor($item,"Estado_civil_nombre"), 
                               $this->tiene_valor($item,"Persona_domicilio"), 
                               $this->tiene_valor($item,"Partido_nombre"), 
                               $this->tiene_valor($item,"Persona_dni_nro"),
                               $nomencla,
                               $this->tiene_valor($item, "Partido_nombre"),
                               $this->tiene_valor($item, "Partido_nro"),
                               $this->tiene_valor($item,"Plano_num"),
                               $this->tiene_valor($item,"Plano_aprobado_fecha"),

                               $this->tiene_valor($item,"Familia_montoadj"),
                               $this->vencimiento_primera_cuota,
                               $this->tiene_valor($item,"Familia_monto_adjudicado_cuotas"),
                               $this->tiene_valor($item,"Familia_monto_adjudicado_cuota_valor"));
        }
        
    }
    
    
    /*
     * Datos comunes a todos los boletos.
     */
    function datos_comun($tribunales, $tiene_vivienda, $localidad_boleto, $fecha_letras, $vencimiento_primera_cuota ){

        $this->tiene_vivienda = $tiene_vivienda;
        
        $this->localidad_boleto = $localidad_boleto;
        
        $this->fecha_letras = $fecha_letras;
        
        $this->tribunales = $tribunales;
        
        $this->vencimiento_primera_cuota = $vencimiento_primera_cuota;
        
    }
    
}


session_start();

if (!isset($_SESSION["user_id"])) {
    
    header("Location: login.php");
    
}

//============================================================+
// Principal
//============================================================+

// listado de números de familias.

$familias = explode( ",", $_POST['familias'] );

// Datos en común a todos los boletos.
$localidad_boleto = $_POST["localidad_boleto"];
$fecha = $_POST["fecha"];
$tribunales = $_POST["tribunales"];
$vencimiento_primera_cuota = $_POST["ven_pri_cuota"];

$tiene_vivienda = false;
    
if (isset(  $_POST['tiene_vivienda']) && 
            $_POST['tiene_vivienda'] == 'tiene_vivienda'){

        $tiene_vivienda = true;
}

$bcompra_venta = new BoletoCompraventa(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'es_AR.utf8', false);
$bcompra_venta->armar_consultas( $familias );

// fecha en formato dd/mm/yyyy
list($dia, $mes, $anio) = split('[/.-]', $fecha);

$fecha_en_letras = FechaUtil::fecha_en_palabras( $dia, $mes, $anio );

//$vencimiento_primera_cuota = FechaUtil::fecha_en_palabras_ma( $mes, $anio );

$bcompra_venta->datos_comun( $tribunales, $tiene_vivienda, $localidad_boleto, $fecha_en_letras, $vencimiento_primera_cuota );
$bcompra_venta->ejecutar_consultas();
$bcompra_venta->mostrar();

//============================================================+
// Fin principal
//============================================================+
?>