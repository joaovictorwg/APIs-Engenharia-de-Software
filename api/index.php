<?php 

    // a api só aceita json como entrada
    header ("Content-Type: application/json");

    require ("vendor/autoload.php");

    // aqui capturamos o método e o que está na url após o host:porta/
    $method = $_SERVER ["REQUEST_METHOD"];
    $url = $_SERVER ["REQUEST_URI"];

    // terá que ser criado um if ou elif com um switch interno para cada método (post, get, put, delete)
    if ($method == "GET") {

        // pode haver várias operações com o método post, cada uma delas será um case
        switch ($url) {

            case "/item" : 

                $item = new Controllers\UserController ();
                
                //aqui nós passamos como parâmetro para a função logino file_get_contents ("php://input")
                // que vai capturar o json que foi passado como entrada e se houver sucesso a resposta no echo
                // será o que foi desejado
                $response = $item -> item (file_get_contents ("php://input"));
                echo "aaaaaaaaa";
                echo ($response);
                break;

                // se nenhuma rota faz parte do método a mensagem abaixo é retornada no echo
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