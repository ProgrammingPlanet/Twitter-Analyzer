<?php

    const HOST = 'localhost';
    const USER = 'root';
    const PASSWORD = '07860';
    const DBNAME = 'TwitterAnalizer';

    try{
        $db = new PDO('mysql:host='.HOST.';dbname='.DBNAME,USER,PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // set the PDO error mode to exception
    }
    catch(PDOException $e){
        die( "Database Connection failed: ".$e->getMessage() );
    }

    date_default_timezone_set('Asia/Kolkata');

?>
