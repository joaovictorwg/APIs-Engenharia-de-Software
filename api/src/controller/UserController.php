<?php 

// atribui o namespace (apelido), chama o autoload para poder chamar classes de outros arquivos
// chama o arquivo UserModel com a classe UserModel

namespace Controllers;
require_once ("vendor/autoload.php");
use Models\UserModel;

Class UserController {

    // recebe um objeto json, decodifica ele e guarda seus campos para passar como parâmetro
    // para a função do objeto $user instanciado com a classe UserModel.
    // Se tudo funcionou o banco retornou 1 linha que terá seus campos encapsulados na variável
    // $data que será transformada num objeto json para ser retornada

    function item ($jsonObject) {
        $item = new UserModel ();

        $data = json_decode ($jsonObject , true);
        $nome_item = $data ["nome_item"];
        

        $item = $item -> item ($nome_item);

        if (isset ($item [0])) {
            
            $data = [
                "nome" => $item [0] ["nome_item"],
                "preco" => $item [0] ["preco_item"],
                "descricao" => $item [0] ["descricao_item"]
            ];
            
            $data = json_encode ($data);

            return $data;
        }
    }
}