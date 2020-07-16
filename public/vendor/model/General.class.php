<?php

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   namespace vendor\model;

   class General
   {
       private $connection = null;
       private $sql = null;
       private $stmt = null;
       private $general_id = null;
       private $user_id = null;
       private $title = null;
       private $description = null;
       private $keywords = null;
       private $copyright = null;
       private $author = null;
       private $url = null;
       private $email = null;
       private $smtp = null;
       private $port = null;
       private $password = null;
       private $domain = null;
       private $charsert = null;
       private $username = null;
       private $session = null;
       private $number_register = null;
       private $cnpj = null;
       private $endereco = null;
       private $telefone = null;
       private $celular = null;
       private $facebook = null;
       private $instagram = null;
       private $pinterest = null;
       private $twitter = null;
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
       public function get()
       {

           /** Consulta SQL **/
           $this->sql = "select * from general order by general_id desc limit 1";

           /** Preparo o SQL **/
           $this->stmt = $this->connection->connect()->prepare($this->sql);

           /** Executo o Sql **/
           $this->stmt->execute();

           return $this->stmt->fetchObject();
       }

       /** Insere/autualiza um registro no banco de dados **/
       public function save($general_id, $user_id, $title, $description, $keywords, $copyright, $author, $url, $email, $smtp, $port, $password, $domain, $charsert, $username, $session, $number_register, $cnpj, $endereco, $telefone, $celular, $facebook, $instagram, $pinterest, $twitter, $date_register, $date_update)
       {

           /** Parâmetros de entrada **/
           $this->general_id      = (int)$general_id;
           $this->user_id         = (int)$user_id;
           $this->title           = (string)$title;
           $this->description     = (string)$description;
           $this->keywords        = (string)$keywords;
           $this->copyright       = (string)$copyright;
           $this->author          = (string)$author;
           $this->url             = (string)$url;
           $this->email           = (string)$email;
           $this->smtp            = (string)$smtp;
           $this->port            = (string)$port;
           $this->password        = (string)$password;
           $this->domain          = (string)$domain;
           $this->charsert        = (string)$charsert;
           $this->username        = (string)$username;
           $this->session         = (string)$session;
           $this->number_register = (int)$number_register;
           $this->cnpj            = (string)$cnpj;
           $this->endereco        = (string)$endereco;
           $this->telefone        = (string)$telefone;
           $this->celular         = (string)$celular;
           $this->facebook        = (string)$facebook;
           $this->instagram       = (string)$instagram;
           $this->pinterest       = (string)$pinterest;
           $this->twitter         = (string)$twitter;
           $this->date_register   = (string)$date_register;
           $this->date_update     = (string)$date_update;

           /** Verifico se é inserção ou atualização **/
           if ($this->general_id == 0) {

               /** Consulta SQL **/
               $this->sql = "INSERT INTO general(general_id, user_id, title, description, keywords, copyright, author, url, email, smtp, port, password, domain, charsert, username, session, number_register, cnpj, endereco, telefone, celular, facebook, instagram, pinterest, twitter, date_register, date_update)VALUES(:general_id, :user_id, :title, :description, :keywords, :copyright, :author, :url, :email, :smtp, :port, :password, :domain, :charsert, :username, :session, :number_register, :cnpj, :endereco, :telefone, :celular, :facebook, :instagram, :pinterest, :twitter, :date_register, :date_update)";
           } else {

               /** Consulta SQL **/
               $this->sql = "UPDATE general set general_id = :general_id, user_id = :user_id, title = :title, description = :description, keywords = :keywords, copyright = :copyright, author = :author, url = :url, email = :email, smtp = :smtp, port = :port, password = :password, domain = :domain, charsert = :charsert, username = :username, session = :session, number_register = :number_register, cnpj = :cnpj, endereco = :endereco, telefone = :telefone, celular = :celular, facebook = :facebook, instagram = :instagram, pinterest = :pinterest, twitter = :twitter, date_register = :date_register, date_update = :date_update WHERE general_id = :general_id";
           }

           /** Preparo o sql **/
           $this->stmt = $this->connection->connect()->prepare($this->sql);

           /** Preencho os parâmetros do SQL **/
           $this->stmt->bindParam(':general_id', $this->general_id);
           $this->stmt->bindParam(':user_id', $this->user_id);
           $this->stmt->bindParam(':title', $this->title);
           $this->stmt->bindParam(':description', $this->description);
           $this->stmt->bindParam(':keywords', $this->keywords);
           $this->stmt->bindParam(':copyright', $this->copyright);
           $this->stmt->bindParam(':author', $this->author);
           $this->stmt->bindParam(':url', $this->url);
           $this->stmt->bindParam(':email', $this->email);
           $this->stmt->bindParam(':smtp', $this->smtp);
           $this->stmt->bindParam(':port', $this->port);
           $this->stmt->bindParam(':password', $this->password);
           $this->stmt->bindParam(':domain', $this->domain);
           $this->stmt->bindParam(':charsert', $this->charsert);
           $this->stmt->bindParam(':username', $this->username);
           $this->stmt->bindParam(':session', $this->session);
           $this->stmt->bindParam(':number_register', $this->number_register);
           $this->stmt->bindParam(':cnpj', $this->cnpj);
           $this->stmt->bindParam(':endereco', $this->endereco);
           $this->stmt->bindParam(':telefone', $this->telefone);
           $this->stmt->bindParam(':celular', $this->celular);
           $this->stmt->bindParam(':facebook', $this->facebook);
           $this->stmt->bindParam(':instagram', $this->instagram);
           $this->stmt->bindParam(':pinterest', $this->pinterest);
           $this->stmt->bindParam(':twitter', $this->twitter);
           $this->stmt->bindParam(':date_register', $this->date_register);
           $this->stmt->bindParam(':date_update', $this->date_update);

           /** Executo o SQL **/
           return $this->stmt->execute();
       }
   }
