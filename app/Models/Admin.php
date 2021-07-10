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
    
        
            
               
        }

  

}