<?php

/* Formulario con datos básicos para generar el pdf boleto compraventa.
 * Esta pantalla debe recibir el número de familia a realizar en la consulta.
 * Por ahora familia_nro se encuentra hardcodeado.
 * @param familia_nro = 110185
 */

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

include("cabecera.php");

$seleccion = implode(",",$_POST["seleccion"]);

#$seleccion =  ('110395');


?>
<script>
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);

 $(function () {
	$("[id^=datepicker]").datepicker();
});
 
</script>
<div class="bloque">
<a href="sbt-menu.php">Volver al menu</a>
<form class="form-generico" action="pdf_boleto_compraventa.php" target="_blank" method="POST" name="pre_boleto" >
<input type="hidden" name="familias" value= <?=$seleccion ?>  >
    <table>
    <tbody>
        <tr>
        	<th colspan="2">Ingrese los datos para generar el boleto de compraventa&nbsp;</th>
        </tr>
        
	<tr>
            <td>Administrador General</td>
            <td><input name="administrador_general" type="text" required style="width: 100%;" /></td>
        </tr>
        
	<tr>
            <td>Subsecretario</td>
            <td><input name="nombre_subsecretario" type="text" required style="width: 100%;" /></td>
    </tr>
    
    <tr>
            <td>Tipo de Certificado</td>
            <td>
				<select name="tipo_boleto">
					<option value="0">Ingrese una opción</option>
					<option value="conurbano">Boleto Compraventa</option>
					<option value="adjudicacion">Certificado de Adjudicación</option>
				</select>
			</td>
    </tr>
    
    <tr>
            <td style="width: 169px;"></td>
        	<td style="width: 203px; text-align:right;"><input name="cmdAccion" type="submit" id="cmdAccion" value="Generar boleto" /></td>
    </tr>
    </tbody>
    </table>
</form>
</div>

<?php
include "pie.php";
?>
