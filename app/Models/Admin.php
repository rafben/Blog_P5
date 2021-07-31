<?php

namespace App\Models;

use App\Models\Model;

class Admin extends Model
{

    protected $table = "users";

        public function getUsers()
    {

    
            $query = $this->pdo->prepare('SELECT * FROM users ORDER BY id DESC LIMIT 0,5');
            $query->execute();
            $resultat = $query->fetch();
        
            return $resultat ;
    }
       
        
    
        public function activateUser()
        {
            $sql = 'UPDATE users
                    SET niveau = REPLACE(:niveau, 0, 1)';
                
            $query = $this->pdo->prepare($sql);
            $query->execute(["niveau" => 1]);

            if ($query->rowCount() == 1) {
                
            return true;
        }
        return false;
        
        }

        public function supprimerUser()

            $sql = 'DELETE FROM users
                    WHERE id = :user_id';

            $user_id = 0 ;
            $query = $this->pdo->prepare($sql);
            $query->execute(["first_name" => $first_name, "last_name" => $last_name, "email" => $email, "pwd" => $pwd]);

            if ($query->rowCount() == 1) {
                
                return true;
            }
            return false;
            }


  

}