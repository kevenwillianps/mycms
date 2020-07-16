<?php

/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 **/

/** Defino o local onde a classe esta localizada **/
namespace vendor\model;

class HighlighterFile
{

    /** Variaveis que irei utilizar na classe **/
    private $connection = null;
    private $sql = null;
    private $stmt = null;
    private $highlighter_file_id = 0;
    private $user_id = 0;
    private $name = null;
    private $description = null;
    private $date_register = 0;
    private $date_update = 0;

    /** Construtor da classe **/
    public function __construct()
    {

        /** Cria o objeto de conexão com o banco de dados **/
        $this->connection = new MySql();

        /** Inicio uma conexão com o banco de dados **/
        $this->connection->connect();
    }

    /** Listo a quantidade total de registros **/
    public function editForm($highlighter_file_id)
    {

        /** Parâmetro de entrada **/
        $this->highlighter_file_id = (int)$highlighter_file_id;

        /** Consulta SQL **/
        $this->sql = "select * from highlighter_file where highlighter_file_id = :highlighter_file_id";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do SQl **/
        $this->stmt->bindValue(':highlighter_file_id', $this->highlighter_file_id);

        /** Executo o SQl **/
        $this->stmt->execute();

        /** Retorno um objeto **/
        return $this->stmt->fetchObject();
    }

    /** Listo a quantidade total de registros **/
    public function get($highlighter_file_id)
    {

        /** Parâmetro de entrada **/
        $this->highlighter_file_id = (int)$highlighter_file_id;

        /** Consulta SQL **/
        $this->sql = "select * from highlighter_file where highlighter_file_id = :highlighter_file_id";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do SQl **/
        $this->stmt->bindValue(':highlighter_file_id', $this->highlighter_file_id);

        /** Executo o SQl **/
        $this->stmt->execute();

        /** Retorno um objeto **/
        return $this->stmt->fetchObject();
    }

    /** Lista todos os registros **/
    public function all()
    {

        /** Consulta SQL **/
        $this->sql = "select * from highlighter_file";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQl **/
        $this->stmt->execute();

        /** Retorno um objeto **/
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Insere/autualiza um registro no banco de dados **/
    public function save($highlighter_file_id, $user_id, $name, $description, $date_register, $date_update)
    {

        /** Parâmetros de entrada **/
        $this->highlighter_file_id = (int)$highlighter_file_id;
        $this->user_id             = (int)$user_id;
        $this->name                = (string)$name;
        $this->description         = (string)$description;
        $this->date_register       = (string)$date_register;
        $this->date_update         = (string)$date_update;

        /** Verifico se é inserção ou atualização **/
        if ($this->highlighter_file_id == 0) {

            /** Consulta SQL **/
            $this->sql = "INSERT INTO highlighter_file(highlighter_file_id, user_id, name, description, date_register, date_update)VALUES(:highlighter_file_id, :user_id, :name, :description, :date_register, :date_update)";
        } else {

            /** Consulta SQL **/
            $this->sql = "UPDATE highlighter_file set highlighter_file_id = :highlighter_file_id, user_id = :user_id, name = :name, description = :description, date_register = :date_register, date_update = :date_update WHERE highlighter_file_id = :highlighter_file_id";
        }

        /** Preparo o SQL **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do sql **/
        $this->stmt->bindValue(':highlighter_file_id', $this->highlighter_file_id);
        $this->stmt->bindValue(':user_id', $this->user_id);
        $this->stmt->bindValue(':name', $this->name);
        $this->stmt->bindValue(':description', $this->description);
        $this->stmt->bindValue(':date_register', $this->date_register);
        $this->stmt->bindValue(':date_update', $this->date_update);

        /** Executo o Sql **/
        return $this->stmt->execute();
    }

    /** Excluo um registro específico **/
    public function delete($highlighter_file_id)
    {

        /** Parâmetro de entrada **/
        $this->highlighter_file_id = (int)$highlighter_file_id;

        /** Consulta SQL **/
        $this->sql = "DELETE FROM highlighter_file WHERE highlighter_file_id = :highlighter_file_id";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do SQl **/
        $this->stmt->bindValue(':highlighter_file_id', $this->highlighter_file_id);

        /** Retorno um objeto **/
        return $this->stmt->execute();
    }
}
