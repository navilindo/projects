<?php

    /*
        we are using user model to make our DB operations
    */ 

    class UserModel{
        private $con;

        // this constructor makes connection whenever the file is created
        function __construct(){
            
            require_once '../src/connection.php';

            $db = new DB();

            $this->con = $db->connect();

        }


        function add($role, $mail, $password, $status){

            if($this->isUserExisting($mail)){
				return 0; 
			}else{
				// $password = md5($pass);
                $user = "INSERT INTO `users` (`id`, `role`, `mail`, `password`, `status`) VALUES (NULL, ?, ?, ?, ?);";
				
                $stmt = $this->con->prepare($user);
				$stmt->bindParam("ssss",$role,$mail,$password,$status);

				if($stmt->execute()){
					return 1; 
				}else{
					return 2; 
				}
			}


            // $user = "INSERT INTO mayilatronic.users (role, email, password, status) VALUES (?,?,?,?)"; 

            // $stmt = $this->con->prepare($user);

            // $stmt->bindParam("isss", $role, $mail, $password, $status);

            // if($stmt->execute()){
            //     return true;
            // }

            // else return false;
        }

        function addTest($name, $password){

            $user = "INSERT INTO mayilatronic.test (name) VALUES (?)"; 

            $stmt = $this->con->prepare($user);

            $stmt->bindParam("s", $name);

            if($stmt->execute()){
                return true;
            }

            else return false;
        }

        function view($id){
            
            $db = new DB();
            
            $sql = "SELECT * from users where id = $id";

            $result = $db->dbQuery($sql);

            $userdata = $result->fetch(PDO::FETCH_ASSOC);

            if($userdata['id'] != null){ 
                $user = array(
                    'id' => $userdata['id'],
                    'role' => $userdata['role'],
                    'email' => $userdata['email'],
                    'status' =>  $userdata['status']
                );    
            }
            return $user;
        }

        function view_all(){
            
            $db = new DB();
            
            $sql = "SELECT * from users";
            $result = $db->dbQuery($sql);

            $users = array();
            $userdata = $result->fetchAll(PDO::FETCH_ASSOC);

            if($userdata != null){
                foreach($userdata as $u){
                   $user = array (
                       'id' => $u['id'],
                       'role' => $u['role'],
                       'email' => $u['email'],
                       'status' => $u['status']
                   );
                   array_push($users, $user);

                }
            }
            return $users;
        }

        function update($id, $mail, $status){
            
            $sql = "UPDATE users SET name = ?, mail = ?, status = ? WHERE id = ?";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("ssi", $mail, $status, $id);

            $result = $db->dbQuery($sql);

            if($stmt->execute()){
                return true; 
            }
            else return false; 
        }

        function confirm($id){
            
            $db = new DB;

            $sql = "UPDATE users SET status = 'active' WHERE id = $id";
            $result = $db->dbQuery($sql);

            if($result){
                return true; 
            }
            else return false; 
        }

        function delete($id){
            
            $stmt = $this->con->prepare("DELETE FROM users WHERE id = ? ");
            $stmt->bindParam("i", $id);
            //
            $result = $db->dbQuery($sql);

            if($stmt->execute()){
                return true; 
            }
            else return false; 
        }

        private function isUserExisting($mail){
			$stmt = $this->con->prepare("SELECT id FROM users WHERE mail = ?");
			$stmt->bindParam("s",$mail);
			$stmt->execute(); 
			$stmt->store_result();

			return $stmt->num_rows > 0; 
		}
    }

    //$us = new UserModel;
    // $users = $us->view_all();
?>