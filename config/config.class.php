<?php
    define("SGBD", 'mysql');
    define("DBHOST",'localhost');
    define("DBNAME",'boken'); //
    define("DBUSER",'boken');
    define("DBPASS",'123');
    define("DBPORT",'3306');

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>