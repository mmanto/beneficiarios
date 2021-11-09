<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Sistema Beneficiarios de Tierras</title>
<meta name="description" value="Sistema de Beneficiarios de Tierras" />
<meta name="author" content="Andrés J. Bilstein">
<style type="text/css">
<!--
body {
	margin-left: 50px;
	margin-top: 20px;
}
</style>

<link href="estilos.css" rel="stylesheet" type="text/css" />

<script>
function pulsar(e) {
  tecla = (document.all) ? e.keyCode :e.which;
  return (tecla!=13);
}
</script> 

<script language=JavaScript>
<!--

function inhabilitar(){
    alert ("No puede utilizar el boton derecho del mouse.\nPor favor, utilice sólo los comandos en pantalla.\nMuchas Gracias.")
    return false
}

document.oncontextmenu=inhabilitar

// -->
</script>
<script language="JavaScript">
function ventana_modif (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=990, height=700, top=70, left=50";
window.open(pagina,"",opciones);
}
</script>

<script language="JavaScript">
function ventana_imprimir (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=950, height=700, top=70, left=50";
window.open(pagina,"",opciones);
}
</script>


<?php 
	error_reporting(E_ERROR);
	include ("hintbox.php"); 
?>
<!-- Menu desplegable -->	
	<script language="JavaScript">
function ChangeUrl(form)
{
 	  		location.href = form.ListeUrl.options[form.ListeUrl.selectedIndex].value;
}
</script>
<script type="text/javascript">
	function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
</script>	
<script>
	  function nobackbutton(){
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button" //chrome
   window.onhashchange=function(){window.location.hash="no-back-button";}
}
</script>
</head>

<body <? if ($noback == '1') { ?>onload="nobackbutton();"<? } ?>>
<table width="<? if ($tipo == '2') { echo "800"; }else{ echo "900"; } ?>" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="75" align="right" valign="top">
	<img src='imagen/logo-ba2.jpg' alt='Buenos Aires' width='900' height='70' />
	</td>
  </tr>
</table>
