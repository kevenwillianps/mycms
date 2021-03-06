<?php
/**
 * Created by MyCode
 * User: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

use \vendor\model\Main;
use \vendor\model\General;
use \vendor\model\ArrayUtf8Encode;

$main = new Main();
$general = new General();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

    /** Verifico se a sessão esta ativa **/
    if ($main->verifySession()){

        /** Executo o método **/
        $row = $general->get();

        /** Verifico se foi localizado algum registro **/
        if ((isset($row)) && ($row->general_id > 0)) {

            /** Result **/
            $result = array(
                "cod" => 1,
                "result" => $arrayUtf8Encode->utf8Converter($row)
            );
        } else {

            /** Preparo o formulario para retorno **/
            $result = array(
                "cod" => 0,
                "message" => "Não foram localizados registros"
            );
        }

    }else{

        /** Result **/
        $result = array(

            "cod" => 404,
            "message" => "Usuário não autenticado",

        );

    }

    /**Envio*/
    echo json_encode($result);

    /**Para o procedimento*/
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
