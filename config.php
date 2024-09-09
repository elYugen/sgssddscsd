<?php 

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $port = '3306';
    $bdd = 'dwwm_rodez';

    try{
        $dbh = new PDO('mysql:host='.$host.';dbname='.$bdd, $user, $password);
        echo 'connexion effectué';
    } catch(PDOException $e ) {
        echo 'cpt';

    }
    
?>