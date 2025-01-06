<?php
#this is the connection to the db

// $dbhost = 'loaclhost';
// $dbuser = 'root';
// $dbpass = '';
// $dbname = 'forum';

// $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// if(!$conn){
//     die('Failed to connect to database'. mysqli_connect_error());
// }



# but the connection to the db can be done in a diff. way by using the define function

    try{
        #db host
        define('HOST','localhost'); 
        #db name
        define('DBNAME','forum');
        #db user
        define('USER','root');
        #db password
        define('PASS','');

        $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME."", USER, PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
    catch(PDOException $Exception){
        echo $Exception->getMessage();
    }