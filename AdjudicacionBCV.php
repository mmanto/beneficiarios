<?php

session_start();

require_once($_SESSION['PROJECT_ROOT'] . '/tcpdf_include.php');
require_once($_SESSION['PROJECT_ROOT'] . '/conec.php');
require_once($_SESSION['PROJECT_ROOT'] . '/lib/fecha_util.php');
require_once($_SESSION['PROJECT_ROOT'] . '/lib/monto_util.php');

define ('PDF_MARGEN_IZQUIERDO', 35);
define ('PDF_MARGEN_SUPERIOR', 23);

class AdjudicacionBCV extends TCPDF{
    
    private $contenido = array();
    
    private $consultas = array();
    
    private $localidad_boleto;
    
    private $fecha_letras;
    
    private $tribunales;
    
    private $administrador_general;
    
    private $nombre_subsecretario;
    
    private $consulta = "select Familia_domic, partido.Partido_nombre, partido.Partido_intendente_nombre, partido.Partido_municip_domicilio,
				    Lote_circunscripcion, Lote_seccion, Lote_chacra, Lote_quinta, Lote_fraccion, 
				    Lote_manzana, Lote_parcela, Lote_subparcela, partido.Partido_nombre, partido.Partido_nro,
				    Plano_num, Plano_aprobado_fecha, Familia_montoadj, Familia_montoadj_cuotas, Familia_montoadj_cuota_valor,
				    familia.Planvivienda_nro, Familia_decreto_compra, Familia_res_adj, Familia_res_adj_fecha, Barrio_nombre
					from mytierras.dbo_familia familia
					inner join mytierras.dbo_partido partido
					on familia.Partido_nro = partido.Partido_nro 
					inner join mytierras.dbo_barrio barrio
					on familia.Barrio_nro = barrio.Barrio_nro
				where familia.Familia_nro = ";
    
    
    public function Header() {

        $image_file = "imagen/Logo_BA.png";

        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, 'R', false, false, 0, false, false, false);
        
        //$this->setFontSubsetting(false);

        //$this->SetFont('helvetica', 'B', 20);

    }
    
    public function config(){

        $this->SetCreator(PDF_CREATOR);
        $this->SetTitle('CERTIFICADO DE ADJUDICACIÓN');
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
        
        $this->setCellHeightRatio(1.6);

        // helvetica trae problemas
        $this->SetFont('FreeSans', '', 10);
        
    }
    
    /**
     *
     * Establece un listado de contenidos con formato html.
     *
     */
    public function carga_datos($res_adj, $res_adj_fecha,$familia_decreto_compra,
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
            
	    
	    $titulo = '<div style="margin-top:0px;">' . 
	    '<img src="http://localhost/beneficiarios/imagen/Logo_BA.png"  width="70" height="38" style="text-align:rigth;">' .
        '<h2 style="text-align:center; ">CERTIFICADO DE ADJUDICACIÓN'.
        '<br>' . strtoupper($partido_nombre) . ' - ' . $localidad .'</h2></div>';
	    

	    $admin_general =  $this->administrador_general ;
	    
	    $datos_integrantes = '';
            
        $pc = new PersonaController();
            
        $integrantes = $pc->obtener_integrantes_familia($id_familia);
            
	    $cant_integrantes = count( $integrantes );
	    
		if ( $cant_integrantes == 1 ){
			
			$datos_integrantes .=  '<b>' . $integrantes[0]->get_nombre_completo() . ", DNI " . number_format( $integrantes[0]->get_dni_nro(), 0,"","." ) . '</b>';

		}else{

			foreach( $integrantes as $key=>$integrante ){
				
				$datos_integrantes .=  '<b>'.$integrante->get_nombre_completo() . ", DNI " . number_format( $integrante->get_dni_nro(), 0,"","." ) . '</b>' ;

				if ( $key < count( $integrantes ) -1 ){
				
					$datos_integrantes .= ' y ' ;
					
				}
			}
		}

            
        $cert_adjudicacion = '<p style="text-align:justify">' .
        
	    ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La Subsecretaría de Hábitar de la Comunidad del Ministerio de Desarrollo de la Comunidad de la Provincia de Buenos Aires,' . 
	    
	    ' CERTIFICA que mediante la Resolución '. $res_adj . ' del Ministerio de Desarrollo de la Comunidad el inmueble '. 
	    
	    ' identificado catastralmente como '. $nomencla . ', sito en el barrio ' . $localidad . 
	    
	    ' del partido de ' . $partido_nombre . ' ha sido adjudicado al sr/sra '. $datos_integrantes . '.</p>';
	    
	    
	    $segundo_parrafo = '<p style="text-align:justify">'.
	    '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La adjudicación se ha producido en el marco del Decreto 2225/95 por lo cual los ' . 
	    ' adjudicatarios deben cumplir con las obligaciones allí dispuestas bajo apercibimiento, ' .
	    ' en caso de incumplimiento, de dar de baja la adjudicación y readjudicar ' . 
	    ' el inmueble a otros beneficiarios.</p>';
	    
	    $tercer_parrafo = '<p style="text-align:justify">'.
	    '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;En virtud de lo dispuesto en el citado Decreto el/los adjudicatario/s deberán continuar ' . 
	    ' ocupando el inmueble adjudicado, en forma ininterrumpida, con destino a vivienda propia '.
	    ' y de su grupo familiar, hasta un plazo mínimo de cinco años desde el otorgamiento de '.
	    'la escritura traslativa de dominio a su nombre.'.
	    '</p>';
	    
	    $cifra = new Cifra();
        $monto = $cifra->traducir( $monto_terreno );
	    $monto_cuota = bcdiv($monto_terreno, $cant_cuotas, 2);
	    $monto_cuota_letras = $cifra->traducir( $monto_cuota );    
	    $cuotas_letras = str_replace( " pesos ", "", $cifra->traducir( $cant_cuotas ) );

	    $cuarto_parrafo = '<p style="text-align:justify">'.
		'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;El/los adjudicatario/s deberá/n abonar como precio total por la adquisición del inmueble '.
		' adjudicado la suma de $'. $monto_terreno .' en '. $cant_cuotas .' cuotas mensuales '.
		' y consecutivas de $'. $monto_cuota.' cada una.';
		
		$quito_parrafo = '<p style="text-align:justify">'.
		'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La escritura traslativa de dominio a favor del/os adjudicatario/s se otorgará ante '. 
		'Escribanía General de Gobierno.</p>';
		
		$sexto_parrafo = '<p style="text-align:justify">'.
		'Se extiende el presente en la ciudad de La Plata, a los '.
		'</p>';
	    
/*	    
	    $cifra = new Cifra();
        $monto = $cifra->traducir( $monto_terreno );
	    $monto_cuota = bcdiv($monto_terreno, $cant_cuotas, 2);
	    $monto_cuota_letras = $cifra->traducir( $monto_cuota );    
	    $cuotas_letras = str_replace( " pesos ", "", $cifra->traducir( $cant_cuotas ) );

	    $segunda = '<p style="text-align:justify"><b>SEGUNDA.-</b>Las partes formalizan la presente operación sobre la base del PRECIO  DEFINITIVO DE ' .
	    strtoupper($monto) . " ($" . $monto_terreno . ".-)"  . ' que “EL COMPRADOR” abonará en '. 
	    strtoupper($cuotas_letras) . '(' . $cant_cuotas .  ')'.
	    
	    ' cuotas mensuales y consecutivas de ' . 
	    strtoupper($monto_cuota_letras) . '($'. $monto_cuota . '.-)' . ' cada una.</p>';
	    
   
*/
	$str = $titulo . $cert_adjudicacion . $segundo_parrafo . $tercer_parrafo . $cuarto_parrafo . $quito_parrafo . $sexto_parrafo;
	
	/*
	 *  Notificación de adjudicación.
	 */
	$b_titulo = $titulo = '<div style="margin-top:0px;">' . '<img src="http://localhost/beneficiarios/imagen/Logo_BA.png"  width="70" height="38" style="text-align:rigth;">' .
            '<h1 style="text-align:center">NOTIFICACIÓN DE ADJUDICACIÓN</h1><h2 style="text-align:center">' . strtoupper($partido_nombre) . ' - ' . $localidad .'</h2></div>';
	
	$b_parrafo_1 = '<p style="text-align:justify">'.
	'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;En la localidad de '. $localidad.' a los ….. días del mes de …………………………… del año …….... me '.
	' notifico de la Resolución '. $res_adj . ' dictada por el Ministro de Desarrollo de la Comunidad '.
	' de la Provincia de Buenos Aires por la cual se adjudica el inmueble identificado '.
	' catastralmente como '. $nomencla .', del barrio '. $localidad.'– '.
	' Partido de '. $partido_nombre.' recibiendo certificación y copia del acto administrativo.'.
	'</p>';
	
	$b_parrafo_2 = '<p style="text-align:justify">'.
	'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Asimismo declaro conocer la situación del inmueble que se me adjudica. Para el supuesto '.
	' de resultar sucesor a título individual o universal de un anterior adjudicatario, '.
	' manifiesto exonerar a la Provincia de cualquier responsabilidad por evicción en los '.
	' términos de los artículos 2098,  2100, 2101, 2106 y concordantes del Código Civil '.
	' manteniendo a la Provincia indemne frente a cualquier acción de terceros que se funden '.
	' en los boletos de compraventa anteriormente otorgados y/o rescindidos. '.	
	'</p>';
	
	$bdatos_integrantes = '';
	foreach( $integrantes as $key=>$integrante ){
	
		$bdatos_integrantes .= '<p style="margin-top:35px;">.........................................................<br>';
		
		$bdatos_integrantes .=  '<b>'. $integrante->get_nombre_completo() . "<br> DNI " . number_format( $integrante->get_dni_nro(), 0,"","." ) .'</b></p>';

	}	
	
	$letra_chica_1 = '<br><br><p style="text-align:justify; font-size: 8px;" >'.
	
	' El art. 2098 del Código Civil textualmente expresa. "Las partes sin embargo pueden aumentar, '.
	' disminuir, o suprimir la obligación que nace de la evicción." <br>';
	
	$letra_chica_2 = 'El art. 2100 del Código Civil textualmente expresa:"La exclusión o renuncia de cualquier responsabilidad , no exime de la responsabilidad por la evicción, y el vencido tendrá derecho a repetir el precio que pagó al enajenante, aunque no los daños e intereses." <br>'.
	
	'El art. 2101 del Código Civil textualmente establece: '.
	' “Exceptúense de la disposición del artículo anterior, los casos siguientes: <br>'.
	' 1° Si el enajenante expresamente excluyó su responsabilidad de restituir el precio; o si el adquirente renunció expresamente el derecho de repetirlo; <br>'.
	' 2° Si la enajenación fue a riesgo del adquirente; <br>'.
	' 3° Si cuando hizo la adquisición, sabía el adquirente, o debía saber, el peligro de '.
	' que sucediese la evicción, y sin embargo renunció a la responsabilidad del enajenante, '.
	' o consintió en que ella se excluyese." <br>'.
	' El art. 2106 del Código Civil textualmente expresa.”Cuando el adquirente de cualquier modo conocía el peligro de la evicción antes de la adquisición, nada puede reclamar del enajenante por los efectos de la evicción que suceda, a no ser que ésta hubiere sido expresamente convenida."'.
	'</br>';
	
	$str2 = $b_titulo . $b_parrafo_1 . $b_parrafo_2 . $bdatos_integrantes . $letra_chica_1 . $letra_chica_2;
	    
	$this->contenido[] =   $str;
	$this->contenido[] =   $str2;
	$this->contenido[] =   $str2;
	//echo utf8_decode( $str );
    }
    
    
    public function mostrar(){
        $this->config();
        foreach ($this->contenido as $html){
            $this->AddPage();
            $this->writeHTML($html, true, false, true, false, ' ');
	    
            
        }
        ob_end_clean();
        //Close and output PDF document
        $this->Output('boleto_compra_venta2.pdf', 'I');
        
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
    
    
    function tiene_valor( $item, $campo  ){
        $s = isset($item[$campo]) ? $item[$campo] : '';
        
        return  $s;
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
            
            $contraparte = $this->tiene_valor($item, "Persona_apellido") . ", " .
                $this->tiene_valor($item,"Persona_nombre");
                
                $madre_nombre = $this->tiene_valor($item,"Persona_madre_nombrecompleto");
                
                $padre_nombre = $this->tiene_valor($item,"Persona_padre_nombrecompleto");
                
                $familia_decreto_compra = $this->tiene_valor($item,"Familia_decreto_compra");
		
                //TODO
		 $res_adj = $this->tiene_valor($item,"Familia_res_adj"); 
		 $res_adj_fecha = $this->tiene_valor($item,"Familia_res_adj_fecha");
		 
		 //echo "famiia res adj: ". $res_adj;
		 //echo "fecha: " . $rea_adj_fecha;
		
		//echo 'Partido nombre : ' . $this->tiene_valor($item,"Barrio_nombre");
		
		$this->carga_datos($res_adj, $res_adj_fecha,
		    $familia_decreto_compra,
		    $planvivienda_nro,
                    //utf8_encode($this->localidad_boleto),
		    $this->tiene_valor($item,"Barrio_nombre"), 
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
    
    function set_administrador_general( $administrador_general ){
	
	$this->administrador_general = utf8_encode( $administrador_general );
	
    }
    
    function set_nombre_subsecretario( $nombre_subsecretario ){
	
	$this->nombre_subsecretario = $nombre_subsecretario ;
	
    }
    /*
     * Datos comunes a todos los boletos.
     */
    function datos_comun($tribunales, $localidad_boleto, $fecha_letras, $vencimiento_primera_cuota, $plano_registrado  ){
        
	$this->localidad_boleto = $localidad_boleto;
	
	$this->fecha_letras = $fecha_letras;
        
        $this->tribunales = $tribunales;
        
        $this->vencimiento_primera_cuota = $vencimiento_primera_cuota;
	
	$this->plano_registrado = $plano_registrado;
        
    }
    
    
}
?>

