<?php
date_default_timezone_set('America/Mexico_City');
function getBackgroundClass() {
    $hour = date('H'); // Obtiene la hora en formato de 24 horas (00-23)



    if ($hour >= 5 && $hour < 8) {
        return 'background-morning';
    } elseif ($hour >= 8 && $hour < 14) {
        return 'background-day';
    } elseif ($hour >= 14 && $hour < 18) {
        return 'background-afternoon';
    }else{
        return 'background-evening';
    }
}
$backgroundClass = getBackgroundClass();




?>
