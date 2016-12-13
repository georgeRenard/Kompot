<?php

    set_include_path(
        get_include_path()
        . PATH_SEPARATOR 
        . "../../Intrusion Detection System/lib"
        );

    require_once "IDS/Init.php";
    require_once "Logger.php";
    use IDS\Init;

    try{
        
        $request = array(
        
            'REQUEST' => $_REQUEST,
            'GET' => $_GET,
            'POST' => $_POST,
            'COOKIE' => $_COOKIE
            
        );
    
        $init = Init::init(dirname(__FILE__) . 'IDS/Config/Config.ini');
        $init->config['General']['base_path'] = dirname(__FILE__) . '/IDS/';
        $init->config['General']['use_base_path'] = true;
        $init->config['Caching']['caching'] = 'file';
        $ids = new IDS_Monitor($request, $init);
        $result = $ids->run();
    
        if (!$result->isEmpty()) {
            require_once 'IDS/Log/File.php';
            require_once 'IDS/Log/Email.php';
            require_once 'IDS/Log/Composite.php';
            $compositeLog = new IDS_Log_Composite();
            $compositeLog->addLogger(IDS_Log_Email::getInstance($init),IDS_Log_File::getInstance($init));
            $compositeLog->execute($result);
        }

    }catch(Exception $ex){
        $logger = new Logger();
        $logger->logAnomaly($ex);
    }