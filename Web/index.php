<?php

use function PHPSTORM_META\type;

session_start(); ?>
<?php
$conn = include "conexion/conexion.php";




if(isset($_GET['fecha'])){
    $fecha_consultar = $_GET['fecha'];
}else{
    date_default_timezone_set('US/Central');
    $fecha_consultar = date("Y-m-d");
}

$nahual = include 'backend/buscar/conseguir_nahual_nombre.php';
$energia = include 'backend/buscar/conseguir_energia_numero.php';
$haab = include 'backend/buscar/conseguir_uinal_nombre.php';
$cuenta_larga = include 'backend/buscar/conseguir_fecha_cuenta_larga.php';
$cholquij = $nahual." ". strval($energia);
$nombre_nahual = $nahual;

$numero_energia = strval($energia);

$fecha_haab = $haab[0];

$nombre_uinal = $haab[1];


$Query = $conn->query("SELECT significado,descripcion,iddesk FROM nahual WHERE nombre IN ('" . str_replace("'", "\\'", $nahual) . "');");


// Divide la cadena en partes usando el punto como delimitador

// Elimina cualquier espacio de la cadena
$cuenta_larga_sin_espacios = str_replace(' ', '', $cuenta_larga);

$partes = explode(".", $cuenta_larga_sin_espacios);

if (count($partes) < 5) {
    die("Error: la cadena 'cuenta_larga' no tiene suficientes partes.");
}




// Accede a cada parte por su índice
$baktun = $partes[0]; // 13
$kaktun = $partes[1]; // 0
$tun = $partes[2]; // 11
$unial = $partes[3]; // 10
$kin = $partes[4]; // 8,

// Asegúrate de que $quinto es una cadena
$quinto = (string)$kin;


?>

<?php
if(isset($haab)){
    $palabraHaab = preg_replace('/[0-9 ]+/', '', $haab);
    $palabraCholquij = preg_replace('/[0-9 ]+/', '', $cholquij);
}
?>

<?php

include "models/funcionFondo.php";
$backgroundClass = getBackgroundClass();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tiempo Maya</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php include "blocks/bloquesCss.html" ?>
    <link rel="stylesheet" href="css/estilo.css?v=<?php echo(rand()); ?>" />
    <link rel="stylesheet" href="css/estiloAdmin.css?v=<?php echo(rand()); ?>" />

    <link rel="stylesheet" href="css/index.css?v=<?php echo (rand()); ?>" />


</head>

<body  class="<?php echo $backgroundClass; ?>">

<?php include "NavBar.php" ?>
<div>
    <section id="inicio">
        <div id="inicioContainer" class="inicio-container">
            <h1><br><br>Bienvenido al Tiempo Maya</h1>
            <div id='formulario' style="padding: 15px; width: auto;">
                <?php
                echo "<a href='models/paginaModeloElemento.php?elemento=uinal#".$palabraHaab."'>";
                echo "<img src=\"img/uinal/".$palabraHaab.".png\" alt=\"Error al intentar mostrar al uinasl ".$palabraHaab." \" class='imagen-elemento' >";
                echo "</a>";
                ?>
                <h5 class="fecha">Calendario Haab : <?php echo isset($haab) ? $haab : ''; ?></h5>
                <?php
                echo "<a href='models/paginaModeloElemento.php?elemento=nahual#".$nombre_nahual."'>";
                echo "<img src=\"img/nahual/".$nombre_nahual.".png\" alt=\"Error al intentar mostrar al nahual ".$nombre_nahual." \" class='imagen-elemento' >";
                echo "</a>";
                ?>
                <h5 class="fecha">Calendario Cholquij : <?php echo isset($cholquij) ? $cholquij : ''; ?></h5>
                <div class="icon-container">
                    <div class="icon"><img src="imgs/cuentaLarga/<?php echo $baktun; ?>.png" alt="Icon 1"></div>
                    <div class="icon"><img src="imgs/cuentaLarga/Baktun.png" alt="Icon 2"></div>
                    <div class="icon"><img src="imgs/cuentaLarga/<?php echo $kaktun; ?>.png" alt="Icon 3"></div>
                    <div class="icon"><img src="imgs/cuentaLarga/Katun.png" alt="Icon 4"></div>
                    <div class="icon"><img src="imgs/cuentaLarga/<?php echo $tun; ?>.png" alt="Icon 5"></div>
                    <div class="icon"><img src="imgs/cuentaLarga/Tun.png" alt="Icon 6"></div>
                    <div class="icon"><img src="imgs/cuentaLarga/<?php echo $unial; ?>.png" alt="Icon 7"></div>
                    <div class="icon"><img src="imgs/cuentaLarga/Unial.png" alt="Icon 8"></div>
                    <div class="icon"><img src="imgs/cuentaLarga/<?php echo $quinto; ?>.png" alt="Icon 9"></div>
                    <div class="icon"><img src="imgs/cuentaLarga/Kin.png" alt="Icon 10"></div>
                </div>
                <h5 class="fecha">Cuenta Larga : <?php echo isset($cuenta_larga) ? $cuenta_larga : ''; ?></h5>

                <label class="fecha"><?php echo isset($fecha_consultar) ? $fecha_consultar : ''; ?></label>

            </div>
        </div>
    </section>
</div>

<div>
    <section id="inicio">
        <div id="inicioContainer" class="inicio-container">
            <h1>El dia de hoy:  <?php echo isset($palabraCholquij) ? $palabraCholquij : ''; ?></h1>
            <h2>Significado:
                <?php foreach($Query as $info){
                    echo $info['significado'];
                }?>

            </h2>
            <h2>Descripcion:</h2>
            <h2>
                <?php foreach($Query as $info){
                    echo $info['descripcion'];
                }?>

            </h2>
        </div>
    </section>
</div>


<div>
    <section id="inicio">
        <div id="inicioContainer" class="inicio-container">
            <img src="img/LogoTiempoMaya.png" alt="No se puede mostrar el logo." class="logo">
        </div>
    </section>
</div>
  <?php include "blocks/bloquesJs1.html" ?>

</body>
</html>
