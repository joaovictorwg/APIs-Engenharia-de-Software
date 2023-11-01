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

        case "/lista.php" : 
           
            $item = new Controllers\UserController ();

            $itens = new UserModel();
            $itens = $itens -> data_itens();
            
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
} else {
    // se o método passado não está em nenhum if então ele não faz parte da api logo
    // a mensagem abaixo é retornada no echo
    $response = [
        "status" => 405,
        "message" => "Metodo $method nao permitido"
    ];
    header ("HTTP/1.0 405 Method Not Allowed");
    echo (json_encode ($response));

    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Itens</title>
</head>
<body>
    <div>
        <h1>Listagem de Itens</h1>
        <br>
        <?php
            foreach($itens as $item){
        ?>

        <p><h2><?php echo $item['nome_item']?></h2></p>
        <p><?php echo $item['preco_item']?></p>
        <p><?php echo $item['descricao_item']?></p>

        <?php
            }
        ?>
    </div>
    
</body>
</html>

