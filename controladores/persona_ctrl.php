<?php

require_once(__DIR__ . '/../conec.php');


class Persona{
    
    private $apellido;
    
    private $nombres;
    
    private $nacionalidad;
    
    private $fecha_nacimiento;
    
    private $madre_nombrecompleto;
    
    private $padre_nombrecompleto;
    
    private $estado_civil;
    
    private $domicilio;
    
    private $lugar_nacimiento;
    
    private $dni_nro;
    
    
    
    function __construct( $apellido, $nombres, $nacionalidad, $fecha_nacimiento, $madre_nombre, $padre_nombre,
        $estado_civil, $domicilio, $lugar_nacimiento, $dni_nro){
            
            $this->apellido = $apellido;
            
            $this->nombres = $nombres;
            
            $this->nacionalidad = $nacionalidad;
            
            $this->fecha_nacimiento = $fecha_nacimiento;
            
            $this->madre_nombrecompleto = $madre_nombre;
            
            $this->padre_nombrecompleto = $padre_nombre;
            
            $this->estado_civil = $estado_civil;
            
            $this->domicilio = $domicilio;
            
            $this->lugar_nacimiento = $lugar_nacimiento;
            
            $this->dni_nro = $dni_nro;
            
    }
    

    public function get_fecha_nacimiento()
    {
        return $this->fecha_nacimiento;
    }

    public function get_apellido(){
        
        return $this->apellido;
        
    }
    
    public function get_nombres(){
        
        return $this->nombres;
        
    }
    
    public function get_nombre_completo()
    {
        return $this->apellido . " " . $this->nombres;
    }
    
    public function get_nacionalidad(){
        
        return $this->nacionalidad;
        
    }
    
    public function get_madre_nombrecompleto()
    {
        return $this->madre_nombrecompleto;
    }
    
    public function get_padre_nombrecompleto()
    {
        return $this->padre_nombrecompleto;
    }
    
    public function get_estado_civil()
    {
        return $this->estado_civil;
    }
    
    public function get_domicilio()
    {
        return $this->domicilio;
    }
    
    public function get_lugar_nacimiento()
    {
        return $this->lugar_nacimiento;
    }
    
    public function get_dni_nro()
    {
        return $this->dni_nro;
    }
    
    
}


class PersonaController{
    
    private static $q_integrantes = "select Persona_apellido, Persona_nombre, Persona_nacionalidad,
                    	   Persona_fecha_nac, Persona_madre_nombrecompleto,
                           Persona_padre_nombrecompleto, Estado_civil_nombre,
                           Persona_domicilio,Persona_dni_nro,Persona_lugar_nac
                           from dbo_persona persona
                           inner join mytierras.dbo_estado_civil	estado_civil
                           on estado_civil.Estado_civil_nro = persona.Estado_civil_nro
                           where familia_nro = ";
    
    private static $condicion = " and persona.Persona_baja = 0
                           and persona.blnActivo = true;";
    
    
    public static function obtener_integrantes_familia( $id_familia ){
        
        $personas = array();
        
        $q = PersonaController::$q_integrantes . $id_familia . PersonaController::$condicion;
        
        $query  = mysql_query($q);
        
        while ($item = mysql_fetch_array($query)) {
	
		$personas[] = new Persona(PersonaController::tiene_valor($item,"Persona_apellido"),
					  PersonaController::tiene_valor($item,"Persona_nombre"),
					  PersonaController::tiene_valor($item,"Persona_nacionalidad"),
					  PersonaController::tiene_valor($item,"Persona_fecha_nac"),
					  PersonaController::tiene_valor($item,"Persona_madre_nombrecompleto"),
					  PersonaController::tiene_valor($item,"Persona_padre_nombrecompleto"),
					  PersonaController::tiene_valor($item,"Estado_civil_nombre"),
					  PersonaController::tiene_valor($item,"Persona_domicilio"),
					  PersonaController::tiene_valor($item,"Partido_nombre"),
					  PersonaController::tiene_valor($item,"Persona_dni_nro") );
	
	}

	
	mysql_free_result($query);
	
         
        return $personas;
        
    }
    
    function de_varias_familias( $familias ){
        
        $varias_familias = array();
        
        foreach ($familias as $f){
            
            $varias_familias[] = $this->obtener_personas($f);
            
        }
        
        return $varias_familias;
    }
    
    /*
     * Retorna la cadena en utf8. De esta forma se elimina el problema
     * de codificación de datos obtenidos de la base.
     */
    private static function tiene_valor( $item, $campo  ){
        $s = isset($item[$campo]) ? $item[$campo] : '';
        
        return  $s;
    }
    
}

?>
