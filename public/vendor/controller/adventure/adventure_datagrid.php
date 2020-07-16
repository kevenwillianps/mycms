<?php
/**
 * Created by PhpStorm.
 * User: KEVEN
 * Date: 03/07/2020
 * Time: 09:08
 */

/** Importo as classes que irei utilizar **/
use \vendor\model\User;
use \vendor\model\Main;
use \vendor\model\Content;
use \vendor\model\ContentSub;
use \vendor\model\ArrayUtf8Encode;

/** Instanciamento das classes importadas **/
$user = new User();
$main = new Main();
$content = new Content();
$contentSub = new ContentSub();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

    /** Verifico se a sessão esta ativa **/
    if ($main->verifySession()){

        /** Result **/
        $result = array(

            "result_user" => $arrayUtf8Encode->utf8Converter($user->getTopProfiles()),
            "result_content" => $arrayUtf8Encode->utf8Converter($content->getContent()),
            "result_content_sub" => $arrayUtf8Encode->utf8Converter($contentSub->getContentSub())

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
