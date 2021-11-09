<?php


class Unidad {
    
    private $numero;
    
    private $unidad = array(0 => "cero",1 => "uno",2=>"dos",3=>"tres",
        4 => "cuatro",5 => "cinco",6 => "seis",7 => "siete",
        8 => "ocho", 9 => "nueve");
    
    
    function __construct( $numero ){
        
        $this->numero = $numero;
    }
    
    function traducir(){
        
        
        $s = explode(",", $this->numero );
        
        if( count( $s ) == 2 ){
            
            $cadena = $s[0];
            
        }else{
            
            $cadena = (string)$this->numero;
        }
        
        return $this->unidad[ $cadena ] ;
    }
}


class Decena {
    
    private $decena = array(1 => "diez",2 => "veinte", 3 => "treinta", 4 => "cuarenta ",
                            5 => "cincuenta", 6 => "sesenta", 7 => "setenta",
                            8 => "ochenta", 9 => "noventa");
    
    private $particulares  = array( 11 => "once", 12 => "doce",
                                    13 => "trece", 14 => "catorce", 15 => "quince",
                                    16 => "dieciseis", 17 => "diecisiete", 18 => "dieciocho",
                                    19 => "diecinueve", 20 => "veinte", 21 => "veintiuno",
                                    22 => "veitidós", 23 => "veintitrés", 24 => "veiticuatro",
                                    25 => "veinticinco", 26 => "veintiséis", 27 => "veintisiete",
                                    28 => "ventiocho", 29 => "ventinueve");
    
    function __construct( $numero ){
        
        $this->numero = $numero;
    }
    
    public function traducir(){
    
        $cadena = (string)$this->numero;
        
        $d = $cadena[0];
        $u = $cadena[1];
        
        /*
        echo "cadena: " . $cadena ."<br>";
        echo "Decena : " . $d . "<br>";
        echo "Unidad : " . $u . "<br>"; 
        */
        if ( $d != "0"){
            
        // Si es un número 'redondo' lo buscamos en la arreglo decena.
        if ( $d != 0 && $u == 0){
            
            return $this->decena[ $d ];
        
        // en caso contrario lo buscamos en la arreglo particulares.
        } elseif (isset($this->particulares[$this->numero])){
            
            return $this->particulares[$this->numero];
        
        // Si no esta en los arreglos, tenemos que armar el nombre con el 
        // nombre de la decena y el nombre de la unidad el cual se le delega
        // a dicha clase.
        }else{ 
                $str = $this->decena[ $d ] . " y " ;
                $uni = new Unidad( $u );
                $str = $str . $uni->traducir();
                
                return $str; 
            
        }
        
        }else{
            
            $uni = new Unidad( $u );
            return $uni->traducir();
        }
    }
}

class Centena{
    
    private $numero;
    
    private $centenas = array(1 => "cien", 2 => "doscientos",
                              3 => "trescientos", 4 => "cuatrocientos",
                              5 => "quinientos", 6 => "seiscientos",
                              7 => "setecientos", 8 => "ochocientos",
                              9 => "novecientos");
    
    function __construct( $numero ){
        
        $this->numero = $numero;
    }
    
    public function traducir(){
       
        $cadena = (string)$this->numero;
        
        $c = $cadena[0];
        $d = $cadena[1];
        $u = $cadena[2];
        $s = $d . $u;
        
        if( $c != "0"){
            
        // si el número es 'redondo' buscamos solo en la tabla de centenas.
        if ( $u == 0 && $d == 0 ){
        
            return $this->centenas[ $c ];
        
        }else{
           
            if ( $c  == 1 ){
                
                $str = " ciento ";
                
            }else{
                
                $str = $this->centenas[ $c ] . " ";
                
            }
            
            $dec = new Decena($s);
            
                $str = $str . $dec->traducir();
                
                return $str;
            
            }
        }else{
        
            $dec = new Decena( $s );
            
        return $dec->traducir();
        
        }
        
    }
}



class UnidadDeMil{
    
    private $numero;

    private $uni;
    
    
    function __construct( $numero ){
        
        $str = (string)$numero;
        
        $this->numero = $numero;
        
        $this->uni = new Unidad( $str[0] );
        
    }
    
    function traducir(){
        
        $str = (string)$this->numero;
        
        if( $str[0] == 1){
            
            $resultado = " un ";
            
        }else{
            
            $resultado = $this->uni->traducir();
            
        }
        
        $valor_centena = substr( $str, 1, strlen( $str ) );
        
        $centenas = "";
        
        $cen = new Centena($valor_centena);
        
        $centenas = $cen->traducir();
            

        return  $resultado . " mil " . $centenas;
        
    }
}

class DecenaDeMil{
    
    private $numero;
    
    private $unidad;
    
    private $decena;
    
    
    function __construct( $numero ){
        
        $s = (string)$numero;
        
        $this->numero = $numero;
        
        $str = substr($s, 0, 2);
                 
        $this->decena = new Decena( $str );
        
    }

    
    function traducir(){
        
        $str = (string)$this->numero;
        
        $param = substr( $str, 2, strlen( $str ) );
        
        $centenas = "";
        
        if ( $param != "000"){
            
            $cen = new Centena( $param );
            $centenas = $cen->traducir();
        }
        
        
        
        return $this->decena->traducir() . " mil " . $centenas;
    }
}



class CentenaDeMil{

    private $numero;
    
    private $unidad;
    
    
    function __construct( $numero ){
    
        $this->numero = $numero;
    
    }
    
    function traducir(){
        
        $str = (string)$this->numero;
        
        $param = substr( $str, 3, strlen( $str ) );
        
        $centenas = new Centena( $param );
        
        $param_mil = substr( $str, 0, 3 );
        
        $centena_mil = new Centena( $param_mil );
        
        return $centena_mil->traducir() . " mil " . $centenas->traducir();
    }
}


class UnidadDeMillon{
    
    private $numero;
    
    private $uni;
    
    
    function __construct( $numero ){
        
        $str = (string)$numero;
        
        $this->numero = $numero;
        
        $this->uni = new Unidad( $str[0] );
        
    }
    
    function traducir(){
        
        $str = (string)$this->numero;
        
        if( $str[0] == 1){
            
            $resultado = " un millón";
            
        }else{
            
            $resultado = $this->uni->traducir() . " millones ";
            
        }
        
        $centenas = new CentenaDeMil( substr( $str, 1, strlen( $str ) ));
        
        
        return  $resultado ." ". $centenas->traducir();
        
    }
}


/*
 * Se encarga de delegar la traducción a letras a la clase correspondiente
 * basado en la cantidad de dígitos. Evalúa si la cifra tiene decimales y los
 * imprime en caso de ser necesario.
 * 
 */
class Cifra{
    
    private $numero;
    
    private $estrategia;
        
    
    function traducir( $valor ){
        
        $respuesta = "";
        
        $str_valor = str_replace( ".", ",", $valor );
        
        $s = explode(",", $str_valor  );
        
        if ( count( $s ) == 2 ){
            
            $str_valor = $s[0];
            
            $dec = new Decena( $s[1] );
            $decimales = " con " . $dec->traducir(). " centavos ";
        
        }
        
        switch (strlen( $str_valor )){
            
            case 1: $this->estrategia = new Unidad( $str_valor ); break;
            
            case 2: $this->estrategia = new Decena( $str_valor );break;
            
            case 3: $this->estrategia = new Centena( $str_valor );break;
            
            case 4: $this->estrategia = new UnidadDeMil( $str_valor );break;
            
            case 5: $this->estrategia = new DecenaDeMil( $str_valor );break;
            
            case 6: $this->estrategia = new CentenaDeMil( $str_valor );break;
            
            case 7: $this->estrategia = new UnidadDeMillon( $str_valor );break;
            
        }
        
        
        return " pesos " . $this->estrategia->traducir() . $decimales;
	        
    }
}

?>
