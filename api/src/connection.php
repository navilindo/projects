<?php

    class DB{
        
        public $conlink;

        public function connect(){

            $host = 'localhost';
            $user= 'rooter';
            $pass = 'toor';
            $db = 'mayilatronic';

            try {

                $conlink = new PDO("mysql:server=$host'; dbname=$db; charset=utf8;", $user, $pass); 

                $conlink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if($conlink){
                    "DB connected successfully<br>";
                }    
            }
            catch(PDOException $e) {
                echo "Connection failed! " . $e->getMessage();
            }

            return $conlink;
        }

        public function dbQuery($sql){

            $con = $this->connect();
        
            try {
                $stmt = $con->query($sql);
                if($stmt){
                    return $stmt;
                }
            } catch (PDOException $e) {
                echo "Database processing error. " . $e->message;
            }
        }

    }

     /*
    //echo "hel<br>";
    
    $db = new DB();
    $c = $db->connect();
    $q = "SELECT * from users";
    $c1 = $db->dbQuery($q);

    if($c1->rowCount()>0){
        //echo "good<br>";echo '<br/>';
        $us = $c1->fetchAll();//echo '<br/>';
        foreach ($us as $u){
            echo $u[0] . " " .$u[3] . "<br/>";
        }

    }
    */
    
?>