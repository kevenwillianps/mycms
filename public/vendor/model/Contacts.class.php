<?php

/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 **/

/** Defino o local onde a classe esta localizada **/
namespace vendor\model;

class Contacts
{

    /** Variaveis que irei utilizar na classe **/
    private $connection = null;
    private $stmt = null;
    private $sql = null;
    private $contact_id = 0;

    /** Construtor da classe **/
    public function __construct()
    {

        /** Cria o objeto de conexão com o banco de dados **/
        $this->connection = new MySql();

        /** Inicio uma conexão com o banco de dados **/
        $this->connection->connect();
    }

    /** Listo a quantidade total de registros **/
    public function get($contact_id)
    {

        /** Parâmetro de entrada **/
        $this->contact_id = (int)$contact_id;

        /** Consulta SQL **/
        $this->sql = "select * from contacts where contact_id = :contact_id";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do SQl **/
        $this->stmt->bindValue(':contact_id', $this->contact_id);

        /** Executo o SQl **/
        $this->stmt->execute();

        /** Retorno um objeto **/
        return $this->stmt->fetchObject();
    }

    /** Lista todos os registros **/
    public function all()
    {

        /** Consulta SQL **/
        $this->sql = "select * from contacts";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQl **/
        $this->stmt->execute();

        /** Retorno um objeto **/
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Excluo um registro específico **/
    public function delete($contact_id)
    {

        /** Parâmetro de entrada **/
        $this->contact_id = (int)$contact_id;

        /** Consulta SQL **/
        $this->sql = "DELETE FROM contacts WHERE contact_id = :contact_id";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do SQl **/
        $this->stmt->bindValue(':contact_id', $this->contact_id);

        /** Retorno um objeto **/
        return $this->stmt->execute();
    }

    /** Construtor da classe **/
    public function __destruct()
    {

        /** Cria o objeto de conexão com o banco de dados **/
        $this->connection = null;
    }
}
