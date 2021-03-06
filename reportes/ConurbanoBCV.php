<?php

session_start();

require_once($_SESSION['PROJECT_ROOT'] . '/tcpdf_include.php');
require_once($_SESSION['PROJECT_ROOT'] . '/conec.php');
require_once($_SESSION['PROJECT_ROOT'] . '/lib/fecha_util.php');
require_once($_SESSION['PROJECT_ROOT'] . '/lib/monto_util.php');

define ('PDF_MARGEN_IZQUIERDO', 35);
define ('PDF_MARGEN_SUPERIOR', 23);

class ConurbanoBCV extends TCPDF{
    
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
        
        $nomencla, // Datos f??sicos de la parcela.
        $partido_nombre,
        $partido_nro,
        $caracteristica,
        $fecha_plano_aprobado, //----------------
        
        $monto_terreno, // Montos y cuotas.
        $vencimiento_primera_cuota,
        $cant_cuotas,
        $monto_cuota){ // -----------------
            
	    
            $titulo = '<div style="margin-top:0px;">' . '<img src="http://localhost/beneficiarios/imagen/Logo_BA.png"  width="70" height="38" style="text-align:rigth;">' .
            '<h1 style="text-align:center">BOLETO DE COMPRAVENTA</h1><h2 style="text-align:center">' . strtoupper($partido_nombre) . ' - ' . $localidad .'</h2></div>';
	    
	
	    $admin_general =  $this->administrador_general ;
            $contenido = '<p style="text-align:justify">' .
	    "Entre el Instituto de la Vivienda de la Provincia de Buenos Aires, representado en este acto por su Administrador General, " . 
	    utf8_decode($admin_general) .  ', con domicilio legal en su sede, Avda. 7 N?? 1267 de la ciudad de La Plata, en adelante "EL INSTITUTO" ' . 
	    ' por una parte, y ' ; 
	    
	    
            $str_contraparte = '';
	    
	    $datos_integrantes = '';
            
            $pc = new PersonaController();
            
            $integrantes = $pc->obtener_integrantes_familia($id_familia);
            
	    $cant_integrantes = count( $integrantes );
	    
                if ( $cant_integrantes == 1 ){
			
			$datos_integrantes .=  '<b>' . $integrantes[0]->get_nombre_completo() . ", DNI " . number_format( $integrantes[0]->get_dni_nro(), 0,"","." ) . '</b>';

		}else{

			foreach( $integrantes as $key=>$integrante ){
				
				$datos_integrantes .=  '<b>'. $integrante->get_nombre_completo() . ", DNI " . number_format( $integrante->get_dni_nro(), 0,"","." ) .'</b>';

				if ( $key < count( $integrantes ) -1 ){
				
					$datos_integrantes .= ' y ' ;
					
				}
			}
			
			
		}
            
	    
            $str_contraparte .=   $datos_integrantes  .' con domicilio real y constitu??do en el inmueble identificado catastralmente como ' .
	    '<b>' . $nomencla . '</b>'. ' del partido de ' . $partido_nombre . ' (' . $partido_nro . ')' .
	    
	    ' de la Provincia de Buenos Aires, parte a quien en adelante se lo identifica como ???EL COMPRADOR??? por la otra, y la Subsecretar??a Social de Tierras ' .
	    ' y Acceso Justo al Habitat del Ministerio de Desarrollo Social, representada en este acto por el Subsecretario ' .
	    
	    
	    $this->nombre_subsecretario . ', con domicilio legal en Diag. 73 N??1568 de La Plata, en adelante "LA SUBSECRETAR??A" se conviene en celebrar ' .
	    ' el presente BOLETO DE COMPRA - VENTA que se ajustar?? a las normas para la venta de inmuebles inclu??dos en las urbanizaciones que ejecuta ' .
	    ' el "INSTITUTO" para el desarrollo de "EL PROGRAMA PRO TIERRA" en todo el ??mbito de la Provincia, de acuerdo al Decreto N?? 815/88 y contenidas en el r??gimen instituido por Decreto N?? 4930/88; Decreto 3066/05, Decreto 2935/08, ' .
	    ' as?? como las disposiciones establecidas en la Resoluci??n del INSTITUTO DE LA VIVIENDA DE LA PROVINCIA DE BUENOS AIRES, N?? '.  $res_adj .' de fecha  ' . 
	    $res_adj_fecha .' que el "COMPRADOR", declara conocer y aceptar y con sujeci??n a las cl??usulas que a continaci??n se consignan: ';
	    
	    $plano_registrado = utf8_encode($this->plano_registrado);
	    
	    $primera = '<p style="text-align:justify"><b>PRIMERA.-</b>"EL INSTITUTO??? vende a ???EL COMPRADOR??? y este compra con ajuste a las ' . 
	    ' disposiciones precedentemente mencionadas y en las condiciones que se pactan en el presente, el inmueble identificado en el encabezamiento ' . 
	    ' de este Boleto. La venta del inmueble se formaliza en el estado y en las condiciones en que se encuentra a la fecha ' . 
	    ' del presente que ???EL COMPRADOR??? declara conocer y aceptar y sin reserva alguna con renuncia expresa a interponer cualquier acci??n presente ' . 
	    ' o futura contra ???EL INSTITUTO??? y/o ???PROVINCIA DE BUENOS AIRES???, por cualquier  causa o motivo  quedando a su exclusivo cargo los gastos ' .
	    ' que por cualquier concepto pudieran originarse en lo sucesivo, tomando posesi??n del inmueble de plena conformidad en este acto y exonerando ' . 
	    'de Responsabilidad al INSTITUTO o a la PROVINCIA por eventuales reclamos que pudieran hacer los terceros que funden sus derechos en anteriores ' . 
	    'Boletos otorgados y/o rescindidos, (arts. 2098, 2100,2101 y 2.106 del C.Civil), sirviendo el presente de suficiente constancia.</p>';
	    
	    
	    $cifra = new Cifra();
            $monto = $cifra->traducir( $monto_terreno );
	    
	    //$monto_cuota = round ($monto_terreno / $cant_cuotas,2);
	    $monto_cuota = bcdiv ($monto_terreno, $cant_cuotas, 2);
	    
	    /*
	    echo "monto terreno: " . $monto_terreno ."<br>"; 
	    echo "monto cuota con round: " . $monto_cuota ."<br>";
	    echo "cantidad de cuotas: " . $cant_cuotas."<br>";
	    */
	    
	    $monto_cuota_letras = $cifra->traducir( $monto_cuota );    
	    $cuotas_letras = str_replace( " pesos ", "", $cifra->traducir( $cant_cuotas ) );

	    $segunda = '<p style="text-align:justify"><b>SEGUNDA.-</b>Las partes formalizan la presente operaci??n sobre la base del PRECIO  DEFINITIVO DE ' .
	    strtoupper($monto) . " ($" . $monto_terreno . ".-)"  . ' que ???EL COMPRADOR??? abonar?? en '. 
	    strtoupper($cuotas_letras) . '(' . $cant_cuotas .  ')'.
	    
	    ' cuotas mensuales y consecutivas de ' . 
	    strtoupper($monto_cuota_letras) . '($'. $monto_cuota . '.-)' . ' cada una.</p>';
	    
	    $tercera = '<p style="text-align:justify"><b>TERCERA.-</b> Las partes convienen que tanto el importe de las cuotas como las '.
	    ' actualizaciones por pago fuera de t??rmino fijados en el presente Boleto, ser??n calculados y liquidados conforme las normas legales '. 
	    'vigentes en la materia</p>';
	    
	    //$cuarta = '<p style="text-align:justify"><b>CUARTA.-</b> </p>';
	    
	    $cuarta = '<p style="text-align:justify"><b>CUARTA.-</b> ???LA SUBSECRETARIA??? gestionar?? el cobro de las sumas debidas con motivo del '.
	    ' presente boleto, las eventuales readjudicaciones que deban realizarse del inmueble, como as?? tambi??n las tareas conducentes al otorgamiento ' .
	    ' la escritura traslativa de dominio y/o en su caso, la constituci??n de derecho real de hipoteca a favor de ???EL INSTITUTO???.-</p>';
	    
	    $quinta = '<p style="text-align:justify"><b>QUINTA.-</b> A los efectos de cumplimentar los pagos mensuales ???LA SUBSECRETARIA??? ' .
	    ' emitir?? las boletas de dep??sito o tarjetas en su caso. En estas boletas figurar??n los ' . 
	    ' pagos y ajustes que correspondan, debiendo el comprador, retirar estas boletas en ???LA SUBSECRETARIA???.</p>' ;

	     $sexta = '<p style="text-align:justify"><b>SEXTA.-</b> El primer servicio de amortizaci??n deber?? ser abonado de acuerdo a lo establecido en la ' .
	     ' notificaci??n de adjudicaci??n oportunamente cursada por ???LA SUBSECRETARIA??? y recibida de conformidad por ???EL COMPRADOR???. ' . 
	     ' Los servicios mensuales restantes con m??s los cargos, que en su caso correspondan de conformidad con lo establecido en este BOLETO, ' . 
	     ' ser??n satisfechos por ???EL COMPRADOR??? en forma ininterrumpida, entre los d??as PRIMERO (1) y DIEZ (10) de cada uno de los meses inmediatos '. 
	     'siguientes al fijado para el pago del primero de los servicios de amortizaci??n. ' . 
	     'Los pagos se acreditar??n mediante dep??sito a efectuar por ???EL COMPRADOR??? para la cuenta fiscal N?? 1397 denominada ???Recaudaci??n por cuenta '.
	     'de Terceros??? abierta en el Banco de la Provincia de Buenos Aires, Casa Matriz ???La Plata. ' . 
	     '???LA SUBSECRETARIA??? emitir?? las boletas o gestionar??  la emisi??n de tarjetas para efectivizar el pago de los servicios de amortizaci??n. La falta de '. 
	     'recepci??n de las mismas por parte de ???EL COMPRADOR???, cualquiera fuera su causa, no relevar?? a ??ste de su obligaci??n de abonar los servicios '. 
	     'dentro de los t??rminos pactados.</p>';
	     
	     $septima = '<p style="text-align:justify"><b>S??PTIMA.-</b> La mora en el pago de los servicios de amortizaci??n  dentro del plazo y en la forma prevista ' .
	     'en el plan de financiaci??n acordado para la cancelaci??n del precio de venta del inmueble, determinar?? para el deudor moroso la obligaci??n de ' . 
	     'cancelar igualmente los mismos al valor que figura en la boleta de dep??sito aunque haya tenido vencimiento la cuota correspondiente. En caso ' .
	     'de producirse mora en los pagos, ???LA SUBSECRETARIA??? dispondr?? las liquidaciones complementarias que correspondan. Estos ajustes ser??n '. 
	     'liquidados autom??ticamente en la cuota siguiente que corresponda, seg??n lo establece la cl??usula tercera.</p>' ;
	     
	     $octava = '<p style="text-align:justify"><b>OCTAVA.-</b> La deuda que resulta de la financiaci??n que se conviene en la cl??usula SEGUNDA o el saldo ' . 
	     'de la misma a la fecha de la extensi??n de la escritura traslativa de dominio sobre el inmueble objeto de la operaci??n ser?? garantizada mediante la ' . 
	     'constituci??n de derecho real de hipoteca a favor de ???EL INSTITUTO??? a constituirse en ese acto. La falta de pago de tres servicios de amortizaci??n ' . 
	     'consecutivos o como m??ximo cinco alternados  por  a??o  calendario  har??  exigible  el  saldo total  adeudado, sin  necesidad de interpelaci??n  judicial ' . 
	     'o extrajudicial alguna. En el supuesto en que la mora del deudor se produjera antes de otorgarse la escritura traslativa de dominio, ???EL INSTITUTO??? ' . 
	     'podr?? optar entre exigir el pago del saldo total adeudado dentro de un plazo perentorio e impostergable que no exceder?? de TREINTA (30) d??as ' . 
	     'corridos o bien declarar la rescisi??n del boleto, con perdida para el comprador de todas las sumas abonadas, que quedar??n a favor de ' . 
	     ' ???EL INSTITUTO??? en concepto de indemnizaci??n por el uso del bien sin perjuicio de exigir desde entonces el reintegro de la posesi??n del inmueble. ' .
	     'Se considerar??n los importes actualizados que hubieran abonado como el pago por el uso del inmueble el que se determinar?? conforme al valor locativo ' .
	     'del mismo al momento de su rescisi??n. En el supuesto de resultar saldo a favor del comprador una vez deducidos los rubros indicados, deber?? ' .
	     ' ???EL INSTITUTO ???, devolverlo actualizado al comprador; caso contrario, de existir deuda a favor de ???EL INSTITUTO???, ??ste podr?? exigir su cobro ' . 
	     'judicialmente. El pacto comisorio por falta de pago no podr?? hacerse valer despu??s que el adquirente haya abonado el 25%  del precio actualizado, ' .
	     'o haya realizado construcciones equivalentes al 50% del precio de compra, ambas actualizadas. Si la mora se produjera despu??s de constituida la ' . 
	     ' hipoteca, EL acreedor proceder?? a la ejecuci??n del cr??dito con ajuste a las cl??usulas de la hipoteca.</p>';
	     
	     $novena = '<p style="text-align:justify"><b>NOVENA.-</b> En la cancelaci??n anticipada de la deuda, el saldo se determinar?? multiplicando el ' . 
	     'n??mero de cuotas faltantes por el valor de ??sta seg??n el ??ltimo vencimiento. De igual modo, cuando los adjudicatarios desearen anticipar pagos ' . 
	     'de cuotas, los importes respectivos se aplicar??n de acuerdo al p??rrafo anterior. El importe respectivo se pondr?? a disposici??n de los interesados a ' . 
	     'requerimiento de estos. A su vez, el pago parcial anticipado implicar?? la autom??tica suspensi??n de pagos posteriores, hasta la recepci??n de los ' . 
	     'nuevos elementos de pago que proveer?? ???LA SUBSECRETARIA???</p>';
	     
	     $decima= '<p style="text-align:justify"><b>D??CIMA.-</b> Toda transgresi??n a las normas establecidas por ???El INSTITUTO???, ???LA SUBSECRETARIA??? ' .
	     'y/o ???EL PROGRAMA???, para la adjudicaci??n  de inmuebles facultar?? al ???INSTITUTO??? a dar por rescindido el presente boleto de pleno derecho y sin ' . 
	     'necesidad de interpelaci??n judicial o extrajudicial alguna, debiendo procederse a su inmediato desalojo sean quienes fueren sus ocupantes salvo si ' . 
	     'est??n cumplidos los porcentajes de la cl??usula octava. La perdida de los importes que hubiere abonado, ser?? total para el comprador, los que '.
	     'quedar??n a favor de ???EL INSTITUTO ???, en concepto de indemnizaci??n por el uso del inmueble, a cuyo fin se aplicar?? el procedimiento previsto en ' .
	     'el art??culo 8?? segundo p??rrafo, sin perjuicio de perseguir el cobro de las sumas que adeudare el comprador al momento de disponerse la rescisi??n.</p>';
	     
	     $dec_primera = '<p style="text-align:justify"><b>D??CIMO PRIMERA.-</b> En caso de contienda el comprador se somete con exclusividad a la jurisdicci??n administrativa en un todo de acuerdo a lo dispuesto por el Dec. Ley 7647/70 (T.O. Ley 13.262) atinente sobre la materia.</p>';
	     
	     $dec_segunda = '<p style="text-align:justify"><b>D??CIMO SEGUNDA.-</b> Para todos los efectos legales, judiciales y/o extrajudiciales que pudieran suscitarse con motivo de este boleto, las partes fijan sus domicilios en los lugares indicados en el encabezamiento del presente boleto, someti??ndose a la jurisdicci??n de los tribunales del Departamento Judicial de La Plata.</p>';
	     
	     $dec_tercera = '<p style="text-align:justify"><b>D??CIMO TERCERA.-</b> El comprador no podr?? transmitir sus derechos hasta tanto d?? cumplimiento a la obligaci??n establecida en el art??culo 17?? de la ley N?? 5.396, para lo cual deber?? presentar plano municipal aprobado y final de obra municipal, salvo autorizaci??n de  ???LA SUBSECRETARIA??? previa fundamentaci??n por el requirente.</p>';
	     
	     $dec_cuarta = '<p style="text-align:justify"><b>D??CIMO CUARTA.-</b> El beneficiario no podr?? transmitir el bien gravado, enajenar, dar en uso, usufructo, comodato, locaci??n, la unidad objeto de este contrato sin haber saldado su obligaci??n hipotecaria. ' .
	     ' En uno u otro caso ???EL COMPRADOR??? no podr?? oponerse a las inspecciones que ???LA SUBSECRETARIA??? o ???EL INSTITUTO??? estimen necesario realizar con el objeto de dar cumplimiento a las disposiciones que regulan la materia.</p>';
	     
	     $dec_quinta = '<p style="text-align:justify"><b>D??CIMO QUINTA.-</b> En caso de que se acreditare que ???EL COMPRADOR??? y/o cualquier miembro de su grupo familiar a cargo tuviere alg??n otro bien inmueble inscripto a su nombre y/o fuere beneficiario de alg??n programa nacional o provincial que le permita el acceso a una vivienda, hasta la cancelaci??n definitiva de la deuda, se rescindir?? la presente operaci??n de pleno derecho sin necesidad de interpelaci??n judicial, para lo cual se le notificar?? al interesado en forma fehaciente.</p>';
	     
	     $dec_sexta = '<p style="text-align:justify"><b>D??CIMO SEXTA.-</b> ???EL COMPRADOR??? y su grupo familiar har??n efectiva ocupaci??n del inmueble a la fecha del presente, salvo autorizaci??n expresa de ???EL INSTITUTO???, previa fundamentaci??n del requirente. El incumplimiento de esta obligaci??n ser?? causal de rescisi??n la que se producir?? de pleno derecho, y sin necesidad de interpelaci??n judicial.</p>';
	     
	     $dec_septima = '<p style="text-align:justify"><b>D??CIMO S??PTIMA.-</b> La escritura traslativa de dominio y la hipoteca, en caso de corresponder, una vez cumplidos todos los requisitos exigidos, ser?? otorgada por la Escriban??a General de Gobierno.' .
	     'En prueba de conformidad se firman dos ejemplares del mismo tenor y a un solo efecto, en la ciudad de La Plata, con fecha</p>';
	     
	     $decimas = $dec_primera . $dec_segunda . $dec_tercera . $dec_cuarta . $dec_quinta . $dec_sexta . $dec_septima;
		
	$str = $titulo . $contenido . $str_contraparte . $primera . $segunda . $tercera . $cuarta . $quinta . $sexta . $septima . $octava . $novena . $decimas;

	$this->contenido[] =   $str ;
	//echo utf8_decode( $str );
    }
    
    
    public function mostrar(){
        $this->config();
        foreach ($this->contenido as $html){
            $this->AddPage();
            $this->writeHTML($html, true, false, true, false, ' ');
	    $this->AddPage();
            
        }
        ob_end_clean();
        //Close and output PDF document
        $this->Output('boleto_compra_venta.pdf', 'I');
        
    }
    
    /*
     * Arma la cadena sql estableciendo una condici??n en familia_nro.
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
     * Obtiene los datos de la base y los env??a a preparar.
     */
    function ejecutar_consultas( $familias ){
        foreach ( $this->consultas as $id_familia => $q ){
            
            $query  = mysql_query($q);
            $item = mysql_fetch_array($query);
            
            if ($this->tiene_valor($item,"Lote_circunscripcion") !== "") {
                $circunscripcion = "Circunscripci??n " . $this->tiene_valor($item,"Lote_circunscripcion");
            }
            
            if ($this->tiene_valor($item,'Lote_seccion') !== ""){
                $seccion = ", Secci??n " . $this->tiene_valor($item,'Lote_seccion');
            }
            
            if($this->tiene_valor($item,'Lote_quinta') !=="0"){
                $quinta = ", Quinta ". $this->tiene_valor($item,'Lote_quinta');
            }
            
            if ($this->tiene_valor($item,'Lote_chacra') !=="0"){
                $chacra = ", Chacra ". $this->tiene_valor($item,'Lote_chacra');
            }
            
            if ($this->tiene_valor($item,'Lote_fraccion') !=="0"){
                $fraccion = ", Fracci??n ". $this->tiene_valor($item,'Lote_fraccion');
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
