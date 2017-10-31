<?php

   class db{
      private $dbhost = '69.65.3.151';
      private $dbuser = 'airint_phpserve';
      private $dbpass = 'Alokin1970!';
      private $dbname = 'airint_phpserver';

      // Connect
      public function connect(){
         $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
         $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);

         $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $dbConnection;
      }
   }
