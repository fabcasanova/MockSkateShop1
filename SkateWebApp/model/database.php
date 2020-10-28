<?php
    $dsn = 'mysql:host=localhost;dbname=skateboardshop';
    $username = 'fabian';
    $password = 'jangofett123';

    try{

        $db = new PDO($dsn, $username, $password);
        //echo "Database is connected";
    }
    catch(PDOException $e){

        $error_message = $e->getMessage();
        echo "Database connection failed!";
        exit();
    }
    //http://localhost/SkateWebApp/model/database.php
?>