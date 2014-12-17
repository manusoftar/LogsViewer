<?php
    $tipo = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
    
    //Si no recibo el tipo de registro que debo mostrar salgo sin hacer nada
    if (strlen($tipo)==0){
        exit(json_encode(array("success"=>false)));
    }
    
    $sistema = isset($_REQUEST['sist']) ? $_REQUEST['sist'] : '';
    
    //Si no recibo el sistema salgo sin hacer nada
    if (strlen($sistema)==0){
        exit(json_encode(array("success"=>false)));
    }
    
    
    $lineas = isset($_REQUEST['lines']) ? $_REQUEST['lines'] : '';
    
    //Si no recibo la cantidad de líneas que debo mostrar salgo sin hacer nada
    if (strlen($lineas)==0){
        exit(json_encode(array("success"=>false)));
    }
    
    
    
                     
    /*switch ($tipo){
        case "1":
        case "2":
        case "4":
                 $lineas *= 1;
                 break;
        case "3":
        case "5":
        case "6":
                 $lineas *= 2;
                 break;
        case "7":
                 $lineas *= 3;
                 break; 
    }*/

    $path_init = "/var/log/";
    $paths = array("0" => "joomla/apache/", "1" => "moodle/apache/", "2" => "vtiger/apache/", "3" => "adserver/apache/", "4" => "erp/apache/", "5" => "cportal/apache/");
    
    $logs = array("1" => "$path_init$paths[$sistema]php5.log", "2" => "$path_init$paths[$sistema]error.log", 
                  "3" => "$path_init$paths[$sistema]php5.log $path_init$paths[$sistema]error.log", "4" => "$path_init$paths[$sistema]access.log",
                  "5" => "$path_init$paths[$sistema]php5.log $path_init$paths[$sistema]access.log", 
                  "6" => "$path_init$paths[$sistema]access.log $path_init$paths[$sistema]error.log", 
                  "7" => "$path_init$paths[$sistema]php5.log $path_init$paths[$sistema]error.log $path_init$paths[$sistema]access.log");
    
    
    $datos = `tail -n$lineas $logs[$tipo]`;
    
    exit(json_encode(array("success"=>true,"data"=>$datos)));
?>