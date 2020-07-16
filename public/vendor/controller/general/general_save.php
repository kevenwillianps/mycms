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

$main = new Main();
$general = new General();

try {

    /** Verifico se a sessão esta ativa **/
    if ($main->verifySession()){

        /** Capturo meus campos envios por json **/
        $inputs = json_decode(file_get_contents('php://input'), true);

        /** Parâmetros de entrada **/
        $general_id      = isset($inputs['inputs']['general_id'])      ? (int)$main->antiInjection($inputs['inputs']['general_id'])       : 0;
        $user_id         = isset($inputs['inputs']['user_id'])         ? (int)$main->antiInjection($inputs['inputs']['user_id'])          : $_SESSION['MYSUPPORT-USER-ID'];
        $title           = isset($inputs['inputs']['title'])           ? (string)$main->antiInjection($inputs['inputs']['title'])         : '';
        $description     = isset($inputs['inputs']['description'])     ? (string)$main->antiInjection($inputs['inputs']['description'])   : '';
        $keywords        = isset($inputs['inputs']['keywords'])        ? (string)$main->antiInjection($inputs['inputs']['keywords'])      : '';
        $copyright       = isset($inputs['inputs']['copyright'])       ? (string)$main->antiInjection($inputs['inputs']['copyright'])     : '';
        $author          = isset($inputs['inputs']['author'])          ? (string)$main->antiInjection($inputs['inputs']['author'])        : '';
        $url             = isset($inputs['inputs']['url'])             ? (string)$main->antiInjection($inputs['inputs']['url'])           : '';
        $email           = isset($inputs['inputs']['email'])           ? (string)$main->antiInjection($inputs['inputs']['email'])         : '';
        $smtp            = isset($inputs['inputs']['smtp'])            ? (string)$main->antiInjection($inputs['inputs']['smtp'])          : '';
        $port            = isset($inputs['inputs']['port'])            ? (string)$main->antiInjection($inputs['inputs']['port'])          : '';
        $password        = isset($inputs['inputs']['password'])        ? (string)$main->antiInjection($inputs['inputs']['password'])      : '';
        $domain          = isset($inputs['inputs']['domain'])          ? (string)$main->antiInjection($inputs['inputs']['domain'])        : '';
        $charsert        = isset($inputs['inputs']['charsert'])        ? (string)$main->antiInjection($inputs['inputs']['charsert'])      : '';
        $username        = isset($inputs['inputs']['username'])        ? (string)$main->antiInjection($inputs['inputs']['username'])      : '';
        $session         = isset($inputs['inputs']['session'])         ? (string)$main->antiInjection($inputs['inputs']['session'])       : '';
        $number_register = isset($inputs['inputs']['number_register']) ? (int)$main->antiInjection($inputs['inputs']['number_register'])  : 0;
        $cnpj            = isset($inputs['inputs']['cnpj'])            ? (string)$main->antiInjection($inputs['inputs']['cnpj'])          : '';
        $endereco        = isset($inputs['inputs']['endereco'])        ? (string)$main->antiInjection($inputs['inputs']['endereco'])      : '';
        $telefone        = isset($inputs['inputs']['telefone'])        ? (string)$main->antiInjection($inputs['inputs']['telefone'])      : '';
        $celular         = isset($inputs['inputs']['celular'])         ? (string)$main->antiInjection($inputs['inputs']['celular'])       : '';
        $facebook        = isset($inputs['inputs']['facebook'])        ? (string)$main->antiInjection($inputs['inputs']['facebook'])      : '';
        $instagram       = isset($inputs['inputs']['instagram'])       ? (string)$main->antiInjection($inputs['inputs']['instagram'])     : '';
        $pinterest       = isset($inputs['inputs']['pinterest'])       ? (string)$main->antiInjection($inputs['inputs']['pinterest'])     : '';
        $twitter         = isset($inputs['inputs']['twitter'])         ? (string)$main->antiInjection($inputs['inputs']['twitter'])       : '';
        $date_register   = isset($inputs['inputs']['date_register'])   ? (string)$main->antiInjection($inputs['inputs']['date_register']) : date("y-m-d h:m:s");
        $date_update     = isset($inputs['inputs']['date_update'])     ? (string)$main->antiInjection($inputs['inputs']['date_update'])   : date("y-m-d h:m:s");

        /** Controle de erros **/
        $message = array();

        /** Validação de campos obrigatórios **/
        /** Verifico se o campo general_id foi preenchido **/
        if ($general_id < 0) {
            array_push($message, ' - $general_id - O seguinte campo deve ser preenchido/selecionado');
        }
        /** Verifico se o campo user_id foi preenchido **/
        if (empty($user_id)) {
            array_push($message, ' - $user_id - O seguinte campo deve ser preenchido/selecionado');
        }
        /** Verifico se o campo date_register foi preenchido **/
        if (empty($date_register)) {
            array_push($message, ' - $date_register - O seguinte campo deve ser preenchido/selecionado');
        }
        /** Verifico se o campo date_update foi preenchido **/
        if (empty($date_update)) {
            array_push($message, ' - $date_update - O seguinte campo deve ser preenchido/selecionado');
        }

        if (count($message) > 0) {

            /** Preparo o formulario para retorno **/
            $result = array(
                "cod" => 0,
                "message" => $message
            );
        } else {

            /** Executo o método para persistir os dados **/
            $general->save($general_id, $user_id, $title, $description, $keywords, $copyright, $author, $url, $email, $smtp, $port, $password, $domain, $charsert, $username, $session, $number_register, $cnpj, $endereco, $telefone, $celular, $facebook, $instagram, $pinterest, $twitter, $date_register, $date_update);

            /** Result **/
            $result = array(
                "cod" => 1,
                "message" => "Informações atualizadas com sucesso!"
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
