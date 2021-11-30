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
    <div class="app-container"><!-- START APP HEADER -->
        <div class="app-header">
            <div class="container container-boxed">
                <ul class="app-header-buttons visible-mobile">
                    <li><a href="#" class="btn btn-link btn-icon" data-navigation-horizontal-toggle="true"><span
                                    class="icon-menu"></span></a></li>
                </ul>
                <a href="index.php" class="app-header-logo app-header-logo-light ">Bank</a>
                <ul class="app-header-buttons pull-right">

                    <li><a href="#" class="btn btn-default">Log Out</a></li>
                </ul>
            </div>
        </div><!-- END APP HEADER  --><!-- START APP CONTENT -->
        <div class="app-content">
            <div class="app-navigation-horizontal margin-bottom-15">
                <div class="container container-boxed">
                    <nav>
                        <ul>
                            <li class="openable active"><a href="#">
                                    <i class="fa fa-globe-americas"></i>
                                    Minha Conta</a>
                                <ul>
                                    <li class="active"><a href="index.php">Conta</a></li>
                                    <li><a href="#">Depositos</a></li>
                                    <li><a href="#">Pagamentos</a></li>
                                    <li><a href="#">Empréstimos</a></li>
                                </ul>
                            </li>
                            <li class="openable"><a href="#">
                                    <i class="fa fa-sync"></i>
                                    Histórico
                                </a>
                                <ul>
                                    <li><a href="pages-bank-activity.html">Recent Activity</a></li>
                                    <li><a href="#">Swift Activity</a></li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div><!-- START PAGE CONTAINER -->

            <div class="container container-boxed">
                <div class="alert alert-success alert-icon-block alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="fa fa-question-circle"></i>

                    </div>
                    Você tem empréstimo pré-aprovado em sua conta!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                class="fa fa-times"></span></button>
                </div>
                <div class="row">
                    <div class="col-md-6"><!-- CARDS -->
                        <div class="block block-condensed">
                            <div class="app-heading app-heading-small">
                                <div class="title"><h2>Saldo</h2>
                                    <p>Saldo atual da conta</p></div>
                                <div class="heading-elements">

                                    <!--<a href="#" class="btn btn-default btn-clean">Add card</a>-->
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="list-group margin-bottom-15">

                                    <a href="#"
                                       class="list-group-item list-group-item-highlighted">
                                        <div class="row">
                                            <div class="col-md-6"><h4
                                                        class="text-rg text-uppercase text-bolder margin-bottom-5">
                                                    Saldo Atual</h4>
                                                <p class="subheader">atualizado em 30/11/2021</p>
                                            </div>
                                            <div class="col-md-6 text-right"><h4
                                                        class="text-rg text-uppercase text-bolder margin-bottom-5">
                                                    $178.255,00</h4>
                                                <p class="subheader">
                                                    <!-- <span class="text-danger">-$14.88</span> 27.06.2017
                                                     20:00-->
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#"
                                       class="list-group-item list-group-item-highlighted">
                                        <div class="row">
                                            <div class="col-md-6"><h4
                                                        class="text-rg text-uppercase text-bolder margin-bottom-5">
                                                    Lançamentos Futuros</h4>
                                                <p class="subheader">atualizado em 30/11/2021</p>
                                            </div>
                                            <div class="col-md-6 text-right"><h4
                                                        class="text-rg text-uppercase text-bolder margin-bottom-5">
                                                    $0</h4>
                                                <p class="subheader">
                                                    <!-- <span class="text-danger">-$14.88</span> 27.06.2017
                                                     20:00-->
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="app-tip app-tip-runing app-tip-noborder app-tip-lg">
                                            <div class="app-tip-runner">Pague usando o internet banking e receba 5% de
                                                cachback
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- END CARDS --><!-- RECENT ACTIVITY -->
                        <div class="block block-condensed">
                            <div class="app-heading app-heading-small margin-bottom-0">
                                <div class="title"><h2>Movimentações recentes</h2>
                                </div>

                            </div>
                            <div class="block-divider-text">31/11/2021</div>
                            <div class="block-content">
                                <div class="listing margin-bottom-0">
                                    <div class="listing-item listing-item-with-icon"><span
                                                class="listing-item-icon">
                                            <i class="fa fa-shopping-cart"></i>
                                        </span><h4 class="text-rg text-bold">
                                            Transferência de fundos
                                            <span class="text-muted pull-right">31/11/2021 20:11</span>
                                        </h4>
                                        <div class="list-group list-group-inline">

                                            <div class="list-group-item col-md-6"><span
                                                        class="text-muted">Valor</span><br><span
                                                        class="text-bold text-danger">-$13.50</span></div>
                                            <div class="list-group-item col-md-6"><span
                                                        class="text-muted">Saldo</span><br><span
                                                        class="text-bold">$178.255,00</span></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="block-content">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3 col-sm-12"><a href="#"
                                                                                       class="btn btn-primary btn-clean btn-block">Ver tudo</a></div>
                                </div>
                            </div>

                        </div><!-- END RECENT --></div>
                    <div class="col-md-6"><!-- NEWS -->

                        <div class="block block-condensed">
                            <div class="app-heading app-heading-small">
                                <div class="title"><h2>Transferência</h2>
                                    <p>Você transfere dinheiro para outra conta</p></div>
                            </div>
                            <div class="block-content">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"><label>Destino</label>
                                            <select name="" id="" class="form-control form-control-sm ">
                                                <option value="0"></option>
                                            </select>
                                        </div>
                                        <div class="col-md-6"><label>Valor</label><input type="text"
                                                                                         class="form-control"
                                                                                         name="amout"
                                                                                         placeholder="0.00"></div>
                                    </div>
                                </div>

                                <div>
                                    <button class="btn btn-primary btn-clean pull-right">Transferir</button>
                                </div>
                            </div>
                        </div><!-- END TRANSFER --><!-- TRANSFER -->
                    </div>
                </div>
            </div>


            <!-- END PAGE CONTAINER --></div><!-- END APP CONTENT --></div><!-- END APP CONTAINER -->
    <!-- START APP FOOTER -->
    <div class="app-footer app-footer-default navbar-fixed-bottom" id="footer">
        <div class="container container-boxed">
            <div class="app-footer-line">
                <div class="copyright">© 2021 FS22Bank. All right reserved.</div>
                <div class="pull-right">
                    <ul class="list-inline">
                        <li><a href="#">About</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- END APP FOOTER --></div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
</body>
</html>
