<?php session_start(); ?>
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

?>

<?php
include "models/funcionFondo.php"; // Incluye el archivo con la función

$backgroundClass = getBackgroundClass();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tiempo Maya - Calculadora de Mayas</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php include "blocks/bloquesCss.html" ?>
    <link rel="stylesheet" href="css/estilo.css?v=<?php echo (rand()); ?>" />
    <link rel="stylesheet" href="css/calculadora.css?v=<?php echo (rand()); ?>" />
</head>

<body  class="<?php echo $backgroundClass; ?>">

<?php include "NavBar.php" ?>


    <div>
    <section id="inicio">
        <div id="inicioContainer" class="inicio-container">
            <br><br><br>
            <div id='formulario'>
                <h1>Calculadora</h1>
                <form action="#" method="GET">
                    <div class="mb-1">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo isset($fecha_consultar) ? $fecha_consultar : ''; ?>" >
                    </div>
                    <button type="submit" class="btn btn-get-started"><i class="far fa-clock"></i> Calcular</button>
                </form>
            </div>
            <?php
            if(isset($haab)){
                $palabraHaab = preg_replace('/[0-9 ]+/', '', $haab);
                $palabraCholquij = preg_replace('/[0-9 ]+/', '', $cholquij);
            }
            ?>
            <br>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card mb-3 border-dark text-center " >
                            <div class="card-header" style="background-color: #cec7a6;">
                                <h3>Calendario Haab</h3>
                            </div>
                            <div class="card-body" style="background-color: #3f4042;">
                                <img width="100" height="100" class="rounded" style="background-color: #fcd5ce;" src="imgs/uinal/<?php echo isset($palabraHaab) ? $palabraHaab : ''; ?>.png">
                                <h4>Fecha</h4>
                                <h5><?php echo isset($haab) ? $haab : ''; ?></h5>
                                <a type="button" class="btn btn-get-started" href='models/paginaModeloElemento.php?elemento=uinal#<?php echo isset($palabraHaab) ? $palabraHaab : ''; ?>'>Mas Info</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mb-3 border-dark text-center " >
                            <div class="card-header" style="background-color: #cec7a6;">
                                <h3>Calendario Cholquij</h3>
                            </div>
                            <div class="card-body" style="background-color: #3f4042;">
                                <img width="100" height="100" class="rounded" style="background-color: #fcd5ce;" src="imgs/nahual/<?php echo isset($palabraCholquij) ? $palabraCholquij : ''; ?>.png">
                                <h4>Fecha</h4>
                                <h5><?php echo isset($cholquij) ? $cholquij : ''; ?></h5>
                                <a type="button" class="btn btn-get-started" href='models/paginaModeloElemento.php?elemento=nahual#<?php echo isset($palabraCholquij) ? $palabraCholquij : ''; ?>'>Mas Info</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mb-3 border-dark text-center " >
                            <div class="card-header" style="background-color: #cec7a6;">
                                <h3>Cuenta Larga</h3>
                            </div>
                            <div class="card-body" style="background-color: #3f4042;">
                                <img width="100" height="100" class="rounded" style="background-color: #fcd5ce;" src="img/fondo4.jpg">
                                <h4>Fecha</h4>
                                <h5><?php echo isset($cuenta_larga) ? $cuenta_larga : ''; ?></h5>
                                <a type="button" class="btn btn-get-started">Mas Info</a>
                            </div>
                        </div>
                    </div>

                </div>



            </div>



    </section>

        <section id="inicio">
            <div id="inicioContainer" class="inicio-container">

                    <div class="container">
                        <div class="row justify-content-center">

                            <div class=" mb-3 border-dark text-center " >
                                <div class="card-header" style=" margin-top: 50px; border-color: white; border-width: medium; background-color:  rgba(0,0,0,0.5);">
                                    <h3>Cruz Maya de <?php echo isset($palabraCholquij) ? $palabraCholquij : ''; ?> </h3>

                                </div>
                                <div class="card-body" style="background-color: #3f4042;">
                                    <img width="500" height="500" class="rounded" style="background-color: #fcd5ce;" src="imgs/cruz/<?php echo isset($palabraCholquij) ? $palabraCholquij : ''; ?>.png">

                                </div>
                            </div>

                        </div>
                    </div>
         
            </div>


        </section>



</div>
<?php include "blocks/bloquesJs1.html" ?>

</body>

</html>