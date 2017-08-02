<?php
include_once "Configuration.php";

function writeLogInfo($user_name, $action){
    //something to write to txt log
    $log = "Date: ".date("Y-m-d H:i:s")." - User: $user_name ".PHP_EOL.
            "Info: $action".PHP_EOL.
            "--------------------------".PHP_EOL;
    $log_file_info = Configuration::getConfiguration()->getLogFileInfo();
    if($log_file_info == 1){
        file_put_contents('Log/log_'.date("Y-m-d").'.txt',$log, FILE_APPEND);
    }

}