<!--
Carlos Munoz
final
INFO_1335_4A
Rosas
5-26-2021
-->
<?php
    //Connection to database
    $dsn = 'mysql:host=localhost;dbname=grades_db';
    $username = 'carlos';
    $password = 'mCC**$';
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $db = new PDO ($dsn, $username, $password, $options) ;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'database_error.php';
        exit();
    }
?>