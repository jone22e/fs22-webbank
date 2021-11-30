<?php
include "vendor2/supertypes/autoload.php";

$clientes = simplexml_load_file("files/savegame1/farms.xml");

foreach ($clientes as $cliente) {
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
}
