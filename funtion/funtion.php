<?php

date_default_timezone_set( 'America/bogota' );
 function fechaC(){
    $mes = array("","enero"
    ,"febrero"
    ,"marzo"
    ,"abril"
    ,"mayo" 
    ,"junio"
    ,"julio"
    ,"agosto"
    ,"septiembre"
    ,"octubre"
    ,"noviembre"
    ,"diciembre");
    return date('d') . " de " . $mes[date('n')] . " del " . date('Y') . " - " . date('h:i A');
}




?>

