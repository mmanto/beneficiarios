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

 $(function () {
	
	$("#tipo_boleto").on("change", function(e){
		if(this.value==="con_vivienda_por_cancelar" || this.value==="sin_vivienda_por_cancelar" ){
			$('#cuotas_automaticas').prop('checked', true);
			$('#cc1').show("slow");
		}else{
			$('#cc1').hide("slow");
			$('#texto_cuotas').hide("slow");
		}
		
	});
	
	
	$("#cuotas_automaticas").on("click", function () {	 
			
			if  (! $("#cuotas_automaticas").is(':checked')){
				$('#texto_cuotas').show("slow");
			}else{
				$('#texto_cuotas').hide("slow");
			}

			});
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
            <td>Localidad</td>
            <td><input name="localidad_boleto" type="text" required style="width: 100%;" /></td>
        </tr>
        <tr>
            <td>Fecha</td>
            <td>
            
			<input type="text" name="fecha" id="datepicker"/>
           
            </td>
        </tr>
        <tr>
            <td>Mes de vencimiento primera cuota</td>
            <td>
            
			<!--  <input type="text" name="ven_pri_cuota" id="datepicker_vpc"/> -->
			<select name="ven_pri_cuota">
			  <option value="0"></option>
			  <option value="enero">enero</option>
              <option value="febrero">febrero</option>
              <option value="marzo">marzo</option>
              <option value="abril">abril</option>
              <option value="mayo">mayo</option>
              <option value="junio">junio</option>
              <option value="julio">julio</option>
              <option value="agosto">agosto</option>
              <option value="septiembre">septiembre</option>
              <option value="octubre">octubre</option>
              <option value="noviembre">noviembre</option>
              <option value="diciembre">diciembre</option>
            </select>
           
            </td>
        </tr>
        <tr>
            <td>Tribunales</td>
            <td><input name="tribunales" type="text" required style="width: 100%;" /></td>
        </tr>
	<tr>
		<td>
		Tipo de boleto
		</td>
		<td>
		    	<select id="tipo_boleto" name="tipo_boleto">
				<option value="0"> - Elija un a opción -</option>
				<option value="sin_vivienda_por_cancelar">Sin Vivienda - Por cancelar</option>
				<option value="sin_vivienda_cancelado">Sin Vivienda - Cancelado</option>
				<option value="con_vivienda_por_cancelar">Con Vivienda - Por cancelar</option>
				<option value="con_vivienda_cancelado">Con Vivienda - Cancelado</option>
			<select>
		</td>
	<tr id="cc1" hidden>
		<td>Cuotas automaticas</td>
		<td><input id="cuotas_automaticas" type="checkbox" name="cuotas_automaticas" value="cuotas_automaticas" checked></td>
	</tr>
	
	<tr id="texto_cuotas" hidden>
		<td>Texto para las cuotas</td>
		<td><textarea  name="cuotas_automaticas_txt" style="width:100%; height:100px;"></textarea></td>
	</tr>
	
	<tr>
		<td>Plano registrado</td>
		<td><input type="checkbox" name="plano_registrado" value="plano_registrado" checked></td>
	</tr>
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