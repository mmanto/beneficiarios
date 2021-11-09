<?
include ("conec.php");
mysql_select_db("MyTierras",$link);

//Funcion para convertir fecha normal en MySQL

function cambiaf_a_mysql($fecha){
    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
    $fechamysql=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
    return $fechamysql;
}

//Función para convertir fecha MySQL en normal

function cambiaf_a_normal($fecha){
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
} 


//Funcion para sumar fecha

function suma_fechas($fecha,$ndias)
            

{
            

      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
            

              list($dia,$mes,$año)=split("/", $fecha);
            

      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
            

              list($dia,$mes,$año)=split("-",$fecha);
        $nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
        $nuevafecha=date("d-m-Y",$nueva);
            

      return ($nuevafecha);  
            

}

// Funcion para mensaje en Javscript

function mensaje_error($msg)
{
echo("<script language='JavaScript'>");
echo("alert('$msg');");
echo("</script>");
exit();
}

/* Esta función puede invocarse del modo:

mensaje_error('Aqui mensaje a mostrar');
*/

//Funcion para insertar separador de miles en num de coumento
function separa_dni($dni_nro)
{
$doc_c1 = substr("$dni_nro",-8,-6);
$doc_c2 = substr("$dni_nro",-6,-3);
$doc_c3 = substr("$dni_nro",-3);
$doc_nro = "$doc_c1.$doc_c2.$doc_c3";
echo $doc_nro;
}

//Funcion para evitar sql injection
function sqlsecurefield($fieldsecure) {
$fieldsecure = str_replace("\'"," ",$fieldsecure);
$fieldsecure = str_replace("\""," ",$fieldsecure);
return $fieldsecure;
}

//Funcion para redondear a dos decimales

function redondear_dos_decimal($valor) {
$float_redondeado=round($valor * 100) / 100;
return $float_redondeado;
}

//Recibe una cansulta y devuelve una matriz con los resultados
//Devuelve false si falla y true si no arrojea resultados
//para saber si no arroja resultados usar !is_array($resultado) 
function armar_matriz($qry){
	$result = mysql_query($qry);
	$matriz= FALSE;
	$i=0;
	if (mysql_num_rows($result) == 0) {
		$matriz = TRUE;
	}
	while($aux = mysql_fetch_array($result, MYSQL_ASSOC)){
		$matriz[$i] = $aux;
		$i++;
	}	
	return $matriz;
}

function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
}
