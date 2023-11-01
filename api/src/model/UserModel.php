<?php 

// atribui o namespace (apelido), chama o autoload de classes e chama a classe Connection e o PDO


namespace Models;
require_once ("vendor/autoload.php");
use Connections\Connection;
use PDO;

Class UserModel {

    // A função espera dois parâmetros, cria um objeto $connection que será a conexão com o banco de dados
    // e depois a $sql recebe o resultado da função connect que executa uma query passada internamente.
    // A variável $sql é reaproveitada e recebe o fetch do resultado do banco de dados (pesquisa sobre o que é fetch).
    // O resultado da $sql é retonado.

    function item ($nome_item) {
        $connection = new Connection ();
        $sql = $connection -> connect () -> query ("SELECT * FROM item WHERE nome_item = '$nome_item'");
        $sql = $sql -> fetchAll (PDO::FETCH_ASSOC);
        return $sql;
    }

    function data_itens () {
        $connection = new Connection ();
        $sql = $connection -> connect () -> query ("SELECT * FROM item ");
        $sql = $sql -> fetchAll (PDO::FETCH_ASSOC);
        return $sql;
    }

    function addItem($nome_item, $preco_item, $descricao_item) {
      
            $connection = new Connection();

            // Preparar a consulta SQL para inserir um novo item
            $sql = "INSERT INTO item (nome_item, preco_item, descricao_item) VALUES (:nome_item, :preco_item, :descricao_item)";

            $stmt = $connection->connect()->prepare($sql);

            // Vincular os parâmetros
            $stmt->bindParam(':nome_item', $nome_item);
            $stmt->bindParam(':preco_item', $preco_item);
            $stmt->bindParam(':descricao_item', $descricao_item);

            // Executar a consulta
            $stmt->execute();

            // Verificar se a inserção foi bem-sucedida
            if ($stmt->rowCount() > 0) {
                return true; // Inserção bem-sucedida
            } else {
                return false; // Falha na inserção
            }
      
    }
}


?>