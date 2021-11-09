<?php

session_start();

require_once($_SESSION['PROJECT_ROOT'] . '/tcpdf_include.php');
require_once($_SESSION['PROJECT_ROOT'] . '/conec.php');
require_once($_SESSION['PROJECT_ROOT'] . '/lib/fecha_util.php');
require_once($_SESSION['PROJECT_ROOT'] . '/lib/monto_util.php');

define ('PDF_MARGEN_IZQUIERDO', 35);
define ('PDF_MARGEN_SUPERIOR', 23);


class GBoletosCompraventa extends TCPDF{
    
    private $boleto = array();
    
    public function Header() {

        $image_file = "imagen/Logo_BA.png";
        
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, 'R', false, false, 0, false, false, false);
        
        $this->SetFont('helvetica', 'B', 20);
        
        //$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
    
    public function config(){
        // set document informationhtml tab
        $this->SetCreator(PDF_CREATOR);
        
        $this->SetTitle('Boleto compraventa');
        
        $this->SetKeywords('boleto, compraventa, subscretaria');
        
        $this->setPrintHeader(false);
        
        $this->setPrintFooter(false);
        
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        $this->SetMargins(PDF_MARGEN_IZQUIERDO, PDF_MARGEN_SUPERIOR, PDF_MARGIN_RIGHT);
        
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        if (@file_exists(dirname(__FILE__).'/lang/es.php')) {
        
            require_once(dirname(__FILE__).'/lang/es.php');
            
            $this->setLanguageArray($l);
        }
        
        $this->SetFont('FreeSans', '', 11);
        
    }
    
    
    function agregar_boleto( $boleto ){
        
        $this->boleto[] = $boleto;
        
    }
    
    function agregar_boletos( $boletos ){
        
        $this->boletos = $boletos;
    
    }
    
    function mostrar( $familias_nro ){
        
        foreach ($familias as $familia) {
            ;
        }
    }
}

class BoletoCompraventa extends TCPDF{
    
    private $contenido = array();
    
    private $consultas = array();
    
    private $localidad_boleto;
    
    private $fecha_letras;
    
    private $tribunales;
    
    private $consulta = "select Familia_domic, partido.Partido_nombre, partido.Partido_intendente_nombre, partido.Partido_municip_domicilio,
				    Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion, 
				    Lote_manzana, Lote_parcela, Lote_subparcela, partido.Partido_nombre, partido.Partido_nro,
				    Plano_num, Plano_aprobado_fecha, Familia_montoadj, Familia_montoadj_cuotas, Familia_montoadj_cuota_valor,
				    Planvivienda_nro, Familia_decreto_compra
					from mytierras.dbo_familia familia
					inner join mytierras.dbo_partido partido
				on familia.Partido_nro = partido.Partido_nro 
				where familia.Familia_nro = ";
    
    
    public function Header() {

        $image_file = "imagen/Logo_BA.png";

        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, 'R', false, false, 0, false, false, false);

        $this->SetFont('helvetica', 'B', 20);

    }
    
    public function config(){

        $this->SetCreator(PDF_CREATOR);
        $this->SetTitle('Boleto compraventa');
        $this->SetKeywords('boleto, compraventa, subscretaria');
        
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
        
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        $this->SetMargins(PDF_MARGEN_IZQUIERDO, PDF_MARGEN_SUPERIOR, PDF_MARGIN_RIGHT);
        
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        if (@file_exists(dirname(__FILE__).'/lang/es.php')) {
            require_once(dirname(__FILE__).'/lang/es.php');
            $this->setLanguageArray($l);
        }
        
        $this->SetFont('FreeSans', '', 11);
        
    }
    
    /**
     *
     * Establece un listado de contenidos con formato html.
     *
     */
    public function carga_datos($familia_decreto_compra, 
						$planvivienda_nro,
						$localidad,
						$fecha,          // -------
						
						$ente_municipal, // Datos del itendente.
						$intendente_nombre,
						$intendente_domicilio,
						$localidad_residencia_intendente, // ------
						
						$id_familia,
						$familia_domic,
						
						$nomencla, // Datos físicos de la parcela.
						$partido_nombre,
						$partido_nro,
						$caracteristica,
						$fecha_plano_aprobado, //----------------
						
						$monto_terreno, // Montos y cuotas.
						$vencimiento_primera_cuota,
						$cant_cuotas,
						$monto_cuota){ // -----------------
            
            
            $titulo = '<div style="margin-top:0px;">' . '<img src="http://localhost/beneficiarios/imagen/Logo_BA.png"  width="70" height="38" style="text-align:rigth;">' .
            '<h1 style="text-align:center">BOLETO DE COMPRAVENTA</h1></div>';
            
            $contenido = '<p style="text-align:justify">En la localidad de ' . $localidad . ", a los " . trim($fecha) . ", por una parte la Municipalidad de " . $ente_municipal   .
            " representada en este acto por el Sr/a. intendente municipal, " . $intendente_nombre . ", con domicilio " . $intendente_domicilio .
            " de la localidad de " . $localidad_residencia_intendente . ", en adelante la MUNICIPALIDAD, y por la otra " .
            
            $str_contraparte = "";
            
            $pc = new PersonaController();
            
            $integrantes = $pc->obtener_integrantes_familia($id_familia);
            
	    $cant_integrantes = count( $integrantes );
	    
                if ( $cant_integrantes == 1 ){
			$str_contraparte .= $integrantes[0]->get_nombre_completo() . ", DNI " . number_format( $integrantes[0]->get_dni_nro(), 0,"","." ) .
			", de nacionalidad " . $integrantes[0]->get_nacionalidad() .
			", con fecha de nacimiento el " . $integrantes[0]->get_fecha_nacimiento() .
			", hijo/a de " . trim($integrantes[0]->get_madre_nombrecompleto()) . " y " .
			$integrantes[0]->get_padre_nombrecompleto() . ", de estado civil " . $integrantes[0]->get_estado_civil() . 
			", con domicilio en " . $familia_domic . ", en adelante el COMPRADOR,  ";
			$plural_singular_comprador = 'el COMPRADOR';
		}else{
			foreach( $integrantes as $key=>$integrante ){
				$str_contraparte .= $integrante->get_nombre_completo() . ", DNI " . number_format( $integrante->get_dni_nro(), 0,"","." ) .
				", de nacionalidad " . $integrante->get_nacionalidad() .
				", con fecha de nacimiento el " . $integrante->get_fecha_nacimiento() .
				", hijo/a de " . trim($integrante->get_madre_nombrecompleto()) . " y " .
				$integrante->get_padre_nombrecompleto() . ", de estado civil " . $integrante->get_estado_civil() . 
				", con domicilio en " . $familia_domic  ;  
				
				if ( $key < count( $integrantes ) -1 ){
					$str_contraparte .= ' y ' ;
				}
			}
			
			$str_contraparte .= ', en adelante los COMPRADORES '; 
			$plural_singular_comprador = 'los COMPRADORES';
		}
            
              
            $str_contraparte .= "se procede a formalizar el presente Boleto de Compraventa, en un todo de acuerdo a las siguientes cláusulas:</p>";
            
            $clausula_1A = '<p style="text-align:justify"><b>CLÁUSULA 1.-</b> La MUNICIPALIDAD vende al '. $plural_singular_comprador .' una parcela identificada catastralmente como ' . $nomencla .
            ", partido de " . $partido_nombre . "(" . $partido_nro . ")" .
            "; originada en el plano de mensura y división aprobado por la Dirección de Geodesia bajo la característica " . $caracteristica .
            " con fecha " . date_format( date_create( $fecha_plano_aprobado ), 'd/m/Y').
            ", registrado por la Agencia de Recaudación de la provincia de Buenos Aires (ARBA) y entrega en este acto la posesión de la misma.</p>";
            $clausula_1B = '<p style="text-align:justify" >' . 'La presente compraventa se realiza en el marco del "Programa Familia Propietaria", representado en este acto por el' .
                " Subsecretario Social de Tierras y Acceso Justo al Hábitat, conforme a lo estipulado por decreto " . $familia_decreto_compra . 
                ", firmado entonces por la Unidad Ejecutora y Coordinadora del Programa Familia Propietaria de la Provincia de Buenos Aires y la MUNICIPALIDAD.</p>";
            
            $clausula_1C = "";
            
	    if ( $planvivienda_nro > 0){
	    
		$q_planvivienda_nombre  = mysql_query('select Planvivienda_nombre from dbo_planvivienda where Planvivienda_nro = ' . $planvivienda_nro);
		
		$item_planvivienda = mysql_fetch_array($q_planvivienda_nombre);
		
		if ($planvivienda_nro == 1 or $planvivienda_nro == 4){
	    
			$clausula_1C = '<p style="text-align:justify">' .
			'En la parcela entregada se encuentra edificada una vivienda construida a través del programa '. $item_planvivienda['Planvivienda_nombre'] .', ' .
			' siendo el monto final de la misma el que determine el Instituto de la Vivienda de la Provincia de Buenos Aires (IVBA) en base a la ' .
			' asistencia financiera otorgada y que oportunamente notificará, firmándose la escritura traslativa de dominio con cláusula ' .
			' hipotecaria a favor de quien se determine para esta operatoria</p>';
			
		}else {
		
			 $clausula_1C = '<p style="text-align:justify">' .
			'En la parcela entregada se encuentra edificada una vivienda construida a través del programa ' .   $item_planvivienda['Planvivienda_nombre'] .', ' .
			' siendo el monto final de la misma el que determine el organismo correspondiente en base a la ' .
			' asistencia financiera otorgada y que oportunamente notificará, firmándose la escritura traslativa de dominio con cláusula ' .
			' hipotecaria a favor de quien se determine para esta operatoria</p>';
			
		    }
		    
	    }
	    
            $cifra = new Cifra();
            
            $monto = $cifra->traducir( $monto_terreno );
            
            $clausula_2 = '<p style="text-align:justify"><b>CLÁUSULA 2.-</b> El monto del terreno se fija en la suma de ' . $monto . "($" . $monto_terreno . ".-)" . " correspondiente al monto total de la operación incluída la escritura.</p>";
            
            $cuotas_letras = str_replace( " pesos ", "", $cifra->traducir( $cant_cuotas ) );
            
            $monto_cuota_letras = $cifra->traducir( $monto_cuota );
            
            $clausula_3 = "<p><b>CLÁUSULA 3.-</b> " . ucfirst($plural_singular_comprador) . " se compromente a pagar la parcela en ". $cuotas_letras . "(" . $cant_cuotas .") cuotas mensuales, iguales y consecutivas de ". $monto_cuota_letras .
            "(" . $monto_cuota. ") pagaderas de 1 al 10 de cada mes, venciendo la primera el mes de ". $vencimiento_primera_cuota . ".-</p>";
            
            $clausula_4 = '<p style="text-align:justify"><b>CLÁUSULA 4.-</b> Los importes correspondientes a los pagos mensuales que ' . $plural_singular_comprador . ' abone ingresarán al Fondo Municipal de la Vivienda ' .
                "para ser reinvertidos en la compra de tierras o mejoramiento de la infraestructura básica de los lotes del Programa Familia Propietaria.-</p>";
            $clausula_5 = '<p style="text-align:justify"><b>CLÁUSULA 5.-</b> La escritura traslativa del dominio con cláusula hipotecaria se tramitará por ante la Escribanía General de Gobierno de la Provincia de Buenos Aires.-</p>';
            
            $clausula_6 = '<p style="text-align:justify"><b>CLÁUSULA 6.-</b> ' . ucfirst($plural_singular_comprador) . ' se compromete a destinar el inmueble a vivienda única y de ocupación permante del grupo familiar, ' .
                " declarando expresamente no poseer propiedad alguna bajo pena de Resolución por falsedad de datos.-</p>";
            
            $clausula_7 = '<p style="text-align:justify"><b>CLÁUSULA 7.-</b> El presente boleto de compraventa es de carácter INTRANSFERIBLE por el termino de cinco (5) años, contados a partir de su firma. ' .
                "La MUNICIPALIDAD no aceptará como válida ningún tipo de cesión o venta entre particulares.-</p>";
            $clausula_8 =  '<p style="text-align:justify"><b>CLÁUSULA 8.-</b> La MUNICIPALIDAD reconocerá como legítimo comprador al que figura en el presente boleto de compraventa, siendo el unico ' .
                "con derecho a obtener la escritura traslativa de dominio, a partir de la Escribanía General de Gobierno en el marco de lo estipulado en el Programa Familia propietaria.-</p>";
            $clausula_9 = '<p style="text-align:justify"><b>CLÁUSULA 9.-</b> La RENUNCIA al Programa Familia Propietaria , será el único medio a través del cual podrá llevarse a cabo la devolución del inmueble. ' .
                "En este caso la MUNICIPALIDAD procedera a devolverle al " . $plural_singular_comprador . " los importes en la misma forma y tiempo en que fueron abonados y " .
                "readjudicará el terreno a quien siga en orden de mérito en el listado de suplentes.-</p>";
            
            $clausula_10 = '<p style="text-align:justify"><b>CLÁUSULA 10.-</b> Ante el incumplimiento de lo estipulado en el presente la MUNICIPALIDAD ser reserva el derecho a exigir la devolución '.
                "de la peracela sin necesidad de interpelación judicial alguna, sometiendo las partes a la jurisdicción de los Tribunales Ordinarios de " . $this->tribunales ."</p>";
            
            $clausula_10A = '<p>Refrenda el presente, la Subsecretaria Social de Tierras, Urbanismo y Vivienda, habiéndose retificado lo actuado a través de la Dirección de Urbanizaciones Sociales '.
                "(Programa Familia Propietaria) dependiente de la Dirección Provincial de Tierras, por haberse cumplido con el Convenio oportunamente suscripto." ."</p>";
            
            $clausula_10B = '<p>En prueba de conformidad y aprobación, se firmará el presente en tres (3) ejemplares de un mismo tenor y a un solo efecto en la localidad y fecha "ut-supra" mencionadas.-</p>';
            
            $this->contenido[] =  $titulo . $contenido .$str_contraparte . $clausula_1A . $clausula_1B . $clausula_1C . $clausula_2 . $clausula_3 . $clausula_4 . $clausula_5 . $clausula_6 . $clausula_7 . $clausula_8 . $clausula_9 . $clausula_10 . $clausula_10A . $clausula_10B;
	    //echo $this->contenido[0];	
            
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
            $consulta = $this->consulta . $valor ." and familia.blnActivo = true;";
            
            $this->consultas[$valor] = $consulta;
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
    
    // Retorna una lista de personas integrantes de la familia.
    function contraparte( $familias ){
        
        $pc = new PersonaController();
        
        return $pc->de_varias_familias( $familias );
        
    }
    
    
    /*
     * Obtiene los datos de la base y los envía a preparar.
     */
    function ejecutar_consultas( $familias ){
        foreach ( $this->consultas as $id_familia => $q ){
            
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
	    
	    
            $planvivienda_nro =  $item['Planvivienda_nro'];
	    
	    $nomencla = $circunscripcion . $seccion . $quinta . $chacra . $fraccion . $manzana . $parcela . $subparcela;
	    
	    $familia_decreto_compra = $this->tiene_valor($item,"Familia_decreto_compra");
            
            $contraparte = $this->tiene_valor($item, "Persona_apellido") . ", " .
                $this->tiene_valor($item,"Persona_nombre");
                
                $madre_nombre = $this->tiene_valor($item,"Persona_madre_nombrecompleto");
                
                $padre_nombre = $this->tiene_valor($item,"Persona_padre_nombrecompleto");
                
                
                $this->carga_datos($familia_decreto_compra, $planvivienda_nro,
                    utf8_encode($this->localidad_boleto),
                    $this->fecha_letras, // -------------------------------
                    
                    $this->tiene_valor($item,"Partido_nombre"), // Datos del intendente.
                    $this->tiene_valor($item,"Partido_intendente_nombre"),
                    $this->tiene_valor($item,"Partido_municip_domicilio"),
                    $this->tiene_valor($item,"Partido_nombre"), // ---------------------
                    
                    $id_familia,
                    $this->tiene_valor($item,"Familia_domic"),
                    
                    $nomencla,
                    $this->tiene_valor($item, "Partido_nombre"),
                    $this->tiene_valor($item, "Partido_nro"),
                    $this->tiene_valor($item,"Plano_num"),
                    $this->tiene_valor($item,"Plano_aprobado_fecha"),
                    
                    $this->tiene_valor($item,"Familia_montoadj"),
                    $this->vencimiento_primera_cuota,
                    $this->tiene_valor($item,"Familia_montoadj_cuotas"),
                    $this->tiene_valor($item,"Familia_montoadj_cuota_valor"));
        }
        
        
    }
    
    
    /*
     * Datos comunes a todos los boletos.
     */
    function datos_comun($tribunales, $localidad_boleto, $fecha_letras, $vencimiento_primera_cuota ){
        
        $this->localidad_boleto = $localidad_boleto;
        
        $this->fecha_letras = $fecha_letras;
        
        $this->tribunales = $tribunales;
        
        $this->vencimiento_primera_cuota = $vencimiento_primera_cuota;
        
    }
    
}
?>