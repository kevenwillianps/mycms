<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 04/06/2020
 * Time: 10:49
 **/

/** Importo as classes que irei utilizar **/
use \vendor\model\Main;
use \vendor\model\UserFunction;
use \vendor\model\ArrayUtf8Encode;

/** Instânciamento de classes **/
$main = new Main();
$userFunction = new UserFunction();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

    /** Verifico se a sessão esta ativa **/
    if ($main->verifySession()){

        /** Capturo meus campos envios por json **/
        $inputs = json_decode(file_get_contents('php://input'), true);

        /** Parâmetros de entrada  **/
        $user_function_id = isset($inputs['inputs']['user_function_id']) ? (int)$main->antiInjection($inputs['inputs']['user_function_id']) : 0;

        /** Controle de erros **/
        $message = array();

        /** Verifico se o campo é válido **/
        if ($user_function_id <= 0) {
            array_push($message, "O campo 'UserFunctionID', deve ser preenchido");
        }

        /** Verifico se existem erros **/
        if (count($message) > 0) {

            /** Result **/
            $result = array(

                "cod" => 0,
                "result" => $message,

            );
        } else {

            /** Result **/
            $result = array(

                "cod" => 1,
                "result" => $arrayUtf8Encode->utf8Converter($userFunction->editForm($user_function_id))

            );
        }


    }else{

        /** Result **/
        $result = array(

            "cod" => 404,
            "message" => "Usuário não autenticado",

        );

    }

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
} catch (Exception $e) {

    /** Preparo o formulario para retorno **/
    $result = array(

        "cod" => 0,
        "message" => $e->getMessage()

    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
}
