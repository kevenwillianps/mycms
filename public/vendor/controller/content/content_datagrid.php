<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

/** Importo a classes que irei utilizar **/
use \vendor\model\Main;
use \vendor\model\Content;
use \vendor\model\ArrayUtf8Encode;

/** Realizo o instânciamento das classes importadas **/
$main = new Main();
$content = new Content();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

    /** Verifico se a sessão esta ativa **/
    if ($main->verifySession()){

        /** Resultado **/
        $result = array(

            /** Execução do métdo que lista todos os registros **/
            "result" => $arrayUtf8Encode->utf8Converter($content->all())

        );

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
