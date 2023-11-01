<?php 

// atribui o namespace (que funciona como apelido), faz o require do autoload e usa o PDO
namespace Connections;
require_once ("vendor/autoload.php");
use PDO;

Class Connection {

    //a função apenas cria uma coneção pdo com o banco de dados e retorna a conexão

    function connect () {
        $host = "localhost";
        $dbName = "api_jvwg";
        $userName = "postgres";
        $password = "1234";
        $port = "5432";

        $pdo = new PDO ("pgsql:host=$host;port=$port;dbname=$dbName" , $userName , $password);
        return $pdo;
    }

}

?>