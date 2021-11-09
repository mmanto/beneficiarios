<?

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

$sql = "SELECT * FROM dbo_persona ORDER BY Persona_nro DESC LIMIT 30000,40000";

$res = mysql_query($sql);

while ($persona = mysql_fetch_array($res)) {

echo "<strong>".$persona["Persona_padre_nombrecompleto"]."</strong> // ".$persona["Persona_madre_nombrecompleto"]." <a href=javascript:ventana_modif('persona_modif_form.php?idPersona=".$persona["Persona_nro"]."')>[Modificar]</a></br>";

}