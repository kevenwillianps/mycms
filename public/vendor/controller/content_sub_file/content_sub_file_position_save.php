<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

/** Realizo a importação de classes **/
use \vendor\model\Main;
use \vendor\model\ContentSubFile;

/** Instânciamento das classes importadas **/
$main = new Main();
$contentSubFile = new ContentSubFile();

try {

    /** Verifico se a sessão esta ativa **/
    if ($main->verifySession()){

        /** Capturo meus campos envios por json **/
        $inputs = json_decode(file_get_contents('php://input'), true);

        $i = 0;

        while ($i < count($inputs['inputs']))
        {

            /** Parâmetros de entrada **/
            $content_sub_file_id = isset($inputs['inputs'][$i]['content_sub_file_id']) ? (int)$main->antiInjection($inputs['inputs'][$i]['content_sub_file_id']) : 0;
            $content_sub_id      = isset($inputs['inputs'][$i]['content_sub_id'])      ? (int)$main->antiInjection($inputs['inputs'][$i]['content_sub_id'])      : 0;
            $user_id             = isset($inputs['inputs'][$i]['user_id'])             ? (int)$main->antiInjection($inputs['inputs'][$i]['user_id'])             : $_SESSION['MYSUPPORT-USER-ID'];
            $situation_id        = isset($inputs['inputs'][$i]['situation_id'])        ? (int)$main->antiInjection($inputs['inputs'][$i]['situation_id'])        : 1;
            $highlighter_file_id = isset($inputs['inputs'][$i]['highlighter_file_id']) ? (int)$main->antiInjection($inputs['inputs'][$i]['highlighter_file_id']) : 1;
            $position            = isset($inputs['inputs'][$i]['position'])            ? (int)$main->antiInjection($inputs['inputs'][$i]['position'])            : 0;
            $name                = isset($inputs['inputs'][$i]['name'])                ? (string)$main->antiInjection($inputs['inputs'][$i]['name'])             : '';
            $description         = isset($inputs['inputs'][$i]['description'])         ? (string)$main->antiInjection($inputs['inputs'][$i]['description'])      : '';
            $base64              = isset($inputs['inputs'][$i]['base64'])              ? (string)$main->antiInjection($inputs['inputs'][$i]['base64'])           : '';
            $file_type           = isset($inputs['inputs'][$i]['file_type'])           ? (string)$main->antiInjection($inputs['inputs'][$i]['file_type'])        : '';
            $path                = isset($inputs['inputs'][$i]['path'])                ? (string)$main->antiInjection($inputs['inputs'][$i]['path'])             : '';
            $date_register       = isset($inputs['inputs'][$i]['date_register'])       ? (string)$main->antiInjection($inputs['inputs'][$i]['date_register'])    : date("y-m-d h:m:s");
            $date_update         = isset($inputs['inputs'][$i]['date_update'])         ? (string)$main->antiInjection($inputs['inputs'][$i]['date_update'])      : date("y-m-d h:m:s");

            /** Controle de erros **/
            $message = array();

            /** Validação de campos obrigatórios **/
            /** Verifico se o campo class_id foi preenchido **/
            if ($content_sub_file_id <= 0) {

                array_push($message, '$content_file_id - O seguinte campo deve ser preenchido/selecionado');

            }
            /** Verifico se o campo class_id foi preenchido **/
            if ($position < 0) {

                array_push($message, '$position - O seguinte campo deve ser preenchido/selecionado');

            }

            /** Verifico se existem erros **/
            if (count($message) > 0) {

                /** Preparo o formulario para retorno **/
                $result = array(

                    "cod" => 0,
                    "message" => $message

                );

            } else {

                $contentSubFile->save($content_sub_file_id, $content_sub_id, $user_id, $situation_id, $highlighter_file_id, $position, $name, $description, $base64, $file_type, $path, $date_register, $date_update);

                /** Result **/
                $result = array(

                    "cod" => 1,
                    "message" => "Informações atualizadas com sucesso!"

                );

            }

            $i++;

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
        "message" => $e->getMessage(),

    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
