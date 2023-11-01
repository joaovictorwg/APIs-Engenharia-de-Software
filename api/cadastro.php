<?php

use Models\UserModel;



require ("vendor/autoload.php");

// aqui capturamos o método e o que está na url após o host:porta/
$method = $_SERVER ["REQUEST_METHOD"];
$url = $_SERVER ["REQUEST_URI"];

// terá que ser criado um if ou elif com um switch interno para cada método (post, get, put, delete)

if ($method == "GET") {

    // pode haver várias operações com o método post, cada uma delas será um case
    switch ($url) {

        case "/cadastro.php" : 
           
            $item = new Controllers\UserController ();

          
            

           
            
            
            
            
            $response = $item -> item (file_get_contents ("php://input"));

            echo ($response);
           
            break;

            // se nenhuma rota faz parte     do método a mensagem abaixo é retornada no echo
        default : 

            $response = [
                "status" => 404,
                "message" => "Rota $url nao encontrada"
            ];
            header ("HTTP/1.0 404 Page Not Allowed");
            echo (json_encode ($response));
    }
} 
else {
        if ($method == "POST") {
            if ($url == "/cadastro.php") {

                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                if(!empty($dados['SendCadUser'])){
                    //var_dump($dados);
                
                    $nome_item = $_POST['nome_item'];
                    $preco_item = $_POST['preco_item'];
                    $descricao_item = $_POST['descricao_item'];
                    $itens = new UserModel();
                    $itens->addItem($nome_item, $preco_item, $descricao_item);
            
                    echo "Item adicionado com sucesso!";
                    header("Location: cadastro.php");
                }
                
        
                
            }
        }
        else{
            $response = [
                "status" => 405,
                "message" => "Metodo $method nao permitido"
            ];
            header ("HTTP/1.0 405 Method Not Allowed");
            echo (json_encode ($response));
        }
}
    
    

    



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Itens</title>
</head>
<body>
    <div>
        <h2>Cadastro de Itens</h2>
        <form action="" method="post">
            
            <label for="nome_item" class="labelInput">Nome do Item</label><br>
            <input type="text" name="nome_item" placeholder="Nome do Item">
            <br><br>
            <label for="preco_item" class="labelInput">Preço do Item</label><br>
            <input type="text" name="preco_item" placeholder="Preço do Item">
            <br><br>
            <label for="descricao_item" class="labelInput">Descrição do Item</label><br>
            <textarea name="descricao_item" placeholder="Descrição do Item"></textarea>

            <br><br>
            <input type="submit" name="SendCadUser" id="submit"><br><br>

    </form>

    <a href="lista.php">Listagem de Itens</a>
    </div>
    
</body>
</html>