<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

/** Importo as classes que irei utilizar **/
use \vendor\model\Main;
use \vendor\model\Highlighter;
use \vendor\model\ArrayUtf8Encode;

/** Instânciamento das classes **/
$main = new Main();
$highlighter = new Highlighter();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

    /** Verifico se a sessão esta ativa **/
    if ($main->verifySession()){

        /** Result **/
        $result = array(
            "result" => $arrayUtf8Encode->utf8Converter($highlighter->all())
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
