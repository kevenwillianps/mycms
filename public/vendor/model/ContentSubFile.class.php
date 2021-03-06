<?php

/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 **/

/** Informo o local onde esta minha classe **/
namespace vendor\model;

class ContentSubFile
{

    /** Declaro as variveis que irei utilizar na classe **/
    private $connection = null;
    private $sql = null;
    private $stmt = null;
    private $content_sub_file_id = 0;
    private $content_sub_id = 0;
    private $user_id = 0;
    private $situation_id = 0;
    private $highlighter_file_id = 0;
    private $position = 0;
    private $name = null;
    private $description = null;
    private $base64 = null;
    private $file_type = null;
    private $path = null;
    private $date_register = null;
    private $date_update = null;

    /** Construtor da classe **/
    public function __construct()
    {

        /** Cria o objeto de conexão com o banco de dados **/
        $this->connection = new MySql();

        /** Inicio a conexão com o banco de dados **/
        $this->connection->connect();
    }

    /** Listo a quantidade total de registros **/
    public function get($content_sub_file_id)
    {

        /** Parâmetro de entrada **/
        $this->content_sub_file_id = (int)$content_sub_file_id;

        /** Consulta SQL **/
        $this->sql = "select * from content_sub_file where content_sub_file_id = :content_sub_file_id";

        /** Preparo o Sql **/
        $stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do SQl **/
        $stmt->bindValue(':content_sub_file_id', $this->content_sub_file_id);

        /** Executo o SQl **/
        $stmt->execute();

        /** Retorno um objeto **/
        return $stmt->fetchObject();
    }

    /** Lista um registro específico **/
    public function getLast()
    {

        /** Consulta SQL **/
        $this->sql = "select * from content_sub_file order by content_sub_file_id desc limit 1";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQl **/
        $this->stmt->execute();

        /** Retorno um objeto **/
        return $this->stmt->fetchObject();
    }

    /** Listo a quantidade total de registros **/
    public function getFiles($content_sub_id)
    {

        /** Parâmetros de Entrada **/
        $this->content_sub_id = (int)$content_sub_id;

        /** Consulta SQL **/
        $this->sql = "select * from content_sub_file where content_sub_id = :content_sub_id order by position asc";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Defino os valores dos parâmetros **/
        $this->stmt->bindParam(':content_sub_id', $this->content_sub_id);

        /** Executo o Sql **/
        $this->stmt->execute();

        /** Retorno um objeto **/
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Lista todos os registros **/
    public function all()
    {

        /** Consulta SQL **/
        $this->sql = "select * from content_sub_file";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQl **/
        $this->stmt->execute();

        /** Retorno um objeto **/
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Insere/autualiza um registro no banco de dados **/
    public function save($content_sub_file_id, $content_sub_id, $user_id, $situation_id, $highlighter_file_id, $position, $name, $description, $base64, $file_type, $path, $date_register, $date_update)
    {

        /** Parâmetros de entrada **/
        $this->content_sub_file_id = (int)$content_sub_file_id;
        $this->content_sub_id      = (int)$content_sub_id;
        $this->user_id             = (int)$user_id;
        $this->situation_id        = (int)$situation_id;
        $this->highlighter_file_id = (int)$highlighter_file_id;
        $this->position            = (int)$position;
        $this->name                = (string)$name;
        $this->description         = (string)$description;
        $this->base64              = (string)$base64;
        $this->file_type           = (string)$file_type;
        $this->path                = (string)$path;
        $this->date_register       = (string)$date_register;
        $this->date_update         = (string)$date_update;

        /** Verifico se é inserção ou atualização **/
        if ($this->content_sub_file_id == 0) {

            /** Consulta SQL **/
            $this->sql = "INSERT INTO content_sub_file(content_sub_file_id, content_sub_id, user_id, situation_id, highlighter_file_id, position, name, description, base64, file_type, path, date_register, date_update)VALUES(:content_sub_file_id, :content_sub_id, :user_id, :situation_id, :highlighter_file_id, :position, :name, :description, :base64, :file_type, :path, :date_register, :date_update)";
        } else {

            /** Consulta SQL **/
            $this->sql = "UPDATE content_sub_file set content_sub_file_id = :content_sub_file_id, content_sub_id = :content_sub_id, user_id = :user_id, situation_id = :situation_id, highlighter_file_id = :highlighter_file_id, position = :position, name = :name, description = :description, base64 = :base64, file_type = :file_type, path = :path, date_register = :date_register, date_update = :date_update WHERE content_sub_file_id = :content_sub_file_id";
        }

        /** Preparo o sql para execução **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do Sql **/
        $this->stmt->bindParam(':content_sub_file_id', $this->content_sub_file_id);
        $this->stmt->bindParam(':content_sub_id', $this->content_sub_id);
        $this->stmt->bindParam(':user_id', $this->user_id);
        $this->stmt->bindParam(':situation_id', $this->situation_id);
        $this->stmt->bindParam(':highlighter_file_id', $this->highlighter_file_id);
        $this->stmt->bindParam(':position', $this->position);
        $this->stmt->bindParam(':name', $this->name);
        $this->stmt->bindParam(':description', $this->description);
        $this->stmt->bindParam(':base64', $this->base64);
        $this->stmt->bindParam(':file_type', $this->file_type);
        $this->stmt->bindParam(':path', $this->path);
        $this->stmt->bindParam(':date_register', $this->date_register);
        $this->stmt->bindParam(':date_update', $this->date_update);

        /** retorno e executo o sql **/
        return $this->stmt->execute();
    }

    /** Excluo um registro específico **/
    public function delete($content_sub_file_id)
    {

        /** Parâmetro de entrada **/
        $this->content_sub_file_id = (int)$content_sub_file_id;

        /** Consulta SQL **/
        $this->sql = "DELETE FROM content_sub_file WHERE content_sub_file_id = :content_sub_file_id";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do SQl **/
        $this->stmt->bindValue(':content_sub_file_id', $this->content_sub_file_id);

        /** Retorno um objeto **/
        return $this->stmt->execute();
    }
}
