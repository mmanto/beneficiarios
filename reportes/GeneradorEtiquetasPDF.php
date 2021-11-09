<?php

require_once(PROJECT_ROOT . 'tcpdf_include.php');
require_once(PROJECT_ROOT . 'controladores/persona_ctrl.php');

class GeneradorEtiquetasPDF extends TCPDF{
    
    private $contenido = array();
    
    protected function config(){
    
        $this->SetCreator(PDF_CREATOR);
        
        $this->SetTitle('Etiqueta');
        
        $this->SetKeywords('etiqueta');
        
        $this->setPrintHeader(false);
        
        $this->setPrintFooter(false);
        
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        $this->SetMargins(0, 0, 0);
        
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        if (@file_exists(dirname(__FILE__).'/lang/es.php')) {
            
            require_once(dirname(__FILE__).'/lang/es.php');
            
            $this->setLanguageArray($l);
        }
        
        $this->SetFont('FreeSans', '', 11);
        
    }
    
    public function agregar_contenido( $familia ){
        
        $integrantes = PersonaController::obtener_integrantes_familia( $familia->get_familia_nro() );
        
        $nombres_str = '';
        
        foreach( $integrantes as $integrante ){
            
            $nombres_str .= $integrante->get_apellido() . ', ' . $integrante->get_nombres() . '<br>';
        }
        

        $html = '<div style="text-align:center; ">'.
            '<br><br><p style="font-size:xx-large;font-weight: bold; ;">'.
            
            $nombres_str .
            
            '</p><br>'.
            '<label>Municipio de </label>' . '<br>' .
            '<label style="font-size:x-large;font-weight: bold;">' .
            $familia->get_municipio() . '</label><br>'.
            '<br>Nomenclatura catastral: ' .
            $familia->get_nomenclatura() .
            '<br><br><br></div><hr style="border:1px dashed;"/>';
        
        $this->contenido[] = $html;
        
    }
    
    public function mostrar(){
        $this->config();
        $this->AddPage();
        foreach ($this->contenido as $html){
            
            $this->writeHTML($html, true, false, true, false, ' ');
            
        }
        //Close and output PDF document
        $this->Output('etiqueta.pdf', 'I');
        
    }
}
?>