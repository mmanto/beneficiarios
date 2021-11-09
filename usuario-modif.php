<? session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: expired.php");
    
} else{

include("cabecera.php");
include ("conec.php");
include ("funciones.php");

$idusuario = $_POST["idusuario"];
$nombre = $_POST["nombre"];
$usuario = $_POST["usuario"];
$area = $_POST["area"];
$habRH = $_POST["HabRH"];
$habExp = $_POST["HabExp"];
$habSbt = $_POST["HabSbt"];
$habCom = $_POST["HabCom"];
$HabIntCom = $_POST["HabIntCom"];

	$sql2 = "SELECT Direccion_nro FROM dbo_area WHERE Area_nro = $area";
	$res2 = mysql_query($sql2);
	$direccion = mysql_fetch_array($res2);
	$direccion_nro = $direccion["Direccion_nro"];

if($_POST["601"] == '1') { $p601 = '1'; }else{ $p601 = '0'; }
if($_POST["602"] == '1') { $p602 = '1'; }else{ $p602 = '0'; }
if($_POST["603"] == '1') { $p603 = '1'; }else{ $p603 = '0'; }
if($_POST["604"] == '1') { $p604 = '1'; }else{ $p604 = '0'; }
if($_POST["605"] == '1') { $p605 = '1'; }else{ $p605 = '0'; }
if($_POST["701"] == '1') { $p701 = '1'; }else{ $p701 = '0'; }
if($_POST["702"] == '1') { $p702 = '1'; }else{ $p702 = '0'; }
if($_POST["703"] == '1') { $p703 = '1'; }else{ $p703 = '0'; }
if($_POST["704"] == '1') { $p704 = '1'; }else{ $p704 = '0'; }
if($_POST["705"] == '1') { $p705 = '1'; }else{ $p705 = '0'; }
if($_POST["711"] == '1') { $p711 = '1'; }else{ $p711 = '0'; }
if($_POST["712"] == '1') { $p712 = '1'; }else{ $p712 = '0'; }
if($_POST["713"] == '1') { $p713 = '1'; }else{ $p713 = '0'; }
if($_POST["714"] == '1') { $p714 = '1'; }else{ $p714 = '0'; }
if($_POST["715"] == '1') { $p715 = '1'; }else{ $p715 = '0'; }
if($_POST["721"] == '1') { $p721 = '1'; }else{ $p721 = '0'; }
if($_POST["722"] == '1') { $p722 = '1'; }else{ $p722 = '0'; }
if($_POST["723"] == '1') { $p723 = '1'; }else{ $p723 = '0'; }
if($_POST["724"] == '1') { $p724 = '1'; }else{ $p724 = '0'; }
if($_POST["725"] == '1') { $p725 = '1'; }else{ $p725 = '0'; }
if($_POST["731"] == '1') { $p731 = '1'; }else{ $p731 = '0'; }
if($_POST["732"] == '1') { $p732 = '1'; }else{ $p732 = '0'; }
if($_POST["733"] == '1') { $p733 = '1'; }else{ $p733 = '0'; }
if($_POST["734"] == '1') { $p734 = '1'; }else{ $p734 = '0'; }
if($_POST["735"] == '1') { $p735 = '1'; }else{ $p735 = '0'; }
if($_POST["741"] == '1') { $p741 = '1'; }else{ $p741 = '0'; }
if($_POST["742"] == '1') { $p742 = '1'; }else{ $p742 = '0'; }
if($_POST["743"] == '1') { $p743 = '1'; }else{ $p743 = '0'; }
if($_POST["744"] == '1') { $p744 = '1'; }else{ $p744 = '0'; }
if($_POST["745"] == '1') { $p745 = '1'; }else{ $p745 = '0'; }
if($_POST["751"] == '1') { $p751 = '1'; }else{ $p751 = '0'; }
if($_POST["752"] == '1') { $p752 = '1'; }else{ $p752 = '0'; }
if($_POST["753"] == '1') { $p753 = '1'; }else{ $p753 = '0'; }
if($_POST["754"] == '1') { $p754 = '1'; }else{ $p754 = '0'; }
if($_POST["755"] == '1') { $p755 = '1'; }else{ $p755 = '0'; }

if($_POST["761"] == '1') { $p761 = '1'; }else{ $p761 = '0'; }
if($_POST["762"] == '1') { $p762 = '1'; }else{ $p762 = '0'; }
if($_POST["763"] == '1') { $p763 = '1'; }else{ $p763 = '0'; }
if($_POST["764"] == '1') { $p764 = '1'; }else{ $p764 = '0'; }

if($_POST["771"] == '1') { $p771 = '1'; }else{ $p771 = '0'; }
if($_POST["772"] == '1') { $p772 = '1'; }else{ $p772 = '0'; }
if($_POST["773"] == '1') { $p773 = '1'; }else{ $p773 = '0'; }
if($_POST["774"] == '1') { $p774 = '1'; }else{ $p774 = '0'; }

if($_POST["781"] == '1') { $p781 = '1'; }else{ $p781 = '0'; }
if($_POST["782"] == '1') { $p782 = '1'; }else{ $p782 = '0'; }
if($_POST["783"] == '1') { $p783 = '1'; }else{ $p783 = '0'; }
if($_POST["784"] == '1') { $p784 = '1'; }else{ $p784 = '0'; }
if($_POST["785"] == '1') { $p785 = '1'; }else{ $p785 = '0'; }

if($_POST["801"] == '1') { $p801 = '1'; }else{ $p801 = '0'; }
if($_POST["802"] == '1') { $p802 = '1'; }else{ $p802 = '0'; }
if($_POST["803"] == '1') { $p803 = '1'; }else{ $p803 = '0'; }
if($_POST["804"] == '1') { $p804 = '1'; }else{ $p804 = '0'; }

if($_POST["901"] == '1') { $p901 = '1'; }else{ $p901 = '0'; }
if($_POST["902"] == '1') { $p902 = '1'; }else{ $p902 = '0'; }
if($_POST["903"] == '1') { $p903 = '1'; }else{ $p903 = '0'; }
if($_POST["904"] == '1') { $p904 = '1'; }else{ $p904 = '0'; }
	

$upd = "UPDATE dbo_usuarios SET
		Usuario = '$usuario',
		Nombre = '$nombre',
		Area_nro = '$area',
		Direccion_nro = '$direccion_nro',
		HabExp = '$habExp',
		HabSbt = '$habSbt',
		HabCom = '$habCom',
		HabRH = '$habRH',
		HabIntCom = '$HabIntCom',
		p601 = '$p601',
		p602 = '$p602',
		p603 = '$p603',
		p604 = '$p604',
		p605 = '$p605',
		p701 = '$p701',
		p702 = '$p702',
		p703 = '$p703',
		p704 = '$p704',
		p705 = '$p705',
		p711 = '$p711',
		p712 = '$p712',
		p713 = '$p713',
		p714 = '$p714',
		p715 = '$p715',
		p721 = '$p721',
		p722 = '$p722',
		p723 = '$p723',
		p724 = '$p724',
		p725 = '$p725',
		p731 = '$p731',
		p732 = '$p732',
		p733 = '$p733',
		p734 = '$p734',
		p735 = '$p735',
		p741 = '$p741',
		p742 = '$p742',
		p743 = '$p743',
		p744 = '$p744',
		p745 = '$p745',
		p751 = '$p751',
		p752 = '$p752',
		p753 = '$p753',
		p754 = '$p754',
		p755 = '$p755',		
		p761 = '$p761',
		p762 = '$p762',
		p763 = '$p763',
		p764 = '$p764',		
		p771 = '$p771',
		p772 = '$p772',
		p773 = '$p773',
		p774 = '$p774',		
		p781 = '$p781',
		p782 = '$p782',
		p783 = '$p783',
		p784 = '$p784',
		p785 = '$p785',	
		p801 = '$p801',
		p802 = '$p802',
		p803 = '$p803',
		p804 = '$p804',
		p901 = '$p901',
		p902 = '$p902',
		p903 = '$p903',
		p904 = '$p904'		
		WHERE idUsuario = '$idusuario'";
		
if(mysql_query($upd)) {

?>
<h2><? echo $p601; ?></h2>
<h2>Los datos fueron actualizados correctamente</h2>
<p>&nbsp;</p>
<p>Ya puede cerrar esta ventana</p>
<p>&nbsp;</p>

<? }else{ ?>
<h2><? echo $p601; ?></h2>
<h2>Error al actualizar los datos. Contacte al administrador</h2>
<p>&nbsp;</p>
<p>Ya puede cerrar esta ventana</p>
<p>&nbsp;</p>


<? 
	}
} 

?>

