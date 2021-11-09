<?php

class TablaFirmas{

	private $cantidad_filas = 0;
	
	private $html = '<table>';
	
	
	private generar_fila_con( $celda ){
		
		return '<tr>' . $celda . '</tr>';
	}
	
	private  generar_linea(){
		
		return '<tr><th>. . . . . . . . . . . . . . . . . . . . . . . . .</th><tr>';
		
		}
		
	private generar_separador(){
		
		return '<td></td>';
		
		}
		
	public agregar_datos_completos( $nombre_completo, $dni){
		}
}

?>
