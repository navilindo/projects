<?php

    class DB{
        
        public $conlink;

        public function connect(){

            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
            header('Access-Control-Max-Age: 1000');
            header('Access-Control-Allow-Headers: Content-Type, Authorization-Requested-With');

            $host = 'localhost';
            $user = 'rooter';
            $pass = 'toor';
            $db = 'e-presc';

//            include_once dirname(__FILE__) . '/con-vars.php';
            try {
                //echo "hello " . $host . " " . $db ." " . $user . " " . $pass . "<br>";
                //$conlink = new PDO("mysql:server=$host'; dbname=$db; charset=utf8;", $user, $pass);
                $conlink = mysqli_connect($host, $user, $pass, $db); 
                //echo "hello one <br>";
                //$conlink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if($conlink){
                     "DB connected successfully<br>";
                }
                
            }
            catch(PDOException $e) {
                echo "Connection failed! " . $e->getMessage();
            }
            //echo "helllo<br>";
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
    8?*/
    //$db = new DB();
    // $c = $db->connect();
    /*
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
