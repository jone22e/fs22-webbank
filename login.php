<?php
include "vendor2/supertypes/autoload.php";

/*$clientes = simplexml_load_file("files/savegame1/farms.xml");*/

/*foreach ($clientes as $cliente) {
    echo $cliente->attributes()->name.'<br>';
    echo 'Saldo: $ '.(number_format(floatval($cliente->attributes()->money),2,',', '.')).'<br>';
    echo 'Tempo Trabalhando: '.round((intval($cliente->statistics->workedTime[0])/60), 2).' horas<br>';
    echo 'Hectares trabalhados : '.$cliente->statistics->workedHectares[0].'<br>';
    echo 'Uso de Combustível: '.$cliente->statistics->fuelUsage[0].'<br>';
    echo 'Sementes Usadas: '.$cliente->statistics->seedUsage[0].'<br>';
    echo 'Distância Percorrida de Trator: '.$cliente->statistics->tractorDistance[0].'<br>';
    echo 'Arvores Cortadas: '.$cliente->statistics->cutTreeCount[0].'<br>';
    echo 'Arvores Plantadas: '.$cliente->statistics->plantedTreeCount[0].'<br>';
    echo 'Corsertos de Veículos: '.$cliente->statistics->repairVehicleCount[0].'<br>';

    echo '<br>';
}*/
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bank</title>
    <link href="/assets/stylesv2.css" rel="stylesheet">
    <link href="/vendor2/fontawesome-free-5.12.0-web/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="app app-loaded"><!-- START APP CONTAINER -->
    <div class="app-container">
        <div class="app-login-box">
            <div class="app-login-box-user"><img src="img/logo-dark.png" alt=""></div>

            <div class="app-login-box-container">
                <form action="index.html" method="post">
                    <div class="form-group"><input type="text" class="form-control" name="login"
                                                   placeholder="Email Address"></div>
                    <div class="form-group"><input type="password" class="form-control" name="password"
                                                   placeholder="Password"></div>
                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-12">
                                <button class="btn btn-info btn-block">Login</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <div class="app-login-box-footer">© FS22Bank. All rights reserved.</div>
        </div>
    </div><!-- END APP CONTAINER --></div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
</body>
</html>
