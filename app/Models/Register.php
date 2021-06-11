<?php

namespace App\Models;

use App\Models\Model;

class Register extends Model
{
 
    public function register($first_name, $last_name, $email, $pwd)
    {

        $sql = 'INSERT INTO users (first_name, last_name, email, pwd)
                VALUES (:first_name, :last_name, :email, :pwd)';
                    
        $query = $this->pdo->prepare($sql);
        $query->execute(["first_name" => $first_name, "last_name" => $last_name, "email" => $email, "pwd" => $pwd]);

        if ($query->rowCount() == 1) {
            
            return true;
        }
        return false;
    }
}
