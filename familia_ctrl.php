<?php

if ( !defined('PROJECT_ROOT') ){
    define('PROJECT_ROOT', '/var/www/html/beneficiarios/');
}

require_once(PROJECT_ROOT . 'conec.php');


class Familia{

    
    private $familia_nro;
    
    private $nombres;
    
    private $partido_nombre;
    
    private $nomenclatura;
    
    
    function __construct( $familia_nro, $familia_nombres, $partido_nombre, $nomenclatura ){
        
        $this->familia_nro = $familia_nro;
        
        $this->nombres = $familia_nombres;
        
        $this->partido_nombre = $partido_nombre;
        
        $this->nomenclatura = $nomenclatura;
        
    }

    
    public function get_familia_nro(){
        
        return $this->familia_nro;
        
    }
    
    
    public function get_nombres(){
        
        return $this->nombres;
        
    }
    
    public function get_municipio(){
        
        return $this->partido_nombre;
        
    }
    
    public function get_nomenclatura(){
        
        return $this->nomenclatura;
        
    }
    
}


class FamiliaController{
    
    private static $familia;
    
    private static $item;
    
    private static $consulta = "select Familia_nro, Familia_apellido, Familia_domic, partido.Partido_nombre, 
                                partido.Partido_intendente_nombre, 
                                partido.Partido_municip_domicilio,
                                Lote_circunscripcion, Lote_seccion, Lote_chacra,
                                Lote_quinta, Lote_fraccion,
                                Lote_manzana, Lote_parcela, Lote_subparcela, 
                                partido.Partido_nombre, partido.Partido_nro,
                                Plano_num, Plano_aprobado_fecha, Familia_montoadj,
                                Familia_montoadj_cuotas, Familia_montoadj_cuota_valor
	                      from mytierras.dbo_familia familia
	                      inner join mytierras.dbo_partido partido
                          on familia.Partido_nro = partido.Partido_nro 
                          where familia.Familia_nro = "; 
	                      
    
    public static function get_familia( $id_familia ){
        
        $consulta = FamiliaController::$consulta . $id_familia . " and familia.blnActivo = true;";
        
        $query  = mysql_query( $consulta );
        
        $item = mysql_fetch_array($query);
        
        $familia_nro = FamiliaController::get_familia_nro( $item );
        
        $nombres = FamiliaController::get_nombres( $item );
        
        $municipio = FamiliaController::get_municipio( $item );
        
        $nomencla = FamiliaController::get_nomencla( $item );
        
        $familia = new Familia( $id_familia, $nombres, $municipio, $nomencla );
        

        return $familia;
        
    }
    
    private static function get_familia_nro( $item ){
        
        $numero = FamiliaController::tiene_valor($item, "Familia_nro");
        // . ", " . FamiliaController::tiene_valor($item,"Persona_nombre");
        
        
        return $numero;
        
    }
    
    
    //FIXME y el nombre?
    private static function get_nombres( $item ){
        
        $nombres = FamiliaController::tiene_valor($item, "Familia_apellido");
                   // . ", " . FamiliaController::tiene_valor($item,"Persona_nombre");


        return $nombres;
        
    }
    
    
    private static function get_municipio( $item ){
        
      
        return FamiliaController::tiene_valor($item,"Partido_nombre");
        
        
    }
    
    
    private static function get_nomencla( $item ){
        
        $circunscripcion = '';
        $seccion = '';
        $quinta = '';
        $chacra = '';
        $fraccion = '';
        $manzana = '';
        $parcela = '';
        $subparcela = '';
        
        if (FamiliaController::tiene_valor($item,"Lote_circunscripcion") !== "") {
            $circunscripcion = "Circunscripción " . FamiliaController::tiene_valor($item,"Lote_circunscripcion");
        }
        
        if (FamiliaController::tiene_valor($item,'Lote_seccion') !== ""){
            $seccion = ", Sección " . FamiliaController::tiene_valor($item,'Lote_seccion');
        }
        
        if(FamiliaController::tiene_valor($item,'Lote_quinta') !=="0"){
            $quinta = ", Quinta ". FamiliaController::tiene_valor($item,'Lote_quinta');
        }
        
        if (FamiliaController::tiene_valor($item,'Lote_chacra') !=="0"){
            $chacra = ", Chacra ". FamiliaController::tiene_valor($item,'Lote_chacra');
        }
        
        if (FamiliaController::tiene_valor($item,'Lote_fraccion') !=="0"){
            $fraccion = ", Fracción ". FamiliaController::tiene_valor($item,'Lote_fraccion');
        }
        
        if (FamiliaController::tiene_valor($item,'Lote_manzana') !==""){
            $manzana = ", Manzana " . FamiliaController::tiene_valor($item,'Lote_manzana');
        }
        
        if(FamiliaController::tiene_valor($item,'Lote_parcela') !== ""){
            $parcela = ", Parcela " . FamiliaController::tiene_valor($item,'Lote_parcela');
        }
        
        if(FamiliaController::tiene_valor($item,'Lote_subparcela') !== "0"){
            $subparcela = ", Subparcela " . FamiliaController::tiene_valor($item,'Lote_subparcela');
        }
        
        $nomencla = $circunscripcion . $seccion . $quinta . $chacra . $fraccion . $manzana . $parcela . $subparcela;
        

        return $nomencla;
        
    }
    
      
    /*
     * Retorna la cadena en utf8. De esta forma se elimina el problema
     * de codificación de datos obtenidos de la base.
     */
    private static function tiene_valor( $item, $campo  ){
        $s = isset($item[$campo]) ? $item[$campo] : '';
        
        return  utf8_encode( $s );
    }
    
}


?>