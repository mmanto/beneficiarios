<?php


class FechaUtil{
    
   private static $dias_del_mes = array("01" => "primer","02" => "dos",
                                        "03" => "tres", "04" => "cuatro",
                                        "05" => "cinco","06" => "seis",
                                        "07" => "siete","08" => "ocho","09"=>"nueve",
                                        "10" => "diez","11" => "once",
                                        "12" => "doce","13" => "trecece",
                                        "14" => "catorce","15" => "quince",
                                        "16" => "dieciséis","17" => "diecisiete",
                                        "18" => "dieciocho","19" => "diecinueve",
                                        "20" => "veinte", "21" => "veintiuno",
                                        "22" => "veintidós", "23" => "veintitrés",
                                        "24" => "veinticuatro", "25" => "veinticinco",
                                        "26" => "veintiseis", "27" => "veintisiete",
                                        "28" => "veintiocho", "29" => "veintinueve",
                                        "30" => "treinta", "31" => "treinta y un"  );
    
    private static $meses = array(  "01"=>"enero",
                                    "02"=>"febrero",
                                    "03"=>"marzo",
                                    "04"=>"abril",
                                    "05"=>"mayo",
                                    "06"=>"junio",
                                    "07"=>"julio",
                                    "08"=>"agosto",
                                    "09"=>"septiembre",
                                    "10"=>"octubre",
                                    "11"=>"noviembre",
                                    "12"=>"diciembre" );
    
   
   public static function analizar_anio( $anio ){
       
       $decena = substr($anio, 2, strlen($anio));  // 2017 retorna solo las decenas 17
       
       return FechaUtil::$dias_del_mes[$decena];
       
   }
   
   private static function analizar_mes( $mes ){
   
       // Si viene un digito solo, agregar un cero a la izquierda.
       if (strlen($mes) == 1){
           
           $mes = "0" . $mes;
       }
       
       
       return FechaUtil::$meses[$mes];
       
   }
   
   private static function analizar_dia( $dia ){
        
        // Si viene un digito solo, agregar un cero a la izquierda.
        if (strlen($dia) == 1){
            
            $dia = "0" . $dia;
        }
        
        return FechaUtil::$dias_del_mes[ $dia ];
                        
    }
    

    
   public static function fecha_en_palabras( $dia, $mes, $anio ){
        
        $msj = "a los ";
        $singular = " días";
        
        
        if (FechaUtil::analizar_dia( $dia ) == "primer"){
            $msj = "";
            $msj = "al ";
            $singular = " día"; 
        }
        
        $str =  $msj . FechaUtil::analizar_dia( $dia ) . 
                $singular . " del mes de " . FechaUtil::analizar_mes( $mes ) .
                " del año dos mil " . FechaUtil::analizar_anio( $anio );
        
        
                return  $str ;
       
    }
    

    public static function fecha_en_palabras_ma( $mes, $anio ){
        
        $str = FechaUtil::analizar_mes( $mes ) .
               " del año dos mil " . FechaUtil::analizar_anio( $anio );
        
        
        return $str;
        
    }
}

?>