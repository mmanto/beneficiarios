<?

include ("cabecera.php");
include ("conec.php");
include ("funciones.php");

$sql = "SELECT Persona_padre_nombre, Persona_padre_apellido, Persona_madre_nombre, Persona_madre_apellido, Persona_nro FROM dbo_persona WHERE blnConv1 = '0' LIMIT 0,500";

$res = mysql_query($sql);

$cant = mysql_num_rows($res);

echo "<p>Cant: ".$cant."</p>";

while ($persona = mysql_fetch_array($res)) {
	
$idPersona = $persona["Persona_nro"];

$padre_apellido = $persona["Persona_padre_apellido"];

$padre_nombre =	$persona["Persona_padre_nombre"];

$madre_apellido = $persona["Persona_madre_apellido"];

$madre_nombre =	$persona["Persona_madre_nombre"];



$padre_nmbcompleto = strtolower ($padre_nombre." ".$padre_apellido);

$padre_nmbcompleto = ucwords($padre_nmbcompleto);

$madre_nmbcompleto = strtolower ($madre_nombre." ".$madre_apellido);

$madre_nmbcompleto = ucwords($madre_nmbcompleto);
	
//echo $idPersona." - ".$padre_nmbcompleto." / ".$madre_nmbcompleto."</br>";

$upd = "UPDATE dbo_persona SET
		Persona_padre_nombrecompleto = '$padre_nmbcompleto',
		Persona_madre_nombrecompleto = '$madre_nmbcompleto',
		blnConv1 = '1'
		WHERE Persona_nro = '$idPersona'";

if(!mysql_query($upd)) { echo "Error al actualizar el registro.(".$idPersona.").-</br>"; }else {echo "Registro actualizado (".$idPersona.").- </br>"; }
	
}
echo "<p>&nbsp;</p>";
include("pie.php");

?>

